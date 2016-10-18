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
<table class="ndas">
    <tr>
        <th class="ndas-031e"style="text-align: left">KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN</th>
    </tr>
</table>

<table class="ndas" style="width: 100%;">
    <tr>
        <th class="ndas-031e" colspan="2" style="text-align: center;">DAFTAR PEMBAYARAN TUNJANGAN KINERJA</th>
    </tr>
    <tr>
        <th class="ndas-031e" style="text-align: right;width: 50%;">BULAN:</th>
        <th class="ndas-031e" style="text-align: left;width: 50%;">{{date('F Y')}}</th>
    </tr>
</table>

<table class="ndas">
    <tr>
        <th class="ndas-031e"style="text-align: left">UNIT ORGANISASI: </th>
        <th class="ndas-031e"style="text-align: right">TGL PROSES: {{date('d F Y')}}</th>
    </tr>
    <tr>
        <th class="ndas-031e"style="text-align: left"></th>
        <th class="ndas-031e"style="text-align: right">Halaman: </th>
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
    <th class="tg-031e" rowspan="4">No. Urut</th>
    <th class="tg-031e">Nama</th>
    <th class="tg-yw4l" rowspan="4">ESELON</th>
    <th class="tg-yw4l" rowspan="4">GOLONGAN</th>
    <th class="tg-yw4l" colspan="2">SUSUNAN<br>KELUARGA</th>
    <th class="tg-yw4l" rowspan="4">PERINGKAT JABATAN</th>
    <th class="tg-yw4l">A. GAJI POKOK</th>
    <th class="tg-yw4l">D. TUNJANGAN<br>KINERJA</th>
    <th class="tg-yw4l">H.KINERJA BER.<br>(D+E+F-G)</th>
    <th class="tg-yw4l" rowspan="4">T. KINERJA YANG<br>DIBAYARKAN<br>(J - K )</th>
    <th class="tg-yw4l" rowspan="4">REKENING</th>
    <th class="tg-yw4l" rowspan="4">KETERANGAN</th>
  </tr>
  <tr>
    <td class="tg-031e" rowspan="3">NIP</td>
    <td class="tg-yw4l" rowspan="3">STS.<br>KA<br>WIN</td>
    <td class="tg-yw4l" rowspan="3">JML<br>ANAK</td>
    <td class="tg-yw4l">B. TUNJANGAN<br>STRUK/FUNG/<br>UMUM</td>
    <td class="tg-yw4l">E. TUNJANGAN<br>PENYESUAIAN<br>PENGHASILAN</td>
    <td class="tg-yw4l">I. TUNJANGAN<br>PPH 21</td>
  </tr>
  <tr>
    <td class="tg-yw4l" rowspan="2">C. GAJI KOTOR</td>
    <td class="tg-yw4l" rowspan="2">G. POT ABSES<br>(%)</td>
    <td class="tg-yw4l">J. T. KINERJA KOT.<br>(H+I)</td>
  </tr>
  <tr>
    <td class="tg-yw4l">K. POT. PPH 21 </td>
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
  <tr>
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
    <td class="sikil-031e" style="padding: 0px;">JAKARTA, 29 AGUSTUS 2016</td>
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
    <td class="sikil-031e" style="padding: 50px 0px 0px;">Agam Embun Sunarpati</td>
    <td class="sikil-031e" style="padding: 50px 0px 0px;">FARHANI LAINUFAR</td>
    <td class="sikil-031e" style="padding: 50px 0px 0px;">DODI WAHYUGI, ST, MMSI</td>
  </tr>
  <tr>
    <td class="sikil-yw4l" style="padding: 0px;">NIP .196309141983101001</td>
    <td class="sikil-yw4l" style="padding: 0px;">NIP .199109282014022002</td>
    <td class="sikil-yw4l" style="padding: 0px;">NIP .198106222003121003</td>
  </tr>
</table>
<div class="teacherPage"></div>