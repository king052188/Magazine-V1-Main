@extends('layout.magazine_main')

@section('title')
    Reports
@endsection

@section('styles')
    <link href="{{  asset('css/plugins/chosen/chosen.css')  }}" rel="stylesheet">
    {{--<link href="{{  asset('css/plugins/dataTables/datatables.min.css')  }}" rel="stylesheet">--}}
    {{--<link href="{{  asset('css/theme.default.css')  }}" rel="stylesheet">--}}
    {{--<link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet">--}}
@endsection

@section('magazine_content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Reports</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Generate your reports</strong>
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
                    <div class="ibox-title" style = "padding-top: 5px;">
                        <h5><button class = "btn btn-primary" data-toggle="modal" data-target="#filter_modal">Filter</button></h5>
                        <h5 style="margin-left: 10px;"><button class = "btn btn-warning" id="btnExportToCSV">Export To CSV</button></h5>
                    </div>

                    <div class="ibox-content">
                        <div class="table-responsive">

                            <div style="width: 100%; height: 45px;">
                                <div style="float: left; text-align: left;">
                                    <h3 id="total_items" style="margin: 0; padding: 0;">0</h3> <b style="color: #A1A1A1;">Total Items</b>
                                </div>

                                <div style="float: right; text-align: right; padding-left: 10px;">
                                    <h3 id="over_all_commission" style="margin: 0; padding: 0;">0</h3> <b style="color: #A1A1A1;">Over All Commission</b>
                                </div>

                                <div style="float: right; text-align: right; padding-right: 10px; border-right: 1px solid #E7E7E7;">
                                    <h3 id="over_all_total" style="margin: 0; padding: 0;">0</h3> <b style="color: #A1A1A1;">Over All Total</b>
                                </div>
                            </div>

                            <table id="tbl_booking_lists" class="table display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style='text-align: left; width: 30px;'>#</th>
                                        <th style='text-align: left; width: 100px;'>Trans#</th>
                                        <th style='text-align: left; width: 180px;'>Publication</th>
                                        <th style='text-align: left;'>Client</th>
                                        <th style='text-align: left; width: 180px;'>Sales Rep</th>
                                        <th style='text-align: left; width: 80px;'>Issue</th>
                                        <th style='text-align: left; width: 80px;'>Year</th>
                                        <th style='text-align: right; width: 100px;'>Amount</th>
                                        <th style='text-align: right; width: 120px;'>Commission</th>
                                        <th style='text-align: left; width: 180px;'>Created</th>
                                        <th style='text-align: left; width: 100px;'>Type</th>
                                        <th style='text-align: left; width: 130px;'>View</th>
                                    </tr>
                                </thead>
                                <tbody> </tbody>
                            </table>

                            <table id="tbl_invoice_lists" class="table display nowrap" style = "display: none;" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th style='text-align: left; width: 10px;'>#</th>
                                    <th style='text-align: left; width: 100px;'>Invoice #</th>
                                    <th style='text-align: left;'>Publication</th>
                                    <th style='text-align: left; width: 100px;'>Year</th>
                                    <th style='text-align: left;'>Executive Account</th>
                                    <th style='text-align: left; width: 100px;'>Invoice Created</th>
                                    <th style='text-align: left; width: 100px;'>Due Date</th>
                                    <th style='text-align: left; width: 100px;'>View</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>

                        </div>
                        <div id = "booking_overall_total"></div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="filter_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelFilterModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="exampleModalLabel">Filter Reports</h4>
                </div>
                <div class="modal-body">

                    <table border = "0" style="width: 100%;">
                        <tr>
                            <td style="width: 270px;">Reports by</td>
                            <td>
                                <select class="form-control filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "reports_by">
                                    <option value = "1">Booking/Commission</option>
                                    <option value = "2">Invoice</option>
                                    {{--<option value = "3">Commission</option>--}}
                                    {{--<option value = "4">Tax</option>--}}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td>
                                <select class="form-control" style="background-color: #2f4050; color: #FFFFFF;" id = "magazine_type_booking">
                                    <option value = "1">Print</option>
                                    <option value = "2">Digital</option>
                                </select>
                            </td>
                        </tr>
                    </table>

                    <br /><br />

                    <table border = "0" style="width: 100%;" id = "table_booking">

                        <tr>
                            <td style="width: 270px;">Publication</td>
                            <td>
                                <select class="form-control chosen-select filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "filter_m_publication">
                                    <option value = "0">-- select --</option>
                                    @for($o = 0; $o < COUNT($publication); $o++)
                                        <option value = "{{ $publication[$o]->Id }}">{{ $publication[$o]->magazine_name }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Client/Company</td>
                            <td>
                                <select class="form-control chosen-select filter_click" id = "filter_m_client">
                                    <option value = "0">-- select --</option>
                                    @for($i = 0; $i < COUNT($clients); $i++)
                                        <option value = "{{ $clients[$i]->Id }}">{{ $clients[$i]->company_name }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>

                        <tr id="print_month">
                            <td>Issue</td>
                            <td>
                                <select class="form-control filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "filter_m_issue">
                                    <option value="0">-- select --</option>
                                    @for($i = 1; $i < 13; $i++)
                                        <option value='{{ $i }}'>{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>

                        {{--// digital --}}

                        <tr id="digital_month" style="display: none;">
                            <td>Month</td>
                            <td>
                                <select class="form-control filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "filter_m_month_issue">
                                    <option value="0">-- select --</option>
                                    <?php $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];?>
                                    @for($i = 0; $i < COUNT($months); $i++)
                                        <option value='{{ $i + 1 }}'>{{ $months[$i] }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>

                        <tr id="digital_week" style="display: none;">
                            <td>Week</td>
                            <td>
                                <select class="form-control filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "filter_m_week_issue">
                                    <option value="0">-- select --</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value='{{ $i }}'>Week {{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>

                        {{--// digital --}}

                        <tr>
                            <td>Year</td>
                            <td>
                                <select class="form-control filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "filter_m_year">
                                    <option value="0">-- select --</option>
                                    @for($i = date('Y') - 4; $i < date('Y'); $i++)
                                        <option value='{{ $i }}'>{{ $i }}</option>
                                    @endfor

                                    @for($i = date('Y'); $i < 2026; $i++)
                                        <option value='{{ $i }}'>{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Sales Rep</td>
                            <td>
                                <select class="form-control filter_click" id = "filter_m_sales_rep" style = "background-color: #2f4050; color: #FFFFFF;">
                                    <option value = "0">-- select --</option>
                                    @for($i = 0; $i < COUNT($sales_rep); $i++)
                                        <option value = "{{ $sales_rep[$i]->Id }}">{{ $sales_rep[$i]->first_name . " " . $sales_rep[$i]->last_name }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <select class="form-control filter_click" id = "filter_m_status" style = "background-color: #2f4050; height: 30px; color: #FFFFFF;">
                                    <option value = "0">-- select --</option>
                                    <option value = "1">Pending</option>
                                    <option value = "2">For Approval</option>
                                    <option value = "3">Approved</option>
                                    <option value = "5">Void</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan = "2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan = "2" style = "font-weight: bold; size: 15px;">Booking Date Created</td>
                        </tr>
                        <tr>
                            <td>Date Operator</td>
                            <td>
                                <select class="form-control filter_click" id = "filter_m_operator" style = "background-color: #2f4050; height: 30px; color: #FFFFFF;">
                                    <option value = "1">Equal</option>
                                    <option value = "2">Between</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label style = "font-weight: normal;" id = "lbl_from">Date</label></td>
                            <td>
                                <input size="16" type="date" id = "filter_m_date_from" value="" style = "background-color: #2f4050; height: 30px; color: #FFFFFF;">
                            </td>
                        </tr>
                        <tr style = "display: none;" id = "date_to_area">
                            <td><label style = "font-weight: normal;" id = "lbl_to"></label></td>
                            <td>
                                <input size="16" type="date" id = "filter_m_date_to" value="" style = "background-color: #2f4050; height: 30px; color: #FFFFFF;">
                            </td>
                        </tr>
                    </table>

                    <table border = "0" id = "table_invoice" style = "width: 100%; display: none;">
                        <tr>
                            <td style = "width: 270px;">Invoice #</td>
                            <td>
                                <input type = "text" style="background-color: #2f4050; height: 30px; color: #FFFFFF;" id = "filter_i_invoice_number">
                            </td>
                        </tr>
                        <tr>
                            <td>Publication</td>
                            <td>
                                <select class="form-control chosen-select filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "filter_i_publication">
                                    <option value = "0">-- select --</option>
                                    @for($i = 0; $i < COUNT($publication); $i++)
                                        <option value = "{{ $publication[$i]->Id }}">{{ $publication[$i]->magazine_name }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Client/Company</td>
                            <td>
                                <select class="form-control chosen-select filter_click" id = "filter_i_client">
                                    <option value = "0">-- select --</option>
                                    @for($i = 0; $i < COUNT($clients); $i++)
                                        <option value = "{{ $clients[$i]->Id }}">{{ $clients[$i]->company_name }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Issue</td>
                            <td>
                                <select class="form-control filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "filter_i_issue">
                                    <option value="0">Select</option>
                                    @for($i = 1; $i < 13; $i++)
                                        <option value='{{ $i }}'>{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Year</td>
                            <td>
                                <select class="form-control filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "filter_i_year">
                                    <option value="0">Select</option>
                                    @for($i = date('Y') - 4; $i < date('Y'); $i++)
                                        <option value='{{ $i }}'>{{ $i }}</option>
                                    @endfor

                                    @for($i = date('Y'); $i < 2026; $i++)
                                        <option value='{{ $i }}'>{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Executive Account</td>
                            <td>
                                <select class="form-control filter_click" id = "filter_i_sales_rep" style = "background-color: #2f4050; height:30px; color: #FFFFFF;">
                                    <option value = "0">-- select --</option>
                                    @for($i = 0; $i < COUNT($sales_rep); $i++)
                                        <option value = "{{ $sales_rep[$i]->Id }}">{{ $sales_rep[$i]->first_name . " " . $sales_rep[$i]->last_name }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan = "2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan = "2" style = "font-weight: bold; size: 15px;">Invoice Date Created</td>
                        </tr>
                        <tr>
                            <td>Date Operator</td>
                            <td>
                                <select class="form-control filter_click" id = "filter_i_operator" style = "background-color: #2f4050; height: 30px; color: #FFFFFF;">
                                    <option value = "1">Equal</option>
                                    <option value = "2">Between</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label style = "font-weight: normal;" id = "lbl_i_from">Date</label></td>
                            <td>
                                <input size="16" type="date" id = "filter_i_date_from" value="" style = "background-color: #2f4050; height: 30px; color: #FFFFFF;">
                            </td>
                        </tr>
                        <tr style = "display: none;" id = "date_i_to_area">
                            <td><label style = "font-weight: normal;" id = "lbl_i_to"></label></td>
                            <td>
                                <input size="16" type="date" id = "filter_i_date_to" value="" style = "background-color: #2f4050; height: 30px; color: #FFFFFF;">
                            </td>
                        </tr>
                    </table>

                    <table border = "0" style="width: 100%; display: none;" id = "table_commission" >
                        <tr>
                            <td>Sales Rep</td>
                            <td>
                                <select class="form-control filter_click" id = "filter_m_sales_rep" style = "background-color: #2f4050; color: #FFFFFF;">
                                    <option value = "0">-- select --</option>
                                    @for($i = 0; $i < COUNT($sales_rep); $i++)
                                        <option value = "{{ $sales_rep[$i]->Id }}">{{ $sales_rep[$i]->first_name . " " . $sales_rep[$i]->last_name }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 270px;">Publication</td>
                            <td>
                                <select class="form-control chosen-select filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "filter_comm_publication">
                                    <option value = "0">-- select --</option>
                                    @for($i = 0; $i < COUNT($publication); $i++)
                                        <option value = "{{ $publication[$i]->Id }}">{{ $publication[$i]->magazine_name }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Client/Company</td>
                            <td>
                                <select class="form-control chosen-select filter_click" id = "filter_comm_client">
                                    <option value = "0">-- select --</option>
                                    @for($i = 0; $i < COUNT($clients); $i++)
                                        <option value = "{{ $clients[$i]->Id }}">{{ $clients[$i]->company_name }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>

                        <tr id="print_month_comm">
                            <td>Issue</td>
                            <td>
                                <select class="form-control filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "filter_m_issue">
                                    <option value="0">-- select --</option>
                                    @for($i = 1; $i < 13; $i++)
                                        <option value='{{ $i }}'>{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>

                        {{--// digital --}}

                        <tr id="digital_month_comm" style="display: none;">
                            <td>Month</td>
                            <td>
                                <select class="form-control filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "filter_m_month_issue">
                                    <option value="0">-- select --</option>
                                    <?php $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];?>
                                    @for($i = 0; $i < COUNT($months); $i++)
                                        <option value='{{ $i + 1 }}'>{{ $months[$i] }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>

                        <tr id="digital_week_comm" style="display: none;">
                            <td>Week</td>
                            <td>
                                <select class="form-control filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "filter_m_week_issue">
                                    <option value="0">-- select --</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value='{{ $i }}'>Week {{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>

                        {{--// digital --}}

                        <tr>
                            <td>Year</td>
                            <td>
                                <select class="form-control filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "filter_m_year">
                                    <option value="0">-- select --</option>
                                    @for($i = date('Y') - 4; $i < date('Y'); $i++)
                                        <option value='{{ $i }}'>{{ $i }}</option>
                                    @endfor

                                    @for($i = date('Y'); $i < 2026; $i++)
                                        <option value='{{ $i }}'>{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <select class="form-control filter_click" id = "filter_m_status" style = "background-color: #2f4050; height: 30px; color: #FFFFFF;">
                                    <option value = "0">-- select --</option>
                                    <option value = "1">Pending</option>
                                    <option value = "2">For Approval</option>
                                    <option value = "3">Approved</option>
                                    <option value = "5">Void</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan = "2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan = "2" style = "font-weight: bold; size: 15px;">Booking Date Created</td>
                        </tr>
                        <tr>
                            <td>Date Operator</td>
                            <td>
                                <select class="form-control filter_click" id = "filter_comm_operator" style = "background-color: #2f4050; height: 30px; color: #FFFFFF;">
                                    <option value = "1">Equal</option>
                                    <option value = "2">Between</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label style = "font-weight: normal;" id = "lbl_from">Date</label></td>
                            <td>
                                <input size="16" type="date" id = "filter_m_date_from_comm" value="" style = "background-color: #2f4050; height: 30px; color: #FFFFFF;">
                            </td>
                        </tr>
                        <tr style = "display: none;" id = "date_to_area_comm">
                            <td><label style = "font-weight: normal;" id = "lbl_to"></label></td>
                            <td>
                                <input size="16" type="date" id = "filter_m_date_to_comm" value="" style = "background-color: #2f4050; height: 30px; color: #FFFFFF;">
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="modal-footer">
                <a type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
                <button type="submit" id = "btn_search" class="btn btn-success">Search Booking</button>
                <button type="submit" id = "btn_search_invoice" style = "display: none;" class="btn btn-success">Search Invoice</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $("#filter_m_publication_chosen").width(270);
            $("#filter_i_publication_chosen").width(270);
            $("#filter_comm_publication_chosen").width(270);

            $("#filter_m_client_chosen").width(270);
            $("#filter_i_client_chosen").width(270);
            $("#filter_comm_client_chosen").width(270);

            $("#filter_m_sales_rep").width(225);
            $("#filter_i_sales_rep").width(225);

            $("#filter_m_status").width(225);

            $("#filter_m_date_from").width(265);
            $("#filter_i_date_from").width(265);

            $("#filter_m_date_to").width(265);
            $("#filter_i_date_to").width(265);

            $("#filter_m_operator").width(100);
            $("#filter_i_operator").width(100);
        });
    </script>
    <!-- Chosen -->
    <script src="{{ asset('js/plugins/chosen/chosen.jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.tablesorter.js') }}"></script>
    <script src="{{ asset('js/jquery.tablesorter.combined.js') }}"></script>
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

//        $(document).ready(function(){
//            $("#tbl_booking_lists").tablesorter();
//        });
    </script>
    <script src="{{ asset('/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('/js/table2csv.js') }}"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script>
        var over_all_total = 0, over_all_commission = 0;

        var trans_id = [];

        $(document).ready(function(){

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

            //magazine_type_booking

            $("#reports_by").change(function(){

                //btn_search_invoice
                var order = parseInt($(this).val());
                if(order == 1){
                    $("#table_booking").show();
                    $("#btn_search").show();
                    $("#table_invoice").hide();
                    $("#table_commission").hide();
                    $("#btn_search_invoice").hide();
                }
                else if(order == 2){
                    $("#table_booking").hide();
                    $("#btn_search").hide();
                    $("#table_invoice").show();
                    $("#table_commission").hide();
                    $("#btn_search_invoice").show();
                }
                else if(order == 3){
                    $("#btn_search").hide();
                    $("#table_booking").hide();
                    $("#table_invoice").hide();
                    $("#table_commission").show();
                    $("#btn_search_invoice").show();
                }
                else if(order == 4) {
                }
                else{
                    $("#table_booking").hide();
                    $("#table_invoice").hide();
                }
            });

            $("#magazine_type_booking").change(function(){
                var position_ = parseInt($(this).val());
                if(position_ == 1) {
                    $("#digital_month").hide();
                    $("#digital_week").hide();
                    $("#print_month").show();

                    $("#digital_month_comm").hide();
                    $("#digital_week_comm").hide();
                    $("#print_month_comm").show();
                }
                else if(position_ == 2) {
                    $("#digital_month").show();
                    $("#digital_week").show();
                    $("#print_month").hide();

                    $("#digital_month_comm").show();
                    $("#digital_week_comm").show();
                    $("#print_month_comm").hide();
                }
            });

            //btnExportToCSV

            $("#btnExportToCSV").click(function(){
                $("#tbl_booking_lists").table2csv({
                    filename: 'booking_lists.csv'
                });
            });

            $("#btn_search").click(function(){
                var magazine_type_booking = $("#magazine_type_booking").val();
                var f_publication = $("#filter_m_publication").val();
                var f_sales_rep = $("#filter_m_sales_rep").val();
                var f_client = $("#filter_m_client").val();

                var f_issue = $("#filter_m_issue").val();
                var f_month_issue = $("#filter_m_month_issue").val();
                var f_week_issue = $("#filter_m_week_issue").val();

                if(parseInt(magazine_type_booking) > 1) {
                    f_issue = f_month_issue + ":" + f_week_issue;
                }

                var f_year = $("#filter_m_year").val();
                var f_status = $("#filter_m_status").val();
                var f_d_from = $("#filter_m_date_from").val() != "" ? $("#filter_m_date_from").val() : "null";
                var f_d_to = $("#filter_m_date_to").val() != "" ? $("#filter_m_date_to").val() : "null";
                var f_operator = $("#filter_m_operator").val();

                get_booking(magazine_type_booking, f_publication, f_sales_rep, f_client, f_issue, f_year, f_status, f_d_from, f_d_to, f_operator);

                $("#filter_modal").modal('hide');
                $("#tbl_invoice_lists").hide();
                $("#tbl_booking_lists").show();
            });

            $("#btn_search_invoice").click(function(){
                var magazine_type_invoice = $("#magazine_type_invoice").val();
                var i_invoice_num = $("#filter_i_invoice_number").val();
                var i_invoice_number = i_invoice_num;
                if(i_invoice_num == ""){
                    i_invoice_number = 0;
                }

                var i_publication = $("#filter_i_publication").val();
                var i_issue = $("#filter_i_issue").val();
                var i_year = $("#filter_i_year").val();
                var i_sales_rep = $("#filter_i_sales_rep").val();
                var i_date_f = $("#filter_i_date_from").val();
                var i_date_from = i_date_f;
                if(i_date_f == ""){
                    i_date_from = 0;
                }
                var i_date_t = $("#filter_i_date_to").val();
                var i_date_to = i_date_t;
                if(i_date_t == ""){
                    i_date_to = 0;
                }

                var i_operator = $("#filter_i_operator").val();

                console.log("i_invoice_number " + i_invoice_number);
                console.log("i_publication " + i_publication);
                console.log("i_issue " + i_issue);
                console.log("i_year " + i_year);
                console.log("i_sales_rep " + i_sales_rep);
                console.log("i_date_from " + i_date_from);
                console.log("i_date_to " + i_date_to);

                get_filter_data_invoice(magazine_type_invoice, i_invoice_number, i_publication, i_issue, i_year, i_sales_rep, i_date_from, i_date_to, i_operator);

                $("#filter_modal").modal('hide');
                $("#tbl_invoice_lists").show();
                $("#tbl_booking_lists").hide();

            });

            $("#filter_m_operator").change(function(){
                if($(this).val() == 2){
                    $("#date_to_area").show();
                    $("#lbl_from").text("From");
                    $("#lbl_to").text("To");
                }else{
                    $("#date_to_area").hide();
                    $("#lbl_from").text("Date");
                    $("#lbl_to").text("");
                }
            });

            $("#filter_i_operator").change(function(){
                if($(this).val() == 2){
                    $("#date_i_to_area").show();
                    $("#lbl_i_from").text("From");
                    $("#lbl_i_to").text("To");
                }else{
                    $("#date_i_to_area").hide();
                    $("#lbl_i_from").text("Date");
                    $("#lbl_i_to").text("");
                }
            });

            $("#filter_comm_operator").change(function(){
                if($(this).val() == 2){
                    $("#date_to_area_comm").show();
                    $("#lbl_from_comm").text("From");
                    $("#lbl_to_comm").text("To");
                }else{
                    $("#date_to_area_comm").hide();
                    $("#lbl_from_comm").text("Date");
                    $("#lbl_to_comm").text("");
                }
            });
        });

        function get_booking(magazine_type_booking, f_publication, f_sales_rep, f_client, f_issue, f_year, f_status, f_date_from, f_date_to, f_operator) {
            var url = "/sales_report/get_filter_data/" + magazine_type_booking + "/" + f_publication + "/" + f_sales_rep + "/" + f_client + "/" + f_issue + "/" + f_year + "/" + f_status + "/" + f_date_from + "/" + f_date_to + "/" + f_operator;
            console.log(url);
            $.ajax({
                url: url,
                dataType: "JSON",
                beforeSend: function () {
                    var html = "";
                    html += "<tr>";
                    html += "<td colspan='8' style='text-align: center;'>Please wait...</td>";
                    html += "</tr>";
                    $("#tbl_booking_lists > tbody").empty().prepend(html);
                    $("#total_items").text("***calculating***");
                    $("#over_all_total").text("***calculating***");
                    $("#over_all_commission").text("***calculating***");
                },
                success: function(json) {
                    console.log(json);
                    var view_url = "http://" + report_url_api + "/kpa/work/transaction/generate/insertion-order-contract/";
                    var html = "";
                    var t_id = 0;
                    $(json.data).each(function(k, d) {
                        var push_input = [d.trans_num, d.magazine_type, d.issue];
                        trans_id.push(push_input);
                        html += "<tr>";
                        html += "<td>"+(t_id + 1)+"</td>";
                        html += "<td>"+d.trans_num+"</td>";
                        html += "<td>"+d.mag_name+"</td>";
                        html += "<td>"+d.client_name+"</td>";
                        html += "<td>"+d.sales_rep_name+"</td>";
                        html += "<td>"+d.issue+"</td>";
                        html += "<td>"+d.issue_year+"</td>";
                        html += "<td style='text-align: right;'><span id='amount_"+t_id+"'>***calculating***</span></td>";
                        html += "<td style='text-align: right;'><span id='commission_"+t_id+"'>***calculating***</span></td>";
                        html += "<td>"+d.created_at+"</td>";
                        if(parseInt(d.magazine_type) == 1) {
                            html += "<td>PRINT</td>";
                            html += "<td><a href='"+view_url+"/"+d.trans_num+"/PREVIEW' target='_blank'>Insertion Order</a></td>";
                        }
                        else {
                            html += "<td>DIGITAL</td>";
                            html += "<td><a href='"+view_url+"/"+d.trans_num+"/DIGITAL' target='_blank'>Insertion Order</a></td>";
                        }
                        html += "</tr>";
                        t_id++;
                    })

                    $("#tbl_booking_lists > tbody").empty().prepend(html);
                }
            }).done(function () {
                over_all_total = 0;
                over_all_commission = 0;
                $("#over_all_total").text(numeral(0).format('0,0.00'));
                $("#over_all_commission").text(numeral(0).format('0,0.00'));
                $("#total_items").text(numeral(0).format('0,0'));
                for (var i = 0; i < trans_id.length; i++) {
                    get_amount_each_item(trans_id[i], i);
                }
                $("#total_items").text(numeral(trans_id.length).format('0,0'));
                trans_id.length = 0;
                trans_id = [];
            })
        }

        function get_amount_each_item(trans_, i) {
            var is_type = trans_[1] == 1 ? "print" : "digital";
            var url = "http://" + report_url_api + "/kpa/work/booking/report/" + is_type + "/" + trans_[0] + "/" + trans_[2];

            console.log(url);
            $.ajax({
                url: url,
                dataType: "JSON",
                beforeSend: function () {
                    $("#amount_" + i).text("***calculating***");
                    $("#commission_" + i).text("***calculating***");
                },
                success: function(json) {

                    console.log(json);

                    $("#amount_" + i).text(numeral(json.Total).format('0,0.00'));
                    $("#commission_" + i).text(numeral(json.Sales_Commission).format('0,0.00'));

                    over_all_total = over_all_total + parseFloat(json.Total);
                    over_all_commission = over_all_commission + parseFloat(json.Sales_Commission);

                    $("#over_all_total").text(numeral(over_all_total).format('0,0.00'));
                    $("#over_all_commission").text(numeral(over_all_commission).format('0,0.00'));
                }
            })
        }

        function get_filter_data(magazine_type_booking, f_publication, f_sales_rep, f_client, f_issue, f_year, f_status, f_date_from, f_date_to, f_operator){

            var url = "/sales_report/get_filter_data/" + magazine_type_booking + "/" + f_publication + "/" + f_sales_rep + "/" + f_client + "/" + f_issue + "/" + f_year + "/" + f_status + "/" + f_date_from + "/" + f_date_to + "/" + f_operator;

            console.log(url)

            $("#booking_overall_total").empty().append("<b style = 'font-size: 15px;'>Total Amount: 0.00</b>");
            $(".dataTables-invoice").DataTable().destroy();
            $(".dataTables-booking").DataTable().destroy();
            $('.dataTables-booking').DataTable( {
                ajax: url,
                columns: [
                    { data: 'reports_set' },
                    { data: 'mag_name' },
                    { data: 'sales_rep_name' },
                    { data: 'client_name' },
                    { data: 'line_item' },
                    { data: 'qty' },
                    { data: 'amount' },
                    { data: 'status' },
                    { data: 'created_at' }
                ],
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

            get_invoice_overall_total(magazine_type_booking, f_publication, f_sales_rep, f_client, f_issue, f_year, f_status, f_date_from, f_date_to, f_operator);
        }

        function get_invoice_overall_total(magazine_type_booking, f_publication, f_sales_rep, f_client, f_issue, f_year, f_status, f_date_from, f_date_to, f_operator) {
            $.ajax({
                url: "/sales_report/get_filter_data/" + magazine_type_booking + "/" + f_publication + "/" + f_sales_rep + "/" + f_client + "/" + f_issue + "/" + f_year + "/" + f_status + "/" + f_date_from + "/" + f_date_to + "/" + f_operator,
                dataType: "text",
                beforeSend: function () {},
                success: function(data) {
                    var json = $.parseJSON(data);
                    if(json.Code == 200)
                    {
                        $("#booking_overall_total").empty().append("<b style = 'font-size: 15px;'>Total Amount: " + json.overall_total + "</b>");
                    }
                }
            });
        }

        function get_filter_data_invoice(magazine_type_invoice, i_invoice_number, i_publication, i_issue, i_year, i_sales_rep, i_date_from, i_date_to, i_operator){

            var url = "/sales_report/get_filter_data_invoice/" + magazine_type_invoice + "/" + i_invoice_number + "/" + i_publication + "/" + i_issue + "/" + i_year + "/" + i_sales_rep + "/" + i_date_from + "/" + i_date_to + "/" + i_operator;

            console.log(url);

            $.ajax({
                url: url,
                dataType: "JSON",
                beforeSend: function () {
                    var html = "";
                    html += "<tr>";
                    html += "<td colspan='8' style='text-align: center;'>Please wait...</td>";
                    html += "</tr>";
                    $("#tbl_invoice_lists > tbody").empty().prepend(html);
                    $("#total_items").text("***calculating***");
                    $("#over_all_total").text("***calculating***");
                },
                success: function(json) {
                    console.log(json);
                    var view_url = "http://" + report_url_api + "/kpa/work/transaction/invoice-order";
                    var html = "";
                    var t_id = 0;
                    $(json.data).each(function(k, d) {
                        trans_id.push(d.invoice_num);
                        html += "<tr>";
                        html += "<td>"+(t_id + 1)+"</td>";
                        html += "<td>"+d.invoice_num+"</td>";
                        html += "<td>"+d.mag_name+"</td>";
                        html += "<td>"+d.invoice_year+"</td>";
                        html += "<td>"+d.sales_rep_name+"</td>";
                        html += "<td>"+d.invoice_created+"</td>";
                        html += "<td>"+d.invoice_due_date+"</td>";
                        if(parseInt(d.issue) > 0) {
                            html += "<td><a href='"+view_url+"/"+d.invoice_num+"' target='_blank'>Invoice</a></td>";
                        }
                        else {
                            html += "<td><a href='"+view_url+"/"+d.invoice_num+"/DIGITAL' target='_blank'>Invoice</a></td>";
                        }
                        html += "</tr>";
                        t_id++;
                    })
                    $("#tbl_invoice_lists > tbody").empty().prepend(html);
                }
            }).done(function () {

            })
        }

        function get_publication() {
            $.ajax({
                url: "/get_publication",
                dataType: "text",
                beforeSend: function () {},
                success: function(data) {
                    var json = $.parseJSON(data);
                    if(json.Code == 200)
                    {
                        $('#filter_publication_area').append("<select class = 'form-control chosen-select' id = 'filter_publication'>");
                        $('#filter_publication').append("<option>--select--</option>");
                        $(json.Result).each(function(g, tran){
                            $('#filter_publication').append("<option value = "+ tran.Id +">"+ tran.magazine_name +"</option>");
                        });
                        $('#filter_publication_area').append("</select>");
                    }
                }
            });
        }
    </script>
@endsection