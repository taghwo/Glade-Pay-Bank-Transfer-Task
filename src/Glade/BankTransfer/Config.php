<?php
require_once "vendor/autoload.php";
$dotenv = \Dotenv\Dotenv::createImmutable(realpath("."));
$dotenv->load();

if (!function_exists('config')) {
    function config($key)
    {
        $configs = [
            'Glade_Test_Merchant_ID' => $_ENV['Glade_Test_Merchant_ID'],
            'Glade_Test_Merchant_Key' => $_ENV['Glade_Test_Merchant_Key'],
            'Glade_Test_Base_Endpoint' => $_ENV['Glade_Test_Base_Endpoint']
        ];
        if ($configs[$key]) {
            return $configs[$key];
        }
        throw new InvalidArgumentException("Sorry array key => $key does not exist in your env");
    }
}
