@extends('layout.layaout')

@section('title', 'TambahZona')

@section('content')
    <div class="container-tambah-data mt-5" id="currentContent">
        <div class="container-isi">
            <div class="card plot-info-card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="ms-3 mt-2">Edit Data Surveyor</h5>
                    @session('success')
                        {{-- <h5 class="ms-3 mt-2">sdsadsa</h5> --}}
                        <div class="toast position-fixed left-0 bottom-0 z-3 ms-4 p-2 mb-3" role="alert" aria-live="assertive"
                            aria-atomic="true" id="myToast">
                            <div class="toast-header border-0">
                                {{-- <img src="..." class="rounded me-2" alt="..."> --}}
                                <strong class="me-auto">Data berhasil dikirim!</strong>
                                {{-- <small>11 mins ago</small> --}}
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Data berhasil dikirim!
                            </div>
                        </div>
                    @endsession
                </div>
                <div class="card-body">
                    <!-- Map Section -->
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <!-- Form -->
                    <dd></dd>
                    <form method="POST" action="{{ route('Surveyor.update', ['slug' => $user->slug]) }}" id="plotAreaForm">
                        @csrf
                        @method('PUT')
                        {{-- <input type="hidden" id="polt-area_id" name="polt-area_id" value="{{ $poltArea->id }}" /> --}}
                        <div class="mb-4">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" id="nama"
                                value="{{ old('nama', $user->nama) }}" />
                        </div>
                        <div class="mb-4">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username"
                                value="{{ old('username', $user->username) }}" />
                        </div>
                        <div class="mb-4">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" name="nip" id="nip"
                                value="{{ old('nip', $user->nip) }}" />
                        </div>

                        <div class="mb-4">
                            <label for="no_hp" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" name="no_hp" id="no_hp"
                                value="{{ old('no_hp', $user->no_hp) }}" />
                        </div>
                        <div class="mb-4">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" name="nik" id="nik"
                                value="{{ old('nik', $user->nik) }}" />
                        </div>
                        <button type="submit" class="btn btn-success" id="submitButton">Submit</button>
                        </a>
                    </form>
                </div>
            </div>
            <div class="d-flex jarak ">
                <div class="option m-2">
                    <a href="{{ route('Surveyor.surveyor') }}" class=" btn btn-back " id="submitButton"><img
                            src="{{ asset('/images/ArrowLeft.svg') }}" alt="Arrow Icon" class="ms-2" />
                        <span>Sebelumnya</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
@endsection
