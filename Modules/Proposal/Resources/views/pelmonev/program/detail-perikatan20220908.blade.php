@extends('layouts.app')
@section('content')
<div id="accordion-default">
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">
                <a data-toggle="collapse" class="text-default" href="#accordion-detail">{{ $title . ' ' . $proposal->judul_proposal }} </a>
            </h6>
        </div>
        <div id="accordion-detail" class="collapse show" data-parent="#accordion-default">
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
                                @php
                                $total = \App\Models\PublicTrxProposalRAB::select(DB::raw('sum(total_bpkh) as nominal_rekomendasi'))->where('trx_proposal_id', $proposalmitra->trx_proposal_child_id)->first();
                                @endphp
                                <td class="font-weight-bold">Nominal</td>
                                <td>: </td>
                                <td>
                                    {{ $total != '' ? "Rp " . number_format($total->nominal_rekomendasi,2,',','.') : 0 }}
                                    <input type="hidden" class="nominal-rekomendasi" value="{{ $total->nominal_rekomendasi }}" />
                                </td>
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
                <!-- <h3>Informasi RAB</h3><br>
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
                                    
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div> -->
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
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">
                <a class="collapsed text-default" data-toggle="collapse" href="#klaisifikasi-program"> PKS</a>
            </h6>
        </div>

        <div id="klaisifikasi-program" class="collapse" data-parent="#accordion-default">
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-penprog-deskripsi">
                        <form class="form-validate-jquery" method="post" id="form-pks" action='{{ route("save.pks") }}' enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="trx_proposal_mitra_id" id="trx_proposal_mitra_id_klasifikasi" value="{{ $proposalmitra ? $proposalmitra->trx_proposal_child_id : '' }}">
                            <input type="hidden" name="trx_pks_id" id="trx_pks_id" value="{{ $trxpks ? $trxpks->trx_pks_id : '' }}">
                            <!-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Judul Kegiatan(Proposal) <span class="text-danger">*</span></label>
                                        <input type="text" name="judul_proposal" class="form-control" value="{{ $proposalmitra ? $proposalmitra->judul_proposal : '' }}">
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Tanggal Kegiatan<span class="text-danger">*</span></label>
                                        <input type="text" name="tanggal_kegiatan" class="form-control" value="{{ $proposalmitra ? $proposalmitra->created_at : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Tanggal<span class="text-danger">*</span></label>
                                        <input type="text" name="tanggal" class="form-control" value="{{ $trxpks ? $trxpks->tanggal : '' }}">
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <!-- <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nomor PKS(BPKH)<span class="text-danger">*</span></label>
                                        <input type="text" name="nomor_pks" class="form-control" value="{{ $trxpks ? $trxpks->no_pks_bpkh : '' }}">
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nomor PKS Mitra<span class="text-danger">*</span></label>
                                        <input type="text" name="nomor_pks_mitra" class="form-control" value="{{ $trxpks ? $trxpks->no_pks_mitra : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">SK Pendirian Mitra Kemaslahatan<span class="text-danger">*</span></label>
                                        <input type="text" name="sk_pendirian_mitra" class="form-control" value="{{ $trxpks ? $trxpks->sk_pendirian_mitra : '' }}" required>
                                    </div>
                                </div>
                            </div>
                            @php
                            $masterbpkh = DB::select('SELECT * FROM trx_bpkh_master LIMIT 1');
                            @endphp
                            <!-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Alamat BPKH<span class="text-danger">*</span></label>
                                        <textarea name="alamat_bpkh" class="form-control" aria-valuemax="{{ $trxpks ? $trxpks->alamat_bpkh : $masterbpkh[0]->alamat_bpkh }}">{{ $trxpks ? $trxpks->no_pks_bpkh : 'Menara Bidakara 1, lantai 5 dan 8, Jl. Gatot Subroto, RT.1/RW.1, Menteng Dalam, Kec. Pancoran, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12870' }}</textarea>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Kepala BPKH<span class="text-danger">*</span></label>
                                        <input type="text" name="kepala_bpkh" class="form-control" value="{{ $trxpks ? $trxpks->kepala_bpk : $masterbpkh[0]->kepala_bpkh }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">SK Pengangkatan Kepala BPKH<span class="text-danger">*</span></label>
                                        <input type="text" name="sk_peng_kep_bpkh" class="form-control" value="{{ $trxpks ? $trxpks->sk_pengangkatan_kep_bpkh : $masterbpkh[0]->sk_pengangkatan_kep_bpkh }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Alamat Mitra Kemaslahatan<span class="text-danger">*</span></label>
                                        <textarea name="alamat_mitra" class="form-control" value="{{ $trxpks ? $trxpks->alamat_mitra : '' }}">{{ $trxpks ? $trxpks->alamat_mitra : $mitra->address }}</textarea>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                @php
                                $total = \App\Models\PublicTrxProposalRAB::select(DB::raw('sum(total_bpkh) as nominal_rekomendasi'))->where('trx_proposal_id', $proposalmitra->trx_proposal_child_id)->first();
                                @endphp
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Dana Kegiatan Kemaslahatan<span class="text-danger">*</span></label>
                                        <input type="text" name="dana_kegiatan" class="form-control" value="{{ number_format($total->nominal_rekomendasi,2,',','.')}}">
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Nomor SK BPKH<span class="text-danger">*</span></label>
                                        <input type="text" name="nomor_sk_bpkh" class="form-control" value="{{ $trxpks ? $trxpks->nomor_sk_bpkh : '' }}">
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                @if($trxpks)
                                @php
                                $termin = DB::select("SELECT termin FROM trx_pelmonev_pks WHERE trx_proposal_id='" . request()->id . "'");
                                $totalterm = count(json_decode($trxpks->termin));
                                $valTerm = json_decode($trxpks->termin);
                                @endphp
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Termin Pencairan<span class="text-danger">*</span></label>
                                        <select name="termin" class="form-control termin" required>
                                            <option value="">Pilih</option>
                                            <option value="sekaligus" {{ $totalterm == 1 ? ' selected' : ''}}>Sekaligus</option>
                                            <option value="2_termin" {{ $totalterm == 2 ? ' selected' : ''}}>2 Termin</option>
                                            <option value="3_termin" {{ $totalterm == 3 ? ' selected' : ''}}>3 Termin</option>
                                        </select>
                                    </div>
                                </div>
                                @if($totalterm == 1)
                                <div class="col-md-6 termin-sekaligus">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Termin Sekaligus<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="termin_1[]" placeholder="mohon isi termin" value="{{ $valTerm[0] }}">
                                    </div>
                                </div>
                                <div class="col-md-6 termin-3" style="display: none;">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">3 Termin<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="termin_3[]" placeholder="mohon isi termin 1">
                                        <input type="text" class="form-control" name="termin_3[]" placeholder="mohon isi termin 2">
                                        <input type="text" class="form-control" name="termin_3[]" placeholder="mohon isi termin 3">
                                    </div>
                                </div>
                                <div class="col-md-3 termin-2" style="display: none;">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">2 Termin<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="termin-1" placeholder="mohon isi termin 1">
                                        <input type="text" class="form-control" id="termin-2" placeholder="mohon isi termin 2">
                                    </div>
                                </div>
                                <div class="col-md-3 termin-2" style="display: none;">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">2 Termin<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control money" id="termin-value-1" name="termin_2[]" placeholder="mohon isi termin 1">
                                        <input type="text" class="form-control money" id="termin-value-2" name="termin_2[]" placeholder="mohon isi termin 2">
                                    </div>
                                </div>
                                @elseif($totalterm == 2)
                                <div class="col-md-3 termin-2">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">2 Termin<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="termin-1" placeholder="mohon isi termin 1" name="termin_2[]" value="{{ $valTerm[0] }}">
                                        <input type="text" class="form-control" id="termin-2" placeholder="mohon isi termin 2" name="termin_2[]" value="{{ $valTerm[1] }}">
                                    </div>
                                </div>
                                <div class="col-md-6 termin-sekaligus" style="display: none;">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Termin Sekaligus<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="termin_1[]" placeholder="mohon isi termin">
                                    </div>
                                </div>
                                <div class="col-md-6 termin-3" style="display: none;">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">3 Termin<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="termin_3[]" placeholder="mohon isi termin 1">
                                        <input type="text" class="form-control" name="termin_3[]" placeholder="mohon isi termin 2">
                                        <input type="text" class="form-control" name="termin_3[]" placeholder="mohon isi termin 3">
                                    </div>
                                </div>
                                @elseif($totalterm == 3)
                                <div class="col-md-3 termin-2" style="display: none;">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">2 Termin<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="termin-1" placeholder="mohon isi termin 1">
                                        <input type="text" class="form-control" id="termin-2" placeholder="mohon isi termin 2">
                                    </div>
                                </div>
                                <div class="col-md-3 termin-2" style="display: none;">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">2 Termin<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control money" id="termin-value-1" name="termin_2[]" placeholder="mohon isi termin 1">
                                        <input type="text" class="form-control money" id="termin-value-2" name="termin_2[]" placeholder="mohon isi termin 2">
                                    </div>
                                </div>
                                <div class="col-md-6 termin-sekaligus" style="display: none;">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Termin Sekaligus<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="termin_1[]" placeholder="mohon isi termin">
                                    </div>
                                </div>
                                <div class="col-md-6 termin-3">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">3 Termin<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="termin_3[]" placeholder="mohon isi termin 1" value="{{ $valTerm[0] }}">
                                        <input type="text" class="form-control" name="termin_3[]" placeholder="mohon isi termin 2" value="{{ $valTerm[1] }}">
                                        <input type="text" class="form-control" name="termin_3[]" placeholder="mohon isi termin 3" value="{{ $valTerm[2] }}">
                                        <input type="text" class="form-control" name="termin_1[]" placeholder="mohon isi termin" style="display: none;">
                                        <input type="text" class="form-control" name="termin_2[]" placeholder="mohon isi termin" style="display: none;">
                                    </div>
                                </div>
                                @endif
                                @else
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Termin Pencairan<span class="text-danger">*</span></label>
                                        <select name="termin" class="form-control termin" required>
                                            <option value="">Pilih</option>
                                            <option value="sekaligus">Sekaligus</option>
                                            <option value="2_termin">2 Termin</option>
                                            <option value="3_termin">3 Termin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 termin-sekaligus" style="display: none;">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Termin Sekaligus<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="termin_1[]" placeholder="mohon isi termin">
                                    </div>
                                </div>
                                <div class="col-md-3 termin-2" style="display: none;">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">2 Termin<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="termin-1" placeholder="mohon isi termin 1">
                                        <input type="text" class="form-control" id="termin-2" placeholder="mohon isi termin 2">
                                    </div>
                                </div>
                                <div class="col-md-6 termin-3" style="display: none;">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">3 Termin<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="termin_3[]" placeholder="mohon isi termin 1">
                                        <input type="text" class="form-control" name="termin_3[]" placeholder="mohon isi termin 2">
                                        <input type="text" class="form-control" name="termin_3[]" placeholder="mohon isi termin 3">
                                    </div>
                                </div>
                                <div class="col-md-3 termin-2" style="display: none;">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">2 Termin<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control money" id="termin-value-1" name="termin_2[]" placeholder="mohon isi termin 1">
                                        <input type="text" class="form-control money" id="termin-value-2" name="termin_2[]" placeholder="mohon isi termin 2">
                                    </div>
                                </div>
                                
                                @endif
                            </div>
                            <div class="ayat-tambahan">
                                @php
                                $trx_pks_id = $trxpks ? $trxpks->trx_pks_id : null;
                                $pasal = \App\Models\TrxPasalPelmonev::where('trx_pelmonev_pks_id', $trx_pks_id)->get();
                                @endphp
                                @if($pasal->count() > 0)
                                @foreach($pasal as $val)
                                <div class="row">
                                    <input name="trx_pasal_id[]" type="hidden" value="{{ $val->trx_pasal_id }}" />
                                    <div class="col-md-6">
                                        <div class="form-group form-group-float">
                                            <label class="form-group-float-label is-visible">Pasal Tambahan<span class="text-danger">*</span></label>
                                            <select name="pasal[]" class="form-control pasal">
                                                <option value="">Pilih</option>
                                                @for($i = 1; $i < 10; $i++) <option value="pasal_{{$i}}" {{ $val->pasal == 'pasal_' . $i .'' ? ' selected' : '' }}>Pasal {{ $i }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-float">
                                            <label class="form-group-float-label is-visible">Ayat Tambahan<span class="text-danger">*</span></label>
                                            <textarea name="ayat_tambahan[]" class="form-control" placeholder="please insert pasal" value="{{ $val->ayat_tambahan }}">{{ $val->ayat_tambahan }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-float">
                                            <label class="form-group-float-label is-visible">Pasal Tambahan<span class="text-danger">*</span></label>
                                            <select name="pasal[]" class="form-control pasal">
                                                <option value="">Pilih</option>
                                                @for($i = 1; $i < 10; $i++) <option value="pasal_{{$i}}">Pasal {{ $i }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-float">
                                            <label class="form-group-float-label is-visible">Ayat Tambahan<span class="text-danger">*</span></label>
                                            <textarea name="ayat_tambahan[]" class="form-control" placeholder="please insert pasal"></textarea>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-sm tambah-pasal" type="button">tambah form pasal</button>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Timeline Kontrak (Start Date)<span class="text-danger">*</span></label>
                                        <input type="date" name="start_date_timeline" class="form-control" value="{{ $trxpks ? $trxpks->start_date_timeline : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Timeline Kontrak (End Date)<span class="text-danger">*</span></label>
                                        <input type="date" name="end_date_timeline" class="form-control" value="{{ $trxpks ? $trxpks->end_date_timeline : '' }}" required>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Logo Mitra<span class="text-danger">*</span></label>
                                        @if($trxpks)
                                        <img src="data:image/png;base64, {{ base64_encode(file_get_contents(storage_path("app/public/pelmonev/pks/$trxpks->photo_mitra"))) }}" width="50px">
                                        <input type="file" name="photo_mitra" class="form-control" value="{{ $trxpks ? $trxpks->photo_mitra : '' }}">
                                        @else
                                        <input type="file" name="photo_mitra" class="form-control" value="{{ $trxpks ? $trxpks->photo_mitra : '' }}" required>
                                        @endif
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Lampiran RAB<span class="text-danger">*</span></label>
                                        @if($trxpks)
                                        <a href="{{ route('download.lampiran', $trxpks->lampiran_rab) }}">Lihat File</a>
                                        <input type="file" name="lampiran_rab" class="form-control" value="{{ $trxpks ? $trxpks->lampiran_rab : '' }}">
                                        @else
                                        <input type="file" name="lampiran_rab" class="form-control" value="{{ $trxpks ? $trxpks->lampiran_rab : '' }}" required>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Lampiran Lainya<span class="text-danger">*</span></label>
                                        @if($trxpks)
                                        <input type="file" name="lampiran_lainya" class="form-control" value="{{ $trxpks ? $trxpks->lampiran_lainya : '' }}">
                                        <a href="{{ route('download.lampiran', $trxpks->lampiran_lainya) }}">Lihat File</a>
                                        @else
                                        <input type="file" name="lampiran_lainya" class="form-control" value="{{ $trxpks ? $trxpks->lampiran_lainya : '' }}" required>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="lampiran-photo">
                                @php
                                $lampiran_photo = $trxpks ? json_decode($trxpks->lampiran_photo) : [];
                                $truePhoto = $lampiran_photo != null ? $lampiran_photo : [];
                                @endphp
                                @if(count($truePhoto) > 0)
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-group-float">
                                            <label class="form-group-float-label is-visible">Lampiran Photo<span class="text-danger">*</span></label>
                                            @foreach($lampiran_photo as $val)
                                            <input type="file" name="lampiran_photo_rab[]" class="form-control" value="{{ $val }}">
                                            <img src="data:image/png;base64, {{ base64_encode(file_get_contents(storage_path("app/public/pelmonev/pks/$val"))) }}" width="50px">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-group-float">
                                            <label class="form-group-float-label is-visible">Lampiran Photo<span class="text-danger">*</span></label>
                                            <input type="file" name="lampiran_photo_rab[]" class="form-control" value="" required>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-group-float">
                                        <button type="button" class="btn btn-sm btn-primary mx-1 px-2 tambah-lampiran">tambah lampiran</button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ route('print.pks', $proposalmitra->trx_proposal_child_id) }}" target="_blank">
                                    <button type="button" class="btn btn-sm btn-primary mx-1 px-2">Print PKS</button>
                                </a>
                                <button type="button" class="btn btn-sm btn-primary mx-1 px-2 legitRipple" id="simpan-pks">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
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
<!-- /modal upload berkas-->
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
        var nominal_rekomendasi = $('.nominal-rekomendasi').val()
        console.log(nominal_rekomendasi)
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

    $('body').on('click', '#simpan-pks', function(e) {
        if (e.isDefaultPrevented()) {
            //--Handle the invalid form
        } else {
            swal({
                title: 'Simpan data ?',
                type: "question",
                showCancelButton: true,
                confirmButtonColor: "#00a65a",
                confirmButtonText: "OK",
                cancelButtonText: "NO",
                allowOutsideClick: false,
            }).then(function(result) {
                if (result.value) {
                    $('#form-pks').submit()
                }
            })
        }
    })

    $('body').on('change', '.termin', function(e) {
        var term = $(this).val()
        if (term == 'sekaligus') {
            $('.termin-sekaligus').show()
            $('.termin-2').hide()
            $('.termin-3').hide()
        } else if (term == '2_termin') {
            $('.termin-sekaligus').hide()
            $('.termin-2').show()
            $('.termin-3').hide()
        } else if (term == '3_termin') {
            $('.termin-sekaligus').hide()
            $('.termin-2').hide()
            $('.termin-3').show()
        }
    })

    $('body').on('keyup', '#termin-1', function(e) {
        if (parseInt($(this).val()) > 100) {
            alert("Termin tidak boleh lebih dari 100 %")
            $("#termin-1").val(' ')
        } else {
            var nominal = $('.nominal-rekomendasi').val()
            var total = (parseInt(nominal) * parseInt($(this).val())) / 100;
            $("#termin-value-1").val(total)
        }
    })

    $('body').on('keyup', '#termin-2', function(e) {
        var termin1 = 100 - parseInt($("#termin-1").val())
        if (parseInt($(this).val()) > parseInt(termin1)) {
            alert("Termin ke 2 tidak boleh lebih dari termin 1")
            $("#termin-2").val(' ');
        } else {
            var nominal = $('.nominal-rekomendasi').val()
            var total = (parseInt(nominal) * parseInt($(this).val())) / 100;
            $("#termin-value-2").val(total)
        }

    })
    $('body').on('click', '.tambah-lampiran', function(e) {
        var body = '<div class="row">'
        body += '<div class="col-md-4">'
        body += '<div class="form-group form-group-float">'
        body += '<input type="file" name="lampiran_photo_rab[]" class="form-control" value="">'
        body += '</div>'
        body += '</div>'
        body += '</div>'
        $('.lampiran-photo').append(body);
    })

    $('body').on('change', '.pasal', function(e) {
        $('.ayat-tambahan').show()
    })

    $('body').on('click', '.tambah-pasal', function(e) {
        var body = '<div class="row">'
        body += '<div class="col-md-6">'
        body += '<div class="form-group form-group-float">'
        body += '<select name="pasal[]" class="form-control pasal">'
        body += '<option value="">Pilih</option>'
        for (let i = 1; i < 10; i++) {
            body += '<option value="pasal_' + i + '">Pasal ' + i + '</option>'
        }
        body += '</select>'
        body += '</div>'
        body += '</div>'
        body += '<div class="col-md-6">'
        body += '<div class="form-group form-group-float">'
        body += '<textarea name="ayat_tambahan[]" class="form-control" placeholder="please insert ayat tambahan"></textarea>'
        body += '</div>'
        body += '</div>'
        body += '</div>'
        $('.ayat-tambahan').append(body);
    })
</script>
@endpush