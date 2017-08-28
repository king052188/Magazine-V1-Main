@extends('layout.magazine_main')

@section('title')
    Magazines List
@endsection

@section('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/datepicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{  asset('css/plugins/chosen/chosen.css')  }}" rel="stylesheet">
@endsection

@section('magazine_content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Payment</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Send Bulk Invoices</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Send Bulk Invoices</h5>
                    </div>

                    <div class="ibox-content">
                        <h5>Initiator</h5>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-sm-12 form-inline">

                                    <div class="" id = "filter_container">
                                        <div class="form-group imp_display" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Type</label><br/>
                                            <select class="form-control chosen-select" style="background-color: #2f4050; color: #FFFFFF; height: 35px;" id = "ddlType">
                                                <option value="0">-- Select --</option>
                                                <option value="1">Send for PRINT INVOICE</option>
                                                <option value="2">Send for DIGITAL INVOICE</option>
                                            </select>
                                        </div>

                                        <div class="form-group" style="margin-right: 10px;">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">Override Client Email (Testing Purposes)</label><br/>
                                            <input type="text" class="form-control input-sm" style="; width: 280px; height: 35px;" id = "txtTempEmail" placeholder="Test Email Here...">
                                        </div>

                                        <div class="form-group">
                                            <label class="filter-col" style="margin-right:0;" for="pref-search">&nbsp;</label><br/>
                                            <button type="submit" class="btn btn-primary filter-col " id = "btn_proceed" style="margin-bottom: 0px; height: 30px; padding: 0 10px 0 5px;">
                                                Proceed
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <h5>Bulk Email Logs</h5>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-sm-12 form-inline">
                                    <iframe style="width: 100%; height: 410px; " src="http://postmail.kpa21.info/v2/logs/?i=6"></iframe>
                                </div>
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
        $(document).ready(function(){

            $("#btn_proceed").click(function() {
                var type = $('#ddlType').val();
                var email = $('#txtTempEmail').val();
                var url = "http://"+ report_url_api +"/kpa/work/send-bulk-email-for-invoice/" + type + "/" + email;
                $.ajax({
                    url: url,
                    dataType: "text",
                    beforeSend: function () {
                        $("#btn_proceed").text("Please wait...");
                    },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if(json.length > 0) {
                            alert("Bulk Invoices has been done.");
                            $("#btn_proceed").text("Proceed");
                            $('#txtTempEmail').val("");
                        }
                    }
                });
            })

        });
    </script>
@endsection