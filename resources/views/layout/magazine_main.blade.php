<?php
    $report_api = \App\Http\Controllers\AssemblyClass::get_reports_api();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        var report_url_api          = "{{ $report_api["Url_Port"] }}";
        var Url_Client_Dashboard    = "{{ $report_api["Url_Client_Dashboard"] }}";
        var Url_Insertion_Order     = "{{ $report_api["Url_Insertion_Order"] }}";
        var Url_Logo_Uploader       = "{{ $report_api["Url_Logo_Uploader"] }}";
        var Role                    = {{ $_COOKIE['role'] }};
    </script>
    <title>Magazine | @yield('title')</title>
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ asset('css/animate.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/checkbox.css') }}">
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('css/plugins/steps/jquery.steps.css')}}" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/1.5.6/numeral.min.js"></script>
    <script>
        var userIdSelected_ = 0, userNameSelected = null;
        var caches_for_achived = [];

        function do_flat() {
            $(document).ready(function () {
                $('#product_flat_plan').modal({
                    show: true
                });

                $.ajax({
                    url: "http://" + report_url_api + "/kpa/work-v2/flat-planning/populate/publication",
                    dataType: "text",
                    beforeSend: function () {
                        console.log("Please wait...");
                        $("#flat_plan_publication").empty().prepend('<h5>Please wait...</h5>');
                    },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        var f_type = '<select class="form-control" id = "fp_type" name="fp_type">';
                        f_type += '<option value="0">-- Select --</option>';
                        f_type += '<option value="1">Existing Flat Plan</option>';
                        f_type += '<option value="2">Create New Flat PLan</option>';
                        f_type += '</select>';
                        $("#flat_plan_publication_type").empty().prepend(f_type);
                        $("#fp_type").change(function(){
                            var val = $(this).val();
                            if(val == 1){
                                console.log("Existing");
                                $("#fp_publication").show();
                                $("#lbl_pub_name").show();
                                $("#fp_publication_create").hide();
                                $("#err_mes_table").show();
                                $("#flat_plan_year_create").hide();
                                $("#flat_plan_issue_create").hide();

                            }else if(val == 2){
                                console.log("Create");
                                $("#flat_table_wrapper").hide();
                                $("#flat_plan_data_table").hide();
                                $("#fp_publication").hide();
                                $("#lbl_pub_name").show();
                                $("#fp_publication_create").show();
                                $("#btn_proceed").show();

                                $("#err_mes_table").hide();
                                $("#flat_plan_year_create").show();
                                $("#flat_plan_issue_create").show();
                            }else{
                                $("#fp_publication").hide();
                                $("#lbl_pub_name").hide();
                                $("#fp_publication_create").hide();
                                $("#btn_proceed").hide();
                                $("#flat_table_wrapper").hide();
                                $("#flat_plan_data_table").hide();
                            }
                        });

                        var select = '<select class="form-control" id = "fp_publication" name="fp_publication" style = "margin-top: 10px; display: none;">';
                        select += '<option value="0">-- Select --</option>';
                        $(json).each(function(key, value){
                            select += '<option value="'+value.Id+ ':' + value.magazine_year + ':' + value.magazine_issues + '">'+ value.magazine_name +'</option>';
                        });
                        select += '</select>';
                        $("#flat_plan_publication").empty().prepend(select);

                        $("#fp_publication").change(function(){
                            var value = $(this).val();
                            var values = value.split(":");
                            var mag_id = values[0];

                            var table_data = "";
                            $.ajax({
                                url: "/api/get/flat/plan/data/" + mag_id,
                                dataType: "text",
                                beforeSend: function () {
                                    console.log("Please wait...");
                                    $("#flat_plan_table_list").empty().prepend('<h5>Please wait...</h5>');
                                },
                                success: function(data) {
                                    var json = $.parseJSON(data);
                                    if(json.Status == 404){
                                        $("#flat_table_wrapper").hide();
                                        $("#flat_plan_data_table").hide();
                                        $("#err_mes_table").text(' No Existing Flat Plan');
                                        return false;
                                    }
                                    if(json.Status == 200){
                                        $("#flat_table_wrapper").show();
                                        $("#flat_plan_data_table").show();
                                        $("#err_mes_table").text('');
                                        $(json.Result).each(function(a, tran){
                                            var mag_id = tran.magazine_id;
                                            var trans_number = tran.trans_number;
                                            var url_exists = "http://"+ report_url_api + "/kpa/work-v2/flat-plan/" + mag_id + "/" + trans_number;
                                            table_data += '<tr>';
                                            table_data += '<td>'+ tran.magazine_id +'</td>';
                                            table_data += '<td>'+ tran.trans_number +'</td>';
                                            table_data += '<td>'+ tran.magazine_year +'</td>';
                                            table_data += '<td>'+ tran.magazine_issue +'</td>';
                                            table_data += '<td><a href = "' + url_exists + '" class="btn btn-primary pull-right">Select</a></td>';
                                            table_data += "</tr>";
                                        });

                                        $('table#flat_plan_data_table > tbody').empty().prepend(table_data);
                                    }

                                }
                            });
                        });

                        var select_create = '<select class="form-control" id = "fp_publication_create" name="fp_publication_create" style = "margin-top: 10px; display: none;">';
                        select_create += '<option value="0">-- Select --</option>';
                        $(json).each(function(key, value){
                            select_create += '<option value="' + value.Id + '">'+ value.magazine_name +'</option>';
                        });
                        select_create += '</select>';
                        $("#flat_plan_publication_create").empty().prepend(select_create);


                        $("#fp_publication_create").change(function(){
                            $("#year_create").show();
                            $("#year_create_lbl").show();
                            $("#issue_create").show();
                            $("#issue_create_lbl").show();
                        });

                        var year_create = '<div style = "width: 48%; float: left;"><label id = "year_create_lbl" style = "display: none;">Year</label><select class="form-control col-sm-2" id = "year_create" name="year_create" style = "margin-top: 10px; display: none;">';
                        year_create += '@for($i = date("Y") - 3; $i < date("Y") + 3; $i++)';
                        year_create += '<option value="{{ $i }}" {{ $i == date("Y") ? "selected" : "" }}>{{ $i }}</option>';
                        year_create += ' @endfor';
                        year_create += '</select></div>';
                        $("#flat_plan_year_create").empty().prepend(year_create);

                        var issue_create = '<div style = "width: 48%; float: right;"><label id = "issue_create_lbl" style = "display: none;">Issue</label><select class="form-control" id = "issue_create" name="issue_create" style = "margin-top: 10px; display: none;">';
                        issue_create += '@for($i = 1; $i < 13; $i++)';
                        issue_create += '<option value="{{ $i }}">{{ $i }}</option>';
                        issue_create += ' @endfor';
                        issue_create += '</select></div>';
                        $("#flat_plan_issue_create").empty().prepend(issue_create);

                    }
                });
            })
        }

        function do_proceed() {
            $(document).ready(function () {
                var type = $("#fp_type").val();
                //var value = $("#fp_publication").val();
                //var values = value.split(":");

                var mag_id = $("#fp_publication_create").val();
                var magazine_year = $("#year_create").val();
                var magazine_issues = $("#issue_create").val();

                if( parseInt(type) == 0 ) {
                    $("#err_mes_type").text(' Oops, Please select type');
                    return false;
                }

                if( parseInt(mag_id) == 0 ) {
                    $("#err_mes_pub").text(' Oops, Please select one of "Publication"');
                    return false;
                }

                if(parseInt(type) == 1){ //Existing Flat Plan
                    console.log("Existing Flat Plan");
                    var url = "http://" + report_url_api + "/kpa/work-v2/flat-plan/" + mag_id + "?year=" + magazine_year + "&issue=" + magazine_issues;
                }

                if(parseInt(type) == 2){ //Create New Flat PLan
                    var url = "http://" + report_url_api + "/kpa/work-v2/flat-plan/" + mag_id + "?year=" + magazine_year + "&issue=" + magazine_issues;
                }

                window.location.href=url;
            })
        }

        function show_settings(id) {
          userNameSelected = $("#btn_"+id).data("sales");
          $("#gaol_sales_name").empty().text("Sales Name: " +userNameSelected);
          console.log(userNameSelected);
          userIdSelected_ = id;
          $('#user_tab_settings').modal({
              show: true
          });
          var data = {user_id : id};
          get_goal_lists(data);
        }

    </script>
    @yield('styles')
    <style>
       select { text-transform: capitalize; }
    </style>
