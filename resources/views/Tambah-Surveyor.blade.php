@extends('layout.layaout')

@section('title', 'Tambah Surveyor')

@section('content')

    <!-- Konten baru yang akan ditampilkan -->
    <div class="container-tambah-data hidden mt-5" id="newContent">
        <div class="container">
            <div class="card plot-info-card batas">
                <div class="card-header d-flex align-items-center">
                    <img class="ms-3 toggle-chevron" src="assets/img/ChevronDown.svg" alt="" />
                    <h5 class="ms-3 mt-2">Tambah Surveyor</h5>
                </div>
                <div class="card-body-sup-plot">
                    <!-- Form -->
                    {{-- <form method="POST" action="{{ route('zona.store') }}" id="SerasahForm"> --}}
                    @csrf
                    {{-- <input type="hidden" id="polt-area_id" name="polt-area_id" value="{{ $poltArea->id }}" /> --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="total_berat_basah" id="TotalBeratBasah"
                            value="" placeholder="Masukkan nama lengkap " />
                    </div>
                    <div class="mb-3">
                        <label for="plotName" class="form-label">Username</label>
                        <input type="text" class="form-control" name="total_berat_basah" id="TotalBeratBasah"
                            value="" placeholder="Masukkan Username" />
                    </div>
                    <div class="mb-3">
                        <label for="plotName" class="form-label">Email</label>
                        <input type="text" class="form-control" name="total_berat_basah" id="TotalBeratBasah"
                            value="" placeholder="Masukkan email" />
                    </div>
                    <div class="mb-3">
                        <label for="plotName" class="form-label">Password</label>
                        <input type="text" class="form-control" name="total_berat_basah" id="TotalBeratBasah"
                            value="" placeholder="Masukkan password" />
                    </div>
                    <div class="mb-3">
                        <label for="plotName" class="form-label">NIP</label>
                        <input type="text" class="form-control" name="total_berat_basah" id="TotalBeratBasah"
                            value="" placeholder="Masukkan NIP" />
                    </div>
                    <div class="mb-3">
                        <label for="plotName" class="form-label">No Telepon/No WhatsApp</label>
                        <input type="text" class="form-control" name="total_berat_basah" id="TotalBeratBasah"
                            value="" placeholder="Masukkan No Telepon/No WhatsApp" />
                    </div>
                    <div class="mb-3">
                        <label for="plotName" class="form-label">NIK</label>
                        <input type="text" class="form-control" name="total_berat_basah" id="TotalBeratBasah"
                            value="" placeholder="Masukkan NIK" />
                    </div>

                    <button type="submit" class="btn btn-submit-plotA d-flex align-items-center justify-content-center"
                        id="submitSerasah">
                        <span>Simpan</span>
                    </button>
                    </form>
                </div>
            </div>
            <div class="d-flex jarak m-3">
                <div class="option">
                    <a href="{{ route('Surveyor.index') }}" class=" btn btn-back  " id="submitButton">
                        <img src="{{ asset('/images/ArrowLeft.svg') }}" alt="Arrow Icon" class="ms-2" />
                        <span>Kembali</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
