@extends('layout.mainlayaot')

@section('title', 'Lokasi')

@section('content')
    <div id="prediksi-content" class="page-content content p-4">
        <div class="image-container mt-4">
            <div class="col page-title">
                <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="img-normal" />
                <p class="large-text text-overlay">Lokasi</p>
            </div>
        </div>
        <div class="table-container">
            <div class="table-container paginated-table">
                {{-- <div class="table-wrapper"> --}}
                <div class="table-header d-flex justify-content-between">
                    {{-- <form method="GET" action="{{ route('Lokasi.lokasi') }}">
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
                        <label for="dataPerPage6">Tampilkan</label>
                        <select class="dataPerPage">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span class="ms-2">data</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <form method="GET" action="{{ route('Lokasi.lokasi') }}">
                            <div class="d-flex align-items-center">
                                <div class="form-control-space">
                                    <input type="text"class="form-control" id="search" name="search"
                                        value="{{ request('search') }}" placeholder="Cari daerah atau status..."
                                        onkeyup="searchTable()">
                                </div>
                                <button type="submit" class="btn btn-tambah-data ">Cari</button>
                            </div>
                        </form>

                        <button onclick="window.location.href='{{ route('Lokasi.index') }}'"
                            class="btn btn-tambah-data m-3">Tambah</button>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table class="custom-table-pancang table  ">
                        <thead>
                            <tr>
                                <th class="kiriPancang">No</th>
                                <th>Nama Lokasi</th>
                                <th>Nama Tim</th>
                                <th>Jenis Hutan</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Tanggal Pengamatan </th>
                                <th>Tanggal Surver </th>
                                <th class="hidden-column kananPancang">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                    <td>1</td>
                                    <td>Telkom University</td>
                                    <td>Detail</td>
                                    <td>Hutan hujan tropis</td>
                                    <td>-6.9744, 107.6303</td>
                                    <td>2024-04-21</td>
                                    <td>2024-04-24</td>
                                    <td class="hidden-column aksi-button">
                                        <button class="view-btn">
                                            <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                        </button>
                                        <button onclick="window.location.href='{{ route('Tambah-Surveyor.indexx') }}'"
                                            class="add-btn">
                                            <img src="{{ asset('/images/AddIcon.svg') }}" alt="" />
                                        </button>
                                        <button class="delete-btn">
                                            <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                        </button>
                                    </td>
                                </tr> --}}
                        </tbody>
                        <tbody class="tableBody">
                            @forelse ($lokasi as $index)
                                <tr class="data-row">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $index->daerah }}</td>
                                    <td>
                                        @if ($index->tim)
                                            {{ $index->tim->nama }}
                                        @else
                                            <form action="{{ route('tim.create', ['lokasi_id' => $index->id]) }}" method="GET">
                                                <button type="submit" class="add-btn" title="Tambah Tim">
                                                    <img src="{{ asset('/images/AddIcon.svg') }}" alt="Tambah Tim" />
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>{{ $index->jenis_hutan }}</td>
                                    <td>{{ $index->latitude }}</td>
                                    <td>{{ $index->longitude }}</td>
                                    <td>{{ $index->periode_pengamatan }}</td>
                                    <td>{{ $index->created_at }}</td>
                                    <td class="hidden-column aksi-button">
                                        <form action="{{ route('zona.getZona', ['slug' => $index->slug]) }}"
                                            method="get">
                                            <button type="submit" class="view-btn">
                                                <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                            </button>
                                        </form>
                                        <button onclick="window.location.href='{{ route('Lokasi.edit', $index->slug) }}'"
                                            class="add-btn">
                                            <img src="{{ asset('/images/PencilSquare.svg') }}" alt="Add" />
                                        </button>
                                        <form action="{{ route('Lokasi.destroy', ['id' => $index->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn">
                                                <img src="{{ asset('/images/Trash.svg') }}" alt="Delete" />
                                            </button>
                                        </form>
                                        {{-- <button>👁️</button>
                                            <button>➕</button>
                                            <button>🗑️</button> --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="table-footer mt-5">
                    {{-- <strong>
                        Menampilkan {{ $lokasi->firstItem() }} sampai {{ $lokasi->lastItem() }} dari
                        {{ $lokasi->total() }} data
                    </strong>
                    <nav>
                        <ul class="pagination">

                            @if ($lokasi->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">Kembali</span></li>
                            @else
                                <li class="page-item"><a class="page-link"
                                        href="{{ $lokasi->previousPageUrl() }}">Kembali</a></li>
                            @endif

                            @foreach ($lokasi->getUrlRange(1, $lokasi->lastPage()) as $page => $url)
                                <li class="page-item {{ $lokasi->currentPage() == $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach


                            @if ($lokasi->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $lokasi->nextPageUrl() }}">Lanjut</a>
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
                <!-- Pagination -->
                {{-- <div class="d-flex justify-content-between">
                    {{ $lokasi->links() }}
                </div> --}}
                {{-- </div> --}}
            </div>
        </div>
    </div>
    <script>
        // function searchTable() {
        //     let input = document.getElementById("search-box").value.toLowerCase();
        //     let rows = document.querySelectorAll("#data-table tbody tr");

        //     rows.forEach(row => {
        //         let text = row.innerText.toLowerCase();
        //         row.style.display = text.includes(input) ? "" : "none";
        //     });
        // }
        document.getElementById('perPageSelect').addEventListener('change', function() {
            let perPage = this.value;
            let search = document.getElementById('searchInput').value;
            window.location.href = "{{ route('Lokasi.lokasi') }}" + "?per_page=" + perPage + "&search=" + search;
        });

        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                let perPage = document.getElementById('perPageSelect').value;
                let search = this.value;
                window.location.href = "{{ route('Lokasi.lokasi') }}" + "?per_page=" + perPage + "&search=" +
                    search;
            }
        });
    </script>
@endsection
