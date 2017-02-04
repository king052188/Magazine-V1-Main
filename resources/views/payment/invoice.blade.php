@extends('layout.magazine_main')

@section('title')
    Magazines List
@endsection

@section('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/datepicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{  asset('css/plugins/chosen/chosen.css')  }}" rel="stylesheet">
    <style type="text/css">
        /*.imp_display select*/
        /*{*/
            /*background-color: #2f4050 !important;*/
            /*color: #FFFFFF !important;*/
        /*}*/
        .imp_display > select > option{
            background-color: #2f4050 !important;
            color: #FFFFFF !important;
        }
    </style>
@endsection

@section('magazine_content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Payment</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Generate Invoice</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Generate Invoice</h5>
                    </div>

                    <div class="ibox-content">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-sm-12 form-inline">

                                    {{--<form class="form-inline" role="form">--}}
                                    <div class="">
                                        <div class="form-group imp_display" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Company Name</label><br/>
                                            <select class="form-control chosen-select" name = "company_name" id = "company_name">
                                                <option value="0">Select</option>
                                                @for($i = 0; $i < COUNT($clients); $i++)
                                                    <option value = "{{ $clients[$i]->Id }}">{{ $clients[$i]->company_name }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Magazine Name</label><br/>
                                            <select class="form-control chosen-select" style="background-color: #2f4050; color: #FFFFFF;" name = "magazine_name" id = "magazine_name">
                                                <option value="0">Select</option>
                                                @for($i = 0; $i < COUNT($magazine); $i++)
                                                    <option value = "{{ $magazine[$i]->Id }}">{{ $magazine[$i]->magazine_name }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Year</label><br/>
                                            <select class='form-control' name='generate_year' id = 'generate_year' style="background-color: #2f4050; color: #FFFFFF; width: 150px; height: 30px;" required>
                                                @for($i = date('Y'); $i > date('Y') - 10; $i--)
                                                    <option value='{{ $i }}'>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Issue</label><br/>
                                            <select class='form-control' name='generate_issue' id = 'generate_issue' style="background-color: #2f4050; color: #FFFFFF; width: 100px; height: 30px;" required>
                                                @for($i = 1; $i < 13; $i++)
                                                    <option value='{{ $i }}'>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">&nbsp;</label><br/>
                                            <button type="submit" class="btn btn-primary filter-col " id = "btn_generate" style="margin-bottom: 0px; height: 30px; padding: 0 5px 0 5px;">
                                                <i class="fa fa-ticket"></i> Generate
                                            </button>
                                        </div>
                                    </div><br/>

                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#all_invoice" id = "all_invoice_press"> All Invoices</a></li>
                                    <li class=""><a data-toggle="tab" href="#latest_invoice" id = "latest_invoice_press"> Latest 24 hours Invoices</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="latest_invoice" class="tab-pane">
                                        <table id="tbl_latest_invoice_list" class="footable table table-striped table-bordered table-hover dataTables-example-main" >
                                            <thead>
                                                <tr>
                                                    <th style='text-align: center; width: 150px;'>Invoice #</th>
                                                    <th style='text-align: center; width: 100px;'>Issue</th>
                                                    <th style='text-align: center; width: 100px;'>Year</th>
                                                    <th style='text-align: center;'>Executive Account</th>
                                                    <th style='text-align: center; width: 150px;'>Invoice Created</th>
                                                    <th style='text-align: center; width: 150px;'>Due Date</th>
                                                    <th style='text-align: center; width: 80px;'>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> </tbody>
                                        </table>
                                    </div>
                                    <div id="all_invoice" class="tab-pane active">
                                        <table id="tbl_all_invoice_list" class="footable table table-striped table-bordered table-hover dataTables-example-main" >
                                            <thead>
                                                <tr>
                                                    <th style='text-align: center; width: 150px;'>Invoice #</th>
                                                    <th style='text-align: center; width: 100px;'>Issue</th>
                                                    <th style='text-align: center; width: 100px;'>Year</th>
                                                    <th style='text-align: center;'>Executive Account</th>
                                                    <th style='text-align: center; width: 150px;'>Invoice Created</th>
                                                    <th style='text-align: center; width: 150px;'>Due Date</th>
                                                    <th style='text-align: center; width: 80px;'>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<div class="modal fade" id="modal_view_invoice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
        {{--<div class="modal-dialog modal-lg" role="document">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                    {{--</button>--}}
                    {{--<h4 class="modal-title" id="myModalLabel">List of Issue</h4>--}}
                {{--</div>--}}
                {{--<div class="col-lg-12">--}}
                    {{--<div class="modal-body form group">--}}
                        {{--<table id="modal_info" class="table table-striped table-bordered table-hover dataTables-example-main" >--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th style='text-align: center; width: 30px;'>Proposal ID</th>--}}
                                {{--<th style='text-align: center; '>Pub.</th>--}}
                                {{--<th style='text-align: center; width: 70px;'>Issue</th>--}}
                                {{--<th style='text-align: center; width: 70px;'>Year</th>--}}
                                {{--<th style='text-align: center; width: 100px;'>Ad Size</th>--}}
                                {{--<th style='text-align: center; width: 70px;'>Ad Color</th>--}}
                                {{--<th style='text-align: right; width: 100px;'>Net</th>--}}
                                {{--<th style='text-align: center; width: 70px;'>Qty</th>--}}
                                {{--<th style='text-align: right; width: 100px;'>GST/HST</th>--}}
                                {{--<th style='text-align: right; width: 100px;'>Amount</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}

                            {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />--}}
                    {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

@section('scripts')
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script>
        $(document).ready(function(){

            populate_invoice_list();

            $("#latest_invoice_press").click(function(){
                populate_latest_invoice_list();
            });

            $("#all_invoice_press").click(function(){
                populate_invoice_list();
            });

            function populate_invoice_list(){
                var html_thmb = "";
                var isFirstLoad = true;
                $.ajax({
                    url: "/payment/invoice/list",
                    dataType: "text",
                    beforeSend: function () {
                        if(isFirstLoad) {
                            isFirstLoad = false;
                            $('table#tbl_all_invoice_list > tbody').empty().prepend('<tr> <td colspan="7" style="text-align: center;"> <img src="{{ asset('img/ripple.gif') }}" style="width: 90px;"  />  Fetching All Transactions... Please wait...</td> </tr>');
                        }
                    },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if(json == null)
                            return false;

                        $(json.list).each(function(i, tran){

                            //console.log(json);

                            html_thmb += "<tr>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.invoice_num +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.issue +"</td>";
                            var get_created_date = stripped_date_time(tran.created_at);
                            html_thmb += "<td style='text-align: center;'>"+ get_created_date[0] +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.sales_rep_name +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ get_created_date[1] +"</td>";

                            var get_due_date = stripped_date_time(tran.created_at);
                            html_thmb += "<td style='text-align: center;'>"+ get_due_date[1] +"</td>";
                            html_thmb += "<td style='text-align: center;'>" +
                                    "<a href = '#' get-val = '"+ tran.invoice_num + "' data-toggle='modal' data-target='#modal_view_invoice' class='btn btn-primary btn-xs view_invoice'><i class='fa fa-eye'></i> View Invoice</a>" +
                                    "</td>";
                            html_thmb += "</tr>";

                        });

                        $('table#tbl_all_invoice_list > tbody').empty().prepend(html_thmb);
                    }
                });
            }

            function populate_latest_invoice_list(){
                var html_thmb = "";
                var isFirstLoad = true;
                $.ajax({
                    url: "/payment/latest/invoice/list",
                    dataType: "text",
                    beforeSend: function () {
                        if(isFirstLoad) {
                            isFirstLoad = false;
                            $('table#tbl_latest_invoice_list > tbody').empty().prepend('<tr> <td colspan="7" style="text-align: center;"> <img src="{{ asset('img/ripple.gif') }}" style="width: 90px;"  />  Fetching All Transactions... Please wait...</td> </tr>');
                        }
                    },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if(json == null)
                            return false;

                        $(json.list).each(function(i, tran){
                            html_thmb += "<tr>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.invoice_num +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.issue +"</td>";

                            var get_created_date = stripped_date_time(tran.created_at);
                            html_thmb += "<td style='text-align: center;'>"+ get_created_date[0] +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.sales_rep_name +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ get_created_date[1] +"</td>";

                            var get_due_date = stripped_date_time(tran.due_date);
                            html_thmb += "<td style='text-align: center;'>"+ get_due_date[1] +"</td>";
                            html_thmb += "<td style='text-align: center;'>" +
                                    "<a href = '#' get-val = '"+ tran.invoice_num + "' class='btn btn-primary btn-xs view_invoice'><i class='fa fa-eye'></i> View</a>" +
                                    "</td>";
                            html_thmb += "</tr>";

                        });

                        $('table#tbl_latest_invoice_list > tbody').empty().prepend(html_thmb);
                    }
                });
            }

            function stripped_date_time(date_time) {
                var get_created_at =  date_time.split(" ");
                var get_year = get_created_at[0].split("-");
                var get_date = get_year[1] + "-" + get_year[2] + "-" + get_year[0];
                return [get_year[0], get_date];
            }

            $("#btn_generate").click(function(){

                var generate_issue = $("#generate_issue").val();
                var generate_year = $("#generate_year").val();
                var generate_company_name = $("#company_name").val();
                var generate_magazine_name = $("#magazine_name").val();

                $.ajax({
                    url: "/payment/invoice/generate/" + generate_issue + "/" + generate_year + "/" + generate_company_name + "/" + generate_magazine_name,
                    dataType: "text",
                    beforeSend: function () {

                    },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if(json == null)
                            return false;

                        if(json.status == 202)
                        {
                            swal(
                                    '',
                                    'Generating Invoice Number has been done.',
                                    'success'
                            )

                            populate_invoice_list();
                        }
                        else if(json.status == 404)
                        {
                            swal(
                                    '',
                                    'No Available Invoice.',
                                    'error'
                            )
                        }
                    }
                });
            });

            $(document).on("click",".view_invoice",function() {

                var value =  $(this).attr('get-val');
                var inv_num = value;

                window.open("http://"+ report_url_api +"/kpa/work/transaction/invoice-order/"+ inv_num  +"",
                        "mywindow","location=1,status=1,scrollbars=1,width=755,height=760");

//                console.log(inv_num);
//
//                $.ajax({
//                    url: "/payment/search_invoice_number_api/" + inv_num,
//                    dataType: "text",
//                    beforeSend: function () {
//                    },
//                    success: function(data) {
//                        var json = $.parseJSON(data);
//                        if(json.result == 200)
//                        {
//                            populate_inv_num(inv_num, json.is_member, json.discount_percent, json.province_tax);
//
//                        }else{
//                            swal(
//                                    '',
//                                    'Invoice Number is not available!',
//                                    'error'
//                            )
//                            return false;
//
//                        }
//                    }
//                });
            });

            function populate_inv_num(inv_num, is_member, discount_percent, province_tax) {
                var html_thmb = "";
                var isFirstLoad = true;

                $.ajax({
                    url: "http://"+ report_url_api +"/kpa/work/invoice-transaction-list/" + inv_num,
                    dataType: "text",
                    beforeSend: function () {
                        if(isFirstLoad) {
                            isFirstLoad = false;
                            $('table#modal_info > tbody').empty().prepend('<tr> <td colspan="11" style="text-align: center;"> <img src="{{ asset('img/ripple.gif') }}" style="width: 90px;"  />  Fetching All Transactions... Please wait...</td> </tr>');
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

                                var new_price = tran.sub_total_amount;
                                if(is_member > 0) {
                                    discount = "15%";
                                    var new_price_aa = new_price - (new_price * 0.15);
                                    new_price =  new_price_aa - (new_price_aa * (discount_percent / 100));
                                }

                                //console.log(discount_percent);
                                //console.log(province_tax * 100);

                                html_thmb += "<td style='text-align: right;'>"+ numeral(new_price).format('0,0.00') +"</td>";
                                html_thmb += "<td style='text-align: center;'>"+ tran.line_item_qty +"</td>";
                                html_thmb += "<td style='text-align: center;'>"+ numeral(province_tax * 100).format('0,0') +"%</td>";
                                html_thmb += "<td style='text-align: right;'>"+ numeral(new_price + (new_price * province_tax)).format('0,0.00') +"</td>";
                                html_thmb += "</tr>";

                            });
                        });

                        $('table#modal_info > tbody').empty().prepend(html_thmb);

                    }
                });
            }

        });
    </script>
    <!-- Chosen -->
    <script src="{{ asset('js/plugins/chosen/chosen.jquery.js') }}"></script>
    <script>
        var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : {allow_single_deselect:true},
            '.chosen-select-no-single' : {disable_search_threshold:10},
            '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'}
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }
    </script>
@endsection