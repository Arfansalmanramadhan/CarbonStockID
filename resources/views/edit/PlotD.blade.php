@extends('layout.layaout')

@section('title', 'Plot D')

@section('content')
    <div class="container-tambah-data hidden mt-5" id="newContent4">
        <div class="container-isi">
            <div class="table-container-plotD">
                <div class="h2-plotD-container">
                    <h2 class="me-3 active" id="utama">Pohon</h2>
                    <h2 id="kedua">Nekromas</h2>
                </div>
                <!-- Konten Nekromas -->
                <div id="nekromasContent" class="content-plotD">
                    <div class="table-header d-flex justify-content-between">
                        <div>
                            <label for="show-entries">Tampilkan</label>
                            <select id="show-entries">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                            </select>
                            <span>data</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-tambah-data me-3" id="addData3" data-bs-toggle="modal"
                                data-bs-target="#dataModal3">Edit</button>

                            <!-- Modal -->
                            <div class="modal" id="dataModal3" aria-hidden="true">
                                <div class="modal-dialog" id="dataModal3">
                                    <div class="modal-content">
                                        <h5 class="ms-3 modal-title" id="dataModalLabel">Sub Plot D - Pohon</h5>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('pohon.store') }}" id="pohonForm">
                                                @csrf
                                                {{-- <input type="hidden" id="zona_id" name="zona_id" value="{{ $zona->id }}" /> --}}
                                                <!-- Keliling -->
                                                <div class="mb-3">
                                                    <label for="keliling" class="form-label">Keliling</label>
                                                    {{-- <input type="text" class="form-control form-control-plot-b"
                                                        id="keliling" name="keliling"
                                                        value="{{ $pohon ? $pohon->keliling : ' ' }}" /> --}}
                                                </div>

                                                <!-- Diameter -->
                                                <div class="mb-3">
                                                    <label for="diameter" class="form-label">Diameter</label>
                                                    {{-- <input type="text"
                                                        class="form-control form-control-plot-b is-invalid" id="diameter"
                                                        value="{{ $pohon ? $pohon->diameter : ' ' }}" readonly /> --}}
                                                    <div class="invalid-feedback">Diameter harus diantara 10 hingga
                                                        19 cm.</div>
                                                </div>

                                                <!-- Nama Lokal with Datalist -->
                                                <div class="mb-3">
                                                    <label for="namaLokal" class="form-label">Nama Lokal</label>
                                                    <div class="input-container">
                                                        <input type="text" class="form-control form-control-plot-b"
                                                            {{-- id="namaLokal3" value="{{ $pohon ? $pohon->nama_lokal : ' ' }}" --}} autocomplete="off" readonly
                                                            name="nama_lokal" />
                                                        <img src="{{ asset('/images/ChevronUp.svg') }}" alt=""
                                                            class="chevron-icon" id="toggleDropdown3"
                                                            onclick="toggleImage3()" />
                                                        <ul class="dropdown" id="dropdownList3">
                                                            <li>Damar</li>
                                                            <li>Jati</li>
                                                            <li>Mahoni</li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <!-- Nama Ilmiah -->
                                                <div class="mb-3">
                                                    <label for="namaIlmiah" class="form-label">Nama Ilmiah</label>
                                                    <input type="text" class="form-control form-control-plot-b"
                                                        {{-- id="namaIlmiah" value="{{ $pohon ? $pohon->nama_ilmiah : ' ' }}" --}} readonly name="nama_ilmiah" />
                                                </div>

                                                <!-- Kerapatan Kayu -->
                                                <div class="mb-3">
                                                    <label for="kerapatanKayu" class="form-label">Kerapatan Jenis
                                                        Kayu</label>
                                                    {{-- <input type="text" class="form-control form-control-plot-b"
                                                        id="kerapatanKayu"
                                                        placeholder="Masukkan kerapatan jenis kayu (gr/cm3)"
                                                        value="{{ $pohon ? $pohon->kerapatan_jenis_kayu : ' ' }}"
                                                        name="kerapatan_jenis_kayu" /> --}}
                                                </div>

                                                <!-- Biomassa, Karbon, CO2 -->
                                                <div class="mb-3">
                                                    <p class="form-label">Biomassa diatas Permukaan
                                                        {{-- Tanah<span>{{ $pohon ? $pohon->bio_di_atas_tanah : ' ' }}
                                                            Kg</span></p>
                                                    <p class="form-label">Kandungan
                                                        Karbon<span>{{ $pohon ? $pohon->kandungan_karbon : ' ' }}
                                                            Kg</span></p>
                                                    <p class="form-label">Serapan
                                                        CO2<span>{{ $pohon ? $pohon->co2 : '' }} Kg</span></p> --}}
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success-plot btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-rataan" id="averageData">Rataan</button>
                        </div>
                    </div>
                    <div class="table-wrapper">
                        <table class="custom-table-pancang">
                            <thead>
                                <tr>
                                    <th class="kiriPancang">No</th>
                                    <th>Keliling</th>
                                    <th>Diameter</th>
                                    <th>Nama Lokal</th>
                                    <th>Nama Ilmiah</th>
                                    <th class="hidden-column">Kerapatan Jenis Kayu</th>
                                    <th class="hidden-column">Bio diatas tanah</th>
                                    <th class="hidden-column">Kandungan karbon</th>
                                    <th class="hidden-column">Serapan CO2</th>
                                    <th class="hidden-column kananPancang">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($pohon as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $loop->keliling }} cm</td>
                                        <td>{{ $loop->diameter }} cm</td>
                                        <td>{{ $loop->nama_lokal }}</td>
                                        <td>{{ $loop->nama_ilmiah }}</td>
                                        <td class="hidden-column">{{ $loop->kerapatan_jenis_kayu }} gr/cm3</td>
                                        <td class="hidden-column">{{ $loop->bio_di_atas_tanah }} kg</td>
                                        <td class="hidden-column">{{ $loop->kandungan_karbon }} kg</td>
                                        <td class="hidden-column">{{ $loop->co2 }} kg</td>
                                        <td class="hidden-column aksi-button">
                                            <button class="edit-btn">
                                                <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                            </button>
                                            <button class="delete-btn">
                                                <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                    <div class="table-footer mt-5">
                        <span>Menampilkan 1 sampai 5 dari 40 data</span>
                        <div class="pagination">
                            <button class="page-btn">Kembali</button>
                            <button class="page-btn activeD">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn">3</button>
                            <button class="page-btn">4</button>
                            <button class="page-btn">Lanjut</button>
                        </div>
                    </div>
                </div>

                <!-- Konten Pohon -->
                <div id="pohonContent" class="content-plotD">
                    <div class="table-header d-flex justify-content-between">
                        <div>
                            <label for="show-entries">Tampilkan</label>
                            <select id="show-entries">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                            </select>
                            <span>data</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-tambah-data me-3" id="addData4" data-bs-toggle="modal"
                                data-bs-target="#dataModal4">Tambah</button>

                            <!-- Modal -->
                            <div class="modal" id="dataModal4" aria-hidden="true">
                                <div class="modal-dialog" id="dataModal4">
                                    <div class="modal-content">
                                        <h5 class="ms-3 modal-title" id="dataModalLabel">Sub Plot D - Nekromas
                                        </h5>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('nekromas.store') }}"
                                                id="nekromasForm">
                                                @csrf
                                                {{-- <input type="hidden" id="zona_id" name="zona_id" value="{{ $zona->id }}" /> --}}
                                                </button>
                                                <!-- Keliling -->
                                                <div class="mb-3">
                                                    <label for="diameterujung" class="form-label">Diameter
                                                        Ujung</label>
                                                    {{-- <input type="text" class="form-control form-control-plot-b"
                                                        id="diameterujung" name="diameter_ujung"
                                                        value="{{ $nekromas ? $nekromas->diameter_ujung : '' }} " /> --}}
                                                </div>

                                                <!-- Diameter -->
                                                <div class="mb-3">
                                                    <label for="diameterpangkal" class="form-label">Diameter
                                                        Pangkal</label>
                                                    {{-- <input type="text"
                                                        class="form-control form-control-plot-b is-invalid"
                                                        id="diameterpangkal" name="diameter_pangkal"
                                                        value="{{ $nekromas ? $nekromas->diameter_pangkal : '' }} "
                                                        readonly /> --}}
                                                </div>

                                                <!-- Nama Lokal with Datalist -->
                                                <div class="mb-3">
                                                    <label for="panjang" class="form-label">Panjang</label>
                                                    {{-- <input type="text" class="form-control form-control-plot-b"
                                                        id="panjang" name="panjang"
                                                        value="{{ $nekromas ? $nekromas->panjang : '' }} " readonly /> --}}
                                                </div>

                                                <!-- Kerapatan Kayu -->
                                                <div class="mb-3">
                                                    <label for="BeratKayu" class="form-label">Berat Jenis
                                                        Kayu</label>
                                                    <input type="text" class="form-control form-control-plot-b"
                                                        id="BeratKayu" name="berat_jenis_kayu" {{-- value="{{ $nekromas ? $nekromas->berat_jenis_kayu : '' }} " --}}
                                                        placeholder="Masukkan berat jenis kayu (gr/cm3)" />
                                                </div>

                                                <!-- Biomassa, Karbon, CO2 -->
                                                <div class="mb-3">
                                                    {{-- <p class="form-label">
                                                        Volume<span>{{ $nekromas ? $nekromas->volume : '' }}
                                                            M3</span></p>
                                                    <p class="form-label">Biomassa
                                                        <span>{{ $nekromas ? $nekromas->biomasa : '' }} Kg</span>
                                                    </p>
                                                    <p class="form-label">Kandungan
                                                        Karbon<span>{{ $nekromas ? $nekromas->carbon : '' }}
                                                            Kg</span></p>
                                                    <p class="form-label">Serapan
                                                        CO2<span>{{ $nekromas ? $nekromas->co2 : '' }} Kg</span>
                                                    </p> --}}
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button"
                                                class="btn btn-success-plot btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-rataan" id="averageData">Rataan</button>
                        </div>
                    </div>
                    <div class="table-wrapper">
                        <table class="custom-table-pancang">
                            <thead>
                                <tr>
                                    <th class="kiriPancang">No</th>
                                    <th>Diameter Pangkal</th>
                                    <th>Diameter Ujung</th>
                                    <th>Panjang</th>
                                    <th>Berat Jenis Kayu</th>
                                    <th class="hidden-column">Volume</th>
                                    <th class="hidden-column">Biomasa</th>
                                    <th class="hidden-column">Kandungan karbon</th>
                                    <th class="hidden-column">Serapan CO2</th>
                                    <th class="hidden-column kananPancang">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- $@foreach ($nekromas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $loop->diameter_pangkal }} cm</td>
                                        <td>{{ $loop->diameter_ujung }} cm</td>
                                        <td>{{ $loop->panjang }}</td>
                                        <td>{{ $loop->berat_jenis_kayu }}</td>
                                        <td class="hidden-column">{{ $loop->volume }} gr/cm3</td>
                                        <td class="hidden-column">{{ $loop->biomasa }}kg</td>
                                        <td class="hidden-column">{{ $loop->carbon }} kg</td>
                                        <td class="hidden-column">{{ $loop->co2 }} kg</td>
                                        <td class="hidden-column aksi-button">
                                            <button class="edit-btn">
                                                <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                            </button>
                                            <button class="delete-btn">
                                                <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                    <div class="table-footer mt-5">
                        <span>Menampilkan 1 sampai 5 dari 40 data</span>
                        <div class="pagination">
                            <button class="page-btn">Kembali</button>
                            <button class="page-btn activeD">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn">3</button>
                            <button class="page-btn">4</button>
                            <button class="page-btn">Lanjut</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex jarak">
                <div class="option">
                    <a href="{{ route('PlotC.index') }}" class=" btn btn-back  " id="submitButton">
                        <img src="{{ asset('/images/ArrowLeft.svg') }}" alt="Arrow Icon" class="ms-2" />
                        <span>Sebelumnya</span>
                    </a>
                </div>
                <div class="option">
                    <a href="{{ route('hitung.index') }}" class=" btn btn-success "
                        id="submitButton"><span>Berikutnya</span>
                        <img src="{{ asset('/images/ArrowRight.svg') }}" alt="Arrow Icon" class="ms-2" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const kedua = document.getElementById("kedua");
            const utama = document.getElementById("utama");
            const nekromasContent = document.getElementById("nekromasContent");
            const pohonContent = document.getElementById("pohonContent");

            // Fungsi untuk menampilkan konten Nekromas
            kedua.addEventListener("click", function() {
                nekromasContent.classList.add("activeD");
                pohonContent.classList.remove("activeD");
            });

            // Fungsi untuk menampilkan konten Pohon
            utama.addEventListener("click", function() {
                pohonContent.classList.add("activeD");
                nekromasContent.classList.remove("activeD");
            });

            // Tampilkan konten Pohon secara default
            pohonContent.classList.add("activeD");
        });

        // // ----------------------

        document.getElementById("kedua").addEventListener("click", function() {
            this.classList.add("active");
            document.getElementById("utama").classList.remove("active");
        });

        document.getElementById("utama").addEventListener("click", function() {
            this.classList.add("active");
            document.getElementById("kedua").classList.remove("active");
        });
    </script>
@endsection