</head>

<body>
    <div id="wrapper">
        @include('partials.nav')
        <div id="page-wrapper" class="dark-gray-bg">
            @include('partials.header')
            @yield('magazine_content')
            @include('partials.footer')
        </div>
    </div>

    <div class="modal fade" id="product_flat_plan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Flat Planning</h4>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Type</label> <span id="err_mes_type" style="color: red;"></span>
                                <div class="form-group" id = "flat_plan_publication_type"></div>

                                <label id = "lbl_pub_name" style = "display: none;">Publication Name</label><span id="err_mes_pub" style="color: red;"></span>
                                <div class="form-group" id = "flat_plan_publication"></div>
                                <div class="form-group" id = "flat_plan_publication_create"></div>
                                <div class="form-group" id = "flat_plan_year_create"></div>
                                <div class="form-group" id = "flat_plan_issue_create"></div>


                                <div id = "flat_table_wrapper" style = "overflow-y: scroll; height: 400px; display: none;">
                                    <table id="flat_plan_data_table" class="table" data-sorting="true" data-page-size="10" style = "display: none;">
                                        <thead>
                                            <tr>
                                                <th>MAG ID</th>
                                                <th>TRANS NUM</th>
                                                <th>YEAR</th>
                                                <th>ISSUE</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <span id="err_mes_table" style="color: red;"></span>
                            </div>
                        </div>
                    </div>
                    <div style = "clear: both;"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary pull-right" id = "btn_proceed" style = "display: none;" onclick="do_proceed();" type="submit">Proceed</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style = "margin-right: 5px;">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-2.1.1.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{ asset('js/plugins/steps/jquery.steps.min.js') }}"></script>
    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js')}}"></script>
    <!-- FooTable -->
    <link href="{{ asset('css/plugins/footable/footable.core.css')}}" rel="stylesheet">
    <script src="{{ asset('js/plugins/footable/footable.all.min.js')}}"></script>
    <script src="{{ asset('js/jquery.cookie.js')}}"></script>
    <!-- FooTable -- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $('.footable').footable();
            $('.footable2').footable();
        });

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
        // Notification
        general_notification();
        function general_notification() {
            var url = "http://" + report_url_api + "/kpa/work/notification-list/"+Role;
            $(document).ready( function() {

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
                                var unread = notif.noti_flag == 1 ? "class='unread'" : "class='read'";
                                html_notif += "" +
                                        "<li "+ unread +" onclick=notif_read(" + notif.Id + ")>" +
                                        "<div class='dropdown-messages-box'>" +
                                        "   <a href = "+  notif.noti_url +">" +
                                        "<div style='float: left; margin-left: 0px; width: 45px;'>" +
                                        "   <i class='fa fa-flag' style='font-size:30px; margin-left: 7px;'></i>" +
                                        "</div>" +
                                        "<div style='float: left; width: 210px;'>" +
                                        "       <div style='margin-top: -17px; padding: 2px;'>" +
                                        "           <strong style='font-size: 1em;'> " + notif.from_name + "</strong>" +
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

                            html_notif += "<li>";
                            html_notif += "<div class='text-center link-block'>";
                            html_notif += "<a href='/notifications'>";
                            html_notif += "<strong>See All Alerts</strong> ";
                            html_notif += "<i class='fa fa-angle-right'></i>";
                            html_notif += "</a>";
                            html_notif += "</div>";
                            html_notif += "</li>";
                            $('#notif_lists').empty().prepend(html_notif);
                        }
                    }
                });
            } );
        }
        setInterval(general_notification, 1000);
        // End Notification
    </script>
    <script src = "https://cdn.jsdelivr.net/sweetalert2/6.2.1/sweetalert2.min.js"></script>
    <link href = "https://cdn.jsdelivr.net/sweetalert2/6.2.1/sweetalert2.min.css" rel="stylesheet">
    <link href = "https://cdn.jsdelivr.net/sweetalert2/6.2.1/sweetalert2.css" rel="stylesheet">
    <script src = "https://cdn.jsdelivr.net/sweetalert2/6.2.1/sweetalert2.js"></script>
    @yield('scripts')

</body>
</html>
