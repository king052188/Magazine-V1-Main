@extends('layout.magazine_main')

@section('title')
    Magazines List
@endsection

@section('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/datepicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{  asset('css/plugins/chosen/chosen.css')  }}" rel="stylesheet">

@endsection

@section('magazine_content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Payment</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>List of all Digital Invoices</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>List of all Invoices</h5>
                    </div>

                    <div class="ibox-content">

                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-sm-12 form-inline">

                                    {{--<form class="form-inline" role="form">--}}
                                    <div class="" id = "filter_container">
                                        <div class="form-group imp_display" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Client Name</label><br/>
                                            <select class="form-control chosen-select" style="background-color: #2f4050; color: #FFFFFF; height: 35px;" id = "client_name">
                                                <option value="0">Select</option>
                                                @for($i = 0; $i < COUNT($clients); $i++)
                                                    <option value = "{{ $clients[$i]->Id }}">{{ $clients[$i]->company_name }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Publication Name</label><br/>
                                            <select class="form-control chosen-select" style="background-color: #2f4050; color: #FFFFFF; height: 35px;" id = "publication_name">
                                                <option value="0">Select</option>
                                                @for($i = 0; $i < COUNT($magazine); $i++)
                                                    <option value = "{{ $magazine[$i]->Id }}">{{ $magazine[$i]->magazine_name }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Year</label><br/>
                                            <select class='form-control' id = 'year' style="background-color: #2f4050; color: #FFFFFF; width: 150px; height: 35px;" required>
                                                @for($i = date('Y') - 3; $i < date('Y') + 3; $i++)
                                                    <option value='{{ $i }}' {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Choose</label><br/>
                                            <select class='form-control' id = 'choose' style="background-color: #2f4050; color: #FFFFFF; width: 150px; height: 35px;" required>
                                                <option value = "0">-select-</option>
                                                <option value = "1">Monthly</option>
                                                <option value = "2">Weekly</option>
                                            </select>
                                        </div>

                                        <div class="form-group" style="margin-right: 10px; display: none;" id = "month_area">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Months</label><br/>
                                            <select class="form-control" id='monthly' style="background-color: #2f4050; color: #FFFFFF; width: 150px; height: 35px;" required>
                                                <option value='1'>January</option>
                                                <option value='2'>February</option>
                                                <option value='3'>March</option>
                                                <option value='4'>April</option>
                                                <option value='5'>May</option>
                                                <option value='6'>June</option>
                                                <option value='7'>July</option>
                                                <option value='8'>August</option>
                                                <option value='9'>September</option>
                                                <option value='10'>October</option>
                                                <option value='11'>November</option>
                                                <option value='12'>December</option>
                                            </select>
                                        </div>

                                        <div class="form-group" style="margin-right: 10px; display: none;" id = "week_area">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Weeks</label><br/>
                                            <select class="form-control" id='weekly' style="background-color: #2f4050; color: #FFFFFF; width: 150px; height: 35px;" required>
                                                <option value='1'>Week 1</option>
                                                <option value='2'>Week 2</option>
                                                <option value='3'>Week 3</option>
                                                <option value='4'>Week 4</option>
                                                <option value='5'>Week 5</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">&nbsp;</label><br/>
                                            <button type="submit" class="btn btn-primary filter-col " id = "btn_generate" style="margin-bottom: 0px; height: 30px; padding: 0 10px 0 5px;">
                                                <i class="fa fa-ticket"></i> Generate
                                            </button>
                                        </div>
                                    </div>
                                    <div id = "btn_generate_invoice_container">
                                        <button type="submit" class="btn btn-primary" id = "btn_generate_invoice">
                                            <i class="fa fa-ticket"></i> Generate Invoice
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active" id = "all_invoices_tab"><a data-toggle="tab" href="#all_invoice" id = "all_invoice_press"> All Invoices</a></li>
                                    <li class="" id = "latest_invoice_tab" style = "display: none;"><a data-toggle="tab" href="#latest_invoice" id = "latest_invoice_press"> Latest Invoices </a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="latest_invoice" class="tab-pane">
                                        <table id="tbl_latest_invoice_list" class="footable table table-striped table-bordered table-hover dataTables-example-main" >
                                            <thead>
                                            <tr>
                                                <th style='text-align: center; width: 150px;'>Invoice #</th>
                                                <th style='text-align: center; width: 150px;'>Publication</th>
                                                <th style='text-align: center; width: 100px;'>Month</th>
                                                <th style='text-align: center; width: 100px;'>Week</th>
                                                <th style='text-align: center; width: 100px;'>Year</th>
                                                <th style='text-align: center;'>Executive Account</th>
                                                <th style='text-align: center; width: 200px;'>Invoice Created</th>
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
                                                <th style='text-align: center; width: 150px;'>Publication</th>
                                                <th style='text-align: center; width: 100px;'>Month</th>
                                                <th style='text-align: center; width: 100px;'>Week</th>
                                                <th style='text-align: center; width: 100px;'>Year</th>
                                                <th style='text-align: center;'>Executive Account</th>
                                                {{--<th style='text-align: right; width: 150px;'>Amount</th>--}}
                                                <th style='text-align: center; width: 200px;'>Invoice Created</th>
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

@endsection

@section('scripts')
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script>
        $(document).ready(function(){


            populate_invoice_list();

            $("#filter_container").hide();
            $("#btn_generate_invoice").click(function(){
//                $("#filter_container").attr("style", "display:block;");
                $("#filter_container").show();
                $("#btn_generate_invoice_container").hide();
            });

//            $("#latest_invoice_press").click(function(){
//                populate_latest_invoice_list();
//            });

            $("#all_invoice_press").click(function(){
                populate_invoice_list();
            });

            $("#choose").change(function(){
                if($(this).val() == 1){
                    $("#month_area").show();
                    $("#week_area").hide();
                }else if($(this).val() == 2){
                    $("#month_area").show();
                    $("#week_area").show();
                }else{
                    $("#month_area").hide();
                    $("#week_area").hide();
                }
            });

            function populate_invoice_list(){

                var html_thmb = "";
                //var isFirstLoad = true;
                $.ajax({
                    url: "/payment/invoice/list/digital", // kapag PRINT "/payment/invoice/list", kapag DIGITAl "/payment/invoice/list/digital"
                    dataType: "text",
                    beforeSend: function () {
//                        if(isFirstLoad) {
//                            isFirstLoad = false;
                            $('table#tbl_all_invoice_list > tbody').empty().prepend('<tr> <td colspan="9" style="text-align: center;"> <img src="{{ asset('img/ripple.gif') }}" style="width: 90px;"  />  Fetching All Transactions... Please wait...</td> </tr>');
                        //}
                    },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if(json == null)
                            return false;

                        if(json.status == 404){
                            $('table#tbl_all_invoice_list > tbody').empty().prepend('<tr> <td colspan="9" style="text-align: center;">No Result Found</td> </tr>');
                            return false;
                        }

                        if(json.status == 202){
                            $(json.list).each(function(i, tran){
                                html_thmb += "<tr>";
                                html_thmb += "<td style='text-align: center;'>"+ tran.invoice_num +"</td>";
                                html_thmb += "<td style='text-align: center;'>"+ tran.mag_name +"</td>";
                                html_thmb += "<td style='text-align: center;'>"+ tran.month +"</td>";
                                html_thmb += "<td style='text-align: center;'>"+ tran.week +"</td>";
                                var get_created_date = stripped_date_time(tran.created_at);
                                html_thmb += "<td style='text-align: center;'>"+ get_created_date[0] +"</td>";
                                html_thmb += "<td style='text-align: center;'>"+ tran.sales_rep_name +"</td>";
//                            html_thmb += "<td style='text-align: right;'>"+ numeral(tran.invoice_amount).format('0,0.00') +"</td>";
                                html_thmb += "<td style='text-align: center;'>"+ get_created_date[1] + " | " + tran.time_ago +"</td>";

                                var get_due_date = stripped_date_time(tran.created_at);
                                html_thmb += "<td style='text-align: center;'>"+ get_due_date[1] +"</td>";
                                html_thmb += "<td style='text-align: center;'>" +
                                        "<a href = '#' get-val = '"+ tran.invoice_num + "' data-toggle='modal' data-target='#modal_view_invoice' class='btn btn-primary btn-xs view_invoice'><i class='fa fa-eye'></i> View Invoice</a>" +
                                        "</td>";
                                html_thmb += "</tr>";
                            });

                            $('table#tbl_all_invoice_list > tbody').empty().prepend(html_thmb);
                        }

                    }
                });
            }

            function populate_latest_invoice_list_digital(client_name, publication_name, yearly, monthly, weekly){
                var html_thmb = "";
                var isFirstLoad = true;
                $.ajax({
                    url: "/payment/latest/invoice/list/digital/" + client_name + "/" + publication_name + "/" + yearly + "/" + monthly + "/" + weekly,
                    dataType: "text",
                    beforeSend: function () {
                        if(isFirstLoad) {
                            isFirstLoad = false;
                            $('table#tbl_latest_invoice_list > tbody').empty().prepend('<tr> <td colspan="8" style="text-align: center;"> <img src="{{ asset('img/ripple.gif') }}" style="width: 90px;"  />  Fetching All Transactions... Please wait...</td> </tr>');
                        }
                    },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if(json == null)
                            return false;

                        $(json.list).each(function(i, tran){
                            html_thmb += "<tr>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.invoice_num +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.mag_name +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.issue +"</td>";
                            var get_created_date = stripped_date_time(tran.created_at);
                            console.log(get_created_date);

                            html_thmb += "<td style='text-align: center;'>"+ get_created_date[0] +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.sales_rep_name +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ get_created_date[1] + " | " + tran.time_ago +"</td>";

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

                var client_name = $("#client_name").val();
                var publication_name = $("#publication_name").val();
                var year = $("#year").val();
                var choose = $("#choose").val();
                var monthly = $("#monthly").val();
                var weekly = $("#weekly").val();

                if(client_name == 0 || publication_name == 0)
                {
                    swal(
                        '',
                        'Required Client Name and Publication Name',
                        'warning'
                    )
                    return false;
                }
                else if(choose == 0){
                    swal(
                        '',
                        'Required Months and Weeks',
                        'warning'
                    )
                    return false;
                }
                else
                {
                    if(choose == 1){
                        var url_exec = "/payment/invoice/generate/digital/" + client_name + "/" + publication_name + "/" + year + "/" + monthly + "/0";
                    }else{
                        var url_exec = "/payment/invoice/generate/digital/" + client_name + "/" + publication_name + "/" + year + "/" + monthly + "/" + weekly;
                    }

                    $.ajax({
                        url: url_exec,
                        dataType: "text",
                        beforeSend: function () {},
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

                                $("#all_invoices_tab").removeClass("active");
                                $("#all_invoice").removeClass("active");

                                $("#latest_invoice_tab").addClass("active");
                                $("#latest_invoice").addClass("active");

                                $("#latest_invoice_tab").show();

                                populate_latest_invoice_list_digital(json.client_name, json.publication_name, json.yearly, json.monthly, json.weekly);
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
                }
            });

            $(document).on("click",".view_invoice",function() {

                var value =  $(this).attr('get-val');
                var inv_num = value;

                window.open("http://"+ report_url_api +"/kpa/work/transaction/invoice-order/"+ inv_num  +"/DIGITAL",
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