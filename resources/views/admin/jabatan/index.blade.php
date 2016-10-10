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
            	<a href="/jabatan/create" class="btn btn-success btn-fill"><i class="fa fa-plus"></i>&nbsp; Tambah Jabatan</a>
                <table class="table table-responsive table-full-width" id="users-table">
			        <thead>
			            <tr>
			                <th>Id</th>
			                <th>Nama Jabatan</th>
			                <th>Kelas Jabatan</th>
			                <th>Unit/Deputi</th>
			                <th style="min-width: 122px;">Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	@forelse($jabatan as $k => $v)
			        		<tr>
			        			<td>{{($v->id)}}</td>
			        			<td>{{$v->nama_jabatan}}</td>
			        			<td>{{$v->kelas_jabatan}}</td>
			        			<td>{{\App\Unit::find($v->unit_id)->nama_unit}}</td>
			        			<td>
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