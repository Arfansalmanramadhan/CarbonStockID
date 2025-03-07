@extends('layout.layaout')

@section('title', 'Tambah Hamparan')

@section('content')
    <div class="container-tambah-data mt-5" id="currentContent">
        <div class="container-isi">
            <div class="card plot-info-card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="ms-3 mt-2">Tambah data Hamparan</h5>
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
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <!-- Form -->
                    <dd></dd>
                    <form method="POST" action="{{ route('Hamparan.store', ['slug' => $zona->slug]) }}" id="plotAreaForm">
                        @csrf
                        {{-- <input type="hidden" id="polt-area_id" name="polt-area_id" value="{{ $poltArea->id }}" /> --}}
                        <div class="mb-4">
                            <label for="plotName" class="form-label">Hamparan Area</label>
                            <select class="form-select  form-control" aria-label="Default select example" name="nama_hamparan">
                                <option selected>Hamparan</option>
                                <option value="Hamparan 1">Hamparan 1</option>
                                <option value="Hamparan 2">Hamparan 2</option>
                                <option value="Hamparan 3">Hamparan 3</option>
                                <option value="Hamparan 4">Hamparan 4</option>
                                <option value="Hamparan 5">Hamparan 5</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control-non" name="latitude" id="latitude" />
                        </div>
                        <div class="mb-4">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control-non" name="longitude" id="longitude" />
                        </div>
                        <button type="submit" class="btn btn-success" id="submitButton">Submit</button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
@endsection
