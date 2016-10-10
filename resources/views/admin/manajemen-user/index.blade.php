@extends('layouts.master')

@section('page_title')
Manajemen User
@endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
	body > div > div.main-panel > div > div > div > div > div > form > div > div.content > div:nth-child(1) > span > span.selection > span
	{
		height: 40px;
	}
	.badge-warning {
		background: #FF9800;
	}
	.badge-info {
		background: #2196F3;
	}
	.badge-success {
		background: #4CAF50;
	}
	.badge-danger {
		background: #f44336;
	}
</style>
@endsection
<style type="text/css">
	.modal-backdrop.fade{
		z-index: 0;  
	}
</style>
@section('content')

<div class="row">
	<div class="col-md-12">
		<form action="{{url('manajemen/simpan')}}" method="post">
			{{csrf_field()}}
			<div class="card">
				<div class="header">
					{{-- <h4 class="title"><strong>Data Hukuman Displin</strong></h4> --}}
					@if(Session::has('message'))
						<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
					@endif
				</div>
				<div class="content">
					<div class="form-group">
						<label>Pegawai</label>
						<select required="" name="user_id" id="user_id" class="form-control border-input">
							<option></option>
							@foreach($dataPegawai as $dataPegawai)
							<option value="{{$dataPegawai->id}}">{{$dataPegawai->name}} - {{$dataPegawai->nip}}</option>
							@endforeach
						</select>
					</div>

					<div class="well" id="detailContainer">
						<dl class="dl-horizontal">
							<dt>Nama</dt>
							<dd id="detNama"></dd>
							<dt>NIP</dt>
							<dd id="detNip"></dd>
							<dt>Unit Kerja</dt>
							<dd id="detUnit"></dd>
							<dt>Jabatan</dt>
							<dd id="detJabatan"></dd>
							<dt>Status Kepegawaian</dt>
							<dd id="detStatus"></dd>
						</dl>
					</div>
					<div class="form-group">
						<label>Role</label>
						<select required="" name="role" id="role" class="form-control border-input">
							<option value="1">Pegawai</option>
							<option value="2">Protakel</option>
							<option value="3">SDM</option>
							<option value="4">Administrator</option>
                		</select>
            		</div>
            <div class="form-group">
            	<button class="btn btn-success btn-fill" type="submit">Simpan</button>
            </div>
        </div>
    </div>
</form>
</div>
	<div class="col-md-12">
		<div class="card">
			<div class="header">
				<h4>Data Role</h4>
			</div>
			<div class="content">
				<table class="table table-responsive table-condensed table-full-width">
					<thead>
						<tr>
							<th>No</th>
							<th>Pegawai</th>
							<th>Sebagai</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@forelse($roles as $key => $role)
							<tr>
								<td>{{ ($roles->currentpage()-1) * $roles->perpage() + $key + 1 }}</td>
								<td>{{App\User::where('id', $role->user_id)->first()->name}}</td>
								<td>
									<?php
										switch ($role->role_id) {
											case 1:
												echo '<span class="badge badge-default">&nbsp;</span>&nbsp; Pegawai';
												break;
											case 2:
												echo '<span class="badge badge-info">&nbsp;</span>&nbsp; Protakel';
												break;
											case 3:
												echo '<span class="badge badge-success">&nbsp;</span>&nbsp; SDM';
												break;
											case 4:
												echo '<span class="badge badge-danger">&nbsp;</span>&nbsp; Administrator';
												break;
											default:
												echo '<span class="badge badge-default">&nbsp;</span>&nbsp; Pegawai';
												break;
										}
									?>
								</td>
								<td>
									<form method="post" action="{{url('manajemen/hapus')}}">
										{{csrf_field()}}
										<input type="hidden" name="role_id" value="{{$role->role_id}}">
										<input type="hidden" name="user_id" value="{{$role->user_id}}">
										<button type="submit" class="btn btn-fill btn-danger btn-sm" onclick="return confirm('Yakin?')"><i class="fa fa-trash"></i></button>
									</form>
								</td>
							</tr>
						@empty
						@endforelse
					</tbody>
				</table>
				<div style="text-align:center;">
					{{$roles->links()}}
				</div>
			</div>
			<div class="footer">
				
			</div>
		</div>
		
	</div>
</div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
	var urlRoot = '{{url('/')}}';
	$(document).ready(function(){
		$('#detailContainer').hide();
		$("#user_id").select2();
		$('#user_id').change(function(){
			// alert($(this).val());
			var id = $(this).val();
			$.ajax({
				url: '{{url('getselected')}}/' + id,
				type: 'GET',
				dataType: 'json',
				beforeSend: function() {
					$('#detNama').text('');
					$('#detNip').text('');
					$('#detUnit').text('');
					$('#detJabatan').text('');
					$('#detStatus').text('');

					$('#detailContainer').hide('fast');

				},
				success: function(data) {
					$('#detNama').text(data.name);
					$('#detNip').text(data.nip);
					$('#detUnit').text(data.unit);
					$('#detJabatan').text(data.jabatan);
					$('#detStatus').text(data.status_pegawai);
					
					$('#detailContainer').show('fast');

				},
				error: function(data) {
					
				}
			});

		});
	});
</script>
@endsection