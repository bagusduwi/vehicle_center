PHP version : PHP 7.4.29
Framework : Laravel
Database : MySQL
Apache : 2.4.53
MariaDB : 10.4.24

Contoh dokomentasi aplikasi dapat dilihat di Folder Screenshot.

Terdapat 2 akses user :
Admin = mengisi data master dan pengajuan penggunaan kendaraan.
User = melakukan persetujuan pengajuan

Terdapat beberapa Grade User 
1 Non Staff
2 Staff
3 Manager
4 General Manager
5 Director


Username dan password yang dapat digunakan setelah menggunakan perintah : 
"php artisan migrate:fresh --seed"
username, password, grade
admin, indonesia, admin
roni, indonesia, grade 1
yanti, indonesia, grade 2
sumi, indonesia, grade 3

Database : "pemesanan_kendaraan" -> "php artisana migrate" atau import dari file pemesanan_kendaraan.sql

