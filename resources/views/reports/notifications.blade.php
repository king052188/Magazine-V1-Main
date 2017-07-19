@extends('layout.magazine_main')

@section('title')
    List of notifications
@endsection

@section('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <style>
        #listing_type_area {
            list-style-type: none;
        }

    </style>
@endsection

@section('magazine_content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Notification</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/booking/booking-list') }}">List of Notification</a>
                </li>
            </ol>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content" style = "height: 700px; overflow-y:scroll; overflow-x:hidden;">
                        <ul style = "margin:0; padding:0;" id = "listing_type_area">

                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script>
        var url = "/api/notifications";
        $(document).ready( function() {

            general_notification();

            function notif_read(notif_uid) {
                $.ajax({
                    url: "http://" + report_url_api + "/kpa/work/notification-read/" + notif_uid,
                    dataType: "text",
                    beforeSend: function () { },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if(json.Code == 200)
                        {
                            console.log("Read Success");
                        }
                    }
                });
            }

            function general_notification() {
                var html_notif = "";
                $.ajax({
                    url: url,
                    dataType: "text",
                    beforeSend: function () { },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if(json.Code == 200)
                        {
                            $("#gen_notification").show();
                            if(json.Total_Unread > 0) {
                                $("#gen_notification_count").text(json.Total_Unread);
                            }

                            $(json.Data).each(function(n, notif){

                                var from_name = notif.first_name + " " + notif.last_name;

                                var unread = notif.noti_flag == 1 ? "class='unread'" : "class='read'";
                                html_notif += "" +
                                        "<li "+ unread +" onclick=notif_read(" + notif.Id + ") style = 'margin: 5px; border: 1px solid #2f4050;'>" +
                                            "<div class='dropdown-messages-box'>" +
                                            "   <a href = "+  notif.noti_url +">" +
                                                    "<div style='float: left; margin-left: 0px; width: 45px;'>" +
                                                    "   <i class='fa fa-flag' style='font-size:30px; margin-left: 7px;'></i>" +
                                                    "</div>" +
                                                    "<div style='float: left;'>" +
                                                    "       <div style='margin-top: 0px; padding: 2px;'>" +
                                                    "           <strong style='font-size: 1em;'> " + from_name + "</strong>" +
                                                    "           <small style='font-size: 1em;'>" + notif.noti_desc + "</small>" +
                                                    "           </div>" +
                                                    "       <div style='padding: 2px;'>" +
                                                    "           <small>10 mins ago</small>" +
                                                    "       </div>" +
                                                    "</div>" +
                                            "   </a>" +
                                            "</div>" +
                                        "</li>" +
                                        "<li class='divider'></li>";
                            });

                            $('#listing_type_area').empty().prepend(html_notif);
                        }
                    }
                });
            }
            setInterval(general_notification, 1000);

        } );
    </script>
@endsection