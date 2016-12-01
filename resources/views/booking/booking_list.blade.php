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
                
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                            <tr>
                                <th style='text-align: center; width: 40px;'>#</th>
                                <th style='text-align: left; width: 100px;'>TRANS#</th>
                                <th style='text-align: left; width: 100px;'>MAG NAME</th>
                                <th style='text-align: left; width: 100px;'>SALES</th>
                                <th style='text-align: left; width: 100px;'>CLIENT</th>
                                <th style='text-align: left; width: 100px;'>AGENCY</th>
                                <th style='text-align: center; width: 40px;'># OF ISSUE</th>
                                <th style='text-align: left; width: 100px;'>AMOUNT</th>
                                <th style='text-align: center; width: 280px;'>STATUS</th>
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
                                        <td style='text-align: left;'><a href = "{{ URL('/booking/magazine-transaction' . '/' . $booking[$i]->Id . '/' . $booking[$i]->magazine_country_name . '/' . $booking[$i]->client_id ) }}">{{ $booking[$i]->trans_num }}</a></td>
                                        <td style='text-align: left;'>{{ $booking[$i]->magazine_name }}</td>
                                        <td style='text-align: left;'>{{ $booking[$i]->sales_rep_name }}</td>
                                        <td style='text-align: left;'>{{ $booking[$i]->client_name }}</td>
                                        <td style='text-align: left;'>{{ $booking[$i]->agency_name }}</td>
                                        <td style='text-align: center;'>{{ $booking[$i]->number_of_issue }}</td>
                                        <td style='text-align: left;'>{{ $booking[$i]->total_amount }}</td>


                                    @if($_COOKIE['role'] > 2)
                                        <td style='text-align: right; width: 280px;'>
                                            <form class="form-inline">
                                                <div class="form-group">
                                                    <select style = "width: 150px;" class="form-control" id="ddlStatus_{{ $booking[$i]->Id }}" {{ ($booking[$i]->status == 5 OR $booking[$i]->status == 3)  ? "disabled" : "" }}>
                                                        @if($booking[$i]->status == 5)
                                                            <option value="0">Void</option>
                                                        @elseif($booking[$i]->status == 3)
                                                            <option value="0">Approved</option>
                                                        @else
                                                            <option {{ $booking[$i]->status == 1 ? "selected=true" : "" }} value="1">Pending</option>
                                                            <option {{ $booking[$i]->status == 2 ? "selected=true" : "" }} value="2">For Approval</option>
                                                            <optgroup label="----------">
                                                                <option value = "0">Preview</option>
                                                            </optgroup>
                                                        @endif
                                                    </select>
                                                    @if($booking[$i]->status == 5)
                                                        <a class="btn btn-primary" style = "width: 80px;" onclick="update_status('{{ $booking[$i]->Id  }}','{{ $booking[$i]->trans_num  }}')" style="margin-bottom: 0;">Preview</a>
                                                    @elseif($booking[$i]->status == 3)
                                                        <a class="btn btn-primary" style = "width: 80px;" onclick="update_status('{{ $booking[$i]->Id  }}','{{ $booking[$i]->trans_num  }}')" style="margin-bottom: 0;">Preview</a>
                                                    @else
                                                        <a class="btn btn-info" id="btn_update" style = "width: 80px;" onclick="update_status('{{ $booking[$i]->Id  }}','{{ $booking[$i]->trans_num  }}')" style="margin-bottom: 0;">Update</a>
                                                    @endif
                                                   </div>
                                            </form>
                                        </td>
                                    @else
                                    <td style='text-align: right; width: 280px;'>
                                        <div class="form-inline">
                                            <div class="form-group">
                                                <select style = "width: 150px;" class="form-control" id="ddlStatus_{{ $booking[$i]->Id }}">
                                                    <option {{ $booking[$i]->status == 1 ? "selected=true" : "" }} value = "1">Pending</option>
                                                    <option {{ $booking[$i]->status == 2 ? "selected=true" : "" }} value = "2">For Approval</option>
                                                    <option {{ $booking[$i]->status == 3 ? "selected=true" : "" }} value = "3">Approved</option>
                                                    {{--<option {{ $booking[$i]->status == 4 ? "selected=true" : "" }} value = "4">Declined</option>--}}
                                                    <option {{ $booking[$i]->status == 5 ? "selected=true" : "" }} value = "5">Void</option>
                                                    <optgroup label="----------">
                                                        <option value = "0">Preview</option>
                                                    </optgroup>
                                                </select>
                                                <button class="btn btn-info" id="btn_update" style = "width: 80px;" onclick="update_status('{{ $booking[$i]->Id  }}','{{ $booking[$i]->trans_num  }}')" style="margin-bottom: 0;">Update</button>
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
<script>
    function open_preview(trans_number)
    {
        window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/pdf/" + trans_number + "?show=preview",
                "mywindow","location=1,status=1,scrollbars=1,width=727,height=680");
    }
</script>
<script>

    update_status = function(control_id, trans_num) {

        var selected = $('#ddlStatus_' + control_id).val();

        if(selected == 0)
        {
            window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/pdf/" + trans_num + "?show=preview",
                    "mywindow","location=1,status=1,scrollbars=1,width=727,height=680");
        }
        else
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