@extends('layouts.master')

@section('page_title')
Manajemen Grade
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="header">
				<h4 class="title"><b>Edit Grade</b></h4>
			</div>
			<div class="content">
				<form role="form" class="form-horizontal" method="post" action="grade/update">
            		<div class="form-group">
            			<div class="col-md-4">
	            			<label for="" class="control-label">Grade</label>
            				<select name="grade" id="id" class="form-control border-input" required="required">
            					<option>--Pilih Grade--</option>
            					@forelse($grade as $g)
            						<option value="{{$g->id}}">{{$g->grade}}</option>
            					@empty
            					@endforelse
            				</select>
            			</div>
            			<div class="col-md-4" style="padding-left: 15px;padding-right: 10px;">
            				<label class="control-label">Tunjangan Kinerja</label>
            				<div class="input-group border-input">
							  <span class="input-group-addon border-input" id="sizing-addon1">Rp. </span>
							  <input type="number" class="form-control border-input" value="" name="tunjangan_kinerja" id="tunjangan_kinerja" min="1" step="1" aria-describedby="sizing-addon1" required="required">
							</div>
            			</div>
            			<div class="col-md-4" style="padding-left: 15px;padding-right: 10px;">
            				<label class="control-label">Dasar Hukum</label>
            				<input type="text" name="dasar_hukum" id="dasar_hukum" class="form-control border-input" required="required">
            			</div>
            		</div>
            		<div class="form-group">
            			<input type="hidden" name="_token" value="{{csrf_token()}}">
            			<div class="col-md-12">
            				<button type="submit" class="btn btn-success btn-fill pull-right"><i class="fa fa-floppy-o"></i>&nbsp; Simpan</button>
            			</div>
            		</div>
            	</form>
			</div>
		</div>
	</div>
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title"><b>Data Grade</b></h4>
            </div>
            <div class="content">
                <table class="table table-responsive table-full-width" id="users-table">
			        <thead>
			            <tr>
			                <th class="text-center"><b>No</b></th>
			                <th class="text-center"><b>Grade</b></th>
			                <th class="text-center"><b>Tunjangan Kinerja</b></th>
			                <th class="text-center"><b>Dasar Hukum</b></th>
			            </tr>
			        </thead>
			        <tbody>
			        	@forelse($grade as $k => $v)
			        		<tr>
			        			<td class="text-center">{{($v->id)}}</td>
			        			<td class="text-center">{{$v->grade}}</td>
			        			<td class="text-center">Rp {{number_format($v->tunjangan_kinerja, '0', ',', '.')}}</td>
			        			<td class="text-center">{{$v->dasar_hukum}}</td>
			        		</tr>
			        	@empty
			        	@endforelse
			        </tbody>
			    </table>
			    <div class="" style="text-align: center;">
			    </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$('#id').change(function(){
			$.ajax({
				url: '{{url('grade')}}/' + $(this).val(),
				dataType: 'json',
				type:'GET',
				success: function (data) {
					$('#tunjangan_kinerja').val(data.tunjangan_kinerja);
					$('#dasar_hukum').val(data.dasar_hukum);
					// console.log(data);
				},
				error: function(data){

				}
			});
		});
	});
</script>
@endsection