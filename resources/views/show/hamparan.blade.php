@extends('layout.mainlayaot')

@section('title', 'Hamparan')

@section('content')
    <div id="prediksi-content" class="page-content content p-4">
        <div class="image-container mt-4">
            <div class="col page-title">
                <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="img-normal" />
                <p class="large-text text-overlay">Hamparan</p>
            </div>
        </div>
        <div class="table-container">
            <div class="table-container">
                    <div class="table-header d-flex justify-content-between">
                        <form method="GET"
                            action="{{ route('hamparan.getHamparan', ['id' =>$hamparan->id ?? 'default-slug']) }}">
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
                            <form method="GET" action="{{ route('hamparan.getHamparan', ['id' =>$zona->id ?? 'default-slug']) }}">
                                <div class="d-flex align-items-center">
                                    <div class="form-control-space">
                                        <input type="text" id="searchInput" name="search" placeholder="Cari..." class="form-control "
                                            value="{{ request('search') }}">
                                        </div>
                                        <button type="submit" class="btn btn-tambah-data m-3">Cari</button>
                                    </div>
                                </form>
                                <button onclick="window.location.href='{{ route('TambahHamparan.tambah',['id' => $zona->id]) }}'"
                                    class="btn btn-tambah-data p-3">Tambah</button>
                        </div>
                    </div>
                    <div class="table-wrapper">
                        <table class="custom-table-pancang">
                            <thead>
                                <tr>
                                    <th class="kiriPancang">No</th>
                                    <th>Nama Lokasi</th>
                                    <th>Nama zona</th>
                                    <th>Nama Hamparan</th>
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
                            <tbody id="data-table ">
                                @forelse ($hamparan as $index )
                                    <tr>
                                        <td>{{$loop->iteration  }}</td>
                                        <td>{{ $poltArea->daerah }}</td>
                                        <td>{{ $zona->zona }}</td>
                                        <td>{{ $index->nama_hamparan }}</td>
                                        <td>{{ $index->latitude }}</td>
                                        <td>{{ $index->longitude }}</td>
                                        <td class="hidden-column aksi-button">
                                            {{-- <a href="{{ route('plot.getPlot', ['slug' => $index->slug]) }}"
                                                class="btn btn-info btn-sm">Detail</a> --}}
                                            <form action="{{ route('plot.getPlot', ['id' => $index->id]) }}" method="get">
                                                <button type="submit" class="view-btn">
                                                    <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                                </button>
                                            </form>
                                            <button onclick="window.location.href='{{ route('Hamparan.edit',['slugZ' => $zona->slug,'slugH' => $index->slug]) }}'"
                                                class="add-btn">
                                                <img src="{{ asset('/images/PencilSquare.svg') }}" alt="Add" />
                                            </button>
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
                            Menampilkan {{ $hamparan->firstItem() }} sampai {{ $hamparan->lastItem() }} dari
                            {{ $hamparan->total() }} data
                        </strong>
                        <nav>
                            <ul class="pagination">
                                @if ($hamparan->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">Kembali</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $hamparan->previousPageUrl() }}">Kembali</a></li>
                                @endif

                                @foreach ($hamparan->getUrlRange(1, $hamparan->lastPage()) as $page => $url)
                                    <li class="page-item {{ $hamparan->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if ($hamparan->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $hamparan->nextPageUrl() }}">Lanjut</a>
                                    </li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">Lanjut</span></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    <div class="d-flex justify-content-between">
                        {{ $hamparan->links() }}
                    </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>

@endsection
