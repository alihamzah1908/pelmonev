@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card" style="zoom: 1;">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">{{ $title }}</h5>
                    <div class="align-content-end align-items-end">
                        <button class="btn btn-outline-success"><i class="icon-file-excel"></i> Download</button>
                    </div>
                </div>
                <div class="card-body">
                    <!--Frame Tabel-->
                    <div id="frame-tabel">
                        <div class="table-responsive">
                            <table class="table datatable-pagination" id="tabel-data">
                                <thead>
                                <tr>
                                    <th class="tg-amwm">Mitra Kemaslahatan</th>
                                    <th class="tg-amwm">Jumlah SK Dilaksanakan</th>
                                    <th class="tg-amwm">Pembatalan</th>
                                    <th class="tg-amwm">%</th>
                                    <th class="tg-amwm">Nilai Persetujuan</th>
                                    <th class="tg-amwm">Nilai Pembatalan</th>
                                    <th class="tg-amwm">Nilai Pelaksanaan</th>
                                    <th class="tg-amwm">%</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="tg-0lax">Mitra A</td>
                                    <td class="tg-0lax">195</td>
                                    <td class="tg-0lax">2</td>
                                    <td class="tg-0lax">43.43</td>
                                    <td class="tg-0lax">80.195.330.493</td>
                                    <td class="tg-0lax">1.732.450.000</td>
                                    <td class="tg-0lax">78.462.880.493</td>
                                    <td class="tg-0lax">41.32</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Mitra B</td>
                                    <td class="tg-0lax">195</td>
                                    <td class="tg-0lax">2</td>
                                    <td class="tg-0lax">43.43</td>
                                    <td class="tg-0lax">80.195.330.493</td>
                                    <td class="tg-0lax">1.732.450.000</td>
                                    <td class="tg-0lax">78.462.880.493</td>
                                    <td class="tg-0lax">41.32</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Mitra C</td>
                                    <td class="tg-0lax">195</td>
                                    <td class="tg-0lax">2</td>
                                    <td class="tg-0lax">43.43</td>
                                    <td class="tg-0lax">80.195.330.493</td>
                                    <td class="tg-0lax">1.732.450.000</td>
                                    <td class="tg-0lax">78.462.880.493</td>
                                    <td class="tg-0lax">41.32</td>
                                </tr>

                                </tbody>
                                <tfoot>
                                <tr style="font-weight: bolder">
                                    <td class="tg-0lax">TOTAL</td>
                                    <td class="tg-0lax">195</td>
                                    <td class="tg-0lax">2</td>
                                    <td class="tg-0lax">43.43</td>
                                    <td class="tg-0lax">80.195.330.493</td>
                                    <td class="tg-0lax">1.732.450.000</td>
                                    <td class="tg-0lax">78.462.880.493</td>
                                    <td class="tg-0lax">41.32</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let tabelData;
        $(document).ready(function () {
            tabelData = $('#tabel-data').DataTable();
        })
    </script>
@endpush
