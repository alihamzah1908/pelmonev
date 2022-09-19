@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group form-group-float">
                        <label for="trx_year_param" class="form-group-float-label is-visible">Tahun <span
                                class="text-danger">*</span></label>
                        <select name="trx_year_param" id="trx_year_param"
                                class="form-control form-control-select2 select-search" data-fouc>
                            @for ($i = 2018 ; $i <= date('Y') ; $i++)
                                @if($i === date('Y'))
                                    <option selected="selected" value="<?= $i ?>"><?= $i ?></option>
                                @else
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group form-group-float">
                        <button type="button" id="filter-dashboard" class="btn btn-primary">Filter</button>
                        <button type="button" id="reset-filter-dashboard" class="btn btn-outline-warning">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <figure class="highcharts-figure">
                        <div id="monitoring_online_offline"></div>
                    </figure>

                </div>
                <div class="col-6">
                    <figure class="highcharts-figure">
                        <div id="monitoring_detail"></div>
                    </figure>

                </div>
            </div>
            <div class="row">
                <div class="col">
                    <figure class="highcharts-figure">
                        <div id="monitoring_bar"></div>
                    </figure>

                </div>
            </div>
            <div class="row">
                <div class="col">
                    <figure class="highcharts-figure">
                        <div id="serahterima_online_offline"></div>
                    </figure>

                </div>
            </div>
            <div class="row">
                <div class="col">
                    <figure class="highcharts-figure">
                        <div id="serahterima_bar"></div>
                    </figure>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        #monitoring_online_offline {
            height: 450px;
        }

        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>

@endpush
@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>


    <script>
        function getRandomInt(max) {
            return Math.floor(Math.random() * max);
        }

        Highcharts.chart('monitoring_online_offline', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Metode monitoring'
            },
            xAxis: {
                categories: [
                    'Online',
                    'Offline',
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                },
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    stacking: 'normal',
                    dataLabels: {
                        formatter: function () {
                            if (this.y) {
                                return this.y;
                            }
                        },
                        enabled: true
                    }
                }
            },
            series: [{
                name: 'Jumlah',
                data: [getRandomInt(100), getRandomInt(100)]
            }]
        });

        Highcharts.chart('monitoring_detail', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Monitoring Detail'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    innerSize: '60%',
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [
                {
                    name: 'Jumlah',
                    data: [
                        ['Monitoring Rutin Bulanan/Progress Report', 44],
                        ['Monitoring oleh Divisi', 26],
                        ['Monitoring Pencairan', 20],
                        ['Monitoring Pendampingan AI/MR/Hukum Kepatuhan', 3],
                        ['Meeting', 5]
                    ]
                }
            ]
        });

        Highcharts.chart('monitoring_bar', {
            chart: {
                type: 'bar'
            },
            colors: ['#4472C4'],
            title: {
                text: 'Monitoring Detail'
            },
            xAxis: {
                categories: ['Monitoring Rutin Bulanan/Progress Report', 'Monitoring oleh Divisi', 'Monitoring Pencairan', 'Monitoring Pendampingan AI/MR/Hukum Kepatuhan', 'Meeting'],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah  ',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Jumlah',
                data: [44, 26, 20, 3, 5]
            }, ]
        });

        Highcharts.chart('serahterima_online_offline', {
            chart: {
                type: 'column'
            },
            colors: ['#ff7979'],
            title: {
                text: 'Metode serah terima'
            },
            xAxis: {
                categories: [
                    'Online',
                    'Offline',
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                },
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    stacking: 'normal',
                    dataLabels: {
                        formatter: function () {
                            if (this.y) {
                                return this.y;
                            }
                        },
                        enabled: true
                    }
                }
            },
            series: [{
                name: 'Jumlah',
                data: [getRandomInt(100), getRandomInt(100)]
            }]
        });

        Highcharts.chart('serahterima_bar', {
            chart: {
                type: 'bar'
            },
            colors: ['#f2a519'],
            title: {
                text: 'Sebaran serah terima'
            },
            xAxis: {
                categories: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                title: {
                    text: 'Serah terima'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah  ',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Jumlah',
                data: [getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100)]
            }, ]
        });
    </script>
@endpush
