@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card" style="zoom: 1;">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">{{ $title }}</h5>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <form>
                            <div class="row">
                                <div class="col">
                                    <select onchange="onChangeYear(this)" class="form-control" id="exampleFormControlSelect1">
                                    @for ($i = 2010; $i <= date('Y'); $i++)
                                        @if($i == $yearFilter)
                                            <option selected value="{{$i}}">{{ $i }}</option>
                                        @else
                                            <option value="{{$i}}">{{ $i }}</option>
                                        @endif

                                    @endfor
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div class="mt-3">
                            <button type="button" onclick="onBtnTodayClicked(this)" class="btn btn-primary btn-lg btn-block">TODAY</button>
                        </div>
                    </div>
                    <div class="col-md-10">

                        <!--Frame Tabel-->
                        <div id="frame-tabel">
                            <div class="table-responsive">
                                <table class="table table-bordered datatable-pagination" id="tabel-data">
                                    <thead>
                                        <tr>
                                            <th class="tg-amwm">ALOKASI</th>
                                            <th class="tg-amwm text-center" colspan="4">PERSETUJUAN</th>
                                            <th class="tg-amwm text-center" colspan="2">PINBUK</th>
                                            <th class="tg-amwm text-center" colspan="4">PENCAIRAN</th>
                                        </tr>
                                        <tr>
                                            <th>ALOKASI 2021</th>
                                            <th>Total Persetujuan & Pengajuan di Rapat BP</th>
                                            <th>Total Pengajuan pada rapat BP</th>
                                            <th>Total SK Lengkap</th>
                                            <th>Menunggu SK Lengkap</th>
                                            <th>Total Pinbuk</th>
                                            <th>Total SK lengkap yang belum di pinbuk</th>
                                            <th>Total Pencairan Ke Mitra</th>
                                            <th>Pencairan Termin Selanjutnya</th>
                                            <th>Menunggu dokumen Lengkap</th>
                                            <th>Efisiensi/ Pengembalian</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $data['alokasi']['nominal'] }}</td>
                                            <td>{{ $data['total_persetujuan']['nominal'] }}</td>
                                            <td>{{ $data['total_pengajuan_bp']['nominal'] }}</td>
                                            <td>{{ $data['total_sk_lengkap']['nominal'] }}</td>
                                            <td>{{ $data['total_menunggu_sk_lengkap']['nominal'] }}</td>
                                            <td>{{ $data['total_pinbuk']['nominal'] /*Rp.185,169,386,818 */ }}</td>
                                            <td>{{ $data['total_sk_lengkap_blm_pinbuk']['nominal'] /* (-Rp.9,180,296,147) */ }}</td>
                                            <td>{{ $data['total_pencairan_mitra']['nominal'] /*Rp.175,376,491,661*/ }}</td>
                                            <td>{{ $data['total_pencairan_termin']['nominal'] /*Rp.4,868,909,852*/ }}</td>
                                            <td>{{ $data['total_menunggu_doc_lengkap']['nominal'] /*Rp.612,599,010*/ }}</td>
                                            <td>{{ $data['total_eff_pengembalian']['nominal'] /*Rp.73,369,095*/ }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ $data['alokasi']['persen'] }}</td>
                                            <td>{{ $data['total_persetujuan']['persen'] }}</td>
                                            <td>{{ $data['total_pengajuan_bp']['persen'] }}</td>
                                            <td>{{ $data['total_sk_lengkap']['persen'] }}</td>
                                            <td>{{ $data['total_menunggu_sk_lengkap']['persen'] }}</td>
                                            <td>{{ $data['total_pinbuk']['persen'] /*105.2%*/}}</td>
                                            <td>{{ $data['total_sk_lengkap_blm_pinbuk']['persen'] /*-5.2%*/ }}</td>
                                            <td>{{ $data['total_pencairan_mitra']['persen'] /*99.7%*/ }}</td>
                                            <td>{{ $data['total_pencairan_termin']['persen'] /*3%*/}}</td>
                                            <td>{{ $data['total_menunggu_doc_lengkap']['persen'] /*0%*/ }}</td>
                                            <td>{{ $data['total_eff_pengembalian']['persen'] /*0.0%*/ }}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>dari Alokasi</td>
                                            <td>dari persetujuan</td>
                                            <td>dari total persetujuan dan pengajuan</td>
                                            <td>dari total persetujuan dan pengajuan</td>
                                            <td>dari Total SK lengkap</td>
                                            <td>dari Total SK lengkap</td>
                                            <td>dari Total SK lengkap</td>
                                            <td>dari Total SK lengkap</td>
                                            <td>dari Total SK lengkap</td>
                                            <td>dari Total SK lengkap</td>
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
@endsection
@push('scripts')
<script>
    let tabelData;
    $(document).ready(function () {


        $('#region_prop_param').select2({
            placeholder: "Pilih Propinsi",
            ajax: {
                url: "{{ url('daftar-daerah/provinsi/') }}",
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
            },
        });

        tabelData = $('#tabel-data').DataTable({
            "ordering": false
        });
    });

    function onChangeYear(sel)
    {
        window.location.href = "{{url('dashboard-pencairan/?tahun=')}}"+sel.value;
    }

    function onBtnTodayClicked(btn){
        window.location.href = "{{url('dashboard-pencairan')}}";
    }
</script>
@endpush
