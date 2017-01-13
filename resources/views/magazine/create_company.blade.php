@extends('layout.magazine_main')

@section('title')
    Add New Company
@endsection

@section('styles')
@endsection

@section('magazine_content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Company</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Add Company</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    {!! Session::get('success') !!}
                </div>
            @endif
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#list_publishers" id = "list_publishers_press"> List Publishers</a></li>
                    <li class=""><a data-toggle="tab" href="#add_publishers" id = "add_publishers_press">Add Publisher</a></li>
                </ul>
                <div class="tab-content">
                    <div id="list_publishers" class="tab-pane active">
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover table-responsive" id = "tbl_publisher" >
                                <thead>
                                <tr>
                                    <th style = "text-align: center;">Publisher Name</th>
                                    <th style = "text-align: center;">City</th>
                                    <th style = "text-align: center;">State</th>
                                    <th style = "text-align: center;">Country</th>
                                    <th style = "text-align: center;">Status</th>
                                    <th style="width:150px;">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $n = 1; ?>
                                @for($i = 0; $i < COUNT($result); $i++)
                                    <tr>
                                        <td style="padding-top: 15px;">{{ $result[$i]->company_name }}</td>
                                        <td style="padding-top: 15px;">{{ $result[$i]->city }}</td>
                                        <td style="padding-top: 15px;">{{ $result[$i]->state }}</td>
                                        <td style="text-align: center;padding-top: 15px;">
                                            @if($result[$i]->country == 1)
                                                USA
                                            @else
                                                CANADA
                                            @endif
                                        </td>
                                        <td style="text-align: center;padding-top: 15px;">
                                            @if($result[$i]->status == 1)
                                                <b style = "color: #FF0000;">In-Active</b>
                                            @else
                                                Active
                                            @endif
                                        </td>
                                        <td>
                                            <select class = "form-control" id = "action_publisher_{{ $result[$i]->Id }}">
                                                <option value = "">--select--</option>
                                                <option value = "1:{{ $result[$i]->Id }}">View Information</option>
                                                <option value = "2:{{ $result[$i]->Id }}">Edit Information</option>
                                                @if($result[$i]->status == 2)
                                                <option value = "3:{{ $result[$i]->Id }}">Set as Inactive</option>
                                                @else
                                                <option value = "4:{{ $result[$i]->Id }}">Set as Active</option>
                                                @endif
                                            </select>
                                        </td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="add_publishers" class="tab-pane">
                        <div class="panel-body">
                            <form role="form" action="{{ url('/magazine/company/save') }}" method="post">
                                <div class="col-lg-12">
                                    <h3>Company Name of Magazine</h3>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Publisher Name</label>
                                            <input type="text" placeholder="Publisher / Business Name" class="form-control"  name="company_name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Address 1</label>
                                            <input type="text" placeholder="Address 1" class="form-control" name="address_1">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Address 2 (Optional)</label>
                                            <input type="text" placeholder="Address 2 (Optional)" class="form-control" name="address_2">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" placeholder="City" class="form-control"  name="city">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>State/Province</label>
                                            <input type="text" placeholder="State" class="form-control"  name="state">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <select class="form-control" name="country">
                                                <option value="1">USA</option>
                                                <option value="2">CANADA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" placeholder="Email" class="form-control"  name="email">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" placeholder="Phone" class="form-control"  name="phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Fax</label>
                                            <input type="text" placeholder="Fax" class="form-control"  name="fax">
                                        </div>
                                    </div>
                                </div>
                                <div class = "col-lg-12">
                                    <div class="form-group">
                                        <input type = "hidden" name = "logo_uid" value = "{{ $logo_uid['id_company'] }}">
                                        <?php
                                        $assembly = new \App\Http\Controllers\AssemblyClass();
                                        $url_api = $assembly::get_reports_api();
                                        $logo_uploader_url = 'http://'. $url_api["Url_Logo_Uploader"] .'type=COMPANY&uid='. $logo_uid['id_company'];
                                        ?>
                                        <iframe src = "{{ $logo_uploader_url }}" style="width: 100%; height: 360px" frameborder="0" scrolling="no"> </iframe>
                                    </div>
                                </div>
                                <div class = "col-lg-12">
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <button class="btn btn-primary pull-right" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="view_publisher_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Edit Publisher</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Publisher Name</label>
                                    <input type="hidden" class="form-control"  id = "e_publisher_uid" name="e_publisher_uid">
                                    <input type="text" placeholder="Publisher / Business Name" class="form-control"  id = "e_company_name" name="e_company_name" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Address 1</label>
                                    <input type="text" placeholder="Address 1" class="form-control" id = "e_address_1" name="e_address_1" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Address 2 (Optional)</label>
                                    <input type="text" placeholder="Address 2 (Optional)" class="form-control" id = "e_address_2" name="e_address_2" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" placeholder="City" class="form-control"  id = "e_city" name="e_city" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>State/Province</label>
                                    <input type="text" placeholder="State" class="form-control"  id = "e_state" name="e_state" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control" id = "e_country" name="e_country" disabled>
                                        <option value="1">USA</option>
                                        <option value="2">CANADA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" placeholder="Email" class="form-control"  id = "e_email" name="e_email" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" placeholder="Phone" class="form-control"  id = "e_phone" name="e_phone" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Fax</label>
                                    <input type="text" placeholder="Fax" class="form-control"  id = "e_fax" name="e_fax" readonly>
                                </div>
                            </div>
                        </div>
                        <div style = "clear: both;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style = "margin-right: 5px;">Close</button>
                    </div>
                </div>
        </div>
    </div>

    <div class="modal fade" id="edit_publisher_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form role="form" action="{{ url('/magazine/update/save') }}" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Edit Publisher</h4>
                    </div>
                    <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Publisher Name</label>
                                        <input type="hidden" class="form-control"  id = "e_publisher_uid" name="e_publisher_uid">
                                        <input type="text" placeholder="Publisher / Business Name" class="form-control"  id = "e_company_name" name="e_company_name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Address 1</label>
                                        <input type="text" placeholder="Address 1" class="form-control" id = "e_address_1" name="e_address_1">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Address 2 (Optional)</label>
                                        <input type="text" placeholder="Address 2 (Optional)" class="form-control" id = "e_address_2" name="e_address_2">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" placeholder="City" class="form-control"  id = "e_city" name="e_city">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>State/Province</label>
                                        <input type="text" placeholder="State" class="form-control"  id = "e_state" name="e_state">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select class="form-control" id = "e_country" name="e_country">
                                            <option value="1">USA</option>
                                            <option value="2">CANADA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" placeholder="Email" class="form-control"  id = "e_email" name="e_email">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" placeholder="Phone" class="form-control"  id = "e_phone" name="e_phone">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Fax</label>
                                        <input type="text" placeholder="Fax" class="form-control"  id = "e_fax" name="e_fax">
                                    </div>
                                </div>
                            </div>
                            <div class = "col-lg-12">
                                <div class="form-group">
                                    <input type = "hidden" id = "e_logo_uid" name = "e_logo_uid" value = "{{ $logo_uid['id_company'] }}">
                                    <?php
                                    $assembly = new \App\Http\Controllers\AssemblyClass();
                                    $url_api = $assembly::get_reports_api();
                                    $logo_uploader_url = 'http://'. $url_api["Url_Logo_Uploader"] .'type=COMPANY&uid='. $logo_uid['id_company'];
                                    ?>
                                    <iframe src = "{{ $logo_uploader_url }}" style="width: 100%; height: 360px" frameborder="0" scrolling="no"> </iframe>
                                </div>
                            </div>
                            <div style = "clear: both;"></div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <button class="btn btn-primary pull-right" type="submit">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style = "margin-right: 5px;">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $("#tbl_publisher > tbody  > tr").change(function(){
                var value =  $(this).find('select:first').val();
                var values = value.split(":");

                if(values[0] == 1){
//                    console.log("View Info");
                    $('#view_publisher_modal').modal({
                        show: true
                    });

                }else if(values[0] == 2){
                    $('#edit_publisher_modal').modal({
                        show: true
                    });

                    var publisher_uid = values[1];
                    $.ajax({
                        url: "/magazine/list/publisher/" + publisher_uid,
                        dataType: "text",
                        beforeSend: function () {
                        },
                        success: function(data) {
                            var json = $.parseJSON(data);
                            if(json == null)
                                return false;

                            if(json.status == 200)
                            {
                                $(json.result).each(function(i, info){

                                    $("#e_publisher_uid").val(info.Id);
                                    $("#e_company_name").val(info.company_name);
                                    $("#e_address_1").val(info.address_1);
                                    $("#e_address_2").val(info.address_2);
                                    $("#e_city").val(info.city);
                                    $("#e_state").val(info.state);
                                    $("#e_country").val(info.country);
                                    $("#e_email").val(info.email);
                                    $("#e_phone").val(info.phone);
                                    $("#e_fax").val(info.fax);
                                    $("#e_logo_uid").val(info.logo_uid);

                                });
                            }
                        }
                    });

                }else if(values[0] == 3){
                    //console.log("Delete Info");
                    var publisher_uid = values[1]
                    $.ajax({
                        url: "/magazine/set/inactive/status/publisher/" + publisher_uid,
                        dataType: "text",
                        beforeSend: function () {
                        },
                        success: function(data) {
                            var json = $.parseJSON(data);
                            if(json == null)
                                return false;

                            if(json.status == 200)
                            {
                                swal(
                                    '',
                                    'Status Change to <b style = "color: #FF0000;">In-Active</b>!',
                                    'success'
                                ).then(
                                        function () {
                                            location.reload();
                                        }
                                )
                            }
                        }
                    });
                }else if(values[0] == 4){
                    //console.log("Delete Info");
                    var publisher_uid = values[1]
                    $.ajax({
                        url: "/magazine/set/active/status/publisher/" + publisher_uid,
                        dataType: "text",
                        beforeSend: function () {
                        },
                        success: function(data) {
                            var json = $.parseJSON(data);
                            if(json == null)
                                return false;

                            if(json.status == 200)
                            {
                                swal(
                                        '',
                                        'Status Change to Active!',
                                        'success'
                                ).then(
                                        function () {
                                            location.reload();
                                        }
                                )
                            }
                        }
                    });
                }

            });
        });
    </script>
@endsection