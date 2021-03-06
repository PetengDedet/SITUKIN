<style type="text/css">
.teacherPage {
   /*page: teacher;*/
   page-break-after: always;
}
  .tg  {border-collapse:collapse;border-spacing:0;}
  .tg td{font-family:Arial, sans-serif;font-size:12px;padding: 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
  .tg th{font-family:Arial, sans-serif;font-size:12px;padding: 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:break-all;}
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
    $max = count($data['grade']);
    $rekap = [];
  ?>
  @for($i = 0; $i<= round($max / 3); $i++)
    <?php 
      $rekap['lembar'][$i] = $i;
    ?>
    <table class="tg">
      @if($status)
      <?php
        $status =false;
      ?>
      <tr>
        <td colspan="13" style="border:0px;">
        <div style="text-align: center;">
          KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN<br>
          DAFTAR PEMBAYARAN TUNJANGAN KINERJA<br>
          BULAN : {{$data['bulan'] . ' ' .$data['tahun']}}
        </div>
        <table width="100%">
          <tr>
            <td  style="border:0px;padding: 0px;" align="left">UNIT ORGANISASI: KEMENTERIAN KOODINATOR BIDANG PEREKONOMIAN</td>
            <td  style="border:0px;padding: 0px;" align="right">TGL PROSES: {{date('d-m-Y')}}</td>
          </tr>
        </table>
        </td>
      </tr>

      <tr>  
        <th class="tg-hgcj" rowspan="2">N<br>O<br>.<br>U<br>R<br>U<br>T</th>
        <th class="tg-hgcj">NAMA</th>
        <th class="tg-hgcj" rowspan="2" >E<br>S<br>E<br>L<br>O<br>N</th>
        <th class="tg-hgcj" rowspan="2"><br>G<br>O<br>L<br>O<br>N<br>G<br>A<br>N</th>
        <th class="tg-hgcj" colspan="2">SUSUNAN<br>KELUARGA</th>
        <th class="tg-hgcj" rowspan="2" style="max-width: 10px;">K<br>E<br>L<br>A<br>S<br><br>J<br>A<br>B<br>A<br>T<br>A<br>N</th>
        <th class="tg-hgcj" style="text-align: left;width: 110px;" rowspan="2">
          A. GAJI POKOK<br><br>
          B. TUNJANGAN<br>
          STRUKTURAL/<br>FUNGSIONAL/<br>UMUM<br><br>
          C. GAJI KOTOR<br>
        </th>
        <th class="tg-hgcj" style="text-align: left;width: 110px;" rowspan="2">D. TUNJANGAN<br>KINERJA<br><br>E. TUNJANGAN<br>PENYESUAIAN<br>PENGHASILAN<br><br>F. TUNJANGAN<br>KHUSUS<br><br>G. POT ABSEN<br>(%)</th>
        <th class="tg-hgcj" style="text-align: left;width: 110px;" rowspan="2">H. TUNJANGAN<br>KINERJA BERSIH<br>(D+E+F-G)<br><br>I. TUNJANGAN PPH 21<br><br>J. TUNJANGAN KINERJA KOTOR (H+1)<br><br>K. POT PPH 21</th>
        <th class="tg-hgcj" style="text-align: left;width: 110px;" rowspan="2">TUNJANGAN KINERJA YANG DIBAYARKAN (J-K)</th>
        <th class="tg-hgcj" rowspan="2">REKENING</th>
        <th class="tg-hgcj" rowspan="2">KETERANGAN</th>
      </tr>
      <tr>
        <td class="tg-hgcj" style="border-right: 3px; solid #000;">NIP</td>
        <th class="tg-hgcj">STATUS KAWIN</th>
        <th class="tg-hgcj">JUMLAH ANAK</th>
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
      <?php
        $jumlahA = 0;
        $jumlahB = 0;
        $jumlahC = 0;
        $jumlahD = 0;
        $jumlahE = 0;
        $jumlahF = 0;
        $jumlahG = 0;
        $jumlahH = 0;
        $jumlahI = 0;
        $jumlahJ = 0;
        $jumlahK = 0;
        $jumlahL = 0;
      ?>
      @for($j =  $i * 3; $j <($i * 3) + 3; $j++)
      
      @if($data['pegawai'][$j])
      <?php
        $gjkotor = $data['pegawai'][$j]->gjpokok + $data['pegawai'][$j]->tjistri + $data['pegawai'][$j]->tjanak + $data['pegawai'][$j]->tjupns + $data['pegawai'][$j]->tjstruk + $data['pegawai'][$j]->tjfungs + $data['pegawai'][$j]->tjdaerah + $data['pegawai'][$j]->tjpencil + $data['pegawai'][$j]->tjlain + $data['pegawai'][$j]->tjkompen + $data['pegawai'][$j]->pembul + $data['pegawai'][$j]->tjberas + $data['pegawai'][$j]->tjpph;
        $tunjanganKinerjaBersih = $data['tkjb'][$j] + 0 + 0;
        $tunjanganKinerjaKotor = $data['pegawai'][$j]->tjpph + $tunjanganKinerjaBersih;
        $jumlahA = $jumlahA + $data['pegawai'][$j]->gjpokok;
        $jumlahB = $jumlahB + $data['pegawai'][$j]->tjstruk;
        $jumlahC = $jumlahC + $gjkotor;
        $jumlahD = $jumlahD + $data['tkjb'][$j];
        $jumlahE = $jumlahE + 0;
        $jumlahF = $jumlahF + 0;
        $jumlahG = $jumlahG + $data['absensi'][$j]->total_potongan_absen;
        $jumlahH = $jumlahH + $tunjanganKinerjaBersih;
        $jumlahI = $jumlahI + $data['pegawai'][$j]->tjpph;
        $jumlahJ = $jumlahJ + $tunjanganKinerjaKotor;
        $jumlahK = $jumlahK + App\Library\HitungLib::PPHDuaSatu($data['tkjd'][$j],$data['pegawai'][$j]->id);
        $jumlahL = $jumlahL + ($tunjanganKinerjaKotor - App\Library\HitungLib::PPHDuaSatu($data['tkjd'][$j],$data['pegawai'][$j]->id))
      ?>
      <tr>
        <td class="tg-s6z2">{{$j + 1}}</td>
        <td class="tg-yw4l">{{$data['pegawai'][$j]->name}}<br>NIP. {{$data['pegawai'][$j]->nip}}</td>
        <td class="tg-baqh">
          
        </td> 
        <td class="tg-baqh">
          <?php
            $dataExplode =  explode('(', $data['pegawai'][$j]->golongan);
            $explodeAgain = explode(')', $dataExplode[1] );
            echo $explodeAgain[0];
          ?>
        </td>
        <td class="tg-baqh">
          @if($data['pegawai'][$j]->kdkawin == "1000" || $data['pegawai'][$j]->kdkawin == "1001" || $data['pegawai'][$j]->kdkawin == "1002" || $data['pegawai'][$j]->kdkawin == "1003")
            TK
          @elseif($data['pegawai'][$j]->kdkawin == "1100" || $data['pegawai'][$j]->kdkawin == "1101" || $data['pegawai'][$j]->kdkawin == "1102" || $data['pegawai'][$j]->kdkawin == "1103")
            K1
          @else
            D/J
          @endif          
        </td>
        <td class="tg-baqh"></td>
        <td class="tg-baqh">{{$data['pegawai'][$j]->kelas_jabatan}}</td>
        <td class="tg-lqy6">
          {{number_format($data['pegawai'][$j]->gjpokok,0, ',', '.')}}
          <br>
          {{number_format($data['pegawai'][$j]->tjstruk,0, ',', '.')}}
          <br>
          {{number_format($gjkotor,0, ',', '.')}}
        </td>
        <td class="tg-lqy6">
          {{number_format($data['tkjb'][$j],0, ',', '.')}}
          <br>
          0
          <br>
          0
          <br>
          ( {{$data['absensi'][$j]->total_potongan_absen}}% )
        </td>
        <td class="tg-lqy6">
          {{number_format($tunjanganKinerjaBersih,0, ',', '.')}}
          <br>
          {{number_format($data['pegawai'][$j]->tjpph,0, ',', '.')}}
          <br>
          {{number_format($tunjanganKinerjaKotor,0, ',', '.')}}
          <br>
          {{number_format(App\Library\HitungLib::PPHDuaSatu($data['tkjd'][$j],$data['pegawai'][$j]->id),0,',','.')}}
          </td>
        <td class="tg-lqy6">
          {{number_format($tunjanganKinerjaKotor - App\Library\HitungLib::PPHDuaSatu($data['tkjd'][$j],$data['pegawai'][$j]->id),0, ',', '.')}}
        </td>
        <td class="tg-yw4l">{{$data['pegawai'][$j]->rekening}}</td>
        <td class="tg-031e"></td>
      </tr>
      @endif
      @endfor
        <?php 
          $rekap['jumlahA'][$i] = number_format($jumlahA,0, ',', '.');
          $rekap['jumlahB'][$i] = number_format($jumlahB,0, ',', '.');
          $rekap['jumlahC'][$i] = number_format($jumlahC,0, ',', '.');
          $rekap['jumlahD'][$i] = number_format($jumlahD,0, ',', '.');
          $rekap['jumlahE'][$i] = number_format($jumlahE,0, ',', '.');
          $rekap['jumlahF'][$i] = number_format($jumlahF,0, ',', '.');
          $rekap['jumlahG'][$i] = number_format($jumlahG,0, ',', '.');
          $rekap['jumlahH'][$i] = number_format($jumlahH,0, ',', '.');
          $rekap['jumlahI'][$i] = number_format($jumlahI,0, ',', '.');
          $rekap['jumlahJ'][$i] = number_format($jumlahJ,0, ',', '.');
          $rekap['jumlahK'][$i] = number_format($jumlahK,0, ',', '.');
          $rekap['jumlahL'][$i] = number_format($jumlahL,0, ',', '.');
        ?>
        <tr>
          <td class="tg-031e" colspan="7">JUMLAH LEMBAR KE :{{$i + 1}}</td>
          <td class="tg-0ord">{{number_format($jumlahA,0, ',', '.')}}<br>{{number_format($jumlahB,0, ',', '.')}}<br>{{number_format($jumlahC,0, ',', '.')}}</td>
          <td class="tg-0ord">{{number_format($jumlahD,0, ',', '.')}}<br>{{number_format($jumlahE,0, ',', '.')}}<br>{{number_format($jumlahF,0, ',', '.')}}<br>{{number_format($jumlahG,0, ',', '.')}}</td>
          <td class="tg-0ord">{{number_format($jumlahH,0, ',', '.')}}<br>{{number_format($jumlahI,0, ',', '.')}}<br>{{number_format($jumlahJ,0, ',', '.')}}<br>{{number_format($jumlahK,0, ',', '.')}}</td>
          <td class="tg-0ord">{{number_format($jumlahL,0, ',', '.')}}</td>
          <td class="tg-031e"></td>
          <td class="tg-031e"></td>
        </tr>
  </table>
  @if($i == round($max /3) || $i == $max)
  <style type="text/css">
  .sikil  {border:none;border-collapse:collapse;border-spacing:0; width: 100%; margin-top: 20px;}
  .sikil td{border:none;font-family:Arial, sans-serif;font-size:10px;padding:5px;overflow:hidden;word-break:normal;}
  /*.sikil th{font-family:Arial, sans-serif;font-size:10px;padding:5px;overflow:hidden;word-break:normal;}*/
  .sikil .sikil-yw4l{vertical-align:top}
  </style>
  <table class="sikil">
    <tr>
      <td class="sikil-031e" style="padding: 0px;">STATUS KAWIN/PERKAWINAN</td>
      <td class="sikil-031e" style="padding: 0px;"></td>
      <td class="sikil-031e" style="padding: 0px;"></td>
      <td class="sikil-031e" style="padding: 0px;">JAKARTA, {{strtoupper(date('d F Y'))}}</td>
    </tr>
    <tr>
      <td class="sikil-031e" rowspan="5" style="vertical-align: top;">TK = TIDAK KAWIN<br>K1 = KAWIN<br>D =DUDA<br>J = JANDA</td>
      <td class="sikil-031e" style="padding: 0px;">MENGETAHUI/MENYETUJUI :</td>
      <td class="sikil-031e"></td>
      <td class="sikil-031e"></td>
    </tr>
    <tr>
      <td class="sikil-031e" style="padding: 0px;">PEJABAT PEMBUAT KOMITMEN</td>
      <td class="sikil-031e" style="padding: 0px;">BENDAHARA</td>
      <td class="sikil-031e" style="padding: 0px;">PPABP BELANJA PEGAWAI</td>
    </tr>
    <tr>
      <td class="sikil-031e" style="padding: 50px 0px 0px;">{{App\User::where('id',$data['pejabat_pembuat_komitmen'])->first()->name}}</td>
      <td class="sikil-031e" style="padding: 50px 0px 0px;">{{App\User::where('id',$data['bendahara'])->first()->name}}</td>
      <td class="sikil-031e" style="padding: 50px 0px 0px;">{{App\User::where('id',$data['belanja_pegawai'])->first()->name}}</td>
    </tr>
    <tr>
      <td class="sikil-yw4l" style="padding: 0px;">NIP. {{App\User::where('id',$data['pejabat_pembuat_komitmen'])->first()->nip}}</td>
      <td class="sikil-yw4l" style="padding: 0px;">NIP. {{App\User::where('id',$data['bendahara'])->first()->nip}}</td>
      <td class="sikil-yw4l" style="padding: 0px;">NIP. {{App\User::where('id',$data['belanja_pegawai'])->first()->nip}}</td>
    </tr>
  </table>
  @endif
  <div class="teacherPage"></div>
  <?php $status = true; ?>
  @endfor

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
  $stt = true;
  $ttlJmlA = 0;
  $ttlJmlB = 0;
  $ttlJmlC = 0;
  $ttlJmlD = 0;
  $ttlJmlE = 0;
  $ttlJmlF = 0;
  $ttlJmlG = 0;
  $ttlJmlH = 0;
  $ttlJmlI = 0;
  $ttlJmlJ = 0;
  $ttlJmlK = 0;
  $ttlJmlL = 0; 
?>
@for($k = 0 ; $k < round(count($rekap['jumlahA']) / 3) ; $k++) 
@if($stt)
<table class="ndas">
    <tr>
        <th class="ndas-031e"style="text-align: center;">KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN</th>
    </tr>
</table>

<table class="ndas" style="width: 100%;">
    <tr>
        <th class="ndas-031e" colspan="2" style="text-align: center;">DAFTAR PEMBAYARAN TUNJANGAN KINERJA</th>
    </tr>
    <tr>
        <th class="ndas-031e" colspan="2" style="text-align: right;width: 50%;">BULAN: {{strtoupper($data['bulan']." ".$data['tahun'])}}</th>
    </tr>
</table>

<table class="ndas">
    <tr>
        <th class="ndas-031e"style="text-align: left">UNIT ORGANISASI: KEMENTERIAN KOODINATOR BIDANG PEREKONOMIAN</th>
        <th class="ndas-031e"style="text-align: right">TGL PROSES: {{strtoupper(date('d F Y'))}}</th>
    </tr>
</table>

<style type="text/css">
.tg  {
    border-collapse:collapse;
    border-spacing:0;
    width: 100%;
}
.tg td{
    font-family:Arial, sans-serif;
    font-size:10px;
    padding:5px;
    border-style:solid;
    border-width:1px;
    overflow:hidden;
    word-break:normal;
}
.tg th{
    font-family:Arial, sans-serif;
    font-size:10px;
    font-weight:normal;
    padding:5px;
    border-style:solid;
    border-width:1px;
    overflow:hidden;
    word-break:normal;
}
.tg .tg-baqh{
    text-align:center;
    vertical-align:top
}
.tg .tg-yw4l{
    vertical-align:top
}
.toptobottom{
  width: 0;
  word-wrap: break-word;
}
</style>
<table class="tg">
  <tr>  
        <th class="tg-hgcj" rowspan="2">N<br>O<br>.<br>U<br>R<br>U<br>T</th>
        <th class="tg-hgcj">NAMA</th>
        <th class="tg-hgcj" rowspan="2" >E<br>S<br>E<br>L<br>O<br>N</th>
        <th class="tg-hgcj" rowspan="2"><br>G<br>O<br>L<br>O<br>N<br>G<br>A<br>N</th>
        <th class="tg-hgcj" colspan="2">SUSUNAN<br>KELUARGA</th>
        <th class="tg-hgcj" rowspan="2" style="max-width: 10px;">K<br>E<br>L<br>A<br>S<br><br>J<br>A<br>B<br>A<br>T<br>A<br>N</th>
        <th class="tg-hgcj" style="text-align: left;width: 110px;" rowspan="2">
          A. GAJI POKOK<br><br>
          B. TUNJANGAN<br>
          STRUKTURAL/<br>FUNGSIONAL/<br>UMUM<br><br>
          C. GAJI KOTOR<br>
        </th>
        <th class="tg-hgcj" style="text-align: left;width: 110px;" rowspan="2">D. TUNJANGAN<br>KINERJA<br><br>E. TUNJANGAN<br>PENYESUAIAN<br>PENGHASILAN<br><br>F. TUNJANGAN<br>KHUSUS<br><br>G. POT ABSEN<br>(%)</th>
        <th class="tg-hgcj" style="text-align: left;width: 110px;" rowspan="2">H. TUNJANGAN<br>KINERJA BERSIH<br>(D+E+F-G)<br><br>I. TUNJANGAN PPH 21<br><br>J. TUNJANGAN KINERJA KOTOR (H+1)<br><br>K. POT PPH 21</th>
        <th class="tg-hgcj" style="text-align: left;width: 110px;" rowspan="2">TUNJANGAN KINERJA YANG DIBAYARKAN (J-K)</th>
        <th class="tg-hgcj" rowspan="2">REKENING</th>
        <th class="tg-hgcj" rowspan="2">KETERANGAN</th>
      </tr>
      <tr>
        <td class="tg-hgcj" style="border-right: 3px; solid #000;">NIP</td>
        <th class="tg-hgcj">STATUS KAWIN</th>
        <th class="tg-hgcj">JUMLAH ANAK</th>
      </tr>
  <tr>
    <td class="tg-baqh">1</td>
    <td class="tg-baqh">2</td>
    <td class="tg-baqh">3</td>
    <td class="tg-baqh">4</td>
    <td class="tg-baqh">5</td>
    <td class="tg-baqh">6</td>
    <td class="tg-baqh">7</td>
    <td class="tg-baqh">8</td>
    <td class="tg-baqh">9</td>
    <td class="tg-baqh">10</td>
    <td class="tg-baqh">11</td>
    <td class="tg-baqh">12</td>
    <td class="tg-baqh">13</td>
  </tr>
  <?php
    $stt = false;
  ?>
  @endif
  @for($l =  $k * 3; $l <($k * 3) + 3; $l++)
  <?php
    $ttlJmlA = $ttlJmlA + str_replace(".", "", $rekap['jumlahA'][$l]);
    $ttlJmlB = $ttlJmlB + str_replace(".", "", $rekap['jumlahB'][$l]);
    $ttlJmlC = $ttlJmlC + str_replace(".", "", $rekap['jumlahC'][$l]);
    $ttlJmlD = $ttlJmlD + str_replace(".", "", $rekap['jumlahD'][$l]);
    $ttlJmlE = $ttlJmlE + str_replace(".", "", $rekap['jumlahE'][$l]);
    $ttlJmlF = $ttlJmlF + str_replace(".", "", $rekap['jumlahF'][$l]);
    $ttlJmlG = $ttlJmlG + str_replace(".", "", $rekap['jumlahG'][$l]);
    $ttlJmlH = $ttlJmlH + str_replace(".", "", $rekap['jumlahH'][$l]);
    $ttlJmlI = $ttlJmlI + str_replace(".", "", $rekap['jumlahI'][$l]);
    $ttlJmlJ = $ttlJmlJ + str_replace(".", "", $rekap['jumlahJ'][$l]);
    $ttlJmlK = $ttlJmlK + str_replace(".", "", $rekap['jumlahK'][$l]);
    $ttlJmlL = $ttlJmlL + str_replace(".", "", $rekap['jumlahL'][$l]);
  ?>
  <tr>
    <td class="tg-yw4l">{{$l + 1}}</td>
    <td class="tg-yw4l" colspan="6">LEMBAR KE : {{$l + 1}}</td>
    <td class="tg-yw4l">{{$rekap['jumlahA'][$l]}}<br>{{$rekap['jumlahB'][$l]}}<br>{{$rekap['jumlahC'][$l]}}</td>
    <td class="tg-yw4l">{{$rekap['jumlahD'][$l]}}<br>{{$rekap['jumlahE'][$l]}}<br>{{$rekap['jumlahF'][$l]}}<br>{{$rekap['jumlahG'][$l]}}</td>
    <td class="tg-yw4l">{{$rekap['jumlahH'][$l]}}<br>{{$rekap['jumlahI'][$l]}}<br>{{$rekap['jumlahJ'][$l]}}<br>{{$rekap['jumlahK'][$l]}}</td>
    <td class="tg-yw4l">{{$rekap['jumlahL'][$l]}}</td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
  @endfor
  <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l" colspan="6">JUMLAH</td>
    <td class="tg-yw4l">{{number_format($ttlJmlA,0,',','.')}}<br>{{number_format($ttlJmlB,0,',','.')}}<br>{{number_format($ttlJmlC,0,',','.')}}</td>
    <td class="tg-yw4l">{{number_format($ttlJmlD,0,',','.')}}<br>{{number_format($ttlJmlE,0,',','.')}}<br>{{number_format($ttlJmlF,0,',','.')}}<br>{{number_format($ttlJmlG,0,',','.')}}</td>
    <td class="tg-yw4l">{{number_format($ttlJmlH,0,',','.')}}<br>{{number_format($ttlJmlI,0,',','.')}}<br>{{number_format($ttlJmlJ,0,',','.')}}<br>{{number_format($ttlJmlK,0,',','.')}}</td>
    <td class="tg-yw4l">{{number_format($ttlJmlL,0,',','.')}}</td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr>
{{--   <tr>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
    <td class="tg-yw4l"></td>
  </tr> --}}
</table>
@if($k == round(count($rekap['jumlahA'])/3) -1 || $k == count($rekap['jumlahA']))
<style type="text/css">
.sikil  {border-collapse:collapse;border-spacing:0; width: 100%; margin-top: 20px;}
.sikil td{font-family:Arial, sans-serif;font-size:10px;padding:5px;overflow:hidden;word-break:normal;}
/*.sikil th{font-family:Arial, sans-serif;font-size:10px;padding:5px;overflow:hidden;word-break:normal;}*/
.sikil .sikil-yw4l{vertical-align:top}
</style>
<table class="sikil">
  <tr>
    <td class="sikil-031e" style="padding: 0px;">STATUS KAWIN/PERKAWINAN</td>
    <td class="sikil-031e" style="padding: 0px;"></td>
    <td class="sikil-031e" style="padding: 0px;"></td>
    <td class="sikil-031e" style="padding: 0px;">JAKARTA, {{strtoupper(date('d F Y'))}}</td>
  </tr>
  <tr>
    <td class="sikil-031e" rowspan="5" style="vertical-align: top;">TK = TIDAK KAWIN<br>K1 = KAWIN<br>D =DUDA<br>J = JANDA</td>
    <td class="sikil-031e" style="padding: 0px;">MENGETAHUI/MENYETUJUI :</td>
    <td class="sikil-031e"></td>
    <td class="sikil-031e"></td>
  </tr>
  <tr>
    <td class="sikil-031e" style="padding: 0px;">PEJABAT PEMBUAT KOMITMEN</td>
    <td class="sikil-031e" style="padding: 0px;">BENDAHARA</td>
    <td class="sikil-031e" style="padding: 0px;">PPABP BELANJA PEGAWAI</td>
  </tr>
  <tr>
    <td class="sikil-031e" style="padding: 50px 0px 0px;">{{App\User::where('id',$data['pejabat_pembuat_komitmen'])->first()->name}}</td>
    <td class="sikil-031e" style="padding: 50px 0px 0px;">{{App\User::where('id',$data['bendahara'])->first()->name}}</td>
    <td class="sikil-031e" style="padding: 50px 0px 0px;">{{App\User::where('id',$data['belanja_pegawai'])->first()->name}}</td>
  </tr>
  <tr>
    <td class="sikil-yw4l" style="padding: 0px;">NIP. {{App\User::where('id',$data['pejabat_pembuat_komitmen'])->first()->nip}}</td>
    <td class="sikil-yw4l" style="padding: 0px;">NIP. {{App\User::where('id',$data['bendahara'])->first()->nip}}</td>
    <td class="sikil-yw4l" style="padding: 0px;">NIP. {{App\User::where('id',$data['belanja_pegawai'])->first()->nip}}</td>
  </tr>
</table>
<div class="teacherPage"></div>
@endif
@endfor
