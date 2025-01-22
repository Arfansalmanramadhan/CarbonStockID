@extends('layout.mainlayaot')

@section('title', 'Buku')

@section('content')
    <div id="sampah-content" class="page-content content p-4 w-100">
        <div class="image-container mt-4">
            <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="mb-4 img-normal" />
            <div class="text-overlay">
                <p class="large-text">Sampah</p>
            </div>
        </div>
        <div class="table-container-sampah">
            <div class="table-header-sampah">
                <div class="tampilkan-data">
                    <label for="show-entries">Tampilkan</label>
                    <span class="number-selection-data">5</span>
                    <img src="{{ asset('/images/downbaru.svg') }}" alt="" class="pancang"
                        id="toggleDropdownBanyakData" />
                    <ul class="dropdownJumlahData" id="dropdownListDataPlot">
                        <li>5</li>
                        <li>10</li>
                        <li>20</li>
                    </ul>
                    <span class="ms-2">data</span>
                </div>
                <div class="tampilkan">
                    <span class="number-selection">Hapus Semua</span>
                    <img src="{{ asset('/images/CaretDownFill.svg') }}" alt="" class="pancang"
                        id="toggleDropdownBanyakData" />
                    <ul class="dropdownData" id="dropdownListDataPlot">
                        <li>Hapus Semua</li>
                        <li>Pulihkan Semua</li>
                    </ul>
                    <input class="form-check-sampah" type="checkbox" id="rememberMe" />
                </div>
            </div>
            <div class="table-tengah-sampah d-flex">
                <h6>Data di Sampah otomatis terhapus setelah 30 hari.</h6>
                <span>Kosongkan Sampah sekarang</span>
            </div>
            <table class="sampah-table">
                <tbody>
                    <tr>
                        <td>0001</td>
                        <td>Mekarjaya, Kec. Banjaran, Kabupaten Bandung</td>
                        <td class="aksi-button">
                            <button class="restrore-btn-sampah">
                                <img src="{{ asset('/images/restoreIcon.svg') }}" alt="" />
                            </button>
                            <button class="delete-btn-sampah">
                                <img src="{{ asset('/images/sampahIconItem.svg') }}" alt="" />
                            </button>
                            <input class="form-check-sampah" type="checkbox" id="rememberMe" />
                        </td>
                    </tr>
                    <tr>
                        <td>0001</td>
                        <td>Mekarjaya, Kec. Banjaran, Kabupaten Bandung</td>
                        <td class="aksi-button">
                            <button class="restrore-btn-sampah">
                                <img src="{{ asset('/images/restoreIcon.svg') }}" alt="" />
                            </button>
                            <button class="delete-btn-sampah">
                                <img src="{{ asset('/images/sampahIconItem.svg') }}" alt="" />
                            </button>
                            <input class="form-check-sampah" type="checkbox" id="rememberMe" />
                        </td>
                    </tr>
                    <tr>
                        <td>0001</td>
                        <td>Mekarjaya, Kec. Banjaran, Kabupaten Bandung</td>
                        <td class="aksi-button">
                            <button class="restrore-btn-sampah">
                                <img src="{{ asset('/images/restoreIcon.svg') }}" alt="" />
                            </button>
                            <button class="delete-btn-sampah">
                                <img src="{{ asset('/images/sampahIconItem.svg') }}" alt="" />
                            </button>
                            <input class="form-check-sampah" type="checkbox" id="rememberMe" />
                        </td>
                    </tr>
                    <tr>
                        <td>0001</td>
                        <td>Mekarjaya, Kec. Banjaran, Kabupaten Bandung</td>
                        <td class="aksi-button">
                            <button class="restrore-btn-sampah">
                                <img src="{{ asset('/images/restoreIcon.svg') }}" alt="" />
                            </button>
                            <button class="delete-btn-sampah">
                                <img src="{{ asset('/images/sampahIconItem.svg') }}" alt="" />
                            </button>
                            <input class="form-check-sampah" type="checkbox" id="rememberMe" />
                        </td>
                    </tr>
                    <tr>
                        <td>0001</td>
                        <td>Mekarjaya, Kec. Banjaran, Kabupaten Bandung</td>
                        <td class="aksi-button">
                            <button class="restrore-btn-sampah">
                                <img src="{{ asset('/images/restoreIcon.svg') }}" alt="" />
                            </button>
                            <button class="delete-btn-sampah">
                                <img src="{{ asset('/images/sampahIconItem.svg') }}" alt="" />
                            </button>
                            <input class="form-check-sampah" type="checkbox" id="rememberMe" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="table-footer-data mt-5">
                <span>Menampilkan 1 sampai 5 dari 40 data</span>
                <div class="pagination-data">
                    <button class="page-btn-data">Kembali</button>
                    <button class="page-btn-data active">1</button>
                    <button class="page-btn-data">2</button>
                    <button class="page-btn-data">3</button>
                    <button class="page-btn-data">4</button>
                    <button class="page-btn-data">Lanjut</button>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
