@extends('layout.mainlayaot')

@section('title', 'Buku')
@section('content')
    <div class="">
        <!-- Content for Beranda (default visible) -->
        <div id="beranda-content" class="page-content w-100 col-lg-10 ">
            <h4 class="judul-beranda">Data Plot Area</h4>
            <table class="custom-table-hasil">
                <thead class="me-4">
                    <tr>
                        <th>NOMOR</th>
                        <th>DAERAH</th>
                        <th>LATITUDE</th>
                        <th>LONGITUDE</th>
                    </tr>
                </thead>
                <tbody class="me-4">
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
                    <tr>
                        <td>00001</td>
                        <td>Mekar Jaya, Me...</td>
                        <td>-6.937154839...</td>
                        <td>6.937178839...</td>
                    </tr>
                </tbody>
            </table>
            <h4 class="judul-beranda mt-5">Prediksi Emisi Karbon Indonesia</h4>
            <div id="carbon-prediction-chart-2"></div>
        </div>
        <!-- Content for Data Plot (initially hidden) -->
    </div>

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
