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
                                    <th class="tg-amwm">Kegiatan</th>
                                    <th class="tg-amwm">Ruang Lingkup</th>
                                    <th class="tg-amwm">Akhir PKS</th>
                                    <th class="tg-amwm">Adendum</th>
                                    <th class="tg-amwm">LPJ (Sudah/Belum)</th>
                                    <th class="tg-amwm">Tanggal LPJ Masuk</th>
                                    <th class="tg-amwm">Nominal Persetujuan</th>
                                    <th class="tg-amwm">Nominal Realisasi</th>
                                    <th class="tg-amwm">Efisiensi</th>
                                    <th class="tg-amwm">Cost Sharing</th>
                                    <th class="tg-amwm">Pengembalian</th>
                                    <th class="tg-amwm">Link LPJ</th>
                                    <th class="tg-amwm">Link Checklist</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="tg-0lax">Mitra A</td>
                                    <td class="tg-0lax">Kegiatan A</td>
                                    <td class="tg-0lax">Ruang Lingkup A</td>
                                    <td class="tg-0lax">2022-02-02</td>
                                    <td class="tg-0lax">Adendum</td>
                                    <td class="tg-0lax">Belum</td>
                                    <td class="tg-0lax">2022-02-02</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">122.345.000</td>
                                    <td class="tg-0lax">12</td>
                                    <td class="tg-0lax">12</td>
                                    <td class="tg-0lax">12.345.678</td>
                                    <td class="tg-0lax"><a href="https://google.com" target="_blank"><i class="icon-download"></i> </a></td>
                                    <td class="tg-0lax"><a href="https://google.com" target="_blank"><i class="icon-link"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Mitra B</td>
                                    <td class="tg-0lax">Kegiatan B</td>
                                    <td class="tg-0lax">Ruang Lingkup B</td>
                                    <td class="tg-0lax">2022-02-02</td>
                                    <td class="tg-0lax">Adendum</td>
                                    <td class="tg-0lax">Belum</td>
                                    <td class="tg-0lax">2022-02-02</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">122.345.000</td>
                                    <td class="tg-0lax">12</td>
                                    <td class="tg-0lax">12</td>
                                    <td class="tg-0lax">12.345.678</td>
                                    <td class="tg-0lax"><a href="https://google.com" target="_blank"><i class="icon-download"></i> </a></td>
                                    <td class="tg-0lax"><a href="https://google.com" target="_blank"><i class="icon-link"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Mitra C</td>
                                    <td class="tg-0lax">Kegiatan C</td>
                                    <td class="tg-0lax">Ruang Lingkup C</td>
                                    <td class="tg-0lax">2022-02-02</td>
                                    <td class="tg-0lax">Adendum</td>
                                    <td class="tg-0lax">Belum</td>
                                    <td class="tg-0lax">2022-02-02</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">122.345.000</td>
                                    <td class="tg-0lax">12</td>
                                    <td class="tg-0lax">12</td>
                                    <td class="tg-0lax">12.345.678</td>
                                    <td class="tg-0lax"><a href="https://google.com" target="_blank"><i class="icon-download"></i> </a></td>
                                    <td class="tg-0lax"><a href="https://google.com" target="_blank"><i class="icon-link"></i></a></td>
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
