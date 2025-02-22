@extends('layout.mainlayaot')

@section('title', 'Buku')
@section('content')
    <style>

    </style>
    <div id="beranda-content" class="page-content">
        <h4 class="judul-beranda">Data Plot Area</h4>
        {{-- <table class="custom-table-hasil"> --}}
        <table class="custom-table-hasil ">
            <thead>
                <tr>
                    <th scope="col">NOMOR</th>
                    <th scope="col">DAERAH</th>
                    <th scope="col">LATITUDE</th>
                    <th scope="col">LONGITUDE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">00001</td>
                    <td>Mekar Jaya, Me...</td>
                    <td>-6.937154839...</td>
                    <td>6.937178839...</td>
                </tr>
                <tr>
                    <td>00001</td>
                    <td>Mekar Jaya, Me...</td>
                    <td>-6.937154839...</td>
                    <td>6.937178839...</td>
                </tr>
                <tr>
                    <td>00001</td>
                    <td>Mekar Jaya, Me...</td>
                    <td>-6.937154839...</td>
                    <td>6.937178839...</td>
                </tr>
            </tbody>
        </table>
        <h4 class="judul-beranda mt-5">Dashboard Monitoring </h4>
        {{-- <div id="carbon-prediction-chart-2"></div> --}}
        <div class="table-container">
            <div class="table-wrapper">
                <div>
                    <label for="show-entries">Tampilkan</label>
                    <select id="show-entries">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                    </select>
                    <span>data</span>
                </div>
                <table class="custom-table-pancang">
                    <thead>
                        <tr>
                            <th class="kiriPancang" rowspan="2">No</th>
                            <th rowspan="2">Zona</th>
                            <th colspan="2">Serasah</th>
                            <th colspan="2">Pancanh</th>
                            <th colspan="2">Tiang</th>
                            <th class="hidden-column" colspan="2">pohon</th>
                            <th class="hidden-column kananPancang" rowspan="2">Aksi</th>
                        </tr>
                        <tr>
                            {{-- <th class="kiriPancang">No</th> --}}
                            {{-- <th>Zona</th> --}}
                            <th>Karbon</th>
                            <th>Serapan karbon</th>
                            <th>Karbon</th>
                            <th class="hidden-column">Serapan Karobn</th>
                            <th class="hidden-column">Karbon</th>
                            <th class="hidden-column">serapan karbon</th>
                            <th class="hidden-column">Karbon</th>
                            <th class="hidden-column">Serapan serapan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>11</td>
                            <td>15 cm</td>
                            <td>15cm</td>
                            <td>15</td>
                            <td>15</td>
                            <td class="hidden-column">15 gr/cm3</td>
                            <td class="hidden-column">15 kg</td>
                            <td class="hidden-column">15 kg</td>
                            <td class="hidden-column">15 kg</td>
                            <td class="hidden-column">15 kg</td>
                            <td class="hidden-column aksi-button">
                                <button class="edit-btn">
                                    <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Total karbon</td>
                            <td colspan="9">15 cm</td>
                        </tr>
                        <tr>
                            <td colspan="2">Total Serapan Karbon</td>
                            <td colspan="9">15 cm</td>
                        </tr>
                    </tbody>
                </table>
                <div class="table-footer mt-5">
                    <span>Menampilkan 1 sampai 5 dari 40 data</span>
                    <div class="pagination">
                        <button class="page-btn">Kembali</button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">4</button>
                        <button class="page-btn">Lanjut</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-table-pancang">
            <div id="chart"></div>

        </div>
        <div class="table-container">
            <div class="h2-pancang-container">
                <h2 class="activee  jarak" id="pertama">Serasah</h2>
                <h2 class=" jarak" id="kedua">Semai</h2>
                <h2 class=" jarak" id="ketiga">Tumbuhan Bawah</h2>
                <h2 class=" jarak" id="keempat">Tanah</h2>
                <h2 class=" jarak" id="kelima">pancang</h2>
                <h2 class=" jarak" id="keenam">Mangrove</h2>
                <h2 class=" jarak" id="ketujuh">Tiang</h2>
                <h2 class=" jarak" id="kedelapan">Pohon</h2>
                <h2 class=" jarak" id="kesebilan">Nekromas</h2>
            </div>
            <div id="serasah">
                <div class="table-header d-flex justify-content-between">
                    <div class="tampilkan">
                        <label for="show-entries">Tampilkan</label>
                        <select id="show-entries" class="number-selection">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                        <span>data</span>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table class="custom-table-pancang">
                        <thead>
                            <tr>
                                <th class="kiriPancang">No</th>
                                <th>Sample Berat Basah</th>
                                <th>Total Berat Basah</th>
                                <th>Sample Berat Basah</th>
                                <th>Total Berat Kering</th>
                                <th>Kanduungan Karbn</th>
                                <th>Serapan CO2</th>
                                <th class="hidden-column kananPancang">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>No</td>
                                <td>202 kg </td>
                                <td>150 kg</td>
                                <td>1011. kg</td>
                                <td>333</td>
                                <td class="hidden-column">1234</td>
                                <td class="hidden-column">2345kg</td>>
                                <td class="hidden-column aksi-button">
                                    <button class="edit-btn">
                                        <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                    </button>
                                    <button class="delete-btn">
                                        <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-footer mt-5">
                    <span>Menampilkan 1 sampai 5 dari 40 data</span>
                    <div class="pagination">
                        <button class="page-btn">Kembali</button>
                        <button class="page-btn ">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">4</button>
                        <button class="page-btn">Lanjut</button>
                    </div>
                </div>
            </div>
            <div id="semai">
                <div class="table-header d-flex justify-content-between">
                    <div class="tampilkan">
                        <label for="show-entries">Tampilkan</label>
                        <select id="show-entries" class="number-selection">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                        <span>data</span>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table class="custom-table-pancang">
                        <thead>
                            <tr>
                                <th class="kiriPancang">No</th>
                                <th>Total Berat Basah</th>
                                <th>Sample Berat Basah</th>
                                <th>Sample Berat Kering</th>
                                <th>Total Berat Keriing</th>
                                <th>Kandungan karbon</th>
                                <th>Serapan</th>
                                <th class="hidden-column kananPancang">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="">No</td>
                                <td>Bakau</td>
                                <td>8 cmr</td>
                                <td>1</td>
                                <td>26.79 KG</td>
                                <td>12.59 KG</td>
                                <td>46,21</td>
                                <td class="hidden-column aksi-button">
                                    <button class="edit-btn">
                                        <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                    </button>
                                    <button class="delete-btn">
                                        <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                    </button>
                                </td>
                            </tr>
                            {{-- @foreach ($pancang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->keliling }} cm</td>
                                    <td>{{ $item->diameter }} cm</td>
                                    <td>{{ $item->nama_lokal }}</td>
                                    <td>{{ $item->nama_ilmiah }}</td>
                                    <td class="hidden-column">{{ $item->kerapatan_jenis_kayu }}gr/cm3</td>
                                    <td class="hidden-column">{{ $item->bio_di_atas_tanah }} kg</td>
                                    <td class="hidden-column">{{ $item->kandungan_karbon }}kg</td>
                                    <td class="hidden-column">{{ $item->co2 }} kg</td>
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
                        <button class="page-btn ">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">4</button>
                        <button class="page-btn">Lanjut</button>
                    </div>
                </div>
            </div>
            <div id="tumbuhanBawah">
                <div class="table-header d-flex justify-content-between">
                    <div class="tampilkan">
                        <label for="show-entries">Tampilkan</label>
                        <select id="show-entries" class="number-selection">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                        <span>data</span>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table class="custom-table-pancang">
                        <thead>
                            <tr>
                                <th class="kiriPancang">No</th>
                                <th>Total Berat Basah</th>
                                <th>Sample Berat Basah</th>
                                <th>Sample Berat Kering</th>
                                <th>Total Berat Keriing</th>
                                <th>Kandungan karbon</th>
                                <th>Serapan</th>
                                <th class="hidden-column kananPancang">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="">No</td>
                                <td>Bakau</td>
                                <td>8 cmr</td>
                                <td>2</td>
                                <td>26.79 KG</td>
                                <td>12.59 KG</td>
                                <td>46,21</td>
                                <td class="hidden-column aksi-button">
                                    <button class="edit-btn">
                                        <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                    </button>
                                    <button class="delete-btn">
                                        <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                    </button>
                                </td>
                            </tr>
                            {{-- @foreach ($pancang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->keliling }} cm</td>
                                    <td>{{ $item->diameter }} cm</td>
                                    <td>{{ $item->nama_lokal }}</td>
                                    <td>{{ $item->nama_ilmiah }}</td>
                                    <td class="hidden-column">{{ $item->kerapatan_jenis_kayu }}gr/cm3</td>
                                    <td class="hidden-column">{{ $item->bio_di_atas_tanah }} kg</td>
                                    <td class="hidden-column">{{ $item->kandungan_karbon }}kg</td>
                                    <td class="hidden-column">{{ $item->co2 }} kg</td>
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
                        <button class="page-btn ">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">4</button>
                        <button class="page-btn">Lanjut</button>
                    </div>
                </div>
            </div>
            <div id="tanah">
                <div class="table-header d-flex justify-content-between">
                    <div class="tampilkan">
                        <label for="show-entries">Tampilkan</label>
                        <select id="show-entries" class="number-selection">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                        <span>data</span>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table class="custom-table-pancang">
                        <thead>
                            <tr>
                                <th class="kiriPancang">No</th>
                                <th>>Kedalaman Sample</th>
                                <th>Sample Berat Basah</th>
                                <th>C organik Tanah</th>
                                <th>karbon </th>
                                <th>karbon</th>
                                <th>Karbon</th>
                                <th class="hidden-column kananPancang">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="">No</td>
                                <td>Bakau</td>
                                <td>8 cmr</td>
                                <td>2</td>
                                <td>26.79 KG</td>
                                <td>12.59 KG</td>
                                <td>46,21</td>
                                <td class="hidden-column aksi-button">
                                    <button class="edit-btn">
                                        <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                    </button>
                                    <button class="delete-btn">
                                        <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                    </button>
                                </td>
                            </tr>
                            {{-- @foreach ($pancang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->keliling }} cm</td>
                                    <td>{{ $item->diameter }} cm</td>
                                    <td>{{ $item->nama_lokal }}</td>
                                    <td>{{ $item->nama_ilmiah }}</td>
                                    <td class="hidden-column">{{ $item->kerapatan_jenis_kayu }}gr/cm3</td>
                                    <td class="hidden-column">{{ $item->bio_di_atas_tanah }} kg</td>
                                    <td class="hidden-column">{{ $item->kandungan_karbon }}kg</td>
                                    <td class="hidden-column">{{ $item->co2 }} kg</td>
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
                        <button class="page-btn ">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">4</button>
                        <button class="page-btn">Lanjut</button>
                    </div>
                </div>
            </div>
            <div id="pancang">
                <div class="table-header d-flex justify-content-between">
                    <div class="tampilkan">
                        <label for="show-entries">Tampilkan</label>
                        <select id="show-entries" class="number-selection">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                        <span>data</span>
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
                                <th>Kerapatan Jenis Kayu</th>
                                <th>Bio diatas tanah</th>
                                <th>Kandungan karbon</th>
                                <th>Serapan CO2 : ''</th>
                                <th class="hidden-column kananPancang">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="">No</td>
                                <td>35</td>
                                <td>11.1 cmr</td>
                                <td>jati</td>
                                <td>Tectona KG</td>
                                <td>61 KG</td>
                                <td>46,21</td>
                                <td>61 KG</td>
                                <td>46,21</td>
                                <td class="hidden-column aksi-button">
                                    <button class="edit-btn">
                                        <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                    </button>
                                    <button class="delete-btn">
                                        <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                    </button>
                                </td>
                            </tr>
                            {{-- @foreach ($pancang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->keliling }} cm</td>
                                    <td>{{ $item->diameter }} cm</td>
                                    <td>{{ $item->nama_lokal }}</td>
                                    <td>{{ $item->nama_ilmiah }}</td>
                                    <td class="hidden-column">{{ $item->kerapatan_jenis_kayu }}gr/cm3</td>
                                    <td class="hidden-column">{{ $item->bio_di_atas_tanah }} kg</td>
                                    <td class="hidden-column">{{ $item->kandungan_karbon }}kg</td>
                                    <td class="hidden-column">{{ $item->co2 }} kg</td>
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
                        <button class="page-btn ">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">4</button>
                        <button class="page-btn">Lanjut</button>
                    </div>
                </div>
            </div>
            <div id="mangrove">
                <div class="table-header d-flex justify-content-between">
                    <div class="tampilkan">
                        <label for="show-entries">Tampilkan</label>
                        <select id="show-entries" class="number-selection">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                        <span>data</span>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table class="custom-table-pancang">
                        <thead>
                            <tr>
                                <th class="kiriPancang">No</th>
                                <th>Jernis Tanaman</th>
                                <th>Diameter</th>
                                <th>Jumlah Tanaman</th>
                                <th>Biomasa</th>
                                <th>Kandungan Karbon</th>
                                <th>Karbondioksida</th>
                                <th class="hidden-column kananPancang">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="">No</td>
                                <td>Bakau</td>
                                <td>8 cmr</td>
                                <td>1</td>
                                <td>26.79 KG</td>
                                <td>12.59 KG</td>
                                <td>46,21</td>
                                <td class="hidden-column aksi-button">
                                    <button class="edit-btn">
                                        <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                    </button>
                                    <button class="delete-btn">
                                        <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                    </button>
                                </td>
                            </tr>
                            {{-- @foreach ($pancang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->keliling }} cm</td>
                                    <td>{{ $item->diameter }} cm</td>
                                    <td>{{ $item->nama_lokal }}</td>
                                    <td>{{ $item->nama_ilmiah }}</td>
                                    <td class="hidden-column">{{ $item->kerapatan_jenis_kayu }}gr/cm3</td>
                                    <td class="hidden-column">{{ $item->bio_di_atas_tanah }} kg</td>
                                    <td class="hidden-column">{{ $item->kandungan_karbon }}kg</td>
                                    <td class="hidden-column">{{ $item->co2 }} kg</td>
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
                        <button class="page-btn ">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">4</button>
                        <button class="page-btn">Lanjut</button>
                    </div>
                </div>
            </div>
            <div id="tiang">
                <div class="table-header d-flex justify-content-between">
                    <div class="tampilkan">
                        <label for="show-entries">Tampilkan</label>
                        <select id="show-entries" class="number-selection">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                        <span>data</span>
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
                                <th>Kerapatan Jenis Kayu</th>
                                <th>Bio diatas tanah</th>
                                <th>Kandungan karbon</th>
                                <th>Serapan CO2 : ''</th>
                                <th class="hidden-column kananPancang">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="">No</td>
                                <td>Bakau</td>
                                <td>8 cmr</td>
                                <td>1</td>
                                <td>26.79 KG</td>
                                <td>12.59 KG</td>
                                <td>46,21</td>
                                <td>46,21</td>
                                <td>46,21</td>
                                <td class="hidden-column aksi-button">
                                    <button class="edit-btn">
                                        <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                    </button>
                                    <button class="delete-btn">
                                        <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                    </button>
                                </td>
                            </tr>
                            {{-- @foreach ($pancang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->keliling }} cm</td>
                                    <td>{{ $item->diameter }} cm</td>
                                    <td>{{ $item->nama_lokal }}</td>
                                    <td>{{ $item->nama_ilmiah }}</td>
                                    <td class="hidden-column">{{ $item->kerapatan_jenis_kayu }}gr/cm3</td>
                                    <td class="hidden-column">{{ $item->bio_di_atas_tanah }} kg</td>
                                    <td class="hidden-column">{{ $item->kandungan_karbon }}kg</td>
                                    <td class="hidden-column">{{ $item->co2 }} kg</td>
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
                        <button class="page-btn ">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">4</button>
                        <button class="page-btn">Lanjut</button>
                    </div>
                </div>
            </div>
            <div id="pohon">
                <div class="table-header d-flex justify-content-between">
                    <div class="tampilkan">
                        <label for="show-entries">Tampilkan</label>
                        <select id="show-entries" class="number-selection">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                        <span>data</span>
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
                            <tr>
                                <td>1</td>
                                <td>12345 cm</td>
                                <td>123456ucm</td>
                                <td>12345</td>
                                <td>12345678</td>
                                <td class="hidden-column">123456789 gr/cm3</td>
                                <td class="hidden-column">212345kg</td>
                                <td class="hidden-column">234567kg</td>
                                <td class="hidden-column">23456789 kg</td>
                                <td class="hidden-column aksi-button">
                                    <button class="edit-btn">
                                        <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                    </button>
                                    <button class="delete-btn">
                                        <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                    </button>
                                </td>
                            </tr>
                            {{-- @foreach ($pancang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->keliling }} cm</td>
                                    <td>{{ $item->diameter }} cm</td>
                                    <td>{{ $item->nama_lokal }}</td>
                                    <td>{{ $item->nama_ilmiah }}</td>
                                    <td class="hidden-column">{{ $item->kerapatan_jenis_kayu }}gr/cm3</td>
                                    <td class="hidden-column">{{ $item->bio_di_atas_tanah }} kg</td>
                                    <td class="hidden-column">{{ $item->kandungan_karbon }}kg</td>
                                    <td class="hidden-column">{{ $item->co2 }} kg</td>
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
                        <button class="page-btn ">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">4</button>
                        <button class="page-btn">Lanjut</button>
                    </div>
                </div>
            </div>
            <div id="nekromas">
                <div class="table-header d-flex justify-content-between">
                    <div class="tampilkan">
                        <label for="show-entries">Tampilkan</label>
                        <select id="show-entries" class="number-selection">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                        <span>data</span>
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
                            <tr>
                                <td>0</td>
                                <td>12 cm</td>
                                <td>13 cm</td>
                                <td>djxhher</td>
                                <td>sfedfhngh</td>
                                <td>123456 gr/cm3</td>
                                <td>12345678 kg</td>
                                <td>12345678 kg</td>
                                <td>2345678 kg</td>
                                <td class="hidden-column aksi-button">
                                    <button class="edit-btn">
                                        <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                    </button>
                                    <button class="delete-btn">
                                        <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                    </button>
                                </td>
                            </tr>
                            {{-- @foreach ($pancang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->keliling }} cm</td>
                                    <td>{{ $item->diameter }} cm</td>
                                    <td>{{ $item->nama_lokal }}</td>
                                    <td>{{ $item->nama_ilmiah }}</td>
                                    <td class="hidden-column">{{ $item->kerapatan_jenis_kayu }}gr/cm3</td>
                                    <td class="hidden-column">{{ $item->bio_di_atas_tanah }} kg</td>
                                    <td class="hidden-column">{{ $item->kandungan_karbon }}kg</td>
                                    <td class="hidden-column">{{ $item->co2 }} kg</td>
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
                        <button class="page-btn ">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">4</button>
                        <button class="page-btn">Lanjut</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('apexchart/dist/apexcharts.css') }}" />

    <script src="{{ asset('apexchart/dist/apexcharts.js') }}"></script>
    <script>
        const options = {
            series: [{
                    name: 'Karbon',
                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                },
                {
                    name: 'Serapan Karbon',
                    data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                }
            ],
            chart: {
                type: 'bar',
                height: 350
            },
            colors: ['#198754', '#DC3545'],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    borderRadius: 5
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct']
            },
            yaxis: {
                title: {
                    text: 'Ton/Hr'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " thousands";
                    }
                }
            }
        };

        const chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil elemen tombol
            const pertama = document.getElementById("pertama");
            const kedua = document.getElementById("kedua");
            const ketiga = document.getElementById("ketiga");
            const keempat = document.getElementById("keempat");
            const kelima = document.getElementById("kelima");
            const keenam = document.getElementById("keenam");
            const ketujuh = document.getElementById("ketujuh");
            const kedelapan = document.getElementById("kedelapan");
            const kesebilan = document.getElementById("kesebilan");

            // Ambil elemen div konten
            const serasah = document.getElementById("serasah");
            const semai = document.getElementById("semai");
            const tumbuhanBawah = document.getElementById("tumbuhanBawah");
            const tanah = document.getElementById("tanah");
            const pancang = document.getElementById("pancang");
            const mangrove = document.getElementById("mangrove");
            const tiang = document.getElementById("tiang");
            const pohon = document.getElementById("pohon");
            const nekromas = document.getElementById("nekromas");

            // Fungsi untuk menyembunyikan semua div dan hanya menampilkan satu
            function tampilkanHanya(elemen) {
                serasah.style.display = "none";
                semai.style.display = "none";
                tumbuhanBawah.style.display = "none";
                tanah.style.display = "none";
                pancang.style.display = "none";
                mangrove.style.display = "none";
                tiang.style.display = "none";
                pohon.style.display = "none";
                nekromas.style.display = "none";

                // Tampilkan elemen yang dipilih
                elemen.style.display = "block";
            }

            // Fungsi untuk mengaktifkan tombol yang dipilih
            function setActiveButton(activeButton) {
                pertama.classList.remove("activee");
                kedua.classList.remove("activee");
                ketiga.classList.remove("activee");
                keempat.classList.remove("activee");
                kelima.classList.remove("activee");
                keenam.classList.remove("activee");
                ketujuh.classList.remove("activee");
                kedelapan.classList.remove("activee");
                kesebilan.classList.remove("activee");

                activeButton.classList.add("activee");
            }

            // Event listener untuk tombol
            pertama.addEventListener("click", function() {
                tampilkanHanya(serasah);
                setActiveButton(pertama);
            });

            kedua.addEventListener("click", function() {
                tampilkanHanya(semai);
                setActiveButton(kedua);
            });

            ketiga.addEventListener("click", function() {
                tampilkanHanya(tumbuhanBawah);
                setActiveButton(ketiga);
            });
            keempat.addEventListener("click", function() {
                tampilkanHanya(tanah);
                setActiveButton(keempat);
            });
            kelima.addEventListener("click", function() {
                tampilkanHanya(pancang);
                setActiveButton(kelima);
            });
            keenam.addEventListener("click", function() {
                tampilkanHanya(mangrove);
                setActiveButton(keenam);
            });
            ketujuh.addEventListener("click", function() {
                tampilkanHanya(tiang);
                setActiveButton(ketujuh);
            });
            kedelapan.addEventListener("click", function() {
                tampilkanHanya(pohon);
                setActiveButton(kedelapan);
            });
            kesebilan.addEventListener("click", function() {
                tampilkanHanya(nekromas);
                setActiveButton(kesebilan);
            });

            // Atur tampilan awal (menampilkan serasah)
            tampilkanHanya(serasah);
            setActiveButton(pertama);
        });
    </script>

@endsection
