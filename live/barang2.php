<?php
error_reporting();
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
# Nomor Halaman (Paging)
$baris = 5;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql = "SELECT * FROM barang";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$maks	 = ceil($jml/$baris);
$mulai	= $baris * ($hal-1);

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>ESPECIAL</title>
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
<?php include_once "slide.php"; ?>
<div class="row">
	<div class="span9">
	
<br class="clr"/>
<div>
<div class="tab-pane">

<!--<ul class="thumbnails">-->
               <?php                                
$barangSql =mysql_query( "SELECT barang.*,  kategori.nm_kategori FROM barang 
			LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori 
			ORDER BY barang.kd_barang DESC LIMIT $mulai, $baris");
//$barangQry = mysql_query($barangSql, $koneksidb) or die ("Gagal Query".mysql_error()); 
$nomor = 0;
while ($barangData = mysql_fetch_array($barangSql)) 
{
	$KodeBarang = $barangData['kd_barang'];
	$KodeKategori = $barangData['kd_kategori'];
	$stok = $barangData['stok'];
	$nombre = $barangData['nm_barang'];
	$codigo = $barangData['kd_barang'];
	$marca = $barangData['brand'];
	$precio = $barangData['harga_jual'];
	
	if ($barangData['file_gambar']=="") 
	{
		$fileGambar = "noimage.jpg";
	}
	else 
	{
		$fileGambar	= $barangData['file_gambar'];
	}
?>
	<div class="row">	  
		<div id="productView" class="span2">
			<img src="assets/products/<?php echo $barangData['file_gambar']; ?>" alt=""/>
		</div>
		<div class="span4">
			<h3>Nuevo | Disponible</h3>				
			<hr class="soft"/>
			<h4><?php echo $barangData['nm_barang']; ?> </h4>
			<p>
				<?php //echo $barangData['keterangan']; ?>
				<?php //echo substr($barangData['keterangan'],0,200); ?>
				<?php $texto = substr($barangData['keterangan'], 0, 200)."..."; 
				echo"$texto";  ?>
			</p>

			<br class="clr"/>
		</div>
		<div class="span3 alignR">
			<form class="form-horizontal qtyFrm">
			<h3>S/.<?php echo format_angka($barangData['harga_jual']); ?></h3>
			<br/>
			  <a href="?open=Barang-Beli&Kode=<?php echo $KodeBarang; ?>&stok=<?php echo $stok; ?>" class="btn btn-primary btn-large"><i class=" icon-shopping-cart"></i> Agregar a Carrito</a>
			  <a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>" class="btn btn-large">VER</a>
			</form>
		</div>
	</div>
	<!--<li class="span3">
					<div class="thumbnail">
						<a href="?open=Barang-Lihat&Kode=<?php echo $codigo; ?>"><img src="assets/products/<?php echo $fileGambar; ?>" alt=""/></a>
						<div class="caption">
						  <h5><?php echo $nombre; ?></h5>
						  <p>
							<?php echo $marca; ?>
						  </p>
						  <h4><a class="btn btn-large" href="?open=Barang-Lihat&Kode=<?php echo $codigo; ?>">VER</a> <span class="pull-right">S/.<?php echo format_angka($precio); ?></span></h4>
						</div>
					  </div>
					</li>-->
	<hr class="soft"/>
	<?php 
	
	$nomor++; 
	
} ?>

<!--</ul>-->
</div>
	<div class="pagination ">
		  <nav>
  <ul class="pager badge-info">
   <li> <?php
	for ($h = 1; $h <= $maks; $h++) {
			echo " <strong> <a  href='?hal=$h'>$h</a></strong> ";
	}
	?></li>
  </ul>
</nav>
	</div>
<br class="clr"/>
    <hr>
</div>
    </div>
</div>
</div>
<!-- Footer ------------------------------------------------------ -->
  </body>
</html>