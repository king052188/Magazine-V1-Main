@extends('layout.magazine_main')

@section('title')
    Magazines List
@endsection

@section('styles')
{{--<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">--}}
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
            <div class="ibox-title">
                <h5>Filter</h5>
                <div class = "pull-left" style = "margin-left: 10px;">
                    <select class="form-control filter_click" id = "filter_publication" style = "background-color: #2f4050; color: #FFFFFF; margin-top: -7px;">
                        <option value = "0" {{ $filter_publication == "0" ? "selected" : "" }}>Publication</option>
                        @for($i = 0; $i < COUNT($publication); $i++)
                        <option value = "{{ $publication[$i]->Id }}" {{ $filter_publication == $publication[$i]->Id ? "selected" : "" }}>{{ $publication[$i]->magazine_name }}</option>
                        @endfor
                    </select>
                </div>
                <div class = "pull-left" style = "margin-left: 10px;">
                    <select class="form-control filter_click" id = "filter_sales_rep" style = "background-color: #2f4050; color: #FFFFFF; margin-top: -7px;">
                        <option value = "0" {{ $filter_sales_rep == "0" ? "selected" : "" }}>Sales Rep</option>
                        @for($i = 0; $i < COUNT($sales_rep); $i++)
                            <option value = "{{ $sales_rep[$i]->Id }}" {{ $filter_sales_rep == $sales_rep[$i]->Id ? "selected" : "" }}>{{ $sales_rep[$i]->first_name . " " . $sales_rep[$i]->last_name }}</option>
                        @endfor
                    </select>
                </div>
                {{--<div class = "pull-left" style = "margin-left: 10px;">--}}
                    {{--<select class="form-control filter_click" id = "filter_issue" style = "background-color: #2f4050; color: #FFFFFF; margin-top: -7px;">--}}
                        {{--<option value = "">Issue</option>--}}
                        {{--@for($i = 1; $i <= 12; $i++)--}}
                            {{--<option value = "{{ $i }}">{{ "IS" . $i }}</option>--}}
                        {{--@endfor--}}
                    {{--</select>--}}
                {{--</div>--}}
                <div class = "pull-left" style = "margin-left: 10px;">
                    <select class="form-control filter_click" id = "filter_client" style = "background-color: #2f4050; color: #FFFFFF; margin-top: -7px;">
                        <option value = "0" {{ $filter_client == "0" ? "selected" : "" }}>Client</option>
                        @for($i = 0; $i < COUNT($clients); $i++)
                            <option value = "{{ $clients[$i]->Id }}" {{ $filter_client == $clients[$i]->Id ? "selected" : "" }}>{{ $clients[$i]->company_name }}</option>
                        @endfor
                    </select>
                </div>
                <div class = "pull-left" style = "margin-left: 10px;">
                    <select class="form-control filter_click" id = "filter_status" style = "background-color: #2f4050; color: #FFFFFF; margin-top: -7px;">
                        <option value = "0" {{ $filter_status == 0 ? "selected" : "" }}>Status</option>
                        <option value = "1" {{ $filter_status == 1 ? "selected" : "" }}>Pending</option>
                        <option value = "2" {{ $filter_status == 2 ? "selected" : "" }}>For Approval</option>
                        <option value = "3" {{ $filter_status == 3 ? "selected" : "" }}>Approved</option>
                        <option value = "5" {{ $filter_status == 5 ? "selected" : "" }}>Void</option>
                    </select>
                </div>
                <div class = "pull-left" style = "margin-left: 10px;">
                    <button class="btn btn-info" id = "btn_filter_display" style = "margin-top: -7px;">Display</button>
                </div>

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
                {{--<div style = "float: right; margin-right: 5px; font-size: 15px;"><label>Sort by:</label></div>--}}
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
                    <table id="tbl_booking_lists" class="footable table" data-sorting="true" data-page-size="10">
                        <thead>
                            <tr>
                                <th style='text-align: center; width: 30px;'>#</th>
                                <th style='text-align: center;'>Publication</th>
                                {{--<th style='text-align: center;'>Issue</th>--}}
                                <th style='text-align: center; width: 150px;'>Sales</th>
                                <th style='text-align: center; width: 150px;'>Client</th>
                                <th style='text-align: center; width: 50px;'>Line Items</th>
                                <th style='text-align: center; width: 50px;'>Qty</th>
                                <th style='text-align: right; width: 80px;'>Amount</th>
                                <th style='text-align: center; width: 120px;'>Date Created</th>
                                <th style='text-align: center; width: 80px;'>Status/Action</th>
                                <th style='text-align: center; width: 50px;'>-</th>
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
                                                    <select style = "padding: 5px;" class="form-control" id="ddlStatus_{{ $booking[$i]->Id }}" >
                                                        <optgroup label="-- Status --"> -- Status -- </optgroup>
                                                        @if($booking[$i]->status == 5)
                                                            <option value="0">Void</option>
                                                            <optgroup label="-- Action --"> -- Action -- </optgroup>
                                                                <option value = "-1:{{ $booking[$i]->trans_num }}">View Insertion Order</option>
                                                                @if($booking[$i]->invoice_num != null)
                                                                    <option value = "-2:{{ $booking[$i]->trans_num }}:{{ $booking[$i]->invoice_num }}">View Invoice Order</option>
                                                                @endif
                                                                <option value = "-3:{{ $booking[$i]->trans_num }}">View As Client</option>
                                                            </optgroup>
                                                        @elseif($booking[$i]->status == 3)
                                                            <option value="0">Approved</option>
                                                                <optgroup label="-- Action --"> -- Action -- </optgroup>
                                                                <option value = "-1:{{ $booking[$i]->trans_num }}">View Insertion Order</option>
                                                                @if($booking[$i]->invoice_num != null)
                                                                    <option value = "-2:{{ $booking[$i]->trans_num }}:{{ $booking[$i]->invoice_num }}">View Invoice Order</option>
                                                                @endif
                                                                <option value = "-3:{{ $booking[$i]->trans_num }}">View As Client</option>
                                                            </optgroup>
                                                        @elseif($booking[$i]->status == 2)
                                                            <option {{ $booking[$i]->status == 2 ? "selected=true" : "" }} value = "2:{{ $booking[$i]->status == 2 ? 1 : 0 }}">For Approval</option>
                                                            <optgroup label="-- Action --"> -- Action -- </optgroup>
                                                                <option value = "-1:{{ $booking[$i]->trans_num }}">View Insertion Order</option>
                                                                @if($booking[$i]->invoice_num != null)
                                                                    <option value = "-2:{{ $booking[$i]->trans_num }}:{{ $booking[$i]->invoice_num }}">View Invoice Order</option>
                                                                @endif
                                                                <option value = "-3:{{ $booking[$i]->trans_num }}">View As Client</option>
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
                                                    <select style = "padding: 5px;" class="form-control" id="ddlStatus_{{ $booking[$i]->Id }}">
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
                                                        </optgroup>
                                                    </select>
                                                    <button class="btn btn-primary" id="btn_update_{{ $booking[$i]->Id }}" style = "width: 80px;margin-bottom: 0px; display: none;" onclick="update_status('{{ $booking[$i]->Id  }}','{{ $booking[$i]->trans_num  }}')" style="margin-bottom: 0;">Update</button>
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                        <td style='text-align: center;'>
                                            <a href="{{ URL('/booking/magazine-transaction' . '/' . $booking[$i]->Id . '/' . $booking[$i]->mag_country . '/' . $booking[$i]->client_id ) }}" class="btn btn-primary" style="padding: 5px 7px 5px 7px; "><i class="fa fa-list-alt"></i>&nbsp;&nbsp;View</a>
                                        </td>
                                    </tr>
                                    @endfor
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <ul class="pagination pull-right"></ul>
                                    </td>
                                </tr>
                            </tfoot>
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

<script>

    function open_preview(trans_number) {
//        var url = "http://"+ report_url_api +"/kpa/work/transaction/generate/insertion-order-contract/" + trans_number + "/preview";
        var url = "http://"+ report_url_api +"/kpa/work/generate/insertion-order/" + trans_number;

        window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/insertion-order-contract/" + trans_number + "/preview",
                "mywindow","location=1,status=1,scrollbars=1,width=755,height=760");
    }

    $(document).ready( function() {

        $("#btn_filter_display").on('click', function(){
            var filter_publication = $("#filter_publication").val();
            var filter_sales_rep = $("#filter_sales_rep").val();
//            var filter_issue = $("#filter_issue").val();
            var filter_client = $("#filter_client").val();
            var filter_status = $("#filter_status").val();

//            console.log("filter_publication " + filter_publication);
//            console.log("filter_sales_rep " + filter_sales_rep);
//            console.log("filter_client " + filter_client);
//            console.log("filter_status " + filter_status);

            window.location.href = "/booking/booking-list-filter/" + filter_publication + "/" + filter_sales_rep + "/" + filter_client + "/" + filter_status;
        });

        $("#tbl_booking_lists > tbody  > tr").change(function(){
//        $("#tbl_booking_lists > tbody  > tr").on('change', '#ddlStatus_190', function(){
            var selected =  $(this).find('select:first');
            var value =  selected.val();

            console.log("this is it: " + selected);
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
@endsection





























































































