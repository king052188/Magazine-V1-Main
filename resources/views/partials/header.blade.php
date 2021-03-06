<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i></a>
        </div>
        <style>
            .noti_count {
                font-size: .8em;
                font-weight: 600;
                color: #FFFFFF;
                background: red;
                padding: 0px 5px 0px 5px;
                margin:  0 1px 0 0;
            }
            li.unread {
                color: #FFFFFF;
                background: #337ab7;
                height: 80px;
                padding: 15px;;
            }
            li.unread:hover {
                background: #135186;
            }
            li.unread div a {
                color: #FFFFFF;
            }
            li.read {
                padding: 15px;;
                height: 80px;;
            }
            li.read:hover {
                background: #efefef;
            }
        </style>

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown" id="gen_notification">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i>  <span id="gen_notification_count" class="label label-primary noti_count"></span>
                </a>
                <ul style="margin-top: -5px; position: absolute; right: -110px;" class="dropdown-menu dropdown-alerts" id = "notif_lists"> </ul>
            </li>
            <li>
                <a href="{{ URL('/logout_process') }}">
                    <i class="fa fa-sign-out"></i>
                    Logout
                </a>
            </li>
        </ul>
    </nav>
</div>