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
                    <script type="text/javascript" src="http://cheappartsguy.com/query/assets/js/jquery-1.9.1.min.js"></script>
                    <script>

                        populate_sales_report();

                        function populate_sales_report() {

                            $(document).ready( function() {

                                var html_thmb = null;

                                $.ajax({
                                    url: "http://192.168.43.132/kpa/work/booking-sales-report",
                                    dataType: "text",
                                    beforeSend: function () {
//                                        $('table#issue_reports > tbody').empty().prepend('<tr> <td colspan="7">Loading... Please wait...</td> </tr>');
                                    },
                                    success: function(data) {
                                        var json = $.parseJSON(data);

                                        if(json == null)
                                            return false;

                                        if(json.Status == 404) {
                                            $('table#issue_reports > tbody').empty().prepend('<tr> <td colspan="7">' + json.Message + '</td> </tr>');
                                            return;
                                        }

                                        var item_count = 1;
                                        $(json.Data).each(function(i, tran){

                                            html_thmb += "<tr>";
                                            html_thmb += "<td>"+item_count+"</td>";
                                            html_thmb += "<td>"+tran.trans_num+"</td>";
                                            html_thmb += "<td>"+tran.sales_rep_code+"</td>";
                                            html_thmb += "<td>"+tran.client_id+"</td>";
                                            html_thmb += "<td>"+tran.agency_id+"</td>";
                                            html_thmb += "<td>"+tran.sales_rep_name+"</td>";
                                            html_thmb += "<td>"+tran.client_name+"</td>";
                                            html_thmb += "<td>"+tran.agency_name+"</td>";
                                            html_thmb += "<td>"+tran.number_of_issue+"</td>";
                                            html_thmb += "<td>"+tran.total_amount+"</td>";

                                            var n_status = "VOID";
                                            var p_status = parseInt(tran.status);

                                            if(p_status == 1) {
                                                n_status = "PENDING";
                                            }
                                            else if(p_status == 2) {
                                                n_status = "ON PROCESS";
                                            }
                                            else if(p_status == 3) {
                                                n_status = "APPROVED";
                                            }
                                            else if(p_status == 4) {
                                                n_status = "DECLINED";
                                            }

                                            html_thmb += "<td>"+n_status+"</td>";
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
                                <th>item no</th>
                                <th>trans_num</th>
                                <th>sales_rep_code</th>
                                <th>client_id</th>
                                <th>agency_id</th>
                                <th>sales_rep_name</th>
                                <th>client_name</th>
                                <th>agency_name</th>
                                <th>number_of_issue</th>
                                <th>total_amount</th>
                                <th>status</th>
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