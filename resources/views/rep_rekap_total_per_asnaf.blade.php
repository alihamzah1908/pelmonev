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
                                    <th class="tg-amwm">Asnaf</th>
                                    <th class="tg-amwm">Pagu Tahun <?php echo(date('Y') -1); ?></th>
                                    <th class="tg-amwm">%</th>
                                    <th class="tg-amwm">Based on Persetujuan</th>
                                    <th class="tg-amwm">% persetujuan thd alokasi</th>
                                    <th class="tg-amwm">Based on SK Lengkap</th>
                                    <th class="tg-amwm">% serapan SK Lengkap thd alokasi</th>
                                    <th class="tg-amwm">Sisa Pagu</th>
                                    <th class="tg-amwm">Pencairan sampai dg tgl hari ini</th>
                                    <th class="tg-amwm">% pencarian thd alokasi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="tg-0lax">Pelayanan Ibadah Haji</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">98</td>
                                    <td class="tg-0lax">123.400.000</td>
                                    <td class="tg-0lax">88</td>
                                    <td class="tg-0lax">120.000.000</td>
                                    <td class="tg-0lax">77</td>
                                    <td class="tg-0lax">8.888.888</td>
                                    <td class="tg-0lax">88.888.888</td>
                                    <td class="tg-0lax">90</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Pendidikan dan Dakwah</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">98</td>
                                    <td class="tg-0lax">123.400.000</td>
                                    <td class="tg-0lax">88</td>
                                    <td class="tg-0lax">120.000.000</td>
                                    <td class="tg-0lax">77</td>
                                    <td class="tg-0lax">8.888.888</td>
                                    <td class="tg-0lax">88.888.888</td>
                                    <td class="tg-0lax">90</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Kesehatan</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">98</td>
                                    <td class="tg-0lax">123.400.000</td>
                                    <td class="tg-0lax">88</td>
                                    <td class="tg-0lax">120.000.000</td>
                                    <td class="tg-0lax">77</td>
                                    <td class="tg-0lax">8.888.888</td>
                                    <td class="tg-0lax">88.888.888</td>
                                    <td class="tg-0lax">90</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Sosial Keagamaan</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">98</td>
                                    <td class="tg-0lax">123.400.000</td>
                                    <td class="tg-0lax">88</td>
                                    <td class="tg-0lax">120.000.000</td>
                                    <td class="tg-0lax">77</td>
                                    <td class="tg-0lax">8.888.888</td>
                                    <td class="tg-0lax">88.888.888</td>
                                    <td class="tg-0lax">90</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Ekonomi Umat</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">98</td>
                                    <td class="tg-0lax">123.400.000</td>
                                    <td class="tg-0lax">88</td>
                                    <td class="tg-0lax">120.000.000</td>
                                    <td class="tg-0lax">77</td>
                                    <td class="tg-0lax">8.888.888</td>
                                    <td class="tg-0lax">88.888.888</td>
                                    <td class="tg-0lax">90</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Sarana dan Prasarana Ibadah</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">98</td>
                                    <td class="tg-0lax">123.400.000</td>
                                    <td class="tg-0lax">88</td>
                                    <td class="tg-0lax">120.000.000</td>
                                    <td class="tg-0lax">77</td>
                                    <td class="tg-0lax">8.888.888</td>
                                    <td class="tg-0lax">88.888.888</td>
                                    <td class="tg-0lax">90</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Tanggap Darurat Bencana pada Pelayanan Ibadah Haji</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Tanggap Darurat Bencana pada Pendidikan dan Dakwah</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Tanggap Darurat Bencana pada Kesehatan</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Tanggap Darurat Bencana pada Sosial Keagamaan</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Tanggap Darurat Bencana pada Ekonomi Umat</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                </tr>
                                <tr>
                                    <td class="tg-0lax">Tanggap Darurat Bencana pada Sarana dan Prasarana Ibadah</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                    <td class="tg-0lax">-</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr style="background: #f8f8f8; font-weight: bolder;">
                                    <td class="tg-0lax">TOTAL</td>
                                    <td class="tg-0lax">123.456.789</td>
                                    <td class="tg-0lax">98</td>
                                    <td class="tg-0lax">123.400.000</td>
                                    <td class="tg-0lax">88</td>
                                    <td class="tg-0lax">120.000.000</td>
                                    <td class="tg-0lax">77</td>
                                    <td class="tg-0lax">8.888.888</td>
                                    <td class="tg-0lax">88.888.888</td>
                                    <td class="tg-0lax">90</td>
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
