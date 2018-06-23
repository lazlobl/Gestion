<?php
$my['host']	= "mysql3.000webhost.com";
$my['user']	= "a9862724_herry";
$my['pass']	= "default123";
$my['dbs']	= "a9862724_phpherr";

$koneksidb	= mysql_connect($my['host'], $my['user'], $my['pass']);
if (! $koneksidb) {
  echo "Failed Connection !";
}
// memilih database pda server
mysql_select_db($my['dbs'])
	 or die ("Database not Found, please contact administrator system!");
?>