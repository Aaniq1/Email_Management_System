<?php
require('config.php');
\Stripe\Stripe::setVerifySslCerts(false);
// require_once('vendor/autoload.php');

// $stripe = new \Stripe\StripeClient(
// 	'pk_test_51JocKUGfeQeGO4uV94dbRMPqC5kPEAoTPJgRiqWv52OjVkTWqzw4jhsglHiXEeFS9fpG1pObrU5fC4by9QMatRn200rwKb47zl'
//   );
//   $stripe->tokens->create([
// 	'card' => [
// 	  'number' => '4242424242424242',
// 	  'exp_month' => 10,
// 	  'exp_year' => 2022,
// 	  'cvc' => '314',
// 	],
//   ]);

	
	$token=\Stripe\Token::create([
		'card' => [
		  'number' => '4242424242424242',
		  'exp_month' => 11,
		  'exp_year' => 2022,
		  'cvc' => '314',
		],
	  ]);
	// $customer=$data=\Stripe\Customer::create(array(
	// 	"email"=>"phpvishal@gmail.com",
	// 	"source"=>$token,
	// ));
	
	// $data=\Stripe\Charge::create(array(
	// 	"amount"=>50,
	// 	"currency"=>"usd",
	// 	"description"=>"Programming with Vishal Desc",
	// 	"customer" => $customer->id,
	// 	"source"=>$token,
	// ));
	$customer = \Stripe\Customer::create([
		'name' => 'Jenny Rosen',
		'email' => 'abdully2k16@gmail.com',
		'address' => [
			'line1' => '510 Townsend St',
			'postal_code' => '98140',
			'city' => 'San Francisco',
			'state' => 'CA',
			'country' => 'US',
		],
	]);
	
	\Stripe\Customer::createSource(
		$customer->id,
		['source' => $token]
	);
	
	Stripe\Charge::create ([
		"customer" => $customer->id,
		"amount" => 100 * 50,
		"currency" => "usd",
		"description" => "Test payment from stripe.test." , 
	]);
	echo "<pre>";
	print_r($customer);

?>