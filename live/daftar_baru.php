<?php

/*
**date 		: 27/04/2016
**author 	: Herry Prasetyo Noor Wibowo
**time 		: 2:21pm 

*/
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

//FUNCTION 
function randomcode($len="10"){
	global $pass;
	global $lchar;

$code= NULL;
for($i=0; $i<$len; $i++){
		$char=chr(rand(48,122));
		while (!ereg("[a-zA-Z0-9]", $char)) {
			if($char == $lchar) {continue;}
			$char =chr(rand(48,90));
		}
		$pass .=$char;
		$lchar=$char;
	}
	return $pass;
}

//JIKA PENYIMPANAN SUKSES
if (isset($_GET['Aksi']) and $_GET['Aksi']=="Sukses") {
	echo "<br><br><center><b>BIENVENIDOS,POR FAVOR REGISTRESE Y REALIZE LA ACTIVACIÓN EN SU CORREO ELECTRÓNICO</b>";
}



//membuat validasi pada form
$error_tuh="";
if (isset($_POST['btnRegister'])) {
$pesanError = array();
    //MEMBERIKAN VARIABEL UNTUK SEMUA FORM
    $txtNamaLengkap			= $_POST['txtNamaLengkap'];
    $txtNamaLengkap			= str_replace("'", "&acute;", $txtNamaLengkap);

    $txtlastName			= $_POST['txtlastName'];
    $txtlastName			= str_replace("'", "&acute;", $txtlastName);

    $txtUsername			= $_POST['txtUsername'];
    $cmbGender				= $_POST['cmbGender'];
    $txtAlamat 				= $_POST['txtAlamat'];	
    $txtMobile				= $_POST['txtMobile'];
    $kec					= $_POST['kec'];
    $propinsi   			= $_POST['propinsi'];
    $kota	      			=$_POST	['kota'];
    $txtPhone				=$_POST['txtPhone'];
    $txtPassword 			= $_POST['txtPassword'];
    //$txtKodepos				=$_POST['txtKodepos'];
	$txtKodepos				="00051";
    $txtEmail				=$_POST['txtEmail'];
    


   
//BACA VARIABEL form
    $txtNamaLengkap = htmlspecialchars(stripslashes(trim($_POST['txtNamaLengkap'])));
   if ($txtNamaLengkap == "") {
   	$error_tuh = "Porfavor, Complete el campo Nombre";
   }else {

   }
	

//VALIDASI USERNAME, Tidak boleh ada yang kembar
	$sqlCek= "SELECT * FROM pelanggan WHERE username ='$txtUsername' AND email='$txtEmail'";
	$sqlQuery = mysql_query($sqlCek,$koneksidb)or die("Gagal Query".mysql_error());
	$adaCek	=mysql_num_rows($sqlQuery);
	if ($adaCek >=1) {
		$pesanError[]= "ERROR!!! Usuario <b>$txtUsername</b> Existente, intente con otro nombre";
	}


# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		$subjek ="Codigo de Activacion";
$kodeAktivasi= randomcode();
$Kepada = $_POST[txtUsername];
$link=
"http://radjabangunan.net84.net/?open=Aktivasi&code=$kodeAktivasi";
$pesan="Hola $_POST[txtUsername],
Gracias por unirse a Radja Edificio Online. Disfrute de la experiencia de compras en línea con nosotros es seguro y conveniente, así de rápido.
Puede ponerse en contacto con nosotros si tiene alguna pregunta. Estamos dispuestos a ayudarle.
Por favor, haga clic en este enlace para activar su cuenta. 
$link


Saludos Cordiales, 

Platea21

";
$from="from : gorchor@gmail.com";
		#script untuk menyimpan data kedalam database
		
		$kodeBaru = buatkode("pelanggan","P");
		$tanggal	=date('Y-m-d');
        mail($txtEmail, $subjek,$pesan,$from);
		$mySql ="INSERT INTO pelanggan (kd_pelanggan,nm_pelanggan,nm_belakang,kelamin,email,no_telepon,mobile,alamat,id_prov,id_kabkot,id_kec,kode_pos,username,password,status,kode_aktivasi,tgl_daftar) 
			VALUES('$kodeBaru','$txtNamaLengkap','$txtlastName','$cmbGender','$txtEmail','$txtPhone','$txtMobile','$txtAlamat','$propinsi','$kota','$kec','$txtKodepos','$txtUsername',MD5('$txtPassword'),'N','$kodeAktivasi','$tanggal')";
		$myQry = mysql_query($mySql,$koneksidb) or die("gagal simpan".mysql_error());
		if ($myQry) {
			# code...
			echo "<meta http-equiv='refresh' content='0; url=?open=SuccessRegistration'>";
		}
		exit;
	}

}
#MEMBACA VARIABLE FORM
$dataNama			=isset($_POST['txtNamaLengkap']) ? $_POST['txtNamaLengkap'] :  '';
$dataLast			= isset($_POST['txtlastName']) ? $_POST['txtlastName'] : '' ;
$dataKelamin		=isset($_POST['cmbGender']) ?  $_POST['cmbGender'] :'' ;
$dataEmail			=isset($_POST['txtEmail']) ? $_POST['txtEmail'] :'';
$dataPhone 			=isset($_POST['txtPhone']) ? $_POST['txtPhone'] :'';
$dataKelamin		=isset($_POST['cmbGender']) ? $_POST['cmbGender'] : '';
$dataAlamat			=isset($_POST['Alamat']) ? $_POST['Alamat']:'';
$dataAlamat2		=isset($_POST['txtAlamat2']) ? $_POST['txtAlamat2'] :''; 
$dataProvinsi		=isset($_POST['cmbProvinsi']) ? $_POST['cmbProvinsi'] :'';
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
	
	<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=propinsi>
  $("#propinsi").change(function(){
    var propinsi = $("#propinsi").val();
    $.ajax({
        url: "ambilkota.php",
        data: "propinsi="+propinsi,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#kota").html(msg);
        }
    });
  });
  $("#kota").change(function(){
    var kota = $("#kota").val();
    $.ajax({
        url: "ambilkecamatan.php",
        data: "kota="+kota,
        cache: false,
        success: function(msg){
            $("#kec").html(msg);
        }
    });
  });
});

