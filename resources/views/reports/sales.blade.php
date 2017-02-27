@extends('layout.magazine_main')

@section('title')
    Reports
@endsection

@section('styles')
    <link href="{{  asset('css/plugins/chosen/chosen.css')  }}" rel="stylesheet">
@endsection

@section('magazine_content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Reports</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Generate your reports</strong>
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
                            <select class="form-control chosen-select filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "filter_publication">
                                <option value = "0" {{ $filter_publication == "0" ? "selected" : "" }}>-- and/or Publication --</option>
                                @for($i = 0; $i < COUNT($publication); $i++)
                                    <option value = "{{ $publication[$i]->Id }}" {{ $filter_publication == $publication[$i]->Id ? "selected" : "" }}>{{ $publication[$i]->magazine_name }}</option>
                                @endfor
                            </select>
                        </div>
                        @if($_COOKIE['role'] != 3)
                            <div class = "pull-left" style = "margin-left: 10px;">
                                <select class="form-control filter_click" id = "filter_sales_rep" style = "background-color: #2f4050; height:30px; color: #FFFFFF;">
                                    <option value = "0" {{ $filter_sales_rep == "0" ? "selected" : "" }}>-- and/or Sales Rep --</option>
                                    @for($i = 0; $i < COUNT($sales_rep); $i++)
                                        <option value = "{{ $sales_rep[$i]->Id }}" {{ $filter_sales_rep == $sales_rep[$i]->Id ? "selected" : "" }}>{{ $sales_rep[$i]->first_name . " " . $sales_rep[$i]->last_name }}</option>
                                    @endfor
                                </select>
                            </div>
                        @endif
                        <div class = "pull-left" style = "margin-left: 10px;">
                            <select class="form-control chosen-select filter_click" id = "filter_client">
                                <option value = "0" {{ $filter_client == "0" ? "selected" : "" }}>-- and/or Client --</option>
                                @for($i = 0; $i < COUNT($clients); $i++)
                                    <option value = "{{ $clients[$i]->Id }}" {{ $filter_client == $clients[$i]->Id ? "selected" : "" }}>{{ $clients[$i]->company_name }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class = "pull-left" style = "margin-left: 10px;">
                            <select class="form-control filter_click" id = "filter_status" style = "background-color: #2f4050; height: 30px; color: #FFFFFF;">
                                <option value = "0" {{ $filter_status == 0 ? "selected" : "" }}>-- and/or Status --</option>
                                <option value = "1" {{ $filter_status == 1 ? "selected" : "" }}>Pending</option>
                                <option value = "2" {{ $filter_status == 2 ? "selected" : "" }}>For Approval</option>
                                <option value = "3" {{ $filter_status == 3 ? "selected" : "" }}>Approved</option>
                                <option value = "5" {{ $filter_status == 5 ? "selected" : "" }}>Void</option>
                            </select>
                        </div>
                        <div class="pull-left" style = "margin-left: 30px;">
                            <b>From:</b>
                            <input size="16" type="date" value="" style = "background-color: #2f4050; height: 30px; color: #FFFFFF;">
                        </div>
                        <div class="pull-left" style = "margin-left: 10px;">
                            <b>To</b>
                            <input size="16" type="date" value="" style = "background-color: #2f4050; height: 30px; color: #FFFFFF;">
                        </div>
                        <div class = "pull-left" style = "margin-left: 10px;">
                            <button class="btn btn-info" id = "btn_filter_display" style = "height: 30px;"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table id="tbl_booking_lists" class="footable table" data-sorting="true" data-page-size="10">
                                <thead>
                                <tr>
                                    <th style='text-align: center; width: 50px;'>#</th>
                                    <th style='text-align: center;'>Publication</th>
                                    <th style='text-align: center; width: 150px;'>Sales</th>
                                    <th style='text-align: center; width: 150px;'>Client</th>
                                    <th style='text-align: center; width: 100px;'>Line Items</th>
                                    <th style='text-align: center; width: 100px;'>Qty</th>
                                    <th style='text-align: right; width: 100px;'>Amount</th>
                                    <th style='text-align: center; width: 130px;'>Date Created</th>
                                    <th style='text-align: center; width: 80px;'>Status/Action</th>
                                    <th style='text-align: center; width: 50px;'></th>
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

    <!-- Chosen -->
    <script src="{{ asset('js/plugins/chosen/chosen.jquery.js') }}"></script>
    <script>
        var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : {allow_single_deselect:true},
            '.chosen-select-no-single' : {disable_search_threshold:10},
            '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'}
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }
    </script>
@endsection