<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css">
		@page {
			size: 8.27in 11.75in;
			size: landscape;
			margin: 0rem;
			font-family: 'Times New Roman', Times, serif;
		}

		body {
			margin: 1rem;
		}

		table {
			/* border-collapse: collapse; */
		}

		table,
		tr {
			/* border-top: 1px solid black; */
		}

		td {
			text-align: justify;
			vertical-align: justify;
		}

		.title {
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

		.tabel-sk {
			border: none;
			font-size: 12;
			margin: 2rem;
			table-layout: fixed;
		}
	</style>
</head>
<?php
function hari_ini()
{
	$hari = date("D");
	switch ($hari) {
		case 'Sun':
			$hari_ini = "Minggu";
			break;

		case 'Mon':
			$hari_ini = "Senin";
			break;

		case 'Tue':
			$hari_ini = "Selasa";
			break;

		case 'Wed':
			$hari_ini = "Rabu";
			break;

		case 'Thu':
			$hari_ini = "Kamis";
			break;

		case 'Fri':
			$hari_ini = "Jumat";
			break;

		case 'Sat':
			$hari_ini = "Sabtu";
			break;

		default:
			$hari_ini = "Tidak di ketahui";
			break;
	}
	return "" . $hari_ini . "";
}
?>
<?php
function bulan_ini()
{
	$hari = date("M");
	switch ($hari) {
		case 'Jan':
			$hari_ini = "Januari";
			break;

		case 'Feb':
			$hari_ini = "Februari";
			break;

		case 'Mar':
			$hari_ini = "Maret";
			break;

		case 'Apr':
			$hari_ini = "April";
			break;

		case 'Mei':
			$hari_ini = "Mei";
			break;

		case 'Jun':
			$hari_ini = "Juni";
			break;

		case 'Jul':
			$hari_ini = "Juli";
			break;
		case 'Aug':
			$hari_ini = "Agustus";
			break;
		case 'Sep':
			$hari_ini = "September";
			break;
		case 'Oct':
			$hari_ini = "Oktober";
			break;
		case 'Nov':
			$hari_ini = "November";
			break;
		case 'Dec':
			$hari_ini = "Desember";
			break;
		default:
			$hari_ini = "Tidak di ketahui";
			break;
	}
	return "" . $hari_ini . "";
}
?>
@php
$masterbpkh = DB::select('SELECT * FROM trx_bpkh_master LIMIT 1');
$total = \App\Models\PublicTrxProposalRAB::select(DB::raw('sum(total_bpkh) as nominal_rekomendasi'))->where('trx_proposal_id', request()->id)->first();
@endphp

<body>
	<div class="halaman">
		<div class="tanda-tangan">
			<table width="100%" style="font-size: 12" style="border: 0px solid #000" border="0">
				<tr>
					<td width="30%">
						<!--<img src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path('images/logo-bpkh-s.png'))) }}" width="250px">-->
						<!-- <img src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path('images/bpkh_png.png'))) }}" width="200px"> -->
					</td>
					<td width="50%">
					</td>
					<td width="20%">
						<!-- <img src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path("images/lazismu-new.png"))) }}" width="150px"> -->
					</td>

				</tr>
			</table>
		</div>
		<center style="margin-bottom:0">
			<p style="margin-top: 1rem;text-align: center;letter-spacing: 0px;line-height: 1.5rem;font-style:bold">
				PERJANJIAN KERJASAMA <br>
				ANTARA <br>
				BADAN PENGELOLA KEUANGAN HAJI (BPKH) <br>
				DAN <br>
				{{ $data->mitra_kemaslahatan_nm }} <br>
				TENTANG <br>
				DANA KEGIATAN KEMASLAHATAN DALAM BENTUK {{ strtoupper($data->judul_proposal) }} MELALUI {{ strtoupper($data->mitra_kemaslahatan_nm) }} <br>
				NOMOR : {{ $masterbpkh ? $masterbpkh[0]->sk_bpkh : ''}} <br>
				NOMOR : {{ $trxpks ? $trxpks->no_pks_mitra : ''}} <br>
			</p>
		</center>
		<hr style="margin: 0%">
		<table class="tabel-sk" width="100%" style="table-layout:fixed; margin-top: 0px;vertical-align: top;text-align: justify;letter-spacing: 0px;line-height: 1.5rem; word-break:break-all; word-wrap:break-word;">
			<tr>
				<td style="" colspan="2" width="100%">
					Pada hari ini, {{ hari_ini() }} tanggal {{ terbilang(date('d')) }} bulan {{ bulan_ini() }} tahun {{ terbilang(date('Y')) }} ({{date('d-m-Y')}}), bertempat di Jakarta, yang bertanda tangan di bawah ini:
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">I.&nbsp;
					<b>Badan Pengelola Keuangan Haji,</b>
					berkedudukan dan berkantor di
					<p style="margin-left: 18px;">{{ $masterbpkh ? $masterbpkh[0]->alamat_bpkh : ''}},
						dalam hal ini diwakili oleh {{ $masterbpkh ? $masterbpkh[0]->kepala_bpkh : ''}}
						Dalam jabatannya selaku Kepala Badan Pelaksana Badan Pengelola Keuangan Haji berdasarkan
						{{ $masterbpkh ? $masterbpkh[0]->sk_pengangkatan_kep_bpkh : ''}},
						dari dan oleh karenanya sah bertindak untuk dan atas nama Badan Pengelola Keuangan Haji,
						untuk selanjutnya disebut sebagai <b>"PIHAK PERTAMA"</b>.
					</p>
				</td>
			</tr>
			<tr style="">
				<td style="vertical-align: top" colspan="2" width="100%">II.&nbsp;
					<b>{{ $data->mitra_kemaslahatan_nm }},</b>
					berkedudukan di <br />
					<p style="margin-left: 20px;">{{ $data->address }},
						suatu Lembaga pemerintah nonstruktural yang didirikan berdasarkan {{$trxpks ? $trxpks->sk_pendirian_mitra : ''}}
						{{ $data->akta_mitra }} untuk selanjutnya disebut sebagai <b>"PIHAK KEDUA"</b>.
					</p>
				</td>
			</tr>
			<tr>
				<td width="100%" style="" colspan="2">
					<br>
					Bersepakat untuk melakukan kerja sama dalam Bidang Kegiatan Kemaslahatan Dalam Bentuk
					{{ $data->judul_proposal }}
					melalui {{ $data->mitra_kemaslahatan_nm }} yang diatur dalam ketentuan sebagai berikut:
				</td>
			</tr>
			<tr>
				<td width="100%" style="" colspan="2">
					PIHAK PERTAMA dan PIHAK KEDUA secara bersama-sama untuk selanjutnya disebut sebagai <b>"Para Pihak"</b>,
					dan secara sendiri-sendiri untuk selanjutnya disebut sebagai <b>"Pihak"</b>.
				</td>
			</tr>
			<tr>
				<td width="100%" style="" colspan="2">
					<br>
					Para Pihak menerangkan terlebih dahulu:
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="1%">1. &nbsp;
					Bahwa PIHAK PERTAMA adalah badan hukum publik yang dibentuk berdasarkan Undang-Undang
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nomor 34 Tahun 2014 tentang Pengelolaan Keuangan Haji yang melaksanakan fungsi pengelolaan 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keuangan Haji, salah satu diantaranya berupa penyelenggaraan Program Kegiatan Kemaslahatan 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Umat Islam;
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">2. &nbsp; Bahwa PIHAK KEDUA adalah merupakan institusi yang telah ditetapkan oleh PIHAK PERTAMA 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sebagai Mitra Kemaslahatan sesuai ketentuan yang berlaku;
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">3.&nbsp; Bahwa Para Pihak telah sepakat untuk melaksanakan kerjasama Program Kegiatan Kemaslahatan Umat 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Islam dalam bentuk pemberian Dana Kegiatan Kemasalahatan kepada PIHAK KEDUA, sebagaimana 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;terlampir dalam Proposal yang telah disetujui oleh PIHAK PERTAMA
				</td>
			</tr>
			<tr>
				<td width="100%" style="" colspan="2">
					<br>
					Oleh karena itu dengan memperhatikan hal-hal tersebut di atas,
					PIHAK PERTAMA dan PIHAK KEDUA dengan ini sepakat dan setuju untuk melakukan kerjasama berdasarkan persyaratan dan ketentuan
					sebagaimana diatur dalam Perjanjian Kerjasama (selanjutnya disebut sebagai <b>Perjanjian</b>) ini sebagai berikut:
				</td>
			</tr>
			{{-- pasal 1 --}}
			@php
			if($trxpks){
				$pasal = DB::select("SELECT * FROM trx_pasal_pelmonev WHERE pasal='pasal_1' AND trx_pelmonev_pks_id='$trxpks->trx_pks_id'");
			}else{
				$pasal = [];
			}
			
			@endphp
			<tr>
				<td width="100%" style="" colspan="2">
					<center style="font-style:bold; text-align:center">
						<br>
						Pasal 1 <br>
						<u>TUJUAN KERJA SAMA</u>
					</center>
					<br>
					Tujuan dari Perjanjian ini adalah untuk membentuk dan menetapkan batasan kerjasama antara Para Pihak sebagaimana diatur dalam Perjanjian ini dan untuk:
					<br>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">&nbsp;&nbsp;&nbsp;&nbsp;a. &nbsp; sebagai ikatan antara Para Pihak dalam pelaksanaan Kegiatan Kemaslahatan;</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">&nbsp;&nbsp;&nbsp;&nbsp;b. &nbsp; sebagai acuan dan untuk tujuan pemantauan dan evaluasi pelaksanaan Kegiatan Kemaslahatan yang 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;dilaksanakan oleh PIHAK KEDUA; dan</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">&nbsp;&nbsp;&nbsp;&nbsp;c. &nbsp; memastikan Kegiatan Kemaslahatan yang dilaksanakan oleh PIHAK KEDUA sesuai dengan amanat 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Undang-undang Nomor 34 Tahun 2014 tentang Pengelolaan Keuangan Haji.</td>
			</tr>
			@foreach($pasal as $val)
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;{!! $val->ayat_tambahan !!}</td>
			</tr>
			@endforeach
			{{-- pasal 2 --}}
			@php
			if($trxpks){
				$pasal = DB::select("SELECT * FROM trx_pasal_pelmonev WHERE pasal='pasal_2' AND trx_pelmonev_pks_id='$trxpks->trx_pks_id'");
			}else{
				$pasal = [];
			}
			
			@endphp
			<tr>
				<td width="100%" style="" colspan="2">
					<center style="font-style:bold; text-align:center">
						<br>
						Pasal 2 <br>
						<u>RUANG LINGKUP KERJA SAMA</u>
						<br>
					</center>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">1.&nbsp; Ruang lingkup Perjanjian ini adalah Kegiatan Kemaslahatan sebagaimana ditetapkan dalam Surat 
				 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keputusan PIHAK PERTAMA dan dijelaskan lebih lanjut dalam Perjanjian ini.</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">2.&nbsp; Pelaksanaan Kegiatan Kemaslahatan tunduk pada syarat dan ketentuan dalam peraturan-peraturan 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PIHAK PERTAMA yang berlaku mengenai Kegiatan Kemaslahatan, Perjanjian dan Proposal 
				serta &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;jadwal kegiatan pelaksanaan. Dalam proses pelaksanaan Kegiatan Kemaslahatan, PIHAK KEDUA 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;mengerti dan setuju bahwa PIHAK KEDUA akan tunduk dan mematuhi instruksi tertulis dari PIHAK 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PERTAMA (jika ada).</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">3. &nbsp;
					Perjanjian ini terdiri dari Perjanjian dan lampiran-lampirannya, merupakan kesatuan yang tidak dapat 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; dipisahkan. Dalam hal terjadi perbedaan satu dan lainnya, maka ketentuan yang berlaku adalah sesuai 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; hierarki di bawah ini:<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Undang-Undang Nomor 34 Tahun 2014 tentang Pengelolaan Keuangan Haji.<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Peraturan Pemerintah Nomor 5 Tahun 2018 tentang Pelaksanaan Undang-Undang Nomor 34 Tahun &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2014 tetang Pengelolaan Keuangan Haji.<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c. Peraturan BPKH No. 7 Tahun 2018 tentang Penetapan Prioritas Kegiatan Kemaslahatan Dan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penggunaan Nilai Manfaat Dana Abadi Umat, berikut perubahan-perubahannya. <br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;d. Surat Keputusan Penetapan Kegiatan Kemaslahatan.<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;e. Perjanjian.<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;f. Surat Pernyataan Tanggung Jawab Mutlak.<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;g. Surat Edaran.<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;h. Instruksi Kepala Badan Pelaksana .<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;i. Surat Persetujuan.<br>
				</td>
			</tr>
			@foreach($pasal as $val)
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $val->ayat_tambahan }}</td>
			</tr>
			@endforeach
			{{-- pasal 3  --}}
			@php
			if($trxpks){
				$pasal = DB::select("SELECT * FROM trx_pasal_pelmonev WHERE pasal='pasal_3' AND trx_pelmonev_pks_id='$trxpks->trx_pks_id'");
			}else{
				$pasal = [];
			}
			
			@endphp
			<tr>
				<td width="100%" style="" colspan="2">
					<center style="font-style:bold; text-align:center">
						<br>
						Pasal 3 <br>
						<u>PELAKSANAAN KEGIATAN</u>
						<br>
					</center>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="1%">1. &nbsp;
					PIHAK PERTAMA memberikan Dana Kegiatan Kemaslahatan kepada PIHAK KEDUA sebesar 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{!! rupiah($total->nominal_rekomendasi)." (<i>".terbilang($total->nominal_rekomendasi)." rupiah</i>)" !!}
					sebagai Dana Program Kemaslahatan dalam &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bentuk <b>{{ $data->judul_proposal }}</b> melalui <b>{{ $data->mitra_kemaslahatan_nm }} </b>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="1%">2. &nbsp;&nbsp;
					Pelaksanaan Kegiatan sebagaimana dimaksud pada ayat 1 dilakukan sesuai dengan Proposal yang 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;telah disetujui oleh PIHAK PERTAMA melalui Keputusan Kepala Badan Pelaksana Nomor 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $masterbpkh ? $masterbpkh[0]->sk_bpkh : ''}}.</td>
			</tr>
			@foreach($pasal as $val)
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">{{ $val->ayat_tambahan }}</td>
			</tr>
			@endforeach
			{{-- pasal 4  --}}
			@php
			if($trxpks){
				$pasal = DB::select("SELECT * FROM trx_pasal_pelmonev WHERE pasal='pasal_4' AND trx_pelmonev_pks_id='$trxpks->trx_pks_id'");
			}else{
				$pasal = [];
			}
			
			@endphp
			<tr>
				<td width="100%" style="" colspan="2">
					<center style="font-style:bold; text-align:center">
						<br>
						Pasal 4 <br>
						<u>PEMBIAYAAN</u>
						<br>
					</center>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">1. &nbsp; Dana Kegiatan Kemaslahatan dalam Perjanjian ini adalah nilai manfaat dari pengembangan Dana &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Abadi Umat (DAU) yang diberikan oleh PIHAK PERTAMA kepada Mitra Kemaslahatan (PIHAK &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;KEDUA) dalam rangka Kegiatan Kemaslahatan sesuai dengan ketentuan peraturan perundang-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;undangan yang berlaku.</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">2. &nbsp; Mekanisme pencairan Dana Kegiatan Kemaslahatan yang akan diberikan kepada PIHAK KEDUA, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;wajib dilaksanakan sesuai dengan ketentuan peraturan perundangan yang berlaku.</td>
			</tr>
			{{--<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">3. &nbsp;
					@if($trxpks)
					@php
					$totalterm = count(json_decode($trxpks->termin));
					if($totalterm == 1){
					$text = 'sekaligus';
					$value = 'dengan termin 1 ' . 'Rp. ' . number_format(json_decode($trxpks->termin)[0], 2,',','.');
					}elseif($totalterm == 2){
					$text = 'bertahap';
					$value = 'dengan termin 1 ' . 'Rp. ' . number_format(json_decode($trxpks->termin)[0], 2,',','.') . ' termin 2 ' . 'Rp. ' . number_format(json_decode($trxpks->termin)[1], 2,',','.');
					}elseif($totalterm == 3){
					$text = 'bertahap';
					$value = 'dengan termin 1 ' . 'Rp. ' . number_format(json_decode($trxpks->termin)[0], 2,',','.') . ' termin 2 ' . 'Rp. ' . number_format(json_decode($trxpks->termin)[1], 2,',','.') . ' termin 3 ' . ' Rp. ' . number_format(json_decode($trxpks->termin)[2], 2,',','.');
					}
					@endphp
					@else
					@php
					$text = '';
					$value = '';
					@endphp
					@endif
					 Pencairan bantuan sebagaimana dimaksud pada ayat (1) ini dilakukan oleh PIHAK PERTAMA melalui &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pemindahbukuan secara {{ $text }} ke rekening PIHAK KEDUA yang telah teregistrasi sesuai ketentuan yang &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;berlaku.
				</td>
			</tr>--}}
			@foreach($pasal as $val)
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">{{ $val->ayat_tambahan }}</td>
			</tr>
			@endforeach
			{{-- pasal 5  --}}
			@php
			if($trxpks){
				$pasal = DB::select("SELECT * FROM trx_pasal_pelmonev WHERE pasal='pasal_5' AND trx_pelmonev_pks_id='$trxpks->trx_pks_id'");
			}else{
				$pasal = [];
			}
			
			@endphp
			<tr style="margin-top: 100px;">
				<td width="100%" style="" colspan="2">
					<center style="font-style:bold; text-align:center">
						<br>
						Pasal 5 <br>
						<u>KEWAJIBAN PIHAK KEDUA</u>
						<br>
					</center>
				</td>
			</tr>
			<tr>
				<td style="" colspan="2" width="100%">
					PIHAK KEDUA mempunyai kewajiban:
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">a. &nbsp;
					Menggunakan Dana Kegiatan Kemaslahatan untuk membeli/mengadakan barang/jasa dan bertanggung 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;jawab mutlak atas penggunaan Dana Kegiatan Kemaslahatan tersebut sesuai dengan Surat Keputusan 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PIHAK PERTAMA dan ketentuan-ketentuan ditetapkan dalam Perjanjian ini
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">b. &nbsp;Menyampaikan rincian pengeluaran Dana Kegiatan Kemaslahatan yang dimasukkan dalam laporan 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pertanggungjawaban.
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">c. &nbsp; Menghentikan kegiatan dalam hal PIHAK KEDUA menghadapi situasi yang memerlukan deviasi dari 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;persyaratan dan persetujuan yang ditetapkan PIHAK PERTAMA, sampai dengan menerima instruksi 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tertulis secara khusus dari PIHAK PERTAMA mengenai penanganan yang dikehendaki terkait 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pengelolaan Dana Kegiatan Kemaslahatan oleh PIHAK KEDUA dimaksud.</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">d. &nbsp;Setiap adanya potensi perbedaan pelaksanaan kegiatan dari persetujuan yang telah disetujui PIHAK 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PERTAMA yang berdampak pada perbedaan dengan desain awal yang telah disetujui agar dimintakan 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;persetujuan kepada PIHAK PERTAMA secara tertulis.</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">e. &nbsp;Memberikan data dan informasi yang diperlukan kepada PIHAK PERTAMA dalam pelaksanaan 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pemantauan dan evaluasi di lokasi Kegiatan Kemaslahatan.</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">f. &nbsp; Menyampaikan laporan awal, laporan perkembangan, dan laporan pertanggungjawaban akhir Kegiatan 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kemaslahatan kepada PIHAK PERTAMA.</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">g. Laporan Pertanggungjawaban akhir Kegiatan Kemaslahatan kepada PIHAK PERTAMA sesuai 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ketentuan peraturan yang berlaku pada PIHAK PERTAMA.</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">h. &nbsp;Memastikan <i>branding</i> institusi PIHAK PERTAMA dalam pelaksanaan Kegiatan Kemaslahatan yang 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dilaksanakan oleh PIHAK KEDUA dalam bentuk namun tidak terbatas pada pencantuman logo pada 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;prasasti dan media lainnya.</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">i. &nbsp; PIHAK KEDUA agar menyiapkan dokumen bukti pelaksanaan pemberian bantuan berupa tanda terima 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dan/atau foto kegiatan sesuai ketentuan yang ditentukan termasuk bukti dokumentasi <i>branding</i> PIHAK 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PERTAMA dalam kegiatan tersebut;</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">j.&nbsp; Mengembalikan Dana Kegiatan Kemaslahatan yang penggunaannya tidak sesuai tujuan Kegiatan 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kemaslahatan sebagaimana dimaksud dalam Surat Keputusan dan Proposal yang telah disetujui oleh 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PIHAK PERTAMA, dalam jangka waktu paling lama 30 hari, setelah diketahui oleh PIHAK 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PERTAMA atau pihak yang ditunjuk oleh PIHAK PERTAMA dalam proses pemantauan dan evaluasi 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;atas penggunaan Dana Kegiatan Kemaslahatan dimaksud.</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">k. Mengembalikan sisa Dana Kegiatan Kemaslahatan, dalam hal terdapat sisa Dana Kegiatan 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kemaslahatan dari pelaksanaan Kegiatan Kemaslahatan, ke rekening PIHAK PERTAMA. </td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">l. &nbsp;
					Penggunaan komponen biaya operasional PIHAK KEDUA (Mitra Kemaslahatan) meliputi:
					<br>&nbsp;&nbsp;&nbsp;&nbsp;1) Asesmen dan Visitasi;
					<br>&nbsp;&nbsp;&nbsp;&nbsp;2) Pembuatan Proposal;
					<br>&nbsp;&nbsp;&nbsp;&nbsp;3) Honor Pegawai Mitra Kemaslahatan;
					<br>&nbsp;&nbsp;&nbsp;&nbsp;4) Biaya Komunikasi dan Transportasi;
					<br>&nbsp;&nbsp;&nbsp;&nbsp;5) Monitoring dan Evaluasi; dan
					<br>&nbsp;&nbsp;&nbsp;&nbsp;6) <i>Branding</i>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">m. PIHAK KEDUA memastikan bahwa PIHAK KEDUA dan/atau Kelompok Penerima Manfaat 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;mendukung program unggulan PIHAK PERTAMA, termasuk tapi tidak terbatas pada:
					<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1) Sosialisasi Kampanye Haji Muda;
					<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2) <i>Intangible benefit</i> program di lingkungan PIHAK KEDUA dan Kelompok Penerima Manfaat untuk 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>branding</i> logo PIHAK PERTAMA menggunakan media yang dimiliki PIHAK KEDUA dan/atau 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kelompok Penerima Manfaat seperti sekolah, kampus, cetakan, souvenir, buku, dan/atau media lainnya.
				</td>
			</tr>
			@foreach($pasal as $val)
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">{{ $val->ayat_tambahan }}</td>
			</tr>
			@endforeach
			{{-- pasal 6  --}}
			@php
			if($trxpks){
				$pasal = DB::select("SELECT * FROM trx_pasal_pelmonev WHERE pasal='pasal_6' AND trx_pelmonev_pks_id='$trxpks->trx_pks_id'");
			}else{
				$pasal = [];
			}
			
			@endphp
			<tr>
				<td width="100%" style="" colspan="2">
					<center style="font-style:bold; text-align:center">
						<br>
						Pasal 6 <br>
						<u>JANGKA WAKTU PERJANJIAN</u>
						<br>
					</center>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">1. &nbsp; Perjanjian ini mulai berlaku sejak tanggal ditandatangani, sampai dengan PIHAK PERTAMA telah 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;menyetujui laporan pertanggungjawaban akhir dari PIHAK KEDUA, selambat-lambatnya pada 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tanggal {{ $trxpks ? date('d M Y', strtotime($trxpks->start_date_timeline)) . ' s.d. ' . date('d M Y', strtotime($trxpks->end_date_timeline)) : ''}}.</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">2. &nbsp; Dalam hal PIHAK KEDUA melakukan pelaksanaan kegiatan kemaslahatan tersebut harus sesuai 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dengan jadwal yang telah disepakati tersebut.</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">3. &nbsp; PIHAK PERTAMA dapat mengakhiri Perjanjian ini sebelum jangka waktu Perjanjian berakhir dalam 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;hal PIHAK KEDUA melakukan tindakan-tindakan yang melanggar Perjanjian ini. </td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">4. &nbsp;Dalam hal pengakhiran Perjanjian sebagaimana dimaksud pada ayat (2) Pasal ini, maka PIHAK 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;KEDUA wajib mengembalikan Dana Kegiatan Kemaslahatan yang sudah diterima kepada PIHAK 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PERTAMA.</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">5. &nbsp;PIHAK KEDUA dapat mengakhiri Perjanjian sebelum berakhirnya jangka waktu Perjanjian 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sebagaimana dimaksud ayat (1) Pasal ini, dengan pemberitahuan secara tertulis selambat-lambatnya 30 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(tiga puluh) hari sebelum efektif pengakhiran, dan atas pengakhiran Perjanjian oleh PIHAK KEDUA 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tersebut, maka PIHAK KEDUA wajib mengembalikan Dana Kegiatan Kemaslahatan.</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">6. &nbsp;Dalam hal dibutuhkan perubahan atas Jangka Waktu Perjanjian, PIHAK KEDUA menyampaikan 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;permintaan perubahan kepada PIHAK PERTAMA secara tertulis selambat-lambatnya 30 (tiga puluh 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;hari) sebelum efektif perubahan tersebut untuk dilakukan persetujuan oleh PIHAK PERTAMA.</td>
			</tr>
			@foreach($pasal as $val)
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">{{ $val->ayat_tambahan }}</td>
			</tr>
			@endforeach
			{{-- pasal 7  --}}
			@php
			if($trxpks){
				$pasal = DB::select("SELECT * FROM trx_pasal_pelmonev WHERE pasal='pasal_7' AND trx_pelmonev_pks_id='$trxpks->trx_pks_id'");
			}else{
				$pasal = [];
			}
			@endphp
			<tr>
				<td width="100%" style="" colspan="2">
					<center style="font-style:bold; text-align:center">
						<br>
						Pasal 7 <br>
						<u>PENYELESAIAN PERSELISIHAN</u>
						<br>
					</center>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">1. &nbsp; Dalam hal tejadi perselisihan mengenai pelaksanaan dan penafsiran yang timbul sehubungan dengan 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Perjanjian ini, Para Pihak sepakat untuk terlebih dahulu akan berupaya menyelesaikan perselisihan 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tersebut dengan cara musyawarah untuk mencapai mufakat, baik dengan menggunakan jasa mediator 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;independen maupun melalui pembicaraan antara wakil-wakil dari masing-masing Pihak.</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">2. &nbsp; Apabila penyelesaian secara musyawarah tidak berhasil mencapai mufakat sampai dengan 30 (tiga 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;puluh) Hari Kalender sejak dimulainya musyawarah tersebut, maka Para Pihak sepakat untuk 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;menyelesaikan perselisihan tersebut melalui Badan Arbitrase Syariah Nasional (Basyarnas) Untuk 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;kemudian eksekusinya dapat dilaksanakan melalui Pengadilan Negeri sesuai dengan keputusan 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Basyarnas.</td>
			</tr>
			{{--<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">3. &nbsp; Sebelum ada keputusan yang berkekuatan hukum tetap, selama proses penyelesaian perselisihan, Para 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pihak tetap wajib melaksanakan kewajibannya menurut Perjanjian ini.</td>
			</tr>
			--}}
			@foreach($pasal as $val)
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">{!! $val->ayat_tambahan !!}</td>
			</tr>
			@endforeach

			{{-- pasal 8  --}}
			@php
			if($trxpks){
				$pasal = DB::select("SELECT * FROM trx_pasal_pelmonev WHERE pasal='pasal_8'");
			}else{
				$pasal = [];
			}
			@endphp
			<tr>
				<td width="100%" style="" colspan="2">
					<center style="font-style:bold; text-align:center">
						<br>
						Pasal 8 <br>
						<u>LAIN-LAIN</u>
						<br>
					</center>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">1. &nbsp; Apabila terjadi hal-hal yang diluar kekuasaan Para Pihak atau force majeure, dapat dipertimbangkan 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;kemungkinan perubahan tempat dan waktu pelaksanaan tugas pekerjaan dengan persetujuan kedua 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;belah Pihak.</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">2. &nbsp; Yang termasuk force majeure adalah: <br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Bencana alam; <br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Tindakan pemerintah di bidang fiskal dan moneter;<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c. Keadaan kemanan yang tidak mengizinkan;<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;d. Bencana non alam<br>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">3. &nbsp; Segala perubahan dan/atau pembatalan terhadap Perjanjian ini akan diatur bersama kemudian oleh 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PIHAK PERTAMA dan PIHAK KEDUA.</td>
			</tr>
			@foreach($pasal as $val)
			<tr>
				<td style="vertical-align: top;" colspan="2" width="100%">{{ $val->ayat_tambahan }}</td>
			</tr>
			@endforeach
		</table>
		<div class="tanda-tangan">
			<table class="tabel-sk" width="100%" style="table-layout:fixed; margin-top: 0px;vertical-align: top;text-align: justify;letter-spacing: 0px;line-height: 1.5rem; word-break:break-all; word-wrap:break-word;">

				{{-- pasal 9  --}}
				@php
				if($trxpks){
					$pasal = DB::select("SELECT * FROM trx_pasal_pelmonev WHERE pasal='pasal_9' AND trx_pelmonev_pks_id='$trxpks->trx_pks_id'");
				}else{
					$pasal = [];
				}
				@endphp
				<tr>
					<td width="100%" style="" colspan="2">
						<center style="font-style:bold; text-align:center">
							<br>
							Pasal 9 <br>
							<u>PENUTUP</u>
							<br>
						</center>
						Demikian Perjanjian ini dibuat dan ditandatangani pada hari dan tanggal tersebut pada awal Perjanjian ini,
						dalam 2 (dua) rangkap yang sama bunyinya dan keduanya bermeterai cukup, mempunyai kekuatan hukum yang sama serta mengikat Para Pihak.
					</td>
				</tr>
				@foreach($pasal as $val)
				<tr>
					<td style="vertical-align: top;" colspan="2" width="100%">{{ $val->ayat_tambahan }}</td>
				</tr>
				@endforeach
			</table>
			<br /><br /><br />
			<table class="tabel-sk" width="100%" style="table-layout:fixed; margin-top: 0px;vertical-align: top;text-align: justify;letter-spacing: 0px;line-height: 1.5rem; word-break:break-all; word-wrap:break-word;">
				<tr>
					<td width="100%" style="text-align: center;"><b>PIHAK PERTAMA, <br> BADAN PENGELOLA KEUANGAN HAJI </b></td>
					<td style="width: 100%;text-align:center"><b>PIHAK KEDUA, <br> {{ $data->mitra_kemaslahatan_nm }}</b></td>
				</tr>
				<tr>
					<td width="100%" style="text-align: center;">
						<br>
						<br>
						<br>
						<br>
						<br>
						Dr. Anggito Abimanyu, M.Sc. <br>
						Kepala Badan Pelaksana
					</td>
					<td width="100%" style="text-align:center">
						<br>
						<br>
						<br>
						<br>
						<br>
						{{ $data->pic_1 }}<br>
						{{ $data->jabatan_pic1 }}
					</td>
				</tr>
			</table>
		</div>
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<div class="tanda-tangan">
			@php
			$lampiran_photo = $trxpks ? json_decode($trxpks->lampiran_photo) : [];
			$truePhoto = $lampiran_photo != null ? $lampiran_photo : [];
			@endphp
			@if(count($truePhoto) > 0)
			<table style="text-align: justify;">
				<tr style="margin-left: 20px;">
					<th>Lampiran PKS (RAB, Lainya)</th>
					<td> : </td>
				</tr>
				<tr align="left">
					<th>Nomor </th>
					<td> : </td>
					<td>{{ $masterbpkh ? $masterbpkh[0]->sk_bpkh : ''}}</td>
				</tr>
				<tr align="left">
					<th>Nomor </th>
					<td> : </td>
					<td>{{ $trxpks ? $trxpks->sk_pendirian_mitra : ''}}</td>
				</tr>
			</table>
			<table>
				<tr>
					<td>Lampiran RAB : </td>
					<td>
						@if(pathinfo($trxpks->lampiran_rab)["extension"] == 'xlsx' || pathinfo($trxpks->lampiran_rab)["extension"] == 'pdf' || pathinfo($trxpks->lampiran_rab)["extension"] == 'docx')
						<a href="{{ route('download.lampiran', $trxpks->lampiran_rab) }}">{{ $trxpks ? $trxpks->lampiran_rab : ''}}</a>
						@else
						<img src="data:image/png;base64, {{ base64_encode(file_get_contents(storage_path("app/public/pelmonev/pks/$trxpks->lampiran_rab"))) }}" width="500px">
						@endif
					</td>
				</tr>
				<tr>
					<td>Lampiran Lainya : </td>
					<td>
						@if(pathinfo($trxpks->lampiran_lainya)["extension"] == 'xlsx' || pathinfo($trxpks->lampiran_lainya)["extension"] == 'pdf' || pathinfo($trxpks->lampiran_lainya)["extension"] == 'docx')
						<a href="{{ route('download.lampiran', $trxpks->lampiran_lainya) }}">{{ $trxpks ? $trxpks->lampiran_lainya : ''}}</a>
						@else
						<img src="data:image/png;base64, {{ base64_encode(file_get_contents(storage_path("app/public/pelmonev/pks/$trxpks->lampiran_lainya"))) }}" width="500px">
						@endif
					</td>
				</tr>
				<tr>
					<td>Lampiran Photo : </td>
					<td>
						@foreach($lampiran_photo as $val)
						<img src="data:image/png;base64, {{ base64_encode(file_get_contents(storage_path("app/public/pelmonev/pks/$val"))) }}" width="500px">
						@endforeach
						@endif
					</td>
				</tr>
			</table>

		</div>
	</div>
</body>

</html>