<?php

include('config.php');
include_once "library/inc.connection.php";

 
        

$transaction_details = array(
	'order_id' 			=> uniqid(),
	'gross_amount' 	=> 200000
);

// Populate items
$items = [
	array(
		'id' 				=> 'item1',
		'price' 		=> 100000,
		'quantity' 	=> 1,
		'name' 			=> 'Adidas f50'
	),
	array(
		'id'				=> 'item2',
		'price' 		=> 50000,
		'quantity' 	=> 2,
		'name' 			=> 'Nike N90'
	)
];

// Populate customer's billing address
$billing_address = array(
	'first_name' 		=> "Andri",
	'last_name' 		=> "Setiawan",
	'address' 			=> "Karet Belakang 15A, Setiabudi.",
	'city' 					=> "Jakarta",
	'postal_code' 	=> "51161",
	'phone' 				=> "081322311801",
	'country_code'	=> 'IDN'
	);

// Populate customer's shipping address
$shipping_address = array(
	'first_name' 	=> "John",
	'last_name' 	=> "Watson",
	'address' 		=> "Bakerstreet 221B.",
	'city' 				=> "Jakarta",
	'postal_code' => "51162",
	'phone' 			=> "081322311801",
	'country_code'=> 'IDN'
	);

// Populate customer's Info
$customer_details = array(
	'first_name' 			=> "Andri",
	'last_name' 			=> "Setiawan",
	'email' 					=> "andrisetiawan@me.com",
	'phone' 					=> "081322311801",
	'billing_address' => $billing_address,
	'shipping_address'=> $shipping_address
	);

// Data yang akan dikirim untuk request redirect_url.
// Uncomment 'credit_card_3d_secure' => true jika transaksi ingin diproses dengan 3DSecure.
$transaction_data = array(
	'payment_type' 			=> 'vtweb', 
	'vtweb' 						=> array(
		'enabled_payments' 	=> ['credit_card'],
		// 'credit_card_3d_secure' => true
	),
	'transaction_details'=> $transaction_details,
	'item_details' 			 => $items,
	'customer_details' 	 => $customer_details
);

$json_transaction_data = json_encode($transaction_data);

// Mengirimkan request dengan menggunakan CURL
// HTTP METHOD : POST
// Header:
//	Content-Type : application/json
//	Accept: application/json
// 	Basic Auth using server_key
$request = curl_init(Config::ENDPOINT);
curl_setopt($request, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($request, CURLOPT_POSTFIELDS, $json_transaction_data);
curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
$auth = sprintf('Authorization: Basic %s', base64_encode(Config::SERVER_KEY.':'));
curl_setopt($request, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
	'Accept: application/json',
	$auth 
	)
);

// Excute request and parse the response
$response = json_decode(curl_exec($request));

// Check Response
if($response->status_code == "201")
{
	//success
	//redirect to vtweb payment page
	header("Location: ".$response->redirect_url);
}
else
{
	//error
	echo "Terjadi kesalahan pada data transaksi yang dikirim.<br />";
	echo "Status message: [".$response->status_code."] ".$response->status_message;

	echo "<h3>Response:</h3>";
	var_dump($response);
}

?>
