@extends('layout.layaout')

@section('title', 'Plot A')

@section('content')
    <div class="container-tambah-data hidden mt-5" id="newContent">
        <div class="container-isi">
            <div class="card plot-info-card batas">
                <div class="card-header d-flex align-items-center">
                    <img class="ms-3 toggle-chevron" src="assets/img/ChevronDown.svg" alt="" />
                    <h5 class="ms-3 mt-2">Kalkulasi Penghitungan Kandungan Karbon</h5>
                </div>
                <div class="card-body-sup-plot">
                    <!-- Form -->
                    <form method="POST" action="{{ route('Serasah.store') }}" id="SerasahForm">
                        @csrf
                        <div class="mb-3">
                            <label for="serasah" class="form-label">Serasah</label>
                            <input type="text" class="form-control" name="serasah_karbon" id="serasah"
                                placeholder="Masukkan hakter serasa" />
                        </div>
                        <div class="mb-3">
                            <label for="Semai" class="form-label">Semai</label>
                            <input type="text" class="form-control" name="Semai_karbon" id="Semai"
                                placeholder="Masukkan hakter semai" />
                        </div>
                        <div class="mb-3">
                            <label for="tumbuhanbawah" class="form-label">Tumbuhan Bawah</label>
                            <input type="text" class="form-control" name="tumbuhanbawah_karbon" id="tumbuhanbawah"
                                placeholder="Masukkan hakter tumbuhan bawah" />
                        </div>
                        <div class="mb-3">
                            <label for="pancang" class="form-label">Pancang</label>
                            <input type="text" class="form-control" name="pancang_karbon" id="pancang"
                                placeholder="Masukkan hakter pancang" />
                        </div>
                        <div class="mb-3">
                            <label for="mangrove" class="form-label">Mangrove</label>
                            <input type="text" class="form-control" name="mangrove_karbon" id="mangrove"
                                placeholder="Masukkan hakter mangrove" />
                        </div>
                        <div class="mb-3">
                            <label for="tiang" class="form-label">Tiang</label>
                            <input type="text" class="form-control" name="tiang_karbon" id="tiang"
                                placeholder="Masukkan hakter tiang" />
                        </div>
                        <div class="mb-3">
                            <label for="nekromas" class="form-label">Nekromas</label>
                            <input type="text" class="form-control" name="nekromas_karbon" id="nekromas"
                                placeholder="Masukkan hakter nekromas" />
                        </div>
                        <div class="mb-3">
                            <label for="pohon" class="form-label">Pohon</label>
                            <input type="text" class="form-control" name="pohon_karbon" id="pohon"
                                placeholder="Masukkan hakter pohon" />
                        </div>
                        <div class="mb-3">
                            <label for="tanah" class="form-label">Tanah</label>
                            <input type="text" class="form-control" name="tanah_karbon" id="tanah"
                                placeholder="Masukkan hakter tanah" />
                        </div>
                        <div class="mb-3">
                            <label for="akar" class="form-label">Akar</label>
                            <input type="text" class="form-control" name="tanah_karbon" id="akar"
                                placeholder="Masukkan hakter akar" />
                        </div>

                        <button type="submit" class="btn btn-success d-flex align-items-center justify-content-center"
                            id="submitSerasah">
                            <span>Submit</span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="card plot-info-card batas">
                <div class="card-header d-flex align-items-center">
                    <img class="ms-3" src="assets/img/ChevronDown.svg" alt="" />
                    <h5 class="ms-3 mt-2">Kalkulasi Penghitungan Serapa CO2</h5>
                </div>
                <div class="card-body-sup-plot">
                    <!-- Form -->
                    <form method="POST" action="{{ route('Semai.store') }}" id="SemaiForm">
                        @csrf
                        <div class="mb-3">
                            <label for="serasah" class="form-label">Serasah</label>
                            <input type="text" class="form-control" name="serasah_serapan" id="serasah"
                                placeholder="Masukkan hakter serasa" />
                        </div>
                        <div class="mb-3">
                            <label for="Semai" class="form-label">Semai</label>
                            <input type="text" class="form-control" name="Semai_serapan" id="Semai"
                                placeholder="Masukkan hakter semai" />
                        </div>
                        <div class="mb-3">
                            <label for="tumbuhanbawah" class="form-label">Tumbuhan Bawah</label>
                            <input type="text" class="form-control" name="tumbuhanbawah_serapan" id="tumbuhanbawah"
                                placeholder="Masukkan hakter tumbuhan bawah" />
                        </div>
                        <div class="mb-3">
                            <label for="pancang" class="form-label">Pancang</label>
                            <input type="text" class="form-control" name="pancang_serapan" id="pancang"
                                placeholder="Masukkan hakter pancang" />
                        </div>
                        <div class="mb-3">
                            <label for="mangrove" class="form-label">Mangrove</label>
                            <input type="text" class="form-control" name="mangrove_serapan" id="mangrove"
                                placeholder="Masukkan hakter mangrove" />
                        </div>
                        <div class="mb-3">
                            <label for="tiang" class="form-label">Tiang</label>
                            <input type="text" class="form-control" name="tiang_serapan" id="tiang"
                                placeholder="Masukkan hakter tiang" />
                        </div>
                        <div class="mb-3">
                            <label for="nekromas" class="form-label">Nekromas</label>
                            <input type="text" class="form-control" name="nekromas_serapan" id="nekromas"
                                placeholder="Masukkan hakter nekromas" />
                        </div>
                        <div class="mb-3">
                            <label for="pohon" class="form-label">Pohon</label>
                            <input type="text" class="form-control" name="pohon_serapan" id="pohon"
                                placeholder="Masukkan hakter pohon" />
                        </div>
                        <div class="mb-3">
                            <label for="tanah" class="form-label">Tanah</label>
                            <input type="text" class="form-control" name="tanah_serapan" id="tanah"
                                placeholder="Masukkan hakter tanah" />
                        </div>
                        <div class="mb-3">
                            <label for="akar" class="form-label">Akar</label>
                            <input type="text" class="form-control" name="tanah_serapan" id="akar"
                                placeholder="Masukkan hakter akar" />
                        </div>

                        <button type="submit" class="btn btn-success d-flex align-items-center justify-content-center"
                            id="submitSemai">
                            <span>Submit</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
