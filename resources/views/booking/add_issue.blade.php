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
                <a href="{{ url('/booking/booking-list') }}">Booking List</a>
            </li>
            <li>
                <a href="#">Add Magazine</a>
            </li>
            <li class="active">
                <strong>Add Issue</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="container">
    
        <div class="row form-group mb0 mrl15">
            <div class="col-xs-12">
                <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                    <li class="disabled"><a href="#step-1">
                        <h4 class="list-group-item-heading">Step 1</h4>
                        <p class="list-group-item-text">Add Booking Details</p>
                    </a></li>
                    <li class="disabled"><a href="#step-2">
                        <h4 class="list-group-item-heading">Step 2</h4>
                        <p class="list-group-item-text">Select Magazine</p>
                    </a></li>
                    <li class="active"><a href="#step-3">
                        <h4 class="list-group-item-heading">Step 3</h4>
                        <p class="list-group-item-text">Add Issue</p>
                    </a></li>
                </ul>
            </div>
        </div>

        <div class="row setup-content" id="step-1">
                <div class="col-md-12 well">
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
                                                        <label for="ex2">Ad Color</label>
                                                        <select class="form-control" name = "ad_criteria_id" id = "ad_criteria_id">
                                                            <option value = "" disabled selected>select</option>
                                                            @for($i = 0; $i < COUNT($ad_c); $i++)
                                                                <option value = "{{ $ad_c[$i]->c_uid }}">{{ $ad_c[$i]->name }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                
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
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <label id = "amount_label"></label>
                                                        <div id = "amount_box"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <label id = "line_item_qty_label"></label>
                                                        <div id = "line_item_qty"></div>
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="row">
                                                    <div class="col-xs-12" id = "btn_save_box">
                                                        <div id = "btn_save_box"></div>
                                                    </div>
                                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
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
                                <h5>List issue of <b>{{ $mag_name[0]->magazine_name }}</b></h5>
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
                                        
                                        <section class="panel">
                                            @if(Session::has('success'))
                                                <div class="alert alert-success alert-dismissable">
                                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                    {{ Session::get('success') }}
                                                </div>
                                            @elseif(Session::has('fail'))
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                    {{ Session::get('fail') }}
                                                </div>
                                            @endif
                                            <table class="table table-striped table-bordered table-hover dataTables-example" id="issue_reports">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 50px; text-align: center;">Item#</th>
                                                        <th style="text-align: left;">TYPE</th>
                                                        <th style="text-align: left;">SIZE</th>
                                                        <th style="width: 100px; text-align: center;">QUARTER / ISSUED</th>
                                                        <th style="width: 100px; text-align: center;">QTY</th>
                                                        <th style="width: 100px; text-align: center;">DISCOUNT</th>
                                                        <th style="width: 100px; text-align: right;">AMOUNT</th>
                                                        <th style="width: 50px; text-align: center;">ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                            <div id="total_result" style="margin-top: 10px;" class="pull-left"></div>
                                            <div id="show_button" style="margin-top: 35px;" class="pull-right"></div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function(){

        var client_id = {{ $client_id }};
        $('#ad_criteria_id').on('change',function(){


            var mag_uid = {{ $transaction_uid[0]->magazine_id }};
            var criteria_id = $(this).val();
            $.ajax({
                url: "/booking/getPackageName/" + criteria_id + "/" + mag_uid,
                dataType: 'text',
                success: function(data)
                {
                    var json = $.parseJSON(data);
                    if(json == null)
                        return false;

                    // $('#ad_package_id').empty();
                    $('#package_label').empty().append("Ad Size");
                    $('#ad_package_id').empty().append("<select class='form-control' name = 'ad_package_id' id = 'ad_package_id_select'>");
                    $('#ad_package_id_select').empty().append("<option value = '' disabled selected>select</option>");
                    $(json.list).each(function(g, gl){
                        $('#ad_package_id_select').append("<option value = "+ gl.ad_size + ";" + gl.ad_amount +">"+ gl.package_name +"</option>");
                    });
                    $('#ad_package_id').append("</select>");


                    //select package and call quarter issue
                    $('#ad_package_id_select').on('change',function()
                    {
                        var i;
                        var ad_size = $(this).val();
                        var ad_sizes = ad_size.split(';');

                        $('#amount_label').empty().append("Amount");
                        $('#amount_box').empty().append('<input type="hidden" value = "'+ ad_sizes[0] +'" name = "ad_p_split"><input type="text" value = "'+ ad_sizes[1] +'" name = "ad_amount" class="form-control" readonly>');

                        $('#quarter_issues_label').empty().append("Quarter Issued");
                        $('#quarter_issued_box').empty().append("<select class='form-control' name = 'quarter_issue' id = 'quarter_issued_select'>");
                        $('#quarter_issued_select').append("<option value = '' disabled selected>select</option>");
                        for(i = 1; i <= 10; i++) {
                            $('#quarter_issued_select').append("<option value = "+ i +"> " + i + "</option>");
                        }
                        $('#quarter_issued_box').append('</select>');

                        //select quarter
                        $('#quarter_issued_select').on('change',function()
                        {
                            $('#line_item_qty_label').empty().append("Line Item QTY");
                            $('#line_item_qty').empty().append('<input type="number" name = "line_item_qty" class="form-control" value = "1">');
                            $('#btn_save_box').empty().append('<input type="submit" class="btn btn-primary" value = "Save">');
                        });
                    });
                }
            });
        });

    });

