@extends('layouts.master')

@section('page_title')
Dashboard
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
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
            <br>
            	<button style="float:right;" class="btn btn-success"  data-toggle="modal" data-target="#modalPegawai">Tambah Pegawai</button>
            	<br>
            	<br>
                <h4 class="title">Data Pegawai</h4>
            </div>
            <div class="content">
                <table class ="table table-responsive table-full-width" id="users-table">
    			        <thead>
    			            <tr>
    			                <th>ID</th>
    			                <th>NIP</th>
    			                <th>Name</th>
    			                <th>Email</th>
    			                <th>Action</th>
    			            </tr>
    			        </thead>
                  <tbody>
                      @foreach(App\User::where('nip','!=','admin')->get() as $data)
                      <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->id}}</td>
                        <td>{{$data->id}}</td>
                        <td>{{$data->id}}</td>
                        <td></td>
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
          <h4 class="modal-title">Tambah Pegawai</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
              <label>NIP</label>
              <input type="text" class="form-control border-input" placeholder="Nomor Induk Pegawai" required="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default">Simpan</button>
        </div>
      </form>
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
    $('#users-table').DataTable({
      "language": {
        "emptyTable": "Tidak ada data pegawai"
      }
    });
  });
</script>
@include('notification')
@endsection