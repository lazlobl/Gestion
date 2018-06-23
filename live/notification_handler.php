<?php

include('config.php');

//Contoh untuk menangani HTTP (POST) notifikasi yang dikirim Veritrans
$json_result = file_get_contents('php://input');
$result = json_decode($json_result);

error_log("Menerima notifikasi dari Veritrans: ");
error_log($json_result);

if($result->status_code == "200")
{
	//OK, trancaction is success
	error_log("Status transaksi untuk order id ".$result->order_id.": ".$result->status_code);

	//TODO: Update merchant's database (Ex: update status order).
}
else if($result->status_code == "201")
{
	//Pending, transaction is success but the processing has not been completed.
	error_log("Status transaksi untuk order id ".$result->order_id.": ".$result->status_code);

	//TODO: Update merchant's database (Ex: update status order).
}
else if($result->status_code == "202")
{
	//Denied, request is success but transaction is denied by bank or Veritrans fraud detection system.
	error_log("Status transaksi untuk order id ".$result->order_id.": ".$result->status_code);

	//TODO: Update merchant's database (Ex: update status order).
}
else
{
	//error. You can see all the possibilities of the status_code and the explanation on the Veritrans Payment API Documentation
	error_log("Terjadi kesalahan. Status code: ".$result->status_code);
}

?>
