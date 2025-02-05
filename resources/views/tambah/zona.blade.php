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
                    <!-- Form -->
                    {{-- <form method="POST" action="{{ route('zona.store') }}" id="SerasahForm"> --}}
                        @csrf
                        {{-- <input type="hidden" id="polt-area_id" name="polt-area_id" value="{{ $poltArea->id }}" /> --}}
                        <div class="mb-3">
                            <label for="plotName" class="form-label">Zona Area</label>
                            <input type="text" class="form-control" name="zona" id="TotalBeratBasah"
                                placeholder="Masukkan Zona Area " />
                        </div>
                        <div class="mb-3">
                            <label for="plotName" class="form-label">Jenis hutan</label>
                            <input type="text" class="form-control" name="jenis_hutan" id="Jenis hutan"
                                placeholder="Masukkan Jenis hutan" />
                        </div>

                        <button type="submit" class="btn btn-submit-plotA d-flex align-items-center justify-content-center"
                            id="submitSerasah">
                            <span>Submit</span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="d-flex jarak">
                <button type="submit" class="btn btn-back d-flex align-items-center justify-content-center"
                    id="previousButton">
                    <img src="{{ asset('/images/ArrowLeft.svg') }}" alt="Arrow Icon" />
                    <span class="ms-2">Sebelumnya</span>
                </button>
                <button type="submit"
                    class="btn btn-success btn-success-2 d-flex align-items-center justify-content-center">
                    <span>Berikutnya</span>
                    <img src="{{ asset('/images/ArrowRight.svg') }}" alt="Arrow Icon" class="ms-2" />
                </button>
            </div>
        </div>
    </div>
@endsection
