# Backend Task for Glade Pay Bank Transfer API
# This package does two things
```sh
1. Initialize bank tranfer flow, returns account details to make payment to.
2. Verifies bank transfer status, returns status of payment.
```

```sh
Status code returned include
1: 401 for unauthenticated response
2: 400 for wrong method or wrong data format supplied
3: 500 for for invalid integration
```

```sh
Successful request will return an stdClass Object
```

# Installation
```sh
composer require taghwo/nigerian-phone-number-validator-formatters
```

```sh
Create a .env file in the root on your project and set fill in details
Glade_Test_Merchant_ID=GP****
Glade_Test_Merchant_Key=123****
Glade_Test_Base_Endpoint: https://demo.api.gladepay.com/
```

#include autoload in your project (PHP file)
```sh
 require_once "vendor/autoload.php";

 Run composer dump-autoload
 ```

 # Usage
 # Initialize Bank Transfer Payment
```sh
Call the InitPayment class
use Taghwo\Glade\BankTransfer\Core\InitPayment;

Make an instance of the class
$bankTransfer = new InitPayment();

Request example
$response = $bankTransfer
            ->amountPayable('1500')
            ->customUserData(['email' => "jacky@example.com","firstname"=>"John", "lastname"=>"Doe"])
            ->execute();
print_r($response);

There are few methods that can be chained together.
```
# Available methods For Initializing Payment
```
amountPayable() this sets the amount to charge for the transaction
Required:true
Throws InvalidData Exception if amount is supplied
```

```
customUserData() takes an array of user data, this add more detail to the transaction. You can add first_name, last_name, email, IP address and fingerprint
Required:false
```

```
country() country to use for this transaction. If not supplied it, will be set to "NG"
Required:false
```

```
currency() currency to use for this transaction. If not supplied it, will be set to "NGN"
Required:false
```

```
execute() this executes the initialization process
Required:true
```

```
Response Example
( [status] => 202 [txnRef] => GP83015561620210221D [auth_type] => device [accountNumber] => 9922554842 [accountName] => GladePay Demo [bankName] => Providus Bank [accountExpires] => 600 [message] => Make a transfer into the following account using your bank app or internet banking platfrom to complete the transaction )
```


 # Verify Bank Transfer Payment
```sh
Call the VerifyPayment class
use Taghwo\Glade\BankTransfer\Core\VerifyPayment;

Request example, it take the transaction reference as argument

$verifyPayment = new VerifyPayment('txnRef');

$response = $verifyPayment
              ->execute();

print_r($response);
```
# Available methods For Verifying Payment Status
```
execute() this executes the initialization process
Required:true
```

```
Response Example
( [status] => 200 [txnStatus] => pending [txnRef] => GP83015561620210221D [message] => PENDING [chargedAmount] => 0 [currency] => NG [payment_method] => bank_transfer [fullname] => John Doe [email] => jacky@example.com [bank_message] => Awaiting Validation )
```
