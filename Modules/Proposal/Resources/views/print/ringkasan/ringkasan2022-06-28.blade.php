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
			
			table, tr {
				border-top: 1px solid black;
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
		</style>
	</head>
	<body>
        <div class="halaman">	
            <table class="tabel-data" width="100%" style="margin: 3rem">>
				<tr>
					<td width="20%" style="border-bottom: 2px solid black;border-right: 2px solid black;">
						<img align="top" src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path('images/logo-bpkh-s.png'))) }}" width="100px">
					</td>
					<td width="80%" style="border-bottom: 2px solid black;border-right:2px solid black;" colspan="2">
					   <center>
						<p style="font-size: 14;font-family:Arial, Helvetica, sans-serif;margin-bottom:0">RINGKASAN PROPOSAL</p>
						{{--<p style="font-size: 14;font-family:Arial, Helvetica, sans-serif;margin-bottom:0">NO FORMULIR</p>--}}
                        		    </center>
                        		    <br>
					</td>
				</tr>
				<tr style="border-bottom: 2px solid black">
					<td style="vertical-align: top" width="20%">Nama Kegiatan</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
					{{ $data->judul_proposal }}
					</td>
                		</tr>
				<tr style="border-bottom: 2px solid black">
					<td style="vertical-align: top" width="20%">Jadwal Pelaksanaan</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
					{{ $data->jadwal_pelaksanaan }}
					</td>
                		</tr>
				<tr>
					<td style="vertical-align: top" width="20%">Lokasi</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
					{{ $data->lokasi }}
					</td>
                </tr>
				<tr style="line-height: 1rem;">
					<td style="vertical-align: top" width="20%">Tujuan</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
					{{ $data->tujuan }}
					<br>
					<br>
					<br>
					</td>
                </tr>
				<tr style="height: 10rem;vertical-align:center">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Program sesuai Peraturan BPKH dan Perka Kemaslahatan: 
					</td>
                </tr>
				<tr style="height: 10rem;vertical-align:center">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-style:bold;font-family:Arial, Helvetica, sans-serif">
						Jumlah dana yang diajukan di dalam proposal (pilih salah satu di bawah):
					</td>
                </tr>
				<tr style="height: 10rem;vertical-align:center">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-style:bold;font-family:Arial, Helvetica, sans-serif">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah sama dengan atau melebihi Rp. 500.000.000,- <br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah kurang dari Rp. 500.000.000,- (Lampiran RAB)
					</td>
                </tr>
				<tr style="height: 10rem;vertical-align:center">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-style:bold;font-family:Arial, Helvetica, sans-serif">
						Indikator manfaat dari suatu kegiatan: 
					</td>
                </tr>
				<tr style="height: 10rem;vertical-align:center">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-style:bold;font-family:Arial, Helvetica, sans-serif">
						<br>
						<br>
						<br>
						<br>
					</td>
                </tr>
				<tr style="height: 10rem;vertical-align:center">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-style:bold;font-family:Arial, Helvetica, sans-serif">
						Kesimpulan
					</td>
                </tr>
				<tr style="height: 10rem;vertical-align:center">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-style:bold;font-family:Arial, Helvetica, sans-serif">
						<br>
						<br>
						<br>
						<br>
					</td>
                </tr>
				<tr style="height: 10rem;vertical-align:center">
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
				<tr style="height: 10rem;vertical-align:center">
					<td style="vertical-align: top" colspan="3" style="font-size: 11pt;font-style:bold;font-family:Arial, Helvetica, sans-serif">
						Dikirim ke Badan Pelaksana untuk persetujuan:      □ Ya               □ Tidak
					</td>
                </tr>
			</table>
			
		</div>
    </body>
</html>
