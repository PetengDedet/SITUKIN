@if ($errors->any())
<div class="alert alert-info fade in">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  	<strong>Terdapat Kesalahan</strong>
</div>
@endif

@if ($message = Session::get('success'))<div class="alert bg-4">
<div class="alert alert-success fade in">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  	<strong>{{$message}}!</strong>
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-info fade in">
  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  	<strong>{{$message}}</strong>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-info fade in">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  	<strong>{{$message}}</strong>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info fade in">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  	<strong>{{$message}}</strong>
</div>
@endif
