<style type="text/css">
.teacherPage {
   /*page: teacher;*/
   page-break-after: always;
}
.ndas  {border-collapse:collapse;border-spacing:0;width: 100%}
.ndas td{
  font-family:Arial, sans-serif;
  font-size:12px;
  padding:2px;
/*  border-style:solid;
  border-width:1px;*/
  overflow:hidden;
  word-break:normal;
}
.ndas th{
  font-family:Arial, sans-serif;
  font-size:12px;
  font-weight:normal;
  padding:2px;
/*  border-style:solid;
  border-width:1px;*/
  overflow:hidden;
  word-break:normal;
  text-align: left;
}
</style>
<?php 
    $max = count($data['pegawai']);
?>
@for($i=1; $i<=$max;$i++)
<table class="ndas">
	<tr>
		<th style="text-align: center;">KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN</th>
	</tr>
	<tr>
		<th style="text-align: center;">TANDA TERIMA PEMBAYARAN TUNJANGAN KINERJA</th>
	</tr>
</table>

<style type="text/css">
.tg  {
	width: 100%;
	margin-top: 20px;
	border-collapse:collapse;
	border-spacing:0;
	border-top: 1px double #000; 
	border-bottom: 1px double #000; 
}
.tg td{
	font-family:Arial, sans-serif;
	font-size:12px;
	padding:5px;
	/*border-style:solid;
	border-width:1px;*/
	overflow:hidden;
	word-break:normal;
}
</style>

<table class="tg">
  <tr>
    <td class="tg-031e">BULAN</td>
    <td class="tg-031e" width="10px">:</td>
    <td class="tg-031e">{{strtoupper(date('F Y'))}} </td>
  </tr>
  <tr>
    <td class="tg-031e">NIP/NAMA</td>
    <td class="tg-031e" width="10px">:</td>
    <td class="tg-031e">{{$data['pegawai'][$i]->nip}} / {{$data['pegawai'][$i]->name}}</td>
  </tr>
  <tr>
    <td class="tg-031e">NOMOR REKENING</td>
    <td class="tg-031e" width="10px">:</td>
    <td class="tg-031e">{{$data['pegawai'][$i]->rekening}}</td>
  </tr>
  <tr>
    <td class="tg-031e" style="width: 185px;">GOL/PERINGKAT JABATAN</td>
    <td class="tg-031e">:</td>
    <td class="tg-031e">
    <?php
      $dataExplode =  explode('(', $data['pegawai'][$i]->golongan);
      $explodeAgain = explode(')', $dataExplode[1] );
      echo $explodeAgain[0];
    ?> 
    /
    {{$data['pegawai'][$i]->kelas_jabatan}}</td>
  </tr>
  <tr>
    <td class="tg-031e">UNIT KERJA</td>
    <td class="tg-031e">:</td>
    <td class="tg-031e">{{$data['unit'][$i]->nama_unit}}</td>
  </tr>
</table>


<style type="text/css">
.duit  {
	width: 100%;
	margin-top: 20px;
	border-collapse:collapse;
	border-spacing:0;
}
.duit td{
	font-family:Arial, sans-serif;
	font-size:12px;
	padding:5px;
	overflow:hidden;
	word-break:normal;
}
</style>
<?php
  $persentaseKinerja = ($data['dataKinerja'][$i]->persentase / 100);
