@extends('layout.mainlayaot')

@section('title', 'Buku')

@section('content')
    <div id="prediksi-content" class="page-content content p-4 w-10">
        <div class="image-container mt-4">
            <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="img-normal" />
            <p class="large-text text-overlay">Verifikasi Data Surveyor</p>
        </div>
        <div id="carbon-prediction-chart">
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
                                <th>Nama</th>
                                <th >Daerah</th>
                                <th class="hidden-column kananPancang">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>11</td>
                                <td>15 cm</td>
                                <td>15cm</td>
                                <td class="hidden-column aksi-button">
                                    <button class="view-btn">
                                        Menyetujui
                                    </button>
                                    <button class="delete-btn">
                                        Buang
                                    </button>
                                </td>
                            </tr>
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
                                <th>Nama</th>
                                <th >Daerah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>11</td>
                                <td>15 cm</td>
                                <td>15cm</td>
                            </tr>
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
