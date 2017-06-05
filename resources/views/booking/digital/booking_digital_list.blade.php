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
                            <select class="form-control chosen-select filter_click" style="background-color: #2f4050; color: #FFFFFF;" id = "filter_publication">
                                <option value = "0" {{ $filter_publication == "0" ? "selected" : "" }}>-- and/or Publication --</option>
                                @for($i = 0; $i < COUNT($publication); $i++)
                                    <option value = "{{ $publication[$i]->Id }}" {{ $filter_publication == $publication[$i]->Id ? "selected" : "" }}>{{ $publication[$i]->magazine_name }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class = "pull-left" style = "margin-left: 10px;">
                            <select class="form-control chosen-select filter_click" id = "filter_client">
                                <option value = "0" {{ $filter_client == "0" ? "selected" : "" }}>-- and/or Client --</option>
                                @for($i = 0; $i < COUNT($clients); $i++)
                                    <option value = "{{ $clients[$i]->Id }}" {{ $filter_client == $clients[$i]->Id ? "selected" : "" }}>{{ $clients[$i]->company_name }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class = "pull-left" style = "margin-left: 10px;">
                            <button class="btn btn-info" id = "btn_filter_display" style = "height: 30px;"><i class="fa fa-search"></i> Search</button>
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
                                        <th style='text-align: center; width: 40px;'>#</th>
                                        <th style='text-align: center;'>Publication</th>
                                        <th style='text-align: center; width: 200px;'>Sales</th>
                                        <th style='text-align: center; width: 200px;'>Client</th>
                                        <th style='text-align: center; width: 200px;'>Line Items</th>
                                        <th style='text-align: right; width: 90px;'>Amount</th>
                                        <th style='text-align: center; width: 140px;'>Date Created</th>
                                        <th style='text-align: center; width: 150px;'>Status/Action</th>
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

            get_digital_transaction(0, 0);

            console.log("ok");

            $("#btn_filter_display").click(function(){
                var publication = $("#filter_publication").val();
                var client = $("#filter_client").val();
                get_digital_transaction(publication, client);
            });
        });

        function get_digital_transaction(publication, client){
            var table = "";
            var count = 1;

            $.ajax({
                url: "/mjt/booking/get/digital-list/" + publication + "/" + client,
                dataType: "text",
                beforeSend: function(){
                    $('table#tbl_booking_digital_lists > tbody').empty().prepend('<tr> <td colspan="8" style="text-align: center;"> <img src="{{ asset('img/ripple.gif') }}" style="width: 90px;"  />  Fetching All Transactions... Please wait...</td> </tr>');
                },
                success: function(data) {
                    var json = $.parseJSON(data);
                    if(json == null) return false;

                    console.log(json);

                    if(json.Code == 404){
                        $('table#tbl_booking_digital_lists > tbody').empty().prepend('<tr> <td colspan="8" style="text-align: center; font-size: 20px;"> No Result Found</td> </tr>');
                        return false;
                    }

                    if(json.Code == 200){
                        $(json.Result).each(function(i, tran){

                            table += '<tr>';
                            table += '<td style="text-align: center;">'+ count++ +'</td>';
                            table += '<td style="text-align: center;">'+ tran.mag_name +'</td>';
                            table += '<td style="text-align: center;">'+ tran.sales_rep_name +'</td>';
                            table += '<td style="text-align: center;">'+ tran.client_name +'</td>';
                            table += '<td style="text-align: center;">'+ tran.line_item +'</td>';
                            table += '<td style="text-align: right;">'+ tran.amount +'</td>';
                            table += '<td style="text-align: center;">'+ tran.created_at +'</td>';

                            var url = "/booking/digital/add_issue/" + tran.Id+ "/" +tran.client_id;

                            table += '<td style="text-align: center;">Pending | <a href="'+url+'" class="btn btn-primary" style="padding: 5px 7px 5px 7px; "><i class="fa fa-list-alt"></i>&nbsp;&nbsp;View</a></td>';
                            table += '</tr>';
                        })

                        $("table#tbl_booking_digital_lists > tbody").empty().append(table).trigger('footable_initialize');
                    }
                }
            })
        }
    </script>
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





























































































