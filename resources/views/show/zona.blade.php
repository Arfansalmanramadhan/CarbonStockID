@extends('layout.mainlayaot')

@section('title', 'Zona')

@section('content')
    <div id="prediksi-content" class="page-content content p-4">
        <div class="image-container mt-4">
            <div class="col page-title">
                <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="img-normal" />
                <p class="large-text text-overlay">Zona</p>
            </div>
        </div>
        <div class="table-container">
            <div class="table-wrapper">
                <div class="table-header d-flex justify-content-between">
                    <form method="GET"
                        action="{{ route('zona.getZona', ['slug' => $poltArea->slug ?? 'default-slug']) }}">
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
                    </form>
                    <div class="d-flex align-items-center">
                        <form method="GET"
                            action="{{ route('zona.getZona', ['slug' => $poltArea->slug ?? 'default-slug']) }}">
                            <div class="d-flex align-items-center">
                                <div class="form-control-space">
                                    <input type="text" id="searchInput" name="search" placeholder="Cari..."
                                        class="form-control" value="{{ request('search') }}">
                                </div>
                                <button type="submit" class="btn btn-tambah-data m-3">Cari</button>
                            </div>
                        </form>
                        <button
                            onclick="window.location.href='{{ route('TambahZona.tambah', ['slug' => $poltArea->slug]) }}'"
                            class="btn btn-tambah-data p-3">Tambah</button>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table class="custom-table-pancang">
                        <thead>
                            <tr>
                                <th class="kiriPancang">No</th>
                                <th>Nama Zona</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Jenis Hutan</th>
                                <th class="hidden-column kananPancang">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="data-table">
                            @forelse ($zona as $index)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $index->zona }}</td>
                                    <td>{{ $index->latitude }}</td>
                                    <td>{{ $index->longitude }}</td>
                                    <td>{{ $index->jenis_hutan }}</td>
                                    <td class="hidden-column aksi-button">
                                        {{-- <a href="{{ route('hamparan.getHamparan', ['slug' => $item->slug]) }}"
                                            class="btn btn-info btn-sm">Detail</a> --}}
                                        <form action="{{ route('hamparan.getHamparan', ['id' => $index->id]) }}"
                                            method="get">
                                            <button type="submit" class="view-btn">
                                                <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                            </button>
                                        </form>
                                        {{-- <button class="view-btn">
                                            <img src="{{ asset('/images/Eye.svg') }}" alt="View" />
                                        </button> --}}

                                        <button class="delete-btn">
                                            <img src="{{ asset('/images/Trash.svg') }}" alt="Delete" />
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
                    <strong>
                        Menampilkan {{ $zona->firstItem() }} sampai {{ $zona->lastItem() }} dari {{ $zona->total() }}
                        data
                    </strong>
                    <nav>
                        <ul class="pagination">
                            @if ($zona->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">Kembali</span></li>
                            @else
                                <li class="page-item"><a class="page-link"
                                        href="{{ $zona->previousPageUrl() }}">Kembali</a></li>
                            @endif

                            @foreach ($zona->getUrlRange(1, $zona->lastPage()) as $page => $url)
                                <li class="page-item {{ $zona->currentPage() == $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if ($zona->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $zona->nextPageUrl() }}">Lanjut</a>
                                </li>
                            @else
                                <li class="page-item disabled"><span class="page-link">Lanjut</span></li>
                            @endif
                        </ul>
                    </nav>
                </div>
                <div class="d-flex justify-content-between">
                    {{ $zona->links() }}
                </div>
            </div>
        </div>
        <div class="table-container card">
            <div class="card-body">
                <div class="d-flex justify-content-between">

                    <h4 class="card-title mb-4">Data Subplot</h4>
                    <button onclick="window.location.href='{{ route('hitung.index') }}'"
                        class="btn btn-tambah-data mb-4">Kalklasi perhitungan</button>
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
                    <div class="tab-pane p-1" id="serasah">
                        <div class="table-header d-flex justify-content-between">
                            <form method="GET"
                                action="{{ route('zona.getZona', ['slug' => $poltArea->slug ?? 'default-slug']) }}">
                                <div class="tampilkan">
                                    <label for="show-entries">Tampilkan</label>
                                    <select id="show-entries perPageSelect" class="number-selection" name="perPage"
                                        onchange="this.form.submit()">
                                        <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                                        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10
                                        </option>
                                        <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20
                                        </option>
                                    </select>
                                    <span class="ms-2">data</span>
                                </div>
                            </form>
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
                                    @forelse ($Serasah as $item)
                                        <tr>
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
                            <strong>
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
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="p-1" id="semai">
                    <div class="table-header d-flex justify-content-between">
                        <form method="GET"
                            action="{{ route('zona.getZona', ['slug' => $poltArea->slug ?? 'default-slug']) }}">
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
                        </form>
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
                                @forelse ($Semai as $item)
                                    <tr>
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
                        <strong>
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
                        </nav>
                    </div>
                </div>
                <div class="p-1" id="tumbuhanBawah">
                    <div class="table-header d-flex justify-content-between">
                        <form method="GET"
                            action="{{ route('zona.getZona', ['slug' => $poltArea->slug ?? 'default-slug']) }}">
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
                        </form>
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
                                @forelse  ($TumbuhanBawah as $item)
                                    <tr>
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
                        <strong>
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
                        </nav>
                    </div>
                </div>
                <div class="p-1" id="tanah">
                    <div class="table-header d-flex justify-content-between">
                        <<form method="GET"
                            action="{{ route('zona.getZona', ['slug' => $poltArea->slug ?? 'default-slug']) }}">
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
                            </form>
                    </div>
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang  table-striped">
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
                            <tbody>
                                @forelse ($tanah as $item)
                                    <tr>
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
                        <strong>
                            Menampilkan {{ $zona->firstItem() }} sampai {{ $zona->lastItem() }} dari
                            {{ $zona->total() }}
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
                        </nav>
                    </div>

                </div>
                <div class="p-1" id="pancang">
                    <div class="table-header d-flex justify-content-between">
                        <form method="GET"
                            action="{{ route('zona.getZona', ['slug' => $poltArea->slug ?? 'default-slug']) }}">
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
                        </form>
                    </div>
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang  table-striped">
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
                            <tbody>
                                @forelse($pancang as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_pohon }} </td>
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
                        <strong>
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
                        </nav>
                    </div>
                </div>

                <div class="p-1" id="tiang">
                    <div class="table-header d-flex justify-content-between">
                        <form method="GET"
                            action="{{ route('zona.getZona', ['slug' => $poltArea->slug ?? 'default-slug']) }}">
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
                        </form>
                    </div>
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang table-striped">
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
                            <tbody>
                                @forelse ($tiang as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_pohon }} </td>
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
                        <strong>
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
                        </nav>
                    </div>
                </div>
                <div class="p-1" id="pohon">
                    <div class="table-header d-flex justify-content-between">
                        <form method="GET"
                            action="{{ route('zona.getZona', ['slug' => $poltArea->slug ?? 'default-slug']) }}">
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
                        </form>
                    </div>
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang table-striped">
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
                            <tbody>

                                @forelse ($pohon as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_pohon }} </td>
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
                        <strong>
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
                        </nav>
                    </div>
                </div>
                <div class="p-1" id="nekromas">
                    <div class="table-header d-flex justify-content-between">
                        <form method="GET"
                            action="{{ route('zona.getZona', ['slug' => $poltArea->slug ?? 'default-slug']) }}">
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
                        </form>
                    </div>
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang table-striped">
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
                            <tbody>
                                @forelse($Necromas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->diameter_pangkal }} m</td>
                                        <td>{{ $item->diameter_ujung }} m</td>
                                        <td>{{ $item->panjang }} m</td>
                                        <td>{{ $item->volume }} m3</td>
                                        <td class="hidden-column">{{ $item->berat_jenis_kayu }} gr/cm3</td>
                                        <td class="hidden-column">{{ $item->biomasa }} kg</td>
                                        <td class="hidden-column">{{ $item->carbon }} kg</td>
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
                        <strong>
                            Menampilkan {{ $Necromas->firstItem() }} sampai {{ $Necromas->lastItem() }} dari {{ $Necromas->total() }}
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
                                    <li class="page-item"><a class="page-link" href="{{ $Necromas->nextPageUrl() }}">Lanjut</a>
                                    </li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">Lanjut</span></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        {{-- <form method="GET" action="{{ route('Lokasi.lokasi') }}"></form> --}}

        <div class="row mb-3">
            @foreach ($ringkasan as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card h-100 border-light shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-center text-success">Pendekatan Kerapatan</h5>
                            <p class="card-text text-center text-muted">
                                <strong>{{ $item['zona'] ?? 'Data tidak tersedia' }}</strong>
                            </p>
                            <div class="mt-3">
                                <p class="text-dark">Biomassa di atas permukaan tanah (ton/ha):</p>
                                <p class="card-text text-start text-success fw-bold">
                                    {{ $item['Biomassadiataspermukaantanah'] ?? 0 }}</p>
                            </div>
                            <div class="mt-3">
                                <p class="text-dark">Kandungan karbon (ton/ha):</p>
                                <p class="card-text text-start text-success fw-bold">{{ $item['Kandungankarbon'] ?? 0 }}
                                </p>
                            </div>
                            <div class="mt-3">
                                <p class="text-dark">Serapan CO2 (ton/ha):</p>
                                <p class="card-text text-start text-success fw-bold">{{ $item['SerapanCO2'] ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @foreach ($ringkasann as $item)
            <div class="row">
                <div class="col-md-6  height-card box-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-0">Summary Kandungan Karbon</h4>
                            <p class="mb-3">Bagian ini untuk menampilkan hitungan total kandungan karbon untuk lokasi
                                {{ $poltArea->daerah }}</p>

                            <div class="table-wrapper ">
                                <table class=" custom-table-pancang table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Subplot</th>
                                            <th class="text-right text-center">Karbon</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Seresah</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs ">{{ $item['SerasahKarbon'] ?? 0 }} Ton C/Ha
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Semai</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs">{{ $item['semaiKarbon'] ?? 0 }} Ton C/Ha
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tumbuhan Bawah</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs">{{ $item['tumbuhanbawahkarbon'] ?? 0 }} Ton C/Ha
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Pancang</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs">{{ $item['TotalPancangkarbon'] ?? 0 }} Ton C/Ha
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Tiang</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs">{{ $item['TotalTiangKarbon'] ?? 0 }} Ton C/Ha
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Nekromas</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs">{{ $item['NecromassCarbon'] ?? 0 }} Ton C/Ha</div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Pohon</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs">{{ $item['TotalPohonkarbon'] ?? 0 }} Ton C/Ha
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Tanah</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs">{{ $item['TanahCarbon'] ?? 0 }} Ton C/Ha</div>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>Total</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs">{{ $item['TotalKandunganKarbon'] ?? 0 }} Ton C/Ha
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-6  height-card box-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-0">Summary Serapan CO2</h4>
                            <p class="mb-3">Bagian ini untuk menampilkan hitungan total serapa CO2 untuk lokasi
                                {{ $poltArea->daerah }}</p>

                            <div class="table-wrapper ">
                                <table class=" custom-table-pancang table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Subplot</th>
                                            <th class="text-right text-center">Karbon</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Seresah</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs ">{{ $item['Serasahco2'] ?? 0 }} Ton C/Ha</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Semai</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs">{{ $item['semaico2'] ?? 0 }} Ton C/Ha</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tumbuhan Bawah</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs">{{ $item['tumbuhanbawahco2'] ?? 0 }} Ton C/Ha
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Pancang</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs">{{ $item['TotalPancangco2'] ?? 0 }} Ton C/Ha</div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Tiang</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs">{{ $item['TotalTiangco2'] ?? 0 }} Ton C/Ha</div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Nekromas</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs">{{ $item['Necromassco2'] ?? 0 }} Ton C/Ha</div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Pohon</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs">{{ $item['TotalPohonco2'] ?? 0 }} Ton C/Ha</div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Tanah</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs">{{ $item['TanahCo2'] ?? 0 }} Ton C/Ha</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Akar</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs">{{ $item['beratMasaAkar'] ?? 0 }} Ton C/Ha
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Total</td>
                                            <td class="text-right">
                                                <div class="badge btn-successs">{{ $item['KarbonCo2'] ?? 0 }} Ton C/Ha</div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row mt-4">
                <div class="card">

                    <div class="card-body">
                        <h4 class="card-title mb-4">Rekapan Perhitungan Carbon 5 Poll Di {{ $poltArea->daerah }}</h4>


                        <div class="table-wrapper table-responsive">
                            <table class="custom-table-pancang table-striped table">
                                <thead>
                                    <tr>
                                        <th class="kiriPancang">No</th>
                                        <th>Nama Penghitungan</th>
                                        <th>Total CO2</th>
                                        <th>Luas Tanah (ha)</th>
                                        <th>Total</th>
                                        <th class="hidden-column kananPancang">Persen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="">1</td>
                                        <td>Serasah</td>
                                        <td>{{ $item['Serasahco2'] ?? 0 }} Ton C/Ha</td>
                                        <td>{{ $item['faktor'] ?? 0 }} Ha</td>
                                        <td>{{ $item['Serasah'] ?? 0 }} Ton C/Ha</td>
                                        <td>{{ $item['hasilSerasahPersen'] ?? 0 }} %</td>
                                        {{-- {{ dd($item) }} --}}
                                    </tr>
                                    <tr>
                                        <td class="">2</td>
                                        <td>Necromass</td>
                                        <td>{{ $item['Necromassco2'] ?? 0 }} Ton C/Ha</td>
                                        <td>{{ $item['faktor'] ?? 0 }} Ha</td>
                                        <td>{{ $item['Necromass'] ?? 0 }} Ton C/Ha</td>
                                        <td>{{ $item['hasilNecromassPersen'] ?? 0 }} %</td>

                                    </tr>
                                    <tr>
                                        <td class="">3</td>
                                        <td>Co2 Tanaman</td>
                                        <td>{{ $item['TotalCarbonn'] ?? 0 }} Ton C/Ha</td>
                                        <td>{{ $item['faktor'] ?? 0 }} Ha</td>
                                        <td>{{ $item['Co2Tanaman'] ?? 0 }} Ton C/Ha</td>
                                        <td>{{ $item['hasilco2tanamanPersen'] ?? 0 }} %</td>

                                    </tr>
                                    <tr>
                                        <td class="">4</td>
                                        <td>Tanah</td>
                                        <td>{{ $item['TanahCo2'] ?? 0 }} Ton C/Ha</td>
                                        <td>{{ $item['faktor'] ?? 0 }} Ha</td>
                                        <td>{{ $item['tanah'] ?? 0 }} Ton C/Ha</td>
                                        <td>{{ $item['hasiltanahPersen'] ?? 0 }} %</td>

                                    </tr>
                                    <tr>
                                        <td class="">5</td>
                                        <td>Berat bioomasa akar</td>
                                        <td>{{ $item['beratMasaAkar'] ?? 0 }} Ton C/Ha</td>
                                        <td>{{ $item['faktor'] ?? 0 }} Ha</td>
                                        <td>{{ $item['BeratBiomassaAkar'] ?? 0 }} Ton C/Ha</td>
                                        <td>{{ $item['hasilakarPersen'] ?? 0 }} %</td>

                                    </tr>
                                    <tr>
                                        <td colspan="4">Total Carbon 5 Poll</td>
                                        <td colspan="2">{{ $item['TotalKaoobon'] ?? 0 }} Ton </td>

                                    </tr>
                                    <tr>
                                        <td colspan="4">Baseline Lahan Kosong</td>
                                        <td colspan="2">{{ $item['BaselineLahanKosong'] ?? 0 }} Ton C/Ha</td>

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
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script></script>
@endsection
