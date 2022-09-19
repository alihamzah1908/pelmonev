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
                                    <th class="tg-amwm">Penerima Manfaat</th>
                                    <th class="tg-amwm">Kegiatan (Judul Sesuai SK)</th>
                                    <th class="tg-amwm">Ruang Lingkup</th>
                                    <th class="tg-amwm">Kabupaten/Kota</th>
                                    <th class="tg-amwm">Provinsi</th>
                                    <th class="tg-amwm">Tanggal Persetujuan</th>
                                    <th class="tg-amwm">Nominal Persetujuan</th>
                                    <th class="tg-amwm">Awal PKS</th>
                                    <th class="tg-amwm">Akhir PKS</th>
                                    <th class="tg-amwm">Adendum</th>
                                    <th class="tg-amwm">Nominal Pinbuk</th>
                                    <th class="tg-amwm">Tanggal Pinbuk</th>
                                    <th class="tg-amwm">Nomor Pinbuk</th>
                                    <th class="tg-amwm">Pencairan (Sekaligus-Termin-At Cost)</th>
                                    <th class="tg-amwm">Dana yang Sudah Dicairkan</th>
                                    <th class="tg-amwm">Surat Perintah Transfer</th>
                                    <th class="tg-amwm">Tanggal SPT</th>
                                    <th class="tg-amwm">Termin 2</th>
                                    <th class="tg-amwm" style="background: green; color: white">Berita SPT</th>
                                    <th class="tg-amwm" style="background: green; color: white">Nilai Pembatalan (Rp)</th>
                                    <th class="tg-amwm">Progress</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="tg-0lax">Mitra A</td>
                                    <td class="tg-0lax">Penerima Manfaat A</td>
                                    <td class="tg-0lax">Kegiatan A</td>
                                    <td class="tg-0lax">Ruang Lingkup A</td>
                                    <td class="tg-0lax">Semarang</td>
                                    <td class="tg-0lax">Jawa Tengah</td>
                                    <td class="tg-0lax">2022-02-02</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">2021-02-02</td>
                                    <td class="tg-0lax">2022-02-02</td>
                                    <td class="tg-0lax">Adendum A</td>
                                    <td class="tg-0lax">111.222.333</td>
                                    <td class="tg-0lax">2021-04-04</td>
                                    <td class="tg-0lax">12345</td>
                                    <td class="tg-0lax">111.111.111</td>
                                    <td class="tg-0lax">111.000.000</td>
                                    <td class="tg-0lax">SPT/001/2021</td>
                                    <td class="tg-0lax">2021-03-03</td>
                                    <td class="tg-0lax">2021-05-05</td>
                                    <td class="tg-0lax">Berita SPT A</td>
                                    <td class="tg-0lax">456.789</td>
                                    <td class="tg-0lax">35%</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Mitra B</td>
                                    <td class="tg-0lax">Penerima Manfaat B</td>
                                    <td class="tg-0lax">Kegiatan B</td>
                                    <td class="tg-0lax">Ruang Lingkup B</td>
                                    <td class="tg-0lax">Semarang</td>
                                    <td class="tg-0lax">Jawa Tengah</td>
                                    <td class="tg-0lax">2022-02-02</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">2021-02-02</td>
                                    <td class="tg-0lax">2022-02-02</td>
                                    <td class="tg-0lax">Adendum B</td>
                                    <td class="tg-0lax">111.222.333</td>
                                    <td class="tg-0lax">2021-04-04</td>
                                    <td class="tg-0lax">12345</td>
                                    <td class="tg-0lax">111.111.111</td>
                                    <td class="tg-0lax">111.000.000</td>
                                    <td class="tg-0lax">SPT/001/2021</td>
                                    <td class="tg-0lax">2021-03-03</td>
                                    <td class="tg-0lax">2021-05-05</td>
                                    <td class="tg-0lax">Berita SPT B</td>
                                    <td class="tg-0lax">456.789</td>
                                    <td class="tg-0lax">35%</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Mitra C</td>
                                    <td class="tg-0lax">Penerima Manfaat C</td>
                                    <td class="tg-0lax">Kegiatan C</td>
                                    <td class="tg-0lax">Ruang Lingkup C</td>
                                    <td class="tg-0lax">Semarang</td>
                                    <td class="tg-0lax">Jawa Tengah</td>
                                    <td class="tg-0lax">2022-02-02</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">2021-02-02</td>
                                    <td class="tg-0lax">2022-02-02</td>
                                    <td class="tg-0lax">Adendum C</td>
                                    <td class="tg-0lax">111.222.333</td>
                                    <td class="tg-0lax">2021-04-04</td>
                                    <td class="tg-0lax">12345</td>
                                    <td class="tg-0lax">111.111.111</td>
                                    <td class="tg-0lax">111.000.000</td>
                                    <td class="tg-0lax">SPT/001/2021</td>
                                    <td class="tg-0lax">2021-03-03</td>
                                    <td class="tg-0lax">2021-05-05</td>
                                    <td class="tg-0lax">Berita SPT C</td>
                                    <td class="tg-0lax">456.789</td>
                                    <td class="tg-0lax">35%</td>
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
