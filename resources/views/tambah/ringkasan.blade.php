@extends('layout.layaout')

@section('title', 'Ringkasan Hitungan')

@section('content')
    <div class="container-tambah-data hidden mt-5" id="newContent5">
        <div class="container-isi">
            <div class="table-container">
                <div class="h2-pancang-container section-hasil">
                    <h2 class="h2-tiang">Ringkasan Hitungan</h2>
                </div>
                {{-- <div class="frame-no-data">
                    <img src="{{ asset('/images/imageNoData.svg') }}" alt="" />
                    <p>Data yang Anda masukkan masih kosong. Mohon lengkapi semua informasi yang diperlukan.</p>
                </div> --}}
                <div class="table-header-hasil d-flex">
                    <button class="btn btn-unduhPDF" id="averageData">Unduh PDF</button>
                </div>
                <div class="plot-info">
                    <p>Nama : Arfan</p>
                    <p>Daerah Plot : Mekarjaya, Kec. Banjaran, Kabupaten Bandung</p>
                    <p>zona : 1</p>
                    <p>Latitude : -6.86617089575936</p>
                    <p>Longitude : 107.64260905148411</p>
                </div>
                <table class="custom-table-hasil">
                    <thead class="me-4">
                        <tr>
                            <th>NAMA PERHITUNGAN</th>
                            <th>TOTAL CO2</th>
                        </tr>
                    </thead>
                    <tbody class="me-4">
                        <tr>
                            <td>Berat bio akar</td>
                            <td>414.17 Ton C/Ha</td>
                        </tr>
                        <tr>
                            <td>Bio tanah</td>
                            <td>1380.58 Ton C/Ha</td>
                        </tr>
                        <tr>
                            <td>Necromas</td>
                            <td>138.06 Ton C/Ha</td>
                        </tr>
                        <tr>
                            <td>Tumbuhan bawah</td>
                            <td>82.83 Ton C/Ha</td>
                        </tr>
                        <tr>
                            <td>Serasah</td>
                            <td>55.23 Ton C/Ha</td>
                        </tr>
                        <tr>
                            <td>Semai</td>
                            <td>27.61 Ton C/Ha</td>
                        </tr>
                        <tr>
                            <td>Pancang</td>
                            <td>110.45 Ton C/Ha</td>
                        </tr>
                        <tr>
                            <td>Tiang</td>
                            <td>276.12 Ton C/Ha</td>
                        </tr>
                        <tr>
                            <td>Pohon</td>
                            <td>276.12 Ton C/Ha</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>TOTAL CADANGAN KARBON CO2</td>
                            <td>2,761.15 Ton C/Ha</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
