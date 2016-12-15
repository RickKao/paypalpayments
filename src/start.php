<?php

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

session_start();

$_SESSION['user_id'] = 1;

require __DIR__.'/../vendor/autoload.php';

//API

// 第一個是client
// 第二個是secret
$api = new ApiContext(
		new OAuthTokenCredential(
			'AfGYnSxFm9GJ2Hq9LZtICtFBxEMF-ABmcyg9vYAdaFA3am01ciBtEZID_yhAVrKLpMg8hAJkC1xm0xe3',
			'ED0Picy87FB4bulv3DiU8_e_fEzhO3CDn_qhvriAdQOB4yea1dgSUXefwi6Q-TmOiVXyzKhEiFEVvheo'
		)
	);

$api->setConfig([
	'mode' => 'sandbox',
	'http.ConnectionTimeOut' => 30,
	'log.LogEnabled' => false,
	'log.Filename' => '',
	'log.Loglevel' => 'FINE',
	'validation.level' => 'log'
	]);

$db = new PDO('mysql:host=localhost;dbname=paypal_test','thediafire1','vD4Y35Tg76');
$user = $db->prepare("
	select * from users
	where id = :user_id
	");
$user->execute(['user_id' => $_SESSION['user_id']]);
$user = $user->fetchObject();


?>