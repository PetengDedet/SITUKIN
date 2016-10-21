@extends('layouts.master')

@section('page_title')
Rekap Data {{$request->unit_kerja}}
<?php $status = true; ?>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap.min.css')}}">
<style type="text/css">
  input[type=number]::-webkit-inner-spin-button, 
  input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
    margin: 0; 
  }
</style>
<style type="text/css">
  .modal-backdrop.fade{
    z-index: 0;  
  }
  #modalPotonganAbsensi .modal-dialog
  {
    width: 70%;
  }
</style>
@endsection

@section('content')
<?php
use App\Library\RoleLib;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Unit;

$getUserData = Sentinel::getUser();

if($request->tahun){
  $tahunnya = $request->tahun;

}else{
  $tahunnya = date('Y');
}

if($request->bulan){
  $bulannya = $request->bulan;
}else{
  $bulannya = date('F');
}

if($request->unit_kerja){
  $unitnya = $request->unit_kerja;
}else{
  $unitnya = $getUserData->unit_id;
}
?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <form action="rekap-data" method="GET">
        <div class="header">
          <h4 class="title"><strong>Rekap Data</strong></h4>
          <br>
          @if(RoleLib::limitThis('4',Sentinel::getUser()->id))
          <div class="form-group">
            <div class="row">
              <div class="col-md-2">
                <select name="bulan" class="form-control border-input" required="" >
                  <?php
                  $i = 1;
                  $month = strtotime('2016-01-01');
                  $monthNow = $bulannya;
                  $monthStatus = true;
                  while($i <= 12)
                  {
                    $month_name = date('F', $month);



                    if($request->bulan == $month_name){
                      if($monthStatus){
                        $monthStatus = false;
                        echo '<option selected value="'. $month_name. '">'.$month_name.'</option>';    
                      }else{
                        echo '<option value="'. $month_name. '">'.$month_name.'</option>';
                      }

                    }else{
                      if($month_name == $monthNow){
                        if($monthStatus){
                          echo '<option selected value="'. $month_name. '">'.$month_name.'</option>';
                        }else{
                          echo '<option value="'. $month_name. '">'.$month_name.'</option>';
                        }
                      }else{
                        echo '<option value="'. $month_name. '">'.$month_name.'</option>';
                      }
                    }

                    $month = strtotime('+1 month', $month);
                    $i++;
                  }

                  $yearNow = date("Y");
                  ?>
                </select>
              </div>
              <div class="col-md-2">
                <select name="tahun" class="form-control border-input" required="" >
                  @for($i = 2016; $i <= $yearNow; $i++)
                  @if($i == $yearNow)
                  <option selected="" value="{{$i}}">{{$i}}</option>
                  @else
                  <option value="{{$i}}">{{$i}}</option>
                  @endif
                  @endfor
                </select>
              </div>
              <div class="col-md-8">
                <!-- <label>Unit Kerja</label> -->
                <select name="unit_kerja" class="form-control border-input" required="" >
                  <option>-- Unit Kerja --</option>
                  @foreach(App\Unit::get() as $dataUnit)
                  @if($request->unit_kerja == $dataUnit->id)
                  <option selected value="{{$dataUnit->id}}">{{$dataUnit->nama_unit}}</option>
                  @else
                  <option value="{{$dataUnit->id}}">{{$dataUnit->nama_unit}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>  
          </div>

          <div class="form-group">
            <label></label>
            <button type="submit" class="btn btn-success btn-fill" style="float: right;">Filter Data</button>
          </div>
          <br>
          @else


          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <input type="text" readonly="" class="form-control border-input"  value="{{$bulannya}}" name="bulan">

              </div>
              <div class="col-md-6">
                <input type="text" readonly="" class="form-control border-input"  value="{{$tahunnya}}" name="tahun">
              </div>
            </div>  
          </div>
          <div class="form-group">
            <label>Unit Kerja</label>
            <?php
            $checkUnitKerja = Unit::where('id','=',$getUserData->unit_id)->count();
            if($checkUnitKerja > 0){
              $getDataUnitKerja = Unit::where('id','=',$getUserData->unit_id)->first();
              $nama_unit_kerja = $getDataUnitKerja->nama_unit;
            }else{
              $nama_unit_kerja = "Anda belum memiliki unit kerja";
            }


            echo $unitnya;                   
            ?>
            <input type="hidden" value="{{$getUserData->unit_id}}" name="unit_id"/>
            <input type="text" readonly="" class="form-control border-input"  value="{{$nama_unit_kerja}}" >
          </div>
          <br>
          @endif
        </div>
      </form>
      <form action="simpan-rekap-data" method="post">
        {{csrf_field()}}
        <input type="hidden" name="tahun" value="{{$tahunnya}}"/>
        <input type="hidden" name="bulan" value="{{$bulannya}}"/>
        <div class="content">

        <style type="text/css">
        .form-group.border-input{
          margin-bottom: 0px;
        }
        .input-group{
         margin-bottom: 0px; 
        }
        </style>

          <table class ="table table-full-width" id="users-table" style="margin-top:50px;">
           <thead>
             <tr>
               <th style="text-align: center;"><b>NIP</b></th>
               <th style="text-align: center;"><b>Nama Pegawai</b></th>
               @if(RoleLib::limitThis('2',Sentinel::getUser()->id))
               <th style="text-align: center;"><b>Kinerja Bulanan</b></th>
               @endif
               @if(RoleLib::limitThis('3',Sentinel::getUser()->id))
               <th style="text-align: center;"><b>Potongan Absensi</b></th>
               <th style="text-align: center;"><b>Potongan Disiplin</b></th>
               @endif
             </tr>
           </thead>
           <tbody>
            <script type="text/javascript">var dataInput = "";</script>
            @forelse(App\User::where('nip','!=','admin')->where('unit_id','=',$unitnya)->get() as $data)
            <input type="hidden" name="pegawai_id[]" value="{{$data->id}}">
            <?php
            $dataUnit = "";
            $checkUnit = App\Unit::where('id','=',$data->unit_id)->count();
            if($checkUnit > 0){
              $getDataUnit = App\Unit::where('id','=',$data->unit_id)->first();
              $dataUnit = $getDataUnit->nama_unit;
            }

            $dataJabatan = "";
            $checkJabatan = App\Jabatan::where('id','=',$data->jabatan_id)->count();
            if($checkJabatan > 0){
              $getDataJabatan = App\Jabatan::where('id','=',$data->jabatan_id)->first();
              $dataJabatan = $getDataJabatan->nama_jabatan;
            }
            ?>
            <tr>
              <td style="text-align: center;"><span style="font-size:13px !important;">{{$data->nip}}</span></td>
              <td style="text-align: center;"><span style="font-size:13px !important;">{{$data->name}}</span></td>

              @if(RoleLib::limitThis('2',Sentinel::getUser()->id))
              <td align="center">
                <input type="hidden" name="dari" value="protakel">
                <?php
                $checkRekapDataKinerjaBulanan = App\KinerjaBulanan::where('pegawai_id','=',$data->id)->where('bulan','=',$bulannya)->where('tahun','=',$tahunnya)->count();
                ?>
                @if($checkRekapDataKinerjaBulanan > 0)
                <?php 
                $dataKinerjaBulanan = App\KinerjaBulanan::where('pegawai_id','=',$data->id)->where('bulan','=',$bulannya)->where('tahun','=',$tahunnya)->first();
                ?>
                <div class="form-group border-input">
                  <div class="input-group">
                    <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="{{$dataKinerjaBulanan->persentase}}" style="text-align: center;" class="form-control border-input"  min="0" max="100" intOnly="true"  name="kinerja_bulanan[]" id="kinerja_bulanan_{{$data->id}}" type="text">
                    <span class="input-group-addon" required>
                      <span class="fa fa-percent"></span>
                    </span>
                  </div>
                </div>
                @else
                <div class="form-group border-input">
                  <div class="input-group">
                    <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align: center;" class="form-control border-input"  min="0" max="100" intOnly="true" value="" name="kinerja_bulanan[]" id="kinerja_bulanan_{{$data->id}}" type="text" required>
                    <span class="input-group-addon">
                      <span class="fa fa-percent"></span>
                    </span>
                  </div>
                </div>
                @endif

              </td>
              @endif

              @if(RoleLib::limitThis('3',Sentinel::getUser()->id))
              <input type="hidden" name="from" value="sdm">
              <td align="center" onclick="showModal('{{$data->id}}','{{$data->name}}');">
                <?php
                $checkRekapDataPotonganAbsensi = App\PotonganAbsensi::where('pegawai_id','=',$data->id)->where('bulan','=',$bulannya)->where('tahun','=',$tahunnya)->count();
                ?>
                @if($checkRekapDataPotonganAbsensi > 0)
                <?php
                $dataRekapDataPotonganAbsensi = App\PotonganAbsensi::where('pegawai_id','=',$data->id)->where('bulan','=',$bulannya)->where('tahun','=',$tahunnya)->first();
                ?>
                <div class="form-group border-input" >
                  <div class="input-group">
                    <input value="{{$dataRekapDataPotonganAbsensi->total_potongan_absen}}" style="text-align: center;" class="readonly form-control border-input"  min="0" max="100" intOnly="true"  required="" id="potongan_absen_{{$data->id}}" name="potongan_absen[]" "type="text">
                    <span class="input-group-addon">
                      <span class="fa fa-percent"></span>
                    </span>
                  </div>
                </div>
                @else
                <div class="form-group border-input" >
                  <div class="input-group">
                    <input  style="text-align: center;" class="readonly form-control border-input"  min="0" max="100" intOnly="true" id="potongan_absen_{{$data->id}}"  required="" name="potongan_absen[]" "type="text">
                    <span class="input-group-addon">
                      <span class="fa fa-percent"></span>
                    </span>
                  </div>
                </div>
                @endif
                @endif
              </td>
              @if(RoleLib::limitThis('3',Sentinel::getUser()->id))
              <td align="center">
                <?php
                $countHukumanPegawai = App\HukumanPegawai::where('user_id','=',$data->id)->count();
                if($countHukumanPegawai > 0){
                  $dataHukumanPegawai = App\HukumanPegawai::where('user_id','=',$data->id)->orderBy('id','DESC')->first();
                  $getDataHukuman = App\HukumanDisiplin::where('id','=',$dataHukumanPegawai->hukuman_id)->first();

                  $curdate=strtotime(date('Y-m-d H:i:s'));
                  $mydate=strtotime($dataHukumanPegawai->berakhir);
                  if($curdate > $mydate)
                  {
                    $persentaseHukumanPegawai = "0";
                  }else{
                    $persentaseHukumanPegawai = $getDataHukuman->potongan;
                  }
                }else{
                  $persentaseHukumanPegawai = "0";
                }
                ?>
                <div class="form-group border-input">
                  <div class="input-group">
                    <input  style="text-align: center;" class="readonly form-control border-input"  min="0" max="100" intOnly="true"  name="potongan_disiplin[]" value="{{$persentaseHukumanPegawai}}" type="text">
                    <span class="input-group-addon">
                      <span class="fa fa-percent"></span>
                    </span>
                  </div>
                </div>
              </td>
              @endif
            </tr>
            <script>dataInput += '{{$data->id}}|'</script>
            @if($status)
            <div style="float: right;">
              @if((RoleLib::limitThis('2',Sentinel::getUser()->id) AND date('d') < 20) || (RoleLib::limitThis('3',Sentinel::getUser()->id) AND date('d') < 22))
              <button type="submit" class="btn btn-primary btn-fill">Simpan Data</button>
              @endif

              <a href="{{url('export-data/'.$unitnya)}}" class="btn btn-warning btn-fill">Export Data</a>

            </div>
            <?php $status = false; ?>
            @endif
            @empty
            <tr>
              <td colspan="5" align="center"><b>Tidak ada data pegawai di unit kerja ini.</b></td>
            </tr>
            @endforelse
          </tbody>

        </table>
      </div>

      <br>
    </form>

  </div>
</div>
</div>
<div id="modalPotonganAbsensi" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form id="formAbsensis">
        <input type="hidden" name="pegawai_id" id="pegawai_id">
        <input type="hidden" name="tahun" id="tahuns">
        <input type="hidden" name="bulan" id="bulans">
        {{csrf_field()}}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h6>Potongan Absensi untuk "<strong id="nama_pegawai"></strong>"</h6>
        </div>
        <div class="modal-body">
          <div class="row">   
            <div class="col-md-4">
              <strong><b>Terlambat Masuk Kantor</b></strong>
              <div class="form-group">
                TL 1: 07:31 - 08:31
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="tl1" id="tl1" placeholder="">
              </div>
              <div class="form-group">
                TL 2: 08:31 - 09:01
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="tl2" id="tl2" placeholder="">
              </div>
              <div class="form-group">
                TL 3: 09:01 - 09:31
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="tl3" id="tl3" placeholder="">
              </div>
              <div class="form-group">
                TL 4: 09:31 - 10:00
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="tl4" id="tl4" placeholder="">
              </div>
              <div style="margin-bottom: 70px;"></div>
              <strong><b>Pulang Sebelum Waktunya</b></strong>
              <div class="form-group">
                PSW 1: 15:31 - < 16:00
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="psw1" id="psw1" placeholder="">
              </div>
              <div class="form-group">
                PSW 2: 15:01 - 15:31
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="psw2" id="psw2" placeholder="">
              </div>
              <div class="form-group">
                PSW 3: 14:01 - 15:01
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="psw3" id="psw3" placeholder="">
              </div>
              <div class="form-group">
                PSW 4: < 14:00
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="psw4" id="psw4" placeholder="">
              </div>
            </div>
            <div class="col-md-4">
              <strong><b>Cuti-Cuti</b></strong>
              <div class="form-group">
                Cuti Tahunan
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="cuti_tahunan" id="cuti_tahunan" placeholder="">
              </div>
              <div class="form-group">
                Cuti Alasan Penting
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="cuti_alasan_penting" id="cuti_alasan_penting" placeholder="">
              </div>
              <div class="form-group">
                Cuti Sakit Tidak Rawat Inap
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="cuti_sakit_tidak_rawat_inap" id="cuti_sakit_tidak_rawat_inap" placeholder="">
              </div>
              <div class="form-group">
                Cuti Sakit Rawat Inap
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="cuti_sakit_rawat_inap" id="cuti_sakit_rawat_inap" placeholder="">
              </div>
              <div class="form-group">
                Cuti Sakit Rawat Jalan
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="cuti_sakit_rawat_jalan" id="cuti_sakit_rawat_jalan" placeholder="">
              </div>
              <div class="form-group">
                Cuti Gugur Kandungan
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="cuti_gugur_kandungan" id="cuti_gugur_kandungan" placeholder="">
              </div>
              <div class="form-group">
                Cuti Bersalin
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="cuti_bersalin" id="cuti_bersalin" placeholder="">
              </div>
              <div class="form-group">
                Cuti Besar
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="cuti_besar" id="cuti_besar" placeholder="">
              </div>
              <div class="form-group">
                Cuti Luar Tanggungan Negara
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="cuti_luar_tanggungan_negara" id="cuti_luar_tanggungan_negara" placeholder="">
              </div>
            </div>
            <div class="col-md-4">
              <strong><b>Cuti Lainnya</b></strong>
              <div class="form-group">
                Alpha
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="cuti_alpha" id="cuti_alpha" placeholder="">
              </div>
              <div class="form-group">
                Izin
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="cuti_ijin" id="cuti_ijin" placeholder="">
              </div>
              <div class="form-group">
                Dinas Luar
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="cuti_dinas_luar" id="cuti_dinas_luar" placeholder="">
              </div>
              <div class="form-group">
                Tugas Belajar
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="cuti_tugas_belajar" id="cuti_tugas_belajar" placeholder="">
              </div>
              <div class="form-group">
                Bebas Tugas
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="hitungAbsensi();" style="text-align: center;" type="text" class="form-control border-input" name="bebas_tugas" id="bebas_tugas" placeholder="">
              </div>

              <div style="margin-top: 241px;">
                <font color="red"><b>Total Potongan Absen</b></font>
                <div class="form-group border-input">
                  <div class="input-group">
                    <input style="text-align: center;" class="form-control border-input" readonly="" name="total_potongan_absen" id="total_potongan_absen" type="text">
                    <span class="input-group-addon">
                      <span class="fa fa-percent"></span>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default save_absensi">Simpan</button>
        </div>
      </form>
    </div>

  </div>
</div>
@endsection

@section('js')

<script type="text/javascript" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript">
  var urlRoot = '{{url('/')}}';
  $(".readonly").keydown(function(e){
    e.preventDefault();
  });
  $(document).ready(function(){
    SplitData = dataInput.split('|');
    for(i = 0; i < SplitData.length ; i++){
      setdata(SplitData[i])
    }

    $(".save_absensi").click(function(){
      var formnya = $("form").serialize();

      $.ajax( {
        type: "POST",
        url: urlRoot + "/tambah-potongan-absen",
        data: formnya,
        success: function( response ) {
          console.log( response );
        }
      });
      $('#modalPotonganAbsensi').modal('hide');

      $.notify({
        message: 'Data absensi berhasil disimpan.' 
      },{
        placement: {
          from: "bottom",
          align: "left"
        },
        type: 'success'
      });

      $('#potongan_absen_' + $('#pegawai_id').val()).val($('#total_potongan_absen').val());

    });
  });

  function setdata(id){
    $("#kinerja_bulanan_" + id).each(function () {
      var thisJ = $(this);
      var max = thisJ.attr("max") * 1;
      var min = thisJ.attr("min") * 1;
      var intOnly = String(thisJ.attr("intOnly")).toLowerCase() == "true";

      var test = function (str) {
        return str == "" || /* (!intOnly && str == ".") || */
        ($.isNumeric(str) && str * 1 <= max && str * 1 >= min &&
          (!intOnly || str.indexOf(".") == -1) && str.match(/^0\d/) == null);
              // commented out code would allow entries like ".7"
            };

            thisJ.keydown(function () {
              var str = thisJ.val();
              if (test(str)) thisJ.data("dwnval", str);
            });

            thisJ.keyup(function () {
              var str = thisJ.val();
              if (!test(str)) thisJ.val(thisJ.data("dwnval"));
            })
          });
  }

  function showModal(id,nama){
    $('#pegawai_id').val(id);
    $('#nama_pegawai').html(nama);
    $('#bulans').val('{{$bulannya}}');
    $('#tahuns').val('{{$tahunnya}}');
    $('#modalPotonganAbsensi').modal('show');

    var dataPostPostAbsensi = "pegawai_id=" + id + "&bulan={{$bulannya}}&tahun={{$tahunnya}}&_token={{csrf_token()}}";
    $.ajax( {
      type: "POST",
      url: urlRoot + "/datapotonganabsensi",
      data: dataPostPostAbsensi,
      success: function( response ) {
        if(response.PotonganAbsensi.length > 0){
          $('#tl1').val(response.PotonganAbsensi[0].tl1);
          $('#tl2').val(response.PotonganAbsensi[0].tl2);
          $('#tl3').val(response.PotonganAbsensi[0].tl3);
          $('#tl4').val(response.PotonganAbsensi[0].tl4);
          $('#psw1').val(response.PotonganAbsensi[0].psw1);
          $('#psw2').val(response.PotonganAbsensi[0].psw2);
          $('#psw3').val(response.PotonganAbsensi[0].psw3);
          $('#psw4').val(response.PotonganAbsensi[0].psw4);
          $('#cuti_tahunan').val(response.PotonganAbsensi[0].cuti_tahunan);
          $('#cuti_alasan_penting').val(response.PotonganAbsensi[0].cuti_alasan_penting);
          $('#cuti_sakit_tidak_rawat_inap').val(response.PotonganAbsensi[0].cuti_sakit_tidak_rawat_inap);
          $('#cuti_sakit_rawat_inap').val(response.PotonganAbsensi[0].cuti_sakit_rawat_inap);
          $('#cuti_sakit_rawat_jalan').val(response.PotonganAbsensi[0].cuti_sakit_rawat_jalan);
          $('#cuti_gugur_kandungan').val(response.PotonganAbsensi[0].cuti_gugur_kandungan);
          $('#cuti_bersalin').val(response.PotonganAbsensi[0].cuti_bersalin);
          $('#cuti_besar').val(response.PotonganAbsensi[0].cuti_besar);
          $('#cuti_luar_tanggungan_negara').val(response.PotonganAbsensi[0].cuti_luar_tanggungan_negara);
          $('#cuti_alpha').val(response.PotonganAbsensi[0].cuti_alpha);
          $('#cuti_ijin').val(response.PotonganAbsensi[0].cuti_ijin);
          $('#cuti_dinas_luar').val(response.PotonganAbsensi[0].cuti_dinas_luar);
          $('#cuti_tugas_belajar').val(response.PotonganAbsensi[0].cuti_tugas_belajar);
          $('#bebas_tugas').val(response.PotonganAbsensi[0].bebas_tugas);
          $('#total_potongan_absen').val(response.PotonganAbsensi[0].total_potongan_absen);
        }else{
          $('#tl1').val("");
          $('#tl2').val("");
          $('#tl3').val("");
          $('#tl4').val("");
          $('#psw1').val("");
          $('#psw2').val("");
          $('#psw3').val("");
          $('#psw4').val("");
          $('#cuti_tahunan').val("");
          $('#cuti_alasan_penting').val("");
          $('#cuti_sakit_tidak_rawat_inap').val("");
          $('#cuti_sakit_rawat_inap').val("");
          $('#cuti_sakit_rawat_jalan').val("");
          $('#cuti_gugur_kandungan').val("");
          $('#cuti_bersalin').val("");
          $('#cuti_besar').val("");
          $('#cuti_luar_tanggungan_negara').val("");
          $('#cuti_alpha').val("");
          $('#cuti_ijin').val("");
          $('#cuti_dinas_luar').val("");
          $('#cuti_tugas_belajar').val("");
          $('#bebas_tugas').val("");
          $('#total_potongan_absen').val("0");
        }
      }
    });
  }

  var tl1, tl2, tl3, tl4, psw1, psw2, psw3, psw4, cuti_tahunan, cuti_alasan_penting, cuti_sakit_tidak_rawat_inap, cuti_sakit_rawat_inap,cuti_sakit_rawat_jalan,cuti_gugur_kandungan, cuti_bersalin,cuti_besar,cuti_luar_tanggungan_negara,cuti_alpha,cuti_ijin,cuti_dinas_luar, cuti_tugas_belajar, bebas_tugas, cuti_alpha, cuti_ijin, cuti_dinas_luar , cuti_tugas_belajar, bebas_tugas;
  function hitungAbsensi(){
    if($('#tl1').val() == ""){
      tl1 = 0;
    }else{
      tl1 = parseFloat($('#tl1').val());
    }

    if($('#tl2').val() == ""){
      tl2 = 0;
    }else{
      tl2 = parseFloat($('#tl2').val());
    }

    if($('#tl3').val() == ""){
      tl3 = 0;
    }else{
      tl3 = parseFloat($('#tl3').val());
    }

    if($('#tl4').val() == ""){
      tl4 = 0;
    }else{
      tl4 = parseFloat($('#tl4').val());
    }

    if($('#psw1').val() == ""){
      psw1 = 0;
    }else{
      psw1 = parseFloat($('#psw1').val());
    }

    if($('#psw2').val() == ""){
      psw2 = 0;
    }else{
      psw2 = parseFloat($('#psw2').val());
    }

    if($('#psw3').val() == ""){
      psw3 = 0;
    }else{
      psw3 = parseFloat($('#psw3').val());
    }

    if($('#psw4').val() == ""){
      psw4 = 0;
    }else{
      psw4 = parseFloat($('#psw4').val());
    }


    if($('#cuti_tahunan').val() == ""){
      cuti_tahunan = 0;
    }else{
      cuti_tahunan = parseFloat($('#cuti_tahunan').val());
    }

    if($('#cuti_alasan_penting').val() == ""){
      cuti_alasan_penting = 0;
    }else{
      cuti_alasan_penting = parseFloat($('#cuti_alasan_penting').val());
      if(cuti_alasan_penting > 3){
        cuti_alasan_penting = cuti_alasan_penting - 3;
      }else{
        cuti_alasan_penting = 0;
      }
    }

    if($('#cuti_sakit_tidak_rawat_inap').val() == ""){
      cuti_sakit_tidak_rawat_inap = 0;
    }else{
      cuti_sakit_tidak_rawat_inap = parseFloat($('#cuti_sakit_tidak_rawat_inap').val());
      if(cuti_sakit_tidak_rawat_inap > 2){
        cuti_sakit_tidak_rawat_inap = cuti_sakit_tidak_rawat_inap - 2;
      }else{
        cuti_sakit_tidak_rawat_inap = 0;
      }
    }

    if($('#cuti_sakit_rawat_inap').val() == ""){
      cuti_sakit_rawat_inap = 0;
    }else{
      cuti_sakit_rawat_inap = parseFloat($('#cuti_sakit_rawat_inap').val());
      if(cuti_sakit_rawat_inap > 3){
        cuti_sakit_rawat_inap = cuti_sakit_rawat_inap - 3;
      }else{
        cuti_sakit_rawat_inap = 0;
      }
    }

    if($('#cuti_sakit_rawat_jalan').val() == ""){
      cuti_sakit_rawat_jalan = 0;
    }else{
      cuti_sakit_rawat_jalan = parseFloat($('#cuti_sakit_rawat_jalan').val());
    }

    if($('#cuti_gugur_kandungan').val() == ""){
      cuti_gugur_kandungan = 0;
    }else{
      cuti_gugur_kandungan = parseFloat($('#cuti_gugur_kandungan').val());
      if(cuti_gugur_kandungan > 5){
        cuti_gugur_kandungan = cuti_gugur_kandungan - 5;
      }else{
        cuti_gugur_kandungan = 0;
      }
    }

    if($('#cuti_bersalin').val() == ""){
      cuti_bersalin = 0;
    }else{
      cuti_bersalin = parseFloat($('#cuti_bersalin').val());
      if(cuti_bersalin > 5){
        cuti_bersalin = cuti_bersalin - 5;
      }else{
        cuti_bersalin = 0;
      }
    }

    if($('#cuti_besar').val() == ""){
      cuti_besar = 0;
    }else{
      cuti_besar = parseFloat($('#cuti_besar').val());
    }

    if($('#cuti_luar_tanggungan_negara').val() == ""){
      cuti_luar_tanggungan_negara = 0;
    }else{
      cuti_luar_tanggungan_negara = parseFloat($('#cuti_luar_tanggungan_negara').val());
    }

    if($('#cuti_alpha').val() == ""){
      cuti_alpha = 0;
    }else{
      cuti_alpha = parseFloat($('#cuti_alpha').val());
    }

    if($('#cuti_ijin').val() == ""){
      cuti_ijin = 0;
    }else{
      cuti_ijin = parseFloat($('#cuti_ijin').val());
    }

    if($('#cuti_dinas_luar').val() == ""){
      cuti_dinas_luar = 0;
    }else{
      cuti_dinas_luar = parseFloat($('#cuti_dinas_luar').val());
    }

    if($('#cuti_tugas_belajar').val() == ""){
      cuti_tugas_belajar = 0;
    }else{
      cuti_tugas_belajar = parseFloat($('#cuti_tugas_belajar').val());
    }

    if($('#bebas_tugas').val() == ""){
      bebas_tugas = 0;
    }else{
      bebas_tugas = parseFloat($('#bebas_tugas').val());
    }

    

    var total = (tl1 * 0) + (tl2 * 1) + (tl3 * 1.25) + (tl4 * 1.5) + (psw1 * 0.5) + (psw2 * 1) + (psw3 * 1.25) + (psw4 * 1.5) + (cuti_tahunan * 0) + (cuti_alasan_penting * 3) + (cuti_sakit_tidak_rawat_inap * 3) + (cuti_sakit_rawat_inap * 2.5) + (cuti_sakit_rawat_jalan * 2.5) + (cuti_gugur_kandungan * 3) + (cuti_bersalin * 3) + (cuti_besar * 100) + (cuti_luar_tanggungan_negara * 100) + (cuti_alpha * 3) + (cuti_ijin * 3) + (  cuti_dinas_luar * 0) + (cuti_tugas_belajar * 0) + ( bebas_tugas * 100);
    $('#total_potongan_absen').val(total);
  }

</script>
@include('notification')
@endsection