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
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}" />

    <!-- Logo Title -->
    <link rel="icon" href="{{ asset('/images/logoCarbonStockID-LightMode.png') }}" type="image/x-icon" />
    <title>CarbonStockID</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-transparent w-100">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard') }}" class="burger-button">
                    <img src="{{ asset('images/leftProfile.svg') }}" alt="Burger Menu" class="burger-icon" />
                </a>
                <a class="navbar-brand d-flex align-items-center ms-3" href="#">
                    <img src="{{ asset('images/logoCarbonStockID-DarkMode.png') }}" alt="Logo" width="30"
                        class="d-inline-block align-middle me-2" />
                    <span>CarbonStockID</span>
                </a>
            </div>
            <div class="d-flex align-items-center">
                <img src="{{ $user->foto ? asset($user->foto) : asset('/images/PersonFill.svg') }}" alt="User Avatar"
                    id="userIcon" class="ms-3 user-avatar" />
            </div>
        </div>
    </nav>

    <!-- Profile Form Section -->
    <section class="container-form mt-5 profile-card">
        <div class="image-container">
            <img src="{{ asset('images/frameProfile.svg') }}" alt="" class="img-normal" />
            <div class="text-overlay">
                <p class="large-text">Profil Pengguna</p>
            </div>
        </div>
        <div class="card p-4 shadow-sm">
            <div class="card-body">
                <form class="form" id="profileForm" action="{{ route('profile.update', $user->slug) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="registrasi_id" name="registrasi_id" value="{{ $user->id }}"
                        enctype="multipart/form-data">
                    <div class="profile-container d-flex align-items-center">
                        <img id="previewImage"
                            src="{{ $user->foto ? asset($user->foto) : asset('/images/profileImage.svg') }}"
                            alt="User Photo" width="168" />
                        <div>
                            <button type="button" class="btn btn-success mb-2" id="uploadButton">Pilih Foto</button>
                            <input type="file" class="foto-image" name="foto" id="fileInput" accept="image/*"
                                style="display: none">
                            <p class="text-muted">Gambar Profile Anda sebaiknya memiliki rasio 1:1 dan berukuran tidak
                                lebih dari 2MB.</p>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="nama" class="form-label ms-1">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Masukan nama lengkap" value="{{ old('nama', $user->nama) }}" />
                    </div>
                    {{-- {{ Auth::user() }} --}}
                    <div class="mb-2">
                        <label for="username" class="form-label ms-1">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Masukan Username" value="{{ old('username', $user->username) }}" />
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label ">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Masukan Email" value="{{ old('email', $user->email) }}"" />
                    </div>
                    <div class="mb-2">
                        <label for="nip" class="form-label ">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip"
                            placeholder="Masukan NIP" value="{{ old('nip', $user->nip) }}" />
                    </div>
                    <div class="mb-2">
                        <label for="no_hp" class="form-label ">Nomor Telepon</label>
                        <input type="text" class="form-control" name="no_hp" id="no_hp"
                            placeholder="Masukan no Telepon" value="{{ old('no_hp', $user->no_hp) }}" />
                    </div>
                    <div class="mb-2">
                        <label for="nik" class="form-label ">NIK</label>
                        <input type="text" class="form-control" name="nik" id="nik"
                            placeholder="masukan NIK" value="{{ old('nik', $user->nik) }}" />
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Foto KTP</label>
                        <input class="form-control" type="file"
                            id="formFile"accept="image/jpeg,image/png,image/jpg,application/pdf" name="foto_ktp"
                            value="{{ old('foto_ktp', $user->foto_ktp) }}">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Tanda tangan digital</label>
                        <input class="form-control" type="file"
                            id="formFile"accept="image/jpeg,image/png,image/jpg,application/pdf"
                            name="foto_tandatangan" value="{{ old('foto_tandatangan', $user->foto_tandatangan) }}">
                    </div>

                    <button type="submit" class="btn btn-simpan-perubahan">Simpan Perubahan</button>
                </form>

                <!-- Pop-up Box -->
                <div id="popup" class="popup-container">
                    <div class="popup-content">
                        <img src="{{ asset('images/HandThumbsUpFill.svg') }}" alt="Success Icon"
                            class="success-icon" />
                        <h2>Perubahan berhasil disimpan</h2>
                        <p>Pembaruan pada profil kamu berhasil disimpan. Jangan ragu untuk melakukan perubahan lainnya
                            kapan saja.</p>
                        <button id="popup-close" class="btn btn-success-oke">Oke</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Custom JS -->
    <script src="{{ asset('js/profile.js') }}"></script>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
