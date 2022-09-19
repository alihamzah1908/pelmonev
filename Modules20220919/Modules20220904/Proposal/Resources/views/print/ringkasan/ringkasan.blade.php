<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<style type="text/css">
			@page {
				size: 8.27in 11.75in;
                size: landscape;
				margin: 0rem;
				font-family: 'Calibri';
			}
			
			body {
				margin : 1rem;
				font-family: 'Calibri';
			}
			
			table {
				border-collapse: collapse;
			}
			
			table, tr {
				border-top: 0px solid black;
			}
			table, td {
				border-bottom: 1px solid black;
			}
			table, .footer {
				border-bottom: 0px solid black;
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
				border-collapse: collapse; 
				border: 1px solid black; 
				font-size: 12;
			}
			.tabel-data-1{
				border-collapse: collapse; 
				border: 0px solid black; 
				font-size: 12;
			}
		</style>
	</head>
	<body>
        <div class="halaman">	
            <table class="tabel-data" width="100%" style="margin: 3rem">
				<tr>
					<td width="20%" style="border-bottom: 2px solid black;border-right: 2px solid black;">
					    <img align="top" src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path('images/logo-bpkh-s.png'))) }}" width="100px">
					</td>
					<td width="80%" style="border-bottom: 2px solid black;border-right:2px solid black;" colspan="2">
					   <center>
						<p style="font-size: 13;font-family:Arial, Helvetica, sans-serif;margin-bottom:0;font-weight:bold;">RINGKASAN PROPOSAL</p>
                        		    </center>
                        		    <br>
					</td>
				</tr>
				<tr style="border-bottom: 1px solid black">
					<td style="vertical-align: top;" width="20%">Nama Kegiatan</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
					{{ $data->judul_proposal }}
					</td>
                		</tr>
				<tr style="border-bottom: 1px solid black">
					<td style="vertical-align: top" width="20%">Jadwal Pelaksanaan</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
					 {{ date('d M Y H:i', strtotime($pelaksanaanPenilaian->penilaian_datetime)) }}
					</td>
                		</tr>
				<tr style="border-bottom: 1px solid black">
					<td style="vertical-align: top" width="20%">Lokasi</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
					{{ $pelaksanaanPenilaian->lokasi }}

					</td>
                		</tr>
				<tr style="border-bottom: 1px solid black">
					<td style="vertical-align: top" width="20%">Penerima</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
					{{ $data->pemohon_nm }}
					</td>
                		</tr>
				<tr style="line-height: 1rem;border-bottom: 1px solid black">
					<td style="vertical-align: top" width="20%">Tujuan</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
					{{ $deskripsi->tujuan_program }}
					<br>
					<br>
					<br>
					</td>
                </tr>
				<tr style="height: 30px;vertical-align:center;border-bottom: 1px solid black">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Program sesuai Peraturan BPKH dan Perka Kemaslahatan: 
						<input type="checkbox" value="ya" checked> Ya
						<input type="checkbox" value="tidak"> Tidak
					</td>
                </tr>
				<tr style="height: 30px;vertical-align:center;border-bottom: 1px solid black">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-style:bold;font-family:Arial, Helvetica, sans-serif">
						<b>Jumlah dana yang diajukan di dalam proposal (pilih salah satu di bawah):</b>
					</td>
                </tr>
				<tr style="height: 30px;vertical-align:center;border-bottom: 1px solid black">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-style:bold;font-family:Arial, Helvetica, sans-serif">
						<input type="checkbox" value="ya" {{ $data->nominal >= '500000000' ? ' checked' : '' }}>Jumlah sama dengan atau melebihi Rp. 500.000.000,- <br>
						<input type="checkbox" value="ya" {{ $data->nominal < '500000000' ? ' checked' : '' }}>Jumlah kurang dari Rp. 500.000.000,- (Lampiran RAB)
					</td>
                </tr>
				<tr style="height: 30px;vertical-align:center;border-bottom: 1px solid black">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-style:bold;font-family:Arial, Helvetica, sans-serif">
						<b>Indikator manfaat dari suatu kegiatan:</b>
					</td>
                </tr>
				<tr style="height: 30px;vertical-align:center">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-style:bold;font-family:Arial, Helvetica, sans-serif">
						<br>
						<br>
						<br>
						<br>
					</td>
                </tr>
				<tr style="height: 30px;vertical-align:center;border-bottom: 1px solid black">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-style:bold;font-family:Arial, Helvetica, sans-serif">
						Kesimpulan : 
					</td>
                </tr>
				<tr style="height: 30px;vertical-align:center">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-style:bold;font-family:Arial, Helvetica, sans-serif">
						<br>
						<br>
						<br>
						<br>
					</td>
                </tr>
				<tr style="height: 30px;vertical-align:center">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-style:bold;font-family:Arial, Helvetica, sans-serif">
						<center>
							Diketahui oleh: <br>
							Anggota Badan Pelaksana Bidang <br>
							Kemaslahatan: <br>
							Nama :  <br>
							Tanggal :  <br>
						</center>
					</td>
                </tr>
				<tr style="height: 30px;vertical-align:center">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-style:bold;font-family:Arial, Helvetica, sans-serif">
						Dikirim ke Badan Pelaksana untuk persetujuan:      
						<input type="checkbox" value="ya"> YA              
						<input type="checkbox" value="ya"> Tidak
					</td>
                </tr>
			</table>
			<div class="halaman">
			<table class="tabel-data-1" width="100%" style="margin: 3rem">
				<tr>
					<td class="footer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
						&nbsp;&nbsp;</td>
					<td class="footer style="float:right">KEPALA BADAN PELAKSANA<br />
						BADAN PENGELOLA KEUANGAN HAJI <br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ttd<br />
						ANGGITO ABIMANYU</td>
				</tr>
				<tr>
					<td class="footer">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Salinan sesuai dengan aslinya<br />
						&nbsp;&nbsp;BADAN PENGELOLA KEUANGAN HAJI <br>
						Badan Pelaksana Bidang Hukum dan Kepatuhan<br />
						<br />
						<br />
						<br />
						<br />
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HURRIYAH EL ISLAMY</td>
					<td class="footer" style="float:left"></td>
				</tr>
			</table>
			</div>
		</div>
    </body>
</html>
