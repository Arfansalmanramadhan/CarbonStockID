@extends('layout.mainlayaot')

@section('title', 'Surveyor')

@section('content')
    <div id="prediksi-content" class="page-content content p-4">
        <div class="image-container mt-4">
            <div class="col page-title">
                <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="img-normal" />
                <p class="large-text text-overlay">Manajemen Tim</p>
            </div>
        </div>
        <div class="table-container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form method="post" action="{{ route('Manajemen-Tim.store') }}">
                <div class="row">
                    @csrf
                    {{-- <input type="hidden" name="registrasi_id" value="{{ auth()->user()->id }}"> --}}
                    <div class="col-12 col-md-4">
                        <label for="keliling" class="form-label">Nama Tim</label>
                        <input type="text" class="form-control" id="keliling" value="" name="nama" />
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="keliling" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control form-control-plot-b" id="keliling" value=""
                            name="tanggal_mulai" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="keliling" class="form-label">Tanggal Berakhir</label>
                        <input type="date" class="form-control form-control-plot-b" id="keliling" value=""
                            name="tanggal_berakhir" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-md-4 align-self-center">
                        <button type="submit" class=" text-center btn btn-success p-3">Simpan</button>
                    </div>
                    {{-- <div class="col-6 col-md-4">
                        <button    type="submit" class="  text-center btn btn-success p-3">Tambah Tim </button>
                    </div> --}}
                    {{-- <div class="col-6 col-md-4 align-self-center">
                        <a href="{{ route('Tambah-Surveyor.indexx') }}"class="  text-center btn btn-success p-3">Tambah
                            Surveyor</a>
                        <button type="submit" class="  text-center btn btn-success p-3">Tambah Surveyor</button>
                    </div> --}}
                </div>
            </form>
            <div class="table-container paginated-table">
                {{-- <div class="table-wrapper"> --}}
                <div class="table-header  d-flex justify-content-between">
                    {{-- <form method="GET" action="{{ route('Manajemen-Tim.index') }}">
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
                    <div class="form-control-space">
                        <input type="text" id="searchInput" placeholder="Cari..." class="form-control mb-3"
                            value="{{ $search }}" onkeyup="searchTable()">
                    </div>
                </div>
                <div class="table-wrapper">
                    <table class="custom-table-pancang table  table-striped">
                        <thead>
                            <tr>
                                <th class="kiriPancang">No</th>
                                <th>Nama TIM</th>
                                <th>Tanggal Mulai </th>
                                <th>Tanggal berakhir </th>
                                <th>Jumlah anggota </th>
                                <th class="hidden-column kananPancang">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="tableBody">
                            @forelse($tim as $index => $t)
                                <tr class="data-row">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $t->nama }}</td>
                                    <td>{{ optional($t->periode)->tanggal_mulai  }}</td>
                                    <td>{{ optional($t->periode)->tanggal_berakhir  }}</td>
                                    <td>{{ $t->anggota_tim_count }}</td>
                                    <td class="hidden-column aksi-button">
                                        {{-- <a href="{{ route('anggota.indexx', $t->id) }}"
                                            class="btn btn-info btn-sm">Detail</a> --}}
                                        <form action="{{ route('anggota.indexx', $t->id) }}" method="get">
                                            <button type="submit" class="view-btn">
                                                <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                            </button>
                                        </form>
                                            {{-- <button class="view-btn">
                                                <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                            </button>
                                            <button onclick="window.location.href='{{ route('Tambah-Surveyor.indexx') }}'"
                                                class="add-btn">
                                                <img src="{{ asset('/images/AddIcon.svg') }}" alt="" />
                                            </button>
                                            <button class="delete-btn">
                                                <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                            </button> --}}
                                        </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data</td>
                                </tr>
                            @endforelse
                            {{-- @forelse($tim as $index => $t)
                                    @if ($t->anggotaTim->isNotEmpty())
                                        @foreach ($t->anggotaTim as $anggota)
                                            @foreach ($anggota->periode as $periode)
                                                <tr>
                                                    <td>{{ $tim->firstItem() + $index }}</td>
                                                    <td>{{ $t->nama }}</td>
                                                    <td>{{ $periode->tanggal_mulai }}</td>
                                                    <td>{{ $periode->tanggal_berakhir }}</td>
                                                    <td>{{ $t->jumlah_anggota }}</td>
                                                    <td>
                                                        <a href="{{ route('anggota.indexx', $t->id) }}"
                                                            class="btn btn-info btn-sm">Detail</a>
                                                        <a href="{{ route('tim.edit', $t->id) }}"
                                                            class="btn btn-warning btn-sm">Edit</a>
                                                        <form action="{{ route('tim.destroy', $t->id) }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>{{ $tim->firstItem() + $index }}</td>
                                            <td>{{ $t->nama }}</td>
                                            <td colspan="3" class="text-center">Tidak ada periode</td>
                                            <td>{{ $t->jumlah_anggota }}</td>
                                            <td>
                                                <a href="{{ route('tim.show', $t->id) }}"
                                                    class="btn btn-info btn-sm">Detail</a>
                                                <a href="{{ route('tim.edit', $t->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('tim.destroy', $t->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada data</td>
                                    </tr>
                                @endforelse --}}
                        </tbody>
                    </table>
                </div>
                {{-- <div class="table-footer mt-5">
                        <span>Menampilkan 1 sampai 5 dari 40 data</span>
                        <div class="pagination">
                            <button class="page-btn">Kembali</button>
                            <button class="page-btn active">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn">3</button>
                            <button class="page-btn">4</button>
                            <button class="page-btn">Lanjut</button>
                        </div>
                    </div> --}}
                <div class="table-footer mt-5">
                    {{-- <strong>
                        Menampilkan {{ $tim->firstItem() }} sampai {{ $tim->lastItem() }} dari
                        {{ $tim->total() }} data
                    </strong>
                    <nav>
                        <ul class="pagination">

                            @if ($tim->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">Kembali</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $tim->previousPageUrl() }}">Kembali</a>
                                </li>
                            @endif


                            @foreach ($tim->getUrlRange(1, $tim->lastPage()) as $page => $url)
                                <li class="page-item {{ $tim->currentPage() == $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach


                            @if ($tim->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $tim->nextPageUrl() }}">Lanjut</a>
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
                <!-- 🔄 Pagination -->
                {{-- <div class="d-flex justify-content-center">
                    {{ $tim->links() }}
                </div> --}}
                {{-- </div> --}}
            </div>
        </div>
    </div>
    <script>
        document.getElementById('perPageSelect').addEventListener('change', function() {
            let perPage = this.value;
            let search = document.getElementById('searchInput').value;
            window.location.href = "{{ route('Manajemen-Tim.index') }}" + "?per_page=" + perPage + "&search=" +
                search;
        });

        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                let perPage = document.getElementById('perPageSelect').value;
                let search = this.value;
                window.location.href = "{{ route('Manajemen-Tim.index') }}" + "?per_page=" + perPage + "&search=" +
                    search;
            }
        });
    </script>
@endsection
