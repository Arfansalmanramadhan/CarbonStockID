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
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <!-- Form -->
                    <dd></dd>
                    <form method="POST" action="{{ route('zona.store', ['id' => $poltArea->id]) }}" id="plotAreaForm">
                        @csrf
                        {{-- <input type="hidden" id="polt-area_id" name="polt-area_id" value="{{ $poltArea->id }}" /> --}}
                        <div class="mb-4">
                            <label for="plotName" class="form-label">Zona Area</label>
                            <select class="form-select  form-control" aria-label="Default select example" name="zona">
                                <option selected>Zona</option>
                                <option value="Zona 1">Zona 1</option>
                                <option value="Zona 2">Zona 2</option>
                                <option value="Zona 3">Zona 3</option>
                                <option value="Zona 4">Zona 4</option>
                                <option value="Zona 5">Zona 5</option>
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

                        <div class="mb-4">
                            <label for="plotName" class="form-label">Jenis hutan</label>
                            <select class="form-select  form-control" aria-label="Default select example"
                                name="jenis_hutan">
                                <option selected>Jenis hutan</option>
                                <option value="Hutan Tropis">Hutan Tropis</option>
                                <option value="Hutan Bakau">Hutan Bakau</option>
                                <option value="Hutan Sabana">Hutan Sabana</option>
                                <option value="Hutan Rawa Gambut">Hutan Rawa Gambut</option>
                                <option value="Hutan Musim ">Hutan Musim </option>
                                <option value="Hutan Homongen ">Hutan Homongen </option>
                                <option value="Hutan Heterogen ">Hutan Heterogen </option>
                                <option value="Hutan Lindung ">Hutan Lindung </option>
                                <option value="Hutan Suaka Alam ">Hutan Suaka Alam </option>
                                <option value="Hutan Produksi ">Hutan Produksi </option>
                            </select>
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
