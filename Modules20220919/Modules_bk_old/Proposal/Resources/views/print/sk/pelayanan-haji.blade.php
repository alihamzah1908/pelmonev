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
				border-collapse: collapse;
			}
			
			table, th, td {
				border: 1px solid black;
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
			
			.tanda-tangan table, th, td {
				border: none;
			}

			.tabel-data{
				border-collapse: collapse; 
				border: 1px solid black; 
				font-size: 8;
			}

			.tabel-sk{
				border: none; 
				font-size: 12;
				margin: 5rem;
			}
		</style>
	</head>
	<body>
        <div class="halaman">	
            <center style="margin-bottom:0">
                <img align="top" src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path('storage/images/pancasila.png'))) }}" width="100px">
                <p style="margin-top: 30px;text-align: center;letter-spacing: 0px;line-height: 1.5rem;">
                    BADAN PENGELOLA KEUANGAN HAJI <br>
                    KEPUTUSAN KEPALA BADAN PELAKSANA <br>
                    BADAN PENGELOLA KEUANGAN HAJI <br>
                    NOMOR  <br>
                    TENTANG <br>
                    KEGIATAN KEMASLAHATAN UMAT ISLAM DALAM BENTUK {{ strtoupper($data->judul_proposal) }} MELALUI {{ strtoupper($data->mitra_kemaslahatan_nm) }} <br><br>
                    DENGAN RAHMAT TUHAN YANG MAHA ESA <br><br>
                    KEPALA BADAN PELAKSANA BADAN PENGELOLA KEUANGAN HAJI, <br>
                </p>
            </center>

			<table class="tabel-sk" width="100%" style="margin-top: 30px;vertical-align: top;text-align: justify;letter-spacing: 0px;line-height: 1.5rem;">
				<tr>
					<td style="vertical-align: top" width="20%" rowspan="4">Menimbang</td>
					<td style="vertical-align: top" width="5%">a.</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
                        bahwa Kegiatan  dalam  rangka  memberikan dukungan, meningkatkan  pelayanan bagi jamaah haji dan umroh baik sebelum, selama dan pasca kegiatan ibadah haji dan umroh, maka diperlukan adanya sarana prasarana ibadah haji dan umroh di dalam dan/atau di luar negeri;
                    </td>
                </tr>
				<tr>
					<td style="vertical-align: top" width="5%">b.</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
                        bahwa bantuan sebagaimana dimaksud dalam huruf a diberikan melalui {{ strtoupper($data->mitra_kemaslahatan_nm) }} selaku Mitra Kemaslahatan;
                    </td>
                </tr>
				<tr>
					<td style="vertical-align: top" width="5%">c.</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						bahwa Badan Pelaksana menyetujui proposal kegiatan kemaslahatan dalam bentuk {{ strtoupper($data->judul_proposal) }} melalui {{ strtoupper($data->mitra_kemaslahatan_nm) }} dalam Rapat Badan Pelaksana pada tanggal ;
                    </td>
                </tr>
				<tr>
					<td style="vertical-align: top" width="5%">d.</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
                        bahwa berdasarkan pertimbangan sebagaimana dimaksud dalam huruf a, huruf b, dan huruf c, perlu ditetapkan dalam Keputusan Kepala Badan Pelaksana Badan Pengelola Keuangan Haji;
                    </td>
                </tr>
			</table>
		</div>
		<pagebreak></pagebreak>
		<div class="halaman">	
			<table class="tabel-sk" width="100%" style="margin-top: 30px;vertical-align: top;text-align: justify;letter-spacing: 0px;line-height: 1.5rem;">
				<tr>
					<td style="vertical-align: top" width="20%" rowspan="5">Mengingat</td>
					<td style="vertical-align: top" width="5%">1.</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Undang-Undang Nomor 34 Tahun 2014 tentang Pengelolaan Keuangan Haji (Lembaran Negara Republik Indonesia Tahun 2014 Nomor 296, Tambahan Lembaran Negara Republik Indonesia Nomor 5605);
                    </td>
                </tr>
				<tr>
					<td style="vertical-align: top" width="5%">2.</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
                        Peraturan Pemerintah Nomor 5 Tahun 2018 tentang Pelaksanaan Undang-Undang Nomor 34 Tahun 2014 tentang Pengelolaan Keuangan Haji (Lembaran Negara Republik Indonesia Tahun 2018 Nomor 13, Tambahan Lembaran Negara Republik Indonesia Nomor 6182);
                    </td>
                </tr>
				<tr>
					<td style="vertical-align: top" width="5%">3.</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Peraturan Presiden Nomor 110 Tahun 2017 tentang Badan Pengelola Keuangan Haji (Lembaran Negara Republik Indonesia Tahun 2017 Nomor 253);
                    </td>
                </tr>
				<tr>
					<td style="vertical-align: top" width="5%">4.</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
                        Peraturan Badan Pengelola Keuangan Haji Nomor 7 Tahun 2018 tentang Penetapan Prioritas Kegiatan Kemaslahatan Dan Penggunaan Nilai Manfaat Dana Abadi Umat (Berita Negara Republik Indonesia Tahun 2018 Nomor 1301) sebagaimana telah beberapa kali diubah terakhir dengan Peraturan Badan Pengelola Keuangan Haji Nomor 4 Tahun 2020 tentang Perubahan Kedua atas Peraturan Badan Pengelola Keuangan Haji Nomor 7 Tahun 2018 tentang Penetapan Prioritas Kegiatan Kemaslahatan Dan Penggunaan Nilai Manfaat Dana Abadi Umat (Berita Negara Republik Indonesia Tahun 2020 Nomor 409);
                    </td>
                </tr>
				<tr>
					<td style="vertical-align: top" width="5%">5.</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Peraturan Kepala Badan Pelaksana Badan Pengelola Keuangan Haji Nomor 3 Tahun 2020 tentang Pedoman Teknis Kegiatan Kemaslahatan sebagaimana telah beberapa kali diubah terakhir dengan Peraturan Kepala Badan Pelaksana Badan Pengelola Keuangan Haji Nomor 11 Tahun 2021 tentang Perubahan Kelima atas Peraturan Kepala Badan Pelaksana Badan Pengelola Keuangan Haji Nomor 3 Tahun 2020 tentang Pedoman Teknis Kegiatan Kemaslahatan;
                    </td>
                </tr>
			</table>
		</div>
		<pagebreak></pagebreak>
		<div class="halaman">
			<center>
				<p style="margin-top: 30px;text-align: center;letter-spacing: 0px;line-height: 1.5rem;">
                    MEMUTUSKAN: <br>
				</p>
			</center>
			<table class="tabel-sk" width="100%" style="margin-top: 30px;vertical-align: top;text-align: justify;letter-spacing: 0px;line-height: 1.5rem;">
				<tr>
					<td style="vertical-align: top" width="20%">Menetapkan</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						KEPUTUSAN KEPALA BADAN PELAKSANA BADAN PENGELOLA KEUANGAN HAJI TENTANG KEGIATAN KEMASLAHATAN UMAT ISLAM DALAM BENTUK 
						{{ strtoupper($data->judul_proposal) }} MELALUI {{ strtoupper($data->mitra_kemaslahatan_nm) }}.
                    </td>
                </tr>
				<tr>
					<td style="vertical-align: top" width="20%">KESATU</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Menetapkan Kegiatan Kemaslahatan dalam bentuk 
						{{ $data->judul_proposal }} sebesar {{ rupiah($data->nominal) }} ({{ terbilang($data->nominal) }} rupiah).
                    </td>
                </tr>
				<tr>
					<td style="vertical-align: top" width="20%">KEDUA</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Pemberian bantuan dana sebagaimana dimaksud dalam Diktum KESATU disalurkan melalui {{ strtoupper($data->mitra_kemaslahatan_nm) }} selaku Mitra Kemaslahatan. 
                    </td>
                </tr>
				<tr>
					<td style="vertical-align: top" width="20%">KETIGA</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Jangka waktu pelaksanaan Kegiatan Kemaslahatan adalah sebagaimana tercantum dalam Proposal yang telah disetujui oleh Badan Pelaksana.
                    </td>
                </tr>
				<tr>
					<td style="vertical-align: top" width="20%">KEEMPAT</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Selain pengeluaran pelaksanaan Kegiatan Kemaslahatan sebagaimana dimaksud dalam Diktum KESATU, segala biaya yang timbul akibat Keputusan ini dibebankan kepada Rencana Kerja dan Anggaran Bidang Kemaslahatan Tahun 2021.
                    </td>
                </tr>
				<tr>
					<td style="vertical-align: top" width="20%">KELIMA</td>
					<td style="vertical-align: top" width="5%">:</td>
					<td style="vertical-align: top" width="75%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Keputusan ini mulai berlaku pada tanggal ditetapkan.
                    </td>
                </tr>
			</table>
			<div class="tanda-tangan">
				<table width="100%" style="font-size: 12" style="border: none">
					<tr>
						<td style="width: 50%;">&nbsp;</td>
						<td style="width: 50%;"></td>
					</tr>
					<tr>
						<td> 
						</td>
						<td style="vertical-align: top;">
								Ditetapkan di Jakarta<br>
								pada tanggal <br><br>
								KEPALA BADAN PELAKSANA <br>
								BADAN PENGELOLA KEUANGAN HAJI<br>
								<br>
								<br>
								<br>
								<br>
								ANGGITO ABIMANYU 
						</td>
					</tr>
				</table>
			</div>
        </div>

    </body>
</html>
