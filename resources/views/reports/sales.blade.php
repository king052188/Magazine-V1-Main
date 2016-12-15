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
                    <style>

                        .trans {
                            display: inline-block;
                            padding: 6px 12px;
                            margin-bottom: 0;
                            font-weight: 400;
                            line-height: 1.42857143;
                            text-align: center;
                            -ms-touch-action: manipulation;
                            touch-action: manipulation;
                            -webkit-user-select: none;
                            -moz-user-select: none;
                            -ms-user-select: none;
                            user-select: none;
                            background-image: none;
                            border: 1px solid transparent;
                            border-radius: 4px;
                        }

                        .trans_pending {
                            background-color: #8B8B8B;
                            border-color: #8B8B8B;
                            color: #FFFFFF;
                        }

                        .trans_pending:hover {
                            background-color: #ffffff;
                            border-color: #8B8B8B;
                            color: #8B8B8B;
                        }

                        .trans_for_approval {
                            background-color: #D329D8;
                            border-color: #D329D8;
                            color: #FFFFFF;
                        }

                        .trans_for_approval:hover {
                            background-color: #FFFFFF;
                            border-color: #D329D8;
                            color: #D329D8;
                        }

                        .trans_approved {
                            background-color: #3FD127;
                            border-color: #3FD127;
                            color: #FFFFFF;
                        }

                        .trans_approved:hover {
                            background-color: #FFFFFF;
                            border-color: #3FD127;
                            color: #3FD127;
                        }

                        .trans_declined_void {
                            background-color: #D83C2F;
                            border-color: #D83C2F;
                            color: #FFFFFF;
                        }

                        .trans_declined_void:hover {
                            background-color: #FFFFFF;
                            border-color: #D83C2F;
                            color: #D83C2F;
                        }

                    </style>
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
                                            var agency = tran.agency_name == null ? "NONE" : tran.agency_name;
                                            html_thmb += "<td style='text-align: left;'>"+agency+"</td>";
                                            html_thmb += "<td style='text-align: center;'>"+tran.number_of_issue+"</td>";
                                            html_thmb += "<td style='text-align: right;'>"+ numeral(tran.total_amount).format('0,0.00')+"</td>";

                                            var n_status = "Void";
                                            var p_status = parseInt(tran.status);

                                            if(p_status == 1) {
                                                n_status = "Pending";
                                                html_thmb += "<td style='text-align: left;'> <span class='trans trans_pending'>"+n_status+"</span> </td>";
                                            }
                                            else if(p_status == 2) {
                                                n_status = "For Approval";
                                                html_thmb += "<td style='text-align: left;'> <span class='trans trans_for_approval'>"+n_status+"</span> </td>";
                                            }
                                            else if(p_status == 3) {
                                                n_status = "Approved";
                                                html_thmb += "<td style='text-align: left;'> <span class='trans trans_approved'>"+n_status+"</span> </td>";
                                            }
                                            else {
                                                n_status = "Void";
                                                html_thmb += "<td style='text-align: left;'> <span class='trans trans_declined_void'>"+n_status+"</span> </td>";
                                            }


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
                        <table class="table table-striped table-bordered table-hover SalesListdataTables" id="issue_reports">
                            <thead>
                            <tr>
                                <th style='text-align: center;'>#</th>
                                <th style='text-align: left;'>TRANS#</th>
                                <th style='text-align: left;'>SALES</th>
                                <th style='text-align: left;'>CLIENT</th>
                                <th style='text-align: left;'>AGENCY</th>
                                <th style='text-align: center;'>LINE ITEM</th>
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

<script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
<script>

    $(document).ready( function() {

        $('.SalesListdataTables').DataTable({
        dom: '<"html5buttons"B>lTfgitp',
        buttons: []
        });

    });
</script>
@endsection