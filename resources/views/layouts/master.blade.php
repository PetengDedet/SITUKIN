<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Si Tukin</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
 

    <!-- Bootstrap core CSS     -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{asset('assets/css/paper-dashboard.css')}}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('assets/css/demo.css')}}" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{asset('assets/css/themify-icons.css')}}" rel="stylesheet">

@yield('css')

</head>
<body>

<div class="wrapper">
@include('layouts.sidebar')
<div class="main-panel">
@include('layouts.topnav')
   <div class="content">
            <div class="container-fluid">
                <div class="row">
@yield('content')

                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>

                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                    </ul>
                </nav>
				<div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> Kemenko Perekonomian RI
                </div>
            </div>
        </footer>

    </div>
</div>

<!--   Core JS Files   -->
    <script src="{{asset('assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="{{asset('assets/js/bootstrap-checkbox-radio.js')}}"></script>

    <!--  Charts Plugin -->
    <script src="{{asset('assets/js/chartist.min.js')}}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{asset('assets/js/bootstrap-notify.js')}}"></script>

    <!--  Google Maps Plugin    -->
    {{-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> --}}

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    <script src="{{asset('assets/js/paper-dashboard.js')}}"></script>

    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{asset('assets/js/demo.js')}}"></script>

@yield('js')

</body>
</html>