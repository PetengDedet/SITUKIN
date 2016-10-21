@extends('layouts.master')

@section('page_title')
Manajemen Jabatan
@endsection

@section('css')
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Data Jabatan</h4>
            </div>
            <div class="content">
            	<a href="/jabatan/create" class="btn btn-primary btn-fill pull-right"><i class="fa fa-plus"></i>&nbsp; Tambah Jabatan</a>
                <table class="table table-responsive table-full-width" id="users-table">
			        <thead>
			            <tr>
			                <th class="text-center"><b>Id</b></th>
			                <th class="text-center"><b>Nama Jabatan</b></th>
			                <th class="text-center"><b>Kelas Jabatan</b></th>
			                <th class="text-center"><b>Unit/Deputi</b></th>
			                <th class="text-center" style="min-width: 122px;"><b>Action</b></th>
			            </tr>
			        </thead>
			        <tbody>
			        	@forelse($jabatan as $k => $v)
			        		<tr>
			        			<td class="text-center" >{{($v->id)}}</td>
			        			<td class="text-center" >{{$v->nama_jabatan}}</td>
			        			<td class="text-center" >{{$v->kelas_jabatan}}</td>
			        			<td class="text-center" >{{\App\Unit::find($v->unit_id)->nama_unit}}</td>
			        			<td class="text-center" >
			        				<a href="{{url('/jabatan/' . $v->id )}}" class="btn btn-default btn-sm btn-fill"><i class="fa fa-eye"></i></a>
			        				<a href="{{url('/jabatan/edit/' . $v->id )}}" class="btn btn-warning btn-sm btn-fill"><i class="fa fa-pencil"></i></a>
			        			</td>
			        		</tr>
			        	@empty
			        	@endforelse
			        </tbody>
			    </table>
			    <div class="" style="text-align: center;">
			    	{{$jabatan->links()}}
			    </div>
            </div>
            <div class="footer">
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
</script>
@endsection