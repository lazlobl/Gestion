<?php
error_reporting();
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

#MEMBACA FILTER kategori
if (isset($_GET['Kode'])) {
    //MEMBACA KODE filter
    $Kode  =$_GET['Kode'];
        if (trim($_GET['Kode'])=="") {
            $filterSQL= " ";
        }
        else {
            $filterSQL  = "WHERE barang.kd_kategori='$Kode'";
        }
    }
# Nomor Halaman (Paging)
$baris = 9;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql = "SELECT * from barang  ORDER BY kd_barang DESC";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$maks	 = ceil($jml/$baris);
$mulai	= $baris * ($hal-1);

//membaca info data kategori

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Toko  Online Alat bangunan Terlengkap Di Indonesia">
    <meta name="author" content="Herry Prasetyo Noow Wibowo">


    <!-- Bootstrap style -->
    <link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
    <!-- Bootstrap style responsive -->
    <link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
    <link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">
    <!-- Google-code-prettify -->
    <link href="themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
    <!-- fav and touch icons -->
	
<!-- Start WOWSlider.com HEAD section -->
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
<script type="text/javascript" src="engine1/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->
    <link href="style.css" rel="stylesheet"/>
	<link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet"/>
	
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="themes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="themes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="themes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="themes/images/ico/apple-touch-icon-57-precomposed.png">
    <style type="text/css" id="enject"></style>
</head>
<body>
<div>

    <?php include "slide.php"; ?>
		  <!-- Feature ==================== ---->
	
<h4>Latest Products </h4>
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
<ul class="thumbnails  ">
    <li id="gallery" class="span3">
        <div class="thumbnail">
            <a  class="thumbnail" href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>"><img src="assets/products/<?php echo $barangData['file_gambar']; ?>" alt=""/></a>
            <div class="caption">
                <h5><a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>"><?php echo $barangData['nm_barang']; ?></a></h5>
                <p>
                    <b>Rp.<?php echo format_angka($barangData['harga_jual']); ?></b>
                </p>

                <h4 style="text-align:center"><a class="btn" href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> </h4>
            </div> 
   
        </div>
     
    </li>
   <?php  $nomor++;} ?>
</ul>
</div>
<nav>

  <nav>
  <ul class="pager ">
   <li> <?php
	for ($h = 1; $h <= $maks; $h++) {
			echo " <strong> <a  href='?hal=$h'>$h</a></strong> ";
	}
	?></li>
  </ul>
</nav>
   

</body>
</html>