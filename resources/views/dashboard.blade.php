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
        <!-- Content for Data Plot (initially hidden) -->
        {{-- </div> --}}

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Highcharts.stockChart('carbon-prediction-chart', {
                    chart: {
                        backgroundColor: '#FFFFFF', // Set sesuai dengan gambar
                        height: 400, // Tinggi yang sama
                    },
                    rangeSelector: {
                        selected: 1
                    },
                    xAxis: {
                        gridLineColor: '#E6E6E6',
                        gridLineDashStyle: 'Solid',
                        labels: {
                            style: {
                                color: '#666666',
                                fontSize: '12px'
                            }
                        }
                    },
                    yAxis: {
                        gridLineColor: '#E6E6E6',
                        gridLineDashStyle: 'Solid',
                        labels: {
                            style: {
                                color: '#666666',
                                fontSize: '12px'
                            }
                        },
                        plotLines: [{
                            color: '#D8D8D8',
                            value: 9782, // Upper value (sesuaikan nilai ini jika berbeda)
                            width: 1,
                            dashStyle: 'Dash',
                            label: {
                                text: '9,782',
                                align: 'right',
                                x: 0,
                                style: {
                                    color: '#666666',
                                    fontWeight: 'bold',
                                    backgroundColor: '#E6E6E6'
                                }
                            }
                        }, {
                            color: '#D8D8D8',
                            value: 9280, // Lower value (sesuaikan nilai ini jika berbeda)
                            width: 1,
                            dashStyle: 'Dash',
                            label: {
                                text: '9,280',
                                align: 'right',
                                x: 0,
                                style: {
                                    color: '#666666',
                                    fontWeight: 'bold',
                                    backgroundColor: '#E6E6E6'
                                }
                            }
                        }]
                    },
                    plotOptions: {
                        candlestick: {
                            upColor: '#28A745', // Warna hijau (bullish)
                            color: '#DC3545', // Warna merah (bearish)
                            lineColor: '#666666', // Warna garis candlestick
                            upLineColor: '#666666' // Warna garis bagian atas candlestick hijau
                        }
                    },
                    tooltip: {
                        formatter: function() {
                            return 'Date: <b>' + Highcharts.dateFormat('%Y-%m-%d', this.x) + '</b><br/>' +
                                'Open: <b>' + this.point.open + '</b><br/>' +
                                'High: <b>' + this.point.high + '</b><br/>' +
                                'Low: <b>' + this.point.low + '</b><br/>' +
                                'Close: <b>' + this.point.close + '</b>';
                        }
                    },
                    series: [{
                        type: 'candlestick',
                        name: 'Cadangan Karbon',
                        data: [
                            [Date.UTC(2013, 0, 1), 9500, 9700, 9400, 9600],
                            [Date.UTC(2014, 0, 1), 9400, 9600, 9300, 9500],
                            [Date.UTC(2015, 0, 1), 9300, 9500, 9200, 9400],
                            [Date.UTC(2016, 0, 1), 9200, 9400, 9100, 9300],
                            [Date.UTC(2017, 0, 1), 9100, 9300, 9000, 9200],
                            [Date.UTC(2018, 0, 1), 9000, 9200, 8900, 9100],
                            [Date.UTC(2019, 0, 1), 8900, 9100, 8800, 9000],
                            [Date.UTC(2020, 0, 1), 8800, 9000, 8700, 8900],
                            [Date.UTC(2021, 0, 1), 8700, 8900, 8600, 8800],
                            [Date.UTC(2022, 0, 1), 8600, 8800, 8500, 8700],
                            [Date.UTC(2023, 0, 1), 8500, 8700, 8400, 8600]
                        ],
                        dataGrouping: {
                            units: [
                                ['day', [1]],
                                ['month', [1, 3, 6]],
                                ['year', null]
                            ]
                        }
                    }]
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Highcharts.stockChart('carbon-prediction-chart-2', {
                    chart: {
                        backgroundColor: '#FFFFFF', // Set sesuai dengan gambar
                        height: 400, // Tinggi yang sama
                    },
                    rangeSelector: {
                        selected: 1
                    },
                    xAxis: {
                        gridLineColor: '#E6E6E6',
                        gridLineDashStyle: 'Solid',
                        labels: {
                            style: {
                                color: '#666666',
                                fontSize: '12px'
                            }
                        }
                    },
                    yAxis: {
                        gridLineColor: '#E6E6E6',
                        gridLineDashStyle: 'Solid',
                        labels: {
                            style: {
                                color: '#666666',
                                fontSize: '12px'
                            }
                        },
                        plotLines: [{
                            color: '#D8D8D8',
                            value: 9782, // Upper value (sesuaikan nilai ini jika berbeda)
                            width: 1,
                            dashStyle: 'Dash',
                            label: {
                                text: '9,782',
                                align: 'right',
                                x: 0,
                                style: {
                                    color: '#666666',
                                    fontWeight: 'bold',
                                    backgroundColor: '#E6E6E6'
                                }
                            }
                        }, {
                            color: '#D8D8D8',
                            value: 9280, // Lower value (sesuaikan nilai ini jika berbeda)
                            width: 1,
                            dashStyle: 'Dash',
                            label: {
                                text: '9,280',
                                align: 'right',
                                x: 0,
                                style: {
                                    color: '#666666',
                                    fontWeight: 'bold',
                                    backgroundColor: '#E6E6E6'
                                }
                            }
                        }]
                    },
                    plotOptions: {
                        candlestick: {
                            upColor: '#28A745', // Warna hijau (bullish)
                            color: '#DC3545', // Warna merah (bearish)
                            lineColor: '#666666', // Warna garis candlestick
                            upLineColor: '#666666' // Warna garis bagian atas candlestick hijau
                        }
                    },
                    tooltip: {
                        formatter: function() {
                            return 'Date: <b>' + Highcharts.dateFormat('%Y-%m-%d', this.x) + '</b><br/>' +
                                'Open: <b>' + this.point.open + '</b><br/>' +
                                'High: <b>' + this.point.high + '</b><br/>' +
                                'Low: <b>' + this.point.low + '</b><br/>' +
                                'Close: <b>' + this.point.close + '</b>';
                        }
                    },
                    series: [{
                        type: 'candlestick',
                        name: 'Cadangan Karbon',
                        data: [
                            [Date.UTC(2013, 0, 1), 9500, 9700, 9400, 9600],
                            [Date.UTC(2014, 0, 1), 9400, 9600, 9300, 9500],
                            [Date.UTC(2015, 0, 1), 9300, 9500, 9200, 9400],
                            [Date.UTC(2016, 0, 1), 9200, 9400, 9100, 9300],
                            [Date.UTC(2017, 0, 1), 9100, 9300, 9000, 9200],
                            [Date.UTC(2018, 0, 1), 9000, 9200, 8900, 9100],
                            [Date.UTC(2019, 0, 1), 8900, 9100, 8800, 9000],
                            [Date.UTC(2020, 0, 1), 8800, 9000, 8700, 8900],
                            [Date.UTC(2021, 0, 1), 8700, 8900, 8600, 8800],
                            [Date.UTC(2022, 0, 1), 8600, 8800, 8500, 8700],
                            [Date.UTC(2023, 0, 1), 8500, 8700, 8400, 8600]
                        ],
                        dataGrouping: {
                            units: [
                                ['day', [1]],
                                ['month', [1, 3, 6]],
                                ['year', null]
                            ]
                        }
                    }]
                });
            });
        </script>

    @endsection
