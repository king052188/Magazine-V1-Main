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
                                        <div class="form-group" id="data_1">
                                        <label class="filter-col" style="margin-right:0;" for="pref-perpage">Date of Payment:</label><br/>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" id = "date_of_payment" name = "date_of_payment" class="form-control" value="03/04/2014" required>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-perpage">Payment Method:</label><br/>
                                            <select class="form-control" id = "payment_method" name = "payment_method" required>
                                                <option value="1">Cash</option>
                                                <option value="2">Credit Card</option>
                                                <option value="3">Checked</option>
                                                <option value="4">Paypal</option>
                                            </select>                                
                                        </div> 
                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Reference Number:</label><br/>
                                            <input type="text" class="form-control" id="ref_number" name = "ref_number" required>
                                        </div> 
                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Which Line Item:</label><br/>
                                            <input type="text" class="form-control" id="line_item" name = "line_item" required>
                                        </div>

                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Amount to be paid:</label><br/>
                                            <input class="form-control" type='number' step='0.01' value='0.00' id = "amount" name = "amount" placeholder='0.00' required/>
                                        </div>
                                        <div class="form-group pull-right">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">&nbsp;</label><br/>
                                            <button type="submit" class="btn btn-primary filter-col " id = "btn_save" style="margin-bottom: 0px;">
                                                <span class="glyphicon glyphicon-record"></span> Save
                                            </button> 
                                        </div>
                                    </div>

                                {{--</form>--}}

                            </div>
                        </div>
                    </div>

                     <div class="table-responsive">
                        <table id="tbl_booking_lists" class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th style='text-align: center; width: 30px;'>Proposal ID</th>
                                    <th style='text-align: center; '>Pub.</th>
                                    <th style='text-align: center; width: 70px;'>Issue</th>
                                    <th style='text-align: center; width: 70px;'>Year</th>
                                    <th style='text-align: center; width: 70px;'>Ad Size</th>
                                    <th style='text-align: center; width: 70px;'>Ad Color</th>
                                    <th style='text-align: right; width: 100px;'>Net</th>
                                    <th style='text-align: center; width: 70px;'>Qty</th>
                                    <th style='text-align: right; width: 100px;'>GST/HST</th>
                                    <th style='text-align: right; width: 100px;'>Amount</th>
                                    <th style='text-align: center; width: 100px;'>Action</th>
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
@endsection

@section('scripts')
<script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script>
    $(document).ready(function(){

        $(".group-payment").hide();

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
                        swal(
                                '',
                                'Invoice Number is available!',
                                'success'
                        )

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

        function populate_inv_num(inv_num)
        {
            console.log(inv_num);

            var html_thmb;

            $.ajax({
                url: "http://magazine-api.kpa21.com/kpa/work/invoice-transaction-list/" + inv_num,
                dataType: "text",
                beforeSend: function () {
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
                            html_thmb += "<td style='text-align: left;'><a href = '#' class='btn btn-primary btn-sm view-clicked' get-val = '"+ tran.id + ":" + tran.total_amount_with_discount +"' title='View Transactions'><i class='fa fa-eye'></i> View</a></td>";
                            html_thmb += "</tr>";

                        });
                    });

                    $('table#tbl_booking_lists > tbody').empty().prepend(html_thmb);

                }
            });
        }



        $(document).on("click",".view-clicked",function() {

            $(".group-payment").show();

            var value =  $(this).attr('get-val');
            var values = value.split(":");

            $('#line_item').val(values[0]);
            $('#amount').val(values[1]);
        });

        $("#btn_save").click(function(){
            var inv_num = $("#invoice_number").val();
            var date_of_payment = Date.parse($("#date_of_payment").val()) / 1000;
            var payment_method = $("#payment_method").val();
            var ref_number = $("#ref_number").val();
            var line_item = $("#line_item").val();
            var amount = $("#amount").val();

            $.ajax({
                url: "/payment/save_payment_transaction/" + inv_num + "/" + line_item + "/" + ref_number + "/" + payment_method + "/" + date_of_payment + "/" + amount,
                dataType: "text",
                beforeSend: function () {
                },
                success: function(data) {
                    var json = $.parseJSON(data);
                    if(json.result == 200)
                    {
                        swal(
                                '',
                                'Successfully Saved!',
                                'success'
                        )
                        window.location.href = "/payment/payment_list";

                    }
                }
            });
        });

        $('.dataTables-example').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: []
        });

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
    });



    function open_preview(trans_number)
    {
//        window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/pdf/" + trans_number + "?show=preview",
//                "mywindow","location=1,status=1,scrollbars=1,width=727,height=680");
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
//                    window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/pdf/" + trans_num + "?show=preview",
//                            "mywindow","location=1,status=1,scrollbars=1,width=727,height=680");
                    window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/insertion-order-contract/" + trans_num + "/preview",
                            "mywindow","location=1,status=1,scrollbars=1,width=755,height=760");
                }
                if(str_to_int == -2) {
                    window.open("http://"+ Url_Client_Dashboard + trans_num,'_blank');
                }
            }
        });
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