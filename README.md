PHP version : PHP 7.4.29<br>
Framework : Laravel<br>
Database : MySQL<br>
Apache : 2.4.53<br>
MariaDB : 10.4.24<br>
<br>
Contoh dokomentasi aplikasi dapat dilihat di Folder Screenshot.<br>
<br>
Terdapat 2 akses user :<br>
Admin = mengisi data master dan pengajuan penggunaan kendaraan.<br>
User = melakukan persetujuan pengajuan<br>
<br>
Terdapat beberapa Grade User <br>
1 Non Staff<br>
2 Staff<br>
3 Manager<br>
4 General Manager<br>
5 Director<br>
<br>
<br>
Username dan password yang dapat digunakan setelah menggunakan perintah : <br>
"php artisan migrate:fresh --seed"<br>
username, password, grade<br>
admin, indonesia, admin<br>
roni, indonesia, grade 1<br>
yanti, indonesia, grade 2<br>
sumi, indonesia, grade 3<br>
<br>
Database : "pemesanan_kendaraan" -> "php artisana migrate" atau import dari file pemesanan_kendaraan.sql<br>
<br>
