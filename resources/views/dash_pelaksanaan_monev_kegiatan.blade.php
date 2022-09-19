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
            <div class="row">
                <div class="col">
                    Total Persetujuan = Rp 123.456.789,00 (87%) <br />
                    Total Realisasi = Rp 23.456.789,00 (13%) <br />
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title"><h1>DASHBOARD PELAKSANAAN DAN MONEV PER KEGIATAN</h1></div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <figure class="highcharts-figure">
                        <div id="progress_bar"></div>
                    </figure>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <figure class="highcharts-figure">
                        <div id="line_chart"></div>
                    </figure>
                </div>
                <div class="col">
                    <figure class="highcharts-figure">
                        <div id="column_chart"></div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        #progress_bar {
            width: 420px;
            margin: 20px auto;
        }
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


        Highcharts.chart('progress_bar', {
            chart: {
                type: 'bar',
                height: 120
            },
            title: {
                text: 'Progres',
                align: 'center',
                margin: 0
            },
            credits: false,
            legend: false,
            tooltip: false,
            plotOptions: {
                bar: {
                    /* stacking: 'normal', */
                    borderWidth: 0,
                    borderRadius: 3
                }
            },
            xAxis: {
                visible: false
            },
            yAxis: {
                visible: true,
                min: 0,
                max: 100,
                title: {
                    text: null
                },
                gridLineWidth: 0,
                labels: {
                    y: -2
                }
            },
            series: [
                {
                    name: "Fill",
                    data: [100],
                    color: "gray",
                    grouping: false
                    // enableMouseTracking: false, disable tooltip on just this data element
                },
                {
                    name: "Percentage",
                    data: [getRandomInt(100)],
                    color: "orange",
                    dataLabels: {
                        enabled: true,
                        inside: true,
                        align: 'right',
                        format: '{point.y}%',
                        style: {
                            color: 'white',
                            textOutline: false,
                        }
                    }
                }
            ]
        });

        Highcharts.chart('line_chart', {
            title: {
                text: ''
            },
            yAxis: {
                title: {
                    text: ''
                }
            },

            xAxis: {
                title: {
                    text: ''
                },
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                }
            },

            series: [{
                name: 'Nilai',
                data: [getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100)]
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });

        Highcharts.chart('column_chart', {
            chart: {
                type: 'column'
            },
            colors: ['#678f34'],
            title: {
                text: 'Mingguan'
            },
            xAxis: {
                categories: [
                    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Juma`t',
                    'Sabtu',
                    'Ahad'
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
                data: [getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100), getRandomInt(100)]
            }]
        });

    </script>

@endpush
