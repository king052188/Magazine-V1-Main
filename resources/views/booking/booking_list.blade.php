@extends('layout.magazine_main')

@section('title')
    Magazines List
@endsection

@section('styles')
{{--<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">--}}
<link href="{{  asset('css/plugins/chosen/chosen.css')  }}" rel="stylesheet">
<link href="{{  asset('css/plugins/dataTables/datatables.min.css')  }}" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet">
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Booking</h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>Booking List</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            {{--<a href="/booking/add-booking" class="btn btn-primary">Add New Booking</a>--}}
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="height: 65px; padding: 20px;">
                <h5>Filter By:</h5>
                <div class = "pull-left" style = "margin-left: 10px;">
                    {{--<select class="form-control filter_click" id = "filter_publication" style = "background-color: #2f4050; color: #FFFFFF; margin-top: -7px;">--}}
                        {{--<option value = "0" {{ $filter_publication == "0" ? "selected" : "" }}>-- and/or Publication --</option>--}}
                        {{--@for($i = 0; $i < COUNT($publication); $i++)--}}
                        {{--<option value = "{{ $publication[$i]->Id }}" {{ $filter_publication == $publication[$i]->Id ? "selected" : "" }}>{{ $publication[$i]->magazine_name }}</option>--}}
                        {{--@endfor--}}
                    {{--</select>--}}
                    <select class="form-control chosen-select filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "filter_publication">
                        <option value = "0" {{ $filter_publication == "0" ? "selected" : "" }}>-- and/or Publication --</option>
                        @for($i = 0; $i < COUNT($publication); $i++)
                            <option value = "{{ $publication[$i]->Id }}" {{ $filter_publication == $publication[$i]->Id ? "selected" : "" }}>{{ $publication[$i]->magazine_name }}</option>
                        @endfor
                    </select>
                </div>
                @if($_COOKIE['role'] != 3)
                <div class = "pull-left" style = "margin-left: 10px;">
                    <select class="form-control filter_click" id = "filter_sales_rep" style = "background-color: #2f4050; height:30px; color: #FFFFFF;">
                        <option value = "0" {{ $filter_sales_rep == "0" ? "selected" : "" }}>-- and/or Sales Rep --</option>
                        @for($i = 0; $i < COUNT($sales_rep); $i++)
                            <option value = "{{ $sales_rep[$i]->Id }}" {{ $filter_sales_rep == $sales_rep[$i]->Id ? "selected" : "" }}>{{ $sales_rep[$i]->first_name . " " . $sales_rep[$i]->last_name }}</option>
                        @endfor
                    </select>
                </div>
                @endif
                <div class = "pull-left" style = "margin-left: 10px;">
                    {{--<select class="form-control filter_click" id = "filter_client" style = "background-color: #2f4050; color: #FFFFFF; margin-top: -7px;">--}}
                        {{--<option value = "0" {{ $filter_client == "0" ? "selected" : "" }}>-- and/or Client --</option>--}}
                        {{--@for($i = 0; $i < COUNT($clients); $i++)--}}
                            {{--<option value = "{{ $clients[$i]->Id }}" {{ $filter_client == $clients[$i]->Id ? "selected" : "" }}>{{ $clients[$i]->company_name }}</option>--}}
                        {{--@endfor--}}
                    {{--</select>--}}
                    <select class="form-control chosen-select filter_click" id = "filter_client">
                        <option value = "0" {{ $filter_client == "0" ? "selected" : "" }}>-- and/or Client --</option>
                        @for($i = 0; $i < COUNT($clients); $i++)
                            <option value = "{{ $clients[$i]->Id }}" {{ $filter_client == $clients[$i]->Id ? "selected" : "" }}>{{ $clients[$i]->company_name }}</option>
                        @endfor
                    </select>
                </div>
                <div class = "pull-left" style = "margin-left: 10px;">
                    <select class="form-control filter_click" id = "filter_status" style = "background-color: #2f4050; height: 30px; color: #FFFFFF;">
                        <option value = "0" {{ $filter_status == 0 ? "selected" : "" }}>-- and/or Status --</option>
                        <option value = "1" {{ $filter_status == 1 ? "selected" : "" }}>Pending</option>
                        <option value = "2" {{ $filter_status == 2 ? "selected" : "" }}>For Approval</option>
                        <option value = "3" {{ $filter_status == 3 ? "selected" : "" }}>Approved</option>
                        <option value = "5" {{ $filter_status == 5 ? "selected" : "" }}>Void</option>
                    </select>
                </div>
                <div class = "pull-left" style = "margin-left: 10px;">
                    <button class="btn btn-info" id = "btn_filter_display" style = "height: 30px;"><i class="fa fa-search"></i> Search</button>
                </div>
            </div>

            <div class="ibox-content">

                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    {{ Session::get('success') }}
                </div>
                @endif
                <div class="table-responsive">
                    {{--<table id="tbl_booking_lists" class="footable table table-stripped toggle-arrow-tiny" data-page-size="10" >--}}
                    <table id="tbl_booking_lists" class="table display nowrap dataTables-booking" data-sorting="true" data-page-size="10">
                        <thead>
                            <tr>
                                <th style='text-align: center; width: 50px;'>#</th>
                                <th style='text-align: center;'>Publication</th>
                                {{--<th style='text-align: center;'>Issue</th>--}}
                                <th style='text-align: center; width: 150px;'>Sales</th>
                                <th style='text-align: center; width: 150px;'>Client</th>
                                <th style='text-align: center; width: 100px;'>Line Items</th>
                                <th style='text-align: center; width: 100px;'>Qty</th>
                                <th style='text-align: right; width: 100px;'>Amount</th>
                                <th style='text-align: center; width: 130px;'>Date Created</th>
                                <th style='text-align: center; width: 80px;'>Status</th>
                                <th style='text-align: center; width: 50px;'>Action</th>
                            </tr>
                        </thead>
                            <tbody>
                                <?php
                                    $n = 1;
                                    $report_api = \App\Http\Controllers\AssemblyClass::get_reports_api();
                                ?>
                                @for($i = 0; $i < COUNT($booking); $i++)
                                    <tr>
                                        <td style='text-align: center;'>{{ $n++ }}</td>
                                        <td style='text-align: left;'>{{ $booking[$i]->mag_name }}</td>
                                        {{--<td style='text-align: left;'></td>--}}
                                        <td style='text-align: left;'>{{ $booking[$i]->sales_rep_name }}</td>
                                        <td style='text-align: left;'>{{ $booking[$i]->client_name }}</td>
                                        <td style='text-align: center;'>{{ $booking[$i]->line_item  }}</td>
                                        <td style='text-align: center;'>{{ $booking[$i]->qty }}</td>
                                        <?php
                                            $amount = $booking[$i]->new_amount != null ? (float)$booking[$i]->new_amount : (float)$booking[$i]->amount;
                                        ?>
                                        <td style='text-align: right;'>{{ number_format($amount, 2, '.', ',') }}</td>
                                        <td style='text-align: center;'>
                                        <?php
                                            $date_created = \Carbon\Carbon::parse($booking[$i]->created_at);
                                        ?>
                                        {{ $date_created->format('F d, Y') }}
                                        </td>
                                    @if($_COOKIE['role'] > 2)
                                        <td style='text-align: center;'>
                                            <form class="form-inline">
                                                <div class="form-group">
                                                    <span id="span_select_loading_{{ $booking[$i]->Id }}" style = "text-align: center; margin-top: 0px;"></span>
                                                    <select style = "padding: 5px;" class="form-control update_me" id="ddlStatus_{{ $booking[$i]->Id }}" >
                                                        <optgroup label="-- Status --"> -- Status -- </optgroup>
                                                        @if($booking[$i]->status == 6)
                                                            <option value="0">Approved/Invoiced</option>
                                                            <optgroup label="-- Action --"> -- Action -- </optgroup>
                                                            <option value = "-1:{{ $booking[$i]->trans_num }}">View Insertion Order</option>
                                                            @if($booking[$i]->invoice_num != null)
                                                                <option value = "-2:{{ $booking[$i]->trans_num }}:{{ $booking[$i]->invoice_num }}">View Invoice Order</option>
                                                            @endif
                                                            <option value = "-3:{{ $booking[$i]->trans_num }}">View As Client</option>
                                                            <option value = "-4:{{ $booking[$i]->Id }}:{{ $booking[$i]->agency_id }}:{{ $booking[$i]->trans_num }}:INSERTION%20ORDER">Send PDF to Bill-To </option>
                                                            </optgroup>
                                                        @elseif($booking[$i]->status == 5)
                                                            <option value="0">Void</option>
                                                            <optgroup label="-- Action --"> -- Action -- </optgroup>
                                                                <option value = "-1:{{ $booking[$i]->trans_num }}">View Insertion Order</option>
                                                                @if($booking[$i]->invoice_num != null)
                                                                    <option value = "-2:{{ $booking[$i]->trans_num }}:{{ $booking[$i]->invoice_num }}">View Invoice Order</option>
                                                                @endif
                                                                <option value = "-3:{{ $booking[$i]->trans_num }}">View As Client</option>
                                                                <option value = "-4:{{ $booking[$i]->Id }}:{{ $booking[$i]->agency_id }}:{{ $booking[$i]->trans_num }}:INSERTION%20ORDER">Send PDF to Bill-To </option>
                                                            </optgroup>
                                                        @elseif($booking[$i]->status == 3)
                                                            <option value="0">Approved</option>
                                                                <optgroup label="-- Action --"> -- Action -- </optgroup>
                                                                <option value = "-1:{{ $booking[$i]->trans_num }}">View Insertion Order</option>
                                                                @if($booking[$i]->invoice_num != null)
                                                                    <option value = "-2:{{ $booking[$i]->trans_num }}:{{ $booking[$i]->invoice_num }}">View Invoice Order</option>
                                                                @endif
                                                                <option value = "-3:{{ $booking[$i]->trans_num }}">View As Client</option>
                                                                <option value = "-4:{{ $booking[$i]->Id }}:{{ $booking[$i]->agency_id }}:{{ $booking[$i]->trans_num }}:INSERTION%20ORDER">Send PDF to Bill-To </option>
                                                            </optgroup>
                                                        @elseif($booking[$i]->status == 2)
                                                            <option {{ $booking[$i]->status == 2 ? "selected=true" : "" }} value = "2:{{ $booking[$i]->status == 2 ? 1 : 0 }}">For Approval</option>
                                                            <optgroup label="-- Action --"> -- Action -- </optgroup>
                                                                <option value = "-1:{{ $booking[$i]->trans_num }}">View Insertion Order</option>
                                                                @if($booking[$i]->invoice_num != null)
                                                                    <option value = "-2:{{ $booking[$i]->trans_num }}:{{ $booking[$i]->invoice_num }}">View Invoice Order</option>
                                                                @endif
                                                                <option value = "-3:{{ $booking[$i]->trans_num }}">View As Client</option>
                                                                <option value = "-4:{{ $booking[$i]->Id }}:{{ $booking[$i]->agency_id }}:{{ $booking[$i]->trans_num }}:INSERTION%20ORDER">Send PDF to Bill-To </option>
                                                            </optgroup>
                                                        @else
                                                            <option {{ $booking[$i]->status == 1 ? "selected=true" : "" }} value = "1:{{ $booking[$i]->status == 1 ? 1 : 0 }}">Pending</option>
                                                            <option {{ $booking[$i]->status == 2 ? "selected=true" : "" }} value = "2:{{ $booking[$i]->status == 2 ? 1 : 0 }}">For Approval</option>
                                                            <optgroup label="-- Action --"> -- Action -- </optgroup>
                                                                <option value = "-1:{{ $booking[$i]->trans_num }}">View Insertion Order</option>
                                                                @if($booking[$i]->invoice_num != null)
                                                                    <option value = "-2:{{ $booking[$i]->trans_num }}:{{ $booking[$i]->invoice_num }}">View Invoice Order</option>
                                                                @endif
                                                                <option value = "-3:{{ $booking[$i]->trans_num }}">View As Client</option>
                                                                <option value = "-4:{{ $booking[$i]->Id }}:{{ $booking[$i]->agency_id }}:{{ $booking[$i]->trans_num }}:INSERTION%20ORDER">Send PDF to Bill-To </option>
                                                            </optgroup>
                                                        @endif
                                                    </select>
                                                    @if($booking[$i]->status == 1)
                                                        <button class="btn btn-primary" id="btn_update_{{ $booking[$i]->Id }}" style = "width: 80px;margin-bottom: 0px; display: none;" onclick="update_status('{{ $booking[$i]->Id  }}','{{ $booking[$i]->trans_num  }}')" style="margin-bottom: 0;">Update</button>
                                                    @endif
                                                   </div>
                                            </form>
                                        </td>
                                    @else
                                        <td style='text-align: center;'>

                                            <div class="form-inline">
                                                <div class="form-group">
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuDivider">
                                                  ...
                                                  <li role="separator" class="divider"></li>
                                                  ...
                                                </ul>
                                                    <span id="span_select_loading_{{ $booking[$i]->Id }}" style = "text-align: center; margin-top: 0px;"></span>
                                                    @if($booking[$i]->status == 6)
                                                        <select style = "padding: 5px;" class="form-control update_me" id="ddlStatus_{{ $booking[$i]->Id }}">
                                                            <option value="0">Approved/Invoiced</option>
                                                            <optgroup label="-- Action --"> -- Action -- </optgroup>
                                                            <option value = "-1:{{ $booking[$i]->trans_num }}">View Insertion Order</option>
                                                            @if($booking[$i]->invoice_num != null)
                                                                <option value = "-2:{{ $booking[$i]->trans_num }}:{{ $booking[$i]->invoice_num }}">View Invoice Order</option>
                                                            @endif
                                                            <option value = "-3:{{ $booking[$i]->trans_num }}">View As Client</option>
                                                            <option value = "-4:{{ $booking[$i]->Id }}:{{ $booking[$i]->agency_id }}:{{ $booking[$i]->trans_num }}:INSERTION%20ORDER">Send PDF to Bill-To </option>
                                                            </optgroup>
                                                        </select>
                                                    @else
                                                        <select style = "padding: 5px;" class="form-control update_me" id="ddlStatus_{{ $booking[$i]->Id }}">
                                                            <optgroup label="-- Status --"> -- Status -- </optgroup>
                                                                <option {{ $booking[$i]->status == 1 ? "selected=true" : "" }} value = "1:{{ $booking[$i]->status == 1 ? 1 : 0 }}">Pending</option>
                                                                <option {{ $booking[$i]->status == 2 ? "selected=true" : "" }} value = "2:{{ $booking[$i]->status == 2 ? 1 : 0 }}">For Approval</option>
                                                                <option {{ $booking[$i]->status == 3 ? "selected=true" : "" }} value = "3:{{ $booking[$i]->status == 3 ? 1 : 0 }}">Approved</option>
                                                                <option {{ $booking[$i]->status == 5 ? "selected=true" : "" }} value = "5:{{ $booking[$i]->status == 5 ? 1 : 0 }}">Void</option>
                                                            <optgroup label="-- Action --"> -- Action -- </optgroup>
                                                                <option value = "-1:{{ $booking[$i]->trans_num }}">View Insertion Order</option>
                                                                @if($booking[$i]->invoice_num != null)
                                                                    <option value = "-2:{{ $booking[$i]->trans_num }}:{{ $booking[$i]->invoice_num }}">View Invoice Order</option>
                                                                @endif
                                                                <option value = "-3:{{ $booking[$i]->trans_num }}">View As Client</option>
                                                                <option value = "-4:{{ $booking[$i]->Id }}:{{ $booking[$i]->agency_id }}:{{ $booking[$i]->trans_num }}:INSERTION%20ORDER">Send PDF to Bill-To </option>
                                                            </optgroup>
                                                        </select>
                                                    @endif
                                                    <button class="btn btn-primary" id="btn_update_{{ $booking[$i]->Id }}" style = "width: 80px;margin-bottom: 0px; display: none;" onclick="update_status('{{ $booking[$i]->Id  }}','{{ $booking[$i]->trans_num  }}')" style="margin-bottom: 0;">Update</button>
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                        <td style='text-align: center;'>
                                            <a id="btn_view_{{ $booking[$i]->Id }}" href="{{ URL('/booking/magazine-transaction' . '/' . $booking[$i]->Id . '/' . $booking[$i]->mag_country . '/' . $booking[$i]->client_id ) }}" class="btn btn-primary" style="padding: 5px 7px 5px 7px; "><i class="fa fa-list-alt"></i>&nbsp;&nbsp;View</a>
                                        </td>
                                    </tr>
                                    @endfor

                                    @if(COUNT($booking) == 0)
                                        <tr><td colspan = "10" style = "text-align: center;"><h3>No Records Found</h3></td></tr>
                                    @endif
                            </tbody>
                    </table>
                    <div id="btn_lists" style="border: 1px solid; height: 25px; margin-top: -10px; display: none;">
                        <span style="text-align: right; position: absolute; right: 220px; color: #983014; margin-top: 6px;">Click SAVE to continue Or Click CANCEL to discard.</span>
                        <button class="btn btn-primary" id="btn_save_clicked" style = "text-align: right; margin-bottom: 0px; right: 130px; position: absolute;" ><i class="fa fa-save"></i>&nbsp;&nbsp;Save</button>
                        <button class="btn btn-primary" id="btn_cancel_clicked" style = "text-align: right; margin-bottom: 0px; right: 35px; position: absolute; background: #a1a1a1; border: 1px solid #a1a1a1;" ><i class="fa fa-close"></i>&nbsp;&nbsp;Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection

@section('scripts')
    <script src="{{ asset('/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.colVis.js"></script>
<script>

    function open_preview(trans_number) {
//        var url = "http://"+ report_url_api +"/kpa/work/transaction/generate/insertion-order-contract/" + trans_number + "/preview";
        var url = "http://"+ report_url_api +"/kpa/work/generate/insertion-order/" + trans_number;

        window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/insertion-order-contract/" + trans_number + "/preview",
                "mywindow","location=1,status=1,scrollbars=1,width=755,height=760");
    }

    $(document).ready( function() {

        $(".dataTables-booking").DataTable().destroy();
        $('.dataTables-booking').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'colvis'
            ]
        });

        $("#btn_filter_display").on('click', function(){

            var filter_publication = $("#filter_publication").val();

            var filter_sales_rep = 0;
            if($.cookie('role') != 3)
            {
                filter_sales_rep = $("#filter_sales_rep").val();
            }
//            var filter_issue = $("#filter_issue").val();
            var filter_client = $("#filter_client").val();
            var filter_status = $("#filter_status").val();
            window.location.href = "/booking/booking-list-filter/" + filter_publication + "/" + filter_sales_rep + "/" + filter_client + "/" + filter_status;
        });

