@extends('layout.magazine_main')

@section('title')
    Magazines List
@endsection

@section('styles')
    {{--<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">--}}
    <link href="{{  asset('css/plugins/chosen/chosen.css')  }}" rel="stylesheet">
@endsection

@section('magazine_content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Booking</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Booking Digital List</strong>
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
                    <div class="ibox-title" style="height: 65px; padding: 20px;">
                        <h5>Filter By:</h5>
                        <div class = "pull-left" style = "margin-left: 10px;">
                            <select>
                                <option>Hello World</option>
                            </select>
                        </div>
                    </div>

                    <div class="ibox-content">

                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            {{--<table id="tbl_booking_lists" class="footable table table-stripped toggle-arrow-tiny" data-page-size="10" >--}}
                            <table id="tbl_booking_digital_lists" class="footable table" data-sorting="true" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th style='text-align: left;'>#</th>
                                        <th style='text-align: left;'>Magazine ID</th>
                                        <th style='text-align: left;'>Client ID</th>
                                        <th style='text-align: left;'>Position ID</th>
                                        <th style='text-align: left;'>Month ID</th>
                                        <th style='text-align: left;'>Week ID</th>
                                        <th style='text-align: left;'>Year</th>
                                        <th style='text-align: left;'>Amount</th>
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            get_digital_transaction();
        });

        function get_digital_transaction(){
            var table = "";
            var count = 1;
            $.ajax({
                url: "/api/booking/get/digital-list",
                dataType: "text",
                success: function(data) {
                    var json = $.parseJSON(data);
                    if(json == null) return false;

                    if(json.Code == 200){
                        $(json.Result).each(function(i, tran){

                            var month;
                            var monthly = tran.month_id;
                            switch (monthly) {
                                case 1: month = "January"; break;
                                case 2: month = "February"; break;
                                case 3: month = "March"; break;
                                case 4: month = "April"; break;
                                case 5: month = "May"; break;
                                case 6: month = "June"; break;
                                case 7: month = "July"; break;
                                case 8: month = "August"; break;
                                case 9: month = "September"; break;
                                case 10: month = "October"; break;
                                case 11: month = "November"; break;
                                case 12: month = "December"; break;
                                default: month = "--";
                            }

                            var weekly = tran.week_id == 0 ? '--' : 'Week ' + tran.week_id;


                            table += '<tr>';
                            table += '<td>'+ count++ +'</td>';
                            table += '<td>'+ tran.magazine_name +'</td>';
                            table += '<td>'+ tran.company_name +'</td>';
                            table += '<td>'+ tran.position_id +'</td>';
                            table += '<td>'+ month +'</td>';
                            table += '<td>'+ weekly +'</td>';
                            table += '<td>'+ tran.year +'</td>';
                            table += '<td>'+ tran.amount +'</td>';
                            table += '</tr>';
                        })

                        $("table#tbl_booking_digital_lists > tbody").empty().append(table).trigger('footable_initialize');
                    }
                }
            })
        }
    </script>
@endsection





























































































