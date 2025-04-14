@extends('layout.mainlayaot')

@section('title', 'Buku')

@section('content')
    <div id="data-plot-content" class="page-content content p-4 w-100 col-lg-10">
        <div class="image-container mt-4">
            <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="mb-4 img-normal" />
            <div class="text-overlay">
                {{-- <p class="small-text">Data Plot</p> --}}
                <p class="large-text">Data Plot Area</p>
            </div>
        </div>
        <div class="table-container paginated-table">
            <div class="table-header d-flex justify-content-between">
                {{-- <form method="GET" action="{{ route('dataPlot.index') }}">
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
                    <form method="GET" action="{{ route('dataPlot.index') }}">
                        <div class="d-flex align-items-center">
                            <div class="form-control-space">
                                <input type="text"class="form-control" id="search" name="search"
                                    value="{{ request('search') }}" placeholder="Cari daerah atau status..."
                                    onkeyup="searchTable()">
                            </div>
                            <button type="submit" class="btn btn-tambah-data ">Cari</button>
                        </div>
                    </form>

                    {{-- <button onclick="window.location.href='{{ route('Lokasi.index') }}'"
                        class="btn btn-tambah-data m-3">Tambah</button> --}}
                </div>
            </div>
            <div class="table-wrapper">
                <table class="custom-table-pancang  table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lokasi</th>
                            <th>Nama zona</th>
                            <th>Nama Hamparan</th>
                            <th>Nama plot</th>
                            <th>Tipe Plot</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="tableBody">
                        @forelse ($plot as $index => $item)
                            <tr class="data-row">
                                <td>{{ $plot->firstItem() + $index }}</td>
                                <td>{{ optional($item->hamparan->zona->poltArea)->daerah ?? '-' }}</td>
                                <td>{{ optional($item->hamparan->zona)->zona ?? '-' }}</td>
                                <td>{{ optional($item->hamparan)->nama_hamparan ?? '-' }}</td>
                                <td>{{ $item->nama_plot }}</td>
                                <td>{{ $item->type_plot }}</td>
                                <td class="hidden-column aksi-button">
                                    @foreach ($item->subplot as $subplost)
                                        <form action="{{ route('DetailPlot.getsubPlot', ['id' => $subplost->id]) }}"
                                            method="get">
                                            <button type="submit" class="view-btn">
                                                <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                            </button>
                                        </form>
                                    @endforeach
                                    {{-- <button class="view-btn">
                                        <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                    </button> --}}
                                    {{-- <button onclick="window.location.href='{{ route('Lokasi.edit', $item->slug) }}'"
                                        class="add-btn">
                                        <img src="{{ asset('/images/PencilSquare.svg') }}" alt="Add" />
                                    </button> --}}
                                    <form action="{{ route('plot.destroy', ['id' => $item->id]) }}"
                                        method="POST">
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
                                <td colspan="9" class="text-center">Belum ada data</td>
                            </tr>
                        @endforelse
                        {{-- <tr>
                            <td>00002</td>
                            <td>Bujursangkar</td>
                            <td>-6.9705, 107.6304</td>
                            <td>Haurpanggung, Kec. Tarogong Kidul, Kabupaten ...</td>
                            <td class="hidden-column aksi-button">
                                <button class="view-btn">
                                    <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                </button>
                                <button class="edit-btn">
                                    <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                </button>

                                <!-- Modal -->
                                <div id="deleteModal" class="modal">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <span class="close">&times;</span>
                                            <img src="" alt="Delete Icon" class="icon" />
                                        </div>
                                        <div class="modal-body">
                                            <h2>Kamu yakin untuk menghapus Plot Area ini?</h2>
                                            <p>Jika anda menghapus plot area ini, semua data terkait plot ini akan dipindahkan
                                                ke Sampah.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="cancelBtn" class="cancel-btn">Batal</button>
                                            <button id="deleteBtn" class="delete-confirm-btn">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>00003</td>
                            <td>Persegi panjang</td>
                            <td>-6.9705, 107.6304</td>
                            <td>Haurpanggung, Kec. Tarogong Kidul, Kabupaten ...</td>
                            <td class="hidden-column aksi-button">
                                <button class="view-btn">
                                    <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                </button>
                                <button class="edit-btn">
                                    <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                </button>

                                <!-- Modal -->
                                <div id="deleteModal" class="modal">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <span class="close">&times;</span>
                                            <img src="" alt="Delete Icon" class="icon" />
                                        </div>
                                        <div class="modal-body">
                                            <h2>Kamu yakin untuk menghapus Plot Area ini?</h2>
                                            <p>Jika anda menghapus plot area ini, semua data terkait plot ini akan dipindahkan
                                                ke Sampah.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="cancelBtn" class="cancel-btn">Batal</button>
                                            <button id="deleteBtn" class="delete-confirm-btn">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>00004</td>
                            <td>Persegi panjang</td>
                            <td>-6.9705, 107.6304</td>
                            <td>Haurpanggung, Kec. Tarogong Kidul, Kabupaten ...</td>
                            <td class="hidden-column aksi-button">
                                <button class="view-btn">
                                    <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                </button>
                                <button class="edit-btn">
                                    <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                </button>

                                <!-- Modal -->
                                <div id="deleteModal" class="modal">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <span class="close">&times;</span>
                                            <img src="" alt="Delete Icon" class="icon" />
                                        </div>
                                        <div class="modal-body">
                                            <h2>Kamu yakin untuk menghapus Plot Area ini?</h2>
                                            <p>Jika anda menghapus plot area ini, semua data terkait plot ini akan dipindahkan
                                                ke Sampah.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="cancelBtn" class="cancel-btn">Batal</button>
                                            <button id="deleteBtn" class="delete-confirm-btn">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>00005</td>
                            <td>Bujursangkar</td>
                            <td>-6.9705, 107.6304</td>
                            <td>Haurpanggung, Kec. Tarogong Kidul, Kabupaten ...</td>
                            <td class="hidden-column aksi-button">
                                <button class="view-btn">
                                    <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                </button>
                                <button class="edit-btn">
                                    <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                </button>

                                <!-- Modal -->
                                <div id="deleteModal" class="modal">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <span class="close">&times;</span>
                                            <img src="" alt="Delete Icon" class="icon" />
                                        </div>
                                        <div class="modal-body">
                                            <h2>Kamu yakin untuk menghapus Plot Area ini?</h2>
                                            <p>Jika anda menghapus plot area ini, semua data terkait plot ini akan dipindahkan
                                                ke Sampah.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="cancelBtn" class="cancel-btn">Batal</button>
                                            <button id="deleteBtn" class="delete-confirm-btn">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr> --}}
                        <!-- Tambahkan baris lainnya di sini -->
                    </tbody>
                </table>
            </div>
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
                            <li class="page-item"><a class="page-link" href="{{ $plot->previousPageUrl() }}">Kembali</a>
                            </li>
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
            <!-- Pagination -->

            {{-- <div class="table-footer">
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
        </div>
    </div>
@endsection
