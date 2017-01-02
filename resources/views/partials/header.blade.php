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
        </style>

        <ul class="nav navbar-top-links navbar-right">
            <li id="gen_notification" style="display: none;">
                <a href="#">
                    <span id="gen_notification_count" class="noti_count"></span>
                    Notification
                </a>
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