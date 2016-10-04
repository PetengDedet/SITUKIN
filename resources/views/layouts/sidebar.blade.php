
</head>
<body>

<div class="wrapper">
	<div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="" class="simple-text">
                    <i class="fa fa-star-o"></i> SI TUKIN
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="{{url('admin/dashboard')}}">
                        <i class="ti-pie-chart"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/users')}}">
                        <i class="ti-user"></i>
                        <p>User</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/pegawai')}}">
                        <i class="fa fa-users"></i>
                        <p>Pegawai</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/settings')}}">
                        <i class="fa fa-cogs"></i>
                        <p>Settings</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/grade')}}">
                        <i class="fa fa-sort-amount-asc"></i>
                        <p>Grade Gaji</p>
                    </a>
                </li>

            </ul>
    	</div>
    </div>