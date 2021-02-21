<?php

namespace Taghwo\Glade\BankTransfer;

use PHPUnit\Framework\TestCase;
use Taghwo\Glade\BankTransfer\Exception\UnAuthenticatedException;
use Taghwo\Glade\BankTransfer\Exception\InvalidDataException;

class ExceptionTest extends TestCase
{
    /**
    * @test
    *
    ***/
    public function assert_UnAuthenticatedException_exception_is_thrown()
    {
        $this->expectException(UnAuthenticatedException::class);
        $this->expectExceptionCode(401);

        throw new UnAuthenticatedException();
    }

    /**
     * @test
     *
     ***/
    public function assert_invalid_data_exception_fires()
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionMessage(INVALID_DATA_MESSAGE);
        $this->expectExceptionCode(400);

        throw new InvalidDataException(INVALID_DATA_MESSAGE);
    }
}
