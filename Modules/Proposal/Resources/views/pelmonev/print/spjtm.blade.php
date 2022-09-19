<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<style type="text/css">
			@page {
				size: 8.27in 11.75in;
                size: landscape;
				margin: 0rem;
				font-family: 'Times New Roman', Times, serif;
			}
			
			body {
				margin : 1rem;
			}
			
			table {
				/* border-collapse: collapse; */
			}
			
			table, tr {
				/* border-top: 1px solid black; */
			}

			td {
				text-align: justify;
				vertical-align: justify;
			}
			
			.title{
				text-align: center,
			}

            div.halaman {
                page-break-after: always;
                page-break-inside: avoid;
            }

            div.halaman:last-child {
                page-break-after: avoid;
                page-break-inside: avoid;
            }

			.tabel-data{
				/* border-collapse: collapse;  */
				/* border: 1px solid black;  */
				font-size: 12;
			}
		</style>
	</head>
	<body>
		@php
		$total = \App\Models\PublicTrxProposalRAB::select(DB::raw('sum(total_bpkh) as nominal_rekomendasi'))->where('trx_proposal_id', request()->id)->first();
		@endphp
        <div class="halaman">	
			{{-- <center>
				<img align="top" src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path('images/logo-bpkh-s.png'))) }}" width="100px">
			</center> --}}
			<div class="tanda-tangan">
			<table width="100%" style="font-size: 12" style="border: 0px solid #000" border="0">
				<tr>
					<td width="30%">
						<!--<img src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path('images/logo-bpkh-s.png'))) }}" width="250px">-->
						<img src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path('images/bpkh_png.png'))) }}" width="200px"> -->
					</td>
					<td width="50%">
					</td>
					<td width="20%">
						<img src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path("images/lazismu-new.png"))) }}" width="150px"> -->
					</td>

				</tr>
			</table>
			</div>
			<br>
			<br>
			<br>
			<br>
            <table class="tabel-data" width="100%" style="margin: 3rem">>
				<tr>
					<td width="20%" style=""  colspan="3">
						Yang bertanda tangan di bawah ini:
					</td>
				</tr>
				<tr style="">
					<td style="vertical-align: top" width="20%">Nama </td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
					{{ $data->penanggung_jawab_nm }}
					</td>
                </tr>
				<tr style="">
					<td style="vertical-align: top" width="20%">Alamat</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
					{{ $data->address }}
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top" width="20%">Jabatan</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
					{{ $data->penanggung_jawab_jabatan }}
					</td>
                </tr>
				<tr style="line-height: 1rem;">
					<td style="vertical-align: top" width="20%">NPWP</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
					{{ $data->npwp_no_lembaga }}
					</td>
                </tr>
				<tr style="line-height: 1rem;">
					<td style="vertical-align: top" width="20%">Rekening</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
					{{ $data->bank_account_no }}
					</td>
                </tr>
				<tr style="line-height: 1rem;">
					<td style="vertical-align: top" width="20%">Bank</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
					{{ $data->bank_nm }}
					</td>
                </tr>
				<tr style="line-height: 1rem;">
					<td style="vertical-align: top" width="20%">Tahun Anggaran</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
					{{ date('Y')}}
					</td>
                </tr>
				<tr style="height: 10rem;vertical-align:center">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Dengan ini menyatakan bahwa saya bertanggung jawab penuh secara formal dan material atas 
						Penerimaan Dana Kemaslahatan untuk kegiatan Dana Program Kemaslahatan dalam bentuk 
						<b>{{ $data->judul_proposal }}</b> melalui <b>{{ $data->mitra_kemaslahatan_nm }}</b>, 
						dan akan bertanggungjawab mutlak terhadap penggunaan dana yang kami terima sesuai dengan ketentuan yang ditetapkan 
						BPKH dan perundang-undangan yang berlaku dengan perincian sebagai berikut:
					</td>
                </tr>
				<tr style="height: 10rem;vertical-align:center">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-style:bold;font-family:Arial, Helvetica, sans-serif">
						<br>
						<br>
						<table width="100%" style="border-collapse: collapse;border: 1px solid black;font-size: 12;">
							<tr style="border: 1px solid black">
								<th width="10%" style="border: 1px solid black">No</th>
								<th width="50%" style="border: 1px solid black">Kegiatan</th>
								<th width="40%" style="border: 1px solid black">Jumlah</th>
							</tr>
							<tr style="border: 1px solid black">
								<td style="border: 1px solid black">1.</td>
								<td style="border: 1px solid black">{{ $data->judul_proposal }}</td>
								<td style="border: 1px solid black">{!! rupiah($total->nominal_rekomendasi)." (<i>".terbilang($total->nominal_rekomendasi)." rupiah</i>)" !!}</td>
							</tr>
						</table>
						<br>
						<br>
					</td>
				</tr>
				<tr style="height: 10rem;vertical-align:center">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Apabila di kemudian hari diketahui terjadi penyimpangan dalam penggunaan dan/atau tidak sesuai dengan rencana penggunaan, 
						maka saya bersedia menerima sanksi sesuai dengan peraturan perundang-undangan yang berlaku.
						Demikian surat pernyataan ini dibuat dengan sebenarnya dan bermaterai cukup untuk dipergunakan sebagaimana mestinya.
					</td>
                </tr>
			</table>
			<div class="tanda-tangan">
				<table width="100%" style="font-size: 12" style="border: none">
					<tr>
						<td style="width: 60%;">&nbsp;</td>
						<td style="width: 40%;"></td>
					</tr>
					<tr>
						<td> 
						</td>
						<td style="vertical-align: top;">
								Jakarta, {{ tgl_indo(date('Y-m-d')) }}<br>
								<br>
								<br>
								<br>
								<br>
								<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $data->pic_1 }}<br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $data->jabatan_pic1 }}
						</td>
					</tr>
				</table>
			</div>
		</div>
    </body>
</html>
