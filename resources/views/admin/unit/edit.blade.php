@extends('layouts.master')

@section('page_title')
Manajemen Unit
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="header">
				<h4 class="title">Edit Unit/Deputi</h4>
			</div>
			<div class="content">
				<form role="form" class="form-horizontal" method="post" action="">
            		<div class="form-group">
            			<div class="col-md-12">
	            			<label for="" class="control-label">Nama Unit/Deputi</label>
            				<input type="text" name="nama_unit" class="form-control border-input" id="nama_unit" value="{{$unit->nama_unit}}">
            			</div>
            		</div>
            		<div class="form-group">
            			<input type="hidden" name="_token" value="{{csrf_token()}}">
            			<input type="hidden" name="id" value="{{$unit->id}}">
            			<div class="col-md-12">
            				<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i>&nbsp; Simpan</button>
            			</div>
            		</div>
            	</form>
			</div>

		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
</script>
@endsection