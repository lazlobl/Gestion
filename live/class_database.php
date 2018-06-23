<?php 
/**
* Herry prasetyo
*
*/
class database
{
	//PROPERTI
	private $dbHost	= "localhost";
	private $dbUser = "root";
	private $dbPass = "";
	private $dbName = "radjabangunandb";

	function connectMySQL(){
		mysql_connect($this->dbHost, $this->dbUser,$this->dbPass);
		mysql_select_db($this->dbName) or die("Database Tidak Ada");
	}

	//method simpan data 
	function tambahPesanan($KodePemesanan, $Kode,$Harga, $Jumlah){
		$KodePemesanan   =buatKode("pemesanan","PS");
		$query = "INSERT INTO pemesanan_item(no_pemesanan, kd_barang, harga, jumlah) VALUES('$KodePemesanan','$Kode','$Harga','$Jumlah')";
	}

	function tampilPesanan(){
		$query = mysql_query("SELECT * FROM pemesanan_item WHERE kd_pelanggan");
		while ($row=mysql_fetch_array($query))
			$data[]=$row;
			return $data;
	}

	function tampilPelanggan($txtNama){

	}

	function tampilTmpKeranjang($KodePelanggan,$Kode,$Harga,$Jumlah){
		$KodePelanggan=$_SESSION['SES_PELANGGAN'];
		 $bacaSql="SELECT *  FROM tmp_keranjang WHERE kd_pelanggan='$KodePelanggan'";
            $bacaQry =mysql_query($bacaSql, $koneksidb)or die("Gagal Keranjang tmp".mysql_error());
            while ($bacaData =mysql_fetch_array($bacaQry)) {
                # SIMPAN DATA DARI KERANJANG BELANJA KE PEMESANAN ITEM
                $Kode       = $bacaData['kd_barang'];
                $Harga      = $bacaData['harga'];
                $Jumlah     = $bacaData['jumlah'];
	}
}

}
?>