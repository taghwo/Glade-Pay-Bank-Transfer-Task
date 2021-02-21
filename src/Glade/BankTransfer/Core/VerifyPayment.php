<?php
namespace Taghwo\Glade\BankTransfer\Core;

use Taghwo\Glade\BankTransfer\Exception\InvalidDataException;

class VerifyPayment extends Gateway
{
    /**
    * @var string
    */
    public $txnref;

    /**
    * @var string
    */
    protected $actionType = 'verify';

    /**
    * Verify transaction with transaction reference token
    * @return void
    * @param string $txnRef
    */
    public function __construct(string $txnRef)
    {
        $this->txnRef =  $txnRef;
    }

    /**
    * Prepare data to be sent in the request body
    * @return array | Exception
    */
    protected function requestPayload()
    {
        if (empty($this->txnRef)) {
            throw new InvalidDataException('Transaction ref cannot be null');
        }

        return [
            'action' => $this->actionType,
            'txnRef' => $this->txnRef
        ];
    }
}
