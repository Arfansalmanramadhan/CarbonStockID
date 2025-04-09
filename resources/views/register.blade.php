<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/font.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/styleRegister.css') }}" />

    <!-- Logo Title -->
    <link rel="icon" href="{{ asset('/images/logoCarbonStockID-LightMode.png') }}" type="image/x-icon" />
    <title>CarbonStockID</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row vh-100">
            <!-- Left Side -->
            <div class="col-lg-6 position-relative d-none d-lg-block left-side">
                <div class="bg-holder" style="background-image: url({{ asset('/images/frameLogin.svg') }})"></div>
                <div class="navbar-brand d-flex align-items-center position-absolute content-overlay text-center">
                    <img src="{{ asset('/images/logoCarbonStockID-DarkMode.png') }}" alt="Logo" width="30"
                        class="d-inline-block align-middle me-2" />
                    <span>CarbonStockID</span>
                </div>
                <div
                    class="penjelasan position-absolute top-50 start-50 translate-middle text-white text-center p-3 content-overlay">
                    <h2>Hitung, Kelola dan Prediksi Cadangan Karbon Jadi Mudah dan Efisien</h2>
                    <p>Daftarkan akun anda! untuk menikmati fitur - fitur platform CarbonStockID.</p>
                </div>
            </div>
            <!-- Right Side -->
            <div class="right-side col-lg-6 d-flex align-items-center">
                <div class="w-100">
                    {{-- Pesan sukses/error --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="judul mb-3">
                        <h1>Buat Akun Anda</h1>
                    </div>
                    <form id="FormLogin" action="{{ route('daftar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" class="form-control" id="name" name="username"
                                placeholder="Masukkan username" />
                        </div>
                        <div class="mb-2">
                            <label for="name" class="form-label">Nama lengkap</label>
                            <input type="text" class="form-control" id="name" name="nama"
                                placeholder="Masukkan nama lengkap" />
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukkan Email" />
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Sandi</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Masukkan Sandi" />
                        </div>
                        <div class="mb-2">
                            <label for="password_confirmation" class="form-label">Konfirmasi Sandi</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Masukkan Sandi" />
                        </div>
                        <div class="mb-2">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip"
                                placeholder="Masukkan nip" />
                        </div>
                        <div class="mb-2">
                            <label for="no_hp" class="form-label ">Nomor Telepon</label>
                            <input type="text" class="form-control" name="no_hp" id="no_hp"
                                placeholder="Masukan no Telepon" />
                        </div>
                        <div class="mb-2">
                            <label for="formFile" class="form-label">Foto Pribadi</label>
                            <input class="form-control" type="file"
                                id="formFile"accept="image/jpeg,image/png,image/jpg" name="foto">
                        </div>
                        <div class="mb-2">
                            <label for="formFilektp" class="form-label">Foto KTP</label>
                            <input class="form-control" type="file"
                                id="formFilektp"accept="image/jpeg,image/png,image/jpg" name="foto_ktp">
                        </div>
                        <button type="submit" class="btn btn-success w-100 mb-2">Daftar</button>
                        <div class="teks text-center">
                            <p>
                                Anda sudah memiliki akun?
                                <a href="{{ route('login') }}" class="daftar">Masuk</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="{{ asset('/js/scriptRegister.js') }}"></script> --}}

    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script>
        document.getElementById("formFile").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    alert("File harus berukuran tidak lebih dari 2MB.");
                    event.target.value = "";
                    return;
                }

                const img = new Image();
                img.src = URL.createObjectURL(file);

                img.onload = function() {
                    const width = img.width;
                    const height = img.height;

                    if (width !== height) {
                        alert("File harus memiliki rasio 1:1.");
                        event.target.value = "";
                    } else {
                        const profileImage = document.querySelector('img[alt="User Photo"]');
                        profileImage.src = img.src;
                        profileImage.style.borderRadius = "8px";
                    }

                    URL.revokeObjectURL(img.src);
                };
            }
        });
        document.getElementById("formFilektp").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    alert("File harus berukuran tidak lebih dari 2MB.");
                    event.target.value = "";
                    return;
                }

                const img = new Image();
                img.src = URL.createObjectURL(file);

                img.onload = function() {
                    const width = img.width;
                    const height = img.height;
                    const ratio = width / height;
                    const expectedRatio = 4 / 3;

                    if (Math.abs(ratio - expectedRatio) > 0.01) {
                        alert("File harus memiliki rasio 4:3.");
                        event.target.value = "";
                    } else {
                        const profileImage = document.querySelector('img[alt="User Photo"]');
                        profileImage.src = img.src;
                        profileImage.style.borderRadius = "8px";
                    }

                    URL.revokeObjectURL(img.src);
                };
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
