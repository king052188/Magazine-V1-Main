@extends('layout.magazine_main')

@section('title')
    Magazines List
@endsection

@section('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Booking</h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>Booking List</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <a href="/booking/add-booking" class="btn btn-primary">Add New Booking</a>
        </div>
    </div>
</div>



<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Booking List</h5>
            </div>

            <div class="ibox-content">
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    {{ Session::get('success') }}
                </div>
                @endif
                <div class="table-responsive">
                    <script type="text/javascript" src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
                    <script>

                        update_status = function(control_id) {

                            var selected = $('#ddlStatus_' + control_id).val();

                            var url = "/transaction/update/row/"+ control_id +"/"+ selected;

                            $(document).ready( function() {

                                $.ajax({
                                    url: url,
                                    dataType: "text",
                                    beforeSend: function () {

                                    },
                                    success: function(data) {
                                        var json = $.parseJSON(data);

                                        console.log(json);

                                        if(json.status == 200)
                                        {
                                            alert("Update was successful");
                                            location.reload();
                                        }
                                    }
                                });

                            } );

                        }


                    </script>
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th style='text-align: center; width: 50px;'>#</th>
                            <th style='text-align: left;'>TRANS#</th>
                            <th style='text-align: left; width: 150px;'>MAG NAME</th>
                            <th style='text-align: left; width: 150px;'>SALES</th>
                            <th style='text-align: left; width: 150px;'>CLIENT</th>
                            <th style='text-align: left; width: 150px;'>AGENCY</th>
                            <th style='text-align: left; width: 150px;'># OF ISSUE</th>
                            <th style='text-align: left; width: 150px;'>AMOUNT</th>
                            <th style='text-align: center; width: 185px;'>STATUS</th>
                            <th style='text-align: center; width: 50px;'></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $n = 1;
                                $report_api = \App\Http\Controllers\AssemblyClass::get_reports_api();
                            ?>
                            @for($i = 0; $i < COUNT($booking); $i++)
                                <tr>
                                    <td style='text-align: center;'>{{ $n++ }}</td>
                                    <td style='text-align: left;'><a href = "{{ URL('/booking/magazine-transaction' . '/' . $booking[$i]->Id . '/' . $booking[$i]->magazine_country . '/' . $booking[$i]->client_id ) }}">{{ $booking[$i]->trans_num }}</a></td>
                                    <td style='text-align: left;'>{{ $booking[$i]->magazine_name }}</td>
                                    <td style='text-align: left;'>{{ $booking[$i]->sales_name }}</td>
                                    <td style='text-align: left;'>{{ $booking[$i]->client_name }}</td>
                                    <td style='text-align: left;'>{{ $booking[$i]->agency_name }}</td>
                                    <td style='text-align: left;'></td>
                                    <td style='text-align: left;'></td>
                                    <td style='text-align: left;'>
                                        @if($_COOKIE['role'] > 2)

                                            <select id="ddlStatus_{{ $booking[$i]->Id }}" {{ $booking[$i]->status == 4 ? "disabled" : "" }}>
                                                @if($booking[$i]->status == 4)
                                                    <option {{ $booking[$i]->status == 4 ? "selected=true" : "" }} value = "4">Declined</option>
                                                @else
                                                    <option {{ $booking[$i]->status == 1 ? "selected=true" : "" }} value = "1">Pending</option>
                                                    <option {{ $booking[$i]->status == 2 ? "selected=true" : "" }} value = "2">For Approval</option>
                                                @endif
                                            </select>

                                            @if($booking[$i]->status <= 2)
                                                <button id = "btn_update" onclick="update_status({{ $booking[$i]->Id  }})">Update</button>
                                            @endif

                                        @else
                                            <select id="ddlStatus_{{ $booking[$i]->Id }}">
                                                <option {{ $booking[$i]->status == 1 ? "selected=true" : "" }} value = "1">Pending</option>
                                                <option {{ $booking[$i]->status == 2 ? "selected=true" : "" }} value = "2">For Approval</option>
                                                <option {{ $booking[$i]->status == 3 ? "selected=true" : "" }} value = "3">Approved</option>
                                                <option {{ $booking[$i]->status == 4 ? "selected=true" : "" }} value = "4">Declined</option>
                                                <option {{ $booking[$i]->status == 5 ? "selected=true" : "" }} value = "5">Void</option>
                                            </select>
                                            <button id = "btn_update" onclick="update_status({{ $booking[$i]->Id  }})">Update</button>
                                        @endif

                                    </td>
                                    <td style='text-align: left;'>
                                        <a href = "http://{{ $report_api["Url_Port"] }}/kpa/work/transaction/generate/pdf/{{ $booking[$i]->trans_num }}" target = "_blank">Preview</a>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection