<?php
include_once "library/inc.connection.php";

if (isset($_GET['Kode'])) {
	$Kode = $_GET['Kode'];

	//MENAMPILKAN DATA SESUAI KODE url
	$lihatSql = "SELECT barang.*,kategori.nm_kategori FROM barang LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori WHERE barang.kd_barang='$Kode'";
	$lihatQry= mysql_query($lihatSql, $koneksidb) or die("Datos No Encontrados".mysql_error());
	$no=0;
	$lihatData =mysql_fetch_array($lihatQry);
	$no++;
	$KodeBarang = $lihatData['kd_barang'];
	$KodeKategori=$lihatData['kd_kategori'];
	$stok=$lihatData['stok'];
	//membaca gambar utama
	if ($lihatData['file_gambar']=="") {
		$fileGambar = "noimage.jpg";
	}
	else {
		$fileGambar = $lihatData['file_gambar'];
	}
}

else {
	//JIKA VARIABEL KODE TIDAK ADA DI URL
	echo "Producto no encontrado";

	//refresh
	echo "<meta http-equiv='refresh' content='2; url=index.php'>";
	exit;
}
?>
<!DOCTYPE html>
<html lang="es">
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


	<script type=”text/javascript”>
	var s5_taf_parent = window.location;
	function popup_print(){
	window.open(‘barang_lihat.php’,’page’,’toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=750,height=600,left=50,top=50,titlebar=yes’)
	}
	</script>
  </head>
<body>
  <!-- Navbar
    ================================================== -->

<!-- ======================================================================================================================== -->

