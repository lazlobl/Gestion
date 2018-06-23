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
<body>
<div class="row">

<div id="sidebar" class="span3"> &nbsp;</div>
		<div class="span3">

			<div class="well well-small">

			<?php
		 if (!isset($_SESSION['SES_PELANGGAN'])) {
		 	//JIKA BELUM LOGIN MAKA FORM LOGIN DITAMPILKAN

		?>
			<form class="form-horizontal loginFrm" action="?open=LoginValidasi"  method="POST">
				<div class="control-group">
				<h5>Iniciar Sesión / Registrar</h5>
						<label><b>Usuario</b></label>
							<input type="text" name="txtUsername" class="span2" id="inputEmail" placeholder="Uuario" required>
						  </div>
						  <div class="control-group">
						  <label><b>Contraseña</b></label>
							<input type="password" name ="txtPassword" class="span2" id="inputPassword" placeholder="Contraseña" required>
						  </div>
						  <div class="control-group">
							<label>
							<a class="btn pull-right" href='?open=DataBaru'>Registrarse</a>
							<button type="submit" class="btn pull-right" name="btnLogin" >Iniciar Sesión</button></label>
							
                          </div>
 </form>
        <?php
}
else {

	//JIKA SUDAH LOGIN, MAKA MENU PELANGGAN DITAMPILKAN
 ?>

 	<h5>OPERACIONES</h5>

                <div class="control-group">

						<label><b> <img src="images/ikon.png" width="9" height="9"> <a href="?open=KeranjangBelanja" target="_self">Carrito de Compra</a></b></label>
						  </div>
                <div class="control-group">
							<lable><b><img src="images/ikon.png" width="9" height="9"><a href="?open=TransaksiList" target="_self"> <b>Historial de Pedidos</b></a></b></lable>
						  </div>
                <div class="control-group">
                		<label><b><img src="images/ikon.png" width="9" height="9">Testimonios</b></label>
                </div>

                <div class="control-group">
						<label><b><a href='login_out.php' target="_self">Cerrar Sesión</a></b></label>
							&nbsp;&nbsp;
						  </div>
              <?php } ?>

    </div>

    </div>

    </div>

</body>
