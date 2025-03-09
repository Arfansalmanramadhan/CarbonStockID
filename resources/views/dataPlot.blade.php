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
        <div class="table-container">
            <div class="table-header d-flex justify-content-between">
                <form method="GET" action="{{ route('dataPlot.index') }}">
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

                    <button onclick="window.location.href='{{ route('Lokasi.index') }}'"
                        class="btn btn-tambah-data m-3">Tambah</button>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="custom-table-hasil">
                    <thead>
                        <tr>
                            <th>NOMOR</th>
                            <th>nama plot</th>
                            <th>TIPE PLOT</th>
                            <th>latitude </th>
                            <th>longitude</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($plot as $index => $item)
                                <tr>
                                    <td>{{ $plot->firstItem() + $index }}</td>
                                    <td>{{ $item->nama_plot }}</td>
                                    <td>{{ $item->type_plot }}</td>
                                    <td>{{ $item->latitude }}</td>
                                    <td>{{ $item->longitude }}</td>
                                    <td class="hidden-column aksi-button">
                                        {{-- <a href="{{ route('zona.getZona', ['slug' => $item->slug]) }}"
                                            class="btn btn-info btn-sm">Detail</a> --}}
                                        <button class="view-btn">
                                            <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                        </button>
                                        <button onclick="window.location.href='{{ route('Lokasi.edit', $item->slug) }}'"
                                            class="add-btn">
                                            <img src="{{ asset('/images/PencilSquare.svg') }}" alt="Add" />
                                        </button>
                                        <button class="delete-btn">
                                            <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                        </button>
                                        {{-- <button>👁️</button>
                                            <button>➕</button>
                                            <button>🗑️</button> --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data</td>
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
                <strong>
                    Menampilkan {{ $plot->firstItem() }} sampai {{ $plot->lastItem() }} dari
                    {{ $plot->total() }} data
                </strong>
                <nav>
                    <ul class="pagination">
                        {{-- Tombol Kembali --}}
                        @if ($plot->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">Kembali</span></li>
                        @else
                            <li class="page-item"><a class="page-link"
                                    href="{{ $plot->previousPageUrl() }}">Kembali</a></li>
                        @endif

                        {{-- Nomor Halaman --}}
                        @foreach ($plot->getUrlRange(1, $plot->lastPage()) as $page => $url)
                            <li class="page-item {{ $plot->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Tombol Lanjut --}}
                        @if ($plot->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $plot->nextPageUrl() }}">Lanjut</a>
                            </li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Lanjut</span></li>
                        @endif
                    </ul>
                </nav>
            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-between">
                {{ $plot->links() }}
            </div>
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
