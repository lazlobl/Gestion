<?php
include_once "library/inc.connection.php";

# BACA TOMBOL LOGIN DIKLIK
if(isset($_POST['btnLogin'])){
	// Baca variabel form
	$txtUsername   = $_POST['txtUsername'];
	$txtPassword   = $_POST['txtPassword'];

	// Validasi data pada form
	$pesanError = array();
	if (trim($txtUsername)=="") {
		$pesanError[] = "<b>Usuario</b> vacía, por favor, rellene correctamente";
	}
	if (trim($txtPassword)=="") {
		$pesanError[] = "<b>Contraseña</b> vacía, por favor, rellene correctamente";
	}


	// Skrip validasi User dan Password dengan data di Database
	$loginSql = "SELECT * FROM pelanggan WHERE username='$txtUsername' AND password=MD5('$txtPassword')";
	$loginQry = mysql_query($loginSql, $koneksidb) or die ("Gagal query password".mysql_error());
	$loginQty = mysql_num_rows($loginQry);
	if($loginQty < 1) {
		$pesanError[] = "Data <b>Usuario y Contraseña</b> introducida no es correcta o nombre de usuario no está activada <b> Por favor Activa tu nombre de usuario en tu correo</b> ";
	}

	// Tampilkan pesan Error jika ditemukan
	if (count($pesanError)>=1 ) {
		echo "<div><br>";
		echo "<div align='left'>";
		echo "&nbsp; <b> INICIO DE SESION NO VALIDO .............</b><br><br>";
		echo "&nbsp; <b> Error Datos de Usuario : </b><br>";
		$urut_pesan = 0;
		foreach ($pesanError as $indeks=>$pesanTampil) {
			$urut_pesan++;
			echo "<div class='pesanError' align='left'>";
			echo "&nbsp; &nbsp;";
			echo "$urut_pesan . $pesanTampil <br>";
		}
		echo "<br></div>";
	}
	else {
		# JIKA TIDAK ADA ERROR FORM DAN LOGIN BERHASIL
		if ($loginQty >=1) {
			// baca data dari Query Login
			$loginData = mysql_fetch_array($loginQry);

			// Membuat session
			$_SESSION['SES_PELANGGAN'] 	= $loginData['kd_pelanggan'];
			$_SESSION['SES_USERNAME'] 	= $loginData['username'];

			// Baca data Kode Pelanggan yang login
			$KodePelanggan	= $loginData['kd_pelanggan'];

			// Kosongkan tabel TMP yang datanya milik Pelanggan
			//$hapusSql = "DELETE FROM tmp_keranjang WHERE kd_pelanggan='$KodePelanggan'";
			//mysql_query($hapusSql) or die ("Gagal query hapus".mysql_error());

			echo "<meta http-equiv='refresh' content='0; url=index.php'>";
			exit;
		}
	}
}
?>