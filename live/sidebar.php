
<div id="sidebar" class="span3">
		<div class="well well-small">Categorias</div>
		<ul id="sideManu" class="nav nav-tabs nav-stacked">
				<?php
include_once "library/inc.connection.php";

//MENU KATEGORI KONEKSI KE DALAM DATABASE
$mySql = "SELECT * FROM kategori ORDER BY nm_kategori";
		  $myQry = mysql_query($mySql, $koneksidb) or die ("Query salah : ".mysql_error());
		
		  while($myData = mysql_fetch_array($myQry)) {
			$Kode=$myData['kd_kategori'];
?>
			<li class="subMenu"><strong><?php echo  "<a class=thumbnail href=?open=Barang-Kategori&Kode=$Kode>$myData[nm_kategori]</a>"; ?></strong>
			</li>
		  <?php } ?>
		  </ul>
		
		<ul>	
            <?php
            include_once "library/inc.connection.php";

            //DAFTAR PRODUK 
            $myProduk = "SELECT barang.*,  kategori.nm_kategori FROM barang 
			LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori 
			ORDER BY barang.kd_barang DESC LIMIT 2";
            $qryProduk = mysql_query($myProduk, $koneksidb) or die("Gagal Query                     Produk".mysql_error());
            while ($barangData =mysql_fetch_array($qryProduk)){
                $KodeProduk=$barangData['kd_barang'];
				$stok = $barangData['stok'];
				$nombre = $barangData['nm_barang'];
				$categoria = $barangData['nm_kategori'];
				$precio = $barangData['harga_jual'];
                if ($barangData['file_gambar']=="") {
                    $fileGambar = "noimage.jpg";
                }
                else {
                    $fileGambar	= $barangData['file_gambar'];
                }
                
            ?>
            <div class="thumbnail row-fluid active">
            <div id="myCarousel1" class="carousel slide">
			<img src="assets/products/<?php echo $barangData['file_gambar'];?>" alt="">
            
			<div class="caption ">
                 <a href="#" class="tag" src="assets/products/new.png"></a>
			  <h5><?php echo $nombre; ?></h5>
						  <p>
							<?php echo $categoria; ?>
						  </p>
			  <h4><a class="btn btn-large" href="?open=Barang-Lihat&Kode=<?php echo $KodeProduk; ?>">VER</a> <span class="pull-right">S/.<?php echo format_angka($precio); ?></span></h4>
						
		  </div> 
						
	  
                 <?php } ?>
                 
            </div>
        </div>
            <!--<div class="thumbnail">
			<img src="assets/products/1.jpg" alt="">
			<div class="caption">
			  <h5>&nbsp;</h5>
			  <p>
				&nbsp;
			  </p>
			  <!----<h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">$222.00</span></h4>
			</div>
		  </div>
            </div>-->
             
		
		</ul>
<br/>