# Lomba Heckfedst 

## NAMA APLIKASI :CarbonStockID
CarbonStockID adalah sebuah aplikasi berbasis web yang dirancang untuk memberikan solusi inovatif dan praktis dalam mengelola cadangan karbon. Bertujuan untuk membantu pengguna dalam menghitung dan memprediksi cadangan karbon pada ekosistem tertentu. Hal ini penting untuk mendukung upaya pelestarian lingkungan dan mengatasi perubahan iklim.
### Software yang di gunakan 
* PHP versi 8.2
* Composer 
* Laravel 10 

### Menjalankan Aplkasi 
* Mengambil kode dari repo dengan cara di bawah ini
```
git clone https://github.com/chevalierlab-sas/web-BE_hijau-2023
```
* intall package dengan cara di bawah ini
```
composer install
```
* Package dan alamat database tidak terbawa ke repo dengan cara di bawah ini
```
cp .env.example .env
```
* Untuk mengatur App Key dengan cara di bawah ini 
```
php artisan key:generate
```
* Menjalankan database dengan cara di bawah ini 
```
php artisan migrate
```
* membuat akun admin dengan cara di bawah ini 
```
php artisan db:seed
```
* Menjalankan aplikasi pembukuan dengan cara di bawah ini 
```
php artisan serve 
```