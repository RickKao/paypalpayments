<?php
use PayPal\Api\Payer;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use Paypal\Exception\PPConnectionException;

require '../src/start.php';

$payer = new Payer();
$details = new Details();
$amount = new Amount();
$transaction = new Transaction();
$payment = new Payment();
$redirectUrls = new RedirectUrls();

//payper
$payer->setPaymentMethod('paypal'); //這裡跟影片中的function名稱不一樣但意思應該一樣

//details

$details->setShipping('2.00')
		->setTax('0.00')
		->setSubtotal('20.00');

//Amount
// currency 應該要改美金的先用範例預設\
$amount->setCurrency('USD')
       ->setTotal('22.00')
	   ->setDetails($details);

//Transaction
$transaction->setAmount($amount)
	        ->setDescription('Membership');

$payment->setintent('sale')
		->setPayer($payer)
		->setTransactions([$transaction]);

//Redirect URLs
$redirectUrls->setReturnUrl('http://localhost/paypalpayments/paypal/pay.php?approved=true')
			 ->setCancelUrl('http://localhost/paypalpayments/paypal/pay.php?approved=false');

$payment->setRedirectUrls($redirectUrls);


try{

	$payment->create($api);
	
	// generate and store hash
	$hash = md5($payment->getId());
	$_SESSION['paypal_hash'] = $hash;
	//perpare and execute transaction storage
	$store = $db->prepare("
		insert into transcations_paypal(user_id, payment_id, hash, complete)
		values (:user_id, :payment_id, :hash, 0)
		");
	$store->execute([
		'user_id' => $_SESSION['user_id'],
		'payment_id' => $payment->getId(),
		'hash' =>$hash

		]);

}catch (PPConnectionException $e) {
	//perhaps log an error
	header('local: ../paypal/error.php');
}

// var_dump($payment->getLinks());

foreach ($payment->getLinks() as $link) {
	if($link->getRel() == 'approval_url'){
		$redirectUrl = $link->getHref();
	}
}
var_dump($redirectUrl);

header('Location: ' . $redirectUrl);


