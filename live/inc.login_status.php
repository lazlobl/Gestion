<script language="javascript" src="kalender.js"></script>
<script type="text/javascript">
	document.write (hari+","+tanggal+" "+bulan+" "+tahun)
</script>
<?php 
if (isset($_SESSION['SES_PELANGGAN'])=="") {
	?><li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">Iniciar Sesion <b class="caret"></b></a>
						<div class="dropdown-menu">
						<!--<form class="form-horizontal loginFrm" action="?open=LoginValidasi"  method="POST">
						  <div class="control-group">								
							<input type="text" class="span2" name="txtUsername" id="inputEmail" placeholder="Usuario">
						  </div>
						  <div class="control-group">
							<input type="password" class="span2" name="txtPassword" id="inputPassword" placeholder="Contraseña">
						  </div>
						  <div class="control-group">
							<label class="checkbox">
							<input type="checkbox"> Recordar
							</label>
							<button type="submit" class="btn btn-block">Iniciar Sesion</button>
						  </div>
						</form>-->		
				
							<form class="form-horizontal loginFrm" action="?open=LoginValidasi"  method="POST">
				<div class="control-group">
						<label><b>Usuario</b></label>
							<input type="text" name="txtUsername" class="span2" id="inputEmail" placeholder="Uuario" required>
						  </div>
						  <div class="control-group">
						  <label><b>Contraseña</b></label>
							<input type="password" name ="txtPassword" class="span2" id="inputPassword" placeholder="Contraseña" required>
						  </div>
						  <div class="control-group">
							<label>
							<button type="submit" class="btn pull-right" name="btnLogin" >Iniciar Sesión</button><a class="btn pull-right" href='?open=DataBaru'>Registrarse</a>
							</label>
							
                          </div>
 </form>



						
						</div>
	</li><?php
	//echo "<b><font color='red'>Bienvenido";
	//echo "|Visitante</font></b>";
	
}
else {
	
	echo "<b>[".$_SESSION['SES_USERNAME']."]";
	echo "  [<a href=login_out.php>Cerrar Sesión</a>]</b>";
}
?>