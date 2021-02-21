<?php
namespace Taghwo\Glade\BankTransfer\Exception;

use Exception;
use Throwable;

class UnAuthenticatedException extends Exception implements Throwable
{
    protected $code = 401;
    protected $message = 'Authentication error, please check the Glade Pay merchant key and merchant ID supplied';
    public function __construct()
    {
        http_response_code(401);
    }
}
