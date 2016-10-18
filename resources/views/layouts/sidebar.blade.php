	<?php 
        use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
        use App\Library\RoleLib;
    ?>
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
                    <a href="{{url('dashboard')}}">
                        <i class="fa fa-tachometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('rekap-data')}}">
                        <i class="fa fa-folder"></i>
                        <p>Rekap Data</p>
                    </a>
                </li>
                @if(RoleLib::limitThis('4',Sentinel::getUser()->id))
                <li>
                    <a href="{{url('pegawai')}}">
                        <i class="ti-user"></i>
                        <p>Pegawai</p>
                    </a>
                </li>
                @endif
                @if(RoleLib::limitThis('3',Sentinel::getUser()->id))
                <li>
                    <a href="{{url('hukuman-disiplin')}}">
                        <i class="fa fa-legal"></i>
                        <p>Hukuman Disiplin</p>
                    </a>
                </li>
                @endif
                @if(RoleLib::limitThis('4',Sentinel::getUser()->id))
                <li>
                    <a href="{{url('unit')}}">
                        <i class="fa fa-sitemap"></i>
                        <p>Unit/Deputi</p>
                    </a>
                </li>
                @endif
                @if(RoleLib::limitThis('4',Sentinel::getUser()->id))
                <li>
                    <a href="{{url('jabatan')}}">
                        <i class="fa fa-shield"></i>
                        <p>Jabatan</p>
                    </a>
                </li>
                @endif
                @if(RoleLib::limitThis('4',Sentinel::getUser()->id))
                <li>
                    <a href="{{url('grade')}}">
                        <i class="fa fa-sort-amount-asc"></i>
                        <p>Grade Gaji</p>
                    </a>
                </li>
                @endif
                @if(RoleLib::limitThis('4',Sentinel::getUser()->id))
                <li>
                    <a href="{{url('manajemen-user')}}">
                        <i class="fa fa-user-secret"></i>
                        <p>Manajemen User</p>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{url('export')}}">
                        <i class="fa fa-cloud-download"></i>
                        <p>Export</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>