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
                <div class = "pull-right">
                    <select class="form-control" id = "filter" style = "margin-top: -7px;">
                        <option disabled>--select--</option>
                        <option value = "" {{ $filter == "" ? "selected" : "" }}>All</option>
                        <option value = "1" {{ $filter == 1 ? "selected" : "" }}>Pending</option>
                        <option value = "2" {{ $filter == 2 ? "selected" : "" }}>For Approval</option>
                        <option value = "3" {{ $filter == 3 ? "selected" : "" }}>Approved</option>
                        <option value = "5" {{ $filter == 5 ? "selected" : "" }}>Void</option>
                    </select>
                </div>
                <div style = "float: right; margin-right: 5px; font-size: 15px;"><label>Sort by:</label></div>
            </div>

            <div class="ibox-content">

                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    {{ Session::get('success') }}
                </div>
                @endif

                <div class="table-responsive">
                    <table id="tbl_booking_lists" class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                <th style='text-align: center; width: 5%;'>#</th>
                                <th style='text-align: left; width: 10%;'>Magazine Name</th>
                                <th style='text-align: left; width: 10%;'>Sales Rep</th>
                                <th style='text-align: left; width: 10%;'>Client</th>
                                <th style='text-align: left; width: 15%;'>Agency</th>
                                <th style='text-align: center; width: 5%;'>Line Item</th>
                                <th style='text-align: center; width: 20%;'>Status / Action</th>
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
                                        <td style='text-align: left;'><a href = "{{ URL('/booking/magazine-transaction' . '/' . $booking[$i]->Id . '/' . $booking[$i]->magazine_country_id . '/' . $booking[$i]->client_id ) }}">{{ $booking[$i]->magazine_name . " ( " . $booking[$i]->magazine_issues . "-" . $booking[$i]->magazine_year . " )" }}</a></td>
                                        <td style='text-align: left;'>{{ $booking[$i]->sales_rep_name }}</td>
                                        <td style='text-align: left;'>{{ $booking[$i]->client_name }}</td>
                                        <td style='text-align: left;'>{{ $booking[$i]->agency_name == null ? "NONE" : $booking[$i]->agency_name  }}</td>
                                        <td style='text-align: center;'>{{ $booking[$i]->number_of_issue }}</td>
                                    @if($_COOKIE['role'] > 2)
                                        <td style='text-align: right; width: 280px;'>
                                            <form class="form-inline">
                                                <div class="form-group">
                                                    <select style = "width: 150px;" class="form-control" id="ddlStatus_{{ $booking[$i]->Id }}" {{ ($booking[$i]->status == 5 OR $booking[$i]->status == 3)  ? "disabled" : "" }}>
                                                        <optgroup label="-- Status --"> -- Status -- </optgroup>
                                                        @if($booking[$i]->status == 5)
                                                            <option value="0">Void</option>
                                                        @elseif($booking[$i]->status == 3)
                                                            <option value="0">Approved</option>
                                                        @else
                                                            <option {{ $booking[$i]->status == 1 ? "selected=true" : "" }} value="1">Pending</option>
                                                            <option {{ $booking[$i]->status == 2 ? "selected=true" : "" }} value="2">For Approval</option>
                                                            <optgroup label="-- Action --"> -- Action -- </optgroup>
                                                                <option value = "-1:{{ $booking[$i]->trans_num  }}">Preview</option>
                                                                <option value = "-2:{{ $booking[$i]->trans_num  }}">View As Client</option>
                                                            </optgroup>
                                                        @endif
                                                    </select>
                                                    @if($booking[$i]->status == 5)
                                                        <a class="btn btn-primary" style = "width: 80px; margin-bottom: 0px;" onclick="update_status('{{ $booking[$i]->Id  }}','{{ $booking[$i]->trans_num  }}')" style="margin-bottom: 0;">Preview</a>
                                                    @elseif($booking[$i]->status == 3)
                                                        <a class="btn btn-primary" style = "width: 80px; margin-bottom: 0px;" onclick="update_status('{{ $booking[$i]->Id  }}','{{ $booking[$i]->trans_num  }}')" style="margin-bottom: 0;">Preview</a>
                                                    @else
                                                        <a class="btn btn-info" id="btn_update" style = "width: 80px; margin-bottom: 0px;" onclick="update_status('{{ $booking[$i]->Id  }}','{{ $booking[$i]->trans_num  }}')" style="margin-bottom: 0;">Update</a>
                                                    @endif
                                                   </div>
                                            </form>
                                        </td>
                                    @else
                                    <td style='text-align: center; width: 280px;'>
                                        <div class="form-inline">
                                            <div class="form-group">
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuDivider">
                                              ...
                                              <li role="separator" class="divider"></li>
                                              ...
                                            </ul>
                                                <select style = "width: 150px;" class="form-control" id="ddlStatus_{{ $booking[$i]->Id }}">
                                                    <optgroup label="-- Status --"> -- Status -- </optgroup>
                                                    <option {{ $booking[$i]->status == 1 ? "selected=true" : "" }} value = "1">Pending</option>
                                                    <option {{ $booking[$i]->status == 2 ? "selected=true" : "" }} value = "2">For Approval</option>
                                                    <option {{ $booking[$i]->status == 3 ? "selected=true" : "" }} value = "3">Approved</option>
                                                    {{--<option {{ $booking[$i]->status == 4 ? "selected=true" : "" }} value = "4">Declined</option>--}}
                                                    <option {{ $booking[$i]->status == 5 ? "selected=true" : "" }} value = "5">Void</option>
                                                    <optgroup label="-- Action --"> -- Action -- </optgroup>
                                                    <option value = "-1:{{ $booking[$i]->trans_num  }}">Preview</option>
                                                    <option value = "-2:{{ $booking[$i]->trans_num  }}">View As Client</option>
                                                    </optgroup>
                                                </select>
                                                <button class="btn btn-primary" id="btn_update" style = "width: 80px;margin-bottom: 0px;" onclick="update_status('{{ $booking[$i]->Id  }}','{{ $booking[$i]->trans_num  }}')" style="margin-bottom: 0;">Update</button>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
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

