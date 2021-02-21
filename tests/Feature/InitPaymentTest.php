<?php
namespace Taghwo\Glade\BankTransfer;

use PHPUnit\Framework\TestCase;
use Taghwo\Glade\BankTransfer\Core\InitPayment;

class InitPaymentTest extends TestCase
{
    protected $amount;
    protected $transRef;
    protected function setUp():void
    {
        parent::setUp();
        $bankTransfer = new InitPayment();

        $this->amount = 2000;

        $this->reponse = $bankTransfer->amountPayable($this->amount)
               ->customUserData(['email' => "jacky@example.com","firstname"=>"John", "lastname"=>"Doe"])
               ->execute();
    }

    /**
     * @test
     *
     */
    public function test_we_can_get_account_number()
    {
        $this->assertTrue(isset($this->reponse->accountNumber));
        $this->assertNotEmpty($this->reponse->accountNumber);
    }

    /**
    * @test
    *
    */
    public function test_we_can_get_account_name()
    {
        $this->assertTrue(isset($this->reponse->accountName));
        $this->assertNotEmpty($this->reponse->accountName);
    }

    /**
    * @test
    *
    */
    public function test_we_can_get_bank_name()
    {
        $this->assertTrue(isset($this->reponse->bankName));
        $this->assertNotEmpty($this->reponse->bankName);
    }

    /**
    * @test
    *
    */
    public function test_status_code_ok()
    {
        $this->assertTrue($this->reponse->status === 202);
    }
}
