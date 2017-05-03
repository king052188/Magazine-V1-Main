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
                                        <input type="text" placeholder="Enter Position" class="form-control" name="digital_type" id="digital_type" required>
                                        <input type="hidden" class="form-control" id="digital_uid" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="ex2">Size</label>
                                        <input type="text" placeholder="Enter Size" class="form-control" name="digital_size" id="digital_size" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" placeholder="Enter Amount" class="form-control" name="digital_amount" id="digital_amount" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="ex2">Frequency</label>
                                        <select class="form-control" name = "digital_issue" id = "digital_issue" required>
                                            <option value = "">-- Select --</option>
                                            <option value = "1">Monthly</option>
                                            <option value = "2">Weekly</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                        <input type = "submit" id = "add_digital" class = "btn btn-primary pull-right" style = "width: 100px;" value = "Add">
                                        <a id = "update_digital" class = "btn btn-primary pull-right" style = "display: none; width: 100px;">Update</a>
                                        <a id = "cancel_digital" class = "btn btn-danger pull-right" style = "display: none; width: 100px; margin-right: 5px;">Cancel</a>
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
                        {{--@if(Session::has('success'))--}}
                            {{--<div class="alert alert-success alert-dismissable">--}}
                                {{--<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>--}}
                                {{--{{ Session::get('success') }}--}}
                            {{--</div>--}}
                        {{--@endif--}}
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
                                        <th style="text-align: center;"></th>
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
    {{--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}
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

                            //var n_issue = "Monthly & Weekly";
                            if(tran.ad_issue == 1){
                                var n_issue = "Monthly";
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
                            html_thmb += "<td style='text-align: center;'><a id = 'edit_digital_settings' data-target = '"+ tran.Id +"' class = 'btn btn-primary' style = 'height: 25px; padding: 2px 5px 2px 5px; margin-right: 5px; width: 70px;'>Edit</a><a id = 'delete_digital_settings' data-target = '"+ tran.Id +"' class = 'btn btn-danger' style = 'height: 25px; padding: 2px 5px 2px 5px; width: 70px;'>Delete</a></td>";
                            html_thmb += "</tr>";
                        });
                    }

                    $('table#info_table > tbody').empty().prepend(html_thmb);
                }
            });
        }

        $("#info_table").on("click", "#edit_digital_settings", function(){

            var digital_uid = $(this).attr("data-target");

            $.ajax({
                url: "/magazine/digital/settings/edit/" + digital_uid,
                dataType: "text",
                success: function(data) {
                    var json = $.parseJSON(data);
                    if(json == null)
                        return false;

                    if(json.status == 200){
                        $("#digital_uid").val(json.Id);
                        $("#digital_type").val(json.ad_type);
                        $("#digital_size").val(json.ad_size);
                        $("#digital_amount").val(json.ad_amount);
                        $("#digital_issue").val(json.ad_issue);

                        $("#update_digital").show();
                        $("#cancel_digital").show();
                        $("#add_digital").hide();
                    }
                }
            });
        });

        $("#info_table").on("click", "#delete_digital_settings", function(){

            var digital_uid = $(this).attr("data-target");

            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then(function() {

                $.ajax({
                    url: "/magazine/digital/settings/delete/" + digital_uid,
                    dataType: "text",
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if(json == null)
                            return false;

                        if(json.status == 200){

                            swal(
                                    '',
                                    'Delete Successful!',
                                    'success'
                            ).then(
                                    function () {
                                        location.reload();
                                    }
                            )
                        }
                    }
                });

            }, function(dismiss) {
                if (dismiss === 'cancel') {
                    swal(
                        'Cancelled',
                        'Your data file is safe :)',
                        'error'
                    )
                }
            })
        });

        $("#update_digital").click(function(){
            var digital_uid = $("#digital_uid").val();
            var digital_type = $("#digital_type").val();
            var digital_size = $("#digital_size").val();
            var digital_amount = $("#digital_amount").val();
            var digital_issue = $("#digital_issue").val();

            $.ajax({
                url: "/magazine/digital/settings/update/" + digital_uid + "/" + digital_type + "/" + digital_size + "/" + digital_amount + "/" + digital_issue,
                dataType: "text",
                success: function(data) {
                    var json = $.parseJSON(data);
                    if(json == null)
                        return false;

                    if(json.status == 200){

                        swal(
                                '',
                                'Update Successful!',
                                'success'
                        ).then(
                                function () {
                                    location.reload();
                                }
                        )
                    }
                }
            });

            $("#update_digital").hide();
            $("#cancel_digital").hide();
            $("#add_digital").show();
        });

        $("#cancel_digital").click(function(){
            $("#digital_type").val("");
            $("#digital_size").val("");
            $("#digital_amount").val("");
            $("#digital_issue").val("");

            $("#update_digital").hide();
            $("#cancel_digital").hide();
            $("#add_digital").show();
        });
    </script>
@endsection