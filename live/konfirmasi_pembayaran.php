<?php

include_once "inc.session.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";


// data Kode di URL harus ada
/**
if(isset($_GET['Kode'])) {
    // Membaca Kode (No Pemesanan)
    $Kode   = $_GET['Kode'];

    // Sql membaca data Pemesanan utama sesuai Kode yang dipilih
    $mySql  = "SELECT pemesanan.*, pelanggan.nm_pelanggan, kabkot.nama_kabkot, kec.nama_kec, prov.*
              FROM pemesanan
              LEFT JOIN pelanggan ON pemesanan.kd_pelanggan= pelanggan.kd_pelanggan
              LEFT JOIN prov ON pemesanan.id_prov=prov.id_prov
              LEFT JOIN kabkot ON pemesanan.id_kabkot=kabkot.id_kabkot
              LEFT JOIN kec ON pemesanan.id_kec=kec.id_kec
              WHERE pemesanan.kd_pelanggan='$KodePelanggan' AND  pemesanan.nm_pelanggan='$NamaPelanggan' AND pemesanan.no_pemesanan ='$Kode'";
    $myQry = mysql_query($mySql, $koneksidb) or die ("Gagal query");
    $myData= mysql_fetch_array($myQry);
}
**/
$KodePelanggan = $_SESSION['SES_PELANGGAN'];
$NamaPelanggan = $_SESSION['SES_USERNAME'];
$totalBarang=0;
#BACA VARIABLE
if (isset($_POST['btnKonfirmasi'])) {
   $txtNama =$_POST ['txtNama'];
   $txtNama = str_replace("'", "&acute;", $txtNama);
   
   $txtNoPemesanan =$_POST['txtKode'];
   $txtNoPemesanan = str_replace("'", "&acute;", $txtNoPemesanan);

    $txtJumlahTransfer       = $_POST['txtJumlahTransfer'];

    $txtJumlahTransfer      = str_replace(".","",$txtJumlahTransfer); // Menghilangkan karakter titik (10.000 jadi 10000)
    $txtJumlahTransfer      = str_replace(",","",$txtJumlahTransfer); // Menghilangkan karakter koma (10,000 jadi 10000)
    $txtJumlahTransfer      = str_replace(" ","",$txtJumlahTransfer); // Menghilangkan karakter kosong (10 000 jadi 10000)

    $txtKeterangan =$_POST['txtKeterangan'];
    $txtKeterangan  = str_replace("'","&acute;",$txtKeterangan);

    $cmbBank =$_POST['cmbBank'];

    $pesanError=array();

    $txtNamaLama = $_POST['txtNamaLama'];

    if (count($pesanError)>=1 ){
        echo "<div class='pesanError' align='left'>";
        echo "<img src='images/attention.png'> <br><hr>";
            $noPesan=0;
            foreach ($pesanError as $indeks=>$pesan_tampil) {
            $noPesan++;
                echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
            }
        echo "<br>";
    }
    else {
$tanggal    = date('Y-m-d');

        // Simpan data ke database
        $Kode = $_POST['txtKode'];
		
        $mySql = "INSERT INTO konfirmasi (no_pemesanan, nm_pelanggan, jumlah_transfer, keterangan, nm_bank, tanggal)
                  VALUES ('$txtNoPemesanan', '$txtNama', '$txtJumlahTransfer', '$txtKeterangan','$cmbBank', '$tanggal')";
        $myQry  = mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());

        echo "<b> CONFIRMACION ENVIADA CORRECTAMENTE</b>";
        
        exit;
    }
}
$Kode         = isset($_GET['Kode']) ? $_GET['Kode'] : $_POST['txtKode'];
$mySql        = "SELECT pemesanan.*, pelanggan.nm_pelanggan, pemesanan_item.*
            FROM pemesanan
            LEFT JOIN pelanggan ON pemesanan.kd_pelanggan= pelanggan.kd_pelanggan
            LEFT JOIN pemesanan_item ON pemesanan_item.no_pemesanan = pemesanan.no_pemesanan
			WHERE pemesanan.kd_pelanggan='$KodePelanggan' AND  pemesanan.nm_pelanggan='$NamaPelanggan' AND pemesanan.no_pemesanan ='$Kode'";
$myQry            = mysql_query($mySql, $koneksidb) or die("Query Ambil Data Salah".mysql_error());
$myData          = mysql_fetch_array($myQry);


