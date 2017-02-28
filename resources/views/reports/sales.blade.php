@extends('layout.magazine_main')

@section('title')
    Reports
@endsection

@section('styles')
    <link href="{{  asset('css/plugins/chosen/chosen.css')  }}" rel="stylesheet">
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
                            <table id="tbl_booking_lists" class="footable table" data-sorting="true" data-page-size="10">
                                <thead>
                                <tr>
                                    <th style='text-align: left;'>Publication</th>
                                    <th style='text-align: left; width: 150px;'>Sales</th>
                                    <th style='text-align: left; width: 150px;'>Client</th>
                                    <th style='text-align: center; width: 100px;'>Line Items</th>
                                    <th style='text-align: center; width: 100px;'>Qty</th>
                                    <th style='text-align: right; width: 100px;'>Amount</th>
                                    <th style='text-align: left; width: 100px;'>Status</th>
                                    <th style='text-align: center; width: 130px;'>Date Created</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <ul class="pagination pull-right"></ul>
                                    </td>
                                </tr>
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

                </div>
                <div class="modal-footer">
                <a type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
                <button type="submit" id = "btn_search" class="btn btn-success">Search</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $("#filter_m_publication_chosen").width(250);
            $("#filter_m_client_chosen").width(250);
            $("#filter_m_sales_rep").width(225);
            $("#filter_m_status").width(225);
            $("#filter_m_date_from").width(250);
            $("#filter_m_date_to").width(250);
            $("#filter_m_operator").width(100);
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

    <script>
        $(document).ready(function(){
            //get_all_data();

            $("#btn_search").click(function(){
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

                console.log("Publication " + f_publication);
                console.log("Sales Rep " + f_sales_rep);
                console.log("Client " + f_client);
                console.log("Status " + f_status);
                console.log("Operator " + f_operator);
                console.log("Date From " + f_date_from);
                console.log("Date To " + f_date_to);

                get_filter_data(f_publication, f_sales_rep, f_client, f_status, f_date_from, f_date_to, f_operator);

                $("#filter_modal").modal('hide');
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

        });

        function get_filter_data(f_publication, f_sales_rep, f_client, f_status, f_date_from, f_date_to, f_operator)
        {
            var html_thmb = "";
            $.ajax({
                url: "/sales_report/get_filter_data/" + f_publication + "/" + f_sales_rep + "/" + f_client + "/" + f_status + "/" + f_date_from + "/" + f_date_to + "/" + f_operator,
                dataType: "text",
                beforeSend: function () {
                    $('table#tbl_booking_lists > tbody').empty().prepend('<tr> <td colspan="8" style="text-align: center;"> <img src="{{ asset('img/ripple.gif') }}" style="width: 90px;"  />  Fetching All Transactions... Please wait...</td> </tr>');
                },
                success: function(data) {
                    var json = $.parseJSON(data);

                    console.log(json);

                    if(json.Code == 200)
                    {
                        $(json.Result).each(function(i, tran){

                            var amount = tran.new_amount != null ? tran.new_amount : tran.amount;

                            html_thmb += "<tr>";
                            html_thmb += "<td style='text-align: left;'>" + tran.mag_name + "</td>";
                            html_thmb += "<td style='text-align: left;'>" + tran.sales_rep_name + "</td>";
                            html_thmb += "<td style='text-align: left;'>" + tran.client_name + "</td>";
                            html_thmb += "<td style='text-align: center;'>" + tran.line_item + "</td>";
                            html_thmb += "<td style='text-align: center;'>" + tran.qty + "</td>";
                            html_thmb += "<td style='text-align: right;'>" + numeral(amount).format('0,0.00') + "</td>";
                            html_thmb += "<td style='text-align: left;'>" + tran.status + "</td>";
                            html_thmb += "<td style='text-align: center;'>" + tran.created_at + "</td>";
                            html_thmb += "</tr>";

                        });
                    }


                    $('table#tbl_booking_lists > tbody').empty().prepend(html_thmb);

                    $("#filter_m_publication").val(f_publication);
                    $("#filter_m_sales_rep").val(f_sales_rep);
                    $("#filter_m_client").val(f_client);
                    $("#filter_m_status").val(f_status);
                    $("#filter_m_date_from").val(f_date_from);
                    $("#filter_m_date_to").val(f_date_to);
                    $("#filter_m_operator").val(f_operator);
                }
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