@extends('layouts.app')
@section('content')
<style>
    .swal2-textarea{
        width: 100%; 
        max-width: 100%;
    }
</style>
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{ $title }}</h5>
        <div class="header-elements">
            <div class="list-icons">

            </div>
        </div>
    </div>
    <div class="card-body">
        <!--Frame Tabel-->
        <div id="frame-tabel">
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="form-group form-group-float">
                        <label class="form-group-float-label is-visible">Judul Proposal <span class="text-danger">*</span></label>
                        <input name="search_param" id="search_param" placeholder="Pencarian Judul" class="form-control param" data-fouc />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-float">
                        <label class="form-group-float-label is-visible">Status Proposal <span class="text-danger">*</span></label>
                        <select name="proses_st_param" id="proses_st_param" data-placeholder="Pilih Data" class="form-control form-control-select2 param" required data-fouc>
                            <option value="SEMUA">==Tampilkan Semua ==</option>
                            {!! listStatus() !!}
                        </select>
                    </div>
                </div>
            </div>
            @if(isRoleUser(['pelmonev']) && Auth::user()->user_id == 'Kadiv_Pelmonev')
            <div class="table-responsive">
                <table class="table datatable-pagination" id="tabel-data" width="100%">
                    <thead>
                        <tr>
                            <th width="0%">No</th>
                            <th width="10%">Kode Proposal</th>
                            <th width="10%">Nomor SK</th>
                            <th width="10%">Id</th>
                            <th width="0%" id="tanggal_pengajuan_table">tanggal_pengajuan</th>
                            <th width="0%" id="trx_pemohon_id_table">Pemohon</th>
                            <th width="10%" id="pemohon_nm_table">Pemohon</th>
                            <th width="0%" id="trx_mitra_kemaslahatan_id_table">Mitra Kemaslahatan</th>
                            <th width="10%" id="mitra_kemaslahatan_nm_table">Mitra Kemaslahatan</th>
                            <th width="30%" id="judul_proposal_table">Judul Proposal</th>
                            <th width="10%" id="nominal_table">Nominal</th>
                            <th width="0%" id="ruang_lingkup_table">ruang_lingkup</th>
                            <th width="10%" id="ruang_lingkup_nm_table">Ruang Lingkup</th>
                            <th width="0%" id="ruang_lingkup_nm_table">Status</th>
                            <th width="0%" id="order_column_table">order_column</th>
                            <th width="20%" id="actions_table">#</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <br />
            <h3>Tabel Perikatan</h3>
            <div class="table-responsive">
                <table class="table datatable-pagination" id="tabel-perikatan" width="100%">
                    <thead>
                        <tr>
                            <th width="0%">No</th>
                            <th width="10%">Kode Proposal</th>
                            <th width="10%">Nomor SK</th>
                            <th width="10%">Id</th>
                            <th width="0%" id="tanggal_pengajuan_table">tanggal_pengajuan</th>
                            <th width="0%" id="trx_pemohon_id_table">Pemohon</th>
                            <th width="10%" id="pemohon_nm_table">Pemohon</th>
                            <th width="0%" id="trx_mitra_kemaslahatan_id_table">Mitra Kemaslahatan</th>
                            <th width="10%" id="mitra_kemaslahatan_nm_table">Mitra Kemaslahatan</th>
                            <th width="30%" id="judul_proposal_table">Judul Proposal</th>
                            <th width="10%" id="nominal_table">Nominal</th>
                            <th width="0%" id="ruang_lingkup_table">ruang_lingkup</th>
                            <th width="10%" id="ruang_lingkup_nm_table">Ruang Lingkup</th>
                            <th width="0%" id="ruang_lingkup_nm_table">Status</th>
                            <th width="0%" id="order_column_table">order_column</th>
                            <th width="20%" id="actions_table">#</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <br />
            <h3>Tabel Pencairan</h3>
            <div class="table-responsive">
                <table class="table datatable-pagination" id="tabel-pencairan" width="100%">
                    <thead>
                        <tr>
                            <th width="0%">No</th>
                            <th width="10%">Kode Proposal</th>
                            <th width="10%">Nomor SK</th>
                            <th width="10%">Id</th>
                            <th width="0%" id="tanggal_pengajuan_table">tanggal_pengajuan</th>
                            <th width="0%" id="trx_pemohon_id_table">Pemohon</th>
                            <th width="10%" id="pemohon_nm_table">Pemohon</th>
                            <th width="0%" id="trx_mitra_kemaslahatan_id_table">Mitra Kemaslahatan</th>
                            <th width="10%" id="mitra_kemaslahatan_nm_table">Mitra Kemaslahatan</th>
                            <th width="30%" id="judul_proposal_table">Judul Proposal</th>
                            <th width="10%" id="nominal_table">Nominal</th>
                            <th width="0%" id="ruang_lingkup_table">ruang_lingkup</th>
                            <th width="10%" id="ruang_lingkup_nm_table">Ruang Lingkup</th>
                            <th width="0%" id="ruang_lingkup_nm_table">Status</th>
                            <th width="0%" id="order_column_table">order_column</th>
                            <th width="20%" id="actions_table">#</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            @elseif(@isRoleUser(['pelmonev']) && Auth::user()->user_id == 'Team_Pelmonev1b')
            <br />
            <h3>Tabel Perikatan</h3>
            <div class="table-responsive">
                <table class="table datatable-pagination" id="tabel-perikatan" width="100%">
                    <thead>
                        <tr>
                            <th width="0%">No</th>
                            <th width="10%">Kode Proposal</th>
                            <th width="10%">Nomor SK</th>
                            <th width="10%">Id</th>
                            <th width="0%" id="tanggal_pengajuan_table">tanggal_pengajuan</th>
                            <th width="0%" id="trx_pemohon_id_table">Pemohon</th>
                            <th width="10%" id="pemohon_nm_table">Pemohon</th>
                            <th width="0%" id="trx_mitra_kemaslahatan_id_table">Mitra Kemaslahatan</th>
                            <th width="10%" id="mitra_kemaslahatan_nm_table">Mitra Kemaslahatan</th>
                            <th width="30%" id="judul_proposal_table">Judul Proposal</th>
                            <th width="10%" id="nominal_table">Nominal</th>
                            <th width="0%" id="ruang_lingkup_table">ruang_lingkup</th>
                            <th width="10%" id="ruang_lingkup_nm_table">Ruang Lingkup</th>
                            <th width="0%" id="ruang_lingkup_nm_table">Status</th>
                            <th width="0%" id="order_column_table">order_column</th>
                            <th width="20%" id="actions_table">#</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            @elseif(@isRoleUser(['pelmonev']) && Auth::user()->user_id == 'Team_Pelmonev1a')
            <br />
            <h3>Tabel Pencairan</h3>
            <div class="table-responsive">
                <table class="table datatable-pagination" id="tabel-pencairan" width="100%">
                    <thead>
                        <tr>
                            <th width="0%">No</th>
                            <th width="10%">Kode Proposal</th>
                            <th width="10%">Nomor SK</th>
                            <th width="10%">Id</th>
                            <th width="0%" id="tanggal_pengajuan_table">tanggal_pengajuan</th>
                            <th width="0%" id="trx_pemohon_id_table">Pemohon</th>
                            <th width="10%" id="pemohon_nm_table">Pemohon</th>
                            <th width="0%" id="trx_mitra_kemaslahatan_id_table">Mitra Kemaslahatan</th>
                            <th width="10%" id="mitra_kemaslahatan_nm_table">Mitra Kemaslahatan</th>
                            <th width="30%" id="judul_proposal_table">Judul Proposal</th>
                            <th width="10%" id="nominal_table">Nominal</th>
                            <th width="0%" id="ruang_lingkup_table">ruang_lingkup</th>
                            <th width="10%" id="ruang_lingkup_nm_table">Ruang Lingkup</th>
                            <th width="0%" id="ruang_lingkup_nm_table">Status</th>
                            <th width="0%" id="order_column_table">order_column</th>
                            <th width="20%" id="actions_table">#</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="/js/catiline.js"></script>
