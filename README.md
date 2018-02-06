[![Build Status](https://travis-ci.org/sanmai/gmopg.svg?branch=master)](https://travis-ci.org/sanmai/gmopg)
[![Coverage Status](https://coveralls.io/repos/github/sanmai/gmopg/badge.svg?branch=master)](https://coveralls.io/github/sanmai/gmopg?branch=master)
[![Latest Stable Version](https://poser.pugx.org/sanmai/gmopg/version)](https://packagist.org/packages/sanmai/gmopg)
[![License](https://poser.pugx.org/sanmai/gmopg/license)](https://packagist.org/packages/sanmai/gmopg)

# Installation

    composer require sanmai/gmopg

# Configuration

There are two ways to configure the API:

1. With global constants. Namely, you need to have defined:

	```php
	  // ショップ情報
	define('GMO_SHOP_ID', 'tshop0000001'); // ショップＩＤ
	define('GMO_SHOP_PASSWORD', 'qwerty'); // ショップ名
	define('GMO_SHOP_NAME', 'My Shop'); // ショップパスワード
	define('GMO_TRIAL_MODE', false);
    ```
    Where first three you can get from the management panel or from emails from GMO PG.
    
    The last constant `GMO_TRIAL_MODE` should be set to `true` if you're using a test shop password. 

2. By calling these static methods:

	```php
	\GMO\API\Defaults::setShopID($shopId);
	\GMO\API\Defaults::setShopName($shopName);
	\GMO\API\Defaults::setPassword($shopPassword);
	```

## Testing

Currently there is no easy way to enable a test mode other than by defining a constant `GMO_TRIAL_MODE` set to `true`.

# Basic usage

```php
// A wrapper object that does everything for you.
$payment = new \GMO\ImmediatePayment();
 // Unique ID for every payment; probably should be taken from an auto-increment field from the database.
$payment->paymentId = 123;
$payment->amount = 1000;
// This card number can be used for tests.
$payment->cardNumber = '4111111111111111';
// A date in the future.
$payment->cardYear = '2020';
$payment->cardMonth = '7';
$payment->cardCode = '123';

// Returns false on an error.
if (!$payment->execute()) {
	$errors = $payment->getErrors();
	foreach ($errors as $errorCode => $errorDescription) {
        // Show an error code and a description to the customer? Your choice.
        // Probably you want to log the error too.
	}
	return;
}

// Success!
$response = $payment->getResponse();
/** @var \GMO\API\Response\ExecTranResponse $response */
// You would probably want to save the response in the database for future reference.
// The response can be used to query details about a transaction, make refunds and so on.

```

Array of `$errors` comes in a form similar to this:

	array(1) {
	  'E01040010' =>
	  string(34) "This order ID was used previously."
	}

[A list of most known error codes.](https://faq.gmo-pg.com/service/Detail.aspx?id=480&printMode=1) [In a readable form.](https://github.com/fumikito/Literally-WordPress/blob/master/class/payment/gmo_error_handler.php) [And another.](https://github.com/everright/gmo-pg-php/blob/master/src/GMO/Payment/Consts.php)

A typical `$response` will look like so:
       
	class GMO\API\Response\ExecTranResponse#1 (9) {
	  public $ACS =>
	  string(1) "0"
	  public $OrderID =>
	  string(10) "1517000000"
	  public $Forward =>
	  string(7) "0afd1200"
	  public $Method =>
	  string(1) "1"
	  public $PayTimes =>
	  string(0) ""
	  public $Approve =>
	  string(7) "0112234"
	  public $TranID =>
	  string(28) "180111111111111111111344439"
	  public $TranDate =>
	  string(14) "20221222213141"
	  public $CheckString =>
	  string(32) "68b329da9893e34099c7d8ad5cb9c940"
	}

## Transaction details

Now you naturally want to load transaction details for the current payment. 

```php
$searchTrade = new \GMO\API\Call\SearchTrade();
$searchTrade->OrderID = $payment->getResponse()->OrderID;
// Copy credential from the original payment
$payment->setupOther($searchTrade);

$response = $searchTrade->dispatch();
```

In this `$response` you would find these fields:

	class GMO\API\Response\SearchTradeResponse#4950 (21) {
	  public $AccessID =>
	  string(32) "b026324c6904b2a9cb4b88d6d61c81d1"
	  public $AccessPass =>
	  string(32) "26ab0db90d72e28ad0ba1e22ee510510"
	  public $OrderID =>
	  string(10) "1517000000"
	  public $Status =>
	  string(5) "SALES"
	  public $ProcessDate =>
	  string(14) "20221222213141"
	  public $JobCd =>
	  string(5) "SALES"
	  public $ItemCode =>
	  string(7) "0000000"
	  public $Amount =>
	  string(4) "4999"
	  public $Tax =>
	  string(1) "0"
	  public $SiteID =>
	  string(0) ""
	  public $MemberID =>
	  string(0) ""
	  public $CardNo =>
	  string(16) "************1111"
	  public $Expire =>
	  string(4) "2307"
	  public $Method =>
	  string(1) "1"
	  public $PayTimes =>
	  string(0) ""
	  public $Forward =>
	  string(7) "0afd1200"
	  public $TranID =>
	  string(28) "180111111111111111111344439"
	  public $Approve =>
	  string(7) "0112234"
	  public $ClientField1 =>
	  string(0) ""
	  public $ClientField2 =>
	  string(0) ""
	  public $ClientField3 =>
	  string(0) ""
	}

# Futher API Documentation

GMO-PG is very secretive seemingly for no reason at all (that's [a complete opposite of Stripe](https://stripe.com/docs)), and typically you can only access their documentation upon signing a non-disclosure agreement.
