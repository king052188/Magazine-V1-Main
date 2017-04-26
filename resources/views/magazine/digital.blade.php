@extends('layout.magazine_main')

@section('title')
    Add New Magazine
@endsection

@section('styles')

@endsection

@section('magazine_content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>{{ $mag[0]->magazine_name }}</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Digital Magazine Settings</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-4">
            {{--<div class="title-action">--}}
            {{--<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal_add_company_magazine">Add New Company</a>--}}
            {{--</div>--}}
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div id="tab_1" class="col-lg-4">
                <form role="form" action="{{ URL('/magazine/digital/settings/save') . '/' . $mag[0]->Id }}" method="POST">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Create Digital Magazine Settings<small> *all fields are required</small></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="ex2">Position</label>
                                        <input type="text" placeholder="Enter Position" class="form-control" name="digital_type">
                                    </div>
                                    <div class="form-group">
                                        <label for="ex2">Size</label>
                                        <input type="text" placeholder="Enter Size" class="form-control" name="digital_size">
                                    </div>

                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="text" placeholder="Enter Amount" class="form-control" name="digital_amount">
                                    </div>
                                    <div class="form-group">
                                        <label for="ex2">Frequency</label>
                                        <select class="form-control" name = "digital_issue">
                                            <option value = "0">-- Select --</option>
                                            <option value = "1">Monthly</option>
                                            <option value = "2">Weekly</option>
                                            <option value = "3">Both</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                        <input type = "submit" class = "btn btn-primary pull-right" value = "Add">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Magazine List</h5>
                    </div>
                    <div class="ibox-content">
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="table-responsive">

                            <div class="col-lg-12">
                                <table class="table table-striped table-bordered" id = "info_table">
                                    <thead>
                                    <tr>
                                        <th data-toggle="true" style="width: 50px; text-align: center;">#</th>
                                        <th style="text-align: center;">Magazine Name</th>
                                        <th style="text-align: center;">Position</th>
                                        <th style="width: 100px; text-align: center;">Size</th>
                                        <th style="width: 100px; text-align: center;">Amount</th>
                                        <th style="width: 150px; text-align: center;">Frequency</th>
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
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script>
        $(document).ready(function(){
            get_info({{ $mag[0]->Id }});
        });

        function get_info(mag_uid){
            var html_thmb = "";
            $.ajax({
                url: "/magazine/digital/settings/info/" + mag_uid,
                dataType: "text",
                beforeSend: function () {
                    $('table#info_table > tbody').empty().prepend('<tr> <td colspan="6" style="text-align: center; font-size: 15px; padding-top: 20px;"> <img src="{{ asset('img/ripple.gif') }}"  /> <br /> Fetching All Data... Please wait...</td> </tr>');
                },
                success: function(data) {
                    var json = $.parseJSON(data);
                    if(json == null)
                        return false;

                    if(json.Code == 404){
                        $('table#info_table > tbody').empty().prepend('<tr> <td colspan="6" style="text-align: center; font-size: 15px; padding-top: 20px;"> No Data Available</td> </tr>');
                        return false;
                    }

                    if(json.Code == 200){
                        var count = 1;
                        $(json.Result).each(function(i, tran){

                            var n_issue = "Monthly & Weekly";
                            if(tran.ad_issue == 1){
                                n_issue = "Monthly";
                            }else if(tran.ad_issue == 2){
                                n_issue = "Weekly";
                            }

                            html_thmb += "<tr>";
                            html_thmb += "<td style='font-weight: normal; text-align: center;'>"+ count++ +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.magazine_name +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.ad_type +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.ad_size +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.ad_amount +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ n_issue +"</td>";
                            html_thmb += "</tr>";
                        });
                    }

                    $('table#info_table > tbody').empty().prepend(html_thmb);
                }
            });
        }
    </script>
@endsection