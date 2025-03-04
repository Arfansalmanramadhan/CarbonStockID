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
            <div class="table-container">
                <div class="table-wrapper">
                    <div class="table-header d-flex justify-content-between">
                        {{-- <form method="GET" action="{{ route('Lokasi.lokasi') }}"> --}}
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

                            <div class="form-control-space">
                                {{-- <input type="text" id="searchInput" placeholder="Cari..." class="form-control mb-3"
                                    value="{{ $search }}" onkeyup="searchTable()"> --}}
                            </div>
                            <!-- Button to trigger modal -->
                            {{-- <button onclick="window.location.href='{{ route('Lokasi.index') }}'"
                                class="btn btn-tambah-data p-3">Tambah</button> --}}
                        </div>
                    </div>
                    <table class="custom-table-pancang">
                        <thead>
                            <tr>
                                <th class="kiriPancang">No</th>
                                <th>Nama Zona</th>
                                <th>Daftar Tim</th>
                                <th>Jenis Hutan</th>
                                <th>Koordinat</th>
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
                        <tbody id="data-table ">
                            {{-- @foreach ($lokasi as $index => $item)
                                <tr>
                                    <td>{{ $lokasi->firstItem() + $index }}</td>
                                    <td>{{ $item->daerah }}</td>
                                    <td>{{ $item->jenis_hutan }}</td>
                                    <td>{{ $item->latitude }}, {{ $item->longitude }}</td>
                                    <td>{{ $item->periode_pengamatan }}</td>
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
                                        <button>👁️</button>
                                        <button>➕</button>
                                        <button>🗑️</button>
                                    </td>
                                </tr>
                            @endforeach --}}


                        </tbody>

                    </table>
                    {{-- <div class="table-footer mt-5">
                        <strong>
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
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $lokasi->nextPageUrl() }}">Lanjut</a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">Lanjut</span></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    <div class="d-flex justify-content-between">
                        {{ $lokasi->links() }}
                    </div> --}}
                </div>
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
        // document.getElementById('perPageSelect').addEventListener('change', function() {
        //     let perPage = this.value;
        //     let search = document.getElementById('searchInput').value;
        //     window.location.href = "{{ route('Lokasi.lokasi') }}" + "?per_page=" + perPage + "&search=" + search;
        // });

        // document.getElementById('searchInput').addEventListener('keypress', function(e) {
        //     if (e.key === 'Enter') {
      .  //         let perPage = document.getElementById('perPageSelect').value;
        //         let search = this.value;
        //         window.location.href = "{{ route('Lokasi.lokasi') }}" + "?per_page=" + perPage + "&search=" +
        //             search;
        //     }
        // });
    </script>
@endsection
