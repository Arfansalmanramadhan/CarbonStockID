@extends('layout.layaout')

@section('title', 'Plot A')

@section('content')
    <div class="container-tambah-data hidden mt-5" id="newContent">
        <div class="container-isi">
            <div class="card plot-info-card">
                <div class="card-header d-flex align-items-center">
                    <img class="ms-3" src="assets/img/ChevronDown.svg" alt="" />
                    <h5 class="ms-3 mt-2">Sub Plot A - Tanah</h5>
                </div>
                <div class="card-body-sup-plot-last">
                    <!-- Form -->
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
                    <form method="POST" action="{{ route('tanah.store', ['id' => $subplot->id]) }}" id="tanahForm">
                        @csrf
                        <input type="hidden" id="subplot_id" name="subplot_id" value="{{ $subplot->id }}" />
                        <div class="mb-3">
                            <label for="plotName" class="form-label">Kedalaman Sample</label>
                            <input type="text" class="form-control" name="kedalaman_sample" id="KedalamanSample"
                                value="{{ $tanah ? $tanah->kedalaman_sample : ' ' }} "
                                placeholder="Masukkan kedalaman sample (cm)" />
                        </div>
                        <div class="mb-3">
                            <label for="plotName" class="form-label">Sample Berat Basah</label>
                            <input type="text" class="form-control" name="berat_jenis_tanah" id="SampleBeratBasah"
                                value="{{ $tanah ? $tanah->berat_jenis_tanah : ' ' }} "
                                placeholder="Masukkan berat jenis tanah " />
                        </div>
                        <div class="mb-3">
                            <label for="plotName" class="form-label">C Organic Tanah</label>
                            <input type="text" class="form-control" name="C_organic_tanah" id="COrganikTanah"
                                value="{{ $tanah ? $tanah->C_organic_tanah : ' ' }} "
                                placeholder="Masukkan c organic tanah (%)" />
                        </div>
                        <p class="form-label">Carbon <span>{{ $tanah ? $tanah->carbongr : ' ' }} Gr/Cm3</span></p>
                        <p class="form-label">Carbon <span>{{ $tanah ? $tanah->carbonton : '' }} Ton/Ha</span></p>
                        <p class="form-label">Carbon <span>{{ $tanah ? $tanah->carbonkg : '' }} Kg</span></p>
                        <p class="form-label">Serapan CO2 <span>{{ $tanah ? $tanah->co2kg : '' }} Kg</span></p>
                        <button type="submit" class="btn btn-success d-flex align-items-center justify-content-center"
                            id="submitButton">
                            <span>Submit</span>
                        </button>
                    </form>
                </div>
            </div>
            {{-- <div class="d-flex jarak"> --}}
            <div class="option">
                <a href="{{ route('zona.index') }}" class=" btn btn-back  " id="submitButton">
                    <img src="{{ asset('/images/ArrowLeft.svg') }}" alt="Arrow Icon" class="ms-2" />
                    <span>Kembali</span>
                </a>
            </div>
            {{-- </div> --}}
        </div>
    </div>
@endsection