<script src="/js/shp.js"></script>
<script src="/js/leaflet.shpfile.js"></script>
<script src="/global_assets/shp/batas_provinsi.js"></script>
<script>
    var tabelData;
    var tabelFiles;
    var saveMethod = 'tambah';
    var baseUrl = '{{ url($baseUrl) }}';
    $(document).ready(function(e) {
        tabelData = $('#tabel-data').DataTable({
            language: {
                paginate: {
                    'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;',
                    'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'
                }
            },
            pagingType: "simple",
            processing: true,
            serverSide: true,
            order: [
                [12, 'desc']
            ],
            ajax: {
                url: baseUrl + '/program/data',
                type: "POST",
                data: function(data) {
                    data._token = $('meta[name="csrf-token"]').attr('content');
                    data.judul = $('input[name=search_param]').val();
                    data.proses = $('select[name=proses_st_param]').val();
                },
            },
            dom: 'tpi',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    visible: true,
                    orderable: false
                },
                {
                    data: 'trx_proposal_id',
                    name: 'trx_proposal_id',
                    defaultContent: "-",
                    visible: true
                },
                {
                    data: 'sk_pengesahan_pendirian_no',
                    name: 'sk_pengesahan_pendirian_no',
                    defaultContent: "-",
                    visible: true
                },
                {
                    data: 'trx_proposal_uid',
                    name: 'trx_proposal_uid',
                    defaultContent: "-",
                    visible: false
                },
                {
                    data: 'tanggal_pengajuan',
                    name: 'tanggal_pengajuan',
                    defaultContent: "-",
                    visible: false
                },
                {
                    data: 'trx_pemohon_id',
                    name: 'trx_pemohon_id',
                    defaultContent: "-",
                    visible: false
                },
                @if(!isRoleUser('pemohon')) {
                    data: 'pemohon_nm',
                    name: 'pemohon_nm',
                    visible: true
                },
                @else {
                    data: 'pemohon_nm',
                    name: 'pemohon_nm',
                    visible: false
                },
                @endif {
                    data: 'trx_mitra_kemaslahatan_id',
                    name: 'trx_mitra_kemaslahatan_id',
                    defaultContent: "-",
                    visible: false
                },
                {
                    data: 'mitra_kemaslahatan_nm',
                    name: 'mitra_kemaslahatan_nm',
                    visible: true
                },
                {
                    data: 'judul_proposal',
                    name: 'judul_proposal',
                    visible: true
                },
                {
                    data: 'nominal',
                    name: 'nominal',
                    visible: true,
                    render: $.fn.dataTable.render.number('.', ',', 2, 'Rp ')
                },
                {
                    data: 'ruang_lingkup',
                    name: 'ruang_lingkup',
                    defaultContent: "-",
                    visible: false
                },
                {
                    data: 'ruang_lingkup_nm',
                    name: 'ruang_lingkup_nm',
                    visible: true
                },
                {
                    data: 'proses_st_nm',
                    name: 'proses_st_nm',
                    visible: true
                },
                {
                    data: 'order_column',
                    name: 'order_column',
                    visible: false
                },
                {
                    data: 'actions',
                    name: 'actions',
                    visible: true
                }
            ],
        });

        tabelPerikatan = $('#tabel-perikatan').DataTable({
            language: {
                paginate: {
                    'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;',
                    'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'
                }
            },
            pagingType: "simple",
            processing: true,
            serverSide: true,
            order: [
                [12, 'desc']
            ],
            ajax: {
                url: baseUrl + '/program/pencairanperikatan/data',
                type: "POST",
                data: function(data) {
                    data._token = $('meta[name="csrf-token"]').attr('content');
                    data.type = 'perikatan';
                },
            },
            dom: 'tpi',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    visible: true,
                    orderable: false
                },
                {
                    data: 'trx_proposal_id',
                    name: 'trx_proposal_id',
                    defaultContent: "-",
                    visible: true
                },
                {
                    data: 'sk_pengesahan_pendirian_no',
                    name: 'sk_pengesahan_pendirian_no',
                    defaultContent: "-",
                    visible: true
                },
                {
                    data: 'trx_proposal_uid',
                    name: 'trx_proposal_uid',
                    defaultContent: "-",
                    visible: false
                },
                {
                    data: 'tanggal_pengajuan',
                    name: 'tanggal_pengajuan',
                    defaultContent: "-",
                    visible: false
                },
                {
                    data: 'trx_pemohon_id',
                    name: 'trx_pemohon_id',
                    defaultContent: "-",
                    visible: false
                },
                @if(!isRoleUser('pemohon')) {
                    data: 'pemohon_nm',
                    name: 'pemohon_nm',
                    visible: true
                },
                @else {
                    data: 'pemohon_nm',
                    name: 'pemohon_nm',
                    visible: false
                },
                @endif {
                    data: 'trx_mitra_kemaslahatan_id',
                    name: 'trx_mitra_kemaslahatan_id',
                    defaultContent: "-",
                    visible: false
                },
                {
                    data: 'mitra_kemaslahatan_nm',
                    name: 'mitra_kemaslahatan_nm',
                    visible: true
                },
                {
                    data: 'judul_proposal',
                    name: 'judul_proposal',
                    visible: true
                },
                {
                    data: 'nominal',
                    name: 'nominal',
                    visible: true,
                    render: $.fn.dataTable.render.number('.', ',', 2, 'Rp ')
                },
                {
                    data: 'ruang_lingkup',
                    name: 'ruang_lingkup',
                    defaultContent: "-",
                    visible: false
                },
                {
                    data: 'ruang_lingkup_nm',
                    name: 'ruang_lingkup_nm',
                    visible: true
                },
                {
                    data: 'proses_st_nm',
                    name: 'proses_st_nm',
                    visible: true
                },
                {
                    data: 'order_column',
                    name: 'order_column',
                    visible: false
                },
                {
                    data: 'actions',
                    name: 'actions',
                    visible: true
                }
            ],
        });

        tabelPencairan = $('#tabel-pencairan').DataTable({
            language: {
                paginate: {
                    'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;',
                    'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'
                }
            },
            pagingType: "simple",
            processing: true,
            serverSide: true,
            order: [
                [12, 'desc']
            ],
            ajax: {
                url: baseUrl + '/program/pencairanperikatan/data',
                type: "POST",
                data: function(data) {
                    data._token = $('meta[name="csrf-token"]').attr('content');
                    data.type = 'pencairan';
                },
            },
            dom: 'tpi',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    visible: true,
                    orderable: false
                },
                {
                    data: 'trx_proposal_id',
                    name: 'trx_proposal_id',
                    defaultContent: "-",
                    visible: true
                },
                {
                    data: 'sk_pengesahan_pendirian_no',
                    name: 'sk_pengesahan_pendirian_no',
                    defaultContent: "-",
                    visible: true
                },
                {
                    data: 'trx_proposal_uid',
                    name: 'trx_proposal_uid',
                    defaultContent: "-",
                    visible: false
                },
                {
                    data: 'tanggal_pengajuan',
                    name: 'tanggal_pengajuan',
                    defaultContent: "-",
                    visible: false
                },
                {
                    data: 'trx_pemohon_id',
                    name: 'trx_pemohon_id',
                    defaultContent: "-",
                    visible: false
                },
                @if(!isRoleUser('pemohon')) {
                    data: 'pemohon_nm',
                    name: 'pemohon_nm',
                    visible: true
                },
                @else {
                    data: 'pemohon_nm',
                    name: 'pemohon_nm',
                    visible: false
                },
                @endif {
                    data: 'trx_mitra_kemaslahatan_id',
                    name: 'trx_mitra_kemaslahatan_id',
                    defaultContent: "-",
                    visible: false
                },
                {
                    data: 'mitra_kemaslahatan_nm',
                    name: 'mitra_kemaslahatan_nm',
                    visible: true
                },
                {
                    data: 'judul_proposal',
                    name: 'judul_proposal',
                    visible: true
                },
                {
                    data: 'nominal',
                    name: 'nominal',
                    visible: true,
                    render: $.fn.dataTable.render.number('.', ',', 2, 'Rp ')
                },
                {
                    data: 'ruang_lingkup',
                    name: 'ruang_lingkup',
                    defaultContent: "-",
                    visible: false
                },
                {
                    data: 'ruang_lingkup_nm',
                    name: 'ruang_lingkup_nm',
                    visible: true
                },
                {
                    data: 'proses_st_nm',
                    name: 'proses_st_nm',
                    visible: true
                },
                {
                    data: 'order_column',
                    name: 'order_column',
                    visible: false
                },
                {
                    data: 'actions',
                    name: 'actions',
                    visible: true
                }
            ],
        });

        $('body').on('click', '#disposisi-program', function() {
            var status = $(this).attr('data-status')
            var id = $(this).attr('data-id')
            swal({
                title: "Disposisi Pogram Ke Perikatan dan Pencairan ?",
                input: 'textarea',
                type: "question",
                showCancelButton: true,
                confirmButtonColor: "#00a65a",
                confirmButtonText: "OK",
                cancelButtonText: "NO",
                allowOutsideClick: false,
            }).then(function(result) {
                console.log(result.value)
                if (result.value) {
                    swal({
                        allowOutsideClick: false,
                        title: "Proses Disposisi",
                        onOpen: () => {
                            swal.showLoading();
                        }
                    });
                    $.ajax({
                        url: '/proposal/program/disposisi/' + id,
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'proses': status,
                            'notes': result.value
                        },
                        success: function(response) {
                            if (response.status == 'ok') {
                                swal({
                                    title: "Proses Rekomendasi Berhasil",
                                    type: "success",
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(() => {
                                    location.href = '/proposal/program/task-program';
                                });
                            } else {
                                swal({
                                    title: "Proses gagal",
                                    type: "error",
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            swal({
                                title: "Terjadi kesalahan sistem !",
                                text: "Silakan hubungi Administrator",
                                type: "error",
                                showCancelButton: false,
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                    })
                } else {
                    swal.close();
                }
            })
        })
    })
</script>
@endpush