</script>

  </head>
<body>
	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.php">Inicio</a> <span class="divider">/</span></li>
		<li class="active">Crear Cuenta: Nuevo Cliente</li>
    </ul>
	<h3> Registrar Nueva Cuenta </h3>
	<hr class="soft"/>
	<div class="well">
	<div class="alert alert-info">
		
		<strong>Bienvenidos</strong>  <font face="comic sans">En Platea21 en línea, servicios de comercio electrónico.
Estamos dispuestos a servirle para conseguir una experiencia de compra agradable de productos electronicos y otras categorías.
Para simplificar el proceso de pedido, debe registrarse en el siguiente formulario.</font></div>
	 <div class="alert alert-block alert-error fade in">
		
		<strong>  Es importante recordar</strong> <font face="comic sans">Por favor, rellene los datos para el nombre, la dirección y el contacto puede contactarse forma más completa posible para que podamos procesar envíos.</font>
	 
	 </div>
	<form class="form-horizontal" name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" target="_self" >
		<h3>Datos Personales</h3>
		<div class="control-group">
		
			<label class="control-label" for="inputFname">Nombre <sup>*</sup></label>
			<div class="controls">
				<div style="color:red"><?php echo $error_tuh; ?></div>
			  <input type="text" id="txtNamaLengkap"  name="txtNamaLengkap"  value="<?php echo $dataNama; ?>"   placeholder="Nombre" class="form-control" required >
			
		 </div>
		 </div>
            
		 <div class="control-group">
            <label class="control-label" for="inputFnameLast">Apellidos<sup>*</sup></label>
             <div class="controls">
                 <input type="text" id="txtlastName" name="txtlastName" value="<?php echo $dataLast; ?>" placeholder="Apellidos" required>
             </div>
        </div>
            
		 	
        <div class="control-group">
            <label class="control-label" for="dob">Género<sup>*</sup></label>
            <div class="controls">
                <select class="span2" id="jeniskelamin" name="cmbGender" required>
                    <option value="KOSONG">-Género-</option>
                  <?php
                  $pilihan  = array("Masculino","Femenino");
                  	foreach ($pilihan as $nilai) {
                  		if ($nilai==$dataKelamin) {
                  			$cek ="selected";
                  	}else { $cek = "";}
                  	echo "<option value='$nilai' $cek>$nilai</option>";
                  }
                  ?>
                </select>
                <?php echo isset($pesanError['cmbGender']) ? $pesanError['cmbGender'] : '';?>
            </div>
        </div>
		
		<div class="control-group">
			<label class="control-label" for="adress">Dirección<sup>*</sup></label>
			<div class="controls">
			  <input type="text" name="txtAlamat"   id="txtAlamat"  value="<?php echo $dataAlamat; ?>" placeholder="Dirección"/ required> <span>Domicilio,Calle,barrio,Dirección de la empresa, etc</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="city" >Departamento<sup>*</sup></label>
			<div class="controls">
				<select type="text" id="propinsi" name="propinsi" required>
					<option value="BLANK">-Seleccionar Departamento-</option>
					<?php
						//MENGAMBIL NAMA PROVINSI YANG DI DATABASE
						$propinsi =mysql_query("SELECT * FROM prov ORDER BY nama_prov");
						while ($dataProvinsi=mysql_fetch_array($propinsi)) {
							echo "<option value=\"$dataProvinsi[id_prov]\">$dataProvinsi[nama_prov]</option>\n";
						}
					?>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="state" >Ciudad / Provincia<sup>*</sup></label>
			<div class="controls">
			  <select type="text" id="kota"  name="kota">
				<option value="BLANK">-Seleccionar Ciudad / Provincia-</option>
				<?php
				//mengambil nama-nama provinsi yang ada di database
				$kota=mysql_query("SELECT * FROM kabkot ORDER BY nama_kabkot ");
				while ($kab=mysql_fetch_array($kota)) {
					echo "<option value=\"$kota[id_kabkot]\">$kota[nama_kabkot]</option>\n";
				}
				?>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="country">Distrito<sup>*</sup></label>
			<div class="controls">
			  <select type="text" id="kec" name="kec" >
				<option value="BLANK">-Seleccionar Distrito-</option>
				
			</select>
			</div>
		</div>
        <!--<div class="control-group">
            <label class="control-label" for="postcode">Codigo Postal<sup>*</sup></label>
            <div class="controls">
                <input type="text" name="txtKodepos" id="postcode"  placeholder="Codigo Postal" required>
            </div>
        </div>-->
	
		<div class="control-group">
			<label class="control-label" for="phone">Celular <sup>*</sup></label>
			<div class="controls">
			  <input type="text"  name="txtPhone" id="phone" placeholder="Celular" required> <span>Usted debe registrarse al menos un número de Teléfono o Celular</span>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="mobile">Telefono Fijo<sup>*</sup></label>
			<div class="controls">
			  <input type="text"  name="txtMobile"  id="mobile" placeholder="Telefono" required />
			</div>
		</div>

        <h3>Datos para Inicio de Sesión</h3>
        <div class="control-group">
        	<label class="control-label" for="inputUsername">Nombre de Usuario<sup>*</sup></label>
        	<div class="controls">
        		<input type="text" name="txtUsername"  id="inputUsername" placeholder="Usuario" required>
        	</div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Email <sup>*</sup></label>
            <div class="controls">
                <input type="text" name="txtEmail" id="inputEmail"  placeholder="Correo Electronico" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPassword">Contraseña <sup>*</sup></label>
            <div class="controls">
                <input type="password" name="txtPassword"  id="inputPassword" placeholder="Contraseña" required>
            </div>
        </div>
       <div >
            <label class="control-label" for="inputPassword">&nbsp; </label>
            <div class="controls">
                &nbsp;
            </div>
        </div>
         <div>
            <label class="control-label" for="inputPassword">&nbsp; </label>
            <div class="controls">
                &nbsp;
                           </div>
        </div>
         <div >
            <label class="control-label" for="inputPassword">&nbsp;</label>
            <div class="controls">
               
            </div>
        </div>
         <div >
            <label class="control-label" for="inputPassword">&nbsp;</label>
            <div class="controls">
                &nbsp;
            </div>
        </div>
        <p><sup>(*)</sup>Campos Obligatorios</p>
	
	<div class="control-group">
			<div class="controls">
				<input type="hidden" name="email_create" value="1">
				<input type="hidden" name="is_new_customer" value="1">
				<input class="btn btn-large" type="submit" name="btnRegister" value="Registrarse" />
			</div>
		</div>		
	</form>
</div>

</div>
</div>

</div>
  </body>
</html>