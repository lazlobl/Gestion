<?php
if(isset($_GET['open'])) {
	switch ($_GET['open']){
		default			: if(!file_exists ("barang2.php")) die ("Informacion de archivo no existe");
								include "barang2.php"; break;

		case '' 		: if(!file_exists ("barang2.php")) die ("Informacion de archivo no existe");
								include "barang2.php"; break;

		case 'Barang':	if (!file_exists("barang.php")) die("Archivo no encontrado");
								include "barang.php";	break;

        case 'Barang2':if(!file_exists("barang2.php")) die ("Archivo Barang2 no encontrado");
                            include "barang2.php"; break;

        case 'Barang-Produk':if (!file_exists("barang_produk.php"))die("Archivo Barang produk no existe");
        	                 include "barang_produk.php";   break;

		case 'About': if (!file_exists("aboutus.php")) die ("Archivo Acerca no existe");
						include "aboutus.php";	break;

		case 'Panduan'   :if(!file_exists ("info_panduan.php")) die ("Archivo de info_panduan.php no existe, puede crear estos archivos desde Dreamweaver");
								include "info_panduan.php";  break;

        case 'KonfirmasiPembayaran' :if(!file_exists("konfirmasi_pembayaran.php")) die ("Archivo Konfirmasi Pembayaran no existe,");
        				include "konfirmasi_pembayaran.php"; break;

		case 'Contact-Us' : if (!file_exists("contact.php")) die("File Tidak Ditemukan");
					include "contact.php"; break;


		case 'Profil'   :if(!file_exists ("info_profil.php"))  die ("File info_profil.php tidak ada, Anda dapat membuat file ini dari dreamweaver");
								include "info_profil.php"; break;

		case 'Home'   :if(!file_exists ("info_home.php"))  die ("File info_home.php tidak ada, Anda dapat membuat file ini dari dreamweaver");
								include "info_home.php"; break;

		case 'Alamat'   :if(!file_exists ("alamatkita.htm")) die ("File alamat kita tidak ada");
								include "alamatkita.htm";  break;

		case 'LoginValidasi' 	: if(!file_exists ("login_validasi.php"))  die ("File login tidak ada");
								include "login_validasi.php"; break;

		case 'Bukutamu' 	:if(!file_exists ("buku_tamu.php")) die ("File buku tamu tidak ada");
								include "buku_tamu.php"; break;

		case 'Bukutamu-Tampil' :if(!file_exists ("buku_tamu_tampil.php")) die ("File buku tamu tampil tidak ada");
								include "buku_tamu_tampil.php"; break;

		case 'DataBaru': if (!file_exists("daftar_baru.php")) die ("File Daftar Belum Dibuat jadi sabar dulu ya");
									include "daftar_baru.php"; break;

        case 'SuccessRegistration':if(!file_exists("daftar_sukses.php")) die ("Lo sentimos archivo en blanco");
                        include "daftar_sukses.php"; break;

        case 'Aktivasi':if (!file_exists("aktivasi_member.php")) die("Lo sentimos archivo en blanco");
        				include "aktivasi_member.php";	break;


        #SYARAT & KETENTUAN
        case 'SyaratKetentuan':if (!file_exists("syarat_ketentuan.php")) die("Lo sentimos archivo en blanco");
        					include "syarat_ketentuan.php";	break;

        #cara member
        case 'CaraMember':
        	if (!file_exists("cara_member.php")) die("Lo sentimos archivo en blanco"); 
        					include "cara_member.php";			break;

        #KEUNTUNGAN MENJADI MEMBER
        case 'KeuntunganMember':
        	if (!file_exists("keuntungan_member.php")) die("Lo sentimos archivo en blanco"); 
        					include "keuntungan_member.php"; break;

        #CARA BELANJA
        case 'CaraBelanja':
        if (!file_exists("cara_belanja.php")) die("Lo sentimos archivo en blanco");
        	include "cara_belanja.php"; break;

        #CARA PENGEMBALIAN
        case 'CaraPengembalian':
        	if (!file_exists("cara_pngembalian.php")) die("Lo sentimos archivo en blanco"); 
        		include "cara_pngembalian.php"; break;

        #KONTAK KAMI 
        case 'KontakKami':
        	if (!file_exists("kontak_kami.php")) die("Lo sentimos archivo en blanco"); 
        		include "kontak_kami.php";		break;

        #Term Question
        case 'TermQuestion':
				if (!file_exists("term_qustion.php")) die("Lo sentimos archivo en blanco");
				include "term_qustion.php"; break;



		case 'Pelanggan-Ubah' :if(!file_exists ("pelanggan_ubah.php")) die ("File pelanggan ubah tidak ada");
								include "pelanggan_ubah.php";  break;
		case 'Pelanggan-Lihat' :if(!file_exists ("pelanggan_lihat.php")) die ("File pelanggan lihat tidak ada");
								include "pelanggan_lihat.php";  break;


		case 'Info' 		: if(!file_exists ("info.php")) die ("Archivo no encontrado");
								include "info.php"; break;

		case 'Barang-Lihat' :if(!file_exists ("barang_lihat.php")) die ("Archivo no encontrado");
								include "barang_lihat.php"; break;

		case 'BarangPencarian' :if(!file_exists ("barang_pencarian.php")) die ("Error Abrir Archivo");
								include "barang_pencarian.php"; break;

		case 'Barang-Beli' :if(!file_exists ("barang_beli.php"))  die ("File beli pilih sim tidak ada");
								include "barang_beli.php"; break;

		case 'Barang-Kategori' :if(!file_exists ("barang_kategori.php")) die ("El archivo no existe");
								include "barang_kategori.php"; break;

		case 'KeranjangBelanja' :if(!file_exists ("keranjang_belanja.php")) die ("Carrito de Compra no existe");
								include "keranjang_belanja.php"; break;

		case 'Transaksi-Proses' :if(!file_exists ("transaksi_proses.php"))  die ("Nngun Arhcivo Encontrado");
								include "transaksi_proses.php";  break;

		case 'Transaksi-Tampil' :if(!file_exists ("transaksi_lihat.php"))  die ("File daftar transaksi tidak ada");
								include "transaksi_lihat.php"; break;


		case 'TransaksiDetail' :if (!file_exists("transaksi_listdet.php")) die("Lo sentimos archivo en blanco");
					include "transaksi_listdet.php"; break;


		case 'Konfirmasi' :if(!file_exists ("konfirmasi.php"))
							   die ("File konfirmasi transaksi tidak ada");
								include "konfirmasi.php";
								break;
		case 'Konfirmasi-Save' :if(!file_exists ("konfirmasi_sim.php"))
							   die ("File konfirmasi transaksi simpan tidak ada");
								include "konfirmasi_sim.php";
								break;
		case 'TransaksiList': if (!file_exists("transaksi_list.php"))
								die("File List tidak ada");
								include "transaksi_list.php";
								break;
	}
}
else {
	if(!file_exists ("barang2.php")) die ("Archivo no encontrado");
		include "barang2.php";
}
?>