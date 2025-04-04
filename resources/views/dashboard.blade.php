@extends('layout.mainlayaot')

@section('title', 'Buku')
@section('content')
    <style>

    </style>
    <div id="beranda-content" class="page-content content p-4">
        <h4 class="judul-beranda">Data Plot Area</h4>
        {{-- <table class="custom-table-hasil"> --}}
        <div class="paginated-table table-container ">
            <div class="table-header d-flex justify-content-between">
                <div class="tampilkan">
                    <label for="dataPerPage2">Tampilkan</label>
                    <select class="dataPerPage">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="ms-2">data</span>
                </div>
            </div>
            <table class="custom-table-pancang table ">
                <thead>
                    <tr>
                        <th scope="col">NOMOR</th>
                        <th scope="col">DAERAH</th>
                        <th scope="col">LATITUDE</th>
                        <th scope="col">LONGITUDE</th>
                    </tr>
                </thead>
                @forelse ($ringkasann as $item)
                    <tbody class="tableBody">
                        <tr class="data-row">

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['dareah'] ?? 'Data tidak tersedia' }}</td>
                            <td>{{ $item['latitude'] ?? 'Data tidak tersedia' }} </td>
                            <td>{{ $item['longitude'] ?? 'Data tidak tersedia' }} </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada data</td>
                        </tr>
                    </tbody>
                @endforelse
            </table>
            <div class="table-footer mt-5">
                <!-- Informasi Rentang Data -->
                <p>Menampilkan data <span class="fromNumber">1</span> sampai <span class="toNumber">5</span> dari <span
                        class="totalData">0</span> data</p>

                <!-- Tombol Pagination -->
                <div class="pagination-controls">
                    <button class="prevPage  btn-button" disabled>Sebelumnya</button>
                    <span class="currentPage">1</span> dari <span class="totalPages">0</span>
                    <button class="nextPage  btn-button">Berikutnya</button>
                </div>
            </div>
        </div>
        <h4 class="judul-beranda mt-5">Dashboard Monitoring </h4>
        {{-- <div id="carbon-prediction-chart-2"></div> --}}
        <div class="table-container  paginated-table">
            {{-- <div class="table-wrapper"> --}}
            <div class="table-header d-flex justify-content-between">
                <div class="tampilkan">
                    <label for="dataPerPage1">Tampilkan</label>
                    <select class="dataPerPage">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>data</span>
                </div>
            </div>
            <div class="">

                <div class="table-wrapper">
                    <table class="custom-table-pancang  table">
                        <thead>
                            <tr>
                                <th class="kiriPancang" rowspan="2">No</th>
                                <th rowspan="2">Daerah</th>
                                <th rowspan="2">Tanah <br> (kandungan Kabon)</th>
                                <th rowspan="2">Necromash <br> (kandungan Kabon)</th>
                                <th colspan="2">Serasah</th>
                                <th colspan="2">Tumbuhan Bawah</th>
                                <th colspan="2">Pancang</th>
                                <th colspan="2">Tiang</th>
                                <th class="hidden-column" colspan="2">pohon</th>
                                <th class="hidden-column"rowspan="2">Total karbon </th>
                                <th class="hidden-column"rowspan="2">Total Serapan Karbon </th>
                                <th class="hidden-column kananPancang" rowspan="2">Aksi</th>
                            </tr>
                            <tr>
                                {{-- <th class="kiriPancang">No</th> --}}
                                {{-- <th>Zona</th> --}}
                                <th>Karbon</th>
                                <th>Serapan <br>karbon</th>
                                <th>Karbon</th>
                                <th class="hidden-column">Serapan <br> Karobn</th>
                                <th>Karbon</th>
                                <th class="hidden-column">Serapan <br> Karobn</th>
                                <th class="hidden-column">Karbon</th>
                                <th class="hidden-column">serapan <br> karbon</th>
                                <th class="hidden-column">Karbon</th>
                                <th class="hidden-column">Serapan <br> serapan</th>

                            </tr>
                        </thead>
                        @forelse ($ringkasann as $item)
                            <tbody class="tableBody">
                                <tr class="data-row">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['dareah'] ?? 'Data tidak tersedia' }}</td>
                                    <td>{{ $item['TanahCarbon'] ?? 0 }}</td>
                                    <td>{{ $item['NecromassCarbon'] ?? 0 }}</td>
                                    <td>{{ $item['Serasahco2'] ?? 0 }}</td>
                                    <td>{{ $item['SerasahKarbon'] ?? 0 }}</td>
                                    <td>{{ $item['tumbuhanbawahco2'] ?? 0 }}</td>
                                    <td class="hidden-column">{{ $item['tumbuhanbawahkarbon'] ?? 0 }}</td>
                                    <td class="hidden-column">{{ $item['TotalPancangco2'] ?? 0 }}</td>
                                    <td class="hidden-column">{{ $item['TotalPancangkarbon'] ?? 0 }}</td>
                                    <td class="hidden-column">{{ $item['TotalTiangco2'] ?? 0 }}</td>
                                    <td class="hidden-column">{{ $item['TotalTiangKarbon'] ?? 0 }}</td>
                                    <td class="hidden-column">{{ $item['TotalPohonco2'] ?? 0 }}</td>
                                    <td class="hidden-column">{{ $item['TotalPohonkarbon'] ?? 0 }}</td>
                                    <td class="hidden-column">{{ $item['TotalKandunganKarbon'] ?? 0 }}</td>
                                    <td class="hidden-column">{{ $item['KarbonCo2'] ?? 0 }}</td>
                                    <td class="hidden-column aksi-button">
                                        {{-- @foreach ($poltArea as $itemm)
                                            {{ dd($poltArea) }}
                                            <form action="{{ route('zona.getZona', ['slug' => $itemm->slug]) }}"
                                                method="get">
                                                <button type="submit" class="view-btn">
                                                    <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                                </button>
                                            </form>
                                        @endforeach --}}
                                        <button class="delete-btn">
                                            <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                        </button>
                                    </td>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada data</td>
                                </tr>
                        @endforelse
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-footer mt-5">
                    <!-- Informasi Rentang Data -->
                    <p>Menampilkan data <span class="fromNumber">1</span> sampai <span class="toNumber">5</span> dari <span
                            class="totalData">0</span> data</p>

                    <!-- Tombol Pagination -->
                    <div class="pagination-controls">
                        <button class="prevPage  btn-button" disabled>Sebelumnya</button>
                        <span class="currentPage">1</span> dari <span class="totalPages">0</span>
                        <button class="nextPage  btn-button">Berikutnya</button>
                    </div>
                </div>
                {{-- </div> --}}
            </div>
        </div>
        <div class="custom-table-pancang">
            {{-- <div class="row">
                <div class="col-lg-6">
                    <h3 class="text-center">Data Carbon Stock dari tiap AREA</h3>
                    <div class="d-flex justify-content-center">
                        <div id="bar" style="width: 100%;"></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h3 class="text-center">Total Pendataan</h3>
                    <div class="d-flex justify-content-center">
                        <div id="pie" style="width: 80%;"></div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="row">
                <div class="col col-lg-6">
                    <div class="row">
                        <div class="col">
                            <h3>Data Carbon Stock dari tiap AREA</h3>
                        </div>
                    </div>
                    <div class="row text-align-center">
                        <div class="col">
                            <div id="bar"></div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-6">
                    <div class="row">
                        <div class="col">
                            <h3>Total Pendataan</h3>
                        </div>
                    </div>
                    <div class="row text-align-center">
                        <div class="col">
                            <div id="pie" ></div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <!-- Bar Chart -->
                <div class="col-12 col-lg-6 mb-3">
                    <div class="card bg-boxshadow full-height">
                        <div class="card-header bg-transparent d-flex align-items-center justify-content-between">
                            <h3 class="card-title mb-0">Data Carbon Stock dari tiap AREA</h3>
                            {{-- <label for="tahun">Pilih Tahun:</label>
                            <select id="tahun" onchange="redirectToYear(this.value)">
                                @for ($i = date('Y'); $i >= 2020; $i--)
                                    <option value="{{ $i }}" {{ $i == $tahun ? 'selected' : '' }}>
                                        {{ $i }}</option>
                                @endfor
                            </select> --}}
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <div id="bar" style="width: 100%; height: 400px;"></div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-12 col-lg-6 mb-3">
                    <div class="card bg-boxshadow full-height">
                        <div class="card-header bg-transparent d-flex align-items-center justify-content-between">
                            <h3 class="card-title mb-0">Total Pendataan</h3>
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <div id="pie" style="width: 80%; height: 400px;"></div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="table-container card">
            <div class="card-body">
                <div class="d-flex justify-content-between">

                    <h4 class="card-title mb-4">Data Subplot</h4>
                </div>
                <ul class=" nav nav-tabs nav-bordered nav-justified overflow-x-auto">
                    <li class="activee nav-item jarak" id="pertama">Serasah</li>
                    <li class="nav-item jarak" id="kedua">Semai</li>
                    <li class="nav-item jarak" id="ketiga">Tumbuhan Bawah</li>
                    <li class="nav-item jarak" id="keempat">Pancang</li>
                    <li class="nav-item jarak" id="kelima">Tiang</li>
                    <li class="nav-item jarak" id="keenam">Pohon</li>
                    <li class="nav-item jarak" id="ketujuh">Nekromas</li>
                    <li class="nav-item jarak" id="kedelapan">Tanah</li>
                </ul>
                <div class="tab-content ">
                    <div class="tab-pane p-1  paginated-table" id="serasah">
                        <div class="table-header d-flex justify-content-between">
                            <div class="tampilkan">
                                <label for="dataPerPage2">Tampilkan</label>
                                <select class="dataPerPage">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <span class="ms-2">data</span>
                            </div>
                        </div>
                        <div class="table-wrapper table-responsive ">
                            <table class="custom-table-pancang table  table-striped">
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
                                <tbody class="tableBody">
                                    @forelse ($Serasah as $item)
                                        <tr class="data-row">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->total_berat_basah }} Gr</td>
                                            <td>{{ $item->sample_berat_basah }} Gr</td>
                                            <td>{{ $item->sample_berat_kering }} Gr</td>
                                            <td>{{ $item->total_berat_kering }} Gr</td>
                                            <td class="hidden-column">{{ $item->kandungan_karbon }}gr/cm3</td>
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
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="table-footer mt-5">
                            {{-- <strong>
                                Menampilkan {{ $Serasah->firstItem() }} sampai {{ $Serasah->lastItem() }} dari
                                {{ $Serasah->total() }}
                                data
                            </strong>
                            <nav>
                                <ul class="pagination">
                                    @if ($Serasah->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">Kembali</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $Serasah->previousPageUrl() }}">Kembali</a></li>
                                    @endif

                                    @foreach ($Serasah->getUrlRange(1, $Serasah->lastPage()) as $page => $url)
                                        <li class="page-item {{ $Serasah->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if ($Serasah->hasMorePages())
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $Serasah->nextPageUrl() }}">Lanjut</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled"><span class="page-link">Lanjut</span></li>
                                    @endif
                                </ul>
                            </nav> --}}
                            <!-- Informasi Rentang Data -->
                            <p>Menampilkan data <span class="fromNumber">1</span> sampai <span class="toNumber">5</span>
                                dari
                                <span class="totalData">0</span> data
                            </p>

                            <!-- Tombol Pagination -->
                            <div class="pagination-controls">
                                <button class="  btn-button prevPage" disabled>Sebelumnya</button>
                                <span class="currentPage">1</span> dari <span class="totalPages">0</span>
                                <button class="  btn-button nextPage">Berikutnya</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-1 paginated-table" id="semai">
                    <div class="table-header d-flex justify-content-between">
                        {{-- <form method="GET"
                            action="{{ route('DetailPlot.getsubPlot', ['id' => $plot->id ?? 'default-slug']) }}">
                            <div class="tampilkan">
                                <label for="show-entries">Tampilkan</label>
                                <select id="show-entries perPageSelect" class="number-selection" name="perPage"
                                    onchange="this.form.submit()">
                                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                                </select>
                                <span class="ms-2">data</span>
                            </div>
                        </form> --}}

                        <div class="tampilkan">
                            <label for="dataPerPage3">Tampilkan</label>
                            <select class="dataPerPage">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span class="ms-2">data</span>
                        </div>

                    </div>
                    <div class="table-wrapper  table-responsive">
                        <table class="custom-table-pancang table table-striped">
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
                            <tbody class="tableBody">
                                @forelse ($Semai as $item)
                                    <tr class="data-row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->total_berat_basah }} Gr</td>
                                        <td>{{ $item->sample_berat_basah }} Gr</td>
                                        <td>{{ $item->sample_berat_kering }} Gr</td>
                                        <td>{{ $item->total_berat_kering }} Gr</td>
                                        <td class="hidden-column">{{ $item->kandungan_karbon }}Kg</td>
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
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-footer mt-5">
                        {{-- <strong>
                            Menampilkan {{ $Semai->firstItem() }} sampai {{ $Semai->lastItem() }} dari
                            {{ $Semai->total() }}
                            data
                        </strong>
                        <nav>
                            <ul class="pagination">
                                @if ($Semai->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">Kembali</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $Semai->previousPageUrl() }}">Kembali</a></li>
                                @endif

                                @foreach ($Semai->getUrlRange(1, $Semai->lastPage()) as $page => $url)
                                    <li class="page-item {{ $Semai->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if ($Semai->hasMorePages())
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $Semai->nextPageUrl() }}">Lanjut</a>
                                    </li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">Lanjut</span></li>
                                @endif
                            </ul>
                        </nav> --}}
                        <p>Menampilkan data <span class="fromNumber">1</span> sampai <span class="toNumber">5</span>
                            dari
                            <span class="totalData">0</span> data
                        </p>

                        <!-- Tombol Pagination -->
                        <div class="pagination-controls">
                            <button class=" btn-button prevPage" disabled>Sebelumnya</button>
                            <span class="currentPage">1</span> dari <span class="totalPages">0</span>
                            <button class=" btn-button nextPage">Berikutnya</button>
                        </div>
                    </div>
                </div>
                <div class="p-1 paginated-table" id="tumbuhanBawah">
                    <div class="table-header d-flex justify-content-between">
                        {{-- <form method="GET"
                            action="{{ route('DetailPlot.getsubPlot', ['id' => $plot->id ?? 'default-slug']) }}">
                            <div class="tampilkan">
                                <label for="show-entries">Tampilkan</label>
                                <select id="show-entries perPageSelect" class="number-selection" name="perPage"
                                    onchange="this.form.submit()">
                                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                                </select>
                                <span class="ms-2">data</span>
                            </div>
                        </form> --}}
                        <div class="tampilkan">
                            <label for="dataPerPage3">Tampilkan</label>
                            <select class="dataPerPage">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span class="ms-2">data</span>
                        </div>
                    </div>
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang table table-striped">
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
                            <tbody class="tableBody">
                                @forelse  ($TumbuhanBawah as $item)
                                    <tr class="data-row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->total_berat_basah }} Gr</td>
                                        <td>{{ $item->sample_berat_basah }} Gr</td>
                                        <td>{{ $item->sample_berat_kering }} Gr</td>
                                        <td>{{ $item->total_berat_kering }} Gr</td>
                                        <td class="hidden-column">{{ $item->kandungan_karbon }}Kg</td>
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
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data</td>
                                    </tr>
                                @endforelse
                        </table>
                    </div>
                    <div class="table-footer mt-5">
                        {{-- <strong>
                            Menampilkan {{ $TumbuhanBawah->firstItem() }} sampai {{ $TumbuhanBawah->lastItem() }} dari
                            {{ $TumbuhanBawah->total() }}
                            data
                        </strong>
                        <nav>
                            <ul class="pagination">
                                @if ($TumbuhanBawah->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">Kembali</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $TumbuhanBawah->previousPageUrl() }}">Kembali</a></li>
                                @endif

                                @foreach ($TumbuhanBawah->getUrlRange(1, $TumbuhanBawah->lastPage()) as $page => $url)
                                    <li class="page-item {{ $TumbuhanBawah->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if ($TumbuhanBawah->hasMorePages())
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $TumbuhanBawah->nextPageUrl() }}">Lanjut</a>
                                    </li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">Lanjut</span></li>
                                @endif
                            </ul>
                        </nav> --}}
                        <p>Menampilkan data <span class="fromNumber">1</span> sampai <span class="toNumber">5</span>
                            dari
                            <span class="totalData">0</span> data
                        </p>

                        <!-- Tombol Pagination -->
                        <div class="pagination-controls">
                            <button class="  btn-button prevPage" disabled>Sebelumnya</button>
                            <span class="currentPage">1</span> dari <span class="totalPages">0</span>
                            <button class="  btn-button nextPage">Berikutnya</button>
                        </div>
                    </div>
                </div>
                <div class="p-1 paginated-table" id="tanah">
                    <div class="table-header d-flex justify-content-between">
                        {{-- <form method="GET"
                            action="{{ route('DetailPlot.getsubPlot', ['id' => $plot->id ?? 'default-slug']) }}">
                            <div class="tampilkan">
                                <label for="show-entries">Tampilkan</label>
                                <select id="show-entries perPageSelect" class="number-selection" name="perPage"
                                    onchange="this.form.submit()">
                                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                                </select>
                                <span class="ms-2">data</span>
                            </div>
                            </form> --}}
                        <div class="tampilkan">
                            <label for="dataPerPage3">Tampilkan</label>
                            <select class="dataPerPage">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span class="ms-2">data</span>
                        </div>
                    </div>
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang table  table-striped">
                            <thead>
                                <tr>
                                    <th class="kiriPancang">No</th>
                                    <th>Kedalaman Sample</th>
                                    <th>Sample Berat Basah</th>
                                    <th>C organik Tanah</th>
                                    <th>karbon Gr</th>
                                    <th>karbon Ton/Ha</th>
                                    <th>Karbon Ton</th>
                                    <th class="hidden-column kananPancang">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="tableBody">
                                @forelse ($tanah as $item)
                                    <tr class="data-row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kedalaman_sample }} cm</td>
                                        <td>{{ $item->berat_jenis_tanah }} Gr/cm3</td>
                                        <td>{{ $item->C_organic_tanah }} %</td>
                                        <td>{{ $item->carbongr }} Gr/m2</td>
                                        <td class="hidden-column">{{ $item->carbonton }}Ton/Ha</td>
                                        <td class="hidden-column">{{ $item->carbonkg }} Ton</td>
                                        <td class="hidden-column">{{ $item->co2kg }}kg</td>
                                        <td class="hidden-column aksi-button">
                                            <button class="edit-btn">
                                                <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                            </button>
                                            <button class="delete-btn">
                                                <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-footer mt-5">
                        {{-- <strong>
                            Menampilkan {{ $tanah->firstItem() }} sampai {{ $tanah->lastItem() }} dari
                            {{ $tanah->total() }}
                            data
                        </strong>
                        <nav>
                            <ul class="pagination">
                                @if ($tanah->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">Kembali</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $tanah->previousPageUrl() }}">Kembali</a></li>
                                @endif

                                @foreach ($tanah->getUrlRange(1, $tanah->lastPage()) as $page => $url)
                                    <li class="page-item {{ $tanah->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if ($tanah->hasMorePages())
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $tanah->nextPageUrl() }}">Lanjut</a>
                                    </li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">Lanjut</span></li>
                                @endif
                            </ul>
                        </nav> --}}
                        <p>Menampilkan data <span class="fromNumber">1</span> sampai <span class="toNumber">5</span>
                            dari
                            <span class="totalData">0</span> data
                        </p>

                        <!-- Tombol Pagination -->
                        <div class="pagination-controls">
                            <button class=" btn-button prevPage" disabled>Sebelumnya</button>
                            <span class="currentPage">1</span> dari <span class="totalPages">0</span>
                            <button class=" btn-button nextPage">Berikutnya</button>
                        </div>
                    </div>
                </div>
                <div class="p-1 paginated-table" id="pancang">
                    <div class="table-header d-flex justify-content-between">
                        {{-- <form method="GET"
                            action="{{ route('DetailPlot.getsubPlot', ['id' => $plot->id ?? 'default-slug']) }}">
                            <div class="tampilkan">
                                <label for="show-entries">Tampilkan</label>
                                <select id="show-entries perPageSelect" class="number-selection" name="perPage"
                                    onchange="this.form.submit()">
                                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                                </select>
                                <span class="ms-2">data</span>
                            </div>
                        </form> --}}
                        <div class="tampilkan">
                            <label for="dataPerPage4">Tampilkan</label>
                            <select class="dataPerPage">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span class="ms-2">data</span>
                        </div>
                    </div>
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang table  table-striped">
                            <thead>
                                <tr>
                                    <th class="kiriPancang">No</th>
                                    <th>No Pohon</th>
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
                            <tbody class="tableBody">
                                @forelse($pancang as $item)
                                    <tr class="data-row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_pohon }} cm</td>
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
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-footer mt-5">
                        {{-- <strong>
                            Menampilkan {{ $pancang->firstItem() }} sampai {{ $pancang->lastItem() }} dari
                            {{ $pancang->total() }}
                            data
                        </strong>
                        <nav>
                            <ul class="pagination">
                                @if ($pancang->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">Kembali</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $pancang->previousPageUrl() }}">Kembali</a></li>
                                @endif

                                @foreach ($pancang->getUrlRange(1, $pancang->lastPage()) as $page => $url)
                                    <li class="page-item {{ $pancang->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if ($pancang->hasMorePages())
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $pancang->nextPageUrl() }}">Lanjut</a>
                                    </li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">Lanjut</span></li>
                                @endif
                            </ul>
                        </nav> --}}
                        <p>Menampilkan data <span class="fromNumber">1</span> sampai <span class="toNumber">5</span>
                            dari
                            <span class="totalData">0</span> data
                        </p>

                        <!-- Tombol Pagination -->
                        <div class="pagination-controls">
                            <button class="  btn-button prevPage" disabled>Sebelumnya</button>
                            <span class="currentPage">1</span> dari <span class="totalPages">0</span>
                            <button class="  btn-button nextPage">Berikutnya</button>
                        </div>
                    </div>
                </div>

                <div class="p-1 paginated-table" id="tiang">
                    <div class="table-header d-flex justify-content-between">
                        {{-- <form method="GET"
                            action="{{ route('DetailPlot.getsubPlot', ['id' => $plot->id ?? 'default-slug']) }}">
                            <div class="tampilkan">
                                <label for="show-entries">Tampilkan</label>
                                <select id="show-entries perPageSelect" class="number-selection" name="perPage"
                                    onchange="this.form.submit()">
                                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                                </select>
                                <span class="ms-2">data</span>
                            </div>
                        </form> --}}
                        <div class="tampilkan">
                            <label for="dataPerPage4">Tampilkan</label>
                            <select class="dataPerPage">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span class="ms-2">data</span>
                        </div>
                    </div>
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang table table-striped">
                            <thead>
                                <tr>
                                    <th class="kiriPancang">No</th>
                                    <th>No Pohon</th>
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
                            <tbody class="tableBody">
                                @forelse ($tiang as $item)
                                    <tr class="data-row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_pohon }} cm</td>
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
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-footer mt-5">
                        {{-- <strong>
                            Menampilkan {{ $tiang->firstItem() }} sampai {{ $tiang->lastItem() }} dari
                            {{ $tiang->total() }}
                            data
                        </strong>
                        <nav>
                            <ul class="pagination">
                                @if ($tiang->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">Kembali</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $tiang->previousPageUrl() }}">Kembali</a></li>
                                @endif

                                @foreach ($tiang->getUrlRange(1, $tiang->lastPage()) as $page => $url)
                                    <li class="page-item {{ $tiang->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if ($tiang->hasMorePages())
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $tiang->nextPageUrl() }}">Lanjut</a>
                                    </li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">Lanjut</span></li>
                                @endif
                            </ul>
                        </nav> --}}
                        <p>Menampilkan data <span class="fromNumber">1</span> sampai <span class="toNumber">5</span>
                            dari
                            <span class="totalData">0</span> data
                        </p>

                        <!-- Tombol Pagination -->
                        <div class="pagination-controls">
                            <button class=" btn-button prevPage" disabled>Sebelumnya</button>
                            <span class="currentPage">1</span> dari <span class="totalPages">0</span>
                            <button class=" btn-button nextPage">Berikutnya</button>
                        </div>
                    </div>
                </div>
                <div class="p-1 paginated-table" id="pohon">
                    <div class="table-header d-flex justify-content-between">
                        {{-- <form method="GET"
                            action="{{ route('DetailPlot.getsubPlot', ['id' => $plot->id ?? 'default-slug']) }}">
                            <div class="tampilkan">
                                <label for="show-entries">Tampilkan</label>
                                <select id="show-entries perPageSelect" class="number-selection" name="perPage"
                                    onchange="this.form.submit()">
                                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                                </select>
                                <span class="ms-2">data</span>
                            </div>
                        </form> --}}
                        <div class="tampilkan">
                            <label for="dataPerPage5">Tampilkan</label>
                            <select class="dataPerPage">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span class="ms-2">data</span>
                        </div>
                    </div>
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang table table-striped">
                            <thead>
                                <tr>
                                    <th class="kiriPancang">No</th>
                                    <th>No Pohon</th>
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
                            <tbody class="tableBody">

                                @forelse ($pohon as $item)
                                    <tr class="data-row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_pohon }} cm</td>
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
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-footer mt-5">
                        {{-- <strong>
                            Menampilkan {{ $pohon->firstItem() }} sampai {{ $pohon->lastItem() }} dari
                            {{ $pohon->total() }}
                            data
                        </strong>
                        <nav>
                            <ul class="pagination">
                                @if ($pohon->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">Kembali</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $pohon->previousPageUrl() }}">Kembali</a></li>
                                @endif

                                @foreach ($pohon->getUrlRange(1, $pohon->lastPage()) as $page => $url)
                                    <li class="page-item {{ $pohon->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if ($pohon->hasMorePages())
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $pohon->nextPageUrl() }}">Lanjut</a>
                                    </li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">Lanjut</span></li>
                                @endif
                            </ul>
                        </nav> --}}
                        <p>Menampilkan data <span class="fromNumber">1</span> sampai <span class="toNumber">5</span>
                            dari
                            <span class="totalData">0</span> data
                        </p>

                        <!-- Tombol Pagination -->
                        <div class="pagination-controls">
                            <button class=" btn-button prevPage" disabled>Sebelumnya</button>
                            <span class="currentPage">1</span> dari <span class="totalPages">0</span>
                            <button class=" btn-button nextPage">Berikutnya</button>
                        </div>
                    </div>
                </div>
                <div class="p-1 paginated-table" id="nekromas">
                    <div class="table-header d-flex justify-content-between">
                        {{-- <form method="GET"
                            action="{{ route('DetailPlot.getsubPlot', ['id' => $plot->id ?? 'default-slug']) }}">
                            <div class="tampilkan">
                                <label for="show-entries">Tampilkan</label>
                                <select id="show-entries perPageSelect" class="number-selection" name="perPage"
                                    onchange="this.form.submit()">
                                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                                </select>
                                <span class="ms-2">data</span>
                            </div>
                        </form> --}}
                        <div class="tampilkan">
                            <label for="dataPerPage5">Tampilkan</label>
                            <select class="dataPerPage">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span class="ms-2">data</span>
                        </div>
                    </div>
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang table table-striped">
                            <thead>
                                <tr>
                                    <th class="kiriPancang">No</th>
                                    <th>Diameter Pangkal</th>
                                    <th>Diameter Ujung</th>
                                    <th>panjang</th>
                                    <th>Valume</th>
                                    <th class="hidden-column">Berat Jenis Kayur</th>
                                    <th class="hidden-column">Bio diatas tanah</th>
                                    <th class="hidden-column">Kandungan karbon</th>
                                    <th class="hidden-column">Serapan CO2</th>
                                    <th class="hidden-column kananPancang">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="tableBody">
                                @forelse($Necromas as $item)
                                    <tr class="data-row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->diameter_pangkal }} cm</td>
                                        <td>{{ $item->diameter_ujung }} cm</td>
                                        <td>{{ $item->panjang }}</td>
                                        <td>{{ $item->volume }}</td>
                                        <td class="hidden-column">{{ $item->berat_jenis_kayu }}gr/cm3</td>
                                        <td class="hidden-column">{{ $item->biomasa }} kg</td>
                                        <td class="hidden-column">{{ $item->carbon }}kg</td>
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
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-footer mt-5">
                        {{-- <strong>
                            Menampilkan {{ $Necromas->firstItem() }} sampai {{ $Necromas->lastItem() }} dari
                            {{ $Necromas->total() }}
                            data
                        </strong>
                        <nav>
                            <ul class="pagination">
                                @if ($Necromas->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">Kembali</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $Necromas->previousPageUrl() }}">Kembali</a></li>
                                @endif

                                @foreach ($Necromas->getUrlRange(1, $Necromas->lastPage()) as $page => $url)
                                    <li class="page-item {{ $Necromas->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if ($Necromas->hasMorePages())
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $Necromas->nextPageUrl() }}">Lanjut</a>
                                    </li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">Lanjut</span></li>
                                @endif
                            </ul>
                        </nav> --}}
                        <p>Menampilkan data <span class="fromNumber">1</span> sampai <span class="toNumber">5</span>
                            dari
                            <span class="totalData">0</span> data
                        </p>

                        <!-- Tombol Pagination -->
                        <div class="pagination-controls">
                            <button class=" btn-button prevPage" disabled>Sebelumnya</button>
                            <span class="currentPage">1</span> dari <span class="totalPages">0</span>
                            <button class=" btn-button nextPage">Berikutnya</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('apexchart/dist/apexcharts.css') }}" />

    <script src="{{ asset('apexchart/dist/apexcharts.js') }}"></script>
    <script>
        var options = {
            series: [{
                    name: 'Karbon',
                    data: @json($ringkasann->pluck('TotalKandunganKarbon'))

                },
                {
                    name: 'Serapan Karbon',
                    data: @json($ringkasann->pluck('KarbonCo2'))
                }
            ],
            chart: {
                type: 'bar',
                height: '100%',
            },
            colors: ['#198754', '#DC3545'],
            plotOptions: {
                bar: {
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
                categories: @json($ringkasann->pluck('dareah'))
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
                        return val + " Ton";
                    }
                }
            }
        };

        const bar = new ApexCharts(document.querySelector("#bar"), options);
        bar.render();


        function redirectToYear(year) {
            window.location.href = "?tahun=" + year;
        }

        let pieeKarbon = @json($ringkasann->pluck('TotalKandunganKarbon'));
        let flatPieekarbon = pieeKarbon.flat().map(Number);

        // 2. Hitung total jumlah
        let Karbon = flatPieekarbon.reduce((sum, num) => sum + num, 0);
        let pieeSerapan = @json($ringkasann->pluck('KarbonCo2'));
        let flatPieeSerapa = pieeSerapan.flat().map(Number);

        // 2. Hitung total jumlah
        let Serapan = flatPieeSerapa.reduce((sum, num) => sum + num, 0);

        const pieoptions = {
            series: [Karbon, Serapan],
            chart: {
                width: '100%',
                type: 'pie',
            },
            labels: ['  Karbon A', 'Serapan Karbon B'],
            colors: ['#198754', '#DC3545'], // Warna khusus
            dataLabels: {
                enabled: true,
                formatter: function(val, opts) {
                    let total = opts.w.config.series.reduce((a, b) => a + b, 0); // Hitung total semua data
                    let percentage = ((opts.w.config.series[opts.seriesIndex] / total) * 100).toFixed(
                        1); // Hitung persentase
                    return `${opts.w.config.series[opts.seriesIndex]} Ton (${percentage}%)`; // Tampilkan data + persentase
                }
            },
            tooltip: {
                y: {
                    formatter: function(val, opts) {
                        let total = opts?.w?.config?.series?.reduce((a, b) => a + b, 0) ||
                            10000000; // Jika undefined, gunakan 1 agar tidak error
                        let percentage = ((val / total) * 100).toFixed(1); // Hitung persentase
                        return `${val} Ton (${percentage}%)`; // Tooltip juga menampilkan data + persentase
                    }
                },

            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 300
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        const pieChart = new ApexCharts(document.querySelector("#pie"), pieoptions);
        pieChart.render();
        document.addEventListener("DOMContentLoaded", function() {
            let tables = document.querySelectorAll(".paginated-table");

            tables.forEach((table) => {
                let rows = table.querySelectorAll(".data-row");
                let select = table.querySelector(".dataPerPage");
                let prevBtn = table.querySelector(".prevPage");
                let nextBtn = table.querySelector(".nextPage");
                let currentPageElem = table.querySelector(".currentPage");
                let totalDataElem = table.querySelector(".totalData");
                let fromElem = table.querySelector(".fromNumber");
                let toElem = table.querySelector(".toNumber");
                let tableRows = table.querySelectorAll(".tableBody tr");
                let totalPagesElem = table.querySelector(".totalPages");

                let totalData = tableRows.length;
                let currentPage = 1;
                let rowsPerPage = parseInt(select.value) || 5;
                let totalPages = Math.ceil(rows.length / rowsPerPage);

                function displayRows() {
                    rows = table.querySelectorAll(".data-row");
                    totalPages = Math.ceil(rows.length / rowsPerPage);

                    let start = (currentPage - 1) * rowsPerPage;
                    let end = start + rowsPerPage;

                    let fromNumber = start + 1;
                    let toNumber = Math.min(end, rows.length);

                    totalPagesElem.textContent = totalPages;
                    currentPageElem.textContent = currentPage;
                    fromElem.textContent = fromNumber;
                    toElem.textContent = toNumber;
                    totalDataElem.textContent = rows.length;

                    rows.forEach((row, index) => {
                        row.style.display = index >= start && index < end ? "" : "none";
                    });

                    prevBtn.disabled = currentPage === 1;
                    nextBtn.disabled = currentPage === totalPages;
                }

                select.addEventListener("change", function() {
                    rowsPerPage = parseInt(this.value);
                    currentPage = 1;
                    displayRows();
                });

                prevBtn.addEventListener("click", function() {
                    if (currentPage > 1) {
                        currentPage--;
                        displayRows();
                    }
                });

                nextBtn.addEventListener("click", function() {
                    if (currentPage < totalPages) {
                        currentPage++;
                        displayRows();
                    }
                });

                displayRows();
            });
        });
    </script>

@endsection