<!-- ==================================================Header End====================================================================== -->
	<div class="span9">
    <ul class="breadcrumb">
    <li><a href="index.html">Inicio</a> <span class="divider">/</span></li>
    <li><a href="products.html">Productos</a> <span class="divider">/</span></li>
    <li class="active">Detalles de Producto</li>
    </ul>
	<div class="row">
			<div id="gallery" class="span3">
			<style>
			#jquery-overlay {position: absolute;top: 0;left: 0;z-index: 90;width: 100%;height: 500px;}
			#jquery-lightbox {position: absolute;top: 0;left: 0;width: 100%;z-index: 100;text-align: center;line-height: 0;}
			#jquery-lightbox a img { border: none; }#lightbox-container-image-box {position: relative;background-color: #fff;width: 250px;height: 250px;margin: 0 auto;}
			#lightbox-container-image { padding: 10px; }#lightbox-loading {position: absolute;top: 40%;left: 0%;height: 25%;width: 100%;text-align: center;line-height: 0;}
			#lightbox-nav {	position: absolute;top: 0;left: 0;height: 100%;width: 100%;z-index: 10;}#lightbox-container-image-box > #lightbox-nav { left: 0; }#lightbox-nav a { outline: none;}
			#lightbox-nav-btnPrev, #lightbox-nav-btnNext {width: 49%;height: 100%;zoom: 1;display: block;}
			#lightbox-nav-btnPrev { left: 0; float: left;}#lightbox-nav-btnNext { right: 0; float: right;}
			#lightbox-container-image-data-box {font: 10px Verdana, Helvetica, sans-serif;background-color: #fff;margin: 0 auto;line-height: 1.4em;overflow: auto;width: 100%;padding: 0 10px 0;}
			#lightbox-container-image-data {	padding: 0 10px; 	color: #666; }
			#lightbox-container-image-data #lightbox-image-details {width: 70%; float: left; text-align: left; }
			#lightbox-image-details-caption { font-weight: bold; }#lightbox-image-details-currentNumber {display: block; clear: left; padding-bottom: 1.0em;}
			#lightbox-secNav-btnClose {width: 66px; float: right;padding-bottom: 0.7em;	}
			</style>
            <a href="assets/products/<?php echo $lihatData['file_gambar']; ?>" width="100%" title="<?php echo $lihatData['nm_barang']; ?>">
				<img src="assets/products/<?php echo $lihatData['file_gambar']; ?>" width="90%" alt=""/>
            </a>
			<div id="myCarousel" class="moreOptopm carousel slide">
                <div class="carousel-inner">
					<div class="item">
					   <a href="assets/products/large/f3.jpg" > <img width="29%" src="assets/products/large/f3.jpg" alt=""/></a>
					   <a href="assets/products/large/f1.jpg"> <img width="29%" src="assets/products/large/f1.jpg" alt=""/></a>
					   <a href="assets/products/large/f2.jpg"> <img width="29%" src="assets/products/large/f2.jpg" alt=""/></a>
					</div>
                </div>
              <!--
			  <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
			  -->
              </div>

			 <div class="btn-toolbar">
			  <div class="btn-group">

				<span class="btn" onClick="javascript:window.print()" ><i class="icon-print"></i></span>

			  </div>
			</div>
			</div>
			<div class="span6">
				<h3><?php echo $lihatData['nm_barang']; ?>  </h3>
				<small><strong>Categoria : <?php echo $lihatData['nm_kategori']; ?></strong></small>
				<hr class="soft"/>
				<form class="form-horizontal qtyFrm">
				  <div class="control-group">
					<label class="control-label"><span> S/.<?php echo format_angka($lihatData['harga_jual']); ?></span></label>
					<div class="controls">
					<!--<input type="number" class="span1" placeholder="Qty."/>--->
					  <a href="?open=Barang-Beli&Kode=<?php echo $KodeBarang; ?>&stok=<?php echo $stok; ?>" class="btn btn-primary btn-large pull-right"><i class=" icon-shopping-cart"></i> Comprar</a>
					</div>
				  </div>
				</form>

				<hr class="soft"/>
				<h4><font color="red"><?php echo $lihatData['stok']; ?></font> Articulos en Stock</h4>
				<form class="form-horizontal qtyFrm pull-right">

				<!--  <div class="control-group">
					<label class="control-label"><span>Materials</span></label>
					<div class="controls">
					  <select class="span2">
						  <option>Slik</option>
						  <option>Cotton</option>
						  <option>Mix</option>
						  <option>Ruby</option>
						</select>
					</div>
				  </div> -->
				</form>

				<p>
				&nbsp;

				</p>

				<br class="clr"/>
			<a name="detail"></a>

			</div>

			<div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab">Detalles de Producto</a></li>

            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="home">
			  <h4>Informacion de Producto</h4>
                <table class="table table-bordered" cellspacing="0" border="1">
				<tbody>
				<tr class="techSpecRow" bgcolor="#998706"><th colspan="2">Detalles de Producto</th></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Marca: </td><td class="techSpecTD2"><?php echo $lihatData['brand']; ?></td></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Modelo:</td><td class="techSpecTD2"><?php echo $lihatData['model']; ?></td></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Publicado:</td><td class="techSpecTD2"> <?php echo $lihatData['realeased']; ?></td></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Velocidad/Ratio:</td><td class="techSpecTD2"> <?php echo $lihatData['dimension']; ?></td></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Otros:</td><td class="techSpecTD2"><?php echo $lihatData['display']; ?></td></tr>
				</tbody>
				</table>

				<h5>Caracteristicas</h5>
				<p>
				<?php echo $lihatData['keterangan']; ?>
				</p>


              </div>
	<?php //echo "que demonios"; ?>
	<div class="tab-pane fade active in" id="profile">
		<div id="myTab" class="pull-right">
		 <!--<a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>-->
		 <a href="#blockView" data-toggle="tab"><span class="btn btn-large active in"><i class="icon-th-large icon-white"></i></span></a>
		</div>
		<br class="clr"/>
		<hr class="soft"/>
		<div class="tab-content">
			<!--<div class="tab-pane" id="listView">
				<div class="row">
					<div id="productView" class="span2">
						<img src="assets/products/B0052.10015364-Essential-8W.png" alt=""/>
					</div>
					<div class="span4">
						<h3>Nuevo | Disponible</h3>
						<hr class="soft"/>
						<h5>Nombre Producto </h5>
						<p>
						Hoy en día la industria de la ropa interior es uno de los spheres.We negocio más exitoso siempre estar en contacto con las últimas tendencias de la moda -
						es por eso que nuestros productos son tan populares ..
						</p>
						<a class="btn btn-small pull-right" href="product_details.html">Ver Detalles</a>
						<br class="clr"/>
					</div>
					<div class="span3 alignR">
					<form class="form-horizontal qtyFrm">
					<h3> $222.00</h3>
					<label class="checkbox">
						<input type="checkbox">  Comparar Productos
					</label><br/>
					<div class="btn-group">
					  <a href="product_details.html" class="btn btn-large"><i class=" icon-shopping-cart"></i> Agregar al carrito</a>
					  <a href="product_details.html" class="btn btn-large">VER</a>
					 </div>
						</form>
					</div>
			</div>
			<hr class="soft"/>
			<div class="row">
					<div id="productView" class="span2">
					<img src="assets/products/4.jpg" alt=""/>
					</div>
					<div class="span4">
						<h3>Nuevo | Disponible</h3>
						<hr class="soft"/>
						<h5>Nombre Producto </h5>
						<p>
						Hoy en día la industria de la ropa interior es uno de los spheres.We negocio más exitoso siempre estar en contacto con las últimas tendencias de la moda -
es por eso que nuestros productos son tan populares ..
						</p>
						<a class="btn btn-small pull-right" href="product_details.html">View Details</a>
						<br class="clr"/>
					</div>
					<div class="span3 alignR">
						<form class="form-horizontal qtyFrm">
						<h3> $222.00</h3>
						<label class="checkbox">
						<input type="checkbox">  Comparar Productos
						</label><br/>
						<div class="btn-group">
						<a href="product_details.html" class="btn btn-large"><i class=" icon-shopping-cart"></i> Agregar al Carrito</a>
						<a href="product_details.html" class="btn btn-large">VER</a>
						</div>
						</form>
					</div>
			</div>
			<hr class="soft"/>
				<div class="row">
					<div id="productView" class="span2">
					<img src="assets/products/4.jpg" alt=""/>
					</div>
					<div class="span4">
						<h3>Nuevo | Disponible</h3>
						<hr class="soft"/>
						<h5>Nombre Producto </h5>
						<p>
						Hoy en día la industria de la ropa interior es uno de los spheres.We negocio más exitoso siempre estar en contacto con las últimas tendencias de la moda -
