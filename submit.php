<?php
require('config.php');
\Stripe\Stripe::setVerifySslCerts(false);
class Stripe{

	public function stripe($name,$email,$amount,$currency,$description)
	{
		$token=\Stripe\Token::create([
			'card' => [
			  'number' => '4242424242424242',
			  'exp_month' => 11,
			  'exp_year' => 2022,
			  'cvc' => '314',
			],
		  ]);
		
			
		  $customer = \Stripe\Customer::create([
			'name' => $name,
			'email' => $email,
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
					"amount" => $amount,
					"currency" => $currency,
					"description" => $description, 
				]);
				echo "<pre>";
				print_r($customer);
	}
};
$name=$_POST['name'];
$email=$_POST['email'];
$amount=$_POST['amount'];
$currency=$_POST['currency'];
$description=$_POST['description'];

$stripe_class=new Stripe();
$stripe_class->stripe($name,$email,$amount,$currency,$description);
// $merchant_class->viewRole($user_id,$token);


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

	
	// $token=\Stripe\Token::create([
	// 	'card' => [
	// 	  'number' => '4242424242424242',
	// 	  'exp_month' => 11,
	// 	  'exp_year' => 2022,
	// 	  'cvc' => '314',
	// 	],
	//   ]);
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
// 	$customer = \Stripe\Customer::create([
// 		'name' => 'Jenny Rosen',
// 		'email' => 'abdully2k16@gmail.com',
// 		'address' => [
// 			'line1' => '510 Townsend St',
// 			'postal_code' => '98140',
// 			'city' => 'San Francisco',
// 			'state' => 'CA',
// 			'country' => 'US',
// 		],
// 	]);
	
// 	\Stripe\Customer::createSource(
// 		$customer->id,
// 		['source' => $token]
// 	);
	
// 	Stripe\Charge::create ([
// 		"customer" => $customer->id,
// 		"amount" => 100 * 50,
// 		"currency" => "usd",
// 		"description" => "Test payment from stripe.test." , 
// 	]);
// 	echo "<pre>";
// 	print_r($customer);

// 	$inputArr=['name','email','amount','currency','description'];

// if (isset($_POST['name','email','amount','currency','description']))
// {
// $name=$_POST['name'];
// $email=$_POST['email'];
// $password=$_POST['password'];
// $amount=$_POST['amount'];

// $merchant_class=new Listing();
// $merchant_class->viewRole($user_id,$token);



?>
