@extends('layout.magazine_main')

@section('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Reports</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Reports</a>
            </li>
            <li class="active">
                <strong>Sales Report</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Sales Report</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <script type="text/javascript" src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
                    <script>

                        var isFirstLoad = true;

                        populate_sales_report();

                        function populate_sales_report() {

                            $(document).ready( function() {

                                var html_thmb = null;

                                $.ajax({
                                    url: "http://"+report_url_api+"/kpa/work/booking-sales-report",
                                    dataType: "text",
                                    beforeSend: function () {
                                        if(isFirstLoad) {
                                            isFirstLoad = false;
                                            $('table#issue_reports > tbody').empty().prepend('<tr> <td colspan="8" style="text-align: center;"> <img src="{{ asset('img/ripple.gif') }}" style="width: 90px;"  />  Fetching All Transactions... Please wait...</td> </tr>');
                                        }
                                    },
                                    success: function(data) {
                                        var json = $.parseJSON(data);

                                        if(json == null)
                                            return false;

                                        if(json.Status == 404) {
                                            $('table#issue_reports > tbody').empty().prepend('<tr> <td colspan="8">' + json.Message + '</td> </tr>');
                                            return;
                                        }

                                        var item_count = 1;
                                        $(json.Data).each(function(i, tran){

                                            html_thmb += "<tr>";
                                            html_thmb += "<td style='text-align: center;'>"+item_count+"</td>";
                                            html_thmb += "<td style='text-align: left;'>"+tran.trans_num+"</td>";
                                            html_thmb += "<td style='text-align: left;'>"+tran.sales_rep_name+"</td>";
                                            html_thmb += "<td style='text-align: left;'>"+tran.client_name+"</td>";
                                            html_thmb += "<td style='text-align: left;'>"+tran.agency_name+"</td>";
                                            html_thmb += "<td style='text-align: center;'>"+tran.number_of_issue+"</td>";
                                            html_thmb += "<td style='text-align: right;'>"+ numeral(tran.total_amount).format('0,0.00')+"</td>";

                                            var n_status = "Void";
                                            var p_status = parseInt(tran.status);

                                            if(p_status == 1) {
                                                n_status = "Pending";
                                            }
                                            else if(p_status == 2) {
                                                n_status = "For Approval";
                                            }
                                            else if(p_status == 3) {
                                                n_status = "Approved";
                                            }
                                            else if(p_status == 4) {
                                                n_status = "Declined";
                                            }

                                            html_thmb += "<td style='text-align: left;'>"+n_status+"</td>";
                                            html_thmb += "</tr>";

                                            item_count++;
                                        });

                                        $('table#issue_reports > tbody').empty().prepend(html_thmb);
                                    }
                                });
                            } );

                        }

                        setInterval(populate_sales_report, 2000);

                    </script>
                    <section class="panel">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="issue_reports">
                            <thead>
                            <tr>
                                <th style='text-align: center;'>#</th>
                                <th style='text-align: left;'>TRANS#</th>
                                <th style='text-align: left;'>SALES</th>
                                <th style='text-align: left;'>CLIENT</th>
                                <th style='text-align: left;'>AGENCY</th>
                                <th style='text-align: center;'># OF ISSUE</th>
                                <th style='text-align: right;'>TOTAL AMOUNT</th>
                                <th style='text-align: left;'>STATUS</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection