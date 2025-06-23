@extends('layout.mainlayaot')

@section('title', 'Subplot')

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
                <div class="d-flex justify-content-between">

                    <h4 class="card-title mb-4">Data Subplot</h4>
                    <p class=" card-title  mb-4">{{ $poltArea->daerah }}</p>
                    {{-- <p class=" mb-4">{{$poltArea}}</p> --}}

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
                                        <th>Serapan CO<SUP>2</SUP></th>
                                        <th class="hidden-column kananPancang">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="tableBody">
                                    @forelse ($Serasah as $item)
                                        <tr class="data-row">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ number_format($item->total_berat_basah, 2) }} Gr</td>
                                            <td>{{ number_format($item->sample_berat_basah, 2) }} Gr</td>
                                            <td>{{ number_format($item->sample_berat_kering, 2) }} Gr</td>
                                            <td>{{ number_format($item->total_berat_kering, 2) }} Gr</td>
                                            <td class="hidden-column">{{ number_format($item->kandungan_karbon, 2) }}kg</td>
                                            <td class="hidden-column">{{ number_format($item->co2, 2) }} kg</td>
                                            <td class="hidden-column aksi-button">
                                                <button
                                                    onclick="window.location.href='{{ route('edit.edit', ['id' => $subplot->id]) }}'"
                                                    class="edit-btn">
                                                    <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                                </button>
                                                <form action="{{ route('Serasah.destroy', ['id' => $item->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete-btn">
                                                        <img src="{{ asset('/images/Trash.svg') }}" alt="Delete" />
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Belum ada data</td>
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
                                        <td>{{ number_format($item->total_berat_basah, 2) }} Gr</td>
                                        <td>{{ number_format($item->sample_berat_basah, 2) }} Gr</td>
                                        <td>{{ number_format($item->sample_berat_kering, 2) }} Gr</td>
                                        <td>{{ number_format($item->total_berat_kering, 2) }} Gr</td>
                                        <td class="hidden-column">{{ number_format($item->kandungan_karbon, 2) }}kg</td>
                                        <td class="hidden-column">{{ number_format($item->co2, 2) }} kg</td>
                                        <td class="hidden-column aksi-button">
                                            <button
                                                onclick="window.location.href='{{ route('edit.edit', ['id' => $subplot->id]) }}'"
                                                class="edit-btn">
                                                <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                            </button>
                                            <form action="{{ route('Semai.destroy', ['id' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-btn">
                                                    <img src="{{ asset('/images/Trash.svg') }}" alt="Delete" />
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada data</td>
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
                                        <td>{{ number_format($item->total_berat_basah, 2) }} Gr</td>
                                        <td>{{ number_format($item->sample_berat_basah, 2) }} Gr</td>
                                        <td>{{ number_format($item->sample_berat_kering, 2) }} Gr</td>
                                        <td>{{ number_format($item->total_berat_kering, 2) }} Gr</td>
                                        <td class="hidden-column">{{ number_format($item->kandungan_karbon, 2) }}kg</td>
                                        <td class="hidden-column">{{ number_format($item->co2, 2) }} kg</td>
                                        <td class="hidden-column aksi-button">
                                            <button
                                                onclick="window.location.href='{{ route('edit.edit', ['id' => $subplot->id]) }}'"
                                                class="edit-btn">
                                                <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                            </button>
                                            <form action="{{ route('tumbuhanBawah.destroy', ['id' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-btn">
                                                    <img src="{{ asset('/images/Trash.svg') }}" alt="Delete" />
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada data</td>
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
                        <div class="d-flex align-items-center">
                            <button onclick="window.location.href='{{ route('tanah.index', ['id' => $subplot->id]) }}'"
                                class="btn btn-tambah-data mt-3 ">Tambah</button>
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
                                    <th>Serapan Co2</th>
                                    <th class="hidden-column kananPancang">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="tableBody">
                                @forelse ($tanah as $item)
                                    <tr class="data-row">
                                        <td>{{ $loop->iteration }}</td>
                                        <<td>{{ number_format($item->kedalaman_sample, 2) }} Cm</td>
                                            <td>{{ number_format($item->berat_jenis_tanah, 2) }} Gr/Cm<sup>3</sup></td>
                                            <td>{{ number_format($item->C_organic_tanah, 0) }} %</td>
                                            <td>{{ number_format($item->carbongr, 2) }} Gr/Cm<SUP>2</SUP></td>
                                            <td class="hidden-column">{{ number_format($item->carbonton, 2) }}Ton/Ha</td>
                                            <td class="hidden-column">{{ number_format($item->carbonkg, 2) }} Ton</td>
                                            <td class="hidden-column">{{ number_format($item->co2kg, 2) }}Kg</td>
                                            <td class="hidden-column aksi-button">
                                                <button
                                                    onclick="window.location.href='{{ route('edit.edit', ['id' => $subplot->id]) }}'"
                                                    class="edit-btn">
                                                    <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                                </button>
                                                <form action="{{ route('tanah.destroy', ['id' => $item->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete-btn">
                                                        <img src="{{ asset('/images/Trash.svg') }}" alt="Delete" />
                                                    </button>
                                                </form>
                                            </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Belum ada data</td>
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
                                    <th>Jumlah Pohon</th>
                                    <th>Keliling</th>
                                    <th>Diameter</th>
                                    <th>Nama Lokal</th>
                                    <th>Nama Ilmiah</th>
                                    <th>Kerapatan Jenis Kayu</th>
                                    <th>Biomasa</th>
                                    <th>Kandungan karbon</th>
                                    <th>Serapan CO<SUP>2</SUP></th>
                                    <th class="hidden-column kananPancang">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="tableBody">
                                @forelse($pancang as $item)
                                    {{-- @dd($item) --}}
                                    <tr class="data-row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ number_format($item->no_pohon, 0) }}</td>
                                        <td>{{ number_format($item->keliling, 1) }} Cm</td>
                                        <td>{{ number_format($item->diameter, 1) }} Cm</td>
                                        <td>{{ $item->nama_lokal }}</td>
                                        <td>{{ $item->nama_ilmiah }}</td>
                                        <td class="hidden-column">
                                            {{ number_format($item->kerapatan_jenis_kayu, 2) }}Gr/Cm<SUP>3</SUP></td>
                                        <td class="hidden-column">{{ number_format($item->bio_di_atas_tanah, 2) }} Kg</td>
                                        <td class="hidden-column">{{ number_format($item->kandungan_karbon, 2) }}Kg</td>
                                        <td class="hidden-column">{{ number_format($item->co2, 2) }} Kg</td>
                                        <td class="hidden-column aksi-button">

                                            <form action="{{ route('pancang.destroy', ['id' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-btn">
                                                    <img src="{{ asset('/images/Trash.svg') }}" alt="Delete" />
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">Belum ada data</td>
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
                                    <th>Jumlah Pohon</th>
                                    <th>Keliling</th>
                                    <th>Diameter</th>
                                    <th>Nama Lokal</th>
                                    <th>Nama Ilmiah</th>
                                    <th>Kerapatan Jenis Kayu</th>
                                    <th>Biomasa</th>
                                    <th>Kandungan karbon</th>
                                    <th>Serapan CO<SUP>2</SUP> </th>
                                    <th class="hidden-column kananPancang">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="tableBody">
                                @forelse ($tiang as $item)
                                    {{-- @dd($item) --}}
                                    <tr class="data-row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ number_format($item->no_pohon, 0) }}</td>
                                        <td>{{ number_format($item->keliling, 1) }} Cm</td>
                                        <td>{{ number_format($item->diameter, 1) }} Cm</td>
                                        <td>{{ $item->nama_lokal }}</td>
                                        <td>{{ $item->nama_ilmiah }}</td>
                                        <td class="hidden-column">
                                            {{ number_format($item->kerapatan_jenis_kayu, 2) }}Gr/Cm<SUP>3</SUP></td>
                                        <td class="hidden-column">{{ number_format($item->bio_di_atas_tanah, 2) }} Kg</td>
                                        <td class="hidden-column">{{ number_format($item->kandungan_karbon, 2) }}Kg</td>
                                        <td class="hidden-column">{{ number_format($item->co2, 2) }} Kg</td>
                                        <td class="hidden-column aksi-button">
                                            <form action="{{ route('tiang.destroy', ['id' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-btn">
                                                    <img src="{{ asset('/images/Trash.svg') }}" alt="Delete" />
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">Belum ada data</td>
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
                                    <th>Jumlah Pohon</th>
                                    <th>Keliling</th>
                                    <th>Diameter</th>
                                    <th>Nama Lokal</th>
                                    <th>Nama Ilmiah</th>
                                    <th>Kerapatan Jenis Kayu</th>
                                    <th>Biomasa</th>
                                    <th>Kandungan karbon</th>
                                    <th>Serapan CO<SUP>2</SUP> </th>
                                    <th class="hidden-column kananPancang">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="tableBody">

                                @forelse ($pohon as $item)
                                    <tr class="data-row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ number_format($item->no_pohon, 0) }}</td>
                                        <td>{{ number_format($item->keliling, 1) }} Cm</td>
                                        <td>{{ number_format($item->diameter, 1) }} Cm</td>
                                        <td>{{ $item->nama_lokal }}</td>
                                        <td>{{ $item->nama_ilmiah }}</td>
                                        <td class="hidden-column">
                                            {{ number_format($item->kerapatan_jenis_kayu, 2) }}Gr/Cm<SUP>3</SUP></td>
                                        <td class="hidden-column">{{ number_format($item->bio_di_atas_tanah, 2) }} Kg</td>
                                        <td class="hidden-column">{{ number_format($item->kandungan_karbon, 2) }}Kg</td>
                                        <td class="hidden-column">{{ number_format($item->co2, 2) }} Kg</td>
                                        <td class="hidden-column aksi-button">
                                            <form action="{{ route('pohon.destroy', ['id' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-btn">
                                                    <img src="{{ asset('/images/Trash.svg') }}" alt="Delete" />
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">Belum ada data</td>
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
                                    <th class="hidden-column">Biomasa</th>
                                    <th class="hidden-column">Kandungan karbon</th>
                                    <th class="hidden-column">Serapan CO<SUP>2</SUP></th>
                                    <th class="hidden-column kananPancang">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="tableBody">
                                @forelse($Necromas as $item)
                                    <tr class="data-row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ number_format($item->diameter_pangkal, 2) }} M</td>
                                        <td>{{ number_format($item->diameter_ujung, 2) }} M</td>
                                        <td>{{ number_format($item->panjang, 2) }} M</td>
                                        <td>{{ number_format($item->volume, 3) }} M<SUP>3</SUP></td>
                                        <td class="hidden-column">
                                            {{ number_format($item->berat_jenis_kayu, 2) }}Gr/M<SUP>3</SUP></td>
                                        <td class="hidden-column">{{ number_format($item->biomasa, 2) }} Kg</td>
                                        <td class="hidden-column">{{ number_format($item->carbon, 2) }}Kg</td>
                                        <td class="hidden-column">{{ number_format($item->co2, 2) }} Kg</td>
                                        <td class="hidden-column aksi-button">
                                            <form action="{{ route('nekromas.destroy', ['id' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-btn">
                                                    <img src="{{ asset('/images/Trash.svg') }}" alt="Delete" />
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">Belum ada data</td>
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
    <script></script>
@endsection
