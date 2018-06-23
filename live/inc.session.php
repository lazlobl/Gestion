<?php 
if(empty($_SESSION['SES_USERNAME'])){
	echo "<center>";
	echo "<br><br><b>LO SENTIMOS, ACCESO DENEGADO!</b><br>
			Su nombre de usuario no esta autorizado para acceder a esta página.
			Si aún no tiene Cuenta, por favor espere unos segundos <b> 
			ESTA SIENDO REDIRIGIDO A LA SECCION DE REGISTRO .. !!</b>";
    echo "<meta http-equiv='refresh' content='2; url=?open=DataBaru'>";
	echo "</center>";	
exit;	
}
?>