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

			.tabel-sk{
				border: none; 
				font-size: 12;
				margin: 2rem;
				table-layout:fixed;
			}
		</style>
	</head>
	<body>
        <div class="halaman">	
			<div class="tanda-tangan">
				<table width="100%" style="font-size: 12" style="border: 0px solid #000" border="0">
					<tr>
						<td >
                					<img src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path('images/logo-bpkh-s.png'))) }}" width="250px">
						</td>
						<td>
                					<img src="data:image/png;base64, {{ base64_encode(file_get_contents(storage_path("app/public/pelmonev/pks/$trxpks->photo_mitra"))) }}" width="250px">
						</td>
					</tr>
				</table>
			</div>
			<center style="margin-bottom:0">
                <p style="margin-top: 1rem;text-align: center;letter-spacing: 0px;line-height: 1.5rem;font-style:bold">
                    PERJANJIAN KERJASAMA <br>
                    ANTARA <br>
                    BADAN PENGELOLA KEUANGAN HAJI (BPKH) <br>
                    DAN  <br>
                    {{ $data->mitra_kemaslahatan_nm }} <br>
                    TENTANG <br>
                    DANA KEGIATAN KEMASLAHATAN DALAM BENTUK {{ strtoupper($data->judul_proposal) }} MELALUI {{ strtoupper($data->mitra_kemaslahatan_nm) }} <br>
                    NOMOR : {{ $trxpks ? $trxpks->no_pks_bpkh : ''}} <br>
					NOMOR : {{ $trxpks ? $trxpks->no_pks_mitra : ''}} <br>
                </p>
            </center>
			<hr style="margin: 0%">
            <table class="tabel-sk" width="100%" style="table-layout:fixed; margin-top: 0px;vertical-align: top;text-align: justify;letter-spacing: 0px;line-height: 1.5rem; word-break:break-all; word-wrap:break-word;">
				<tr>
					<td style="" colspan="2" width="100%">
						Pada hari ini, Selasa tanggal delapan bulan Februari tahun dua ribu dua puluh dua (08-02-2022), bertempat di Jakarta, yang bertanda tangan di bawah ini:
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;" width="3cm">I.</td>
					<td style="vertical-align: top;" width="20cm" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						<b>Badan Pengelola Keuangan Haji,</b> 
						berkedudukan dan berkantor di {{ $trxpks ? $trxpks->alamat_bpkh : ''}}, 
						dalam hal ini diwakili oleh {{ $trxpks ? $trxpks->kepala_bpkh : ''}} 
						Dalam jabatannya selaku Kepala Badan Pelaksana Badan Pengelola Keuangan Haji berdasarkan 
						{{ $trxpks ? $trxpks->sk_pengangkatan_kep_bpkh : ''}}, 
						dari dan oleh karenanya sah bertindak untuk dan atas nama Badan Pengelola Keuangan Haji, 
						untuk selanjutnya disebut sebagai <b>"PIHAK PERTAMA"</b>.
					</td>
                </tr>
				<tr style="">
					<td style="vertical-align: top" width="1%">II.</td>
					<td style="vertical-align: top" width="98%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						<b>{{ $data->mitra_kemaslahatan_nm }},</b> 
						berkedudukan di {{ $data->address }}, 
						suatu Lembaga pemerintah nonstruktural yang didirikan berdasarkan {{$trxpks ? $trxpks->sk_pendirian_mitra : ''}}
						untuk selanjutnya disebut sebagai <b>"PIHAK KEDUA"</b>.
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
						<br>
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
					<td style="vertical-align: top;" width="1%">1.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Bahwa PIHAK PERTAMA adalah badan hukum publik yang dibentuk berdasarkan Undang-Undang Nomor 34 Tahun 2014 tentang Pengelolaan Keuangan Haji yang melaksanakan fungsi pengelolaan Keuangan Haji, salah satu diantaranya berupa penyelenggaraan Program Kegiatan Kemaslahatan Umat Islam; 
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">2.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Bahwa PIHAK KEDUA adalah merupakan institusi yang telah ditetapkan oleh PIHAK PERTAMA sebagai Mitra Kemaslahatan sesuai ketentuan yang berlaku;
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">3.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Bahwa Para Pihak telah sepakat untuk melaksanakan kerjasama Program Kegiatan Kemaslahatan Umat Islam dalam bentuk pemberian Dana Kegiatan Kemasalahatan kepada PIHAK KEDUA, sebagaimana terlampir dalam Proposal yang telah disetujui oleh PIHAK PERTAMA
					</td>
                </tr>
				<tr>
					<td width="100%" style="" colspan="2">
						<br>
						Oleh karena itu dengan memperhatikan hal-hal tersebut di atas, 
						PIHAK PERTAMA dan PIHAK KEDUA dengan ini sepakat dan setuju untuk melakukan kerjasama berdasarkan persyaratan dan ketentuan 
						sebagaimana diatur dalam Perjanjian Kerjasama (selanjutnya disebut sebagai <b>Perjanjian</b>) ini  sebagai berikut:
					</td>
				</tr>
				{{-- pasal 1 --}}
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
					<td style="vertical-align: top;" width="1cm">a.</td>
					<td style="vertical-align: top;" width="9cm" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						sebagai ikatan antara Para Pihak dalam pelaksanaan Kegiatan Kemaslahatan;
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">b.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						sebagai acuan dan untuk tujuan pemantauan dan evaluasi pelaksanaan Kegiatan Kemaslahatan yang dilaksanakan oleh PIHAK KEDUA; dan
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">c.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						memastikan Kegiatan Kemaslahatan yang dilaksanakan oleh PIHAK KEDUA sesuai dengan amanat Undang-undang Nomor 34 Tahun 2014 tentang Pengelolaan Keuangan Haji.
					</td>
                </tr>

				{{-- pasal 2 --}}
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
					<td style="vertical-align: top;" width="1%">1.	</td>
					<td style="vertical-align: top;" width="99%"style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Ruang lingkup Perjanjian ini adalah Kegiatan Kemaslahatan sebagaimana ditetapkan dalam Surat Keputusan PIHAK PERTAMA dan dijelaskan lebih lanjut dalam Perjanjian ini.
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">2.	</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Pelaksanaan Kegiatan Kemaslahatan tunduk pada syarat dan ketentuan dalam peraturan-peraturan PIHAK PERTAMA yang berlaku mengenai Kegiatan Kemaslahatan, Perjanjian dan Proposal serta jadwal kegiatan pelaksanaan. Dalam proses pelaksanaan Kegiatan Kemaslahatan, PIHAK KEDUA mengerti dan setuju bahwa PIHAK KEDUA akan tunduk dan mematuhi instruksi tertulis dari PIHAK PERTAMA (jika ada).
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">3.	</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Perjanjian ini terdiri dari Perjanjian dan lampiran-lampirannya, merupakan kesatuan yang tidak dapat dipisahkan. Dalam hal terjadi perbedaan satu dan lainnya, maka ketentuan yang berlaku adalah sesuai hierarki di bawah ini:<br>
						&nbsp;&nbsp;&nbsp;a.	Undang-Undang Nomor 34 Tahun 2014 tentang Pengelolaan Keuangan Haji.<br>
						&nbsp;&nbsp;&nbsp;b.	Peraturan Pemerintah Nomor 5 Tahun 2018 tentang Pelaksanaan Undang-Undang Nomor 34 Tahun 2014 tetang Pengelolaan Keuangan Haji.<br>
						&nbsp;&nbsp;&nbsp;c.	Peraturan BPKH No. 7 Tahun 2018 tentang Penetapan Prioritas Kegiatan Kemaslahatan Dan Penggunaan Nilai Manfaat Dana Abadi Umat, berikut perubahan-perubahannya. <br>
						&nbsp;&nbsp;&nbsp;d.	Surat Keputusan Penetapan Kegiatan Kemaslahatan.<br>
						&nbsp;&nbsp;&nbsp;e.	Perjanjian.<br>
						&nbsp;&nbsp;&nbsp;f.	Surat Pernyataan Tanggung Jawab Mutlak.<br>
						&nbsp;&nbsp;&nbsp;g.	Surat Persetujuan.<br>

					</td>
                </tr>

				{{-- pasal 3  --}}
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
					<td style="vertical-align: top;" width="1%">1.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						PIHAK PERTAMA memberikan Dana Kegiatan Kemaslahatan kepada PIHAK KEDUA sebesar 
						{!! rupiah($data->nominal)." (<i>".terbilang($data->nominal)." rupiah</i>)" !!}
						sebagai Dana Program Kemaslahatan dalam bentuk <b>{{ $data->judul_proposal }}</b> melalui <b>{{ $data->mitra_kemaslahatan_nm }} </b>
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">2.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Pelaksanaan Kegiatan sebagaimana dimaksud pada ayat 1 dilakukan sesuai dengan Proposal yang telah disetujui oleh PIHAK PERTAMA melalui Keputusan Kepala Badan Pelaksana Nomor {{ $trxpks ? $trxpks->no_sk_bpkh : ''}}.
					</td>
                </tr>

				{{-- pasal 4  --}}
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
					<td style="vertical-align: top;" width="1%">1.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Dana Kegiatan Kemaslahatan dalam Perjanjian ini adalah nilai manfaat dari pengembangan Dana Abadi Umat (DAU) yang diberikan oleh PIHAK PERTAMA kepada Mitra Kemaslahatan (PIHAK KEDUA) dalam rangka Kegiatan Kemaslahatan sesuai dengan ketentuan peraturan perundang-undangan yang berlaku.
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">2.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Mekanisme pencairan Dana Kegiatan Kemaslahatan yang akan diberikan kepada PIHAK KEDUA, wajib dilaksanakan sesuai dengan ketentuan peraturan perundangan yang berlaku.
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">3.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Pencairan bantuan sebagaimana dimaksud pada ayat (1) ini dilakukan oleh PIHAK PERTAMA melalui pemindahbukuan secara sekaligus ke rekening PIHAK KEDUA yang telah teregistrasi sesuai ketentuan yang berlaku.
					</td>
                </tr>

				{{-- pasal 5  --}}
				<tr>
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
					<td style="vertical-align: top;" width="1%">a.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Menggunakan Dana Kegiatan Kemaslahatan untuk membeli/mengadakan barang/jasa dan bertanggung jawab mutlak atas penggunaan Dana Kegiatan Kemaslahatan tersebut sesuai dengan Surat Keputusan PIHAK PERTAMA dan ketentuan-ketentuan ditetapkan dalam Perjanjian ini
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">b.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Menyampaikan rincian pengeluaran Dana Kegiatan Kemaslahatan yang dimasukkan dalam laporan pertanggungjawaban.
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">c.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Menghentikan kegiatan dalam hal PIHAK KEDUA menghadapi situasi yang memerlukan deviasi dari persyaratan dan persetujuan yang ditetapkan PIHAK PERTAMA, sampai dengan menerima instruksi tertulis secara khusus dari PIHAK PERTAMA mengenai penanganan yang dikehendaki terkait pengelolaan Dana Kegiatan Kemaslahatan oleh PIHAK KEDUA dimaksud.
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">d.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Setiap adanya potensi perbedaan pelaksanaan kegiatan dari persetujuan yang telah disetujui PIHAK PERTAMA yang berdampak pada perbedaan dengan desain awal yang telah disetujui agar dimintakan persetujuan kepada PIHAK PERTAMA secara tertulis.
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">e.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Memberikan data dan informasi yang diperlukan kepada PIHAK PERTAMA dalam pelaksanaan pemantauan dan evaluasi di lokasi Kegiatan Kemaslahatan.
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">f.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Menyampaikan laporan awal, laporan perkembangan, dan laporan pertanggungjawaban akhir Kegiatan Kemaslahatan kepada PIHAK PERTAMA.
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">g.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Laporan Pertanggungjawaban akhir Kegiatan Kemaslahatan kepada PIHAK PERTAMA sesuai ketentuan peraturan yang berlaku pada PIHAK PERTAMA.
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">h.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Memastikan <i>branding</i> institusi PIHAK PERTAMA dalam pelaksanaan Kegiatan Kemaslahatan yang dilaksanakan oleh PIHAK KEDUA dalam bentuk namun tidak terbatas pada pencantuman logo pada prasasti dan media lainnya.
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">i.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						PIHAK KEDUA agar menyiapkan dokumen bukti pelaksanaan pemberian bantuan berupa tanda terima dan/atau foto kegiatan sesuai ketentuan yang ditentukan termasuk bukti dokumentasi <i>branding</i> PIHAK PERTAMA dalam kegiatan tersebut;
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">j.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Mengembalikan Dana Kegiatan Kemaslahatan yang penggunaannya tidak sesuai tujuan Kegiatan Kemaslahatan sebagaimana dimaksud dalam Surat Keputusan dan Proposal yang telah disetujui oleh PIHAK PERTAMA, dalam jangka waktu paling lama 30 hari, setelah diketahui oleh PIHAK PERTAMA atau pihak yang ditunjuk oleh PIHAK PERTAMA dalam proses pemantauan dan evaluasi atas penggunaan Dana Kegiatan Kemaslahatan dimaksud.
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">k.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Mengembalikan sisa Dana Kegiatan Kemaslahatan, dalam hal terdapat sisa Dana Kegiatan Kemaslahatan dari pelaksanaan Kegiatan Kemaslahatan, ke rekening PIHAK PERTAMA. 
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">l.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Penggunaan komponen biaya operasional PIHAK KEDUA (Mitra Kemaslahatan) meliputi:
						<br>&nbsp;&nbsp;&nbsp;&nbsp;1)	Asesmen dan Visitasi;
						<br>&nbsp;&nbsp;&nbsp;&nbsp;2)	Pembuatan Proposal;
						<br>&nbsp;&nbsp;&nbsp;&nbsp;3)	Honor Pegawai Mitra Kemaslahatan;
						<br>&nbsp;&nbsp;&nbsp;&nbsp;4)	Biaya Komunikasi dan Transportasi;
						<br>&nbsp;&nbsp;&nbsp;&nbsp;5)	Monitoring dan Evaluasi; dan
						<br>&nbsp;&nbsp;&nbsp;&nbsp;6)	<i>Branding</i>
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">m.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						PIHAK KEDUA memastikan bahwa PIHAK KEDUA dan/atau Kelompok Penerima Manfaat mendukung program unggulan PIHAK PERTAMA, termasuk tapi tidak terbatas pada:
						<br>&nbsp;&nbsp;&nbsp;&nbsp;1)	Sosialisasi Kampanye Haji Muda;
						<br>&nbsp;&nbsp;&nbsp;&nbsp;2)	<i>Intangible benefit</i> program di lingkungan PIHAK KEDUA dan Kelompok Penerima Manfaat untuk <i>branding</i> logo PIHAK PERTAMA menggunakan media yang dimiliki PIHAK KEDUA dan/atau Kelompok Penerima Manfaat seperti sekolah, kampus, cetakan, souvenir, buku, dan/atau media lainnya.
					</td>
                </tr>

				{{-- pasal 6  --}}
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
					<td style="vertical-align: top;" width="1%">1.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Perjanjian ini mulai berlaku sejak tanggal ditandatangani, sampai dengan PIHAK PERTAMA telah menyetujui laporan pertanggungjawaban akhir dari PIHAK KEDUA, selambat-lambatnya pada tanggal {{ $trxpks ? date('d M Y', strtotime($trxpks->start_date_timeline)) . ' s.d. ' . date('d M Y', strtotime($trxpks->start_date_timeline)) : ''}}.
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">2.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Dalam hal PIHAK KEDUA melakukan pelaksanaan kegiatan kemaslahatan tersebut harus sesuai dengan jadwal yang telah disepakati tersebut.
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">3.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						PIHAK PERTAMA dapat mengakhiri Perjanjian ini sebelum jangka waktu Perjanjian berakhir dalam hal PIHAK KEDUA melakukan tindakan-tindakan yang melanggar Perjanjian ini. 
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">4.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Dalam hal pengakhiran Perjanjian sebagaimana dimaksud pada ayat (2) Pasal ini, maka PIHAK KEDUA wajib mengembalikan Dana Kegiatan Kemaslahatan yang sudah diterima kepada PIHAK PERTAMA.
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">5.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						PIHAK KEDUA dapat mengakhiri Perjanjian sebelum berakhirnya jangka waktu Perjanjian sebagaimana dimaksud ayat (1) Pasal ini, dengan pemberitahuan secara tertulis selambat-lambatnya 30 (tiga puluh) hari sebelum efektif pengakhiran, dan atas pengakhiran Perjanjian oleh PIHAK KEDUA tersebut, maka PIHAK KEDUA wajib mengembalikan Dana Kegiatan Kemaslahatan.
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">6.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Dalam hal dibutuhkan perubahan atas Jangka Waktu Perjanjian, PIHAK KEDUA menyampaikan permintaan perubahan kepada PIHAK PERTAMA secara tertulis selambat-lambatnya 30 (tiga puluh hari) sebelum efektif perubahan tersebut untuk dilakukan persetujuan oleh PIHAK PERTAMA.
					</td>
                </tr>

				{{-- pasal 7  --}}
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
					<td style="vertical-align: top;" width="1%">1.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Dalam hal tejadi perselisihan mengenai pelaksanaan dan penafsiran yang timbul sehubungan dengan Perjanjian ini, Para Pihak sepakat untuk terlebih dahulu akan berupaya menyelesaikan perselisihan tersebut dengan cara musyawarah untuk mencapai mufakat, baik dengan menggunakan jasa mediator independen maupun melalui pembicaraan antara wakil-wakil dari masing-masing Pihak.
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">2.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Apabila penyelesaian secara musyawarah tidak berhasil mencapai mufakat sampai dengan 30 (tiga puluh) Hari Kalender sejak dimulainya musyawarah tersebut, maka Para Pihak sepakat untuk menyelesaikan perselisihan tersebut melalui Badan Arbitrase Syariah Nasional (Basyarnas) Untuk kemudian eksekusinya dapat dilaksanakan melalui Pengadilan Negeri sesuai dengan keputusan Basyarnas.
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">3.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Sebelum ada keputusan yang berkekuatan hukum tetap, selama proses penyelesaian perselisihan, Para Pihak tetap wajib melaksanakan kewajibannya menurut Perjanjian ini.
					</td>
                </tr>


				{{-- pasal 8  --}}
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
					<td style="vertical-align: top;" width="1%">1.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Apabila terjadi hal-hal yang diluar kekuasaan Para Pihak atau force majeure, dapat dipertimbangkan kemungkinan perubahan tempat dan waktu pelaksanaan tugas pekerjaan dengan persetujuan kedua belah Pihak.
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">2.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						2.	Yang termasuk force majeure adalah: <br>
						&nbsp;&nbsp;&nbsp;&nbsp;a.	Bencana alam;  <br>
						&nbsp;&nbsp;&nbsp;&nbsp;b.	Tindakan pemerintah di bidang fiskal dan moneter;<br>
						&nbsp;&nbsp;&nbsp;&nbsp;c.	Keadaan kemanan yang tidak mengizinkan;<br>
						&nbsp;&nbsp;&nbsp;&nbsp;d.	Bencana non alam<br>
					</td>
                </tr>
				<tr>
					<td style="vertical-align: top;" width="1%">3.</td>
					<td style="vertical-align: top;" width="99%" style="font-size: 11pt;font-family:Arial, Helvetica, sans-serif">
						Segala perubahan dan/atau pembatalan terhadap Perjanjian ini akan diatur bersama kemudian oleh PIHAK PERTAMA dan PIHAK KEDUA.
					</td>
				</tr>

				{{-- pasal 9  --}}
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
			</table>
			<div class="tanda-tangan">
				<table width="100%" style="font-size: 12" style="border: none">
					<tr>
						<td style="width: 50%;"><b>PIHAK PERTAMA, <br> BADAN PENGELOLA KEUANGAN HAJI </b></td>
						<td style="width: 50%;"><b>PIHAK KEDUA, <br> {{ $data->mitra_kemaslahatan_nm }}</b></td>
					</tr>
					<tr>
						<td style="vertical-align: top;"> 
							<br>
							<br>
							<br>
							<br>
							<br>
							Dr. Anggito Abimanyu, M.Sc. <br>
							Kepala Badan Pelaksana
						</td>
						<td style="vertical-align: top;">
							<br>
							<br>
							<br>
							<br>
							<br>
							{{ $data->penanggung_jawab_nm }}<br>
							{{ $data->penanggung_jawab_jabatan }}
						</td>
					</tr>
				</table>
			</div>
		</div>
    </body>
</html>
