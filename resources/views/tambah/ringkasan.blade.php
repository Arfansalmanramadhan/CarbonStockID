@extends('layout.layaout')

@section('title', 'Ringkasan Hitungan')

@section('content')
    {{-- <div class="container-tambah-data hidden mt-5" id="newContent5"> --}}
    {{-- <div class="container-isi"> --}}
    <div class="table-container">
        <div class="table-wrapper">
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
                <p>Nama : {{ $user->nama }}</p>
                <p>Daerah Plot : {{ $poltArea->daerah }}</p>
                <p>Latitude :{{ $poltArea->latitude }}</p>
                <p>Longitude : {{ $poltArea->longitude }}</p>
            </div>
            <div class="row mb-3">
                @foreach ($ringkasan as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <div class="card h-100 border-light shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-center text-success">Pendekatan Kerapatan</h5>
                                <p class="card-text text-center text-muted">
                                    <strong>{{ $item['zona'] ?? 'Data tidak tersedia' }}</strong>
                                </p>
                                <div class="mt-3">
                                    <p class="text-dark">Biomassa di atas permukaan tanah (ton/ha):</p>
                                    <p class="card-text text-start text-success fw-bold">
                                        {{ $item['Biomassadiataspermukaantanah'] ?? 0 }}</p>
                                </div>
                                <div class="mt-3">
                                    <p class="text-dark">Kandungan karbon (ton/ha):</p>
                                    <p class="card-text text-start text-success fw-bold">
                                        {{ $item['Kandungankarbon'] ?? 0 }}
                                    </p>
                                </div>
                                <div class="mt-3">
                                    <p class="text-dark">Serapan CO2 (ton/ha):</p>
                                    <p class="card-text text-start text-success fw-bold">{{ $item['SerapanCO2'] ?? 0 }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @foreach ($ringkasann as $item)
                <div class="row">
                    <div class="col-md-6  height-card box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-0">Summary Kandungan Karbon</h4>
                                <p class="mb-3">Bagian ini untuk menampilkan hitungan total kandungan karbon untuk
                                    lokasi
                                    {{ $poltArea->daerah }}</p>

                                <div class="table-wrapper ">
                                    <table class=" custom-table-pancang table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Subplot</th>
                                                <th class="text-right text-center">Karbon</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Seresah</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs ">{{ $item['SerasahKarbon'] ?? 0 }}
                                                        Ton C/Ha
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Semai</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs">{{ $item['semaiKarbon'] ?? 0 }} Ton
                                                        C/Ha
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tumbuhan Bawah</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs">
                                                        {{ $item['tumbuhanbawahkarbon'] ?? 0 }} Ton C/Ha
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Pancang</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs">
                                                        {{ $item['TotalPancangkarbon'] ?? 0 }} Ton C/Ha
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Tiang</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs">
                                                        {{ $item['TotalTiangKarbon'] ?? 0 }} Ton C/Ha
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Nekromas</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs">{{ $item['NecromassCarbon'] ?? 0 }}
                                                        Ton C/Ha</div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Pohon</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs">
                                                        {{ $item['TotalPohonkarbon'] ?? 0 }} Ton C/Ha
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Tanah</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs">{{ $item['TanahCarbon'] ?? 0 }} Ton
                                                        C/Ha</div>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>Total</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs">
                                                        {{ $item['TotalKandunganKarbon'] ?? 0 }} Ton C/Ha
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6  height-card box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-0">Summary Serapan CO2</h4>
                                <p class="mb-3">Bagian ini untuk menampilkan hitungan total serapa CO2 untuk lokasi
                                    {{ $poltArea->daerah }}</p>

                                <div class="table-wrapper ">
                                    <table class=" custom-table-pancang table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Subplot</th>
                                                <th class="text-right text-center">Karbon</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Seresah</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs ">{{ $item['Serasahco2'] ?? 0 }} Ton
                                                        C/Ha</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Semai</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs">{{ $item['semaico2'] ?? 0 }} Ton
                                                        C/Ha</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tumbuhan Bawah</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs">
                                                        {{ $item['tumbuhanbawahco2'] ?? 0 }} Ton C/Ha
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Pancang</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs">{{ $item['TotalPancangco2'] ?? 0 }}
                                                        Ton C/Ha</div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Tiang</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs">{{ $item['TotalTiangco2'] ?? 0 }}
                                                        Ton C/Ha</div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Nekromas</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs">{{ $item['Necromassco2'] ?? 0 }}
                                                        Ton C/Ha</div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Pohon</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs">{{ $item['TotalPohonco2'] ?? 0 }}
                                                        Ton C/Ha</div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Tanah</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs">{{ $item['TanahCo2'] ?? 0 }} Ton
                                                        C/Ha</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Akar</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs">{{ $item['beratMasaAkar'] ?? 0 }}
                                                        Ton C/Ha
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Total</td>
                                                <td class="text-right">
                                                    <div class="badge btn-successs">{{ $item['KarbonCo2'] ?? 0 }} Ton
                                                        C/Ha</div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row mt-4">
                    <div class="card">

                        <div class="card-body">
                            <h4 class="card-title mb-4">Rekapan Perhitungan Carbon 5 Poll Di {{ $poltArea->daerah }}
                            </h4>


                            <div class="table-wrapper table-responsive">
                                <table class="custom-table-pancang table-striped table">
                                    <thead>
                                        <tr>
                                            <th class="kiriPancang">No</th>
                                            <th>Nama Penghitungan</th>
                                            <th>Total CO2</th>
                                            <th>Luas Tanah (ha)</th>
                                            <th>Total</th>
                                            <th class="hidden-column kananPancang">Persen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="">1</td>
                                            <td>Serasah</td>
                                            <td>{{ $item['Serasahco2'] ?? 0 }} Ton C/Ha</td>
                                            <td>{{ $item['faktor'] ?? 0 }} Ha</td>
                                            <td>{{ $item['Serasah'] ?? 0 }} Ton C/Ha</td>
                                            <td>{{ $item['hasilSerasahPersen'] ?? 0 }} %</td>
                                            {{-- {{ dd($item) }} --}}
                                        </tr>
                                        <tr>
                                            <td class="">2</td>
                                            <td>Necromass</td>
                                            <td>{{ $item['Necromassco2'] ?? 0 }} Ton C/Ha</td>
                                            <td>{{ $item['faktor'] ?? 0 }} Ha</td>
                                            <td>{{ $item['Necromass'] ?? 0 }} Ton C/Ha</td>
                                            <td>{{ $item['hasilNecromassPersen'] ?? 0 }} %</td>

                                        </tr>
                                        <tr>
                                            <td class="">3</td>
                                            <td>Co2 Tanaman</td>
                                            <td>{{ $item['TotalCarbonn'] ?? 0 }} Ton C/Ha</td>
                                            <td>{{ $item['faktor'] ?? 0 }} Ha</td>
                                            <td>{{ $item['Co2Tanaman'] ?? 0 }} Ton C/Ha</td>
                                            <td>{{ $item['hasilco2tanamanPersen'] ?? 0 }} %</td>

                                        </tr>
                                        <tr>
                                            <td class="">4</td>
                                            <td>Tanah</td>
                                            <td>{{ $item['TanahCo2'] ?? 0 }} Ton C/Ha</td>
                                            <td>{{ $item['faktor'] ?? 0 }} Ha</td>
                                            <td>{{ $item['tanah'] ?? 0 }} Ton C/Ha</td>
                                            <td>{{ $item['hasiltanahPersen'] ?? 0 }} %</td>

                                        </tr>
                                        <tr>
                                            <td class="">5</td>
                                            <td>Berat bioomasa akar</td>
                                            <td>{{ $item['beratMasaAkar'] ?? 0 }} Ton C/Ha</td>
                                            <td>{{ $item['faktor'] ?? 0 }} Ha</td>
                                            <td>{{ $item['BeratBiomassaAkar'] ?? 0 }} Ton C/Ha</td>
                                            <td>{{ $item['hasilakarPersen'] ?? 0 }} %</td>

                                        </tr>
                                        <tr>
                                            <td colspan="4">Total Carbon 5 Poll</td>
                                            <td colspan="2">{{ $item['TotalKaoobon'] ?? 0 }} Ton </td>

                                        </tr>
                                        <tr>
                                            <td colspan="4">Baseline Lahan Kosong</td>
                                            <td colspan="2">{{ $item['BaselineLahanKosong'] ?? 0 }} Ton C/Ha</td>

                                        </tr>
                                        {{-- @foreach ($pancang as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->keliling }} cm</td>
                                        <td>{{ $item->diameter }} cm</td>
                                        <td>{{ $item->nama_lokal }}</td>
                                        <td>{{ $item->nama_ilmiah }}</td>
                                        <td class="hidden-column">{{ $item->kerapatan_jenis_kayu }}gr/cm3</td>
                                        <td class="hidden-column">{{ $item->bio_di_atas_tanah }} kg</td>
                                        <td class="hidden-column">{{ $item->kandungan_karbon }}kg</td>
                                        <td class="hidden-column">{{ $item->co2 }} kg</td>
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
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- </div> --}}
    {{-- </div> --}}
@endsection
