@extends('layouts.master')

@section('page_title')
Tambah Hukuman Disiplin
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
<script type="text/javascript" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

@endsection
<style type="text/css">
  .modal-backdrop.fade{
    z-index: 0;  
  }
</style>
@section('content')
<?php
  $dataHukuman = App\HukumanPegawai::where('id','=',$id)->first();
?>
<div class="row">
  <div class="col-md-12">
    <form action="{{url('hukuman-pegawai/simpan')}}" method="post">
      {{csrf_field()}}
      <div class="card">
        <div class="header">
            <h4 class="title"><strong>Data Hukuman Displin</strong></h4>
        </div>
        <div class="content">
          <div class="form-group">
              <label>Pegawai</label>
              <select required="" name="user_id" id="user_id" class="form-control border-input">
                <option></option>
                @foreach(App\User::get() as $dataPegawai)
                <option value="{{$dataPegawai->id}}">{{$dataPegawai->name}} - {{$dataPegawai->nip}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
              <label>Hukuman</label>
              <select required="" name="hukuman_id" id="hukuman_id" class="form-control border-input">
                <option></option>
                @foreach(App\HukumanDisiplin::get() as $dataHukuman)
                <option value="{{$dataHukuman->id}}">{{$dataHukuman->status_hukuman}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
          <button class="btn btn-success btn-fill" type="submit">Simpan</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
var urlRoot = '{{url('/')}}';
  $(document).ready(function(){
    $("#user_id").select2();
    $("#hukuman_id").select2();
  });
</script>
@endsection
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
              <h4 class="title"><strong>Data Hukuman Disiplin Pegawai</strong></h4>
              <br>
              <a class="btn btn-success btn-fill" href="hukuman-disiplin/tambah">Tambah Hukuman</a>
            </div>
            <div class="content">
                <table class ="table table-responsive table-full-width" id="hukuman-table">
    			        <thead>
    			            <tr>
                          <th style="text-align: center;">NIP</th>
    			                <th style="text-align: center;">Nama Pegawai</th>
    			                <th style="text-align: center;">Status Hukuman</th>
                          <th style="text-align: center;">Berakhir Pada</th>
    			                <th style="text-align: center;">Action</th>
    			            </tr>
    			        </thead>
                  <tbody>
                      @foreach(App\HukumanPegawai::get() as $data)
                      <?php
                        $dataNip = "";
                        $dataNama = "";
                        $checkUser = App\User::where('id','=',$data->user_id)->count();
                        if($checkUser > 0){
                            $getDataUser = App\User::where('id','=',$data->user_id)->first();
                            $dataNip = $getDataUser->nip;
                            $dataNama = $getDataUser->name;
                        }

                        $dataStatusHukuman = "";
                        $dataJenisHukuman = "";
                        $checkHukuman = App\HukumanDisiplin::where('id','=',$data->hukuman_id)->count();
                        if($checkHukuman > 0){
                            $getDataHukuman = App\HukumanDisiplin::where('id','=',$data->hukuman_id)->first();
                            $dataStatusHukuman = $getDataHukuman->status_hukuman;
                            $dataJenisHukuman = $getDataHukuman->jenis_hukuman;
                        }
                      ?>
                      <tr>
                        <td style="text-align: center;">{{$dataNip}}</td>
                        <td style="text-align: center;">{{$dataNama}}</td>
                        <td style="text-align: center;">{{$dataStatusHukuman}}</td>
                        <td style="text-align: center;">{{date("d F Y", strtotime($data->berakhir))}}</td>
                        <td style="text-align: center;"><a href="#" onclick="loadData('{{$data->id}}');"><i class="ti-slice"></i></a>&nbsp;&nbsp;<a href="delete-hukuman/{{$data->id}}"><i class="ti-close"></i></a></td>
                      </tr>
                      @endforeach
                  </tbody>
			          </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#hukuman-table').DataTable({
      "language": {
        "emptyTable": "Tidak ada data pegawai yang terkena hukuman disiplin"
      }
    });
    $("#unit_id").change(function () {
      var values = "unit_id=" + $('select[name=unit_id]').val() + "&_token={{csrf_token()}}";
      $.ajax({
        url: "jabatanjson",
        type: "post",
        data: values ,
        success: function (response) {
          $('#jabatan_id').html('');
          var html = "";
            for(i = 0; i < response.Jabatan.length; i++){
              html += "<option value='" + response.Jabatan[i].id + "'>" + response.Jabatan[i].nama_jabatan + "</option>";
            }
            $('#jabatan_id').html(html);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
      });
    });
  });

  function loadData(id){
    var responses = "";
    var values = "id=" + id + "&_token={{csrf_token()}}";
      $.ajax({
        url: "userjson",
        type: "post",
        data: values ,
        success: function (response) {
          $('#id').val(response.User.id);
          $('#nip').val(response.User.nip);
          $('#name').val(response.User.name);
          $('#unit_id').val(response.User.unit_id).change();
          responses = response.User.jabatan_id;
          //$('#jabatan_id').val(response.User.jabatan_id);
          $('#gaji_pokok').val(response.User.gaji_pokok);

          var valuess = "unit_id=" + response.User.unit_id + "&_token={{csrf_token()}}";

          $.ajax({
            url: "jabatanjson",
            type: "post",
            data: valuess ,
            success: function (responsedua) {
              $('#jabatan_id').html('');
              var html = "";
                for(i = 0; i < responsedua.Jabatan.length; i++){
                  //alert(responsedua.Jabatan[i].nama_jabatan);
                  html += "<option value='" + responsedua.Jabatan[i].id + "'>" + responsedua.Jabatan[i].nama_jabatan + "</option>";
                }
                //alert(html);
                $('#jabatan_id_edit').html(html);

                $("select#jabatan_id_edit option")
                  .each(function() { 
                    this.selected = ($(this).val() == responses); 
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
          });

          $("select#unit_id option")
            .each(function() { 
              this.selected = ($(this).val() == response.User.unit_id); 
          });

          $('#modalEditPegawai').modal('show')


        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
      });
  }
</script>
@include('notification')
@endsection