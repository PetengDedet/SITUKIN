@extends('layouts.master')

@section('page_title')
Detail Jabatan
@endsection

@section('css')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="col-md-6 col-md-offset-3">
			<div class="card">
				<div class="header">
					<h4 class="title">Detail Jabatan</h4>
				</div>
				<div class="content">
					<dl class="dl-horizontal">
						<dt>ID</dt>
						<dd>{{$jabatan->id}}</dd>
						<dt>Nama Jabatan</dt>
						<dd>{{$jabatan->nama_jabatan}}</dd>
						<dt>Unit/Deputi</dt>
						<dd>{{\App\Unit::find($jabatan->unit_id)->nama_unit}}</dd>
						<dt>Kelas Jabatan</dt>
						<dd>{{$jabatan->kelas_jabatan}}</dd>
					</dl>
				</div>
				<div class="footer text-center">
            		<a href="/admin/jabatan" class="btn btn-default btn-fill"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
            		<a href="/admin/jabatan/edit/{{$jabatan->id}}" class="btn btn-primary btn-fill"><i class="fa fa-pencil"></i>&nbsp; Edit</a>
            		<a href="/admin/jabatan/delete/{{$jabatan->id}}" class="btn btn-danger btn-fill"><i class="fa fa-trash"></i>&nbsp; Hapus</a>
            		<hr>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
</script>
@endsection