@extends('layout.mainlayaot')

@section('title', 'Plot')

@section('content')
    <div id="prediksi-content" class="page-content content p-4">
        <div class="image-container mt-4">
            <div class="col page-title">
                <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="img-normal" />
                <p class="large-text text-overlay">Plot</p>
            </div>
        </div>
        <div class="table-container">
            <div class="table-container paginated-table">
                <div class="table-wrapper">
                    <div class="table-header d-flex justify-content-between">
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
                            <form method="GET"
                                action="{{ route('plot.getPlot', ['id' => $plot->id ?? 'default-slug']) }}">
                                <div class="d-flex align-items-center">
                                    <div class="form-control-space">
                                        <input type="text" id="searchInput" name="search" placeholder="Cari..."
                                            class="form-control " value="{{ request('search') }}">
                                    </div>
                                    <button type="submit" class="btn btn-tambah-data">Cari</button>
                                </div>
                            </form>

                            <button onclick="window.location.href='{{ route('Plot.tambah', ['slug' => $hamparan->slug]) }}'"
                                class="btn btn-tambah-data m-3
                                ">Tambah</button>
                        </div>

                    </div>
                    <table class="custom-table-pancang table table-striped">
                        <thead>
                            <tr>
                                <th class="kiriPancang">No</th>
                                <th>Nama Lokasi</th>
                                <th>Nama zona</th>
                                <th>Nama Hamparan</th>
                                <th>Nama Plot</th>
                                <th>Tipe Plot</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
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
                            @forelse ($plot as $index )
                                <tr class="data-row">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $poltArea->daerah }}</td>
                                    <td>{{ $zona->zona }}</td>
                                    <td>{{ $hamparan->nama_hamparan }}</td>
                                    <td>{{ $index->nama_plot }}</td>
                                    <td>{{ $index->type_plot }}</td>
                                    <td>{{ $index->latitude }}</td>
                                    <td>{{ $index->longitude }}</td>
                                    <td class="hidden-column aksi-button">
                                        @foreach ($index->subplot as $subplost)
                                        <form action="{{ route('DetailPlot.getsubPlot', ['id' => $subplost->id]) }}" method="get">
                                            <button type="submit" class="view-btn">
                                                <img src="{{ asset('/images/Eye.svg') }}" alt="View" />
                                            </button>
                                        </form>
                                    @endforeach
                                    <form action="{{ route('plot.destroy', ['hamparan_id' => $item->id]) }}"
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
                                    <td colspan="7" class="text-center">Belum ada data</td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                    <div class="table-footer mt-5">
                        {{-- <strong>
                            Menampilkan {{ $plot->firstItem() }} sampai {{ $plot->lastItem() }} dari
                            {{ $plot->total() }} data
                        </strong>
                        <nav>
                            <ul class="pagination">
                                @if ($plot->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">Kembali</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $plot->previousPageUrl() }}">Kembali</a></li>
                                @endif

                                @foreach ($plot->getUrlRange(1, $plot->lastPage()) as $page => $url)
                                    <li class="page-item {{ $plot->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if ($plot->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $plot->nextPageUrl() }}">Lanjut</a>
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

@endsection
