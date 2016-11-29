@extends('layout.magazine_main')

@section('title')
    Add New Contract
@endsection

@section('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Booking</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Booking List</a>
            </li>
            <li>
                <a href="index.html">Add Booking</a>
            </li>
            <li>
                <a href="index.html">Add Magazine</a>
            </li>
            <li class="active">
                <strong>Add Issue</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Issue <small> *all fields are required</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form method="post" action = "{{ url('/booking/save_issue') . '/' . $mag_trans_uid . '/' . $client_id}}">
                                <section class="panel">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label for="ex2">Criteria</label>
                                            <select class="form-control" name = "ad_criteria_id" id = "ad_criteria_id">
                                                <option value = "" disabled selected>select</option>
                                                @for($i = 0; $i < COUNT($ad_c); $i++)
                                                    <option value = "{{ $ad_c[$i]->Id }}">{{ $ad_c[$i]->name }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <script type="text/javascript" src="http://cheappartsguy.com/query/assets/js/jquery-1.9.1.min.js"></script>
                                    <script>
                                        $(document).ready(function(){

                                            var client_id = {{ $client_id }};
                                            $('#ad_criteria_id').on('change',function(){

                                                var criteria_id = $(this).val();
                                                $.ajax({
                                                    url: "/booking/getPackageName/" + criteria_id,
                                                    dataType: 'text',
                                                    success: function(data)
                                                    {
                                                        var json = $.parseJSON(data);
                                                        if(json == null)
                                                            return false;

                                                        $('#ad_package_id').empty();
                                                        $('#package_label').append("Package");
                                                        $('#ad_package_id').append("<select class='form-control' name = 'ad_package_id' id = 'ad_package_id_select'>");
                                                        $('#ad_package_id_select').append("<option value = '' disabled selected>select</option>");
                                                        $(json.list).each(function(g, gl){
                                                            $('#ad_package_id_select').append("<option value = "+ gl.id +">"+ gl.package_name +"</option>");
                                                        });
                                                        $('#ad_package_id').append("</select>");


                                                        //select package and call quarter issue
                                                        $('#ad_package_id_select').on('change',function()
                                                        {
                                                            var i;
                                                            $('#quarter_issues_label').append("Quarter Issued");
                                                            $('#quarter_issued_box').append("<select class='form-control' name = 'quarter_issue' id = 'quarter_issued_select'>");
                                                            for(i = 1; i <= 10; i++) {
                                                                $('#quarter_issued_select').append("<option value = "+ i +"> " + i + "</option>");
                                                            }
                                                            $('#quarter_issued_box').append('</select>');

                                                            //select quarter
                                                            $('#quarter_issued_select').on('change',function()
                                                            {
                                                                $('#btn_save_box').append('<input type="submit" class="btn btn-primary" value = "Save">');
                                                                $('#btn_save_box').append(' <a href = "{{ URL('/booking/booking-list') }}" class="btn btn-primary">Back</a>');
                                                            });
                                                        });
                                                    }
                                                });
                                            });

                                        });
                                    </script>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label id = "package_label"></label>
                                            <div id = "ad_package_id"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label id = "quarter_issues_label"></label>
                                            <div id = "quarter_issued_box"></div>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-xs-12" id = "btn_save_box">
                                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                            <div id = "btn_save_box"></div>
                                        </div>
                                    </div>
                                </section>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>List Of Issue</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php
                                $report_api = \App\Http\Controllers\AssemblyClass::get_reports_api();
                            ?>
                            <script type="text/javascript" src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
                            <script>
                                function open_preview(trans_number)
                                {
                                    window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/pdf/" + trans_number + "?show=preview",
                                            "mywindow","location=1,status=1,scrollbars=1,width=727,height=680");
                                }
                            </script>
                            <script>
                                var trans_id = {{ $transaction_uid[0]->transaction_id }};
                                populate_issues_transaction(trans_id);
                                function populate_issues_transaction(uid)
                                {

                                    var html_thmb = "";

                                    $(document).ready( function() {
                                        $.ajax({
//                                            url: "http://magazine-api.kpa21.com/kpa/work/magazine-issue-lists/"+uid,
                                            url: "http://"+report_url_api+"/kpa/work/magazine-issue-lists/"+uid,
                                            dataType: "text",
                                            beforeSend: function () {
                                                $('#mag_name').text("***");
                                                $('table#issue_reports > tbody').empty().prepend('<tr> <td colspan="7">Loading... Please wait...</td> </tr>');
                                            },
                                            success: function(data) {
                                                var json = $.parseJSON(data);
                                                if(json == null)
                                                    return false;

                                                if(json.Status == 404) {

                                                    $('table#issue_reports > tbody').empty().prepend('<tr> <td colspan="7">' + json.Message + '</td> </tr>');
                                                    return;
                                                }

                                                $('#mag_trans_container').empty().prepend('<h3>'+ json.Magazine_Name +' [ <span>'+ json.Mag_Code +'</span> ] | '+ json.Mag_Country +' </h3>');

                                                var item_count = 1;
                                                $(json.Data).each(function(i, tran){

                                                    html_thmb += "<tr>";
                                                    html_thmb += "<td>"+item_count+"</td>";
                                                    html_thmb += "<td>"+tran.criteria_name+"</td>";
                                                    html_thmb += "<td>"+tran.package_name+"</td>";
                                                    html_thmb += "<td>"+tran.quarter_issued+"</td>";

                                                    var n_status = "Void";
                                                    var p_status = parseInt(tran.status);

                                                    if(p_status == 1){
                                                        n_status = "Pending";
                                                    }else if(p_status == 2){
                                                        n_status = "For Approval";
                                                    }else if(p_status == 3){
                                                        n_status = "Approved";
                                                    }else if(p_status == 4){
                                                        n_status = "Declined";
                                                    }

                                                    html_thmb += "<td>"+n_status+"</td>";
                                                    html_thmb += "<td>"+tran.amount+"</td>";
                                                    html_thmb += "<td style='text-align: center;'><button class='btn btn-danger' data-toggle='trashbin' title='Delete'><i class='fa fa-trash'></i></button></td>";
                                                    html_thmb += "</tr>";

                                                    item_count++;
                                                });

                                                $('table#issue_reports > tbody').empty().prepend(html_thmb);

                                                $('#total_result').append('<b style = "font-size: 15px;">Total Amount : ' + json.Total_Amount + '</b>');
                                                $('#show_button').append(' <a href = "{{ URL('/booking/booking-list') }}" class="btn btn-default">Back</a>');
                                                $('#show_button').append(' <a href = "#" onclick=open_preview("{{ $booking_trans_num[0]->trans_num }}"); class = "btn btn-primary">Preview</a>');
                                            }
                                        });
                                    } )
                                }
                            </script>
                            <section class="panel">
                                @if(Session::has('success'))
                                    <div class="alert alert-success alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="issue_reports">
                                    <thead>
                                        <tr>
                                            <th>Item#</th>
                                            <th>Criteria Name</th>
                                            <th>Package Size</th>
                                            <th>Quarter / Issued</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                <div id = "total_result" style = "margin-top: 10px;" class = "pull-left"></div>
                                <div id = "show_button" style = "margin-top: 35px;" class = "pull-right"></div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection