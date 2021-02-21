<?php
declare(strict_types=1);

namespace Taghwo\Glade\BankTransfer\Core;

use Taghwo\Glade\BankTransfer\Contracts\BaseInterface;
use Taghwo\Glade\BankTransfer\Exception\InvalidDataException;
use Taghwo\Glade\BankTransfer\Exception\UnAuthenticatedException;

abstract class Gateway implements BaseInterface
{
    abstract protected function requestPayload();

    /**
     * @var string
     */
    protected $method = 'payment';

    /**
     * @var array
     */
    protected $body;

    /**
     * Set headers for request
     * @return array
     */
    private function setHeaders()
    {
        return array(
            "key:".customConfig('Glade_Test_Merchant_Key'),
            "mid:".customConfig('Glade_Test_Merchant_ID')
        );
    }

    /**
     * Set full request endpoint based on method
     * @return string
     */
    private function setURL()
    {
        return customConfig('Glade_Test_Base_Endpoint').$this->method;
    }

    /**
     * Boot up the http connection to Glade Pay API
     * @return string
     */
    public function execute()
    {
        $this->body = $this->requestPayload();

        return $this->makeHttpRequest();
    }

    /**
     * Connect with Glade Pay API
     * @return object
     */
    public function makeHttpRequest()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->setURL());

        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->setHeaders());

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->body));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        return $this->responseHandler($ch);
    }


    /**
     * Send appropriate response back based on response from Glade pay API
     * @return object $ch
     * @param json |Exceptin
     */
    private function responseHandler($ch)
    {
        $response = curl_exec($ch);

        $err = curl_error($ch);

        curl_close($ch);

        if ($err) {
            throw new \Exception($err);
        }

        $data = json_decode($response);

        if ($data->status === 101) {
            throw new UnAuthenticatedException();
        }
        if ($data->status === 102 || $data->status ===103 || $data->status ===104) {
            throw new InvalidDataException($data->message);
        }
        return $data;
    }
}
