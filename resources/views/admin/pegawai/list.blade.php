@extends('layouts.master')

@section('page_title')
Manajemen Pegawai
@endsection

@section('css')
{{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"> --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap.min.css')}}">
<script type="text/javascript" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

@endsection
<style type="text/css">
  .modal-backdrop.fade{
    z-index: 0;  
  }
</style>
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
            
                <h4 class="title"><strong>Data Pegawai</strong></h4>
                <br>
                <a class="btn btn-success btn-fill" href="{{url('pegawai/create')}}"><i class="fa fa-plus"></i>&nbsp; Tambah Pegawai</a>
                
            </div>
            <div class="content">
                <table class ="table table-responsive table-full-width" id="users-table">
    			        <thead>
    			            <tr>
    			                <th style="text-align: center;">NIP</th>
    			                <th style="text-align: center;">Name</th>
    			                <th style="text-align: center;">Unit</th>
                          <th style="text-align: center;">Jabatan</th>
    			                <th style="text-align: center;width: 120px;">Action</th>
    			            </tr>
    			        </thead>
                  <tbody>
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
                        <td style="text-align: center;">{{$data->nip}}</td>
                        <td style="text-align: center;">{{$data->name}}</td>
                        <td style="text-align: center;">{{$dataUnit}}</td>
                        <td style="text-align: center;">{{$dataJabatan}}</td>
                        <td style="text-align: center;">
                        <a href="{{url('pegawai/' . $data->id )}}" class="btn btn-default btn-sm btn-fill"><i class="fa fa-eye"></i></a><a href="{{url('delete-pegawai/' . $data->id )}}" class="btn btn-warning btn-sm btn-fill"><i class="fa fa-close"></i></a>
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
			          </table>
            </div>
        </div>
    </div>
</div>
<div id="modalPegawai" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="simpan-pegawai" method="post">
      {{csrf_field()}}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Data Pegawai</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
              <label>NIP</label>
              <input type="text" class="form-control border-input" name="nip" placeholder="Nomor Induk Pegawai" required="">
          </div>
          <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control border-input" name="name" placeholder="Nama" required="">
          </div>
          <div class="form-group">
              <label>Unit Kerja</label>
              <select name="unit_id" id="unit_id" class="form-control border-input" required="" >
                    <option ></option>
                  @foreach(App\Unit::get() as $data)
                    <option value="{{$data->id}}">{{$data->nama_unit}}</option>
                  @endforeach
              </select>
          </div>
          <div class="form-group">
              <label>Jabatan</label>
              <select name="jabatan_id" id="jabatan_id" class="form-control border-input" required="" >
                <span id="dataJabatan"></span>
              </select>
          </div>
          <div class="form-group">
              <label>Gaji Pokok</label>
              <input type="number" class="form-control border-input" name="gaji_pokok" placeholder="Gaji Pokok" required="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default">Simpan</button>
        </div>
      </form>
    </div>

  </div>
</div>
<div id="modalEditPegawai" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="edit-pegawai" method="post">
      <input type="hidden" name="id" id="id" required="" />
      {{csrf_field()}}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Data Pegawai</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
              <label>NIP</label>
              <input type="text" id="nip" class="form-control border-input" name="nip" placeholder="Nomor Induk Pegawai" required="">
          </div>
          <div class="form-group">
              <label>Nama</label>
              <input type="text" id="name" class="form-control border-input" name="name" placeholder="Nama" required="">
          </div>
          <div class="form-group">
              <label>Unit Kerja</label>
              <select name="unit_id" id="unit_id" class="form-control border-input" required="" >
                    <option value=""></option>
                  @foreach(App\Unit::get() as $data)
                    <option value="{{$data->id}}">{{$data->nama_unit}}</option>
                  @endforeach
              </select>
          </div>
          <div class="form-group">
              <label>Jabatan</label>
              <select name="jabatan_id" id="jabatan_id_edit" class="form-control border-input" required="" >
                <span id="dataJabatan"></span>
              </select>
          </div>
          <div class="form-group">
              <label>Gaji Pokok</label>
              <input type="number" id="gaji_pokok" class="form-control border-input" name="gaji_pokok" placeholder="Gaji Pokok" required="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default">Simpan</button>
        </div>
      </form>
    </div>

  </div>
</div>
<div id="importModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="{{url('pegawai/import-data')}}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Import Data</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
              <label>CSV File</label>
              <input type="file" name="csv_file" accept=".csv" class="form-control border-input" required="" >
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default">Save</button>
        </div>
      </div>
    </form>

  </div>
</div>
@endsection

@section('js')

<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#users-table').DataTable({
      "language": {
        "emptyTable": "Tidak ada data pegawai"
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
          $('#gaji_pokok').val(response.User.gjpokok);

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