@extends('layout.layaout')

@section('title', 'Hitung Luas Tanah')

@section('content')
    <div class="container-tambah-data hidden mt-5" id="newContent">
        <div class="container-isi">
            <div class="card plot-info-card batas">
                <div class="card-header d-flex align-items-center">
                    <img class="ms-3 toggle-chevron" src="assets/img/ChevronDown.svg" alt="" />
                    <h5 class="ms-3 mt-2">Hitung Luas Tanah</h5>
                </div>
                <div class="card-body-sup-plot">
                    <!-- Form -->
                    <form method="POST" action="{{ route('Serasah.store') }}" id="SerasahForm">
                        @csrf
                        <div class="mb-3">
                            <label for="berat_bio_akar" class="form-label">Berat Bio Akar</label>
                            <input type="text" class="form-control" name="berat_bio_akar" id="berat_bio_akar"
                                placeholder="Masukkan Berat Bio Akar" />
                        </div>
                        <div class="mb-3">
                            <label for="berat_tanah" class="form-label">Berat Tanah</label>
                            <input type="text" class="form-control" name="berat_tanah" id="berat_tanah"
                                placeholder="Masukkan Berat Tanah" />
                        </div>
                        <div class="mb-3">
                            <label for="nerocmas" class="form-label">Necromas</label>
                            <input type="text" class="form-control" name="nerocmas" id="nerocmas"
                                placeholder="Masukkan Necromas " />
                        </div>
                        <div class="mb-3">
                            <label for="tumbuhan_tanah" class="form-label">Tumbuhan Tanah</label>
                            <input type="text" class="form-control" name="tumbuhan_tanah" id="tumbuhan_tanah"
                                placeholder="Masukkan tumbuhan tanah " />
                        </div>
                        <div class="mb-3">
                            <label for="serasah "class="form-label">Serasah</label>
                            <input type="text" class="form-control" name="serasah" id="serasah"
                                placeholder="Masukkan serasah " />
                        </div>
                        <div class="mb-3">
                            <label for="serasah" class="form-label">Serasah</label>
                            <input type="text" class="form-control" name="serasah "id="serasah"
                                placeholder="Masukkan serasah " />
                        </div>
                        <div class="mb-3">
                            <label for="semai" class="form-label">Semai</label>
                            <input type="text" class="form-control" name="semai "id="semai"
                                placeholder="Masukkan semai " />
                        </div>
                        <div class="mb-3">
                            <label for="pancang" class="form-label">Pncang</label>
                            <input type="text" class="form-control" name="pancang "id="pancang"
                                placeholder="Masukkan pancang " />
                        </div>
                        <div class="mb-3">
                            <label for="tiang" class="form-label">Tiang</label>
                            <input type="text" class="form-control" name="tiang "id="tiang"
                                placeholder="Masukkan tiang " />
                        </div>
                        <div class="mb-3">
                            <label for="pohon" class="form-label">Pohon</label>
                            <input type="text" class="form-control" name="pohon "id="pohon"
                                placeholder="Masukkan pohon " />
                        </div>
                        <button type="submit" class="btn btn-success d-flex align-items-center justify-content-center"
                            id="submitSerasah">
                            <span>Submit</span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="d-flex jarak">
                <div class="option">
                    <a href="{{ route('PlotD.index') }}" class=" btn btn-back  " id="submitButton">
                        <img src="{{ asset('/images/ArrowLeft.svg') }}" alt="Arrow Icon" class="ms-2" />
                        <span>Sebelumnya</span>
                    </a>
                </div>
                <div class="option">
                    <a href="{{ route('ringkasan.indexx') }}" class=" btn btn-success "
                        id="submitButton"><span>Berikutnya</span>
                        <img src="{{ asset('/images/ArrowRight.svg') }}" alt="Arrow Icon" class="ms-2" />
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
