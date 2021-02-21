<?php
namespace Taghwo\Glade\PhoneNumber;

use PHPUnit\Framework\TestCase;

require 'vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(realpath("."));
$dotenv->load();
class FunctionTest extends TestCase
{
    /**
     * @test
     */
    public function test_we_can_get_env_credentials_through_config_function()
    {
        $this->assertEquals(config('Glade_Test_Base_Endpoint'), 'https://demo.api.gladepay.com/');
    }

    /**
    * @test
    */
    public function test_we_can_check_env_has_needed_keys()
    {
        $this->assertArrayHasKey('Glade_Test_Base_Endpoint', $_ENV);
        $this->assertArrayHasKey('Glade_Test_Merchant_Key', $_ENV);
        $this->assertArrayHasKey('Glade_Test_Merchant_ID', $_ENV);
    }
}
