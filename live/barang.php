<?php
error_reporting();
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
# Nomor Halaman (Paging)
$baris = 3;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql = "SELECT * FROM barang";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$maks	 = ceil($jml/$baris);
$mulai	= $baris * ($hal-1);
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
<div class="row">
	<div class="span9">
   	<hr class="soft"/>
<br class="clr"/>
<div class="tab-content">

		<div class="row">	  
            <?php
                   
                
$barangSql =mysql_query( "SELECT barang.*,  kategori.nm_kategori FROM barang 
			LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori 
			ORDER BY barang.kd_barang ASC LIMIT $mulai, $baris");
//$barangQry = mysql_query($barangSql, $koneksidb) or die ("Gagal Query".mysql_error()); 
$nomor = 0;
while ($barangData = mysql_fetch_array($barangSql)) {
	
	$KodeBarang = $barangData['kd_barang'];
	$KodeKategori = $barangData['kd_kategori'];
	
	
	if ($barangData['file_gambar']=="") {
		$fileGambar = "noimage.jpg";
	}
	else {
		$fileGambar	= $barangData['file_gambar'];
	}
?>
           
			<div id="productView" class="span6">
			<img src="assets/products/<?php echo $barangData['file_gambar']; ?>" alt=""/>
			</div>
			<div class="span4">
				<h3>Nuevo | S/.<?php echo format_angka($barangData['harga_jual']); ?></h3>				
				<hr class="soft"/>
				<h5>Nombre de Producto </h5>
				<p>
				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s ...
				</p>
				<a class="btn btn-small pull-right" href="product_details.html">Ver Detalles</a>
				<br class="clr"/>
			</div>
			<div class="span6 alignR">
			<form class="form-horizontal qtyFrm">
			<h3> $222.00</h3>
	
			  <a href="?open=Barang-Beli&Kode=<?php echo $KodeBarang; ?>" class="btn btn-large"><i class=" icon-shopping-cart"></i> Agregar a Carrito</a>
			  <a href="product_details.html" class="btn btn-large">VER</a>
				</form>
			</div>
    </div>
	<?php $nomor; } ?>
</div>
        <!--
<a href="compair.html" class="btn btn-large pull-right">Compair Product</a>
	<div class="pagination">
		<ul>
		<li><a href="#">&lsaquo;</a></li>
		<li><a href="#">1</a></li>
		<li><a href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">4</a></li>
		<li><a href="#">...</a></li>
		<li><a href="#">&rsaquo;</a></li>
		</ul>
	</div>
-->
<br class="clr"/>
</div>
</div>
  </body>
</html>