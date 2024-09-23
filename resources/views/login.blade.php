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
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/styleLogin.css') }}" />

    <!-- Logo Title -->
    <link rel="icon" href="{{ asset('/images/logoCarbonStockID-LightMode.png') }}" type="image/x-icon" />
    <title>CarbonStockID</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row vh-100">
        <!-- Left Side -->
        <div class="left-side col-lg-6 d-flex align-items-center">
          <div class="w-100">
            <div class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('/images/logoCarbonStockID-DarkMode.png') }}" alt="Logo" width="30" class="d-inline-block align-middle me-2" />
              <span>CarbonStockID</span>
            </div>
            <div class="judul mb-4">
              <h1>Masuk ke Akun Anda</h1>
            </div>
            <form action="{{ route('login') }}" method="POST">
              @csrf
              <div class="mb-2">
                <label for="email" class="form-label">Email / Username</label>
                <input type="text" name="email" class="form-control" id="email" placeholder="Masukkan Email / Username" />
              </div>
              <div class="mb-2">
                <label for="password" class="form-label">Sandi</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Sandi" />
              </div>
              <button type="submit" class="btn-success w-100">Masuk</button>
              <p class="masuk-dengan text-center mt-2 mb-2"><span>Atau masuk dengan</span></p>
              <a type="button" class="btn btn-outline-dark w-100 mt-2" href="dashboard.html">
                <img src="{{ asset('/images/iconGoogle.png') }}" alt="Google Icon" class="me-2" style="width: 20px" />
                Masuk dengan Google
              </a>
              <div class="teks text-center">
                <p>
                  Anda belum memiliki akun?
                  <a href="{{ route('register') }}" class="daftar">Daftar</a>
                </p>
              </div>
            </form>
            
            @if(session('success'))
                <div>{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div>{{ session('error') }}</div>
            @endif
          </div>
        </div>
        <!-- Right Side -->
        <div class="col-lg-6 position-relative d-none d-lg-block right-side">
          <div class="bg-holder" style="background-image: url({{ asset('/images/frameLogin.svg') }})"></div>
          <div class="penjelasan position-absolute top-50 start-50 translate-middle text-white text-center p-3 content-overlay">
            <h2>Hitung, Kelola dan Prediksi Cadangan Karbon Jadi Mudah dan Efisien</h2>
            <p>Masuk ke akun anda! untuk menikmati fitur - fitur platform CarbonStockID.</p>
          </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('/js/scriptLogin.js') }}"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cpNmN1hPckj2KdUMJj6UG4l3kNxodFjGkOn37cTh/j04WIF6P2R9Qkz5gMYZXLoN" crossorigin="anonymous"></script>
  </body>
</html>
