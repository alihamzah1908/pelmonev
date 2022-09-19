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
                           @if($i == date('Y'))
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
                    <!--Frame Tabel-->
                    <div id="frame-tabel">
                        <div class="table-responsive">
                            <table class="table datatable-pagination" id="tabel-data">
                                <thead>
                                <tr>
                                    <th class="tg-amwm" rowspan="2">NO</th>
                                    <th class="tg-amwm" rowspan="2">KODE MS</th>
                                    <th class="tg-amwm" rowspan="2">TOTAL PROPOSAL</th>
                                    <th class="tg-amwm" colspan="16">STATUS PROPOSAL</th>
                                </tr>
                                <tr>
                                    <th title="Proposal dari Penerima Manfaat" class="tg-amwm">1</th>
                                    <th title="Penugasan Mitra" class="tg-amwm">2</th>
                                    <th title="Assesment dari Mitra" class="tg-amwm">3</th>
                                    <th title="Analisa Kemaslahatan" class="tg-amwm">4</th>
                                    <th title="Analisa Non-Kemaslahatan" class="tg-amwm">5</th>
                                    <th title="Notulen Rapat BP" class="tg-amwm">6</th>
                                    <th title="Surat Persetujuan BP" class="tg-amwm">7</th>
                                    <th title="PKS" class="tg-amwm">8</th>
                                    <th title="SPTJM" class="tg-amwm">9</th>
                                    <th title="Pindah Buku" class="tg-amwm">10</th>
                                    <th title="Pencairan Termin I" class="tg-amwm">11</th>
                                    <th title="Pencarian Termin II" class="tg-amwm">12</th>
                                    <th title="Pencairan Termin III" class="tg-amwm">13</th>
                                    <th title="Laporan Progres Pekerjaan" class="tg-amwm">14</th>
                                    <th title="Laporan Pertanggungjawaban" class="tg-amwm">15</th>
                                    <th title="SK Laporan Pertanggungjawaban" class="tg-amwm">16</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="tg-0lax">1</td>
                                    <td class="tg-0lax">AA</td>
                                    <td class="tg-0lax">10</td>
                                    <td class="tg-0lax"><a href="#" class='data-link' data-toggle="modal" data-target="#exampleModal">1</a></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"><a href="#" class='data-link' data-toggle="modal" data-target="#exampleModal">5</a></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"><a href="#" class='data-link' data-toggle="modal" data-target="#exampleModal">1</a></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"><a href="#" class='data-link' data-toggle="modal" data-target="#exampleModal">3</a></td>
                                    <td class="tg-0lax"></td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">2</td>
                                    <td class="tg-0lax">BB</td>
                                    <td class="tg-0lax">13</td>
                                    <td class="tg-0lax"><a href="#" class='data-link' data-toggle="modal" data-target="#exampleModal">1</a></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"><a href="#" class='data-link' data-toggle="modal" data-target="#exampleModal">3</a></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"><a href="#" class='data-link' data-toggle="modal" data-target="#exampleModal">7</a></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"><a href="#" class='data-link' data-toggle="modal" data-target="#exampleModal">3</a></td>
                                    <td class="tg-0lax"></td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">3</td>
                                    <td class="tg-0lax">CC</td>
                                    <td class="tg-0lax">15</td>
                                    <td class="tg-0lax"><a href="#" class='data-link' data-toggle="modal" data-target="#exampleModal">1</a></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"><a href="#" class='data-link' data-toggle="modal" data-target="#exampleModal">7</a></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"><a href="#" class='data-link' data-toggle="modal" data-target="#exampleModal">2</a></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"><a href="#" class='data-link' data-toggle="modal" data-target="#exampleModal">8</a></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"><a href="#" class='data-link' data-toggle="modal" data-target="#exampleModal">2</a></td>
                                    <td class="tg-0lax"></td>
                                    <td class="tg-0lax"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-3">
                        <h5>Status Proposal:</h5>
                        <div class="row">
                            <div class="col-md-3">
                                1). Proposal dari Penerima Manfaat
                            </div>
                            <div class="col-md-3">
                                2). Penugasan Mitra
                            </div>
                            <div class="col-md-3">
                                3). Proposal dari Penerima Manfaat
                            </div>
                            <div class="col-md-3">
                                4). Proposal dari Penerima Manfaat
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                5). Analisa Non-Kemaslahatan
                            </div>
                            <div class="col-md-3">
                                6). Notulen Rapat BP
                            </div>
                            <div class="col-md-3">
                                7). Surat Persetujuan BP
                            </div>
                            <div class="col-md-3">
                                8). PKS
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                9). SPTJM
                            </div>
                            <div class="col-md-3">
                                10). Pindah Buku
                            </div>
                            <div class="col-md-3">
                                11). Pencairan Termin I
                            </div>
                            <div class="col-md-3">
                                12). Pencairan Termin II
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                13). Pencairan Termin III
                            </div>
                            <div class="col-md-3">
                                14). Laporan Progres Pekerjaan
                            </div>
                            <div class="col-md-3">
                                15). Laporan Pertanggungjawaban
                            </div>
                            <div class="col-md-3">
                                16). SK Laporan Pertanggungjawaban
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   
    

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Proposal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row" id='table-proposal'>
                    <div class="col-xl-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                       
                        <div class="header-elements">
                            <div class="list-icons">
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--Frame Tabel-->
                        <div id="frame-tabel">
                            {{-- <button type="button" class="btn btn-primary legitRipple" id="tambah"><i class="icon-add mr-2"></i> Tambah</button> --}}
                            {{-- <button type="button" class="btn btn-info legitRipple" id="detail"><i class="icon-enlarge mr-2"></i> Detail Proposal</button> --}}
                            {{-- <button type="button" class="btn btn-danger legitRipple" id="hapus"><i class="icon-trash mr-2"></i> Hapus</button> --}}
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Judul Proposal <span class="text-danger">*</span></label>
                                        <input name="search_param" id="search_param" placeholder="Pencarian Judul" class="form-control param" data-fouc />
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group form-group-float">
                                        <label class="form-group-float-label is-visible">Status Proposal <span class="text-danger">*</span></label>
                                        <select name="proses_st_param" id="proses_st_param" data-placeholder="Pilih Data" class="form-control form-control-select2 param" required data-fouc>
                                            <option value="SEMUA">==Tampilkan Semua ==</option>
                                            {!! listStatus() !!}
                                        </select>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="table-responsive">
                                <table class="table datatable-pagination" id="tabel-data" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="0%">No</th>
                                          
                                           
                                            <th width="0%" id="trx_pemohon_id_table">Pemohon</th>
                                           
                                            <th width="0%" id="trx_mitra_kemaslahatan_id_table">Mitra Kemaslahatan</th>
                                          
                                            <th width="30%" id="judul_proposal_table">Judul Proposal</th>
                                            <th width="10%" id="nominal_table">Nominal</th>
                                            
                                            <th width="10%" id="ruang_lingkup_nm_table">Ruang Lingkup</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>PP Lembaga Pendidikan Tinggi Nahdlatul Ulama</td>
                                            <td>LAZISMU</td>
                                            <td>Testing Proposal 31 Januari 2022 versi 2</td>
                                            <td>Rp 150.000.000,00</td>
                                            <td>Ekonomi Umat</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>PP Lembaga Pendidikan Tinggi Nahdlatul Ulama</td>
                                            <td>LAZISMU</td>
                                            <td>proposal pengajuan dana untuk pembuatan musholah</td>
                                            <td>Rp 150.000.000,00</td>
                                            <td>Ekonomi Umat</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>PP Lembaga Pendidikan Tinggi Nahdlatul Ulama</td>
                                            <td>LAZISMU</td>
                                            <td>Testing Proposal 31 Januari 2022 versi 2</td>
                                            <td>Rp 150.000.000,00</td>
                                            <td>Ekonomi Umat</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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

            
            $('#region_prop_param').select2({
                placeholder : "Pilih Propinsi",
                ajax : {
                    url :  "{{ url('daftar-daerah/provinsi/') }}",
                    dataType: 'json',
                    processResults: function(data){
                        return {
                            results: data
                        };
                    },
                },
            });

            tabelData = $('#tabel-data').DataTable();
        })
    </script>
@endpush