function open_preview(trans_number)
{
    window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/pdf/" + trans_number + "?show=preview",
            "mywindow","location=1,status=1,scrollbars=1,width=727,height=680");
}

function ConfirmDelete()
{
    var x = confirm("Are you sure you want to delete?");
    if (x)
        return true;
    else
        return false;
}

var trans_id = {{ $transaction_uid[0]->transaction_id }};
populate_issues_transaction(trans_id);
function populate_issues_transaction(uid)
{
var html_thmb = "";
var isFirstLoad = true;
console.log(uid);

$(document).ready( function() {
    $.ajax({
        url: "http://"+report_url_api+"/kpa/work/magazine-issue-lists/"+uid,
        dataType: "text",
        beforeSend: function () {
            if(isFirstLoad) {
                isFirstLoad = false;
                $('table#issue_reports > tbody').empty().prepend('<tr> <td colspan="8" style="text-align: center;"> <img src="{{ asset('img/ripple.gif') }}" style="width: 90px;"  />  Fetching All Transactions... Please wait...</td> </tr>');
            }
//            $('#mag_name').text("***");
//            $('table#issue_reports > tbody').empty().prepend('<tr> <td colspan="7">Loading... Please wait...</td> </tr>');
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

            var total_with_discount = 0;
            var item_count = 1;
            $(json.Data).each(function(i, tran){

                html_thmb += "<tr>";
                html_thmb += "<td style='text-align: center;'>"+item_count+"</td>";
                html_thmb += "<td style='text-align: left;'>"+tran.ad_color+"</td>";
                html_thmb += "<td style='text-align: left;'>"+tran.ad_size+"</td>";
                html_thmb += "<td style='text-align: center;'> Q"+tran.quarter_issued+"</td>";
                html_thmb += "<td style='text-align: center;'> "+tran.line_item_qty+"</td>";
                html_thmb += "<td style='text-align: center;'> "+numeral(tran.total_discount).format('0,0.00')+"</td>";

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

                html_thmb += "<td style='text-align: right;'>"+ numeral(tran.total_amount_with_discount).format('0,0.00') +"</td>";
                html_thmb += "<td style='text-align: center;'><a onclick='return ConfirmDelete();' href = '{{ URL("/booking/delete_issue") ."/" }}"+ tran.id + "/" + tran.magazine_trans_id +"/{{ $client_id }}' class='btn btn-danger' data-toggle='trashbin' title='Delete'><i class='fa fa-trash'></i></a></td>";
                html_thmb += "</tr>";

                item_count++;

                total_with_discount += parseFloat(tran.total_amount_with_discount);
            });

            $('table#issue_reports > tbody').empty().prepend(html_thmb);

            $('#total_result').append('<b style = "font-size: 15px;">Total Amount : ' + numeral(total_with_discount).format('0,0.00') + '</b>');
            $('#show_button').append(' <a href = "{{ URL('/booking/booking-list') }}" class="btn btn-default">Back</a>');
            $('#show_button').append(' <a href = "#" onclick=open_preview("{{ $booking_trans_num[0]->trans_num }}"); class = "btn btn-primary">Preview</a>');
        }
    });
})
}
</script>
@endsection