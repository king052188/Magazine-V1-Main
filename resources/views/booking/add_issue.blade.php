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
                    <div class="col-lg-4" id = "once_approved_aa">
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
                                                    <div class="col-xs-12 " id = "btn_save_box">
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

                    <div class="col-lg-8" id = "once_approved_bb">
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
                                                        <th style="width: 10%; text-align: center;">Item #</th>
                                                        <th style="width: 20%; text-align: left;">TYPE</th>
                                                        <th style="width: 20%; text-align: left;">SIZE</th>
                                                        <th style="width: 10%; text-align: center;">ISSUE</th>
                                                        <th style="width: 10%; text-align: center;">QTY</th>
                                                        <th style="width: 10%; text-align: center;">DISCOUNT</th>
                                                        <th style="width: 10%; text-align: right;">AMOUNT</th>
                                                        <th style="width: 10%; text-align: center;">ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                            <div id="total_result" style="margin-top: 15px;" class="pull-right">
                                                <style>
                                                    .issues_amount_table tr td { font-size: 1em; font-weight: 600; padding: 2px; text-align: right; }
                                                </style>
                                                <table class="issues_amount_table" style="width: 250px" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td>Sub Total:</td>
                                                        <td><span id="issues_sub_total"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span id = "issues_discount_label">0% Discount:</span></td>
                                                        <td><span id="issues_discount"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Amount:</td>
                                                        <td><span id="issues_total_amount"></span></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div id="show_button" style="margin-top: 45px;" class="pull-left"></div>
                                        </section>

                                    </div>
                                 </div>
                                <div id="status_discretionary_discount" style="height: 35px; margin-top: 10px; display: none;"> </div>
                                <div id="approval_discretionary_discount" style="width: 100%; margin-top: 10px; display: none; ">
                                    <h3>Discretionary Discount</h3>
                                    <table style="width: 100%; padding: 10px;" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="width: 20%; padding: 5px; border-bottom: 1px solid gray;"> Sales Rep: </td>
                                            <td style="text-align: right; padding: 5px; border-bottom: 1px solid gray;"> <span id="approval_sales_rep"></span> </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%; padding: 5px; border-bottom: 1px solid gray;"> Date: </td>
                                            <td style="text-align: right; padding: 5px; border-bottom: 1px solid gray;"> <span id="approval_date"></span> </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%; padding: 5px; border-bottom: 1px solid gray;"> Remarks: </td>
                                            <td style="text-align: right; padding: 5px; border-bottom: 1px solid gray;"> <span id="approval_remarks"></span> </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%; padding: 5px; border-bottom: 1px solid gray;"> Sub Total: </td>
                                            <td style="text-align: right; padding: 5px; border-bottom: 1px solid gray;"> <span id="approval_sub_total"></span> </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%; padding: 5px; border-bottom: 1px solid gray;"> <span id="approval_discount_label"></span> Discount: </td>
                                            <td style="text-align: right; padding: 5px; border-bottom: 1px solid gray;"> <span id="approval_discount"></span> </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%; padding: 5px;"> Total Amount: </td>
                                            <td style="text-align: right; padding: 5px;"> <span id="approval_amount"></span> </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding: 5px;">
                                                <div id="button_approve" style="float: right;">
                                                    <button data-toggle="modal" data-target="#approved_modal" class="btn btn-primary">Approve</button>
                                                    <button data-toggle="modal" data-target="#declined_modal" class="btn btn-danger">Decline</button>
                                                </div>
                                                <h3 id="text_status"> Approved </h3>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="bd-example">

    {{--discount modal area--}}
    <div class="modal fade" id="discount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action = "{{ url('/booking/save/discount') . '/' . $booking_trans_num[0]->trans_num . '/' . $mag_trans_uid . '/' . $client_id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Discretionary Discount</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Base Amount:</label>
                            <input type="text" class="form-control" id="txtBaseAmount" name = "txtBaseAmount" readonly>
                            <input type="hidden" class="form-control" id="txtBaseAmountHidden" name = "txtBaseAmountHidden" readonly>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Discount: <i>by percentage</i></label>
                            <input type="number" class="form-control" id="txtDiscount" name = "txtDiscount" placeholder="Enter discount. I.e: 2 / 12" >
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Remarks: <i>300 Characters</i> </label>
                            <textarea type="number" class="form-control" id="txtRemarks" name = "txtRemarks" placeholder="Enter remarks" maxlength="300" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Total Amount:</label>
                            <input type="text" class="form-control" id="txtAmount" disabled>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <a type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{--approve modal area--}}
    <div class="modal fade" id="approved_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelApprove" aria-hidden="true">
        <form method="post" action = "{{ url('/booking/issue/discount/approve') . '/' . $booking_trans_num[0]->trans_num . '/' . $mag_trans_uid . '/' . $client_id }}">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type = "hidden" id = "sls_rep" name = "sls_rep">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="exampleModalLabel">Approve</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Remarks: <i>300 Characters</i> </label>
                        <textarea type="number" class="form-control" id="txtApproveRemarks" name = "txtApproveRemarks" placeholder="Enter remarks" maxlength="300" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <button type="submit" id = "btn_approve_skip" class="btn btn-info pull-left">Skip</button>
                    <a type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
                    <button type="submit" id = "btn_approve_save" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
        </form>
    </div>

    {{--declined modal area--}}
    <div class="modal fade" id="declined_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelDecline" aria-hidden="true">
        <form method="post" action = "{{ url('/booking/issue/discount/decline') . '/' . $booking_trans_num[0]->trans_num . '/' . $mag_trans_uid . '/' . $client_id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <input type = "hidden" id = "sls_rep_dec" name = "sls_rep">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Decline</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Remarks: <i>300 Characters</i> </label>
                            <textarea type="number" class="form-control" id="txtDeclineRemarks" name = "txtDeclineRemarks" placeholder="Enter remarks" maxlength="300" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <button type="submit" id = "btn_decline_skip" class="btn btn-info pull-left">Skip</button>
                        <a type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
                        <button type="submit" id = "btn_decline_save" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')

<style>
    .btn-preview-kpa {
        background: #7f7f7f;
        color: #ffffff;
    }
    .btn-preview-kpa:hover {
        background: #8d8d8d;
        color: #ffffff;
    }
</style>
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
                    $('#ad_package_id_select').append("<option value = "+ gl.ad_size + ";" + gl.ad_amount + ";" + gl.price_uid +">"+ gl.package_name +"</option>");
                });
                $('#ad_package_id').append("</select>");

                //select package and call quarter issue
                $('#ad_package_id_select').on('change',function()
                {
                    var i;
                    var ad_size = $(this).val();
                    var ad_sizes = ad_size.split(';');

                    $('#amount_label').empty().append("Amount");
                    $('#amount_box').empty().append('<input type="hidden" value = "'+ ad_sizes[2] +'" name = "price_uid"><input type="hidden" value = "'+ ad_sizes[0] +'" name = "ad_p_split"><input type="text" value = "'+ ad_sizes[1] +'" name = "ad_amount" class="form-control" readonly>');

                    $('#quarter_issues_label').empty().append("Issue");
                    $('#quarter_issued_box').empty().append("<select class='form-control' name = 'quarter_issue' id = 'quarter_issued_select'>");
                    $('#quarter_issued_select').append("<option value = '' disabled selected>select</option>");
                    for(i = 1; i <= 12; i++) {
                        $('#quarter_issued_select').append("<option value = "+ i +"> " + i + "</option>");
                    }
                    $('#quarter_issued_box').append('</select>');

                    //select quarter
                    $('#quarter_issued_select').on('change',function()
                    {
                        $('#line_item_qty_label').empty().append("Line Item QTY");
                        $('#line_item_qty').empty().append('<input type="number" name = "line_item_qty" class="form-control" value = "1">');
                        $('#btn_save_box').empty().append('<input type="submit" class="btn btn-primary pull-right" value = "Save">');
                    });
                });
            }
        });
    });

    $("#btn_approve_save").click(function(){
        var remarks = $("#txtApproveRemarks").val();
        if(remarks == "")
        {
            swal({
                title: "Remarks is required",
                text: "",
                timer: 2000,
                showConfirmButton: false
            });

            return false;
        }
    });

    $("#btn_decline_save").click(function(){
        var remarks = $("#txtDeclineRemarks").val();
        if(remarks == "")
        {
            swal({
                title: "Remarks is required",
                text: "",
                timer: 2000,
                showConfirmButton: false
            });

            return false;
        }
    });
});