$dataNoPemesanan    = $myData['no_pemesanan'];
$dataNama           = isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nm_pelanggan'];
$dataBank           = isset($_POST['cmbBank']) ? $_POST['cmbBank'] : $myData['payment'];

$digitHp  = substr($myData['no_telepon'],-2); // ambil 3 digit terakhir no HP
$dataJumlahTransfer = $myData['harga'] + $digitHp;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Tienda Online - Platea21</title>
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
  <div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.php">Inicio</a> <span class="divider">/</span></li>
		<li class="active"> Confirmacion de Pago</li>
    </ul>
      <h3><img src="images/atm.gif" width="70" height="41"><font color="#FF9933">Confirmacion de Pago</font></h3>

    <hr class="soft" />
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" target="_self">
    <table class="table table-bordered" border="1">
            <thead>
                <tr>
                    <th colspan="3" bgcolor="#FF9933" valign="center"><strong>Por favor, para confirmar su pago:</strong></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Nro. Reserva</strong></td>
                    <td><strong>:</strong></td>
                    <td><input name="txtKode" type="text" width="20" placeholder="Nro Reserva" value="<?php echo $dataNoPemesanan; ?>">
                         <input name="txtKode" type="hidden" value="<?php echo $dataNoPemesanan; ?>" /></td>
                
                </tr>
                <tr>
                    <td><strong>Nombre de Cliente</strong></td>
                    <td width="2%"><strong>:</strong></td>
                    <td><input name="txtNama" type="text" width="30" placeholder="Nombre cliente" value="<?php echo $dataNama; ?>" >
                        <input name="txtNamaLama" type="hidden" value="<?php echo $myData['nm_pelanggan']; ?>"></td>
                </tr>
                <tr>
                    <td><strong>Notas</strong></td>
                    <td><strong>:</strong></td>
                    <td>		<div class="controls">
			  <textarea name="txtKeterangan"  id="aditionalInfo" cols="26" rows="3" placeholder="Notas" required value=""></textarea>
			</div></td>
                </tr>
                <tr>
                    <td><strong>Numero Operacion Bancaria</strong></td>
                    <td><strong>:</strong></td>
                    <td>
					<input id="namaBank" name="cmbBank" type="text" width="15" placeholder="Numero Operacion" value="">
                    <!--<div class="controls">
                    <select class="span2" id="namaBank" name="cmbBank" >
                    <option value="BLANK">-Seleccione Pago-</option>
                        <?php
                        //MENGAMBIL DATA BANK
                            
                        ?>
                    </select>
                    </div>-->
                    </td>
                </tr>
                <tr>
                    <td><strong>Numero de Transferencia</strong></td>
                    <td><strong>:</strong></td>
                    <td><input name="txtJumlahTransfer" type="text" width="15" placeholder="Numero Tranferencia" value="<?php echo $dataJumlahTransfer; ?>"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input class="btn btn-large" type="submit" name="btnKonfirmasi" Value="Confirmar Pago"></td>
                </tr>

            </tbody>
    </table>


      </div>
   </form>

   <div class="span9">
        <div class="alert alert-info span8">
        
        <strong>Transferir su dinero en efectivo. Realizar la confirmación después de transferir con éxito los pagos a una de las cuentas de abajo.</strong> 
     </div>
        <table class="table table-bordered" border="1">
            <thead>
                <tr>
                    <th colspan="5" bgcolor="#FF9933"><strong>VIA BCP</strong></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" width="25%"><img src="images/BCP.jpg"></td>
                    <td  width="2%">:</td>
                    <td>
                    <p>
                        <b>
                    BANCO          : BCP<br/>
                    Nro Cuenta     : 540-24103460-0-53<br>
                    Beneficiario   : Julio Cesar B.<br>
                    <br><br><br>
                    </p></b>
                    </td>

                </tr>
             <!--<tr>
                    <td colspan="3"><img src="images/mandiri2.png"></td>
                    <td  width="2%">:</td>
                    <td>
                    <p>
                        <b>
                    BANK          : Mandiri<br/>
                    A/C           :166 0000 4902 43<br>
                    A/N           : PT. RADJA BANGUNAN<br>
                    CABANG        : MATRAMAN, JAKARTA<br><br><br>
                    </p></b>
                    </td>

                </tr>-->


            </tbody>
       </table>
   </div>
</div>

</body>
</html>