#Backedn Task for Glade Pay Bank Transfer API
#This package does two things
```sh
1. Initialize bank tranfer flow, returns account details to make payment to.
2. Verifies bank transfer status, returns status of payment.
```

```sh
Status code returned include
1: 401 for unauthicated response
2: 400 for wrong method and wrong data format
3: 500 for for invalid integration
```

```sh
Succesful request will return an stdClass Object
```

#Installation
```sh
composer require taghwo/nigerian-phone-number-validator-formatters
```
#include package in your PHP file
```sh
 require_once "vendor/autoload.php"; 
 ```

```sh
use Taghwo\PhoneNumber\PhoneNumberRequest;
```

##Available methods
```
setDigits() accepts single or range of digits(min_range, max_range). ('14') or ('11','14)
```
```
validateWithRange() will validate if phone number supplied falls within range 
```
```
validateStrict() throws exception if phone number supplied is === single number in setDigits()
```
```
getCleanNumber() returns clean phone number
```
```
formatToIntPhoneNumber() prefixes 234 on phonenumber if it does not have it
```
```
getPrefix() fetches phonenumber prefix
```
```
splitPhoneNumber() splits phone number into chunks based on criterai supplied, (null, 4)
```
```
setPhoneNumber() Note only use when using the static call on use Taghwo\PhoneNumber\PhoneNumber;
```

#Usage

## example using the class instance
```sh
$phonenumber = new PhoneNumberRequest('/--dff/s07000000000');
         
          $phonenumber
            ->setDigits('11,14')
            ->validateWithRange() ✅
            ->getCleanNumber()//07000000000;✅
            ->formatToIntPhoneNumber()//2347000000000;✅
            ->getPrefix()//070
            ->splitPhoneNumber(null, 3);//[070,000,000,00];

```
## using statically
```sh
use Taghwo\PhoneNumber\PhoneNumber;
```
```sh
PhoneNumber::setDigits('14')
            ->setPhoneNumber('/--dff/s07000000000')
            ->validateStrict()//❌ must be 14 chars
            ->getCleanNumber()//0700000000;✅
            ->formatToIntPhoneNumber()//2347000000000;✅
            ->getPrefix()//070
            ->splitPhoneNumber(null, 3);//[070,000,000,00];

```

#Extra
```
Running quick checks on phone number, returns true and false
```
```
use Taghwo\PhoneNumber\Rule\Check;

$isValid = Check::verifyPhoneNumber('000007060499168');//❌false
$isIntFormat = Check::verifyPhoneNumberIsIntFormat('007060499168');//❌False
```