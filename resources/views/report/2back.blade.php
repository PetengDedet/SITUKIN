<style type="text/css">
	.tg  {border-collapse:collapse;border-spacing:0;}
	.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
	.tg th{background:#eee;font-family:Arial, sans-serif;font-size:14px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:break-all;}
	.tg .tg-0ord{text-align:right}
	.tg .tg-s6z2{text-align:center}
	.tg .tg-baqh{text-align:center;vertical-align:top}
	.tg .tg-e3zv{font-weight:bold}
	.tg .tg-lqy6{text-align:right;vertical-align:top}
	.tg .tg-hgcj{font-weight:bold;text-align:center}
	.tg .tg-9hbo{font-weight:bold;vertical-align:top}
	.tg .tg-yw4l{vertical-align:top}

</style>

	<?php 
		$status = true;
		$max = 9;
	?>
	@for($i = 1; $i<=$max; $i++)
		@if($status)
			<?php
				$status = false;
			?>
			<table class="tg">
				<tr>
					<td colspan="13" style="border:0px;">
					<div style="text-align: center;">
						KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN<br>
						DAFTAR PEMBAYARAN TUNJANGAN KINERJA<br>
						BULAN : SEPTEMBER 2016
					</div>
					<table width="100%">
						<tr>
							<td  style="border:0px;padding: 0px;" align="left">UNIT ORGANISASI: KEMENTERIAN KOODINATOR BIDANG PEREKONOMIAN</td>
							<td  style="border:0px;padding: 0px;" align="right">TGL PROSES: 29-8-2016</td>
						</tr>
					</table>
					</td>
				</tr>

				<tr>	
					<th class="tg-hgcj" rowspan="2">N<br>O<br>.<br>U<br>R<br>U<br>T</th>
					<th class="tg-hgcj">NAMA</th>
					<th class="tg-hgcj" rowspan="2">E<br>S<br>E<br>L<br>O<br>N</th>
					<th class="tg-hgcj" rowspan="2"><br>G<br>O<br>L<br>O<br>N<br>G<br>A<br>N</th>
					<th class="tg-hgcj" colspan="2">SUSUNAN<br>KELUARGA</th>
					<th class="tg-hgcj" rowspan="2" style="max-width: 10px;">K<br>E<br>L<br>A<br>S<br><br>J<br>A<br>B<br>A<br>T<br>A<br>N</th>
					<th class="tg-9hbo" style="text-align: left;width: 110px;" rowspan="2">
						A. GAJI POKOK<br><br>
						B. TUNJANGAN<br>
						STRUKTURAL/<br>FUNGSIONAL/<br>UMUM<br><br>
						C. GAJI KOTOR<br>
					</th>
					<th class="tg-9hbo" style="text-align: left;width: 110px;" rowspan="2">D. TUNJANGAN<br>KINERJA<br><br>E. TUNJANGAN<br>PENYESUAIAN<br>PENGHASILAN<br><br>F. TUNJANGAN<br>KHUSUS<br><br>G. POT ABSEN<br>(%)</th>
					<th class="tg-9hbo" style="text-align: left;width: 110px;" rowspan="2">H. TUNJANGAN<br>KINERJA BERSIH<br>(D+E+F-G)<br><br>I. TUNJANGAN PPH 21<br><br>J. TUNJANGAN KINERJA KOTOR (H+1)<br><br>K. POT PPH 21</th>
					<th class="tg-9hbo" style="text-align: left;width: 110px;" rowspan="2">TUNJANGAN KINERJA YANG DIBAYARKAN (J-K)</th>
					<th class="tg-hgcj" rowspan="2">REKENING</th>
					<th class="tg-hgcj" rowspan="2">KETERANGAN</th>
				</tr>
				<tr>
					<th class="tg-hgcj">NIP</th>
					<th class="tg-e3zv">STATUS KAWIN</th>
					<th class="tg-e3zv">JUMLAH ANAK</th>
				</tr>
				<tr>
					<td class="tg-hgcj">1</td>
					<td class="tg-hgcj">2</td>
					<td class="tg-hgcj">3</td>
					<td class="tg-hgcj">4</td>
					<td class="tg-hgcj">5</td>
					<td class="tg-hgcj">6</td>
					<td class="tg-hgcj">7</td>
					<td class="tg-hgcj">8</td>
					<td class="tg-hgcj">9</td>
					<td class="tg-hgcj">10</td>
					<td class="tg-hgcj">11</td>
					<td class="tg-hgcj">12</td>
					<td class="tg-hgcj">13</td>
				</tr>
		@endif
		<tr>
			<td class="tg-s6z2">1.</td>
			<td class="tg-yw4l">EMANUEL CHRISTIANTOKO<br>NIP. 100000000000</td>
			<td class="tg-baqh">I.B</td>
			<td class="tg-baqh">IV/E</td>
			<td class="tg-baqh">K1</td>
			<td class="tg-baqh"></td>
			<td class="tg-baqh">16</td>
			<td class="tg-lqy6">3.228.300<br>4.375.000<br>8.065.713</td>
			<td class="tg-lqy6">24.405.000<br>0<br>0<br>0<br>( 0% )</td>
			<td class="tg-lqy6">24.405.000<br>4,443,105<br>28,848,105<br>4,443,105</td>
			<td class="tg-lqy6">24.405.000</td>
			<td class="tg-yw4l">050701016367509</td>
			<td class="tg-031e"></td>
		</tr>

		
		@if($i % 2 == 0 || $i == $max)
		<?php
			$status = true;
		?>
				<tr>
					<td class="tg-031e" colspan="7">JUMLAH LEMBAR KE :{{$i}}</td>
					<td class="tg-0ord">6,456,600,<br>8,750,000<br>16,131,426</td>
					<td class="tg-0ord">48,810,000<br>0<br>0<br>0</td>
					<td class="tg-0ord">48,810,000<br>8,886,210<br>57,696,210<br>8,886,210</td>
					<td class="tg-0ord">48,810,000</td>
					<td class="tg-031e"></td>
					<td class="tg-031e"></td>
				</tr>
			</table>
		@endif
	@endfor