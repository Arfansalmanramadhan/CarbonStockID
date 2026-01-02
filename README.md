# NAMA APLIKASI :CarbonStockID
CarbonStockID adalah sebuah aplikasi berbasis web dan android yang dirancang untuk memberikan solusi inovatif dan praktis dalam mengelola cadangan karbon. Bertujuan untuk membantu pengguna dalam menghitung cadangan karbon pada ekosistem tertentu. Hal ini penting untuk mendukung upaya pelestarian lingkungan dan mengatasi perubahan iklim.

### Teknologi yang di gunakan 

#### Backend & Web Developer 
* PHP versi 8.2
* Composer 
* Laravel 10 
* Supabase

#### Android & Deain
* Kotlin
* Figma

### Fitur Utama
#### Fitur Web (Admin & Pengelola Data)

* Manajemen Tim, lokasi dan plot area cadangan karbon

* Pengelolaan data sub-plot (pohon, pancang, semai, serasah, tanah, nekromas, dll)

* Perhitungan biomassa, kandungan karbon, dan serapan CO₂

* Verifikasa data cadangan karbon

* Autentikasi dan otorisasi pengguna

* Export dan monitoring data cadangan karbon

#### Fitur Mobile (Android)

* Input data lapangan secara langsung melalui aplikasi Android

* Sinkronisasi data dengan backend melalui Supabase

* Visualisasi data cadangan karbon

* Akses data berbasis akun pengguna

### Fitur Umum

* Integrasi backend Laravel dengan Supabase

* Arsitektur sistem terpisah antara Web, Mobile, dan Backend

#### Menjalankan Aplkasi (Web)
* Mengambil kode dari repo dengan cara di bawah ini
```
git clone https://github.com/Arfansalmanramadhan/CarbonStockID
```
* intall package dengan cara di bawah ini
```
composer update
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

* Menjalankan aplikasi CarbonStockID dengan cara di bawah ini 
```
php artisan serve 
```

### UX/UI Designer
[Link](https://www.figma.com/design/NLM2yXRX5v81TgP7kYcosY/PA-Carbon?node-id=1-1387&p=f&t=XXybktfPkJkQfROh-0)

## Blue Print Team (Versi pertama)
- **Back end Deceloper & Front end Deceloper**: Arfan Salman Ramadhan
- **Front end Developer**: Najmi Iqbal Hanif [Github](https://github.com/pendosataubat) & [instragram](https://www.instagram.com/hnf_.45/)
- **UI/UX Designer**: Syfanadya Wenning Adi  [Github](https://github.com/syfanadya) & [instragram](https://www.instagram.com/syfa.ndya)
- **Machine Learningr**: Vina Namira Andrina Andidi  [Github](https://github.com/vinanamira) & [instragram](https://www.instagram.com/vinanamiraa16/)

## Apliikasi Versi Kedua 
### Tim Developer:
- **Full Stack Web Deceloper**: Arfan Salman Ramadhan
- **Android Developer**: Muhammad Fadhlan Jamil [instragram](https://www.instagram.com/fdhlan_jmail/)
- **Android Developer**: Dzaki Alwan Firjatullah [instragram](https://www.instagram.com/dzakialwan_05/)

