@extends('layout.mainlayaot')

@section('title', 'Jumlah Pohon')

@section('content')
    <div id="sampah-content" class="page-content content p-4 w-100">
        <div class="image-container mt-4">
            <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="mb-4 img-normal" />
            <div class="text-overlay">
                <p class="large-text">Jumlah Pohon </p>
            </div>
        </div>
        <div class="table-container">
            <form method="POST" action="{{ route('Sampah.hitung') }}">
                @csrf
                <div class="form-group">
                    <label for="lokasi">Pilih Lokasi:</label>
                    <select name="lokasi_id" id="lokasi" class="form-control" required>
                        <option value="">-- Pilih Lokasi --</option>
                        @foreach ($lokasi as $l)
                            <option value="{{ $l->id }}"
                                {{ isset($lokasiId) && $lokasiId == $l->id ? 'selected' : '' }}>{{ $l->daerah }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-tambah-data mt-2">Hitung</button>
            </form>
            @if (isset($detail))
                <hr>
                <h4>Lokasi: {{ $lokasi_nama }}</h4>
                <p>Total Individu: <strong>{{ $total }}</strong></p>
                <p>Nilai H': <strong>{{ round($h, 6) }}</strong></p>
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
                        <table class="custom-table-pancang table ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Spesies</th>
                                    <th>Jumlah Individu</th>
                                    <th>Pi</th>
                                    <th>ln(Pi)</th>
                                    <th>-Pi ln(Pi)</th>
                                </tr>
                            </thead>
                            <tbody class="tableBody">
                                {{-- {{dd($anggota);}} --}}
                                {{-- @if ($anggota->isNotEmpty()) --}}
                                @forelse($detail as $index => $item)
                                    <tr class="data-row">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item['spesies'] }}</td>
                                        <td>{{ $item['jumlah_individu'] }}</td>
                                        <td>{{ $item['pi'] }}</td>
                                        <td>{{ $item['ln_pi'] }}</td>
                                        <td>{{ $item['neg_pi_ln_pi'] }}</td>
                                    @empty

                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data</td>
                                    </tr>
                                @endforelse
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
            @endif

        </div>
    </div>
@endsection
