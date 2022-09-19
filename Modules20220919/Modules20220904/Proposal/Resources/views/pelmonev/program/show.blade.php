@extends('layouts.app')
@section('content')
<div id="accordion-default">
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">
                <a data-toggle="collapse" class="text-default" href="#accordion-detail">{{ $title . ' ' . $proposal->judul_proposal }} </a>
            </h6>
        </div>
        <div class="card-body">
            <h3>Summary Proposal</h3><br>
            <div class="row mb-3">
                <div class="col-md-12">
                    <table class="table" width="50%">
                        <tr>
                            <td class="font-weight-bold">Judul Proposal</td>
                            <td>: </td>
                            <td>{{ $proposal ? $proposal->judul_proposal : ''}}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Mitra Kemaslahatan</td>
                            <td>: </td>
                            <td>{{ $mitra != '' ? $mitra->mitra_kemaslahatan_nm : '' }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Nominal</td>
                            <td>: </td>
                            <td>{{ $proposal ? "Rp " . number_format($proposal->nominal,2,',','.') : '' }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Ruang Lingkup </td>
                            <td>: </td>
                            <td>
                                @if($proposal->ruang_lingkup == "RUANG_LINGKUP_1")
                                Reguler - {{ $proposal->code_nm }}
                                @else
                                Tanggap Darurat - {{ $proposal->code_nm }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Alamat (Wilayah)</td>
                            <td>: </td>
                            <td>{{ $proposal ? $proposal->lokasi_nama_gedung . ' ' . getRegionNm($proposal->region_prop) . ' ' . getRegionNm($proposal->region_kab) . ' ' . getRegionNm($proposal->region_kec) : ' '  }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <h3>Informasi RAB</h3><br>
            <div class="row">
                <div class="col-md-12">
                    <table class="table datatable-pagination" id="tabel-rab" width="100%">
                        <thead>
                            <tr>
                                <th width="0%">Kode</th>
                                <th width="0%">No</th>
                                <th width="20%" id="jenis_pengeluaran_table">Jenis Pengeluaran</th>
                                <th width="20%" id="jumlah_unit_table">Jumlah Unit</th>
                                <th width="20%" id="biaya_satuan_table">Biaya Satuan</th>
                                <th width="20%" id="nominal_bantuan_table">Total</th>
                                <th width="20%" id="jumlah_unit_bpkh">Jumlah Rekomendasi</th>
                                <th width="20%" id="biaya_satuan_bpkh">Biaya Satuan BPKH</th>
                                <th width="20%" id="total_bpkh">Biaya Rekomenadsi BPKH</th>
                                <!-- <th width="20%" id="action_2">Aksi</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="card-body">
                <form class="form-validate-jquery" id="form-penilaian-mitra" action="#">
                    @csrf
                    <table class="table datatable-pagination" id="tabel-penilaian mitra" width="100%">
                        <thead>
                            <tr>
                                <th width="20%">JENIS PENILAIAN</th>
                                <th width="20%">STATUS PENILAIAN</th>
                                <th width="20%" colspan="2">SKORING</th>
                                <th width="20%">BOBOT</th>
                                <th width="20%">NILAI AKHIR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="20%" rowspan="3">Manfaat</td>
                                <td width="20%" rowspan="3">Berapa Orang Penerima Manfaat</td>
                                <td width="20%">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if($penilaianMitra)
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_bh" id="pen_mitra_bh_5" value="5" {{ $penilaianMitra->pen_mitra_bh == 5 ? ' checked' : '' }}>
                                        @else
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_bh" id="pen_mitra_bh_5" value="5">
                                        @endif
                                        <label class="custom-control-label" for="pen_mitra_bh_5">1. > 500 orang</label>
                                    </div>
                                </td>
                                <td width="20%">5</td>
                                <td width="20%" rowspan="3">20%</td>
                                <td width="20%" rowspan="3">
                                    <h4 id="pen_mitra_bh_nilai">{{ $penilaianMitra ? $penilaianMitra->pen_mitra_bh * 20 : '' }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if($penilaianMitra)
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_bh" id="pen_mitra_bh_4" value="4" {{ $penilaianMitra->pen_mitra_bh == 4 ? ' checked' : '' }}>
                                        @else
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_bh" id="pen_mitra_bh_4" value="4">
                                        @endif
                                        <label class="custom-control-label" for="pen_mitra_bh_4">2. 100-500 orang</label>
                                    </div>
                                </td>
                                <td width="20%">4</td>
                            </tr>
                            <tr>
                                <td width="20%">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if($penilaianMitra)
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_bh" id="pen_mitra_bh_3" value="3" {{ $penilaianMitra->pen_mitra_bh == 3 ? ' checked' : '' }}>
                                        @else
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_bh" id="pen_mitra_bh_3" value="3">
                                        @endif
                                        <label class="custom-control-label" for="pen_mitra_bh_3">3. < 100 orang</label>
                                    </div>
                                </td>
                                <td width="20%">3</td>
                            </tr>

                            <tr>
                                <td width="20%" rowspan="2">Optimal</td>
                                <td width="20%" rowspan="2">Jumlah pihak yang ikut berkontribusi dalam pembiayaan dan/atau pengelolaan</td>
                                <td width="20%">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if($penilaianMitra)
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_sdm_pen" id="pen_mitra_sdm_pen_5" value="5" {{ $penilaianMitra->pen_mitra_sdm_pen == 5 ? ' checked' : '' }}>
                                        @else
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_sdm_pen" id="pen_mitra_sdm_pen_5" value="5">
                                        @endif
                                        <label class="custom-control-label" for="pen_mitra_sdm_pen_5">1. < 100% dari BPKH</label>
                                    </div>
                                </td>
                                <td width="20%">5</td>
                                <td width="20%" rowspan="2">20%</td>
                                <td width="20%" rowspan="2">
                                    <h4 id="pen_mitra_sdm_pen_nilai">{{ $penilaianMitra ? $penilaianMitra->pen_mitra_sdm_pen * 20 : '' }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if($penilaianMitra)
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_sdm_pen" id="pen_mitra_sdm_pen_3" value="3" {{ $penilaianMitra->pen_mitra_sdm_pen == 3 ? ' checked' : '' }}>
                                        @else
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_sdm_pen" id="pen_mitra_sdm_pen_3" value="3">
                                        @endif
                                        <label class="custom-control-label" for="pen_mitra_sdm_pen_3">2. 100% dari BPKH</label>
                                    </div>
                                </td>
                                <td width="20%">3</td>
                            </tr>

                            <tr>
                                <td width="20%" rowspan="3">Kehati-hatian</td>
                                <td width="20%" rowspan="3">Akreditasi/Rekomendasi/Sertifikasi/ Penghargaan lainnya kepada Mitra/Penerima Manfaat dari Kementrian/ Lembaga lainnya</td>
                                <td width="20%">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if($penilaianMitra)
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_ruang_lingkup" id="pen_mitra_ruang_lingkup_5" value="5" {{ $penilaianMitra->pen_mitra_ruang_lingkup == 5 ? ' checked' : '' }}>
                                        @else
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_ruang_lingkup" id="pen_mitra_ruang_lingkup_5" value="5">
                                        @endif
                                        <label class="custom-control-label" for="pen_mitra_ruang_lingkup_5">1. > 5 Jumlah Penghargaan</label>
                                    </div>
                                </td>
                                <td width="20%">5</td>
                                <td width="20%" rowspan="3">20%</td>
                                <td width="20%" rowspan="3">
                                    <h4 id="pen_mitra_ruang_lingkup_nilai">{{ $penilaianMitra ? $penilaianMitra->pen_mitra_ruang_lingkup * 20 : '' }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if($penilaianMitra)
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_ruang_lingkup" id="pen_mitra_ruang_lingkup_3" value="3" {{ $penilaianMitra->pen_mitra_ruang_lingkup == 3 ? ' checked' : '' }}>
                                        @else
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_ruang_lingkup" id="pen_mitra_ruang_lingkup_3" value="3">
                                        @endif
                                        <label class="custom-control-label" for="pen_mitra_ruang_lingkup_3">2. <= 5 Jumlah Penghargaan</label>
                                    </div>
                                </td>
                                <td width="20%">3</td>
                            </tr>
                            <tr>
                                <td width="20%">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if($penilaianMitra)
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_ruang_lingkup" id="pen_mitra_ruang_lingkup_2" value="2" {{ $penilaianMitra->pen_mitra_ruang_lingkup == 2 ? ' checked' : '' }}>
                                        @else
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_ruang_lingkup" id="pen_mitra_ruang_lingkup_2" value="2">
                                        @endif
                                        <label class="custom-control-label" for="pen_mitra_ruang_lingkup_2">3. Belum Ada/Tidak Ada Penghargaan</label>
                                    </div>
                                </td>
                                <td width="20%">2</td>
                            </tr>

                            <tr>
                                <td width="20%" rowspan="2">Efisien</td>
                                <td width="20%" rowspan="2">Jumlah nilai biaya RAB Kegiatan dibandingkan terhadap manfaat (Rasio Biaya/Manfaat)</td>
                                <td width="20%">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if($penilaianMitra)
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_dk" id="pen_mitra_dk_5" value="5" {{ $penilaianMitra->pen_mitra_dk == 5 ? ' checked' : '' }}>
                                        @else
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_dk" id="pen_mitra_dk_5" value="5">
                                        @endif
                                        <label class="custom-control-label" for="pen_mitra_dk_5">1. Biaya operasional bantuan program tidak melebihi 10% dari total anggaran yang disetujui</label>
                                    </div>
                                </td>
                                <td width="20%">5</td>
                                <td width="20%" rowspan="2">20%</td>
                                <td width="20%" rowspan="2">
                                    <h4 id="pen_mitra_dk_nilai">{{ $penilaianMitra ? $penilaianMitra->pen_mitra_dk * 20 : '' }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if($penilaianMitra)
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_dk" id="pen_mitra_dk_3" value="3" {{ $penilaianMitra->pen_mitra_dk == 3 ? ' checked' : '' }}>
                                        @else
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_dk" id="pen_mitra_dk_3" value="3">
                                        @endif
                                        <label class="custom-control-label" for="pen_mitra_dk_3">2. Biaya operasional bantuan program melebihi 10% dari total anggaran yang disetujui</label>
                                    </div>
                                </td>
                                <td width="20%">3</td>
                            </tr>

                            <tr>
                                <td width="20%" rowspan="2">Efektivitas</td>
                                <td width="20%" rowspan="2">Berapa lama umur ekonomis/teknis kegiatan</td>
                                <td width="20%">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if($penilaianMitra)
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_djk" id="pen_mitra_djk_5" value="5" {{ $penilaianMitra->pen_mitra_djk == 5 ? ' checked' : '' }}>
                                        @else
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_djk" id="pen_mitra_djk_5" value="5">
                                        @endif
                                        <label class="custom-control-label" for="pen_mitra_djk_5">1. > 3 tahun</label>
                                    </div>
                                </td>
                                <td width="20%">5</td>
                                <td width="20%" rowspan="2">20%</td>
                                <td width="20%" rowspan="2">
                                    <h4 id="pen_mitra_djk_nilai">{{ $penilaianMitra ? $penilaianMitra->pen_mitra_djk * 20 : '' }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        @if($penilaianMitra)
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_djk" id="pen_mitra_djk_4" value="4" {{ $penilaianMitra->pen_mitra_djk == 4 ? ' checked' : '' }}>
                                        @else
                                        <input type="radio" class="custom-control-input pen-mitra" data-bobot="20" name="pen_mitra_djk" id="pen_mitra_djk_4" value="4">

                                        @endif
                                        <label class="custom-control-label" for="pen_mitra_djk_4">2. <= 3 tahun</label>
                                    </div>
                                </td>
                                <td width="20%">4</td>
                            </tr>
                            @php
                            if($penilaianMitra){
                            $rata_rata = ($penilaianMitra->pen_mitra_bh * 20) + ($penilaianMitra->pen_mitra_sdm_pen * 20) + ($penilaianMitra->pen_mitra_ruang_lingkup * 20) + ($penilaianMitra->pen_mitra_dk*20) + ($penilaianMitra->pen_mitra_djk * 20);
                            }else{
                            $rata_rata = 0;
                            }
                            @endphp
                            <tr>
                                <td width="20%" rowspan="2">Rata - Rata</td>
                                <td width="20%" rowspan="2"></td>
                                <td width="20%"></td>
                                <td width="20%"></td>
                                <td width="20%" rowspan="2"></td>
                                <td width="20%" rowspan="2">
                                    <h4>{{ ($rata_rata / 5)}}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%"></td>
                                <td width="20%"></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        @if($proposalmitra->proses_st == 'PROSES_TERIMA' || $proposal->proses_st == 'PROSES_TERIMA')
        <button id="disposisi-program" data-id="{{ $proposalmitra->trx_proposal_child_id }}" data-status="{{ $proposalmitra->proses_st }}" class="btn btn-sm btn-primary mx-1 px-2">Disposisi</button>
        @endif
        <button id="print-ringkasan" class="btn btn-sm btn-primary mx-1 px-2">Print Ringkasan Proposal</button>
        <button id="print-sk" class="btn btn-sm btn-primary mx-1 px-2">Print SK Kemaslahatan</button>
    </div>
</div>
@endsection
@push('scripts')
<script>
    var tabelFiles;
    var tabelPengurus;
    var tabelRAB;
    var tabelPenilaian;
    var groupColumn = 6;
    var hasilYa = 0;
    var hasilTidak = 0;

    var saveMethod = 'ubah';
    var baseUrl = '{{ url("proposal-layak-teknis") }}';
    var baseUrlProposal = '{{ url("proposal") }}';
    var baseUrlProposalAssesment = '{{ url("proposal-hasil-assesmen") }}';
    var dataCd = '{{ $proposalmitra ? $proposalmitra->trx_proposal_child_id : "" }}';
    $(document).ready(function() {

        tabelKerjasama = $('#tabel-kerjasama').DataTable({
            language: {
                paginate: {
                    'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;',
                    'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'
                }
            },
            pagingType: "simple",
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: baseUrl + '/kerjasama/data',
                type: "POST",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id': '{{ $proposal->trx_proposal_mitra_id }}'
                },
            },
            dom: 'tpi',
            columns: [{
                    data: 'trx_proposal_lembaga_kerjasama_id',
                    name: 'trx_proposal_lembaga_kerjasama_id',
                    visible: false
                },
                {
                    data: 'lembaga_nm',
                    name: 'lembaga_nm'
                },
                {
                    data: 'kegiatan_nm',
                    name: 'kegiatan_nm'
                },
                {
                    data: 'nominal_bantuan',
                    name: 'nominal_bantuan',
                    render: $.fn.dataTable.render.number('.', ',', 2, 'Rp ')
                },
            ],
        });

        tabelRAB = $('#tabel-rab').DataTable({
            language: {
                paginate: {
                    'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;',
                    'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'
                }
            },
            pagingType: "simple",
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: baseUrl + '/rab/data',
                type: "POST",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id': '{{ $proposalmitra->trx_proposal_child_id }}'
                },
            },
            dom: 'tpi',
            columns: [{
                    data: 'trx_proposal_rab_id',
                    name: 'trx_proposal_rab_id',
                    visible: false
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    visible: true,
                    orderable: false
                },
                {
                    data: 'jenis_pengeluaran',
                    name: 'jenis_pengeluaran'
                },
                {
                    data: 'jumlah_unit',
                    name: 'jumlah_unit'
                },
                {
                    data: 'biaya_satuan',
                    name: 'biaya_satuan_mitra',
                    render: $.fn.dataTable.render.number('.', ',', 2, 'Rp ')
                },
                {
                    data: 'total',
                    name: 'total',
                    render: $.fn.dataTable.render.number('.', ',', 2, 'Rp ')
                },
                {
                    data: 'total_bpkh',
                    name: 'total_bpkh'
                },
                {
                    data: 'biaya_satuan_bpkh',
                    name: 'biaya_satuan_bpkh'
                },
                // { data: 'action_2', name: 'action_2' },
            ],
        });

        $('input[name=nominal]').val("{{ (int)$proposal->nominal }}").trigger('input');
        $('select[name=ruang_lingkup]').val("{{ $proposal->ruang_lingkup }}").trigger('change');
        $('input[name=deskripsi_nominal]').val("{{ (int)$proposal->deskripsi_nominal }}").trigger('input');
        $('select[name=deskripsi_spesifikasi_kegiatan]').val("{{ $proposal->deskripsi_spesifikasi_kegiatan }}").trigger('change');
    });

    $(document).on('click', '#print-ringkasan', function() {
        window.open(baseUrlProposal + '/ringkasan/' + dataCd, '_blank');
    });

    $(document).on('click', '#print-sk', function() {
        window.open(baseUrl + '/print/sk/' + dataCd, '_blank');
    });

    $('body').on('click', '#disposisi-program', function() {
        var status = $(this).attr('data-status')
        var id = $(this).attr('data-id')
        swal({
            title: "Disposisi Pogram Ke Perikatan dan Pencairan ?",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: "#00a65a",
            confirmButtonText: "OK",
            cancelButtonText: "NO",
            allowOutsideClick: false,
        }).then(function(result) {
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
</script>
@endpush