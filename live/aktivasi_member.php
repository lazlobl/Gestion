<?php

mysql_connect('mysql3.000webhost.com','a9862724_herry','default123') or die (mysql_error());
mysql_select_db('a9862724_phpherr');

$kode=$_GET['code'];

$sql=mysql_query("SELECT * FROM pelanggan WHERE kode_aktivasi= '$kode' AND status='N'");

$nums=mysql_num_rows($sql);
if($nums > 0){
	$data=mysql_fetch_array($sql);
mysql_query("UPDATE pelanggan SET status='Y' WHERE kd_pelanggan='$data[kd_pelanggan]'");
echo "AKUN ANDA TELAH AKTIF";

require "daftar_member.php"; 
}
?>