<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    {{-- <link href="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css" rel="stylesheet" /> --}}

    <!-- Bootstrap CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" /> --}}

    <!-- Google Fonts -->
    <link rel="stylesheet" href="{{ asset('css/font.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/mapbox.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/mapbox2.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/mapbox-gl.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/tambahData.css') }}" />



    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" /> --}}

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
            {{-- <div class="d-flex align-items-center">

                <img src="{{ asset('/images/logoCarbonStockID-DarkMode.png') }}" alt="User Avatar" id="userIcon"
                    class="ms-3 user-avatar" />
                <div class="user-profile-dropdown" id="userProfileDropdown" style="display: none">
                    <div class="user-info">
                        <img src="{{ asset('/images/logoCarbonStockID-DarkMode.png') }}" alt="User Avatar"
                            class="user-avatar" />
                        <div class="user-details">
                            <h4>{{ $user->username }}</h4>
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>
                    <hr />
                    <div class="user-options">
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
            </div> --}}
        </div>
    </nav>

    <div class="container">
        @yield('content')
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
