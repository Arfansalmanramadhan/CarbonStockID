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
                <div class="d-flex justify-content-between">

                    <h4 class="card-title mb-4">Data Subplot</h4>
                    {{-- <button onclick="window.location.href='{{ route('hitung.plot') }}'"
                        class="btn btn-tambah-data mb-4">Kalklasi perhitungan</button> --}}
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
                                action="{{ route('DetailPlot.getsubPlot', ['id' => $plot->id ?? 'default-slug']) }}">
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
                                                <button
                                                    onclick="window.location.href='{{ route('edit.edit', ['id' => $subplot->id]) }}'"
                                                    class="edit-btn">
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
                                            <button
                                                onclick="window.location.href='{{ route('edit.edit', ['id' => $subplot->id]) }}'"
                                                class="edit-btn">
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
                                            <button
                                                onclick="window.location.href='{{ route('edit.edit', ['id' => $subplot->id]) }}'"
                                                class="edit-btn">
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
                        <form method="GET"
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
                        </form>
                        <div class="d-flex align-items-center">
                            <button onclick="window.location.href='{{ route('tanah.index', ['id' => $subplot->id]) }}'"
                                class="btn btn-tambah-data mt-3 ">Tambah</button>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                    <div class="table-wrapper table-responsive">
                        <table class="custom-table-pancang  table-striped">
                            <thead>
                                <tr>
                                    <th class="kiriPancang">No</th>
                                    <th>Kedalaman Sample</th>
                                    <th>Berat Jenis Basah</th>
                                    <th>C Organik Tanah</th>
                                    <th>karbon Gr</th>
                                    <th>karbon Ton/Ha</th>
                                    <th>Karbon Ton</th>
                                    <th>Serapan CO2</th>
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
                                            <button
                                                onclick="window.location.href='{{ route('edit.edit', ['id' => $subplot->id]) }}'"
                                                class="edit-btn">
                                                <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                            </button>
                                            <form action="{{ route('tanah.destroy', ['id' => $tanah->id]) }}"
                                                method="POST">
                                                {{-- <form action="{{ route('tanah.destroy', ['id' => $subplot->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');"> --}}
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
                                        <td colspan="7" class="text-center">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-footer mt-5">
                        <strong>
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
                        </nav>
                    </div>

                </div>
                <div class="p-1" id="pancang">
                    <div class="table-header d-flex justify-content-between">
                        <form method="GET"
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
                        <strong>
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
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <script></script>
    @endsection
