<?php
namespace Taghwo\Glade\BankTransfer\Exception;

use Exception;
use Throwable;

class InvalidDataException extends Exception implements Throwable
{
    protected $code = 400;
    protected $message;
    public function __construct($msg)
    {
        http_response_code(400);
        $this->message = sprintf('%s sent to Glade Pay', $msg);
    }
}
