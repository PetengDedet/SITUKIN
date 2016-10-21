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
                    <!-- <i class="fa fa-star-o"></i> --> <img src="{{asset('assets/img/garuda.png')}}" width="45" height="45">&nbsp;&nbsp; SI TUKIN
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="{{url('dashboard')}}">
                        <i class="fa fa-tachometer" style="color:#34495E;"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('rekap-data')}}">
                        <i class="fa fa-folder" style="color:#E67E22;"></i>
                        <p>Rekap Data</p>
                    </a>
                </li>
                @if(RoleLib::limitThis('4',Sentinel::getUser()->id))
                <li>
                    <a href="{{url('pegawai')}}">
                        <i class="fa fa-user" style="color:#0097A7;"></i>
                        <p>Pegawai</p>
                    </a>
                </li>
                @endif
                @if(RoleLib::limitThis('3',Sentinel::getUser()->id))
                <li>
                    <a href="{{url('hukuman-disiplin')}}">
                        <i class="fa fa-legal" style="color:#808B96;"></i>
                        <p>Hukuman Disiplin</p>
                    </a>
                </li>
                @endif
                @if(RoleLib::limitThis('4',Sentinel::getUser()->id))
                <li>
                    <a href="{{url('unit')}}">
                        <i class="fa fa-sitemap" style="color:#2ECC71;"></i>
                        <p>Unit/Deputi</p>
                    </a>
                </li>
                @endif
                @if(RoleLib::limitThis('4',Sentinel::getUser()->id))
                <li>
                    <a href="{{url('jabatan')}}">
                        <i class="fa fa-shield" style="color:#FF5722;"></i>
                        <p>Jabatan</p>
                    </a>
                </li>
                @endif
                @if(RoleLib::limitThis('4',Sentinel::getUser()->id))
                <li>
                    <a href="{{url('grade')}}">
                        <i class="fa fa-sort-amount-asc" style="color:#196F3D;"></i>
                        <p>Grade Gaji</p>
                    </a>
                </li>
                @endif
                @if(RoleLib::limitThis('4',Sentinel::getUser()->id))
                <li>
                    <a href="{{url('manajemen-user')}}">
                        <i class="fa fa-user-secret" style="color:#E74C3C;"></i>
                        <p>Manajemen User</p>
                    </a>
                </li>
                @endif
                @if(RoleLib::limitThis('4',Sentinel::getUser()->id))
                <li>
                    <a href="{{url('export')}}">
                        <i class="fa fa-cloud-download" style="color:#5DADE2;"></i>
                        <p>Export</p>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>