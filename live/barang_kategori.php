<?php
error_reporting();
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

#MEMBACA FILTER kategori
if (isset($_GET['Kode'])) {
	//membaca kode dari URL
	$Kode  	=$_GET['Kode'];

	if (trim($_GET['Kode']) == "") {
		$filterSQL = " ";
	}
	else {
		$filterSQL= "WHERE barang.kd_kategori='$Kode'";
	}

}


# Nomor Halaman (Paging)
$baris = 6;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql = "SELECT * FROM barang $filterSQL ORDER BY kd_barang DESC";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$maks	 = ceil($jml/$baris);
$mulai	= $baris * ($hal-1);

#MEMBACA DATA KATEGORI
$infoSql 	= "SELECT * FROM kategori WHERE kd_kategori='$Kode'";
$infoQry	=mysql_query($infoSql, $koneksidb) or die("Query Salah".mysql_error());
$infoData 	=mysql_fetch_array($infoQry);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SPECIAL</title>
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
	
<br class="clr"/>
<div>
	<div class="tab-pane">
               <?php
                   
                
$barang2Sql =mysql_query( "SELECT barang.*,  kategori.nm_kategori FROM barang 
			LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori  $filterSQL
			ORDER BY barang.kd_barang ASC LIMIT $mulai, $baris");
//$barangQry = mysql_query($barangSql, $koneksidb) or die ("Gagal Query".mysql_error()); 
$nomor = 0;
while ($barang2Data = mysql_fetch_array($barang2Sql)) {
	$nomor++;
	$KodeBarang = $barang2Data['kd_barang'];
	$KodeKategori = $barang2Data['kd_kategori'];
	
	
	if ($barang2Data['file_gambar']=="") {
		$fileGambar = "noimage.jpg";
	}
	else {
		$fileGambar	= $barang2Data['file_gambar'];
	}
?>
		<div class="row">	  
			<div id="productView" class="span2">
			
			<img src="assets/products/<?php echo $barang2Data['file_gambar']; ?>" alt=""/>
			</div>
			<div class="span4">
				<h3><img src="images/new.jpg"> | <?php echo strtoupper($infoData['nm_kategori']); ?></h3>				
				<hr class="soft"/>
				<h5><a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>"><?php echo $barang2Data['nm_barang']; ?></a> </h5>
				<p>
				<?php //echo $barang2Data['keterangan'];
				$texto = substr($barang2Data['keterangan'], 0, 200)."..."; 
				echo"$texto";
				?>
				</p>
		
				<br class="clr"/>
			</div>
			<div class="span3 alignR">
			<form class="form-horizontal qtyFrm">
			<h3>S/.<?php echo format_angka($barang2Data['harga_jual']); ?></h3>
			
			  <a href="?open=Barang-Beli&Kode=<?php echo $KodeBarang; ?>" class="btn btn-large"><i class=" icon-shopping-cart"></i>Agregar al Carrito</a>
			  <a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>" class="btn btn-large">VER</a>
				</form>
			</div>
	</div>
	<hr class="soft"/>
	<?php $nomor++; } ?>
	</div>
	<div class="pagination">
		<ul>
		<li><a href="#">&lsaquo;</a></li>
		<li><?php
		for ($h=1; $h <= $maks; $h++) { 
			echo "<a href='?open=Barang-Kategori&Kode=$KodeKategori&hal=$h'>$h</a>";
		}
				?>
		</li>
	
		<li><a href="#">&rsaquo;</a></li>
		</ul>
	</div>
<br class="clr"/>
</div>
</div>
<!-- Footer ------------------------------------------------------ -->
<hr class="soft">

  </body>
</html>