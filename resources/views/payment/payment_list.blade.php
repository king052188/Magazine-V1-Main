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


                <div id="filter-panel" class="filter-panel collapse">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-sm-12">

                                <form class="form-inline" role="form">
                                    <div class="">
                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Find by Invoice Number:</label><br/>
                                            <input type="text" class="form-control" id="" placeholder="Input Invoice Number">
                                        </div>
                                        <div class="form-group">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">&nbsp;</label><br/>
                                            <button type="submit" class="btn btn-primary filter-col " style="margin-bottom: 0px;">
                                                <i class="fa fa-searh"></i> Search
                                            </button> 
                                        </div>

                                    </div><br/>

                                    <div>
                                        <div class="form-group" id="data_1">
                                        <label class="filter-col" style="margin-right:0;" for="pref-perpage">Date of Payment:</label><br/>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="03/04/2014">
                                            </div>
                                        </div>
                                    </div><br/>


                                    <div class="">
                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-perpage">Payment Method:</label><br/>
                                            <select id="pref-perpage" class="form-control">
                                                <option value="1">Cash</option>
                                                <option value="2">Credit Card</option>
                                                <option value="3">Checked</option>
                                                <option value="4">Paypal</option>
                                            </select>                                
                                        </div> 
                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Reference Number:</label><br/>
                                            <input type="text" class="form-control" id="pref-search">
                                        </div> 
                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Which Line Item:</label><br/>
                                            <input type="text" class="form-control" id="pref-search">
                                        </div>

                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Amount to be paid:</label><br/>
                                            <input class="form-control" type='number' step='0.01' value='0.00' placeholder='0.00' />
                                        </div>
                                        <div class="form-group pull-right">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">&nbsp;</label><br/>
                                            <button type="submit" class="btn btn-primary filter-col " style="margin-bottom: 0px;">
                                                <span class="glyphicon glyphicon-record"></span> Save
                                            </button> 
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#filter-panel" style="margin-bottom: 10px;">
                    <span class="glyphicon glyphicon-cog"></span> Filter/Search
                </button>

                     <div class="table-responsive">
                        <table id="tbl_booking_lists" class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th style='text-align: center;'>#</th>
                                    <th style='text-align: left;'>Proposal ID</th>
                                    <th style='text-align: left;'>Pub.</th>
                                    <th style='text-align: left;'>Issue</th>
                                    <th style='text-align: left;'>Year</th>
                                    <th style='text-align: left;'>Ad Size</th>
                                    <th style='text-align: left;'>Colour</th>
                                    <th style='text-align: center;'>Net</th>
                                    <th style='text-align: center;'>GST/HST</th>
                                    <th style='text-align: center;'>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style='text-align: center;'>1</td>
                                    <td style='text-align: left;'>Sample</td>
                                    <td style='text-align: center;'>Sample</td>
                                    <td style='text-align: center;'>Sample</td>
                                    <td style='text-align: left;'>Sample</td>
                                    <td style='text-align: left;'>Sample</td>
                                    <td style='text-align: left;'>Sample</td>
                                    <td style='text-align: center;'>Sample</td>
                                    <td style='text-align: left;'>Sample</td>
                                    <td style='text-align: left;'>Sample</td>
                                </tr>
                                <tr>
                                    <td style='text-align: center;'>2</td>
                                    <td style='text-align: left;'>Sample</td>
                                    <td style='text-align: center;'>Sample</td>
                                    <td style='text-align: center;'>Sample</td>
                                    <td style='text-align: left;'>Sample</td>
                                    <td style='text-align: left;'>Sample</td>
                                    <td style='text-align: left;'>Sample</td>
                                    <td style='text-align: center;'>Sample</td>
                                    <td style='text-align: left;'>Sample</td>
                                    <td style='text-align: left;'>Sample</td>
                                </tr>
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