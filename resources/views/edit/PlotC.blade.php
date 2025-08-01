@extends('layout.layaout')

@section('title', 'Edit Plot C')

@section('content')
    <div class="container-tambah-data hidden mt-5" id="newContent3">
        <div class="container-isi">
            <div class="table-container">
                <div class="h2-pancang-container section-tiang">
                    <h2 class="h2-tiang">Tiang</h2>
                </div>
                <div class="table-header d-flex justify-content-between">
                    <div>
                        <label for="show-entries">Tampilkan</label>
                        <select id="show-entries">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                        <span>data</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-tambah-data me-3" id="addData2" data-bs-toggle="modal"
                            data-bs-target="#dataModal2">Edit</button>

                        <!-- Modal -->
                        <div class="modal" id="dataModal2" aria-hidden="true">
                            <div class="modal-dialog" id="dataModal2">
                                <div class="modal-content">
                                    <h5 class="ms-3 modal-title" id="dataModalLabel">Sub Plot C - Tiang</h5>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('tiang.store') }}" id="tiangForm">
                                            @csrf
                                            {{-- <input type="hidden" id="zona_id" name="zona_id" value="{{ $zona->id }}" /> --}}
                                            <!-- Keliling -->
                                            <div class="mb-3">
                                                <label for="keliling" class="form-label">Keliling</label>
                                                {{-- <input type="text" class="form-control form-control-plot-b"
                                                    id="keliling" name="keliling"
                                                    value="{{ $tiang ? $tiang->keliling : ' ' }}" /> --}}
                                            </div>

                                            <!-- Diameter -->
                                            <div class="mb-3">
                                                <label for="diameter" class="form-label">Diameter</label>
                                                {{-- <input type="text" class="form-control form-control-plot-b is-invalid"
                                                    id="diameter" value="{{ $tiang ? $tiang->diameter : ' ' }}" readonly /> --}}
                                                <div class="invalid-feedback">Diameter harus diantara 10 hingga 19
                                                    cm.</div>
                                            </div>

                                            <!-- Nama Lokal with Datalist -->
                                            <div class="mb-3">
                                                <label for="namaLokal" class="form-label">Nama Lokal</label>
                                                <div class="input-container">
                                                    {{-- <input type="text" class="form-control form-control-plot-b"
                                                        id="namaLokal" value="Jati" autocomplete="off" readonly
                                                        name="nama_lokal" value="{{ $tiang ? $tiang->nama_lokal : ' ' }}" /> --}}
                                                    <img src="{{ asset('/images/ChevronUp.svg') }}" alt=""
                                                        class="chevron-icon" id="toggleDropdown" onclick="toggleImage()" />
                                                    <ul class="dropdown" id="dropdownList">
                                                        <li>Damar</li>
                                                        <li>Jati</li>
                                                        <li>Mahoni</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <!-- Nama Ilmiah -->
                                            <div class="mb-3">
                                                <label for="namaIlmiah" class="form-label">Nama Ilmiah</label>
                                                {{-- <input type="text" class="form-control form-control-plot-b"
                                                    id="namaIlmiah" value="Tectona grandis" readonly name="nama_ilmiah"
                                                    value="{{ $tiang ? $tiang->nama_ilmiah : '' }}" /> --}}
                                            </div>

                                            <!-- Kerapatan Kayu -->
                                            <div class="mb-3">
                                                <label for="kerapatanKayu" class="form-label">Kerapatan Jenis
                                                    Kayu</label>
                                                {{-- <input type="text" class="form-control form-control-plot-b"
                                                    id="kerapatanKayu" placeholder="Masukkan kerapatan jenis kayu (gr/cm3)"
                                                    name="kerapatan_jenis_kayu"
                                                    value="{{ $tiang ? $tiang->kerapatan_jenis_kayu : '' }}" /> --}}
                                            </div>

                                            <!-- Biomassa, Karbon, CO2 : '' -->
                                            <div class="mb-3">
                                                {{-- <p class="form-label">Biomassa diatas Permukaan
                                                    Tanah<span>{{ $tiang ? $tiang->bio_di_atas_tanah : '' }}
                                                        Kg</span></p>
                                                <p class="form-label">Kandungan
                                                    Karbon<span>{{ $tiang ? $tiang->kandungan_karbon : ' ' }}
                                                        Kg</span></p>
                                                <p class="form-label">Serapan CO2 :
                                                    ''<span>{{ $tiang ? $tiang->co2 : '' }} Kg</span></p> --}}
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success-plot btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table class="custom-table-pancang">
                        <thead>
                            <tr>
                                <th class="kiriPancang">No</th>
                                <th>Keliling</th>
                                <th>Diameter</th>
                                <th>Nama Lokal</th>
                                <th>Nama Ilmiah</th>
                                <th class="hidden-column">Kerapatan Jenis Kayu</th>
                                <th class="hidden-column">Bio diatas tanah</th>
                                <th class="hidden-column">Kandungan karbon</th>
                                <th class="hidden-column">Serapan CO2 : ''</th>
                                <th class="hidden-column kananPancang">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- $@foreach ($tiang as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->keliling}} cm</td>
                                <td>{{$item->diameter}} cm</td>
                                <td>{{$item->nama_lokal}}</td>
                                <td>{{$item->nama_ilmiah}}</td>
                                <td class="hidden-column">{{$item->kerapatan_jenis_kayu}} gr/cm3</td>
                                <td class="hidden-column">{{$item->bio_di_atas_tanah}} kg</td>
                                <td class="hidden-column">{{$item->kandunngan_karbon}}kg</td>
                                <td class="hidden-column">{{$item->co2}} kg</td>
                                <td class="hidden-column aksi-button">
                                    <button class="edit-btn">
                                        <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                    </button>
                                    <button class="delete-btn">
                                        <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                    </button>
                                </td>
                            </tr>
                          @endforeach --}}
                        </tbody>
                    </table>
                </div>
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
            <div class="d-flex jarak">
                <div class="option">
                    <a href="{{ route('PlotB.index') }}" class=" btn btn-back  " id="submitButton">
                        <img src="{{ asset('/images/ArrowLeft.svg') }}" alt="Arrow Icon" class="ms-2" />
                        <span>Sebelumnya</span>
                    </a>
                </div>
                <div class="option">
                    <a href="{{ route('PlotD.index') }}" class=" btn btn-success "
                        id="submitButton"><span>Berikutnya</span>
                        <img src="{{ asset('/images/ArrowRight.svg') }}" alt="Arrow Icon" class="ms-2" />
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
