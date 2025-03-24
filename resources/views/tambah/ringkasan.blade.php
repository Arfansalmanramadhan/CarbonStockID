<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    {{-- <link href="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css" rel="stylesheet" /> --}}

    <!-- Bootstrap CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" /> --}}

    {{-- @if (isset($pdf))
        <!-- Untuk PDF (DOMPDF) -->
        <link rel="stylesheet" href="{{ public_path('css/font.css') }}">
        <link rel="stylesheet" href="{{ public_path('css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ public_path('css/mapbox.css') }}">
        <link rel="stylesheet" href="{{ public_path('css/mapbox2.css') }}">
        <link rel="stylesheet" href="{{ public_path('css/mapbox-gl.css') }}">
        <link rel="stylesheet" href="{{ public_path('css/tambahData.css') }}">
    @else
        <!-- Untuk Web -->
        <link rel="stylesheet" href="{{ asset('css/font.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/mapbox.css') }}">
        <link rel="stylesheet" href="{{ asset('css/mapbox2.css') }}">
        <link rel="stylesheet" href="{{ asset('css/mapbox-gl.css') }}">
        <link rel="stylesheet" href="{{ asset('css/tambahData.css') }}">
    @endif --}}
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mapbox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mapbox2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mapbox-gl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tambahData.css') }}">

    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" /> --}}

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/images/logoCarbonStockID-LightMode.png') }}" type="image/x-icon" />
    <title>@yield('title')</title>
</head>

