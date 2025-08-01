@extends('layout.layaout')

@section('title', 'Edit Plot A')

@section('content')
    <div class="container-tambah-data hidden mt-5" id="newContent">
        <div class="container-isi">
            <div class="card plot-info-card batas">
                <div class="card-header d-flex align-items-center">
                    <img class="ms-3 toggle-chevron" src="assets/img/ChevronDown.svg" alt="" />
                    <h5 class="ms-3 mt-2">Sub Plot A - Serasah</h5>
                </div>
                <div class="card-body-sup-plot">
                    <!-- Form -->
                    <form method="POST" action="{{ route('Serasah.update', ['id' => $subplot->id]) }}" id="SerasahForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="subplot_id" name="subplot_id" value="{{ $subplot->id }}" />
                        <div class="mb-3">
                            <label for="plotName" class="form-label">Total Berat Basah</label>
                            <input type="text" class="form-control" name="total_berat_basah" id="TotalBeratBasah" value="{{ $serasah ? $serasah->total_berat_basah : ""}}"
                                placeholder="Masukkan total berat basah (gr)" />
                        </div>
                        <div class="mb-3">
                            <label for="plotName" class="form-label">Sample Berat Basah</label>
                            <input type="text" class="form-control" name="sample_berat_basah" id="SampleBeratBasah"  value="{{ $serasah ? $serasah->sample_berat_basah : ""}}"
                                placeholder="Masukkan sample berat basah (gr)" />
                        </div>
                        <div class="mb-3">
                            <label for="plotName" class="form-label">Sample Berat Kering</label>
                            <input type="text" class="form-control" name="sample_berat_kering" id="SampleBeratKering"  value="{{ $serasah ? $serasah->sample_berat_kering : ""}}"
                                placeholder="Masukkan sample berat kering (gr)" />
                        </div>
                        <div class="mb-3">
                            <label for="plotName" class="form-label">Total Berat Kering</label>
                            <input type="text" class="form-control-non" name="total_berat_kering" id="TotalBeratKering "
                                value="{{ $serasah ? $serasah->total_berat_kering : "" }} " readonly />
                        </div>
                        <p class="form-label">Kandungan Karbon
                            <span>{{ $serasah ? $serasah->kandungan_karbon : "" }} Kg</span>
                        </p>
                        <p class="form-label">Serapan CO<sub>2</sub> <span>{{ $serasah ?  $serasah->co2 : "" }} Kg</span></p>
                        {{-- <button type="submit"
                            class="btn btn-success d-flex align-items-center justify-content-center"
                            id="submitSerasah">
                            <span>Submit</span>
                        </button> --}}
                        <button type="submit" class="btn btn-success" id="submitButton">Submit</button>
                    </form>
                </div>
            </div>
            <div class="card plot-info-card batas">
                <div class="card-header d-flex align-items-center">
                    <img class="ms-3" src="assets/img/ChevronDown.svg" alt="" />
                    <h5 class="ms-3 mt-2">Sub Plot A - Semai</h5>
                </div>
                <div class="card-body-sup-plot">
                    <!-- Form -->
                    <form method="POST" action="{{ route('Semai.update',  ['id' => $subplot->id]) }}" id="SemaiForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="subplot_id" name="subplot_id" value="{{ $subplot->id }}" />
                        <div class="mb-3">
                            <label for="plotName" class="form-label">Total Berat Basah</label>
                            <input type="text" class="form-control" name="total_berat_basah" id="TotalBeratBasah"
                                value="{{  $semai ? $semai->total_berat_basah : "" }}" placeholder="Masukkan total berat basah (gr)" />
                        </div>
                        <div class="mb-3">
                            <label for="plotName" class="form-label">Sample Berat Basah</label>
                            <input type="text" class="form-control" name="sample_berat_basah" id="SampleBeratBasah"
                                value="{{  $semai ? $semai->sample_berat_basah : "" }}" placeholder="Masukkan sample berat basah (gr)" />
                        </div>
                        <div class="mb-3">
                            <label for="plotName" class="form-label">Sample Berat Kering</label>
                            <input type="text" class="form-control" name="sample_berat_kering" id="SampleBeratKering"
                                value="{{  $semai ? $semai->sample_berat_kering : "" }}" placeholder="Masukkan sample berat kering (gr)" />
                        </div>
                        <div class="mb-3">
                            <label for="plotName" class="form-label">Total Berat Kering</label>
                            <input type="text" class="form-control-non" name="total_berat_kering" id="TotalBeratKering"
                                value="{{  $semai ? $semai->kandungan_karbon : "" }}" readonly />
                        </div>
                        <p class="form-label">Kandungan Karbon <span>{{  $semai ? $semai->kandungan_karbon : "" }}
                                Kg</span></p>
                        <p class="form-label">Serapan CO<sub>2</sub> <span>{{  $semai ? $semai->co2 : "" }} Kg</span></p>
                        <button type="submit" class="btn btn-success d-flex align-items-center justify-content-center"
                            id="submitSemai">
                            <span>Submit</span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="card plot-info-card batas">
                <div class="card-header d-flex align-items-center">
                    <img class="ms-3" src="assets/img/ChevronDown.svg" alt="" />
                    <h5 class="ms-3 mt-2">Sub Plot A - Tumbuhan Bawah</h5>
                </div>
                <div class="card-body-sup-plot">
                    <!-- Form -->
                    <form method="POST" action="{{ route('tumbuhanBawah.update',  ['id' => $subplot->id] ) }}" id="tumbuhanBawahForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="subplot_id" name="subplot_id" value="{{ $subplot->id }}" />
                        <div class="mb-3">
                            <label for="plotName" class="form-label">Total Berat Basah</label>
                            <input type="text" class="form-control" name="total_berat_basah" id="TotalBeratBasah"
                                placeholder="Masukkan total berat basah (gr)"  value="{{ $tumbuhanbawah ? $tumbuhanbawah->total_berat_basah : "" }}" />
                        </div>
                        <div class="mb-3">
                            <label for="plotName" class="form-label">Sample Berat Basah</label>
                            <input type="text" class="form-control" name="sample_berat_basah" id="SampleBeratBasah"
                                value="{{ $tumbuhanbawah ? $tumbuhanbawah->sample_berat_basah : "" }}" placeholder="Masukkan sample berat basah (gr)" />
                        </div>
                        <div class="mb-3">
                            <label for="plotName" class="form-label">Sample Berat Kering</label>
                            <input type="text" class="form-control" name="sample_berat_kering" id="SampleBeratKering"
                                value="{{ $tumbuhanbawah ? $tumbuhanbawah->sample_berat_kering : "" }}" placeholder="Masukkan sample berat kering (gr)" />
                        </div>
                        <div class="mb-3">
                            <label for="plotName" class="form-label">Total Berat Kering</label>
                            <input type="text" class="form-control-non" name="total_berat_kering"
                                id="TotalBeratKering"
                                value="{{ $tumbuhanbawah ? $tumbuhanbawah->total_berat_kering : "" }}" readonly />
                        </div>
                        <p class="form-label">Kandungan Karbon
                            <span>{{ $tumbuhanbawah ? $tumbuhanbawah->kandungan_karbon : "" }} Kg</span>
                        </p>
                        <p class="form-label">Serapan CO<sub>2</sub> <span>{{ $tumbuhanbawah ? $tumbuhanbawah->co2 : "" }}
                                Kg</span></p>
                        <button type="submit" class="btn btn-success d-flex align-items-center justify-content-center"
                            id="submitButton">
                            <span>Submit</span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="card plot-info-card">
                <div class="card-header d-flex align-items-center">
                    <img class="ms-3" src="assets/img/ChevronDown.svg" alt="" />
                    <h5 class="ms-3 mt-2">Sub Plot A - Tanah</h5>
                </div>
                <div class="card-body-sup-plot-last">
                    <!-- Form -->
                    <form method="POST" action="{{ route('tanah.update' ,  ['id' => $subplot->id]) }}" id="tanahForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="subplot_id" name="subplot_id" value="{{ $subplot->id }}" />
                        <div class="mb-3">
                            <label for="plotName" class="form-label">Kedalaman Sample</label>
                            <input type="text" class="form-control" name="kedalaman_sample" id="KedalamanSample"
                                value="{{ $tanah ? $tanah->kedalaman_sample : ""}} " placeholder="Masukkan kedalaman sample (cm)" />
                        </div>
                        <div class="mb-3">
                            <label for="plotName" class="form-label">Sample Berat Basah</label>
                            <input type="text" class="form-control" name="berat_jenis_tanah" id="SampleBeratBasah"
                                value="{{ $tanah ? $tanah->berat_jenis_tanah : ""}} " placeholder="Masukkan berat jenis tanah " />
                        </div>
                        <div class="mb-3">
                            <label for="plotName" class="form-label">C Organic Tanah</label>
                            <input type="text" class="form-control" name="C_organic_tanah" id="COrganikTanah"
                                value="{{ $tanah ? $tanah->C_organic_tanah : ""}} "
                                placeholder="Masukkan c organic tanah (%)" />
                        </div>
                        <p class="form-label">Carbon <span>{{ $tanah ? $tanah->carbongr : ""}} Gr/Cm3</span></p>
                        <p class="form-label">Carbon <span>{{ $tanah ? $tanah->carbonton : "" }} Ton/Ha</span></p>
                        <p class="form-label">Carbon <span>{{ $tanah ? $tanah->carbonkg : "" }} Kg</span></p>
                        <p class="form-label">Serapan CO<sub>2</sub> <span>{{ $tanah ? $tanah->co2kg : "" }} Kg</span></p>
                        <button type="submit" class="btn btn-success d-flex align-items-center justify-content-center"
                            id="submitButton">
                            <span>Submit</span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="d-flex jarak">
                <div class="option">
                    <a href="{{ route('DetailPlot.getsubPlot', ['id' => $subplot->id]) }}" class=" btn btn-back  " id="submitButton">
                        <img src="{{ asset('/images/ArrowLeft.svg') }}" alt="Arrow Icon" class="ms-2" />
                        <span>Sebelumnya</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
