@extends('layout.layaout')

@section('title', 'TambahZona')

@section('content')
    <div class="container-tambah-data mt-5" id="currentContent">
        <div class="container-isi">
            <div class="card plot-info-card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="ms-3 mt-2">Tambah data zona</h5>
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
                    <div id="map"></div>

                    <!-- Form -->
                    <dd></dd>
                    <form method="POST" action="{{ route('plotarea.store') }}" id="plotAreaForm">
                        @csrf
                        <div class="mb-4">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control-non" name="latitude" id="latitude" />
                        </div>
                        <div class="mb-4">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control-non" name="longitude" id="longitude" />
                        </div>
                        <div class="mb-4">
                            <label for="plotName" class="form-label">Nama Zona</label>
                            <input type="text" class="form-control" name="daerah" id="plotName"
                                placeholder="Masukkan nama daerah pengamatan" />
                        </div>
                        <div class="mb-4">
                            <label for="plotName" class="form-label">Pilih Jenis Hutan</label>
                            <input type="text" class="form-control" name="daerah" id="plotName"
                                placeholder="Masukkan nama daerah pengamatan" />
                        </div>
                        <div class="mb-4">
                            <label for="fileUpload" class="form-label">Upload Foto Zona</label>
                            <input type="file" class="form-control" name="foto_zona" id="fileUpload" />
                        </div>
                        {{-- <input type="hidden" name="profil_id" value="{{ auth()->user()->user->id }}" /> --}}
                        <!-- pastikan user sudah login -->
                        <button type="submit" class="btn btn-success" id="submitButton">Submit</button>
                        {{-- <a href="{{ route('zona.index') }}" class=" btn btn-success " ><span>Submit</span> --}}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
@endsection
