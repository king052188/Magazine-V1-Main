<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ $user_info[0]->first_name }} {{ $user_info[0]->last_name }}</strong>
                            </span> <span class="text-muted text-xs block">
                                @if($user_info[0]->role == 1)
                                    Administrator
                                @elseif($user_info[0]->role == 2)
                                    Admin/Manager
                                @elseif($user_info[0]->role == 3)
                                    Sales Representative
                                @endif
                            <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ URL('/logout_process') }}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    Mg
                </div>
            </li>
            <li class = "nav_dashboard {{ $nav_dashboard == 'active' ? 'active' : '' }}">
                <a href="/dashboard"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            @if((int)$_COOKIE['role'] > 2)
                <li class = "nav_clients {{ $nav_dashboard == 'active' ? 'active' : '' }}">
                    <a href="/client/create"><i class="fa fa-address-card"></i> <span class="nav-label">Clients</span></a>
                </li>

                <li class = "nav_sales {{ $nav_sales == 'active' ? 'active' : '' }}">
                    <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Sales</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        {{--<li><a href="{{ url('/booking/add-booking') }}"> <span class="nav-label">Book an Ad</span></a></li>--}}
                        <li><a href="{{ url('/booking/checkpoint') }}"> <span class="nav-label">Book an Ad</span></a></li>
                        <li><a href="{{ url('/booking/booking-list') }}"> <span class="nav-label">List of Print Ads</span></a></li>
                        <li><a href="{{ url('/booking/digital-list') }}"> <span class="nav-label">List of Digital Ads</span></a></li>
                    </ul>
                </li>
            @else
            <li class = "nav_publisher {{ $nav_publisher == 'active' ? 'active' : '' }}">
                <a href="#"><i class="fa fa-book" aria-hidden="true"></i> <span class="nav-label">Publisher</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="/magazine/create/company/add">Create New Publishers</a></li>
                    <li><a href="/magazine/create/company">List Publishers</a></li>
                </ul>
            </li>
            <li class = "nav_publication {{ $nav_publication == 'active' ? 'active' : '' }}">
                <a href="#"><i class="fa fa-book" aria-hidden="true"></i> <span class="nav-label">Publication</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="/magazine/create">Create New Publication</a></li>
                    <li><a href="/magazine/all">View All Publication</a></li>
                </ul>
            </li>
            <li class = "nav_clients {{ $nav_clients == 'active' ? 'active' : '' }}">
                <a href="/client/create"><i class="fa fa-address-card"></i> <span class="nav-label">Clients</span></a>
            </li>
            <li class = "nav_sales {{ $nav_sales == 'active' ? 'active' : '' }}">
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Sales</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ url('/booking/checkpoint') }}"> <span class="nav-label">Book an Ad</span></a></li>
                    <li><a href="{{ url('/booking/booking-list') }}"> <span class="nav-label">List of Print Ads</span></a></li>
                    <li><a href="{{ url('/booking/digital-list') }}"> <span class="nav-label">List of Digital Ads</span></a></li>
                </ul>
            </li>

            <li class = "nav_payment {{ $nav_payment == 'active' ? 'active' : '' }}">
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Production</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="#" onclick="do_flat();"> <span class="nav-label">Flat Plan</span></a></li>
                </ul>
            </li>

            <li class = "nav_payment {{ $nav_payment == 'active' ? 'active' : '' }}">
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Payment</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ url('payment/invoice/print') }}"> <span class="nav-label">Invoice for PRINT</span></a></li>
                    <li><a href="{{ url('payment/invoice/digital') }}"> <span class="nav-label">Invoice for DIGITAL</span></a></li>
                    <li><a href="{{ url('payment/invoice/send-bulk') }}"> <span class="nav-label">Send Bulk Invoice</span></a></li>
                    <li><a href="{{ url('payment/payment_list') }}"> <span class="nav-label">Receiving</span></a></li>
                </ul>
            </li>

            <li class = "nav_reports {{ $nav_reports == 'active' ? 'active' : '' }}">
                <a href="/sales_report/view"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Reports</span></a>
            </li>

            <li class = "nav_users {{ $nav_users == 'active' ? 'active' : '' }}">
                <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Users</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="/users/create">Create New User</a></li>
                    <li><a href="/users/all">View All Users</a></li>
                </ul>
            </li>
            @endif



        </ul>
    </div>
</nav>