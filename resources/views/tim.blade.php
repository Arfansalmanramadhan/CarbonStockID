@extends('layout.mainlayaot')

@section('title', 'tim')

@section('content')
    <div id="prediksi-content" class="page-content content p-4">
        <div class="image-container mt-4">
            <div class="col page-title">
                <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="img-normal" />
                <p class="large-text text-overlay">Lokasi {{ $lokasi->daerah }}</p>
            </div>
        </div>
        <div class="table-container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form method="post" action="{{ route('tim.storee', $lokasi->id) }}" >
                <div class="row">
                    @csrf
                    <label for="tim_id">Pilih Tim:</label>
                    <select name="tim_id" required>
                        @foreach ($tim as $tims)
                            <option value="{{ $tims->id }}">{{ $tims->nama }} </option>
                        @endforeach
                    </select>
                    <div class="row">
                        <div class="col-6 col-md-4 align-self-center">
                            <button type="submit" class=" text-center btn btn-success p-3">Simpan</button>
                        </div>

                    </div>
            </form>
            <div class="table-container">
                <div class="table-wrapper paginated-table">
                    <div class="table-header d-flex justify-content-between">
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
                    </div>
                    <table class="custom-table-pancang table table-striped">
                        <thead>
                            <tr>
                                <th class="kiriPancang">No</th>
                                <th>Nama Daerah</th>
                                <th>Nama Tim</th>
                                <th class="hidden-column kananPancang">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="tableBody">
                            {{-- {{dd($anggota);}} --}}
                            @if ($anggota->isNotEmpty())
                                @forelse($anggota as $index => $t)
                                    <tr  class="data-row">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $t->nama_lokasi }}</td>
                                        <td>{{ $t->tim }}</td>
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
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="table-footer mt-5">
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
