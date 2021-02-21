<?php
namespace Taghwo\Glade\BankTransfer\Core;

use Taghwo\Glade\BankTransfer\Exception\InvalidDataException;

class InitPayment extends Gateway
{
    /**
     * @var string
     */
    protected $amount;

    /**
     * @var Array
     */
    protected $userData;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $actionType = 'charge';

    /**
     * @var string
     */
    protected $paymentType = 'bank_transfer';

    /**
     * @var string
     */
    protected $defaultCountry = 'NG';
    /**
     * @var string
     */
    protected $defaultCurrency = 'NGN';

    /**
     * Amount to be charged
     * @return object
     * @param string $amount
     */
    public function amountPayable(string $amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Takes array of key value pairs for User data.
     * Example ['first_name' =>'john Doe','email' => "sparky@example.com']
     * This data will be returned when and after verifying payment
     * @return object
     * @param array $amount
     */
    public function customUserData(array $data)
    {
        $this->userData = $data;

        return $this;
    }

    /**
    * Optional method. Set to currency that fits the transaction
    * If no currency is supplied, NGN will be used
    * This data will be returned when and after verifying payment
    * @return object
    * @param string $currency
    */
    public function currency(string $currency)
    {
        $this->currency = $currency;

        return $this;
    }


    /**
    * Optional method. Set to country that fits the transaction
    * If no currency is supplied, NG will be used
    * This data will be returned when and after verifying payment
    * @return object
    * @param string $currency
    */
    public function country(string $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
    * Prepare data to be sent in the request body
    * @return array | Exception
    */
    protected function requestPayload()
    {
        if (empty($this->amount)) {
            throw new InvalidDataException('Amount cannot be empty');
        }

        return [
            'action' => $this->actionType,
            'paymentType' => $this->paymentType,
            'amount' => $this->amount,
            'currency' => is_null($this->currency)?$this->defaultCountry:$this->currency,
            'country' => is_null($this->country)?$this->defaultCountry:$this->country,
            'user' =>  $this->userData
        ];
    }
}
