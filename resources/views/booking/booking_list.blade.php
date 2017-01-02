@extends('layout.magazine_main')

@section('title')
    Magazines List
@endsection

@section('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
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
                <h5>Booking List</h5>
                <div class = "pull-right">
                    <select class="form-control" id = "filter" style = "margin-top: -7px;">
                        <option disabled>--select--</option>
                        <option value = "" {{ $filter == "" ? "selected" : "" }}>All</option>
                        <option value = "1" {{ $filter == 1 ? "selected" : "" }}>Pending</option>
                        <option value = "2" {{ $filter == 2 ? "selected" : "" }}>For Approval</option>
                        <option value = "3" {{ $filter == 3 ? "selected" : "" }}>Approved</option>
                        <option value = "5" {{ $filter == 5 ? "selected" : "" }}>Void</option>
                    </select>
                </div>
                <div style = "float: right; margin-right: 5px; font-size: 15px;"><label>Sort by:</label></div>
            </div>

            <div class="ibox-content">

                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    {{ Session::get('success') }}
                </div>
                @endif

                <div class="table-responsive">
                    <table id="tbl_booking_lists" class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                <th style='text-align: center; width: 30px;'>#</th>
                                <th style='text-align: left;'>Magazine</th>
                                <th style='text-align: left; width: 50px;'># Issue</th>
                                <th style='text-align: left; width: 50px;'>Year Issue</th>
                                <th style='text-align: left; width: 150px;'>Sales</th>
                                <th style='text-align: left; width: 150px;'>Client</th>
                                <th style='text-align: left; width: 150px;'>Agency</th>
                                <th style='text-align: center; width: 50px;'>Line</th>
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
                                        <td style='text-align: left;'>{{ $booking[$i]->magazine_name }}</td>
                                        <td style='text-align: center;'>{{ $booking[$i]->magazine_issues }}</td>
                                        <td style='text-align: center;'>{{ $booking[$i]->magazine_year }}</td>
                                        <td style='text-align: left;'>{{ $booking[$i]->sales_rep_name }}</td>
                                        <td style='text-align: left;'>{{ $booking[$i]->client_name }}</td>
                                        <td style='text-align: left;'>{{ $booking[$i]->agency_name == null ? "NONE" : $booking[$i]->agency_name  }}</td>
                                        <td style='text-align: center;'>{{ $booking[$i]->number_of_issue }}</td>
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
                                                                <option value = "-2:{{ $booking[$i]->trans_num }}">View Invoice Order</option>
                                                                <option value = "-3:{{ $booking[$i]->trans_num }}">View As Client</option>
                                                            </optgroup>
                                                        @elseif($booking[$i]->status == 3)
                                                            <option value="0">Approved</option>
                                                                <optgroup label="-- Action --"> -- Action -- </optgroup>
                                                                <option value = "-1:{{ $booking[$i]->trans_num }}">View Insertion Order</option>
                                                                <option value = "-2:{{ $booking[$i]->trans_num }}">View Invoice Order</option>
                                                                <option value = "-3:{{ $booking[$i]->trans_num }}">View As Client</option>
                                                            </optgroup>
                                                        @elseif($booking[$i]->status == 2)
                                                            <option {{ $booking[$i]->status == 2 ? "selected=true" : "" }} value = "2:{{ $booking[$i]->status == 2 ? 1 : 0 }}">For Approval</option>
                                                            <optgroup label="-- Action --"> -- Action -- </optgroup>
                                                                <option value = "-1:{{ $booking[$i]->trans_num }}">View Insertion Order</option>
                                                                <option value = "-2:{{ $booking[$i]->trans_num }}">View Invoice Order</option>
                                                                <option value = "-3:{{ $booking[$i]->trans_num }}">View As Client</option>
                                                            </optgroup>
                                                        @else
                                                            <option {{ $booking[$i]->status == 1 ? "selected=true" : "" }} value = "1:{{ $booking[$i]->status == 1 ? 1 : 0 }}">Pending</option>
                                                            <option {{ $booking[$i]->status == 2 ? "selected=true" : "" }} value = "2:{{ $booking[$i]->status == 2 ? 1 : 0 }}">For Approval</option>
                                                            <optgroup label="-- Action --"> -- Action -- </optgroup>
                                                                <option value = "-1:{{ $booking[$i]->trans_num }}">View Insertion Order</option>
                                                                <option value = "-2:{{ $booking[$i]->trans_num }}">View Invoice Order</option>
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
                                                            <option value = "-1:{{ $booking[$i]->trans_num  }}">View Insertion Order</option>
                                                            <option value = "-2:{{ $booking[$i]->trans_num  }}">View Invoice Order</option>
                                                            <option value = "-3:{{ $booking[$i]->trans_num  }}">View As Client</option>
                                                        </optgroup>
                                                    </select>
                                                    <button class="btn btn-primary" id="btn_update_{{ $booking[$i]->Id }}" style = "width: 80px;margin-bottom: 0px; display: none;" onclick="update_status('{{ $booking[$i]->Id  }}','{{ $booking[$i]->trans_num  }}')" style="margin-bottom: 0;">Update</button>
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                        <td style='text-align: center;'>
                                            <a href="{{ URL('/booking/magazine-transaction' . '/' . $booking[$i]->Id . '/' . $booking[$i]->magazine_country_id . '/' . $booking[$i]->client_id ) }}" class="btn btn-primary" style="padding: 5px 7px 5px 7px; "><i class="fa fa-list-alt"></i>&nbsp;&nbsp;View</a>
                                        </td>
                                    </tr>
                                    @endfor

                            </tbody>
                    </table>
                    <div id="btn_lists" style="height: 25px; margin-top: -10px; display: none;">
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

<script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: []
        });
    });

    function open_preview(trans_number)
    {
        window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/insertion-order-contract/" + trans_number + "/preview",
                "mywindow","location=1,status=1,scrollbars=1,width=755,height=760");
    }

    $(document).ready( function() {
        $("#filter").on('change', function(){
            window.location.href = "/booking/booking-list/" + $(this).val();
        });
        $("#tbl_booking_lists > tbody  > tr").change(function(){
            var selected =  $(this).find('select:first');
            var value =  selected.val();
            var values = value.split(":");

            if(values.length > 1) {
                var str_to_int = parseInt(values[0]);
                var trans_num = values[1];
                if(str_to_int == -1) {
                    $("#btn_lists").hide();
                    window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/insertion-order-contract/" + trans_num + "/preview",
                            "mywindow","location=1,status=1,scrollbars=1,width=755,height=760");
                }
                else if(str_to_int == -2) {

                    $("#btn_lists").hide();
                    window.open("http://"+ report_url_api +"/kpa/work/transaction/invoice-order/1234567",
                            "mywindow","location=1,status=1,scrollbars=1,width=795,height=760");

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
                    $("#btn_lists").hide();
                    window.open("http://"+ Url_Client_Dashboard + trans_num,'_blank');
                }
                else {

                    var selected_id = selected.attr("id");
                    var split_selected_id = selected_id.split("_");
                    console.log(trans_num);
                    console.log(split_selected_id);
                    if(trans_num != 1) {
//                        $("#btn_update_"+split_selected_id[1]).show();
                        $("#btn_lists").show();

                        $("#btn_save_clicked").click(function() {
                            $("#btn_update_"+split_selected_id[1]).click();
                        });

                        $("#btn_cancel_clicked").click(function() {
                            location.reload();
                        });
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





























































































