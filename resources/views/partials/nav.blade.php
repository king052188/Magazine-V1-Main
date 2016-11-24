<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">FName LName</strong>
                         </span> <span class="text-muted text-xs block">Administrator <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    Mg
                </div>
            </li>
            <li class="active">
                <a href="/dashboard"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            @if($_COOKIE['role'] > 2)

                <li>
                    <a href="#"><i class="fa fa-address-card"></i> <span class="nav-label">Clients</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="/client/create">Create New Clients</a></li>
                        <li><a href="#">Edit Clients</a></li>
                        <li><a href="/client/all">View All Clients</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ url('booking/booking-list') }}"><i class="fa fa-credit-card" aria-hidden="true"></i> <span class="nav-label">Booking and Sales</span><span class="fa arrow"></span></a>
                </li>

            @else

                <li>
                    <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Reports</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="/sales_report/view">Sales Report</a></li>
                        <li><a href="#">Report Sample 2</a></li>
                        <li><a href="#">Report Sample 3</a></li>
                        <li><a href="#">Report Sample 4</a></li>
                        <li><a href="#">Report Sample 5</a></li>
                        <li><a href="#">Report Sample 6</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-address-card"></i> <span class="nav-label">Clients</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="/client/create">Create New Clients</a></li>
                        <li><a href="#">Edit Clients</a></li>
                        <li><a href="/client/all">View All Clients</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Salesperson</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="/salesperson/create">Create New Salesperson</a></li>
                        <li><a href="#">Edit Salesperson</a></li>
                        <li><a href="/salesperson/all">View All Salesperson</a></li>
                    </ul>
                </li>
                {{--<li>--}}
                {{--<a href="#"><i class="fa fa-briefcase" aria-hidden="true"></i> <span class="nav-label">Contract</span><span class="fa arrow"></span></a>--}}
                {{--<ul class="nav nav-second-level collapse">--}}
                {{--<li><a href="/contract/create">Create New Contract</a></li>--}}
                {{--<li><a href="#">Edit Contract</a></li>--}}
                {{--<li><a href="/contract/all">View All Contract</a></li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                <li>
                    <a href="#"><i class="fa fa-book" aria-hidden="true"></i> <span class="nav-label">Magazine</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="/magazine/create">Create New Magazine</a></li>
                        <li><a href="#">Edit Magazine</a></li>
                        <li><a href="/magazine/all">View All Magazine</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('booking/booking-list') }}"><i class="fa fa-credit-card" aria-hidden="true"></i> <span class="nav-label">Booking and Sales</span><span class="fa arrow"></span></a>
                </li>

            @endif

        </ul>
    </div>
</nav>