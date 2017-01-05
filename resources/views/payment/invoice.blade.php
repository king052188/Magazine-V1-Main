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
                    <strong>Generate Invoice</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Generate Invoice</h5>
                    </div>

                    <div class="ibox-content">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-sm-12 form-inline">

                                    {{--<form class="form-inline" role="form">--}}
                                    <div class="">
                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Year:</label><br/>
                                            <select class='form-control' name='generate_year' id = 'generate_year' style = 'width: 150px;' required>
                                                @for($i = date('Y'); $i > date('Y') - 10; $i--)
                                                    <option value='{{ $i }}'>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Issue:</label><br/>
                                            <select class='form-control' name='generate_issue' id = 'generate_issue' style = 'width: 100px;' required>
                                                @for($i = 1; $i < 13; $i++)
                                                    <option value='{{ $i }}'>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">&nbsp;</label><br/>
                                            <button type="submit" class="btn btn-primary filter-col " id = "btn_generate" style="margin-bottom: 0px;">
                                                <i class="fa fa-ticket"></i> Generate
                                            </button>
                                        </div>

                                    </div><br/>

                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="tbl_invoice_list" class="table table-striped table-bordered table-hover dataTables-example-main" >
                                <thead>
                                <tr>
                                    <th style='text-align: center; width: 200px;'>Invoice Number</th>
                                    <th style='text-align: center; width: 200px;'>Issue</th>
                                    <th style='text-align: center; width: 200px;'>Due Date</th>
                                    <th style='text-align: center;'>Sales Representative</th>
                                    <th style='text-align: center; width: 100px;'>Action</th>
                                </tr>
                                </thead>
                                <tbody>

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

            function populate_invoice_list()
            {
                var html_thmb = "";
                var isFirstLoad = true;
                $.ajax({
                    url: "/payment/invoice/list",
                    dataType: "text",
                    beforeSend: function () {
                        if(isFirstLoad) {
                            isFirstLoad = false;
                            $('table#tbl_payment_list > tbody').empty().prepend('<tr> <td colspan="5" style="text-align: center;"> <img src="{{ asset('img/ripple.gif') }}" style="width: 90px;"  />  Fetching All Transactions... Please wait...</td> </tr>');
                        }
                    },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if(json == null)
                            return false;

                        $(json.list).each(function(i, tran){

                            html_thmb += "<tr>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.invoice_num +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.issue +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.due_date +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.account_executive +"</td>";
                            html_thmb += "<td style='text-align: left;'></td>";
                            html_thmb += "</tr>";

                        });

                        $('table#tbl_invoice_list > tbody').empty().prepend(html_thmb);
                    }
                });
            }


            $("#btn_generate").click(function(){

                var generate_issue = $("#generate_issue").val();
                var generate_year = $("#generate_year").val();

                console.log(generate_issue);
                console.log(generate_year);

                $.ajax({
                    url: "/payment/invoice/generate/" + generate_issue + "/" + generate_year,
                    dataType: "text",
                    beforeSend: function () {

                    },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if(json == null)
                            return false;

                        if(json.status == 202)
                        {
                            swal(
                                    '',
                                    'Generating Invoice Number has been done!',
                                    'success'
                            )

                            populate_invoice_list();
                        }
                        else if(json.status == 404)
                        {
                            swal(
                                    '',
                                    'Generating Invoice Number error!',
                                    'fail'
                            )
                        }
                    }
                });
            });
        });
    </script>
@endsection