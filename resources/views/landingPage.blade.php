<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Inter:wght@400;700&display=swap"
        rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
    <style>
        section {
            padding-top: 5rem
        }
    </style>

    <!-- Logo Title -->
    <link rel="icon" href="{{ asset('/images/logoCarbonStockID-LightMode.png') }}" type="image/x-icon" />
    <title>CarbonStockID</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg  bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('/images/logoCarbonStockID-DarkMode.png') }}" alt="Logo" width="30"
                    class="d-inline-block align-middle me-2" />
                <span>CarbonStockID</span>
            </a>
            <button class="navbar-toggler bg-success" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item me-2">
                        <a class="nav-link" href="#fitur">Fitur</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#Pertanyaan">Pertanyaan</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#TentangKami">Tentang Kami</a>
                    </li>
                </ul>
                <div>
                    <a href="{{ route('login') }}" class="btn btn-light btn-masuk" type="button">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-success btn-daftar" type="button">Daftar</a>
                </div>
            </div>
        </div>
    </nav>


    <!-- Hero Section -->
    <section id="hero">
        <div class="container  me h-100 position-relative">
            <div class="row">
                <div class="col-lg-6 hero-tagline  ">
                    <h1>Hitung, Kelola  Cadangan Karbon Jadi <span>Mudah dan Efisien</span></h1>
                    <p>Solusi terintegrasi untuk perhitungan dan pengelolaan cadangan karbon yang akurat dan efisien.
                        Mengoptimalan carbon trading di Indonesia dengan.</p>
                    <a href="{{ route('login') }}" class="btn btn-success button-hero">Mulai sekarang</a>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('/images/imagehero.png') }}" alt="Hero Image"
                        class="position-absolute end-0 bottom-0 img-hero" />
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Section -->
    <section id="Fitur">
        <div class="container me">
            <div class="row text-center">
                <div class="col">
                    <h2 id="fitur">FITUR ANDALAN</h2>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3>Fitur Terbaik untuk Pengelolaan Cadangan Karbon yang Efisien</h3>
                </div>
                <div class="col-lg-6">
                    <p>Platform CarbonStockID menawarkan fitur - fitur yang tentunya akan menghemat waktu Anda dalam
                        proses perhitungan cadangan karbon.</p>
                </div>
            </div>
            <div class="row text-center mt-5">
                <div class="col-lg-4 mt-2">
                    <div class="card">
                        <img src="{{ asset('/images/fitur1.svg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Management Data Plot</h5>
                            <p class="card-text">Memudahkan pengguna dalam mengelola data lokasi pengukuran serta sub
                                plot.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-2">
                    <div class="card">
                        <img src="{{ asset('/images/image.png') }}" class="card-img-top" alt="..." height="260px">
                        <div class="card-body">
                            <h5 class="card-title">Diagram </h5>
                            <p class="card-text">Memudahkan pengguna dalam mengelola data serapan dan karbon setiap  lokasi pengukuran .</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-2">
                    <div class="card">
                        <img src="{{ asset('/images/fitur3.svg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Kalkulasi</h5>
                            <p class="card-text">Menghitung cadanagan karbon secara otomatis berdasarkan parameter yang
                                diinput.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pertanyaan Section -->
    <section id="Pertanyaan">
        <div class="container me ">
            <div class="row text-center">
                <div class="col">
                    <h2>PERTANYAAN & JAWABAN</h2>
                </div>
            </div>
            <p>Pelajari tentang platform CarbonStockID melalui pertanyaan berikut</p>
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="card-pertanyaan" onclick="toggleAnswer(this)">
                        <div class="pertanyaan-header">
                            <p>Apa itu CarbonStockID?</p>
                            <i class="fas fa-chevron-down"></i>
                            <img src="{{ asset('/images/ChevronDown.png') }}" alt="" />
                        </div>
                        <div class="pertanyaan-body">
                            <span>CarbonStockID adalah aplikasi inovatif berbasis web dan mobile yang dirancang untuk membantu pengguna dalam mengukur, mengelola, dan memprediksi cadangan karbon di berbagai lokasi hutan atau lahan berdasarkan data lapangan.</span>
                        </div>
                    </div>
                    <div class="card-pertanyaan" onclick="toggleAnswer(this)">
                        <div class="pertanyaan-header">
                            <p>Siapa yang bisa menggunakan?</p>
                            <i class="fas fa-chevron-down"></i>
                            <img src="{{ asset('/images/ChevronDown.png') }}" alt="" />
                        </div>
                        <div class="pertanyaan-body">
                            <span>CarbonStockID dapat digunakan oleh dua jenis pengguna:
                                <ul>
                                    <li>Surveyor, yang bertugas menginput data hasil pengukuran di lapangan</li>
                                    <li>Admin, yang bertugas melakukan kalkulasi, validasi, serta pengolahan data dan hasil akhir.</li>
                                </ul>
                            </span>
                        </div>
                    </div>
                    <div class="card-pertanyaan" onclick="toggleAnswer(this)">
                        <div class="pertanyaan-header">
                            <p>Bagaimana cara kerjanya?</p>
                            <i class="fas fa-chevron-down"></i>
                            <img src="{{ asset('/images/ChevronDown.png') }}" alt="" />
                        </div>
                        <div class="pertanyaan-body">
                            <span>Surveyor memasukkan data biomassa dari pohon, semai, serasah, dan nekromas melalui form isian di aplikasi. Data ini kemudian dihitung oleh sistem menggunakan rumus dari SNI 7724 untuk menghasilkan estimasi cadangan karbon. Hasilnya ditampilkan dan dapat diunduh melalui dashboard admin.

                            </span>
                        </div>
                    </div>
                    <div class="card-pertanyaan" onclick="toggleAnswer(this)">
                        <div class="pertanyaan-header">
                            <p>Bagaimana cara memulainya?</p>
                            <i class="fas fa-chevron-down"></i>
                            <img src="{{ asset('/images/ChevronDown.png') }}" alt="" />
                        </div>
                        <div class="pertanyaan-body">
                            <span>Pengguna dapat mulai dengan membuat akun sebagai admin atau surveyor. Setelah login, pengguna dapat langsung mengakses dashboard dan fitur-fitur sesuai peran masing-masing untuk mulai menginput atau memproses data.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-pertanyaan" onclick="toggleAnswer(this)">
                        <div class="pertanyaan-header">
                            <p>Apakah data yang saya masukkan aman?</p>
                            <i class="fas fa-chevron-down"></i>
                            <img src="{{ asset('/images/ChevronDown.png') }}" alt="" />
                        </div>
                        <div class="pertanyaan-body">
                            <span>Ya. Data pengguna disimpan secara aman dan dikelola melalui sistem autentikasi yang dibedakan antara admin dan surveyor. Aplikasi ini terhubung dengan Supabase untuk menjamin keamanan data secara real-time.</span>
                        </div>
                    </div>
                    <div class="card-pertanyaan" onclick="toggleAnswer(this)">
                        <div class="pertanyaan-header">
                            <p>Apakah bisa mengunduh hasil kalkulasi?</p>
                            <i class="fas fa-chevron-down"></i>
                            <img src="{{ asset('/images/ChevronDown.png') }}" alt="" />
                        </div>
                        <div class="pertanyaan-body">
                            <span>Bisa. Admin dapat mengunduh hasil kalkulasi cadangan karbon dalam bentuk laporan terstruktur yang mencakup biomassa, kandungan karbon, dan estimasi serapan CO₂.</span>
                        </div>
                    </div>
                    <div class="card-pertanyaan" onclick="toggleAnswer(this)">
                        <div class="pertanyaan-header">
                            <p>Apakah pengukuran sesuai standar SNI?</p>
                            <i class="fas fa-chevron-down"></i>
                            <img src="{{ asset('/images/ChevronDown.png') }}" alt="" />
                        </div>
                        <div class="pertanyaan-body">
                            <span>Ya. Aplikasi ini mengacu pada SNI 7724 sebagai standar dalam penghitungan biomassa dan cadangan karbon, sehingga hasilnya valid dan dapat dipertanggungjawabkan secara ilmiah.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="TentangKami">
        <div class="container me">
            <h2>TENTANG KAMI</h2>
            <p>Mengenal platform CarbonStockID lebih dalam lagi</p>
            <div class="row mt-5 align-items-center">
                <div class="col-md-6 penjelasan">
                    <h3>Perubahan iklim, yang disebabkan oleh emisi GRK seperti CO2, menjadi isu global.</h3>
                    <h4>Sebagai bagian dari upaya pengurangan emisi, aplikasi “CarbonStockID” dikembangkan untuk
                        mengukur  cadangan karbon  sesuai standar SNI,
                        mendukung mekanisme carbon trading.</h4>
                </div>
                <div class="col-md-6 video-container">
                    <!-- Video Responsive -->
                    <div class="video-responsive">
                        <iframe src="https://www.youtube.com/embed/YOUR_VIDEO_ID" frameborder="0"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="Footer">
        <div class="container-fluid">
            <div class="container">
                <div class="row text-white py-5">
                    <div class="col-md-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset('/images/logoCarbonStockID-LightMode.png') }}" alt="Logo"
                                class="me-2" />
                            <span>CarbonStockID</span>
                        </div>
                        <p>Hak Cipta © 2024 CarbonStockID. Semua hak dilindungi</p>
                        <div class="social-links d-flex">
                            <div class="circle-icon position-relative me-2">
                                <a href="https://instagram.com"><img src="{{ asset('/images/Instagram.png') }}"
                                        alt="Instagram"
                                        class="position-absolute top-50 start-50 translate-middle" /></a>
                            </div>
                            <div class="circle-icon position-relative me-2">
                                <a href="https://google.com"><img src="{{ asset('/images/Google.png') }}"
                                        alt="Google"
                                        class="position-absolute top-50 start-50 translate-middle" /></a>
                            </div>
                            <div class="circle-icon position-relative me-2">
                                <a href="https://linkedin.com"><img src="{{ asset('/images/Linkedin.png') }}"
                                        alt="LinkedIn"
                                        class="position-absolute top-50 start-50 translate-middle" /></a>
                            </div>
                            <div class="circle-icon position-relative">
                                <a href="https://youtube.com"><img src="{{ asset('/images/Youtube.png') }}"
                                        alt="YouTube"
                                        class="position-absolute top-50 start-50 translate-middle" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5>Navigasi</h5>
                        <ul class="list-navigasi">
                            <li><a href="#">Beranda</a></li>
                            <li><a href="#">Fitur</a></li>
                            <li><a href="#">Pertanyaan</a></li>
                            <li><a href="#">Tentang Kami</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Kontak</h5>
                        <ul class="list-kontak">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('/images/TelephoneFill.png') }}" alt="Logo" class="me-2" />
                                <li><i class="fa fa-phone"></i> +62 813-5800-8183</li>
                            </div>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('/images/EnvelopeFill.png') }}" alt="Logo" class="me-2" />
                                <li><i class="fa fa-envelope"></i> carbonstockid@gmail.com</li>
                            </div>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('/images/GeoAltFill.png') }}" alt="Logo" class="me-2" />
                                <li><i class="fa fa-map-marker"></i> Telkom University, Kabupaten Bandung, Jawa Barat
                                    40257</li>
                            </div>
                        </ul>
                    </div>
                    <div class="col-md-1">
                        <div class="circle-scroll position-relative">
                            <a href="#"><img src="{{ asset('/images/ChevronUp.png') }}" alt="chevronup"
                                    class="position-absolute top-50 start-50 translate-middle" /></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('/js/script.js') }}"></script>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
