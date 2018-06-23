<?php
include_once "inc.session.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

// Program ini akan Dijalankan ketika Tombol BELI diklik, tombol BELI ada di halaman Produk Barang

// Baca Kode Pelanggan yang Login
$KodePelanggan	= $_SESSION['SES_PELANGGAN'];
$NamaPelanggan	= $_SESSION['SES_USERNAME'];
$stok=$_GET['stok'];
if($stok>0)
{
	if(isset($_GET['Kode'])) {
		// Baca Kode Barang yang dipilih
		$Kode = $_GET['Kode'];
		
		// Baca data di dalam Keranjang Belanja	
		$cekSql = "SELECT * FROM tmp_keranjang WHERE kd_barang='$Kode' AND   kd_pelanggan='$KodePelanggan' AND nm_pelanggan='$NamaPelanggan'" ;
		$cekQry = mysql_query($cekSql, $koneksidb) or die ("Compruebe los datos ingresados".mysql_error());
		if(mysql_num_rows($cekQry) >=1) {
			// Si el artículo ha sido seleccionada, la actualización sólo el número de bienes (+1)
			$mySql = "UPDATE tmp_keranjang SET jumlah=jumlah + 1 WHERE kd_barang='$Kode' AND kd_pelanggan='$KodePelanggan' AND nm_pelanggan='$NamaPelanggan'";

		}
		else {
			// Jika barang belum pernah dipilih, maka tambahkan baris baru ke keranjang
			$mySql = "SELECT * FROM barang WHERE kd_barang='$Kode'";
			$myQry = mysql_query($mySql, $koneksidb) or die ("Error en los datos Ingresados".mysql_error());
			$myData = mysql_fetch_array($myQry);
			
			// Membaca data dari tabel Barang, untuk diinput ke tabel TMP
			$hargaModal	= $myData['harga_modal'];
			$hargaJual	= $myData['harga_jual'];
			$tanggal	= date('Y-m-d');
			
			// Simpan data ke TMP (Keranjang Belanja)
			$mySql	= "INSERT INTO tmp_keranjang (kd_barang, harga, jumlah, tanggal, kd_pelanggan,nm_pelanggan) 
						VALUES('$Kode', '$hargaJual', '1', '$tanggal', '$KodePelanggan', '$NamaPelanggan')";
		}
		
		// Menjalankan SQL di atas ( Update jumlah barang & Input barang baru ke TMP)
		$myQry = mysql_query($mySql, $koneksidb) or die ("Error".mysql_error());
		if ($myQry) {
			echo "<meta http-equiv='refresh' content='0; url=?open=KeranjangBelanja'>";
		}
	}
}
else
{
	echo "<b>El Producto no esta disponible, no hay stock del producto :  </b>  ";
	echo "<a href=index.php><b>VOLVER</b></a>";
	echo "<meta http-equiv='refresh' content='4; url=index.php'>";
}
?>