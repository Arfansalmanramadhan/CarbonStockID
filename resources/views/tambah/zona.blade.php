@extends('layout.layaout')

@section('title', 'Buku')

@section('content')

    <!-- Konten baru yang akan ditampilkan -->
    <div class="container-tambah-data hidden mt-5" id="newContent">
        <div class="container-isi">
            <div class="card plot-info-card batas">
                <div class="card-header d-flex align-items-center">
                    <img class="ms-3 toggle-chevron" src="assets/img/ChevronDown.svg" alt="" />
                    <h5 class="ms-3 mt-2">Zona Area</h5>
                </div>
                <div class="card-body-sup-plot">
                    <div id="map" style="width: 100%; height: 400px;"></div>
                    <!-- Form -->
                    <form method="POST" action="{{ route('zona.store') }}" id="SerasahForm">
                        @csrf
                        <input type="hidden" id="polt-area_id" name="polt-area_id" value="{{ $poltArea->id }}" />
                        <div class="mb-3">
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
                            <input type="text" class="form-control" placeholder="Latitude" name="latitude" id="latitude"
                                required />
                        </div>

                        <!-- Input Longitude -->
                        <div class="mb-4">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control" placeholder="Longitude" name="longitude"
                                id="longitude" required />
                        </div>
                        <div class="mb-3">
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
                        <button type="submit" class="btn btn-submit-plotA d-flex align-items-center justify-content-center"
                            id="submitSerasah">
                            <span>Submit</span>
                        </button>
                    </form>
                </div>
            </div>
            {{-- <div class="d-flex jarak">
                <div class="option">
                    <a href="{{ route('PlotArea.index') }}" class=" btn btn-back  " id="submitButton">
                        <img src="{{ asset('/images/ArrowLeft.svg') }}" alt="Arrow Icon" class="ms-2" />
                        <span>Sebelumnya</span>
                    </a>
                </div>
                <div class="option">
                    <a href="{{ route('PlotA.index') }}" class=" btn btn-success " id="submitButton"><span>Berikutnya</span>
                        <img src="{{ asset('/images/ArrowRight.svg') }}" alt="Arrow Icon" class="ms-2" />
                    </a>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
