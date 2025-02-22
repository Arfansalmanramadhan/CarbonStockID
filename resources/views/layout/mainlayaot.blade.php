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
    <link rel="stylesheet" href="{{ asset('css/styleDashboard.css') }}" />

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-financial"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <!-- Favicon -->
    <link rel="icon" href="{{ $user->image ? asset($user->image) : asset('/images/PersonFill.svg') }}"
        type="image/x-icon" />
    <title>@yield('title')</title>

    <!-- LineIcons -->
    <link rel="stylesheet" href="https://cdn.lineicons.com/5.0/lineicons.css" />
</head>

<body>

    {{-- <main class="main d-flex flex-column justify-content-between"> --}}
    <main class="d-flex flex-column justify-content-between">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary bg-light">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    {{-- <button class="burger-button" type="button" data-bs-target="#sidebar" aria-controls="sidebar"
                        aria-expanded="false">
                        <img src="{{ asset('/images/burgerIcon.png') }}" alt="Burger Menu" class="burger-icon" />
                    </button> --}}
                    <a class="navbar-brand d-flex align-items-center ms-3" href="#">
                        <img src="{{ asset('/images/logoCarbonStockID-DarkMode.png') }}" alt="Logo" width="30"
                            class="d-inline-block align-middle me-2" />
                        <span>CarbonStockID</span>
                    </a>
                </div>
                <div class="d-flex align-items-center">
                    <form class="d-flex me-2 position-relative" role="search">
                        <input class="form-control search-input" type="search" placeholder="Cari..."
                            aria-label="Search" />
                        <img src="{{ asset('/images/iconSearch.png') }}" alt="Search Icon" class="search-icon" />
                    </form>
                    <a href="{{ url('/PlotArea') }}" class="btn btn-light btn-tambahData">Tambah data</a>
                    <img src="{{ $user->image ? asset($user->image) : asset('/images/PersonFill.svg') }}"
                        alt="User Avatar" id="userIcon" class="ms-3 user-avatar" />
                    <div class="user-usere-dropdown parent-container " id="userProfileDropdown" style="display: none">
                        <div class="user-info">
                            <img src="{{ $user->image ? asset($user->image) : asset('/images/PersonFill.svg') }}"
                                alt="User Avatar" id="userIcon" class="ms-3 user-avatar" />
                            <div class="user-details">
                                <h4>{{ $user->username }}</h4>
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                        <hr />
                        <div class="user-options">
                            <div class="option">
                                <img class="me-1" src="{{ asset('/images/PersonFill.svg') }}" alt="" />
                                <a href="/profile/{{ $user->slug }}"><span>Profil Saya</span></a>
                                {{-- <a href="{{ route('profile.index',Auth::user()->slug]) }}"><span>Profil Saya</span></a> --}}
                            </div>
                            <div class="option">
                                <img class="ms-1 me-1" src="{{ asset('/images/majesticons_logout.svg') }}"
                                    alt="" />
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    <button type="submit"
                                        style="border: none; background: none; padding: 0; cursor: pointer;">
                                        <span>Keluar</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        {{-- <section class="d-flex main "> --}}
            <div class="wrapper">
                <aside id="sidebar">
                    <div class="d-flex">
                        <button id="toogle-btn" type="button">
                            <i class="lni lni-dashboard-square-1"></i>
                        </button>
                        <div class="sidebar-logo">
                            <a href="#">CarbonStockID</a>
                        </div>
                    </div>
                    <ul class="sidebar-nav">
                        <li class="sidebar-item">
                            <a href="dashboard" class="sidebar-link">
                                <i class="lni lni-home-2"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="panduan" class="sidebar-link">
                                <i class="lni lni-file-multiple"></i>
                                <span>Panduan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="Surveyor" class="sidebar-link">
                                <i class="lni lni-user-multiple-4"></i>
                                <span>Manajemen Tim</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">
                                <i class="lni lni-map-marker-1"></i>
                                <span>Lokasi</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">
                                <i class="lni lni-map-marker-5"></i>
                                <span>Zona</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="dataPlot" class="sidebar-link">
                                <i class="lni lni-notebook-1"></i>
                                <span>Data Plot</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="Verifikasi" class="sidebar-link">
                                <i class="lni lni-shield-2-check"></i>
                                <span>Verifikasi</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="Sampah" class="sidebar-link">
                                <i class="lni lni-trash-3"></i>
                                <span>Sampah</span>
                            </a>
                        </li>
                    </ul>
                </aside>
                <div class="main p-3">
                    {{-- <div class="text-center"> --}}
                        @yield('content')
                    {{-- </div> --}}
                </div>
            </div>
            {{-- <div class="row  h-100 ">
                <div class="sidebar col-lg-2 collapse d-lg-block bg-dark" id="sidebar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="d-flex align-items-center ms-3 nav-link   " href="dashboard">
                                <img src="{{ asset('/images/iconamoon_home-fill.svg') }}" alt="Home Icon" />
                                <span class="ms-2">Beranda</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center ms-3 nav-link   " href="panduan">
                                <img src="{{ asset('/images/FileEarmarkPdfFill.svg') }}" alt="Guide Icon" />
                                <span class="ms-2">Panduan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center ms-3 nav-link   " href="dataPlot">
                                <img src="{{ asset('/images/FolderFill.svg') }}" alt="Data Plot Icon" />
                                <span class="ms-2">Lokasi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center ms-3 nav-link   " href="dataPlot">
                                <img src="{{ asset('/images/FolderFill.svg') }}" alt="Data Plot Icon" />
                                <span class="ms-2">Hamparan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center ms-3 nav-link   " href="dataPlot">
                                <img src="{{ asset('/images/FolderFill.svg') }}" alt="Data Plot Icon" />
                                <span class="ms-2">Zona</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center ms-3 nav-link   " href="dataPlot">
                                <img src="{{ asset('/images/FolderFill.svg') }}" alt="Data Plot Icon" />
                                <span class="ms-2">Data Plot</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center ms-3 nav-link   " href="Surveyor">
                                <img src="{{ asset('/images/prediksiLogo.svg') }}" alt="Guide Icon" />
                                <span class="ms-2">Surveyor</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center ms-3 nav-link   " href="Verifikasi">
                                <img src="{{ asset('/images/prediksiLogo.svg') }}" alt="Guide Icon" />
                                <span class="ms-2">Verifikasi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center ms-3 nav-link   " href="Sampah">
                                <img src="{{ asset('/images/TrashFill.svg') }}" alt="Trash Icon" />
                                <span class="ms-2">Sampah</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main p-3">
                <div class="text-center">
                    @yield('content')
                </div>
            </div> --}}
        {{-- </section> --}}
    </main>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-financial"></script>

    <script src="{{ asset('js/scriptDashboard.js') }}"></script>
    <!-- Highcharts Library -->
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
