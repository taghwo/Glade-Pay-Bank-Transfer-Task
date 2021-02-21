<?php
namespace Taghwo\Glade\BankTransfer;

use PHPUnit\Framework\TestCase;
use Taghwo\Glade\BankTransfer\Core\InitPayment;
use Taghwo\Glade\BankTransfer\Core\VerifyPayment;
use Taghwo\Glade\BankTransfer\Exception\InvalidDataException;

class PaymentVerificationTest extends TestCase
{
    protected $amount;
    protected $transRef;
    protected function setUp():void
    {
        parent::setUp();
        $bankTransfer = new InitPayment();

        $this->amount = 2000;

        $res = $bankTransfer->amountPayable($this->amount)
               ->customUserData(['email' => "jacky@example.com","firstname"=>"John", "lastname"=>"Doe"])
               ->execute();
        $this->transRef = $res->txnRef;
        $this->verifyPayment = new VerifyPayment($this->transRef);
    }

    /**
     * @test
     *
     */
    public function test_we_can_verify_payment_status_amount_message()
    {
        $data = $this->verifyPayment->execute();
        $this->assertEquals($data->status, 200);
        $this->assertEquals($data->message, "PENDING");
        $this->assertEquals($data->txnRef, $this->transRef);
        $this->assertEquals($data->chargedAmount, 0);
        $this->assertEquals($data->payment_method, 'bank_transfer');
    }

    /**
     * @test
     *
     */
    public function test_we_can_get_invalid_response_for_invalid_txnref()
    {
        $this->expectException(InvalidDataException::class);
        $this->expectExceptionCode(400);
        $badTxnRef = "iueyfiuegh7676";
        $this->verifyPayment = new VerifyPayment($badTxnRef);
        $this->verifyPayment->execute();
    }
}
