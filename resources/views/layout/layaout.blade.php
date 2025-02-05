<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Inter:wght@400;700&display=swap"
        rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/tambahData.css') }}" />

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/images/logoCarbonStockID-LightMode.png') }}" type="image/x-icon" />
    <title>@yield('title')</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-transparent w-100">
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
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <!-- Custom JS -->
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js"></script>
    <script src="{{ asset('/js/tambahData.js') }}"></script>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
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
