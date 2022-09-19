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
                                    <th class="tg-amwm">No</th>
                                    <th class="tg-amwm">Keterangan</th>
                                    <th class="tg-amwm">Tanggal Transfer</th>
                                    <th class="tg-amwm">Berita Transfer</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="tg-0lax">1</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">2022-02-02</td>
                                    <td class="tg-0lax">Berita pengembalian 1</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">2</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">2022-02-02</td>
                                    <td class="tg-0lax">Berita pengembalian 2</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">3</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">2022-02-02</td>
                                    <td class="tg-0lax">Berita pengembalian 3</td>
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
