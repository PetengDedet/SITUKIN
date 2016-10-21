<?php
  $unit_id = $data['unit_id'];
?>
<style type="text/css">
.teacherPage {
   /*page: teacher;*/
   page-break-after: auto|always|avoid|left|right|initial|inherit;

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

<style type="text/css">
.teacherPage {
   /*page: teacher;*/
   page-break-after: always;
}
.kol  {border-collapse:collapse;border-spacing:0;width: 100%}
.kol td{
  font-family:Arial, sans-serif;
  font-size:12px;
  padding:2px;
  border-style:solid;
  border-width:1px;
  overflow:hidden;
  word-break:normal;
}
.kol th{
  font-family:Arial, sans-serif;
  font-size:12px;
  font-weight:normal;
  padding:2px;
  border-style:solid;
  border-width:1px;
  overflow:hidden;
  word-break:normal;
  text-align: left;
}
</style>
<?php
  $k = 1;
?>
@for($j = 0; $j < App\User::where('unit_id','=',$unit_id)->count() / 50; $j++)
  <table class="ndas">
    <tr>
        <th style="text-align: center;"><b>KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN</b></th>
    </tr>
    <tr>
        <th style="text-align: center;"><b>Formulir Rekapitulasi Laporan Potongan Absen dan Potongan Disiplin</b></th>
    </tr>
  </table>
  <?php
    $data_unit = App\Unit::where('id','=',$unit_id)->first();
  ?>
  <br>
  <table class="ndas">
      <tr>
          <td class="ndas-031e" style="width: 140px;">UNIT KERJA ESELON I</td>
          <td class="ndas-031e">:</td>
          <td class="ndas-031e" style="text-align: left;">{{$data_unit->nama_unit}}</td>
      </tr>
      <tr>
        <td class="ndas-031e">BULAN</td>
        <td class="ndas-031e" style="width: 5px;">:</td>
        <td class="ndas-031e" style="text-align: left;">{{date('F Y')}}</td>
      </tr>
  </table>
  <br>
  <table class="kol">
    <tr>
        <th style="text-align: center;">No</th>
        <th style="text-align: center;">Nama Pegawai</th>
        <th style="text-align: center;">Kinerja Bulanan<br>(%)</th>
        <th style="text-align: center;">Potongan Absen<br>(%)</th>
        <th style="text-align: center;">Potongan Disiplin<br>(%)</th>
    </tr>
    @foreach(App\User::where('unit_id','=',$unit_id)->skip($j * 50)->take(50)->get() as $data_user)
        <?php
          $checkKinerjaBulanan = App\KinerjaBulanan::where('pegawai_id','=',$data_user->id)->where('bulan','=',date('F'))->where('tahun','=',date('Y'))->count();
          if($checkKinerjaBulanan > 0){
            $getDataKinerjaBulanan = App\KinerjaBulanan::where('pegawai_id','=',$data_user->id)->where('bulan','=',date('F'))->where('tahun','=',date('Y'))->first();
            $kinerjaBulanan = $getDataKinerjaBulanan->persentase;
          }else{
            $kinerjaBulanan = "97";
          }
        ?>
        <?php
          $checkPotonganAbsen = App\PotonganAbsensi::where('pegawai_id','=',$data_user->id)->where('bulan','=',date('F'))->where('tahun','=',date('Y'))->count();
          if($checkPotonganAbsen > 0){
            $getDataPotonganAbsen = App\PotonganAbsensi::where('pegawai_id','=',$data_user->id)->where('bulan','=',date('F'))->where('tahun','=',date('Y'))->first();
            $potonganAbsen = $getDataPotonganAbsen->total_potongan_absen;
          }else{
            $potonganAbsen = "0";
          }

          $checkPotonganDisiplin = App\HukumanPegawai::where('user_id','=',$data_user->id)->count();

          if($checkPotonganDisiplin > 0){
            $dataHukumanPegawai = App\HukumanPegawai::where('user_id','=',$data_user->id)->orderBy('id','DESC')->first();
            $getDataHukumanDisiplin = App\HukumanDisiplin::where('id','=',$dataHukumanPegawai->hukuman_id)->first();
            $potonganDisiplin = $getDataHukumanDisiplin->potongan;
          }else{
            $potonganDisiplin = "0";
          }
        ?>
        <tr>
            <td style="text-align: center; border-bottom:1px solid #000;">{{$k}}</td>
            <td style="margin-left: 5px;border-bottom:1px solid #000;">{{$data_user->name}}</td>
            <td style="text-align: center;border-bottom:1px solid #000;">{{$kinerjaBulanan}}</td>
            <td style="text-align: center;border-bottom:1px solid #000;">{{$potonganAbsen}}</td>
            <td style="text-align: center;border-bottom:1px solid #000;">{{$potonganDisiplin}}</td>
        </tr>
        <?php $k++; ?>
    @endforeach
  </table>

  @if($j == round(App\User::where('unit_id','=',$unit_id)->count() / 50))
  <table class="ndas" style="margin-top: 20px;">
    <tr>
        <td style="width: 35%;"></td>
        <td style="width: 35%;"></td>
        <td style="width: 30%;">Jakarta, {{date('d F Y')}}</td>
    </tr>
        <tr>
        <td style="width: 35%;"></td>
        <td style="width: 35%;"></td>
        <td style="width: 30%;">Pimpinan Unit Kerja Eselon I</td>
    </tr>
        <tr>
        <td style="width: 35%;"></td>
        <td style="width: 35%;"></td>
        <td style="width: 30%;padding-top: 70px;">{{App\User::where('id',$data['eselon_satu'])->first()->name}}</td>
    </tr>
        <tr>
        <td style="width: 35%;"></td>
        <td style="width: 35%;"></td>
        <td style="width: 30%;">NIP. {{App\User::where('id',$data['eselon_satu'])->first()->nip}}</td>
    </tr>
  </table>
  @endif

  <div  style="page-break-after: always;"></div>
@endfor