@section('scripts')

<script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
<script>

$(document).ready(function(){
    $('.dataTables-example').DataTable({
        dom: '<"html5buttons"B>lTfgitp',
        buttons: []
    });

});



    function open_preview(trans_number)
    {
        window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/pdf/" + trans_number + "?show=preview",
                "mywindow","location=1,status=1,scrollbars=1,width=727,height=680");
    }


    $(document).ready( function() {

        $("#filter").on('change', function(){
            window.location.href = "/booking/booking-list/" + $(this).val();
        });

        $("#tbl_booking_lists > tbody  > tr").change(function(){
            var value =  $(this).find('select:first').val();
            var values = value.split(":");

            if(values.length > 1) {
                var str_to_int = parseInt(values[0]);
                var trans_num = values[1];

                if(str_to_int == -1) {
                    window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/pdf/" + trans_num + "?show=preview",
                            "mywindow","location=1,status=1,scrollbars=1,width=727,height=680");
                }
                if(str_to_int == -2) {
                    window.open("http://"+ Url_Client_Dashboard + trans_num,'_blank');

                }
            }
        });
    } );

    update_status = function(control_id, trans_num) {

        var selected = $('#ddlStatus_' + control_id).val();

        var str_to_int = parseInt(selected);

        if(str_to_int > 0)
        {
            var url = "/transaction/update/row/"+ control_id +"/"+ selected;

            $(document).ready( function() {
                $.ajax({
                    url: url,
                    dataType: "text",
                    beforeSend: function () {

                    },
                    success: function(data) {
                        var json = $.parseJSON(data);

                        if(json.status == 200)
                        {
                            alert("Update was successful");
                            location.reload();
                        }
                    }
                });
            } );
        }
    }


</script>
@endsection