<body>
    <!-- Navbar -->
    {{-- <nav class="navbar navbar-expand-lg bg-transparent w-100">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard') }}" class="burger-button">
                    <img src="{{ asset('/images/leftProfile.svg') }}" alt="Burger Menu" class="burger-icon" />
                </a>
                <a class="navbar-brand d-flex align-items-center ms-3" href="#">
                    <img src="{{ asset('/images/logoCarbonStockID-DarkMode.png') }}" alt="Logo" width="30"
                        class="d-inline-block align-middle me-2" />
                    <span>CarbonStockID</span>
                </a>
            </div>
            <div class="d-flex align-items-center">
                <button class="btn btn-light btn-plot-area d-flex justify-content-between align-items-center">
                    <span>Plot Area</span>
                    <img src="{{ asset('/images/CaretUpFill.svg') }}" alt="Caret Icon" />
                </button>
                <div class="dropdown-plot-area" id="dropdownPlotArea" style="display: none">
                    <ul>
                        <li class="header-dropdown">Plot Area</li>
                        <li id="plotA">Sub Plot A</li>
                        <li id="plotB">Sub Plot B</li>
                        <li id="plotC">Sub Plot C</li>
                        <li id="plotD">Sub Plot D</li>
                        <li id="hasilHitung" class="akhir">Hasil Hitung</li>
                    </ul>
                </div>
                <img src="{{ asset('/images/userIcon.png') }}" alt="User Avatar" id="userIcon"
                    class="ms-3 user-avatar" />
                <div class="user-profile-dropdown" id="userProfileDropdown" style="display: none">
                    <div class="user-info">
                        <img src="{{ asset('/images/userIcon.png') }}" alt="User Avatar" class="user-avatar" />
                        <div class="user-details">
                            <h4>Chistoper Govert</h4>
                            <p>chistoper@gmail.com</p>
                        </div>
                    </div>
                    <hr />
                    <div class="user-options">
                        <div class="option">
                            <img class="me-1" src="{{ asset('/images/PersonFill.svg') }}" alt="" />
                            <a href="{{ url('/profile') }}"><span>Profil Saya</span></a>
                        </div>
                        <div class="option">
                            <img class="ms-1 me-1" src="{{ asset('/images/majesticons_logout.svg') }}"
                                alt="" />
                            <a href="{{ url('') }}"><span>Keluar</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav> --}}

    <div class="container">
        <div class="table-container">
            <div class="">
                <div class="h2-pancang-container section-hasil">
                    <h2 class="h2-tiang">Ringkasan Hitungan</h2>
                </div>
                {{-- <div class="frame-no-data">
                        <img src="{{ asset('/images/imageNoData.svg') }}" alt="" />
                        <p>Data yang Anda masukkan masih kosong. Mohon lengkapi semua informasi yang diperlukan.</p>
                    </div> --}}
                <form method="GET"
                    action="{{ route('downloadRingkasan.ringkasan', ['slug' => $poltArea->slug ?? 'default-slug']) }}">
                    <div class="table-header-hasil d-flex">
                        {{-- <a href="/Lokasi/zona/hitung/pdf" class="btn btn-unduhPDF"> Unduh PDF</a> --}}
                        <button class="btn btn-unduhPDF" id="averageData">Unduh PDF</button>
                    </div>
                </form>
                <div class="plot-info">
                    <p>Nama : {{ $user->nama }}</p>
                    <p>Daerah Plot : {{ $poltArea->daerah }}</p>
                    <p>Latitude :{{ $poltArea->latitude }}</p>
                    <p>Longitude : {{ $poltArea->longitude }}</p>
                </div>
                <div class="row mb-3">
                    @foreach ($ringkasan as $item)
                        {{-- <div class="col-lg-3 col-md-4 col-sm-6 mb-3"> --}}
                        <div class=" sm-3">
                            <div class="card  border-light shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title text-center text-success">Pendekatan Kerapatan</h5>
                                    <p class="card-text text-center text-muted">
                                        <strong>{{ $item['zona'] ?? 'Data tidak tersedia' }}</strong>
                                    </p>
                                    <div class="mt-3">
                                        <p class="text-dark">Biomassa di atas permukaan tanah (ton/ha):</p>
                                        <p class="card-text text-start text-success ">
                                            {{ $item['Biomassadiataspermukaantanah'] ?? 0 }}</p>
                                    </div>
                                    <div class="mt-3">
                                        <p class="text-dark">Kandungan karbon (ton/ha):</p>
                                        <p class="card-text text-start text-success ">
                                            {{ $item['Kandungankarbon'] ?? 0 }}
                                        </p>
                                    </div>
                                    <div class="mt-3">
                                        <p class="text-dark">Serapan CO2 (ton/ha):</p>
                                        <p class="card-text text-start text-success ">
                                            {{ $item['SerapanCO2'] ?? 0 }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @foreach ($ringkasann as $item)
                    <div class=" m-3   ">
                        <div class="col-md-6  height-card box-margin">
                            <div class="card  text-center">
                                <div class="card-body ">
                                    <h4 class="card-title mb-0">Summary Kandungan Karbon</h4>
                                    <p class="mb-3">Bagian ini untuk menampilkan hitungan total kandungan karbon
                                        untuk lokasi
                                        {{ $poltArea->daerah }}</p>

                                    <div class="table-wrapper ">
                                        <table class=" custom-table-pancang table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Subplot</th>
                                                    <th class="text-right text-center">Karbon</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Seresah</td>
                                                    <td class="  btn-successs text-center">

                                                        {{ $item['SerasahKarbon'] ?? 0 }} Ton C/Ha

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Semai</td>
                                                    <td class="  btn-successs text-center">

                                                        {{ $item['semaiKarbon'] ?? 0 }} Ton C/Ha

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tumbuhan Bawah</td>
                                                    <td class="  btn-successs text-center">

                                                        {{ $item['tumbuhanbawahkarbon'] ?? 0 }} Ton
                                                        C/Ha

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Pancang</td>
                                                    <td class="  btn-successs text-center">

                                                        {{ $item['TotalPancangkarbon'] ?? 0 }} Ton
                                                        C/Ha

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Tiang</td>
                                                    <td class="  btn-successs text-center">

                                                        {{ $item['TotalTiangKarbon'] ?? 0 }} Ton
                                                        C/Ha

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Nekromas</td>
                                                    <td class="  btn-successs text-center">

                                                        {{ $item['NecromassCarbon'] ?? 0 }} Ton
                                                        C/Ha
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Pohon</td>
                                                    <td class="  btn-successs text-center">

                                                        {{ $item['TotalPohonkarbon'] ?? 0 }} Ton
                                                        C/Ha

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Tanah</td>
                                                    <td class="  btn-successs text-center">

                                                        {{ $item['TanahCarbon'] ?? 0 }} Ton C/Ha

                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td>Total</td>
                                                    <td class="  btn-successs text-center">

                                                        {{ $item['TotalKandunganKarbon'] ?? 0 }}
                                                        Ton C/Ha

                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6  height-card box-margin">
                            <div class="card  text-center">
                                <div class="card-body ">
                                    <h4 class="card-title mb-0">Summary Serapan CO2</h4>
                                    <p class="mb-3">Bagian ini untuk menampilkan hitungan total serapa CO2 untuk
                                        lokasi
                                        {{ $poltArea->daerah }}</p>

                                    <div class="table-wrapper ">
                                        <table class=" custom-table-pancang table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Subplot</th>
                                                    <th class="text-right text-center">Karbon</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Seresah</td>
                                                    <td class="  btn-successs text-center">

                                                        {{ $item['Serasahco2'] ?? 0 }} Ton C/Ha

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Semai</td>
                                                    <td class="  btn-successs text-center">
                                                        {{ $item['semaico2'] ?? 0 }}
                                                        Ton C/Ha

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tumbuhan Bawah</td>
                                                    <td class="  btn-successs text-center">

                                                        {{ $item['tumbuhanbawahco2'] ?? 0 }} Ton
                                                        C/Ha

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Pancang</td>
                                                    <td class="  btn-successs text-center">

                                                        {{ $item['TotalPancangco2'] ?? 0 }} Ton
                                                        C/Ha

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Tiang</td>
                                                    <td class="  btn-successs text-center">

                                                        {{ $item['TotalTiangco2'] ?? 0 }} Ton C/Ha

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Nekromas</td>
                                                    <td class="  btn-successs text-center">

                                                        {{ $item['Necromassco2'] ?? 0 }} Ton C/Ha

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Pohon</td>
                                                    <td class="  btn-successs text-center">

                                                        {{ $item['TotalPohonco2'] ?? 0 }} Ton C/Ha

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Tanah</td>
                                                    <td class="  btn-successs text-center">
                                                        {{ $item['TanahCo2'] ?? 0 }}
                                                        Ton C/Ha

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Akar</td>
                                                    <td class="  btn-successs text-center">

                                                        {{ $item['beratMasaAkar'] ?? 0 }} Ton C/Ha

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Total</td>
                                                    <td class="  btn-successs text-center">
                                                        {{ $item['KarbonCo2'] ?? 0 }}
                                                        Ton C/Ha

                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row mt-4">
                        <div class="card">

                            <div class="card-body">
                                <h4 class="card-title mb-4">Rekapan Perhitungan Carbon 5 Poll Di
                                    {{ $poltArea->daerah }}</h4>


                                <div class="table-wrapper table-responsive">
                                    <table class="custom-table-pancang table-striped table">
                                        <thead>
                                            <tr>
                                                <th class="kiriPancang">No</th>
                                                <th>Nama Penghitungan</th>
                                                <th>Total CO2</th>
                                                <th>Luas Tanah (ha)</th>
                                                <th>Total</th>
                                                <th class="hidden-column kananPancang">Persen</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="">1</td>
                                                <td>Serasah</td>
                                                <td>{{ $item['Serasahco2'] ?? 0 }} Ton C/Ha</td>
                                                <td>{{ $item['faktor'] ?? 0 }} Ha</td>
                                                <td>{{ $item['Serasah'] ?? 0 }} Ton C/Ha</td>
                                                <td>{{ $item['hasilSerasahPersen'] ?? 0 }} %</td>
                                                {{-- {{ dd($item) }} --}}
                                            </tr>
                                            <tr>
                                                <td class="">2</td>
                                                <td>Necromass</td>
                                                <td>{{ $item['Necromassco2'] ?? 0 }} Ton C/Ha</td>
                                                <td>{{ $item['faktor'] ?? 0 }} Ha</td>
                                                <td>{{ $item['Necromass'] ?? 0 }} Ton C/Ha</td>
                                                <td>{{ $item['hasilNecromassPersen'] ?? 0 }} %</td>

                                            </tr>
                                            <tr>
                                                <td class="">3</td>
                                                <td>Co2 Tanaman</td>
                                                <td>{{ $item['TotalCarbonn'] ?? 0 }} Ton C/Ha</td>
                                                <td>{{ $item['faktor'] ?? 0 }} Ha</td>
                                                <td>{{ $item['Co2Tanaman'] ?? 0 }} Ton C/Ha</td>
                                                <td>{{ $item['hasilco2tanamanPersen'] ?? 0 }} %</td>

                                            </tr>
                                            <tr>
                                                <td class="">4</td>
                                                <td>Tanah</td>
                                                <td>{{ $item['TanahCo2'] ?? 0 }} Ton C/Ha</td>
                                                <td>{{ $item['faktor'] ?? 0 }} Ha</td>
                                                <td>{{ $item['tanah'] ?? 0 }} Ton C/Ha</td>
                                                <td>{{ $item['hasiltanahPersen'] ?? 0 }} %</td>

                                            </tr>
                                            <tr>
                                                <td class="">5</td>
                                                <td>Berat bioomasa akar</td>
                                                <td>{{ $item['beratMasaAkar'] ?? 0 }} Ton C/Ha</td>
                                                <td>{{ $item['faktor'] ?? 0 }} Ha</td>
                                                <td>{{ $item['BeratBiomassaAkar'] ?? 0 }} Ton C/Ha</td>
                                                <td>{{ $item['hasilakarPersen'] ?? 0 }} %</td>

                                            </tr>
                                            <tr>
                                                <td colspan="4">Total Carbon 5 Poll</td>
                                                <td colspan="2">{{ $item['TotalKaoobon'] ?? 0 }} Ton </td>

                                            </tr>
                                            <tr>
                                                <td colspan="4">Baseline Lahan Kosong</td>
                                                <td colspan="2">{{ $item['BaselineLahanKosong'] ?? 0 }} Ton
                                                    C/Ha
                                                </td>

                                            </tr>
                                            {{-- @foreach ($pancang as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->keliling }} cm</td>
                                            <td>{{ $item->diameter }} cm</td>
                                            <td>{{ $item->nama_lokal }}</td>
                                            <td>{{ $item->nama_ilmiah }}</td>
                                            <td class="hidden-column">{{ $item->kerapatan_jenis_kayu }}gr/cm3</td>
                                            <td class="hidden-column">{{ $item->bio_di_atas_tanah }} kg</td>
                                            <td class="hidden-column">{{ $item->kandungan_karbon }}kg</td>
                                            <td class="hidden-column">{{ $item->co2 }} kg</td>
                                            <td class="hidden-column aksi-button">
                                                <button class="edit-btn">
                                                    <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                                </button>
                                                <button class="delete-btn">
                                                    <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    {{-- <script src="https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js"></script> --}}
    {{-- <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script> --}}
    <!-- Chart.js -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <!-- Custom JS -->
    {{-- <script src="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js"></script> --}}
    <script src="{{ asset('/js/chart.js') }}"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js"></script>
    <script src="{{ asset('/js/mapbox-gl-geocoder.js') }}"></script>
    <script src="{{ asset('/js/mapbox-gl.js') }}"></script>
    <script src="{{ asset('/js/mapbox-gll.js') }}"></script>
    <script src="{{ asset('/js/tambahData.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>

    <!-- Bootstrap JS Bundle with Popper -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toastEl = document.getElementById('myToast');
            var toast = new bootstrap.Toast(toastEl, {
                delay: 3000 // Menghilang setelah 1 detik
            });

            toast.show(); // Menampilkan toast saat halaman dimuat
        });
    </script>
</body>

</html>
