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
                {{-- <div class="table-wrapper"> --}}
                <div class="table-header d-flex justify-content-between">
                    <form method="GET" action="{{ route('zona.index') }}">
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
                    <form method="GET" action="{{ route('zona.index') }}">
                        <div class="d-flex align-items-center">
                            <div class="form-control-space">
                                <input type="text" id="searchInput" name="search" placeholder="Cari..." class="form-control mb-3"
                                    value="{{ request('search') }}">
                            </div>
                            <button type="submit" class="btn btn-tambah-data">Cari</button>
                        </div>
                    </form>
                </div>
                <div class="table-wrapper">
                    <table class="custom-table-pancang">
                        <thead>
                            <tr>
                                <th class="kiriPancang">No</th>
                                <th>Nama Zona</th>
                                <th>Latittude</th>
                                <th>Longitude</th>
                                <th>Jenis Hutan </th>
                                <th class="hidden-column kananPancang">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($zona as $index => $item)
                                <tr>
                                    <td>{{ $zona->firstItem() + $index }}</td>
                                    <td>{{ $item->zona }}</td>
                                    <td>{{ $item->latitude }}</td>
                                    <td>{{ $item->longitude }}</td>
                                    <td>{{ $item->jenis_hutan }}</td>
                                    <td class="hidden-column aksi-button">
                                        {{-- <a href="{{ route('hamparan.getHamparan', ['slug' => $item->slug]) }}"
                                            class="btn btn-info btn-sm">Detail</a> --}}
                                        <form action="{{ route('hamparan.getHamparan', ['id' => $item->id]) }}" method="get">
                                            <button type="submit" class="view-btn">
                                                <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                            </button>
                                        </form>
                                        {{-- <button onclick="window.location.href='{{ route('zona.edit') }}'"
                                        class="add-btn">
                                        <img src="{{ asset('/images/PencilSquare.svg') }}" alt="Add" />
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


                            {{-- <tr>
                                <td>1</td>
                                <td>Zona 1</td>
                                <td>Detail</td>
                                <td>Hutan hujan tropis</td>
                                <td>-6.9744, 107.6303</td>
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
                        {{-- <tbody>
                            <tr>
                                <td>1</td>
                                <td>Zona 1</td>
                                <td>Detail</td>
                                <td>Hutan hujan tropis</td>
                                <td>-6.9744, 107.6303</td>
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
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Zona 1</td>
                                <td>Detail</td>
                                <td>Hutan hujan tropis</td>
                                <td>-6.9744, 107.6303</td>
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
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Zona 1</td>
                                <td>Detail</td>
                                <td>Hutan hujan tropis</td>
                                <td>-6.9744, 107.6303</td>
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
                            </tr>
                        </tbody> --}}
                    </table>
                </div>
                <div class="table-footer mt-5">
                    <strong>
                        Menampilkan {{ $zona->firstItem() }} sampai {{ $zona->lastItem() }} dari
                        {{ $zona->total() }} data
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
                {{-- <div class="d-flex justify-content-between">
                    {{ $zona->links() }}
                </div> --}}
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
                {{-- </div> --}}
            </div>
        </div>
    </div>
    <script>
        // let searchTimeout; // Variabel untuk menyimpan timer debounce

        // document.getElementById('searchInput').addEventListener('input', function() {
        //     clearTimeout(searchTimeout);

        //     searchTimeout = setTimeout(function() {
        //         searchZona();
        //     }, 500); // Delay pencarian 0.5 detik untuk mencegah permintaan berulang
        // });

        // function searchZona() {
        //     let perPage = document.getElementById('perPageSelect').value;
        //     let search = document.getElementById('searchInput').value;

        //     fetch("{{ route('zona.index') }}" + "?per_page=" + perPage + "&search=" + encodeURIComponent(search))
        //         .then(response => response.json())
        //         .then(data => {
        //             updateTable(data.zona);
        //         })
        //         .catch(error => console.error('Error:', error));
        // }

        // function updateTable(data) {
        //     let tableBody = document.querySelector(".custom-table-pancang tbody");
        //     tableBody.innerHTML = ""; // Hapus isi tabel

        //     if (data.length === 0) {
        //         tableBody.innerHTML = `
        //     <tr>
        //         <td colspan="6" class="text-center">Belum ada data</td>
        //     </tr>
        // `;
        //     } else {
        //         data.forEach((item, index) => {
        //             let row = `
        //         <tr>
        //             <td>${index + 1}</td>
        //             <td>${item.zona}</td>
        //             <td>${item.latitude}</td>
        //             <td>${item.longitude}</td>
        //             <td>${item.jenis_hutan}</td>
        //             <td class="hidden-column aksi-button">
        //                 <button class="view-btn">
        //                     <img src="/images/Eye.svg" alt="View" />
        //                 </button>
        //                 <button class="delete-btn">
        //                     <img src="/images/Trash.svg" alt="Delete" />
        //                 </button>
        //             </td>
        //         </tr>
        //     `;
        //             tableBody.innerHTML += row;
        //         });
        //     }
        // }
    </script>
@endsection
