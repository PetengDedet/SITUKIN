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
        <th>KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN</th>
    </tr>
    <tr>
        <th style="text-align: center;">Formulir Rekapitulasi Laporan Capaian Kinerja Bulanan Pegawai</th>
    </tr>
</table>

<table class="ndas">
    <tr>
        <td class="ndas-031e" style="width: 140px;">UNIT KERJA ESELON I</td>
        <td class="ndas-031e">:</td>
        <td class="ndas-031e" style="text-align: left;"></td>
    </tr>
    <tr>
    <td class="ndas-031e">BULAN</td>
        <td class="ndas-031e" style="width: 5px;">:</td>
        <td class="ndas-031e" style="text-align: left;">SEPTEMBER 2016</td>
    </tr>
</table>

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
<table class="kol">
    <tr>
        <th style="text-align: center;">No</th>
        <th style="text-align: center;">Nama Pegawai</th>
        <th style="text-align: center;">Kinerja Bulanan<br>(%)</th>
    </tr>
    @for($i=1; $i<=10; $i++)
        <tr>
            <td>{{$i}}</td>
            <td></td>
            <td></td>
        </tr>
    @endfor
</table>

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
        <td style="width: 30%;padding-top: 70px;">Nama</td>
    </tr>
        <tr>
        <td style="width: 35%;"></td>
        <td style="width: 35%;"></td>
        <td style="width: 30%;">NIP</td>
    </tr>
</table>

<div class="teacherPage"></div>