@extends('layouts.master')

@section('page_title')
Rekap Data
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
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
          <form action="rekap-data" method="get">
            <div class="header">
                <h4 class="title"><strong>Rekap Data</strong><button type="submit" class="btn btn-success btn-fill" style="float: right;">Simpan Data</button></h4>
                <br>
                <div class="form-group">
                    <label>Bulan</label>
                    <div class="row">
                      <div class="col-md-6">
                        <select class="form-control border-input" required="" >
                          <?php
                            $i = 1;
                            $month = strtotime('2016-01-01');
                            $monthNow = date("F");
                            while($i <= 12)
                            {
                                $month_name = date('F', $month);
                                if($month_name == $monthNow){
                                  echo '<option selected value="'. $month_name. '">'.$month_name.'</option>';
                                }else{
                                  echo '<option value="'. $month_name. '">'.$month_name.'</option>';
                                }
                                
                                $month = strtotime('+1 month', $month);
                                $i++;
                            }

                            $yearNow = date("Y");
                          ?>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <select class="form-control border-input" required="" >
                          @for($i = 2000; $i < 2019; $i++)
                            @if($i == $yearNow)
                              <option selected="" value="{{$i}}">{{$i}}</option>
                            @else
                              <option value="{{$i}}">{{$i}}</option>
                            @endif
                          @endfor
                        </select>
                      </div>
                    </div>  
                </div>
                <div class="form-group">
                    <label>Unit Kerja</label>
                    <select class="form-control border-input" required="" >
                      @foreach(App\Unit::get() as $dataUnit)
                          <option selected="" value="{{$dataUnit->id}}">{{$dataUnit->nama_unit}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label></label>
                    <button type="submit" class="btn btn-success btn-fill" style="float: right;">Set Bulan</button>
                </div>
                <br>
            </div>
            </form>
            <div class="content">
                <table class ="table table-responsive table-full-width" id="users-table">
    			        <thead>
    			            <tr>
    			                <th style="text-align: center;">ID</th>
    			                <th style="text-align: center;">Nama Pegawai</th>
    			                <th style="text-align: center;">Kinerja Bulanan</th>
                          <th style="text-align: center;">Potongan Absensi</th>
    			                <th style="text-align: center;">Potongan Disiplin</th>
    			            </tr>
    			        </thead>
                  <tbody>
                      <script type="text/javascript">var dataInput = "";</script>
                      @foreach(App\User::where('nip','!=','admin')->get() as $data)
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
                        <td style="text-align: center;">{{$data->id}}</td>
                        <td style="text-align: center;">{{$data->name}}</td>
                        <td style="text-align: center;">
                          <div class="form-group border-input" style="width: 60%">
                            <div class="input-group">
                              <input style="text-align: center;" class="form-control border-input"  min="0" max="100" intOnly="true"  name="kinerja_bulanan[]" id="kinerja_bulanan_{{$data->id}}" required="" type="text">
                              <span class="input-group-addon">
                                <span class="fa fa-percent"></span>
                              </span>
                            </div>
                          </div>
                        </td>
                        <td style="text-align: center;">{{$dataUnit}}</td>
                        <td style="text-align: center;">
                          <?php
                            $countHukumanPegawai = App\HukumanPegawai::where('user_id','=',$data->id)->count();
                            if($countHukumanPegawai > 0){
                              $dataHukumanPegawai = App\HukumanPegawai::where('user_id','=',$data->id)->orderBy('id','DESC')->first();
                              $getDataHukuman = App\HukumanDisiplin::where('id','=',$dataHukumanPegawai->hukuman_id)->first();

                              $persentaseHukumanPegawai = $getDataHukuman->potongan;
                            }else{
                              $persentaseHukumanPegawai = "0";
                            }
                          ?>
                          <div class="form-group border-input" style="width: 60%">
                            <div class="input-group">
                              <input  style="text-align: center;" class="form-control border-input"  min="0" max="100" intOnly="true"  name="potongan_disiplin[]" readonly="" value="{{$persentaseHukumanPegawai}}" type="text">
                              <span class="input-group-addon">
                                <span class="fa fa-percent"></span>
                              </span>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <script>dataInput += '{{$data->id}}|'</script>
                      @endforeach
                  </tbody>
			          </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script type="text/javascript" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#users-table').DataTable({
      "language": {
        "emptyTable": "Tidak ada data Rekap Pegawai"
      }
    });
    SplitData = dataInput.split('|');
    for(i = 0; i < SplitData.length ; i++){
      setdata(SplitData[i])
    }
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
</script>
@include('notification')
@endsection