es por eso que nuestros productos son tan populares ..
						</p>
						<a class="btn btn-small pull-right" href="product_details.html">View Details</a>
						<br class="clr"/>
					</div>
					<div class="span3 alignR">
						<form class="form-horizontal qtyFrm">
						<h3> $222.00</h3>
						<label class="checkbox">
						<input type="checkbox">  Comparar Productos
						</label><br/>
						<div class="btn-group">
						<a href="product_details.html" class="btn btn-large"><i class=" icon-shopping-cart"></i> Agregar al Carrito</a>
						<a href="product_details.html" class="btn btn-large">VER</a>
						</div>
						</form>
					</div>
			</div>
			<hr class="soft"/>
		</div>-->
			<div class="tab-pane active" id="blockView">
			<ul class="thumbnails">
			
<!-- Aqui empieza Bucle productos Similares -->
               <?php  
$codKategoria=$lihatData['kd_kategori'];   
$barangSql =mysql_query( "SELECT * FROM barang where kd_kategori='$codKategoria' ORDER BY kd_barang");
//$barangQry = mysql_query($barangSql, $koneksidb) or die ("Gagal Query".mysql_error()); 
$nomor = 0;
while ($barangData = mysql_fetch_array($barangSql)) 
{
	$nombre = $barangData['nm_barang'];
	$codigo = $barangData['kd_barang'];
	$marca = $barangData['brand'];
	$precio = $barangData['harga_jual'];
	$stok = $barangData['stok'];
	if ($barangData['file_gambar']=="") 
	{
		$fileGambar = "noimage.jpg";
	}
	else 
	{
		$fileGambar	= $barangData['file_gambar'];
	}
?>
 
<!-- Aqui Termina Bucle Pruductos relacionados-->			
			
					
				    <li class="span3">
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
					</li>
					<!--<li class="span3">
					  <div class="thumbnail">
						<a href="product_details.html"><img src="assets/products/4.jpg" alt=""/></a>
						<div class="caption">
						  <h5>Manicure &amp; Pedicure</h5>
						  <p>
							Lorem Ipsum is simply dummy text.
						  </p>
						  <h4><a class="btn btn-large" href="product_details.html">VIEW</a> <span class="pull-right">$222.00</span></h4>
						</div>
					  </div>
					</li>
					<li class="span3">
					  <div class="thumbnail">
						<a href="product_details.html"><img src="assets/products/4.jpg" alt=""/></a>
						<div class="caption">
						  <h5>Manicure &amp; Pedicure</h5>
						  <p>
							Lorem Ipsum is simply dummy text.
						  </p>
						   <h4><a class="btn btn-large" href="product_details.html">VIEW</a> <span class="pull-right">$222.00</span></h4>
						</div>
					  </div>
					</li>
					<li class="span3">
					  <div class="thumbnail">
						<a href="product_details.html"><img src="assets/products/4.jpg" alt=""/></a>
						<div class="caption">
						  <h5>Manicure &amp; Pedicure</h5>
						  <p>
							Lorem Ipsum is simply dummy text.
						  </p>
						   <h4><a class="btn btn-large" href="product_details.html">VIEW</a> <span class="pull-right">$222.00</span></h4>
						</div>
					  </div>
					</li>
					<li class="span3">
					  <div class="thumbnail">
						<a href="product_details.html"><img src="assets/products/4.jpg" alt=""/></a>
						<div class="caption">
						  <h5>Manicure &amp; Pedicure</h5>
						  <p>
							Lorem Ipsum is simply dummy text.
						  </p>
						   <h4><a class="btn btn-large" href="product_details.html">VIEW</a> <span class="pull-right">$222.00</span></h4>
						</div>
					  </div>
					</li>
					<li class="span3">
					  <div class="thumbnail">
						<a href="product_details.html"><img src="assets/products/4.jpg" alt=""/></a>
						<div class="caption">
						  <h5>Manicure &amp; Pedicure</h5>
						  <p>
							Lorem Ipsum is simply dummy text.
						  </p>
						   <h4><a class="btn btn-large" href="product_details.html">VER</a> <span class="pull-right">$222.00</span></h4>
						</div>
					  </div>
					</li>-->
<?php 
	
	$nomor++; 
	
} ?>
				  </ul></div>
			<hr class="soft"/>
			</div>
		</div>
				<br class="clr">
		</div>
		<?php //echo "que demonios"; ?>
		</div>
          </div>

	</div>
</div>
</div> <!-- Body wrapper -->

  </body>
</html>