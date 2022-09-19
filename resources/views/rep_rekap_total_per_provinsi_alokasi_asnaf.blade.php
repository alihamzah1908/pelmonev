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
                                    <th class="tg-amwm">Provinsi</th>
                                    <th class="tg-amwm"></th>
                                    <th class="tg-amwm">Persetujuan (Rp)</th>
                                    <th class="tg-amwm">Persetujuan (%)</th>
                                    <th class="tg-amwm">Pencairan (Rp)</th>
                                    <th class="tg-amwm">Pencairan (%)</th>
                                    <th class="tg-amwm"></th>
                                    <th class="tg-amwm">Pelayanan Ibadah Haji</th>
                                    <th class="tg-amwm">Pendidikan dan Dakwah</th>
                                    <th class="tg-amwm">Kesehatan</th>
                                    <th class="tg-amwm">Sosial Keagamaan</th>
                                    <th class="tg-amwm">Ekonomi Umat</th>
                                    <th class="tg-amwm">Sarana dan Prasarana Ibadah</th>
                                    <th class="tg-amwm">Tanggap Darurat Bencana pada Pelayanan Ibadah Haji</th>
                                    <th class="tg-amwm">Tanggap Darurat Bencana pada Pendidikan dan Dakwah</th>
                                    <th class="tg-amwm">Tanggap Darurat Bencana pada Kesehatan</th>
                                    <th class="tg-amwm">Tanggap Darurat Bencana pada Sosial Keagamaan</th>
                                    <th class="tg-amwm">Tanggap Darurat Bencana pada Ekonomi Umat</th>
                                    <th class="tg-amwm">Tanggap Darurat Bencana pada Sarana dan Prasarana Ibadah</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr style="background: #e8b45f">
                                    <td class="tg-0lax">TOTAL</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">98</td>
                                    <td class="tg-0lax">123.400.000</td>
                                    <td class="tg-0lax">89</td>
                                    <td class="tg-0lax">&nbsp;</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Jawa Timur</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">98</td>
                                    <td class="tg-0lax">123.400.000</td>
                                    <td class="tg-0lax">89</td>
                                    <td class="tg-0lax">&nbsp;</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Jawa Tengah</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">98</td>
                                    <td class="tg-0lax">123.400.000</td>
                                    <td class="tg-0lax">89</td>
                                    <td class="tg-0lax">&nbsp;</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Jawa Barat</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">98</td>
                                    <td class="tg-0lax">123.400.000</td>
                                    <td class="tg-0lax">89</td>
                                    <td class="tg-0lax">&nbsp;</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">23.456.789</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                </tr>
                                </tbody>
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
