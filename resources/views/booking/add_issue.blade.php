@extends('layout.magazine_main')

@section('title')
    Add New Contract
@endsection

@section('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Booking</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Booking List</a>
            </li>
            <li>
                <a href="index.html">Add Booking</a>
            </li>
            <li>
                <a href="index.html">Add Magazine</a>
            </li>
            <li class="active">
                <strong>Add Issue</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Issue <small> *all fields are required</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form method="post" action = "{{ url('/booking/save_issue') . '/' . $mag_trans_uid . '/' . $client_id}}">
                                <section class="panel">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label for="ex2">magazine_trans_id</label>
                                            <input class="form-control" id="ex2" type="text" value = "{{ $mag_trans_uid }}" name = "magazine_trans_id" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label for="ex2">ad_criteria_id</label>
                                            <select class="form-control" name = "ad_criteria_id" id = "ad_criteria_id">
                                                <option value = "" disabled selected>select</option>
                                                @for($i = 0; $i < COUNT($ad_c); $i++)
                                                    <option value = "{{ $ad_c[$i]->Id }}">{{ $ad_c[$i]->Id . ' - ' . $ad_c[$i]->name }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <script type="text/javascript" src="http://cheappartsguy.com/query/assets/js/jquery-1.9.1.min.js"></script>
                                    <script>
                                        $(document).ready(function(){
                                            var client_id = {{ $client_id }};
                                            $('#ad_criteria_id').on('change',function(){

                                                var criteria_id = $(this).val();
                                                $.ajax({
                                                    url: "/booking/getPackageName/" + criteria_id,
                                                    dataType: 'text',
                                                    success: function(data)
                                                    {
                                                        var json = $.parseJSON(data);
                                                        if(json == null)
                                                            return false;

                                                        $('#ad_package_id').empty();
                                                        $('#ad_package_id').append("<option value = '' disabled selected>select</option>");
                                                        $(json.list).each(function(g, gl){
                                                            $('#ad_package_id').append("<option value = "+ gl.id +">"+ gl.package_name +"</option>");
                                                        });
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label for="ex2">ad_package_id</label>
                                            <select class="form-control" name = "ad_package_id" id = "ad_package_id">

                                            </select>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                            <input type="submit" class="btn btn-primary" value = "Save">
                                            <a href = "{{ URL('/v2/book_and_sales/') }}" class="btn btn-primary">Back</a>
                                        </div>
                                    </div>
                                </section>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>List Of Issue</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <script type="text/javascript" src="http://cheappartsguy.com/query/assets/js/jquery-1.9.1.min.js"></script>
                            <script>
                                var trans_id = {{ $transaction_uid[0]->transaction_id }};
                                populate_issues_transaction(trans_id);
                                function populate_issues_transaction(uid)
                                {
                                    var html_thmb = "";

                                    $(document).ready( function() {
                                        $.ajax({
                                            url: "http://192.168.43.132/kpa/work/magazine-issue-lists/"+uid,
                                            dataType: "text",
                                            beforeSend: function () {
                                                $('#mag_name').text("***");
                                                $('table#issue_reports > tbody').empty().prepend('<tr> <td colspan="7">Loading... Please wait...</td> </tr>');
                                            },
                                            success: function(data) {
                                                var json = $.parseJSON(data);
                                                if(json == null)
                                                    return false;

                                                if(json.Status == 404) {

                                                    $('table#issue_reports > tbody').empty().prepend('<tr> <td colspan="7">' + json.Message + '</td> </tr>');
                                                    return;
                                                }

                                                $('#mag_trans_container').empty().prepend('<h3>'+ json.Magazine_Name +' [ <span>'+ json.Mag_Code +'</span> ] | '+ json.Mag_Country +' </h3>');

                                                var item_count = 1;
                                                $(json.Data).each(function(i, tran){

                                                    html_thmb += "<tr>";
                                                    html_thmb += "<td>"+item_count+"</td>";
                                                    html_thmb += "<td>"+tran.criteria_name+"</td>";
                                                    html_thmb += "<td>"+tran.package_name+"</td>";
                                                    html_thmb += "<td>"+tran.amount+"</td>";
                                                    html_thmb += "<td>"+tran.date_issued+"</td>";
                                                    html_thmb += "<td>"+tran.status+"</td>";
                                                    html_thmb += "<td>"+tran.created_at+"</td>";
                                                    html_thmb += "</tr>";

                                                    item_count++;
                                                });

                                                $('table#issue_reports > tbody').empty().prepend(html_thmb);
                                            }
                                        });
                                    } )
                                }
                            </script>
                            <section class="panel">
                                @if(Session::has('success'))
                                    <div class="alert alert-success alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                <table class="table table-striped table-bordered table-hover dataTables-example" id="issue_reports">
                                    <thead>
                                        <tr>
                                            <th>Item#</th>
                                            <th>Criteria Name</th>
                                            <th>Package Size</th>
                                            <th>Amount</th>
                                            <th>Date Issued</th>
                                            <th>Status</th>
                                            <th>Date Created</th>
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
</div>
@endsection

@section('scripts')
{{--code later--}}
@endsection