@extends('layout.magazine_main')

@section('title')
    Magazines List
@endsection

@section('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/plugins/datepicker/datepicker3.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Payment</h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>Receiving</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Receiving</h5>
                {{--<div class = "pull-right">--}}
                    {{--<select class="form-control" id = "filter" style = "margin-top: -7px;">--}}
                        {{--<option disabled>--select--</option>--}}
                        {{--<option value = "" {{ $filter == "" ? "selected" : "" }}>All</option>--}}
                        {{--<option value = "1" {{ $filter == 1 ? "selected" : "" }}>Pending</option>--}}
                        {{--<option value = "2" {{ $filter == 2 ? "selected" : "" }}>For Approval</option>--}}
                        {{--<option value = "3" {{ $filter == 3 ? "selected" : "" }}>Approved</option>--}}
                        {{--<option value = "5" {{ $filter == 5 ? "selected" : "" }}>Void</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div style = "float: right; margin-right: 5px; font-size: 15px;"><label>Sort by:</label></div>               --}}
            </div>

            <div class="ibox-content">

                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    {{ Session::get('success') }}
                </div>
                @endif
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-sm-12 form-inline">
                                {{--<form class="form-inline" role="form">--}}
                                    <div class="">
                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Find by Invoice Number:</label><br/>
                                            <input type="text" class="form-control" id="invoice_number" name = "invoice_number" placeholder="Input Invoice Number">
                                        </div>

                                        <div class="form-group">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">&nbsp;</label><br/>
                                            <button type="submit" class="btn btn-primary filter-col " id = "btn_search" style="margin-bottom: 0px;">
                                                <i class="fa fa-search"></i> Search
                                            </button>
                                        </div>

                                    </div><br/>

                                    <div class="group-payment">

                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Which Line Item:</label><br/>
                                            <input type="text" class="form-control" id="line_item" name = "line_item" style="width: 100px;" readonly>
                                        </div>

                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Reference Number:</label><br/>
                                            <input type="text" class="form-control" id="ref_number" name = "ref_number" style="width: 240px;" required>
                                        </div>

                                        <br /><br />

                                        <div class="form-group" id="data_1" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-perpage">Date of Payment:</label><br/>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" id = "date_of_payment" name = "date_of_payment" class="form-control" value="03/04/2014" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="filter-col" style="margin-right:0;" for="pref-perpage">Payment Method:</label><br/>
                                            <select class="form-control" id = "payment_method" name = "payment_method" required>
                                                <option value="1">Cash</option>
                                                <option value="2">Credit Card</option>
                                                <option value="3">Checked</option>
                                                <option value="4">Paypal</option>
                                            </select>
                                        </div>

                                        <br /><br />

                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Amount:</label><br/>
                                            <input style="text-align: right;" class="form-control" type='number' step='0.01' value='0.00' id = "amount" name = "amount" placeholder='0.00' required/>
                                        </div>

                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Total Paid:</label><br/>
                                            <input style="text-align: right;" class="form-control" type='number' step='0.01' value='0.00' id = "total_paid" name = "total_paid" placeholder='0.00' readonly/>
                                        </div>

                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Total Balance:</label><br/>
                                            <input style="text-align: right;" class="form-control" type='number' step='0.01' value='0.00' id = "rem_balance" name = "rem_balance" placeholder='0.00' readonly/>
                                        </div>

                                        <br /><br />

                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Remarks:</label><br/>
                                            <input type="text" class="form-control" id="remarks" name = "remarks" style="width: 360px;" required>
                                        </div>

                                        <div class="form-group pull-right">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">&nbsp;</label><br/>
                                            <button type="submit" class="btn btn-primary filter-col " id = "btn_save" style="margin-bottom: 0px;">
                                                <span class="glyphicon glyphicon-record"></span> Save
                                            </button>
                                            <button type="submit" class="btn btn-danger filter-col " id = "btn_cancel" style="margin-bottom: 0px;">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>

                                {{--</form>--}}

                            </div>
                        </div>
                    </div>

                     <div class="table-responsive">
                        <table id="tbl_payment_list" class="footable table table-striped table-bordered table-hover dataTables-example-main" >
                         {{--<table id="tbl_payment_list" class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">--}}
                            <thead>
                                <tr>
                                    <th style='text-align: center; width: 30px;'>Proposal ID</th>
                                    <th style='text-align: center; '>Pub.</th>
                                    <th style='text-align: center; width: 70px;'>Issue</th>
                                    <th style='text-align: center; width: 70px;'>Year</th>
                                    <th style='text-align: center; width: 100px;'>Ad Size</th>
                                    <th style='text-align: center; width: 70px;'>Ad Color</th>
                                    <th style='text-align: right; width: 100px;'>Net</th>
                                    <th style='text-align: center; width: 70px;'>Qty</th>
                                    <th style='text-align: right; width: 100px;'>GST/HST</th>
                                    <th style='text-align: right; width: 100px;'>Amount</th>
                                    <th style='text-align: center; width: 250px;'>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_transaction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">View Transaction</h4>
            </div>

            <div class="modal-body">
                Invoice Number: <label id = "invoice_number_result"></label> <br />
                Proposal ID: <label id = "line_item_result"></label>
                <br /><br />
                {{--<table class="table table-striped table-bordered table-hover dataTables-example" id="view_transaction_results">--}}
                    <table id="view_transaction_results" class="footable table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                    <tr>
                        <th style="width: 10%; text-align: center;">Ref #</th>
                        <th style="width: 20%; text-align: center;">METHOD PAYMENT</th>
                        <th style="width: 20%; text-align: center;">DATE PAYMENT</th>
                        <th style="width: 10%; text-align: center;">AMOUNT</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <div id = "sum_group">
                    <div class="col-sm-7"></div>
                    <div class="col-sm-3"><b>Total Payment:</b></div>
                    <div class="col-sm-2" style = "text-align: right"><label id = "total_payment"></label></div>

                    <div class="col-sm-7"></div>
                    <div class="col-sm-3"><b>Total Payable:</b></div>
                    <div class="col-sm-2" style = "text-align: right"><label id = "total_balance"></label></div>

                    <div class="col-sm-7"></div>
                    <div class="col-sm-3"><b>Balance:</b></div>
                    <div class="col-sm-2" style = "text-align: right"><label id = "available_balance"></label></div>
                </div>
                <div style = "clear: both;"></div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script>
    $(document).ready(function(){

//        $('.dataTables-example-main').DataTable({
//            dom: '<"html5buttons"B>lTfgitp',
//            buttons: []
//        });
//        TEMPORARY
//        populate_inv_num('2017-12345');


        $(".group-payment").hide();

        $("#btn_cancel").click(function(){
            $(".group-payment").hide();
        });

        $("#btn_search").click(function(){
            var inv_num = $("#invoice_number").val();
            if(inv_num == "")
            {
                swal(
                        'Oops...',
                        'Invoice Number Required!',
                        'error'
                )
                return false;
            }

            $.ajax({
                url: "/payment/search_invoice_number_api/" + inv_num,
                dataType: "text",
                beforeSend: function () {
                },
                success: function(data) {
                    var json = $.parseJSON(data);
                    if(json.result == 200)
                    {
                        populate_inv_num(inv_num);

                    }else{
                        swal(
                                '',
                                'Invoice Number is not available!',
                                'error'
                        )
                        return false;

                    }
                }
            });
        });

        function populate_inv_num(inv_num) {
            var html_thmb = "";
            var isFirstLoad = true;

            $.ajax({
                url: "http://"+ report_url_api +"/kpa/work/invoice-transaction-list/" + inv_num,
                dataType: "text",
                beforeSend: function () {
                    if(isFirstLoad) {
                        isFirstLoad = false;
                        $('table#tbl_payment_list > tbody').empty().prepend('<tr> <td colspan="11" style="text-align: center;"> <img src="{{ asset('img/ripple.gif') }}" style="width: 90px;"  />  Fetching All Transactions... Please wait...</td> </tr>');
                    }
                },
                success: function(data) {
                    var json = $.parseJSON(data);
                    if(json == null)
                        return false;

                    $(json.Data).each(function(i, tran){

                        $(json.Company_Information).each(function(i, info){

                            html_thmb += "<tr>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.id +"</td>";
                            html_thmb += "<td style='text-align: left;'>"+ info.company_name +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.quarter_issued +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ json.Magazine_Year +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.ad_size +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.ad_color +"</td>";
                            html_thmb += "<td style='text-align: right;'>"+ numeral(tran.sub_total_amount).format('0,0.00') +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.line_item_qty +"</td>";
                            html_thmb += "<td style='text-align: left;'></td>";
                            html_thmb += "<td style='text-align: right;'>"+ numeral(tran.total_amount_with_discount).format('0,0.00') +"</td>";
                            html_thmb += "<td style='text-align: left;'>" +
                                    "<select class='form-control'  id = 'action_payment_"+tran.id +"'>" +
                                    "<option value = '0'>--select--</option>" +
                                    "<option value = '"+ tran.id + ":" + tran.total_amount_with_discount + ":" + inv_num + ":1'>Select for payment</option>" +
                                    "<option value = '"+ tran.id + ":" + inv_num + ":" + tran.total_amount_with_discount + ":2'>View Transaction</option>" +
                                    "<option value = '"+ tran.id + ":" + tran.total_amount_with_discount + ":" + inv_num + ":3'>View Invoice</option>" +
                                    "</select>" +
                                    "</td>";
                            html_thmb += "</tr>";

                        });
                    });

                    $('table#tbl_payment_list > tbody').empty().prepend(html_thmb);

                    $("#tbl_payment_list > tbody  > tr").change(function(){
                        var selected =  $(this).find('select:first');
                        var value =  selected.val();
                        var values = value.split(":");

                        if(values[3] == 1){

                            var value =  selected.val();
                            var values = value.split(":");
                            var line_item = values[0];
                            var amount = values[1];
                            var inv_num = values[2];

                            $('#line_item').val(values[0]);

                            $.ajax({
                                url: "/payment/view/transaction/" + inv_num + "/" + line_item,
                                dataType: "text",
                                beforeSend: function () {
                                },
                                success: function(data) {
                                    var json = $.parseJSON(data);
                                    if(json == null)
                                        return false;

                                    if(json.status == 200)
                                    {
                                        var r_balance = amount - json.total_paid;

                                        $('#total_paid').val(json.total_paid);
                                        $('#rem_balance').val(r_balance);
                                        $('#amount').val("0.00");

                                        if(r_balance <= 0)
                                        {
                                            swal(
                                                    'PAID',
                                                    'Invoice Number <b>' + inv_num + '</b> and Proposal ID <b>'+ line_item +'</b>',
                                                    'info'
                                            )
                                            $(".group-payment").hide();
                                            return false;
                                        }else{

                                            $(".group-payment").show();
                                        }
                                    }
                                    else
                                    {
                                        $('#total_paid').val("0.00");
                                        $('#rem_balance').val(amount);
                                        $('#amount').val("0.00");
                                        $(".group-payment").show();
                                    }
                                }
                            });
                        }else if(values[3] == 2){

                            $('#modal_transaction').modal({
                                show: true
                            });

                            var value =  selected.val();
                            var values = value.split(":");
                            var line_item = values[0];
                            var inv_num = values[1];
                            var total_balance = values[2];

                            $.ajax({
                                url: "/payment/view/transaction/" + inv_num + "/" + line_item,
                                dataType: "text",
                                beforeSend: function () {
                                },
                                success: function(data) {
                                    var json = $.parseJSON(data);
                                    if(json == null)
                                        return false;

                                    if(json.status == 200)
                                    {
//                        var method_of_payment;
                                        var html_thmb = "";
                                        var total_payment = 0;
                                        var available_balance = 0;

                                        $(json.result).each(function(i, info){

                                            total_payment += Number(info.amount);
                                            available_balance = (total_balance - total_payment);

                                            $("#invoice_number_result").empty().append(json.invoice_num_result);
                                            $("#line_item_result").empty().append(json.line_item_id_result);

                                            if(info.method_payment == 1){
                                                method_of_payment = 'Cash';
                                            }else if(info.method_payment == 2){
                                                method_of_payment = 'Credit Card';
                                            }else if(info.method_payment == 3){
                                                method_of_payment = 'Checked';
                                            }else if(info.method_payment == 4){
                                                method_of_payment = 'Paypal';
                                            }

                                            html_thmb += "<tr>";
                                            html_thmb += "<td style='text-align: center;'>"+ info.reference_number +"</td>";
                                            html_thmb += "<td style='text-align: center;'>"+ method_of_payment +"</td>";
                                            html_thmb += "<td style='text-align: center;'>"+ info.date_payment +"</td>";
                                            html_thmb += "<td style='text-align: center;'>"+ info.amount +"</td>";
                                            html_thmb += "</tr>";

                                        });

                                        $('table#view_transaction_results > tbody').empty().prepend(html_thmb);
                                        $('#total_payment').empty().append(numeral(total_payment).format('0,0.00'));
                                        $('#total_balance').empty().append(numeral(total_balance).format('0,0.00'));
                                        $('#available_balance').empty().append(numeral(available_balance).format('0,0.00'));
                                    }
                                }
                            });

                        }else if (values[3] == 3){

                            var value =  selected.val();
                            var values = value.split(":");
                            var line_item = values[0];
                            var inv_num = values[2];
                            var amount = values[1];

                            $.ajax({
                                url: "/payment/view/transaction/" + inv_num + "/" + line_item,
                                dataType: "text",
                                beforeSend: function () {
                                },
                                success: function(data) {
                                    var json = $.parseJSON(data);
                                    if(json == null)
                                        return false;

                                    if(json.status == 200)
                                    {
                                        var r_balance = amount - json.total_paid;

                                        if(r_balance <= 0)
                                        {
                                            window.open('http://'+ report_url_api +'/kpa/work/transaction/invoice-order/'+ inv_num +'/'+ line_item +'/paid',
                                                    "mywindow","location=1,status=1,scrollbars=1,width=755,height=760");
                                        }else{
                                            window.open('http://'+ report_url_api +'/kpa/work/transaction/invoice-order/'+ inv_num +'/'+ line_item +'',
                                                    "mywindow","location=1,status=1,scrollbars=1,width=755,height=760");
                                        }
                                    }
                                }
                            });

                        } else {
                            $(".group-payment").hide();
                        }
                    });

                }
            });
        }

        $("#btn_save").click(function(){
            var inv_num = $("#invoice_number").val();
            var date_of_payment = Date.parse($("#date_of_payment").val()) / 1000;
            var payment_method = $("#payment_method").val();
            var ref_number = $("#ref_number").val();
            var line_item = $("#line_item").val();
            var amount = $("#amount").val();
            var rem_balance = $("#rem_balance").val();
            var remarks = $("#remarks").val();

            if(inv_num == "")
            {
                swal(
                        'Oops...',
                        'Invoice # is required!',
                        'warning'
                )
                return false;
            }

            if(ref_number == "")
            {
                swal(
                        'Oops...',
                        'Ref Number is required!',
                        'warning'
                )
                return false;
            }

            if(amount == "" || amount == '0.00')
            {
                swal(
                        'Oops...',
                        'Please input your payment!',
                        'warning'
                )
                return false;
            }

            if(remarks == "")
            {
                swal(
                        'Oops...',
                        'Remarks is required!',
                        'warning'
                )
                return false;
            }

            if(parseFloat(amount) > parseFloat(rem_balance)){
                swal(
                        '',
                        'Payment must be less than or equal invoice balance!',
                        'error'
                )
                return false;
            }
            else
            {
                $.ajax({
                    url: "/payment/save_payment_transaction/" + inv_num + "/" + line_item + "/" + ref_number + "/" + payment_method + "/" + date_of_payment + "/" + amount + "/" + remarks,
                    dataType: "text",
                    beforeSend: function () {
                    },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if(json.result == 200)
                        {
                            swal(
                                    '',
                                    'The Payment Transaction has been saved!',
                                    'success'
                            )

                            $(".group-payment").hide();
//                        window.location.href = "/payment/payment_list";
                        }
                    }
                });
            }
        });

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

    });


    function open_preview(trans_number) {
        window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/insertion-order-contract/" + trans_number + "/preview",
                "mywindow","location=1,status=1,scrollbars=1,width=755,height=760");
    }

    $(document).ready( function() {
        $("#filter").on('change', function(){
            window.location.href = "/booking/booking-list/" + $(this).val();
        });

        $("#tbl_booking_lists > tbody  > tr").change(function(){
            var value =  $(this).find('select:first').val();
            var values = value.split(":");

            if(values.length > 1) {
                var str_to_int = parseInt(values[0]);
                var trans_num = values[1];
                if(str_to_int == -1) {
                    window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/insertion-order-contract/" + trans_num + "/preview",
                            "mywindow","location=1,status=1,scrollbars=1,width=755,height=760");
                }
                if(str_to_int == -2) {
                    window.open("http://"+ Url_Client_Dashboard + trans_num,'_blank');
                }
            }
        });

//        $('#amount').val("0.00");
//        $('#amount').on('keyup', function(){
//            var total_paid = $('#total_paid').val();
//            var value = $(this).val();
//            if(value != "") {
//                var rem_balance = parseFloat(total_paid) - parseFloat(value);
//                var t_blance = numeral(rem_balance).format('0,0.00');
//                $('#rem_balance').val(t_blance);
//            }
//        });

    } );

    update_status = function(control_id, trans_num) {
        var selected = $('#ddlStatus_' + control_id).val();
        var str_to_int = parseInt(selected);
        if(str_to_int > 0)
        {
            var url = "/transaction/update/row/"+ control_id +"/"+ selected;
            $(document).ready( function() {
                $.ajax({
                    url: url,
                    dataType: "text",
                    beforeSend: function () {
                    },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if(json.status == 200)
                        {
                            alert("Update was successful");
                            location.reload();
                        }
                    }
                });
            } );
        }
    }
</script>
@endsection