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
<table class="ndas">
  <tr>
    <th class="ndas-031e" colspan="2" style="text-align: left">KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN</th>
  </tr>
  <tr>
    <th class="ndas-031e" style="width:115px;">UNIT ORGANISASI :</th>
    <th class="ndas-031e">KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN</th>
  </tr>
</table>

<table class="ndas" style="width: 100%;">
  <tr>
    <th class="ndas-031e" colspan="2" style="text-align: center;">REKAPITULASI PEMBAYARAN TUNJANGAN KINERJA PEGAWAI</th>
  </tr>
  <tr>
    <th class="ndas-031e" style="text-align: right;width: 50%;">BULAN:</th>
    <th class="ndas-031e" style="text-align: left;width: 50%;">SEPTEMBER 2016</th>
  </tr>
</table>


<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:10px;padding:5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:10px;font-weight:bolder;padding:5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-yw4l{vertical-align:top}
</style>

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
  @for($i = 1; $i<=17;$i++)
    <tr>
      <td class="tg-yw4l">{{$i}}</td>
      <td class="tg-yw4l"></td>
      <td class="tg-yw4l"></td>
      <td class="tg-yw4l"></td>
      <td class="tg-yw4l"></td>
      <td class="tg-yw4l"></td>
    </tr>
  @endfor
  <tr>
      <th class="tg-yw4l"></th>
      <th class="tg-yw4l">JUMLAH</th>
      <th class="tg-yw4l">-</th>
      <th class="tg-yw4l"></th>
      <th class="tg-yw4l" style="text-align: left;">
        1. {{-- --}}<br>
        2. {{-- --}}<br>
        3. {{-- --}}<br>
      </th>

      <th class="tg-yw4l" style="text-align: left;">
        1. {{-- --}}<br>
        2. {{-- --}}<br>
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