?>
<table class="duit">
  <tr>
    <td class="duit-031e" style="width: 20%"></td>
    <td class="duit-031e" width="25%">TUNJANGAN KINERJA</td>
    <td class="duit-031e">:</td>
    <td class="duit-031e">Rp.</td>
    <td class="duit-yw4l" style="text-align: right;" width="25%">{{number_format($data['grade'][$i]->tunjangan_kinerja * $persentaseKinerja,0,',','.')}}</td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l" style="width: 20%;	"></td>
  </tr>
  <tr>
    <td class="duit-yw4l" style="width: 20%"></td>
    <td class="duit-031e" >TUNJANGAN PENYESUAIAN PENGHASILAN</td>
    <td class="duit-031e">:</td>
    <td class="duit-031e">Rp.</td>
    <td class="duit-yw4l" style="text-align: right;">0</td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l" style="width: 20%;	"></td>
  </tr>
  <tr>
    <td class="duit-yw4l" style="width: 20%"></td>
    <td class="duit-031e">TUNJANGAN TAMBAHAN KHUSUS</td>
    <td class="duit-031e">:</td>
    <td class="duit-031e">Rp.</td>
    <td class="duit-yw4l" style="text-align: right;">0</td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l" style="width: 20%;	"></td>
  </tr>
  <tr>
    <td class="duit-yw4l" style="width: 20%"></td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l" style="padding: 0px;"><hr></td>
    <td class="duit-yw4l">+</td>
    <td class="duit-yw4l" style="width: 20%;	"></td>
  </tr>
  <tr>
    <td class="duit-yw4l" style="width: 20%"></td>
    <td class="duit-031e">JUMLAH</td>
    <td class="duit-031e">:</td>
    <td class="duit-031e">Rp.</td>
    <td class="duit-yw4l" style="text-align: right;">{{number_format($data['grade'][$i]->tunjangan_kinerja,0,',','.')}}</td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l" style="width: 20%;	"></td>
  </tr>
  <tr>
    <td class="duit-yw4l" style="width: 20%"></td>
    <td class="duit-031e">POTONGAN ABSEN ( {{$data['absensi'][$i]->total_potongan_absen }} % )</td>
    <td class="duit-031e">:</td>
    <td class="duit-031e">Rp.</td>
    <td class="duit-yw4l" style="text-align: right;">{{number_format(($data['absensi'][$i]->total_potongan_absen / 100) * ($data['grade'][$i]->tunjangan_kinerja * $persentaseKinerja),0,',','.') }}</td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l" style="width: 20%;	"></td>
  </tr>
  <tr>
    <td class="duit-yw4l" style="width: 20%"></td>
    <td class="duit-031e">POTONGAN DISIPLIN ( {{($data['disiplin'][$i]->persentase/100)  }} % )</td>
    <td class="duit-031e">:</td>
    <td class="duit-031e">Rp.</td>
    <td class="duit-yw4l" style="text-align: right;">{{number_format(($data['disiplin'][$i]->persentase / 100) * ($data['grade'][$i]->tunjangan_kinerja * $persentaseKinerja),0,',','.') }}</td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l" style="width: 20%;  "></td>
  </tr>

  <tr>
    <td class="duit-yw4l" style="width: 20%"></td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l" style="padding: 0px;"><hr></td>
    <td class="duit-yw4l">-</td>
    <td class="duit-yw4l" style="width: 20%;	"></td>
  </tr>
  <tr>
    <td class="duit-yw4l" style="width: 20%"></td>
    <td class="duit-031e">TUNJANGAN KINERJA BERSIH</td>
    <td class="duit-031e">:</td>
    <td class="duit-031e">Rp.</td>
    <td class="duit-yw4l" style="text-align: right;">{{number_format($tjkinerjabersih = ($data['grade'][$i]->tunjangan_kinerja * $persentaseKinerja) - ($data['absensi'][$i]->total_potongan_absen / 100) * ($data['grade'][$i]->tunjangan_kinerja * $persentaseKinerja) - ($data['disiplin'][$i]->persentase / 100) * ($data['grade'][$i]->tunjangan_kinerja * $persentaseKinerja),0,',','.')}}</td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l" style="width: 20%;	"></td>
  </tr>
  <tr>
    <td class="duit-yw4l" style="width: 20%"></td>
    <td class="duit-031e">TUNJANGAN PPH PASAL 21</td>
    <td class="duit-031e">:</td>
    <td class="duit-031e">Rp.</td>
    <td class="duit-yw4l" style="text-align: right;">{{number_format($tjpph = $data['pegawai'][$i]->tjpph,0,',','.')}}</td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l" style="width: 20%;	"></td>
  </tr>
  <tr>
    <td class="duit-yw4l" style="width: 20%"></td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l" style="padding: 0px;"><hr></td>
    <td class="duit-yw4l">+</td>
    <td class="duit-yw4l" style="width: 20%;	"></td>
  </tr>
  <tr>
    <td class="duit-yw4l" style="width: 20%"></td>
    <td class="duit-031e">TUNJANGAN KINERJA KOTOR</td>
    <td class="duit-031e">:</td>
    <td class="duit-031e">Rp.</td>
    <td class="duit-yw4l" style="text-align: right;">{{number_format($tjkotor = $tjkinerjabersih + $tjpph,0,',','.')}}</td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l" style="width: 20%;	"></td>
  </tr>
  <tr>
    <td class="duit-yw4l" style="width: 20%"></td>
    <td class="duit-031e">POTONGAN PPH PASAL 21</td>
    <td class="duit-031e">:</td>
    <td class="duit-031e">Rp.</td>
    <td class="duit-yw4l" style="text-align: right;">{{number_format($potpph = App\Library\HitungLib::PPHDuaSatu($tjkinerjabersih,$data['pegawai'][$i]->id),0,',','.')}}</td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l" style="width: 20%;	"></td>
  </tr>
  <tr>
    <td class="duit-yw4l" style="width: 20%"></td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l" style="padding: 0px;"><hr></td>
    <td class="duit-yw4l">-</td>
    <td class="duit-yw4l" style="width: 20%;	"></td>
  </tr>
  <tr>
    <td class="duit-yw4l" style="width: 20%"></td>
    <td class="duit-031e">TUNJANGAN KINERJA YANG DIBAYARKAN</td>
    <td class="duit-031e">:</td>
    <td class="duit-031e">Rp.</td>
    <td class="duit-yw4l" style="text-align: right;">{{number_format($tjkotor - $potpph,0,',','.')}}</td>
    <td class="duit-yw4l"></td>
    <td class="duit-yw4l" style="width: 20%;	"></td>
  </tr>
</table>



<style type="text/css">
.ttd  {border-collapse:collapse;border-spacing:0;width: 100%; margin-top: 50px;}
.ttd td{font-family:Arial, sans-serif;font-size:12px;padding:5px;overflow:hidden;word-break:normal;}
</style>
<table class="ttd">
  <tr>
    <td class="ttd-031e" style="width: 60%;">TELAH DIKREDITKAN OLEH BANK PEMBAYAR</td>
    {{-- <td class="ttd-031e" style="width: 30%;"></td> --}}
    <td class="ttd-031e" style="width: 30%;">TANDA TANGAN</td>
  </tr>
  <tr>
    {{-- <td class="ttd-031e"></td> --}}
    <td class="ttd-031e"></td>
    <td class="ttd-031e" style="padding-top: 70px">EMANUEL CHRISTIANTOKO</td>
  </tr>
  <tr>
    {{-- <td class="ttd-031e"></td> --}}
    <td class="ttd-031e"></td>
    <td class="ttd-031e">NIP. 100000000000</td>
  </tr>
</table>
<div class="teacherPage"></div>
@endfor