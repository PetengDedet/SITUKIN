<!DOCTYPE HTML>
<html>
<head>
<title>Login - Si Tukin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Si Tukin" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="{{ asset('css/bootstrap.min.css') }}" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="{{ asset('css/style.css') }}" rel='stylesheet' type='text/css' />
<link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet"> 
<script src="{{ asset('js/jquery.min.js') }}"> </script>
<script src="{{ asset('js/bootstrap.min.js') }}"> </script>
</head>
<body>
	<div class="login">
		<h1><a href="index.html">Si Tukin </a></h1>
		<div class="login-bottom">
			<h2>Login</h2>
			 @include('notifications')
			<form action="{{ URL::to('login') }}" method="post">
			{{ csrf_field() }}
			<div class="col-md-12">
				<div class="login-mail">
					<input type="text" placeholder="NIP" name="nip" required="">
					<i class="fa fa-user"></i>
				</div>
				<div class="login-mail">
					<input type="password" placeholder="Password" name="password" required="">
					<i class="fa fa-lock"></i>
				</div>
				   <div class="col-md-12 login-do">
						<label class="hvr-shutter-in-horizontal login-sub">
							<input type="submit" value="login">
							</label>
							
					</div>

			
			</div>
			
			<div class="clearfix"> </div>
			</form>
		</div>
	</div>
		<!---->
<!---->
<!--scrolling js-->
	<script src="{{ asset('js/jquery.nicescroll.js') }}"></script>
	<script src="{{ asset('js/scripts.js') }}"></script>
	<!--//scrolling js-->
</body>
</html>