<?php
include_once "inc.session.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

// Baca Kode Pelanggan yang Login
$KodePelanggan	= $_SESSION['SES_PELANGGAN'];
$NamaPelanggan	= $_SESSION['SES_USERNAME'];

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	$arrData = count($_POST['txtJum']);
	$qty = 1;
	for ($i=0; $i < $arrData; $i++) {
		# Melewati biar tidak 0 atau minus
		if ($_POST['txtJum'][$i] < 1) {
			$qty = 1;
		}
		else {
			$qty = $_POST['txtJum'][$i];
		}

		# Simpan Perubahan
		$KodeBrg	= $_POST['txtKodeH'][$i];
		$tanggal	= date('Y-m-d');
		$jam		= date('G:i:s');

		$sql = "UPDATE tmp_keranjang SET jumlah='$qty', tanggal='$tanggal'
				WHERE kd_barang='$KodeBrg' AND kd_pelanggan='$KodePelanggan' AND nm_pelanggan='$NamaPelanggan'";
		$query = mysql_query($sql, $koneksidb);
	}
	// Refresh
	echo "<meta http-equiv='refresh' content='2; url=?open=KeranjangBelanja'>";
	exit;
}

# MENGHAPUS DATA BARANG YANG ADA DI KERANJANG
// Membaca Kode dari URL
if(isset($_GET['aksi']) and trim($_GET['aksi'])=="Hapus"){
	// Membaca Id data yang dihapus
	$idHapus	= $_GET['idHapus'];

	// Menghapus data keranjang sesuai Kode yang dibaca di URL
	$mySql = "DELETE FROM tmp_keranjang  WHERE id='$idHapus' AND kd_pelanggan='$KodePelanggan' AND nm_pelanggan='$NamaPelanggan'";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Eror hapus data".mysql_error());
	if($myQry){
		echo "<meta http-equiv='refresh' content='2; url=?open=Barang2'>";
	}
}

# MEMERIKSA DATA DALAM KERANJANG
$cekSql = "SELECT * FROM tmp_keranjang WHERE  kd_pelanggan='$KodePelanggan' AND nm_pelanggan='$NamaPelanggan'";
$cekQry = mysql_query($cekSql, $koneksidb) or die (mysql_error());
$cekQty = mysql_num_rows($cekQry);
if($cekQty < 1){
	echo "<br><br>";
	echo "<center>";
	echo "<b> CARRITO DE COMPRA VACIO </b>";
	echo "<center>";

	// Jika Keranjang masih Kosong, maka halaman Refresh ke data Barang
	echo "<meta http-equiv='refresh' content='1; url=?page=Barang2'>";
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Tienda Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet"/>
	<link href="assets/css/docs.css" rel="stylesheet"/>

    <link href="style.css" rel="stylesheet"/>
	<link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet"/>

	<!-- Less styles
	<link rel="stylesheet/less" type="text/css" href="less/bootsshop.less">
	<script src="less.js" type="text/javascript"></script>
	 -->

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">


  </head>
<body>
  <!-- Navbar
    ================================================== -->

<!-- ======================================================================================================================== -->

<!-- ==================================================Header End====================================================================== -->


	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Inicio</a> <span class="divider">/</span></li>
		<li class="active"> Carrito de Compras</li>
    </ul>
	<img src="images/compras_en_linea.png" width="900" height="41px">
	<hr class="soft"/>
	<form action="<?php $_SERVER['PHP_SELF']; ?>" METHOD="POST" target="_self">
	<table class="table table-bordered">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Nombre Producto</th>
                  <th>Precio (S/.)</th>
				  <th>Cantidad</th>
                  <th colspan="2">Total</th>

				</tr>
				<?php
				// Menampilkan data Barang dari tmp_keranjang (Keranjang Belanja)
	$mySql = "SELECT barang.nm_barang, barang.file_gambar, kategori.nm_kategori, tmp_keranjang.*
			FROM tmp_keranjang
			LEFT JOIN barang ON tmp_keranjang.kd_barang=barang.kd_barang
			LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori
			WHERE tmp_keranjang.kd_pelanggan='$KodePelanggan'
			ORDER BY tmp_keranjang.id";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal SQL".mysql_error());
	$total = 0; $grandTotal = 0;
	$no	= 0;
	while ($myData = mysql_fetch_array($myQry)) {
	  $no++;
	  // Menghitung sub total harga
	  $total 		= $myData['harga'] * $myData['jumlah'];
	  $grandTotal	= $grandTotal + $total;

	  // Menampilkan gambar
	  if ($myData['file_gambar']=="") {
			$fileGambar = "assets/products/noimage.jpg";
	  }
	  else {
			$fileGambar	= $myData['file_gambar'];
	  }

	  #Kode Barang
	  $Kode = $myData['kd_barang'];
	?>
              </thead>
              <tbody>
                <tr>
                  <td> <img width="60" src="assets/products/<?php echo $fileGambar; ?>" width="70" alt=""/></td>
                  <td><b><?php echo $myData['nm_barang']; ?> </b></td>

                  <td>S/. <?php echo format_angka($myData['harga']); ?></td>
                  <td><input name="txtJum[]" type="text" value="<?php echo $myData['jumlah']; ?>" width="2" >
                  <input name="txtKodeH[]" style="width:0px;"type="hidden" value="<?php echo $myData['kd_barang']; ?>"></td>

                  <td> S/. <?php echo format_angka($total); ?></td>
                  <td><a href="?open=KeranjangBelanja&aksi=Hapus&idHapus=<?php echo $myData['id']; ?>"><img src="images/hapus.gif" alt="Eliminar datos de Compra" width="16" height="16" border="0"></a></td>
                </tr>

                <?php } ?>
				 <tr>
                  <td colspan="4" align="right"><strong>TOTAL</strong></td>
                  <td class="label label-important" colspan="2"> <strong><?php echo "S/.".format_angka($grandTotal); ?> </strong></td>
                </tr>
                    <tr>
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2"><input name="btnSimpan" type="submit" value="VER TOTAL"></td>
                    </tr>
	</tbody>
	</form>
            </table>
        
	<a href="?open=Transaksi-Proses" class="btn btn-large pull-right">Siguiente <i class="icon-arrow-right"></i></a><br><BR>
<a href="?open=Barang2" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Seguir Comprando </a> <br /><BR>
        
			<table class="table table-bordered">
			<tbody>
                <tr><th colspan="2"><strong>ACTUALIZAR</strong> </th></tr>
                 <tr>
				 <td>
					<form class="form-horizontal">
		
					  <div class="control-group">
						<label class="span2 control-label" for="inputPost"><input name="" type="button" value="VER TOTAL"></label>
						<div class="controls">
						  <b>(Total) Pulse para ver la cantidad que se debe pagar de acuerdo a la cantidad que se ha actualizado</b>
						</div>
					  </div>
                        <!---
					  <div class="control-group">
						<div class="controls">
						  <button type="submit" class="btn">ESTIMATE</button>
						</div>-->
					  </div>
					</form>
				  </td>
				  </tr>
              </tbody>
            </table>
</div>
</div>

  </body>
</html>