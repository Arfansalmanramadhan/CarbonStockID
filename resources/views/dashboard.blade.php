@extends('layout.mainlayaot')

@section('title', 'Buku')
@section('content')
    <style>

    </style>
    <div id="beranda-content" class="page-content">
        <h4 class="judul-beranda">Data Plot Area</h4>
        {{-- <table class="custom-table-hasil"> --}}
        <table class="custom-table-hasil ">
            <thead>
                <tr>
                    <th scope="col">NOMOR</th>
                    <th scope="col">DAERAH</th>
                    <th scope="col">LATITUDE</th>
                    <th scope="col">LONGITUDE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">00001</td>
                    <td>Mekar Jaya, Me...</td>
                    <td>-6.937154839...</td>
                    <td>6.937178839...</td>
                </tr>
                <tr>
                    <td>00001</td>
                    <td>Mekar Jaya, Me...</td>
                    <td>-6.937154839...</td>
                    <td>6.937178839...</td>
                </tr>
                <tr>
                    <td>00001</td>
                    <td>Mekar Jaya, Me...</td>
                    <td>-6.937154839...</td>
                    <td>6.937178839...</td>
                </tr>
            </tbody>
        </table>
        <h4 class="judul-beranda mt-5">Dashboard Monitoring </h4>
        {{-- <div id="carbon-prediction-chart-2"></div> --}}
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
                            <th class="kiriPancang" rowspan="2">No</th>
                            <th rowspan="2">Zona</th>
                            <th colspan="2">Serasah</th>
                            <th colspan="2">Pancanh</th>
                            <th colspan="2">Tiang</th>
                            <th class="hidden-column" colspan="2">pohon</th>
                            <th class="hidden-column kananPancang" rowspan="2">Aksi</th>
                        </tr>
                        <tr>
                            {{-- <th class="kiriPancang">No</th> --}}
                            {{-- <th>Zona</th> --}}
                            <th>Karbon</th>
                            <th>Serapan karbon</th>
                            <th>Karbon</th>
                            <th class="hidden-column">Serapan Karobn</th>
                            <th class="hidden-column">Karbon</th>
                            <th class="hidden-column">serapan karbon</th>
                            <th class="hidden-column">Karbon</th>
                            <th class="hidden-column">Serapan serapan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>11</td>
                            <td>15 cm</td>
                            <td>15cm</td>
                            <td>15</td>
                            <td>15</td>
                            <td class="hidden-column">15 gr/cm3</td>
                            <td class="hidden-column">15 kg</td>
                            <td class="hidden-column">15 kg</td>
                            <td class="hidden-column">15 kg</td>
                            <td class="hidden-column">15 kg</td>
                            <td class="hidden-column aksi-button">
                                <button class="edit-btn">
                                    <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Total karbon</td>
                            <td colspan="9">15 cm</td>
                        </tr>
                        <tr>
                            <td colspan="2">Total Serapan Karbon</td>
                            <td colspan="9">15 cm</td>
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
        <div class="custom-table-pancang">
            <div id="chart"></div>

        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('apexchart/dist/apexcharts.css') }}" />

    <script src="{{ asset('apexchart/dist/apexcharts.js') }}"></script>
    <script>
        const options = {
            series: [
                {
                    name: 'Karbon',
                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                },
                {
                    name: 'Serapan Karbon',
                    data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                }
            ],
            chart: {
                type: 'bar',
                height: 350
            },
            colors: ['#198754', '#DC3545'],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    borderRadius: 5
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct']
            },
            yaxis: {
                title: {
                    text: 'Ton/Hr'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " thousands";
                    }
                }
            }
        };

        const chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>

@endsection
