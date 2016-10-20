<style type="text/css">
.teacherPage {
   /*page: teacher;*/
   page-break-after: always;
}
.ndas  {border-collapse:collapse;border-spacing:0;width: 100%}
.ndas td{
  font-family:Arial, sans-serif;
  font-size:11px;
  padding:2px;
/*  border-style:solid;
  border-width:1px;*/
  overflow:hidden;
  word-break:normal;
}
.ndas th{
  font-family:Arial, sans-serif;
  font-size:11px;
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
?>
@for($j = 0 ; $j < count($data['grade_semua']); $j++)
@if($stt)
<table class="ndas">
  <tr>
    <th class="ndas-031e" colspan="2" style="text-align: center;font-weight: bold;">KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN</th>
  </tr>
  <tr>
    <th class="ndas-031e" colspan="2" style="text-align: center;font-weight: bold;">UNIT ORGANISASI : KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN</th>
  </tr>
</table>

<table class="ndas" style="width: 100%;">
  <tr>
    <th class="ndas-031e" colspan="2" style="text-align: center;font-weight: bold;">REKAPITULASI PEMBAYARAN TUNJANGAN KINERJA PEGAWAI</th>
  </tr>
  <tr>
    <th class="ndas-031e" colspan="2" style="text-align: center;font-weight: bold;">BULAN: {{$data['bulan']}} {{$data['tahun']}}</th>
  </tr>
</table>
<br>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:10px;padding:5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:10px;font-weight:bolder;padding:5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-yw4l{vertical-align:top}
</style>
@endif
@if($stt) 
<table class="tg" style="width: 100%;">
  <tr>
    <th class="tg-031e" rowspan="3">NO</th>
    <th class="tg-031e" rowspan="3">KELAS JABATAN</th>
    <th class="tg-031e" rowspan="3">JUMLAH PENERIMA</th>
    <th class="tg-031e" rowspan="3">TUNJANGAN KINERJA PER KELAS JABATAN</th>
    <th class="tg-031e" style="border-bottom: none;text-align: left;">1. JUMLAH TUNJANGAN</th>
    <th class="tg-031e" style="border-bottom: none;text-align: left;">1. POTONGAN PAJAK</th>
  </tr>
  <tr>
    <th class="tg-031e" style="border-top: none;border-bottom: none;text-align: left;vertical-align: top;">2. PAJAK</th>
    <th class="tg-031e" rowspan="2" style="border-top: none;text-align: left;vertical-align: top;">2. JUMLAH NETTO</th>
  </tr>
  <tr>
    <th class="tg-031e" style="border-top: none;text-align: left;">3. JUMLAH</th>
  </tr>
  <?php
    $stt = false;
  ?>
  @endif
  <tr>
    <td class="tg-yw4l" align="center">{{$j + 1}}</td>
    <td class="tg-yw4l" align="center">{{$data['grade_semua'][$j]->grade}}</td>
    <?php
      $tempJabatan = 0;
      $tempJmlTunjangan = 0;
      $tempJmlPPH = 0;
      $user = App\User::where('unit_id', $data['unit_id'])->get();

      foreach ($user as $dataUser) {
        $dataJabatan = App\Jabatan::where('id',$dataUser->jabatan_id)->first();
        if($dataJabatan->kelas_jabatan == $data['grade_semua'][$j]->grade){
          $tempJabatan++;
          $jmlPegawai++;
          $tempJmlTunjangan = $tempJmlTunjangan + App\Library\HitungLib::HitungKinerjaBulanan($dataUser->id,$data['bulan'], $data['tahun']);
          $totalJmlTnjangan = $totalJmlTnjangan + App\Library\HitungLib::HitungKinerjaBulanan($dataUser->id,$data['bulan'], $data['tahun']);
          $tempJmlPPH = $tempJmlPPH + App\Library\HitungLib::PPHDuaSatu(App\Library\HitungLib::HitungKinerjaBulanan($dataUser->id,$data['bulan'], $data['tahun']), $dataUser->id,$data['bulan']);
          $totalJmlPajak = totalJmlPajak + App\Library\HitungLib::PPHDuaSatu(App\Library\HitungLib::HitungKinerjaBulanan($dataUser->id,$data['bulan'], $data['tahun']), $dataUser->id,$data['bulan']);
        }
      }
    ?>  
    <td class="tg-yw4l" align="center">@if($tempJabatan == 0) - @else {{$tempJabatan}} @endif</td>
    <td class="tg-yw4l" align="center">{{number_format($data['grade_semua'][$j]->tunjangan_kinerja,0,',','.')}}</td>
    <td class="tg-yw4l">
      1. {{number_format($tempJmlTunjangan,0,',','.')}}
      <br>
      2. {{number_format($tempJmlPPH,0,',','.')}}
      <br>
      3. {{number_format($tempJmlTunjangan + $tempJmlPPH,0,',','.')}}
    </td>
    <td class="tg-yw4l">
      1. {{number_format($tempJmlPPH,0,',','.')}}
      <br>
      2. {{number_format($tempJmlTunjangan,0,',','.')}}
    </td>
  </tr>
  @if($j == 50 || $j == count($data['grade_semua']) - 1)
  <tr>
    <th class="tg-yw4l"></th>
    <th class="tg-yw4l">JUMLAH</th>
    <th class="tg-yw4l">{{$jmlPegawai}}</th>
    <th class="tg-yw4l"></th>
    <th class="tg-yw4l" style="text-align: left;">
      1. {{number_format($totalJmlTnjangan, 0, ',', '.')}}<br>
      2. {{number_format($totalJmlPajak, 0, ',', '.')}}<br>
      3. {{number_format($totalJmlPajak + $totalJmlTnjangan, 0, ',', '.')}}<br>
    </th>

    <th class="tg-yw4l" style="text-align: left;">
      1. {{number_format($totalJmlPajak, 0, ',', '.')}}<br>
      2. {{number_format($totalJmlTnjangan, 0, ',', '.')}}<br>
    </th>
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
  <div class="teacherPage"></div>
  <?php
    $stt = true;
  ?>
@endif
@endfor

