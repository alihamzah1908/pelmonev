@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group form-group-float">
                        <label class="form-group-float-label is-visible">Tahun <span class="text-danger">*</span></label>
                        <select name="trx_year_param" id="trx_year_param" class="form-control form-control-select2 select-search" data-fouc>
                            @for ($i = 2018 ; $i <= date('Y') ; $i++)
                               @if($i == $tahun)
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
                        <label class="form-group-float-label is-visible">Propinsi</label>
                            <select name="region_prop_param" id="region_prop_param" data-placeholder="Pilih Data" class="form-control form-control-select2 check-kuota" data-fouc>
                                
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
    <div class="row">
        <div class="col-xl-12">
            <div class="card" style="zoom: 1;">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">{{ $title }}</h5>
                </div>
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="chart-container"></div>

                    </figure>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        #chart-container {
            height: 600px;
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

        let currentProvinsi = '';

        $(document).ready(function () {

            $('#filter-dashboard').click(function(){
                let provSelect = $('select[name=region_prop_param]');
                let dataProv = (null === provSelect.val())? currentProvinsi : provSelect.val() ;
                let tahun = $('select[name=trx_year_param]').val();

                window.location.href = `{{url('dashboard-realisasi')}}?prov=${dataProv}&tahun=${tahun}`;

                console.log('TEST', dataProv, tahun);

            });

            $('#region_prop_param').select2({
                placeholder : "Pilih Propinsi",
                ajax : {
                    url :  "{{ url('daftar-daerah/provinsi/') }}",
                    dataType: 'json',
                    processResults: function(data){
                        data[1].selected = true;
                        return {
                            results: data
                        };
                    },
                },
            });

            let nominal_total_alokasi = "{{$sum_nominal}}";
            let gapVal = "{{$gapVal}}";
            let gapColor = "{{$gapColor}}";

            let proposalMasuk = "{{$proposalMasuk}}"
            let proposalKajian = "{{$proposalKajian}}"
            let proposalRealisasi = "{{$proposalRealisasi}}"
        
            let charts = $('#chart-container').highcharts({
                chart: {
                    type: 'column'
                },
                colors: [
                        gapColor, '#4472C4', '#f2a519', '#6677ef', '#ff7979'
                ],
                title: {
                    text: 'Realisasi Anggaran 2022'
                },
                xAxis: {
                    type: 'category'
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -40,
                    y: 50,
                    floating: true,
                    borderWidth: 1,
                    backgroundColor: '#FFFFFF',
                    shadow: true
                },
                yAxis: {
                    title: {
                        text: 'Nilai (Juta)'
                    },
                    stackLabels: {
                        enabled: false,
                        style: {
                            fontWeight: 'bold',
                            color: ( // theme
                                Highcharts.defaultOptions.title.style &&
                                Highcharts.defaultOptions.title.style.color
                            ) || 'gray'
                        }
                    }
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            formatter: function () {
                                if (this.y) {
                                    return this.y;
                                }
                            },
                            enabled: true
                        }
                    },

                },

                series: [
                    {
                        name: 'Gap Alokasi',
                        data: [{
                            name: 'Total Anggaran Kemaslahatan',
                            y: parseFloat(gapVal),
                            drilldown: null,
                           
                        }]
                    },
                    {
                        name: 'Total Alokasi',
                        data: [{
                            name: 'Total Anggaran Kemaslahatan',
                            y: parseFloat(nominal_total_alokasi),
                            drilldown: null,
                            
                        }]
                    }, {
                        name: 'Proposal Masuk',
                        data: [{
                            name: 'Total per-Tahapan Proposal',
                            y: parseFloat(proposalMasuk),
                            drilldown: 'detail-proposal',
                            
                        }]
                    }, {
                        name: 'Kajian',
                        data: [{
                            name: 'Total per-Tahapan Proposal',
                            y: parseFloat(proposalKajian),
                            drilldown: 'detail-kajian',
                            
                        }]
                    }, {
                        name: 'Realisasi Mitra',
                        data: [{
                            name: 'Total per-Tahapan Proposal',
                            y: parseFloat(proposalRealisasi),
                            drilldown: 'detail-realisasi-mitra',
                           
                        }]
                    },
                ],
                drilldown: {
                    series: [{
                        type: 'pie',
                        name: "Detail Realisasi Mitra",
                        id: 'detail-realisasi-mitra',
                        data: [
                            {
                                name: 'Lazis NU',
                                y: 20
                            },
                            {
                                name: 'Lazis MU',
                                y: 25
                            },
                            {
                                name: 'DT',
                                y: 20
                            },
                            {
                                name: 'YT',
                                y: 10
                            },
                        ]
                    }, {
                        type: 'pie',
                        name: "Detail Kajian",
                        id: 'detail-kajian',
                        data: [
                            {
                                name: 'Lazis NU',
                                y: 25
                            },
                            {
                                name: 'Lazis MU',
                                y: 20
                            },
                            {
                                name: 'DT',
                                y: 15
                            },
                            {
                                name: 'YT',
                                y: 15
                            },
                        ]
                    }, {
                        type: 'pie',
                        name: "Detail Proposal",
                        id: 'detail-proposal',
                        data: [
                            {
                                name: 'Lazis NU',
                                y: 15
                            },
                            {
                                name: 'Lazis MU',
                                y: 5
                            },
                            {
                                name: 'DT',
                                y: 30
                            },
                            {
                                name: 'YT',
                                y: 10
                            },
                        ]
                    },

                    ]
                }
            });
        })
    </script>
@endpush
