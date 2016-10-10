@extends('layouts.master')

@section('page_title')
Manajemen Grade
@endsection

@section('css')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="header">
				<h4 class="title">Detail Unit/Deputi</h4>
			</div>
			<div class="content">
				<dl class="dl-horizontal">
					<dt>ID</dt>
					<dd>{{$unit->id}}</dd>
					<dt>Nama Unit/Deputi</dt>
					<dd>{{$unit->nama_unit}}</dd>
				</dl>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
</script>
@endsection