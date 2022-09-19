<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<style type="text/css">
			@page {
				size: 8.27in 11.75in;
                		size: landscape;
				margin: 0rem;
				font-family: 'Bookman Old Style';
			}
			
			body {
				margin : 1rem;
			}
			
			table {
				border-collapse: collapse;
			}
			
			table, th, td {
				border: 0px solid black;
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
        <div class="halaman">	
			<center>
				<img align="top" src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path('storage/images/pancasila.png'))) }}" width="100px">
			</center>
			<br>
			<div style="font-size: 12px">
				<center><h3>BADAN PENGELOLA KEUANGAN HAJI</h3>
					<p>Menara Bidakara I Lantai 2, 5 dan 8, Jl. Gatot Subroto Kav. 71-73, Jakarta Selatan 12870</p>
					<p>Telp: 021-83793001 (Hunting), 021-83793002 Fax: 021-83793019 www.bpkh.go.id</p>
				</center>
			</div>
            <table class="tabel-data" width="100%" style="margin: 3rem; font-size: 11px">
				<tr style="">
					<td style="vertical-align: top" width="20%">Nomor </td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						B./BP/A6/07/2022
					</td>
                </tr>
				<tr style="">
					<td style="vertical-align: top" width="20%">Sifat</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Biasa
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top" width="20%">Lampiran</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						-
					</td>
                </tr>
				<tr style="line-height: 1rem;">
					<td style="vertical-align: top" width="20%">Hal</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Persetujuan Permohonan {{ $data->judul_proposal }}
					</td>
                </tr>
			</table>
			<table class="tabel-data" width="50%" style="margin: 3rem;font-size:11px;">
				<tr style="line-height: 1rem;margin-top: 30px;">
					<td style="vertical-align: top" width="20%"><b>Yth.</b></td>
                </tr>
				<tr style="line-height: 1rem;">
					<td style="vertical-align: top" width="20%"><b>Pimpinan. {{ $mitra->mitra_kemaslahatan_nm }}</b></td>
                </tr>
				<tr style="line-height: 1rem;">
					<td style="vertical-align: top" width="20%">{{ $mitra->address }}</td>
                </tr>
			</table>
			<table class="tabel-data isi-surat" width="100%" style="margin: 3rem; font-size: 11px;">
				@php
				//dd($data);
			     	$id = $data->trx_proposal_child_id != '' ? $data->trx_proposal_child_id : $data->trx_proposal_id;
			     	$total = \App\Models\PublicTrxProposalRAB::select(DB::raw('sum(total_bpkh) as nominal_rekomendasi'))->where('trx_proposal_id', $id)->first();
				@endphp
				
				<tr style="line-height: 1rem;">
					<td style="vertical-align: top" width="100%"><i>Assalamu`alaikum warahmatullahi wabarakatuh</i></td>
				</tr>
				<tr style="height: 5rem;vertical-align:center;">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif;">
						<p style="text-align: justify;">Semoga rahmat dan lindungan Allah SWT senantiasa menyertai kita dalam menjalankan aktivitas sehari-hari. Aamiin.
						
						Pertama-tama, kami mengucapkan terima kasih atas permohonan pengajuan proposal terkait
						
						<b>{{ $data->judul_proposal}}</b> yang Saudara ajukan melalui surat Nomor <b>{{$data->proposal_no}}</b>
						
						tanggal {{ $data->created_at != '' ? date('d M Y', strtotime($data->created_at)) : date('d M Y', strtotime($data->updated_at)) }} perihal {{ $data->judul_proposal}} Selanjutnya kami informasikan bahwa setelah melalui evaluasi atas proposal tersebut, maka
						permohonan Saudara dapat disetujui oleh Badan Pelaksana BPKH. Persetujuan tersebut telah
						ditetapkan dalam Surat Keputusan Kepala Badan Pelaksana BPKH nomor 392/BPKH.00/10/2021 tanggal 8 Oktober 2021 tentang Kegiatan Kemaslahatan Umat Islam Dalam Bentuk {{ $data->judul_proposal }}
						melalui {{ strtoupper($data->mitra_kemaslahatan_nm) }} Kegiatan tersebut kami setujui berupa {{ $data->judul_proposal }} dengan nominal persetujuan sebesar {{ rupiah($total->nominal_rekomendasi) }} rupiah. <br >
						Adapun rinciannya adalah sebagai berikut:</p>
					</td>                
				</tr>
			</table>
			<table class="tabel-data isi-surat" width="100%" style="margin: 3rem;font-size: 11px;">
				<tr style="height: 7rem;vertical-align:center">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-style:bold;font-family:Arial, Helvetica, sans-serif">
						<br>
						<br>
						<table width="100%" style="border-collapse: collapse;border: 1px solid black;font-size: 11px;">
							<tr style="border: 1px solid black">
								<th width="10%" style="border: 1px solid black">No</th>
								<th width="50%" style="border: 1px solid black">Kegiatan</th>
								<th width="40%" style="border: 1px solid black">Nilai Persetujuan</th>
							</tr>
							@php
			     				$id = $data->trx_proposal_child_id != '' ? $data->trx_proposal_child_id : $data->trx_proposal_id;
			     				$total = \App\Models\PublicTrxProposalRAB::select(DB::raw('sum(total_bpkh) as nominal_rekomendasi'))->where('trx_proposal_id', $id)->first();
		            				$ppn = ($total->nominal_rekomendasi * 10) / 100;
							$afterPpn = $total->nominal_rekomendasi  - $ppn;							
							@endphp
							<tr style="border: 1px solid black">
								<td style="border: 1px solid black">1.</td>
								<td style="border: 1px solid black">{{ $data->judul_proposal }}</td>
								<td style="border: 1px solid black">{{ "Rp " . number_format($afterPpn ,2,',','.') }}</td>
							</tr>
							<tr style="border: 1px solid black">
								<td style="border: 1px solid black">2.</td>
								<td style="border: 1px solid black">Biaya operasional 10%</td>
								<td style="border: 1px solid black">{{ "Rp " . number_format($ppn,2,',','.') }}</td>
							</tr>
							<tr style="border: 1px solid black">
								<td style="border: 1px solid black"></td>
								<td style="border: 1px solid black">Total</td>
								<td style="border: 1px solid black">{{ "Rp " . number_format($total->nominal_rekomendasi,2,',','.') }}</td>
							</tr>

						</table>
						<br>
						<br>
					</td>
				</tr>
				<tr style="vertical-align:center">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Demikian kami sampaikan, atas perhatian dan kerjasamanya kami mengucapkan terima kasih.
					</td>
                </tr>
				<tr style="border: 1px solid black">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						<i>Wassalamu`alaikum warahmatullahi wabarakatuh.</i>
					</td>
                </tr>
			</table>
			<div class="tanda-tangan" style="font-size: 11px;">
				<center>
					BADAN PENGELOLA KEUANGAN HAJI<br />
					BADAN PELAKSANAAN
				</center>
			</div>
				<table class="tabel-data isi-surat" width="100%" style="margin: 3rem;vertical-align:center;font-size: 11px;">
					<tr>
						<td style="vertical-align: top;text-align:center"> 
							Anggito Abimanyu<br>
							Kepala
						</td>
						<td style="vertical-align: top;text-align:center">
								Rahmat Hidayat
								<br>
								Anggota Bidang Kesekretariatan Badan dan <br/> Kemaslahatan
						</td>
					</tr>
				</table>
		</div>
    	</body>
</html>
