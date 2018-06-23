<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

$filterSql	= "";
// Membaca variabel form
$KeyWord	= isset($_GET['KeyWord']) ? $_GET['KeyWord'] : '';
$txtKeyword	= isset($_POST['txtKeyword']) ? $_POST['txtKeyword'] : $KeyWord;

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
	if($_POST) {
         // Skrip pencarian
		$filterSql = "WHERE nm_barang LIKE '%$txtKeyword%' OR nm_barang LIKE '$txtKeyword%'";
	}
}
else {
	if($KeyWord){
         // Skrip pencarian
		$filterSql = "WHERE nm_barang LIKE '%$txtKeyword%' OR nm_barang LIKE '$txtKeyword%'";
	}
	else {
		$filterSql = "";
	}
}

# Nomor Halaman (Paging)
$baris	= 10;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM barang $filterSql ORDER BY kd_barang DESC";
$pageQry= mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	= mysql_num_rows($pageQry);
$maks	= ceil($jml/$baris);
$mulai	= $baris * ($hal-1);
?>
<html>
<head>
<title></title>
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
    <link rel="stylesheet" type="text/css" href="admin/styles_user.css">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

</head>
<body>
<div>
<table width="75%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC" scope="col"><strong>RESULTADOS DE LA BÚSQUEDA </strong> " <?php echo $txtKeyword; ?> "</td>
  </tr>
<?php
// Menampilkan daftar barang
$barang2Sql = "SELECT barang.*,  kategori.nm_kategori FROM barang
			LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori
			$filterSql
			ORDER BY barang.kd_barang ASC LIMIT $mulai, $baris";
$barang2Qry = mysql_query($barang2Sql, $koneksidb) or die ("Gagal Query".mysql_error());
$nomor = 0;
while ($barang2Data = mysql_fetch_array($barang2Qry)) {
  $nomor++;
  $KodeBarang = $barang2Data['kd_barang'];
  $KodeKategori = $barang2Data['kd_kategori'];

  // Menampilkan gambar utama
  if ($barang2Data['file_gambar']=="") {
		$fileGambar = "noimage.jpg";
  }
  else {
		$fileGambar	= $barang2Data['file_gambar'];
  }

// Warna baris data
if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
?>
  <tr>
    <td width="24%" align="center">
		<a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>">
		<img src="assets/products/<?php echo $fileGambar; ?>" width="100" border="0"> </a> <br>
		<div class='harga'>S/. <?php echo format_angka($barang2Data['harga_jual']); ?> </div> <br>
		<a href="?open=Barang-Beli&Kode=<?php echo $KodeBarang; ?>" class="btn btn-small"><i class=" icon-shopping-cart"></i> Agregar al Carrito</a>
    <td width="76%" valign="top">
		<a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>">
	  <div class='judul'> <font color="red"><strong><?php echo $barang2Data['nm_barang']; ?></strong></font> </div> </a>
		<p><?php echo substr($barang2Data['keterangan'], 0, 200); ?> ....</p>
		<p><strong>Stock :</strong> <?php echo $barang2Data['stok']; ?></p>
	<strong>Categoria :</strong> <?php echo $barang2Data['nm_kategori']; ?>	</td>
  </tr>
<?php } ?>
  <tr>
    <td colspan="2" align="center"><b>Paginas:
      <?php
	for ($h = 1; $h <= $maks; $h++) {
			echo "[  <a href='?open=BarangPencarian&KeyWord=$txtKeyword&hal=$h'>$h</a> ]";
	}
	?>
    </b></td>
  </tr>
</table>
</div>
</div
</body>
</html>
