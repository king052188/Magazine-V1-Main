@extends('layout.magazine_main')

@section('title')
    Reports
@endsection

@section('styles')
    <link href="{{  asset('css/plugins/chosen/chosen.css')  }}" rel="stylesheet">
    <link href="{{  asset('css/plugins/dataTables/datatables.min.css')  }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet">
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
                    </div>

                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table id="tbl_booking_lists" class="table display nowrap dataTables-booking" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th style='text-align: left;'>Reports</th>
                                    <th style='text-align: left;'>Publication</th>
                                    <th style='text-align: left; width: 150px;'>Sales Rep</th>
                                    <th style='text-align: left; width: 150px;'>Client</th>
                                    <th style='text-align: left; width: 100px;'>Line Items</th>
                                    <th style='text-align: left; width: 100px;'>Qty</th>
                                    <th style='text-align: left; width: 100px;'>Amount</th>
                                    <th style='text-align: left; width: 100px;'>Status</th>
                                    <th style='text-align: left; width: 130px;'>Date Created</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                </tfoot>
                            </table>

                            <table id="tbl_invoice_lists" class="table display nowrap dataTables-invoice" style = "display: none;" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th style='text-align: left;'>Reports</th>
                                    <th style='text-align: left;'>Invoice #</th>
                                    <th style='text-align: left; width: 150px;'>Publication</th>
                                    <th style='text-align: left; width: 150px;'>Issue</th>
                                    <th style='text-align: left; width: 100px;'>Year</th>
                                    <th style='text-align: left; width: 100px;'>Executive Account</th>
                                    <th style='text-align: left; width: 100px;'>Invoice Created</th>
                                    <th style='text-align: left; width: 100px;'>Due Date</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                </tfoot>
                            </table>
                        </div>
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
                    <table border = "0">
                        <tr>
                            <td style = "width: 200px;">Reports by</td>
                            <td>
                                <select class="form-control filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "reports_by">
                                    <option value = "1">Booking</option>
                                    <option value = "2">Invoice</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style = "width: 200px;">Type</td>
                            <td>
                                <select class="form-control" style="background-color: #2f4050; color: #FFFFFF;" id = "magazine_type_booking">
                                    <option value = "0">All</option>
                                    <option value = "1">Print</option>
                                    <option value = "2">Digital</option>
                                </select>
                                <select class="form-control" style="background-color: #2f4050; color: #FFFFFF; display: none; " id = "magazine_type_invoice">
                                    <option value = "0">All</option>
                                    <option value = "1">Print</option>
                                    <option value = "2">Digital</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <br /><br />
                    <table border = "0" id = "table_booking">
                        <tr>
                            <td style = "width: 200px;">Publication</td>
                            <td>
                                <select class="form-control chosen-select filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "filter_m_publication">
                                    <option value = "0">-- select --</option>
                                    @for($i = 0; $i < COUNT($publication); $i++)
                                        <option value = "{{ $publication[$i]->Id }}">{{ $publication[$i]->magazine_name }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Sales Rep</td>
                            <td>
                                <select class="form-control filter_click" id = "filter_m_sales_rep" style = "background-color: #2f4050; height:30px; color: #FFFFFF;">
                                    <option value = "0">-- select --</option>
                                    @for($i = 0; $i < COUNT($sales_rep); $i++)
                                        <option value = "{{ $sales_rep[$i]->Id }}">{{ $sales_rep[$i]->first_name . " " . $sales_rep[$i]->last_name }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Client</td>
                            <td>
                                <select class="form-control chosen-select filter_click" id = "filter_m_client">
                                    <option value = "0">-- select --</option>
                                    @for($i = 0; $i < COUNT($clients); $i++)
                                        <option value = "{{ $clients[$i]->Id }}">{{ $clients[$i]->company_name }}</option>
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

                    <table border = "0" id = "table_invoice" style = "display: none;">
                        <tr>
                            <td style = "width: 200px;">Invoice #</td>
                            <td>
                                <input type = "text" style="background-color: #2f4050; height: 30px; color: #FFFFFF;" id = "filter_i_invoice_number">
                            </td>
                        </tr>
                        <tr>
                            <td style = "width: 200px;">Publication</td>
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
                            <td style = "width: 200px;">Issue</td>
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
                            <td style = "width: 200px;">Year</td>
                            <td>
                                <select class="form-control filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "filter_i_year">
                                    <option value="0">Select</option>
                                    @for($i = 2017; $i < 2026; $i++)
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
            $("#filter_m_publication_chosen").width(250);
            $("#filter_i_publication_chosen").width(250);

            $("#filter_m_client_chosen").width(250);

            $("#filter_m_sales_rep").width(225);
            $("#filter_i_sales_rep").width(225);

            $("#filter_m_status").width(225);

            $("#filter_m_date_from").width(250);
            $("#filter_i_date_from").width(250);

            $("#filter_m_date_to").width(250);
            $("#filter_i_date_to").width(250);

            $("#filter_m_operator").width(100);
            $("#filter_i_operator").width(100);
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
    <script src="{{ asset('/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    {{--<script src="//code.jquery.com/jquery-1.12.4.js"></script>--}}
    {{--<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>--}}
    {{--<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>--}}
    {{--<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>--}}
    {{--<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>--}}
    {{--<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js"></script>--}}
    {{--<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js"></script>--}}
    {{--<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>--}}
    {{--<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>--}}
    <script>
        $(document).ready(function(){
            //get_all_data();

            $("#reports_by").change(function(){
                console.log($(this).val());
                if($(this).val() == 1){
                    $("#table_booking").show();
                    $("#btn_search").show();
                    $("#table_invoice").hide();
                    $("#btn_search_invoice").hide();
                    $("#magazine_type_booking").show();
                    $("#magazine_type_invoice").hide();
                }else{
                    $("#table_booking").hide();
                    $("#btn_search").hide();
                    $("#table_invoice").show();
                    $("#btn_search_invoice").show();
                    $("#magazine_type_booking").hide();
                    $("#magazine_type_invoice").show();
                }
            });

            $("#btn_search").click(function(){
                var magazine_type_booking = $("#magazine_type_booking").val();

                var f_publication = $("#filter_m_publication").val();
                var f_sales_rep = $("#filter_m_sales_rep").val();
                var f_client = $("#filter_m_client").val();
                var f_status = $("#filter_m_status").val();
                var f_d_from = $("#filter_m_date_from").val();
                var f_date_from = f_d_from;
                    if(f_d_from == ""){
                        f_date_from = 0;
                    }
                var f_d_to = $("#filter_m_date_to").val();
                var f_date_to = f_d_to;
                if(f_d_to == ""){
                    f_date_to = 0;
                }

                var f_operator = $("#filter_m_operator").val();

                get_filter_data(magazine_type_booking, f_publication, f_sales_rep, f_client, f_status, f_date_from, f_date_to, f_operator);

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
        });

        function get_filter_data(magazine_type_booking, f_publication, f_sales_rep, f_client, f_status, f_date_from, f_date_to, f_operator){

//            console.log("Mag Type " + magazine_type_booking);
//            console.log("Publication " + f_publication);
//            console.log("Sales Rep " + f_sales_rep);
//            console.log("Client " + f_client);
//            console.log("Status " + f_status);
//            console.log("Operator " + f_operator);
//            console.log("Date From " + f_date_from);
//            console.log("Date To " + f_date_to);

            $(".dataTables-invoice").DataTable().destroy();
            $(".dataTables-booking").DataTable().destroy();

            $('.dataTables-booking').DataTable( {
                ajax: "/sales_report/get_filter_data/" + magazine_type_booking + "/" + f_publication + "/" + f_sales_rep + "/" + f_client + "/" + f_status + "/" + f_date_from + "/" + f_date_to + "/" + f_operator,
                columns: [
                    { data: 'reports_set' },
                    { data: 'mag_name' },
                    { data: 'sales_rep_name' },
                    { data: 'client_name' },
                    { data: 'line_item' },
                    { data: 'qty' },
                    { data: 'new_amount' },
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
        }

        function get_filter_data_invoice(magazine_type_invoice, i_invoice_number, i_publication, i_issue, i_year, i_sales_rep, i_date_from, i_date_to, i_operator){

            $(".dataTables-booking").DataTable().destroy();
            $(".dataTables-invoice").DataTable().destroy();

            $('.dataTables-invoice').DataTable( {
                ajax: "/sales_report/get_filter_data_invoice/" + magazine_type_invoice + "/" + i_invoice_number + "/" + i_publication + "/" + i_issue + "/" + i_year + "/" + i_sales_rep + "/" + i_date_from + "/" + i_date_to + "/" + i_operator,
                columns: [
                    { data: 'reports_set' },
                    { data: 'invoice_number' },
                    { data: 'publication' },
                    { data: 'issue' },
                    { data: 'year' },
                    { data: 'executive_account' },
                    { data: 'invoice_created' },
                    { data: 'due_date' }
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