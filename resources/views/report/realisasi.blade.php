<style type="text/css">
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
  $stt = true;
  $totalJmlTnjangan = 0;
  $totalJmlPajak = 0;
  $totalJml = 0;
  $jmlPegawai = 0;

  $status = true;
?>
@for($i = 0; $i < count($data['grade_semua']); $i++)
@if($status)
<table class="ndas">
  <tr>
    <th class="ndas-031e" style="text-align: center; font-weight: bold;">KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN</th>
  </tr>
</table>

<table class="ndas" style="width: 100%;">
  <tr>
    <th class="ndas-031e" colspan="2" style="text-align: center; font-weight: bold;">LAPORAN REALISASI PEMBAYARAN TUNJANGAN KINERJA</th>
  </tr>
  <tr>
    <th class="ndas-031e" style="text-align: right;width: 50%; font-weight: bold;">BULAN:</th>
    <th class="ndas-031e" style="text-align: left;width: 50%; font-weight: bold;">{{strtoupper($data['bulan'])}} {{$data['tahun']}}</th>
  </tr>
</table>
<br>
<table class="ndas">
  <tr>
    <th class="ndas-031e" style="width: 115px;">UNIT ORGANISASI :</th>
    <th class="ndas-031e">KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN</th>
  </tr>
</table>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;width: 100%;}
.tg td{font-family:Arial, sans-serif;font-size:10px;padding:5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:10px;font-weight:bolder;padding:5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-yw4l{vertical-align:top}
</style>

<table class="tg">

  <tr>
    <th class="tg-031e" rowspan="2">NO</th>
    <th class="tg-031e" rowspan="2">PERINGKAT JABATAN</th>
    <th class="tg-031e" rowspan="2">JUMLAH PEGAWAI</th>
    <th class="tg-031e" colspan="3">REALISASI</th>
    <th class="tg-031e" rowspan="2">KETERANGAN</th>
  </tr>
  <tr>
    <th class="tg-031e">TUNJANGAN KINERJA</th>
    <th class="tg-031e">PPH PS. 21</th>
    <th class="tg-031e">JUMLAH</th>
  </tr>
  <tr>
    <th class="tg-031e">1</th>
    <th class="tg-031e">2</th>
    <th class="tg-031e">3</th>
    <th class="tg-yw4l">4</th>
    <th class="tg-yw4l">5</th>
    <th class="tg-yw4l">6</th>
    <th class="tg-yw4l">7</th>
  </tr>
  <?php
    $status = false;
  ?>
  @endif

  <?php
    $tempJabatan = 0;
    $tempJmlTunjangan = 0;
    $tempJmlPPH = 0;
    $user = App\User::where('unit_id', $data['unit_id'])->get();

    foreach ($user as $dataUser) {
      $dataJabatan = App\Jabatan::where('id',$dataUser->jabatan_id)->first();
      if($dataJabatan->kelas_jabatan == $data['grade_semua'][$i]->grade){
        $jmlPegawai++;
        $tempJabatan++;
        $tempJmlTunjangan = $tempJmlTunjangan + App\Library\HitungLib::HitungKinerjaBulanan($dataUser->id,$data['bulan'], $data['tahun']);
        $totalJmlTnjangan = $totalJmlTnjangan + App\Library\HitungLib::HitungKinerjaBulanan($dataUser->id,$data['bulan'], $data['tahun']);
        $tempJmlPPH = $tempJmlPPH + App\Library\HitungLib::PPHDuaSatu(App\Library\HitungLib::HitungKinerjaBulanan($dataUser->id,$data['bulan'], $data['tahun']), $dataUser->id,$data['bulan']);
        $totalJmlPajak = $totalJmlPajak + App\Library\HitungLib::PPHDuaSatu(App\Library\HitungLib::HitungKinerjaBulanan($dataUser->id,$data['bulan'], $data['tahun']), $dataUser->id,$data['bulan']);
      }
    }
  ?>  
    <tr>
      <td class="tg-031e" align="center">{{$i + 1}}</td>
      <td class="tg-031e" align="center">{{$data['grade_semua'][$i]->grade}}</td>
      <td class="tg-031e" align="center">@if($tempJabatan == 0) - @else {{$tempJabatan}} @endif</td>
      <td class="tg-yw4l" align="center">{{number_format($tempJmlTunjangan,0,',','.')}}</td>
      <td class="tg-yw4l" align="center">{{number_format($tempJmlPPH,0,',','.')}}</td>
      <td class="tg-yw4l" align="center">{{number_format($tempJmlTunjangan + $tempJmlPPH,0,',','.')}}</td>
      <td class="tg-yw4l" align="center"></td>
    </tr>
  
  @if($i == 50 || $i == count($data['grade_semua']) - 1)
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l">JUMLAH</td>
    <td class="tg-yw4l" align="center">{{$jmlPegawai}}</td>
    <td class="tg-yw4l" align="center">{{number_format($totalJmlTnjangan,0,',','.')}}</td>
    <td class="tg-yw4l" align="center">{{number_format($totalJmlPajak,0,',','.')}}</td>
    <td class="tg-yw4l" align="center">{{number_format($totalJmlTnjangan + $totalJmlPajak,0,',','.')}}</td>
    <td class="tg-yw4l"></td>
  </tr>
</table>

<style type="text/css">
.sikil  {
  border-collapse:collapse;border-spacing:0;
  width: 100%;
}
.sikil td{
  font-family:Arial, sans-serif;
  font-size:10px;
  padding:5px;
/*  border-style:solid;
  border-width:1px;*/
  overflow:hidden;
  word-break:normal;
}
.sikil th{
  font-family:Arial, sans-serif;
  font-size:10px;
  font-weight:normal;
  padding:5px;
/*  border-style:solid;
  border-width:1px;*/
  overflow:hidden;
  word-break:normal;
}
.sikil .sikil-yw4l{vertical-align:top}
</style>
<table class="sikil">
  <tr>
    <td class="sikil-031e" style="width: 23%;"></td>
    <td class="sikil-031e" style="width: 54%;"></td>
    <td class="sikil-yw4l" style="width: 23%;">Jakarta...........</td>
  </tr>
  <tr>
    <td class="sikil-031e">Pejabat Pembuat Komitmen</td>
    <td class="sikil-031e"></td>
    <td class="sikil-yw4l">Bendahara</td>
  </tr>
  <tr>
    <td class="sikil-031e" style="padding-top: 50px;">{{--$nama--}}</td>
    <td class="sikil-031e"></td>
    <td class="sikil-yw4l" style="padding-top: 50px;">{{--$nama--}}</td>
  </tr>
  <tr>
    <td class="sikil-031e">NIP. {{--$nip--}}</td>
    <td class="sikil-031e"></td>
    <td class="sikil-yw4l">NIP. {{--$nip--}}</td>
  </tr>
</table>
@endif
@endfor