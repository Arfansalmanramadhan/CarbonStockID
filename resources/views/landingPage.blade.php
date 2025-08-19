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
                        <a class="nav-link" href="#Gambar">Peta</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link" href="#Fitur">Fitur</a>
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
                    <h1>Hitung, Kelola Cadangan Karbon Jadi <span>Mudah dan Efisien</span></h1>
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
    <section id="Gambar">
        <div class=" ">
            <div class="row text-center">
                <div class="col">
                    <h2 id="fitur">PETA SEBARAN CARBOSTOCK</h2>
                </div>
            </div>
            {{-- <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3>Fitur Terbaik untuk Pengelolaan Cadangan Karbon yang Efisien</h3>
                </div>
                <div class="col-lg-6">
                    <p>Platform CarbonStockID menawarkan fitur - fitur yang tentunya akan menghemat waktu Anda dalam
                        proses perhitungan cadangan karbon.</p>
                </div>
            </div>
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
        </div> --}}
            <div class="row">
                <div class="col-12 position-relative">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h3 class="card-title"><strong>Peta Monitoring Karbon</strong></h3>
                        </div> --}}
                        <div class="card-body" style="position: relative;">
                            <div id="map" style="height: 600px; width: 100%;"></div>
                            <div id="info-panel" class="info-panel">
                                <p>Klik marker untuk melihat detail plot area</p>
                            </div>
                        </div>
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
                            <p class="card-text">Memudahkan pengguna dalam mengelola data serapan dan karbon setiap
                                lokasi pengukuran .</p>
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
                            <span>CarbonStockID adalah aplikasi inovatif berbasis web dan mobile yang dirancang untuk
                                membantu pengguna dalam mengukur, mengelola, dan memprediksi cadangan karbon di berbagai
                                lokasi hutan atau lahan berdasarkan data lapangan.</span>
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
                                    <li>Admin, yang bertugas melakukan kalkulasi, validasi, serta pengolahan data dan
                                        hasil akhir.</li>
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
                            <span>Surveyor memasukkan data biomassa dari pohon, semai, serasah, dan nekromas melalui
                                form isian di aplikasi. Data ini kemudian dihitung oleh sistem menggunakan rumus dari
                                SNI 7724 untuk menghasilkan estimasi cadangan karbon. Hasilnya ditampilkan dan dapat
                                diunduh melalui dashboard admin.

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
                            <span>Pengguna dapat mulai dengan membuat akun sebagai admin atau surveyor. Setelah login,
                                pengguna dapat langsung mengakses dashboard dan fitur-fitur sesuai peran masing-masing
                                untuk mulai menginput atau memproses data.</span>
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
                            <span>Ya. Data pengguna disimpan secara aman dan dikelola melalui sistem autentikasi yang
                                dibedakan antara admin dan surveyor. Aplikasi ini terhubung dengan Supabase untuk
                                menjamin keamanan data secara real-time.</span>
                        </div>
                    </div>
                    <div class="card-pertanyaan" onclick="toggleAnswer(this)">
                        <div class="pertanyaan-header">
                            <p>Apakah bisa mengunduh hasil kalkulasi?</p>
                            <i class="fas fa-chevron-down"></i>
                            <img src="{{ asset('/images/ChevronDown.png') }}" alt="" />
                        </div>
                        <div class="pertanyaan-body">
                            <span>Bisa. Admin dapat mengunduh hasil kalkulasi cadangan karbon dalam bentuk laporan
                                terstruktur yang mencakup biomassa, kandungan karbon, dan estimasi serapan CO₂.</span>
                        </div>
                    </div>
                    <div class="card-pertanyaan" onclick="toggleAnswer(this)">
                        <div class="pertanyaan-header">
                            <p>Apakah pengukuran sesuai standar SNI?</p>
                            <i class="fas fa-chevron-down"></i>
                            <img src="{{ asset('/images/ChevronDown.png') }}" alt="" />
                        </div>
                        <div class="pertanyaan-body">
                            <span>Ya. Aplikasi ini mengacu pada SNI 7724 sebagai standar dalam penghitungan biomassa dan
                                cadangan karbon, sehingga hasilnya valid dan dapat dipertanggungjawabkan secara
                                ilmiah.</span>
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
                        mengukur cadangan karbon sesuai standar SNI,
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        .info-panel {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 360px;
            max-height: 500px;
            overflow-y: auto;
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            font-size: 14px;
        }

        .info-panel table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .info-panel thead th {
            background-color: #5cb85c;
            color: #fff;
            padding: 8px;
            text-align: left;
            font-weight: 600;
        }

        .info-panel tbody tr:nth-child(odd) {
            background-color: #f7fdf7;
        }

        .info-panel td,
        .info-panel th {
            border: 1px solid #5cb85c;
            padding: 6px 8px;
        }

        .info-panel tfoot td {
            background-color: #f7fdf7;
            font-weight: 600;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const map = L.map('map').setView([-6.9175, 107.6191], 10);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 18
            }).addTo(map);

            const infoPanel = document.getElementById('info-panel');
            const updateInfo = html => infoPanel.innerHTML = html;

            fetch('/zones/plot-area')
                .then(r => r.json())
                .then(res => {
                    if (!res.success) throw new Error(res.message || 'Gagal memuat plot area');
                    renderPlotAreas(res.data);
                })
                .catch(e => updateInfo(`<div class="alert alert-danger">Error: ${e.message}</div>`));

            function renderPlotAreas(areas) {
                const bounds = [];
                areas.forEach(a => {
                    if (!a.latitude || !a.longitude) return;
                    const lat = +a.latitude,
                        lng = +a.longitude;
                    const m = L.circleMarker([lat, lng], {
                        radius: 8,
                        fillColor: '#28a745',
                        color: '#fff',
                        weight: 2,
                        opacity: 1,
                        fillOpacity: 0.8
                    }).addTo(map);

                    m.bindPopup(`
        <div style="text-align:center">
          <h6><strong>${a.daerah}</strong></h6>
          <button class="btn btn-sm btn-primary"
            onclick="showDetails('${a.slug}', '${a.daerah}')">
            Lihat Detail
          </button>
        </div>
      `);
                    bounds.push([lat, lng]);
                });
                if (bounds.length) map.fitBounds(bounds, {
                    padding: [20, 20]
                });
            }

            window.showDetails = (slug, name) => {
                updateInfo(`
    <div class="text-center">
      <div class="spinner-border"></div>
      <p>Memuat data: <strong>${name}</strong>…</p>
    </div>
  `);

                fetch(`/zones/${slug}/summary`)
                    .then(r => r.json())
                    .then(res => {
                        const obj = res.data[0];

                        const rows = [{
                                label: 'Serasah',
                                co2: parseFloat(obj.Serasahco2),
                                luas: parseFloat(obj.faktor),
                                total: parseFloat(obj.Serasah),
                                persen: parseFloat(obj.hasilSerasahPersen)
                            },
                            {
                                label: 'Necromass',
                                co2: parseFloat(obj.Necromassco2),
                                luas: parseFloat(obj.faktor),
                                total: parseFloat(obj.Necromass),
                                persen: parseFloat(obj.hasilNecromassPersen)
                            },
                            {
                                label: 'CO₂ Tanaman',
                                co2: parseFloat(obj.Co2Tanaman),
                                luas: parseFloat(obj.faktor),
                                total: parseFloat(obj.TotalCarbonn),
                                persen: parseFloat(obj.hasilco2tanamanPersen)
                            },
                            {
                                label: 'Tanah',
                                co2: parseFloat(obj.TanahCo2),
                                luas: parseFloat(obj.tanah),
                                total: parseFloat(obj.TanahCarbon),
                                persen: parseFloat(obj.hasiltanahPersen)
                            },
                            {
                                label: 'Berat biomasa akar',
                                co2: parseFloat(obj.BeratBiomassaAkar),
                                luas: parseFloat(obj.faktor),
                                total: parseFloat(obj.beratMasaAkar),
                                persen: parseFloat(obj.hasilakarPersen)
                            },
                        ];

                        let html = `
        <h6>Titik Lokasi</h6>
        <table>
          <tfoot>
                          <tr>
                            <th>Daerah Plot</th>
                            <td>${name}</td>
                          </tr>
                          <tr>
                            <th>Latitude</th>
                            <td>${parseFloat(obj.latitude).toFixed(8)}</td>
                          </tr>
                          <tr>
                            <th>Longitude</th>
                            <td>${parseFloat(obj.longitude).toFixed(8)}</td>
                          </tr>

          <tfoot>
        </table>
      `;

                        //                 rows.forEach((r, i) => {
                        //                     html += `
                    //   <tr>
                    //     <td>${i+1}</td>
                    //     <td>${r.label}</td>
                    //     <td>${r.co2.toFixed(2)} Ton C/Ha</td>
                    //     <td>${r.luas.toFixed(2)} Ha</td>
                    //     <td>${r.total.toFixed(2)} Ton C/Ha</td>
                    //     <td>${r.persen.toFixed(2)} %</td>
                    //   </tr>
                    // `;
                        //                 });
                        //                 // console.log(obj.latitude);
                        //                 html += `
                    //   </tfoot>
                    //   <tfoot>
                    //     <tr>
                    //       <td colspan="4"><strong>Total Carbon 5 Poll</strong></td>
                    //       <td colspan="2">${obj.latitude ? parseFloat(obj.latitude).toFixed(8) : '-'} Ton</td>
                    //     </tr>
                    //     <tr>
                    //       <td colspan="4"><strong>Baseline Lahan Kosong</strong></td>
                    //       <td colspan="2">${obj.longitude ? parseFloat(obj.longitude).toFixed(8) : '-'} Ton C/Ha</td>
                    //     </tr>
                    //   </tfoot>
                    // </table>
                    //   `;
                        //                         let html = `
                    //     <h6 class="mb-3">Informasi Lokasi Plot</h6>
                    //     <table>
                    //       <tbody>
                    //         <tr>
                    //           <th>Daerah Plot</th>
                    //           <td>${obj.daerah}</td>
                    //         </tr>
                    //         <tr>
                    //           <th>Latitude</th>
                    //           <td>${parseFloat(obj.latitude).toFixed(8)}</td>
                    //         </tr>
                    //         <tr>
                    //           <th>Longitude</th>
                    //           <td>${parseFloat(obj.longitude).toFixed(8)}</td>
                    //         </tr>
                    //       </tbody>
                    //     </table>
                    //   `;

                        updateInfo(html);

                        // updateInfo(html);
                    })
                    .catch(e => updateInfo(`<div class="alert alert-danger">Error: ${e.message}</div>`));
            };

            // 4) Legend
            const legend = L.control({
                position: 'bottomright'
            });
            legend.onAdd = () => {
                const div = L.DomUtil.create('div', 'info legend');
                div.style.cssText = 'background:#fff;padding:8px;border:1px solid #ccc;border-radius:4px';
                div.innerHTML = `
      <h6>Legenda</h6>
      <span style="display:inline-block;width:12px;height:12px;
                   background:#28a745;border-radius:50%;
                   margin-right:5px;"></span> Plot Area
    `;
                return div;
            };
            legend.addTo(map);
        });
    </script>
</body>

</html>
