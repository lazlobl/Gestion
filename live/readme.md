Veritrans VT-Web in PHP
===========================

Contoh sederhana untuk mengimplementasikan VT-Web dengan PHP.

### Cara penggunaan
1. Download semua file dalam repositori ini, letakkan di server (Misalnya: folder htdocs, jika Anda menggunakan XAMPP atau MAMP).
2. Ubah konfigurasi `server_key` di file `checkout_process.php` sesuai dengan yang ada di Merchant Administration Portal (MAP) di halaman Setting >> Access Keys.
3. Selesai. Buka checkout.html dari browser.


### Menangani Notifikasi
File `notification_handler.php` adalah contoh script untuk menangani HTTP(POST) notification yang dikirim oleh server Veritrans ke server merchant. Atur alamat endpoint server merchant yang akan dikirimi HTTP(POST) notifikasi di Merchant Administration Portal (MAP) pada halaman Setting >> VT-Web Preferences.


### Production Environment
Jika Anda sudah selesai melakukan testing dan sudah siap untuk go live di Production Environment, ada satu hal yang perlu dipastikan:

Arahkan konfigurasi `$endpoint` di file `checkout_process.php` ke: 

  ```
  https://api.veritrans.co.id/v2/charge
  ```