function open_preview(trans_number) {
    window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/insertion-order-contract/" + trans_number + "/preview",
            "mywindow","location=1,status=1,scrollbars=1,width=755,height=760");
}

function ConfirmDelete() {
    var x = confirm("Are you sure you want to delete?");
    if (x)
        return true;
    else
        return false;
}

var trans_id = {{ $transaction_uid[0]->transaction_id }};

populate_issues_transaction(trans_id);

function populate_issues_transaction(uid) {
    var html_thmb = "";
    var isFirstLoad = true;

    console.log(uid);

    $(document).ready( function() {
        var hasDiscount = 0;
        var BaseTotalAmount = 0;
        $.ajax({
            url: "http://"+report_url_api+"/kpa/work/magazine-issue-lists/"+uid,
            dataType: "text",
            beforeSend: function () {
                if(isFirstLoad) {
                    isFirstLoad = false;
                    $('table#issue_reports > tbody').empty().prepend('<tr> <td colspan="8" style="text-align: center;"> <img src="{{ asset('img/ripple.gif') }}" style="width: 90px;"  />  Fetching All Transactions... Please wait...</td> </tr>');
                }
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
                var i_sub_total = 0;
                var i_discount = 0;
                var i_total_less_discount = 0;

                $(json.Data).each(function(i, tran){

                    html_thmb += "<tr>";
                    html_thmb += "<td style='text-align: center;'>"+item_count+"</td>";
                    html_thmb += "<td style='text-align: left;'>"+tran.ad_color+"</td>";
                    html_thmb += "<td style='text-align: left;'>"+tran.ad_size+"</td>";
                    html_thmb += "<td style='text-align: center;'> IS"+tran.quarter_issued+"</td>";
                    html_thmb += "<td style='text-align: center;'> "+tran.line_item_qty+"</td>";
                    html_thmb += "<td style='text-align: center;'> "+numeral(tran.total_discount_by_percent).format('0,0')+"%</td>";

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

                $('#issues_sub_total').text(numeral(total_with_discount).format('0,0.00'));
                $.ajax({
                    url: "/booking/get_discount_transaction/" + '{{ $booking_trans_num[0]->trans_num }}',
                    dataType: "text",
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if (json.status == 202) {

                            $(json.result).each(function(i, discount) {
                                i_sub_total = discount.amount;
                                i_discount = discount.discount_percent;
                                i_total_less_discount = (i_sub_total * i_discount) / 100;

                                console.log(Role);

                                if(Role > 1) {
                                    $("#issues_discount_label").text(numeral(i_discount).format('0,0') + "% Discount:");
                                    $("#issues_discount").text( "(" + numeral(i_total_less_discount).format('0,0.00') + ")");
                                    $("#issues_total_amount").text(numeral(i_sub_total - i_total_less_discount).format('0,0.00'));
                                    if(parseInt( discount.status ) == 2) {
                                        $('#status_discretionary_discount').show();
                                        var x_wrapper = "<div id='wrapper_discretionary_discount' style='text-align: center; border: 2px solid green; padding: 5px; border-radius: 5px;'>";
                                        x_wrapper += "<h3 style='color: green;'>Discretionary Discount has been Approved</h3>";
                                        x_wrapper += "</div>";
                                        $('#status_discretionary_discount').empty().append(x_wrapper);
                                    }
                                    else if(parseInt( discount.status ) == 3) {
                                        $('#status_discretionary_discount').show();
                                        var x_wrapper = "<div id='wrapper_discretionary_discount' style='text-align: center; border: 2px solid red; padding: 5px; border-radius: 5px;'>";
                                        x_wrapper += "<h3 style='color: red;'>Discretionary Discount has been Declined</h3>";
                                        x_wrapper += "</div>";
                                        $('#status_discretionary_discount').empty().append(x_wrapper);
                                    }
                                    else {
                                        $('#status_discretionary_discount').show();
                                        var x_wrapper = "<div id='wrapper_discretionary_discount' style='text-align: center; border: 2px solid #1976D2; padding: 5px; border-radius: 5px;'>";
                                        x_wrapper += "<h3 style='color: #1976D2;'>Discretionary Discount is not yet Approved</h3>";
                                        x_wrapper += "</div>";
                                        $('#status_discretionary_discount').empty().append(x_wrapper);
                                    }
                                }
                                else {

                                    $('#approval_discretionary_discount').show();
                                    $('#total_result').hide();
                                    $("#approval_sales_rep").text(discount.sales_rep_name);
                                    $("#sls_rep").val(discount.sales_rep_id);
                                    $("#sls_rep_dec").val(discount.sales_rep_id);
                                    $("#approval_date").text(discount.created_at);
                                    $("#approval_remarks").text(discount.remarks);
                                    $("#approval_sub_total").text(numeral(total_with_discount).format('0,0.00'));
                                    $("#approval_discount_label").text(numeral(i_discount).format('0,0') + "%");
                                    $("#approval_discount").text( "(" + numeral(i_total_less_discount).format('0,0') + ")");
                                    $("#approval_amount").text(numeral(i_sub_total - i_total_less_discount).format('0,0'));

                                    if(parseInt( discount.status ) == 2) {
                                        $("#once_approved_aa").hide();
                                        $("#once_approved_bb").removeClass('col-lg-8').addClass('col-lg-12');
                                        $("#button_approve").hide();
                                        $("#text_status").text("Approved");
                                        $("#text_status").attr("style", "color: green;");
                                    }
                                    else if(parseInt( discount.status ) == 3) {
                                        $("#once_approved_aa").hide();
                                        $("#once_approved_bb").removeClass('col-lg-8').addClass('col-lg-12');
                                        $("#button_approve").hide();
                                        $("#text_status").text("Declined");
                                        $("#text_status").attr("style", "color: red;");
                                    }
                                    else {
                                        $("#text_status").hide();
                                        $("#once_approved_aa").show();
                                        $("#once_approved_bb").removeClass('col-lg-12').addClass('col-lg-8');
                                    }
                                }
                            });

                            $('#show_button').append('<a href = "#" onclick=open_preview("{{ $booking_trans_num[0]->trans_num }}"); style="margin-right: 5px;" class = "btn btn-preview-kpa">Preview</a>');
                            $('#show_button').append('<a href = "{{ URL('/booking/booking-list') }}" class="btn btn-primary">Done</a>');
                        }
                        else {
                            $('#issues_discount').text("(" + numeral("0").format('0,0.00') + ")");
                            $('#issues_total_amount').text(numeral(total_with_discount).format('0,0.00'));

                            $('#show_button').append('<a href = "#" style="margin-right: 5px;" class="btn btn-warning" data-toggle="modal" data-target="#discount">Discount</a>');
                            $('#show_button').append('<a href = "#" onclick=open_preview("{{ $booking_trans_num[0]->trans_num }}"); style="margin-right: 5px;" class = "btn btn-preview-kpa">Preview</a>');
                            $('#show_button').append('<a href = "{{ URL('/booking/booking-list') }}" class="btn btn-primary">Done</a>');
                        }
                    }
                });
                BaseTotalAmount = total_with_discount;
                $('#txtBaseAmount').val(numeral(BaseTotalAmount).format('0,0.00'));
                $('#txtBaseAmountHidden').val(BaseTotalAmount);
            }
        });


        $('#txtAmount').val("0.00");
        $('#txtDiscount').on('keyup', function(){
            var origin_amount = BaseTotalAmount;
            var value = $(this).val();
            if(value != "") {
                var orig_amount = (parseFloat(origin_amount) * parseFloat(value)) / 100;
                var new_amount = parseFloat(origin_amount) - orig_amount;
                $('#txtAmount').val(numeral(new_amount).format('0,0.00'));
            }
            else {
                $('#txtAmount').val("0.00");
            }
        });
    })
}

</script>

@endsection