<?php

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;


require '../src/start.php';

if(isset($_GET['approved'])){
	$approved = $_GET['approved'] === 'true';

	if($approved) {
		$payerId = $_GET['PayerID'];

		// Get payment_id from database

		$paymentId = $db->prepare("
			select payment_id
			from transcations_paypal
			where hash = :hash
		");

		$paymentId->execute([
			'hash' => $_SESSION['paypal_hash']
		]);

		$paymentId = $paymentId->fetchObject()->payment_id;
		
		$payment = Payment::get($paymentId, $api);
		
		$execution = new PaymentExecution();
		$execution->setPayerId($payerId);
 
		// charge the user
		
		// execute paypal payment(charge)
		$payment->execute($execution, $api);

		//update transaction
		$updateTransaction = $db->prepare("
			update transcations_paypal
			set complete = 1
			where payment_id = :payment_id

			");
		$updateTransaction->execute([
			'payment_id' => $paymentId
		]);

		// set the user as member
		$setMember = $db->prepare("
			update users
			set member = 1
			where id = :user_id
		");
		$setMember->execute([
			'user_id' => $_SESSION['user_id']
		]);
		// unset paypal hash
		unset($_SESSION['paypal_hash']);

		header('Location:../member/complete.php');


	}else{
		header('Location: ../paypal/cancelled.php');
	}


}
?>