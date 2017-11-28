[![Build Status](https://travis-ci.org/sanmai/gmopg.svg?branch=master)](https://travis-ci.org/sanmai/gmopg)
[![Coverage Status](https://coveralls.io/repos/github/sanmai/gmopg/badge.svg?branch=master)](https://coveralls.io/github/sanmai/gmopg?branch=master)

# Installation

    composer require sanmai/gmopg

# Configuration

This library expects certain global constants present. Namely, you need to have defined:

    // ショップ情報
	define('GMO_SHOP_ID', 'tshop0000001'); // ショップＩＤ
	define('GMO_SHOP_PASSWORD', 'qwerty'); // ショップ名
	define('GMO_SHOP_NAME', 'My Shop'); // ショップパスワード
	define('GMO_TRIAL_MODE', false);

Where first three you can get from the management panel or from emails from GMO PG. 

The last constant `GMO_TRIAL_MODE` should be set to `true` if you're using a test shop password.

# Usage

	// A wrapper object that does everything for you.
	$payment = new \GMO\ImmediatePayment();
	 // Unique ID for every payment; probably should be taken from an auto-increment field from the database.
	$payment->paymentId = 123;
	$payment->amount = 1000;
	// This card number can be used for tests
	$payment->cardNumber = '4111111111111111';
	// A date in the future
	$payment->cardYear = '2020';
	$payment->cardMonth = '7';
	$payment->cardCode = '123';
	
	if ($payment->execute()) {
	    // Success!
	    $response = $payment->getResponse();
	    /** @var \GMO\API\Response\ExecTranResponse $response */
	    // You would probably want to save the response in the database.
	    // The response can be used to query details about a transaction, make refunds and so on.
	} else {
	    $errorCode = $payment->getErrorCode();
	    // Show error message to the customer?
	}

[A list of most known error codes.](https://github.com/fumikito/Literally-WordPress/blob/master/class/payment/gmo_error_handler.php)