//        $("#tbl_booking_lists > tbody  > tr").change(function(){
        $("#tbl_booking_lists").on('change', '.update_me', function(){

//            var selected =  $(this).find('select:first');
//            var value =  $(this).val();

            var selected = $(this);
            var value =  $(this).val();

            var values = value.split(":");

            if(values.length > 1) {
                var str_to_int = parseInt(values[0]);
                var trans_num = values[1];

                if(str_to_int == -1) {
                    $("#btn_lists").hide();
                    window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/insertion-order-contract/" + trans_num + "/preview",
                            "mywindow","location=1,status=1,scrollbars=1,width=855,height=800");
                }
                else if(str_to_int == -2) {
                    if(values.length > 2) {

                        var invoice_num = values[2];
                        $("#btn_lists").hide();
                        window.open("http://"+ report_url_api +"/kpa/work/transaction/invoice-order/"+invoice_num,
                                "mywindow","location=1,status=1,scrollbars=1,width=795,height=760");

                    }

//                    $(document).ready( function() {
//                        $.ajax({
//                            url: "/payment/invoice_create_api/"+ trans_num,
//                            dataType: "text",
//                            beforeSend: function () {
//                            },
//                            success: function(data) {
//                                var json = $.parseJSON(data);
//                                if(json.result == 200)
//                                {
//                                    alert("Invoice successfully save.");
//                                    location.reload();
//                                }else{
//                                    alert("Invoice already exists!");
//                                    location.reload();
//                                }
//                            }
//                        });
//                    } );
                }
                else if(str_to_int == -3) {
                    console.log(str_to_int);
                    $("#btn_lists").hide();
                    window.open("http://"+ Url_Client_Dashboard + trans_num,'_blank');
                }
                else if(str_to_int == -4) {
                    console.log(values);
                    var btn_id = "#span_select_loading_" + values[1];
                    var bill_to = values[2];
                    var trans_num = values[3];
                    var subject = values[4];

                    $(document).ready( function() {
                        $.ajax({
                            url: "http://"+ report_url_api +"/kpa/work/send/email/"+bill_to+"/"+trans_num+"/"+ subject,
                            dataType: "text",
                            beforeSend: function () {
                                selected.hide();
                                $(btn_id).text("Please wait...");
                            },
                            success: function(data) {
                                var json = $.parseJSON(data);
                                if(json.code == 200)
                                {
                                    alert("Insertion Order has been sent.");
                                    location.reload();
                                }else{
                                    alert("Oops, Server Error");
                                    location.reload();
                                }
                            }
                        });
                    } );
                }
                else {

                    var selected_id = selected.attr("id");
                    var split_selected_id = selected_id.split("_");
                    console.log(str_to_int);
                    console.log("this is trans num: " + trans_num);
                    console.log(split_selected_id);

//                    1 = Pending
//                    2 = For Approval
//                    3 = Approved
//                    5 = Void

                    var status_msg = "Are you sure do you want to update as <b>PENDING</b>?";

                    if(str_to_int == 2){
                        status_msg = "Requesting <b>FOR APPROVAL</b>?";
                    }else if(str_to_int == 3){
                        status_msg = "Are you sure do you want to update as <b>APPROVED</b>?";;
                    }else if(str_to_int == 5){
                        status_msg = "Are you sure do you want to update to <b>VOID</b>?";
                    }

                    if(trans_num != 1) {
//                        $("#btn_update_"+split_selected_id[1]).show();
//                        $("#btn_lists").show();
//
//                        $("#btn_save_clicked").click(function() {
//
//
//                        });
//
//                        $("#btn_cancel_clicked").click(function() {
//                            location.reload();
//                        });
                        swal({
                            title: "",
                            text: status_msg,
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'Cancel'
                        }).then(function() {
                            $("#btn_update_"+split_selected_id[1]).click();
                        }, function(dismiss) {
                            if (dismiss === 'cancel') {

                                swal({
                                    title: "Cancelled",
                                    text: "",
                                    type: "error"
                                }).then(
                                        function() {
                                            location.reload();
                                        }
                                )
                            }
                        })
                    }
                    else {
//                        $("#btn_update_"+split_selected_id[1]).hide();
                        $("#btn_lists").hide();
                    }
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
//                            alert("Update was successful");
//                            location.reload();
                            swal({
                                title: "",
                                text: "Update was successful",
                                type: "success"
                            }).then(
                                    function() {
                                        location.reload();
                                    }
                            )
                        }
                    }
                });
            } );
        }
    }
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





























































































