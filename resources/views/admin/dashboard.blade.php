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
                <h4 class="title">Users Behavior</h4>
                <p class="category">24 Hours performance</p>
            </div>
            <div class="content">
                <table class="table table-responsive table-full-width" id="users-table">
			        <thead>
			            <tr>
			                <th>Id</th>
			                <th>Name</th>
			                <th>Email</th>
			                <th>Action</th>
			            </tr>
			        </thead>
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
	$(function() {
	    $('#users-table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{!! route('admin.dashboard.user.datatables') !!}',
	        columns: [
	            { data: 'id', name: 'id' },
	            { data: 'name', name: 'name' },
	            { data: 'email', name: 'email' },
	            { data: 'action', name: 'action', searchable:false }
	        ]
	    });
	});
</script>
@endsection