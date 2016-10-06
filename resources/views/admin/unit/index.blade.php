@extends('layouts.master')

@section('page_title')
Dashboard
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="header">
				<h4 class="title">Tambah Unit/Deputi</h4>
			</div>
			<div class="content">
				<form role="form" class="form-horizontal" method="post" action="">
            		<div class="form-group">
            			<div class="col-md-12">
	            			<label for="" class="control-label">Nama Unit/Deputi</label>
            				<input type="text" name="nama_unit" class="form-control border-input" id="nama_unit">
            			</div>
            		</div>
            		<div class="form-group">
            			<input type="hidden" name="_token" value="{{csrf_token()}}">
            			<div class="col-md-12">
            				<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i>&nbsp; Simpan</button>
            			</div>
            		</div>
            	</form>
			</div>

		</div>
	</div>
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Data Unit / Deputi</h4>
            </div>
            <div class="content">
                <table class="table table-responsive table-full-width" id="users-table">
			        <thead>
			            <tr>
			                <th>Id</th>
			                <th>Nama</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	@forelse($unit as $k => $v)
			        		<tr>
			        			<td>{{($k+1)}}</td>
			        			<td>{{$v->nama_unit}}</td>
			        			<td>{{$v->id}}</td>
			        		</tr>
			        	@empty
			        	@endforelse
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
	// $(function() {
	//     $('#users-table').DataTable({
	//         processing: true,
	//         serverSide: true,
	//         ajax: '{!! route('admin.dashboard.user.datatables') !!}',
	//         columns: [
	//             { data: 'id', name: 'id' },
	//             { data: 'name', name: 'name' },
	//             { data: 'email', name: 'email' },
	//             { data: 'action', name: 'action', searchable:false }
	//         ]
	//     });
	// });
</script>
@endsection