<?php

include_once "inc.session.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

//BACA KODE PELANGGAN
$KodePelanggan = $_SESSION['SES_PELANGGAN'];
$NamaPelanggan = $_SESSION['SES_USERNAME'];

// data Kode di URL harus ada

?>
<!DOCTYPE html>
<html>
<head>
    <title>Historial de Orden</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.min.css">

    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
</head>
<body>
    <div class="row-fluid">
        <div class="span9">
            <table width="100%" class="table table-bordered" border="1" cellpadding="0" cellspacing="3">
                <thead>
                    <tr>
                        <th height="22" colspan="8" bgcolor="#CCCCCC"><b>LISTA DE RESERVA</b></th>
                    </tr>
                    <tr bgcolor="#dfe9ff">
                        <th width="4" align="center" bgcolor="#F5F5F5"><strong>Nro</strong></th>
                        <th width="13%" bgcolor="#F5F5F5"><strong>Nro Reserva</strong></th>
                        <th width="14%" bgcolor="#F5F5F5"><strong>Fecha</strong></th>
                        <th width="24%" bgcolor="#F5F5F5"><strong>Nombre Beneficiario</strong></th>
                        <th width="14%" align="right" bgcolor="#F5F5F5"><strong>Total</strong></th>
                        <th width="23%" align="center" bgcolor="#F5f5f5"><strong>Gastos de Envio (S/.)</strong></th>
                        <th width="4%" align="center" bgcolor="#f5f5f5"><strong>Estado</strong></th>
                        <th width="4%" align="center" bgcolor="#F5F5F5"><strong>Herramientas</strong></th>
                    </tr>
                    <?php
                   // Deklrasi variabel
    $biayaKirim = 0;
    $totalBayar     = 0;
    $digitHp    = "";
    $unikTransfer   = 0;
            $mySql = "SELECT pemesanan.*, pelanggan.nm_pelanggan, prov.biaya_kirim
                FROM pemesanan
                LEFT JOIN pelanggan ON pemesanan.kd_pelanggan=pelanggan.kd_pelanggan
                LEFT JOIN prov ON pemesanan.id_prov= prov.id_prov
                WHERE pemesanan.kd_pelanggan='$KodePelanggan' AND pemesanan.nm_pelanggan='$NamaPelanggan' ORDER BY no_pemesanan";

            $myQry = @mysql_query($mySql, $koneksidb) or die("Gagal Query Tuh !!".mysql_error());
            $nomor=0;
            while ($myData=mysql_fetch_array($myQry)) {
                $nomor++;
                $Kode   = $myData['no_pemesanan'];

                $diskonHarga =0;
                $hargaDiskon =0;
                $totalHarga =0;
                $totalBarang =0;

                // Menampilkan data di pemesanan_item
    $hitungSql  = "SELECT SUM(harga * jumlah) As total_harga,
                SUM(jumlah) As total_barang FROM pemesanan_item WHERE no_pemesanan='$Kode'";
    $hitungQry  = mysql_query($hitungSql, $koneksidb) or die ("Gagal query 2 ".mysql_error());
    $hitungData = mysql_fetch_array($hitungQry);

    $totalHarga     = $hitungData['total_harga'];
    $totalBarang    = $hitungData['total_barang'];

    // Hitung total biaya kirim (Biaya Kirim Dikali dengan jumlah barang)
    $biayaKirim = $totalBarang * $myData['biaya_kirim'];

    // Hitung total yang harus dibayar
    $totalBayar = $totalHarga + $biayaKirim;

    // Mengambil 3 digit terakhir nomor HP
    $digitHp    = substr($myData['no_telepon'],-2);

    // Membuat nominal transfer
    $unikTransfer = substr($totalBayar,0,-2).$digitHp;

                    ?>
                </thead>
                <tbody>
                    <tr>
                            <td align="center" bgcolor="#FFFFFF"><?php echo $nomor; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $myData['no_pemesanan']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo IndonesiaTgl($myData['tgl_pemesanan']); ?></td>
      <td bgcolor="#FFFFFF"><?php echo $myData['nama_penerima']; ?></td>
      <td align="right" bgcolor="#FFFFFF">S/. <?php echo format_angka($totalHarga); ?></td>
      <td align="right" bgcolor="#FFFFFF">S/. <?php echo format_angka($biayaKirim); ?></td>
      <td align="center" bgcolor="#FFFFCC"><?php echo $myData['status_bayar']; ?></td>
                        <td align="center"><a href="?open=TransaksiDetail&Kode=<?php echo  $Kode; ?>" target="_self"><font color="red">VER</font></a><b>|</b><a href="?open=KonfirmasiPembayaran&Kode=<?php echo $Kode; ?>" target="_self"><font color="blue">CONFIRMAR</font></a></td>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>