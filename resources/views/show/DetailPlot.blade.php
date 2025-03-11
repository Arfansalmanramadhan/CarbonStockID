@extends('layout.mainlayaot')

@section('title', 'Hamparan')

@section('content')
    <div id="prediksi-content" class="page-content content p-4">
        <div class="image-container mt-4">
            <div class="col page-title">
                <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="img-normal" />
                <p class="large-text text-overlay">Detai Plot</p>
            </div>
        </div>
        <div class="table-container card">
            <div class="card-body">
                <h4 class="card-title mb-4">Data Subplot</h4>
                <ul class=" nav nav-tabs nav-bordered nav-justified overflow-x-auto">
                    <li class="activee nav-item jarak" id="pertama">Serasah</li>
                    <li class="nav-item jarak" id="kedua">Semai</li>
                    <li class="nav-item jarak" id="ketiga">Tumbuhan Bawah</li>
                    <li class="nav-item jarak" id="keempat">Pancang</li>
                    <li class="nav-item jarak" id="kelima">Mangrove</li>
                    <li class="nav-item jarak" id="keenam">Tiang</li>
                    <li class="nav-item jarak" id="ketujuh">Pohon</li>
                    <li class="nav-item jarak" id="kedelapan">Nekromas</li>
                    <li class="nav-item jarak" id="kesebilan">Tanah</li>
                </ul>
                <div class="tab-content ">
                    <div class="tab-pane p-1" id="serasah">
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
                        <div class="table-wrapper table-responsive">
                            <table class="custom-table-pancang  table-striped">
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
                                        <td class="hidden-column">2345kg</td>
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
                </div>
                <div class="p-1" id="semai">
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
                    <div class="table-wrapper  table-responsive">
                        <table class="custom-table-pancang table-striped">
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
                <div class="p-1" id="tumbuhanBawah">
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
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang table-striped">
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
                <div class="p-1" id="tanah">
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
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang  table-striped">
                            <thead>
                                <tr>
                                    <th class="kiriPancang">No</th>
                                    <th>Kedalaman Sample</th>
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
                <div class="p-1" id="pancang">
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
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang  table-striped">
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
                <div class="p-1" id="mangrove">
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
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang table-striped">
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
                <div class="p-1" id="tiang">
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
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang table-striped">
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
                <div class="p-1" id="pohon">
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
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang table-striped">
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
                <div class="p-1" id="nekromas">
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
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang table-striped">
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
    </div>
    <script>
    </script>
@endsection
