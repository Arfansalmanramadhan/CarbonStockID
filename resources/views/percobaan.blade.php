@extends('layout.mainlayaot')

@section('title', 'Surveyor')

@section('content')
    <div id="prediksi-content" class="page-content content p-4">
        <div class="image-container mt-4">
            <div class="col page-title">
                <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="img-normal" />
                <p class="large-text text-overlay">Surveyor</p>
            </div>
        </div>
        <div class="table-container">
            <div class="table-container paginated-table">
                <div class="table-header d-flex justify-content-between">
                    {{-- <form method="GET" action="{{ route('zona.index') }}">
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
                    {{-- <form method="GET" action="{{ route('zona.index') }}">
                        <div class="d-flex align-items-center">
                            <div class="form-control-space">
                                <input type="text" id="searchInput" name="search" placeholder="Cari..."
                                    class="form-control mb-3" value="{{ request('search') }}">
                            </div>
                            <button type="submit" class="btn btn-tambah-data">Cari</button>
                        </div>
                    </form> --}}
                </div>
                <div class="table-wrapper">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <table class="custom-table-pancang table ">
                        <thead>
                            <tr>
                                <th class="kiriPancang">No</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Email</th>
                                {{-- <th>Foto</th> --}}
                                <th>NIP</th>
                                <th>No Telepon</th>
                                <th>NIK</th>
                                <th>Nama Tim</th>
                                <th class="hidden-column kananPancang">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="tableBody">
                            @if ($anggota->isNotEmpty())
                                @forelse($anggota as $index => $t)

                                    <tr class="data-row">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $t->nama }}</td>
                                        <td>{{ $t->username }}</td>
                                        <td>{{ $t->email }}</td>
                                        {{-- @php
                                            $fotoUrl = Str::startsWith($t->foto, 'https')
                                                ? $t->foto
                                                : 'https://stetzzdtqvwljzvsagjz.supabase.co/storage/v1/object/public/foto/Untitled%20folder/WhatsApp%20Image%202025-04-15%20at%2010.49.06.jpeg' .
                                                    $t->foto;
                                        @endphp
                                        <td>
                                            <img src="{{ $fotoUrl }}" alt="Foto" width="60" height="60"
                                                style="object-fit: cover;">
                                        </td> --}}
                                        <td>{{ $t->nip }}</td>
                                        <td>{{ $t->no_hp }}</td>
                                        <td>{{ $t->nik }}</td>
                                        <td>{{ $t->nama_tim }}</td>
                                        <td class="hidden-column aksi-button">
                                            <button
                                                onclick="window.location.href='{{ route('Surveyor.show', ['slug' => $t->slug]) }}'"
                                                class="add-btn">
                                                <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                            </button>
                                            {{-- <pre>{{ dd($index) }}</pre> --}}
                                            {{-- <form action="" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-btn">
                                                    <img src="{{ asset('/images/Trash.svg') }}" alt="Delete" />
                                                </button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="table-footer mt-5">
                        {{-- <strong>
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
    </div>
    </div>
@endsection
