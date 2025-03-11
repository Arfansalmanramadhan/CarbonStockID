@extends('layout.mainlayaot')

@section('title', 'Anggota')

@section('content')
    <div id="prediksi-content" class="page-content content p-4">
        <div class="image-container mt-4">
            <div class="col page-title">
                <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="img-normal" />
                <p class="large-text text-overlay">Anggota Tim {{ $tim->nama }}</p>
            </div>
        </div>
        <div class="table-container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form method="post" action="{{ route('anggota.storee', $tim->id) }}">
                <div class="row">
                    @csrf
                    <label for="registrasi_id">Pilih Anggota:</label>
                    <select name="registrasi_id" required>
                        @foreach ($registrasi as $user)
                            <option value="{{ $user->id }}">{{ $user->nama }} ({{ $user->username }})</option>
                        @endforeach
                    </select>
                    <div class="row">
                        <div class="col-6 col-md-4 align-self-center">
                            <button type="submit" class=" text-center btn btn-success p-3">Simpan</button>
                        </div>

                    </div>
            </form>
            <div class="table-container">
                <div class="table-wrapper">
                    <table class="custom-table-pancang">
                        <thead>
                            <tr>
                                <th class="kiriPancang">No</th>
                                <th>Nama Anggota</th>
                                th>Username</th>
                                <th>Nama Tim</th>
                                <th class="hidden-column kananPancang">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($anggota->isNotEmpty())
                                @forelse($anggota as $index => $t)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $t->nama_anggota }}</td>
                                        <td>{{ $t->nama_tim }}</td>
                                        <td>{{ $t->username }}</td>
                                        {{-- <td class="hidden-column aksi-button">
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
                                        </td> --}}
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
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
                </div>
            </div>
        </div>
    </div>
@endsection
