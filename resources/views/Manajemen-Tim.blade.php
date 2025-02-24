@extends('layout.mainlayaot')

@section('title', 'Surveyor')

@section('content')
    <div id="prediksi-content" class="page-content content p-4">
        <div class="image-container mt-4">
            <div class="col page-title">
                <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="img-normal" />
                <p class="large-text text-overlay">Manajemen Tim</p>
            </div>
        </div>
        <div class="table-container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form method="post" action="{{ route('Manajemen-Tim.store') }}">
                <div class="row">
                    @csrf
                    <input type="hidden" name="registrasi_id" value="{{ auth()->user()->id }}">
                    <div class="col-12 col-md-4">
                        <label for="keliling" class="form-label">Nama Tim</label>
                        <input type="text" class="form-control" id="keliling" value="" name="nama" />
                    </div>
                    {{-- <div class="col-12 col-md-4">
                        <label for="keliling" class="form-label">Nama Surveyor</label>
                        <select class="form-select form-control" aria-label="Default select example" name="zona">
                            <option selected>Zona</option>
                            <option value="Zona 1">Zona 1</option>
                            <option value="Zona 2">Zona 2</option>
                            <option value="Zona 3">Zona 3</option>
                            <option value="Zona 4">Zona 4</option>
                            <option value="Zona 5">Zona 5</option>
                        </select>
                    </div> --}}
                    <div class="col-12 col-md-4">
                        <label for="keliling" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control form-control-plot-b" id="keliling" value=""
                            name="tanggal_mulai" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="keliling" class="form-label">Tanggal Berakhir</label>
                        <input type="date" class="form-control form-control-plot-b" id="keliling" value=""
                            name="tanggal_berakhir" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-md-4 align-self-center">
                        <button type="submit" class=" text-center btn btn-success p-3">Simpan</button>
                    </div>
                    {{-- <div class="col-6 col-md-4">
                        <button    type="submit" class="  text-center btn btn-success p-3">Tambah Tim </button>
                    </div> --}}
                    {{-- <div class="col-6 col-md-4 align-self-center">
                        <a href="{{ route('Tambah-Surveyor.indexx') }}"class="  text-center btn btn-success p-3">Tambah
                            Surveyor</a>
                        <button type="submit" class="  text-center btn btn-success p-3">Tambah Surveyor</button>
                    </div> --}}
                </div>
            </form>
            <div class="table-container">
                <div class="table-wrapper">
                    <div>
                        <label for="show-entries">Tampilkan</label>
                        <select id="show-entries">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                        <span>data</span>
                    </div>
                    <table class="custom-table-pancang">
                        <thead>
                            <tr>
                                <th class="kiriPancang">No</th>
                                <th>Nama TIM</th>
                                <th>Tanggal Mulai </th>
                                <th>Tanggal berakhir </th>
                                <th class="hidden-column kananPancang">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tim as $index => $tim)
                                @foreach ($tim->periode as $periode)
                                    <tr>
                                        <td>{{ $index + 1}}</td>
                                        <td>{{ $tim->nama }}</td>
                                        <td>{{ $periode->tanggal_mulai }}</td>
                                        <td>{{ $periode->tanggal_berakhir }}</td>
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
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="table-footer mt-5">
                        <span>Menampilkan 1 sampai 5 dari 40 data</span>
                        <div class="pagination">
                            <button class="page-btn">Kembali</button>
                            <button class="page-btn active">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn">3</button>
                            <button class="page-btn">4</button>
                            <button class="page-btn">Lanjut</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
