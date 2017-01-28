@extends('layout.magazine_main')

@section('title')
    Add New Client
@endsection

@section('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <style>
        .content.clearfix{
            height: 520px;
        }

        .ibox-content{
            height: 610px;
        }
    </style>

@endsection

@section('magazine_content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>
                <strong> Company: </strong> {{ $company[0]->company_name }}
                @if($company[0]->is_member == -1)
                    (Non-Member)
                @else
                    (Member)
                @endif
            </h2>
            <ol class="breadcrumb">
                <li class="active" style = "font-size: 15px;">
                    <strong> Address: </strong> {{ $company[0]->address }} |
                    <strong> City: </strong> {{ $company[0]->city }}       |
                    <strong> State: </strong> {{ $company[0]->state}}      |
                    <strong> Zipcode: </strong> {{ $company[0]->zip_code }}
                </li>
            </ol>
        </div>
        <div class="col-sm-4">
            <div class="title-action">
                {{--<a href="#" class="btn btn-primary" id="btnSave">Save</a>--}}
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight"> {{-- wrapper start --}}
        <form role="form" action="{{ url('/client/save_contact') . '/' . $company[0]->Id }}" method="post">{{-- form start --}}
            <div class="row">{{-- row start --}}
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#all_contacts" id = "all_contacts_press"> All Contacts</a></li>
                            <li class=""><a data-toggle="tab" href="#all_groups" id = "all_groups_press"> All Groups</a></li>
                            <li class=""><a data-toggle="tab" href="#add_more_contacts" id = "add_more_contacts_press">Add More Contacts</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="all_contacts" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style = "font-size: 15px;">List of all Contacts Details</a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                                            <thead>
                                                            <tr>
                                                                <th style = "width:100px; text-align: center;">Firstname</th>
                                                                <th style = "width:100px; text-align: center;">Lastname</th>
                                                                <th style = "width:150px; text-align: center;">Position</th>
                                                                <th style = "width:50px; text-align: center;">Type</th>
                                                                <th style = "width:50px; text-align: center;">Role</th>
                                                                <th style = "width:50px; text-align: center;">Status</th>
                                                                <th style="width:30px;">&nbsp;</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $n = 1; ?>
                                                            @for($i = 0; $i < COUNT($results); $i++)
                                                                <tr>
                                                                    <td>{{ $results[$i]->first_name }}</td>
                                                                    <td>{{ $results[$i]->last_name }}</td>
                                                                    <td>{{ $results[$i]->position }}</td>
                                                                    <td style = "text-align: center;">{{ $results[$i]->type == 1 ? "Advertiser" : ($results[$i]->type == 2 ? "Agency" : "Lead") }}</td>
                                                                    <td style = "text-align: center;
                                                                        @if($results[$i]->role == 1)
                                                                            background-color: #1976D2; color: #ffffff;
                                                                        @elseif($results[$i]->role == 2)
                                                                            background-color: #f8ac59; color: #ffffff;
                                                                        @elseif($results[$i]->role == 3)
                                                                            background-color: #23c6c8; color: #ffffff;
                                                                        @elseif($results[$i]->role == 5)
                                                                            background-color: #af1c1e; color: #ffffff;
                                                                        @else
                                                                        {{ $results[$i]->branch_name }}
                                                                        @endif
                                                                    ">
                                                                        @if($results[$i]->role == 1)
                                                                            Primary
                                                                        @elseif($results[$i]->role == 2)
                                                                            Secondary
                                                                        @elseif($results[$i]->role == 3)
                                                                            Bill To
                                                                        @elseif($results[$i]->role == 5)
                                                                            Primary and Bill To
                                                                        @else
                                                                            {{ $results[$i]->branch_name }}
                                                                        @endif
                                                                    </td>
                                                                    <td style = "text-align: center;">{{ $results[$i]->status == 1 ? "In-active" : "Active" }}</td>
                                                                    <td><a href = "" onclick="return edit_contacts({{ $results[$i]->Id }});" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_edit_contacts" style = "padding: 0px 5px 0px 5px; margin: -5px -5px -5px -5px;"><i class="fa fa-edit" title = "Edit Contacts"></i> Edit</a></td>
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
                            </div>
                            <div id="add_more_contacts" class="tab-pane">
                                <div class="panel-body">
                                    <div class="col-lg-12" id = "role_handler">
                                        <div class="form-group">
                                            <label for="ex2">Role</label>
                                            <select class="form-control" name = "role" id = "role" required>
                                                <option value="">--select--</option>
                                                <option value="1" {{ COUNT($p) != 0 ? 'hidden' : '' }}>Primary Contact</option>
                                                <option value="2" {{ COUNT($s) != 0 ? 'hidden' : '' }}>Secondary Contact</option>
                                                <option value="3" {{ COUNT($b) != 0 ? 'hidden' : '' }}>Bill To Contact</option>
                                                <option value="4">Other Contact</option>
                                                <option value="5" {{ COUNT($same) != 0 ? 'hidden' : '' }}>Same as to Bill To Contact</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6" id = "company_name_show">
                                        <div class="form-group">
                                            <label for="ex2">Company Name</label>
                                            <input class="form-control" type="text" name="branch_name" placeholder="Enter Company Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6" id = "other_name_show">
                                        <div class="form-group">
                                            {{--specify name--}}
                                            <label for="ex2">Company Name</label>
                                            <input class="form-control" type="text" id ="other_name" name="other_name" placeholder="Enter Company Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ex2">First Name</label>
                                            <input class="form-control" type="text" name="first_name" placeholder="Enter First Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ex2">Last Name</label>
                                            <input class="form-control" type="text" name="last_name" placeholder="Enter Last Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="ex2">Address</label>
                                            <input class="form-control" type="text" name="address_1" placeholder="Enter Complete Address" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ex2">City</label>
                                            <input class="form-control" type="text" name="city" placeholder="Enter City" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ex2">Province/State</label>
                                            <select class="form-control" name = "state" required>
                                                <option value = "" selected>Select</option>
                                                @for($i = 0; $i < COUNT($tax); $i++)
                                                    <option value = "{{ $tax[$i]->province_code }}">
                                                        [{{ $tax[$i]->province_code }}]
                                                        {{ $tax[$i]->province_name }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ex2">Postal/Zip Code</label>
                                            <input class="form-control" type="text" name="zip_code" placeholder="Email Postal/Zipcode" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ex2">Email</label>
                                            <input class="form-control" type="text" name="email" placeholder="Enter Email" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ex2">Landline</label>
                                            <input class="form-control" type="text" name="landline" placeholder="Enter Landline Number" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ex2">Mobile</label>
                                            <input class="form-control" type="text" name="mobile" placeholder="Enter Mobile Number" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ex2">Position</label>
                                            <input class="form-control" type="text" name="position" placeholder="Enter Position" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ex2">Type</label>
                                            <select class="form-control" name = "type" required>
                                                <option value="">--select--</option>
                                                @for($i = 0; $i < COUNT($ref); $i++)
                                                    <option value="{{ $ref[$i]->Id }}">{{ $ref[$i]->name }}</option>
                                                @endfor
                                            </select>
                                            {{--<input class="form-control" type="text" name="b_type_designation" placeholder="Enter Type" required>--}}
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="ex2">Status</label>
                                            <div class="checkbox checkbox-primary">
                                                <input class="styled" type="checkbox" id = "status" name="status" checked>
                                                <label for="checkbox2">
                                                    Active
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" >
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                        <button id="btnUpdate" class="btn btn-primary pull-right" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div id="all_groups" class="tab-pane">
                                <div class="panel-body">
                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style = "font-size: 15px;">List of all Groups</a>
                                                    <a class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#modal_create_group" style = "color: #FFFFFF;">Create Group</a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="footable table table-stripped toggle-arrow-tiny" id = "list_group_table" data-page-size="15">
                                                            <thead>
                                                            <tr>
                                                                <th style = "text-align: Left;">Group Name</th>
                                                                <th style = "text-align: Left;">Category</th>
                                                                <th style = "text-align: Right;"></th>
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
                        </div>
                    </div>
                </div>

            </div> {{-- row end --}}
        </form> {{-- form end --}}
    </div>{{-- wrapper end --}}

    <script type="text/javascript">
        function edit_contacts($contact_uid) {
            var contact_uid = $contact_uid;

            $.ajax({
                url: "/contact/update/" + contact_uid,
                dataType: "text",
                success: function(data) {
                    var json = $.parseJSON(data);
                    if (json == null) return false;
                    if (json.result == 404) {
                        console.log("error " . contact_uid);
                    } else {

                        $(json.result).each(function(i, contact) {
//                            console.log(contact.role);

//                            $("#cid").append("<option value = '" + country.Id + "'>" + country.company_name + "</option>")
                            if(contact.role == 3 || contact.role == 5){

                                $("#contact_role_handler").removeClass('col-lg-12').addClass('col-lg-6');
                                $("#contact_company_name_show").show();
                                $("#contact_other_name_show").hide();
                                $("#e_contact_branch_name").val(contact.branch_name);

                            }else if(contact.role == 4){
                                $("#contact_role_handler").removeClass('col-lg-12').addClass('col-lg-6');
                                $("#contact_other_name_show").show();
                                $("#contact_company_name_show").hide();
                                $("#e_contact_other_name").val(contact.branch_name);

                            }else{
                                $("#contact_company_name_show").hide();
                                $("#contact_other_name_show").hide();
                                $("#contact_role_handler").removeClass('col-lg-6').addClass('col-lg-12');
                            }

                            if(contact.status == 2){
                                $('#e_status').prop('checked', true);
                            }else{
                                $('#e_status').prop('checked', false);
                            }

                            $("#e_contact_uid").val(contact.Id);
                            $("#e_client_id").val(contact.client_id);
                            $("#e_contact_role").val(contact.role);
                            $("#e_first_name").val(contact.first_name);
                            $("#e_middle_name").val(contact.middle_name);
                            $("#e_last_name").val(contact.last_name);
                            $("#e_address_1").val(contact.address_1);
                            $("#e_city").val(contact.city);

                            $("#e_state").val(contact.state);

                            //var state_val = contact.state;
                            //$("#e_state option[value=state_val]").prop("selected", true);

                            $("#e_zip_code").val(contact.zip_code);
                            $("#e_email").val(contact.email);
                            $("#e_landline").val(contact.landline);
                            $("#e_mobile").val(contact.mobile);
                            $("#e_position").val(contact.position);
                            $("#e_type").val(contact.type);

                        });
                    }
                }
            });
        }
    </script>

    <div class="modal fade" id="modal_edit_contacts" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Edit Contacts</h4>
                </div>
                <form role="form" action="{{ url('/client/save_update_contact') }}" method="post">

                    <div class="col-lg-12">
                        <div class="modal-body form group">
                            <input type = "hidden" name = "contact_uid" id = "e_contact_uid">
                            <input type = "hidden" name = "client_id" id = "e_client_id">
                            <div class="col-lg-12" id = "contact_role_handler">
                                <div class="form-group">
                                    <label for="ex2">Role</label>
                                    <select class="form-control" name = "role" id = "e_contact_role" required>
                                        <option value="">--select--</option>
                                        <option value="1" {{ COUNT($p) != 0 ? 'hidden' : '' }}>Primary Contact</option>
                                        <option value="2" {{ COUNT($s) != 0 ? 'hidden' : '' }}>Secondary Contact</option>
                                        <option value="3" {{ COUNT($b) != 0 ? 'hidden' : '' }}>Bill To Contact</option>
                                        <option value="4">Other Contact</option>
                                        <option value="5" {{ COUNT($same) != 0 ? 'hidden' : '' }}>Same as to Bill To Contact</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6" id = "contact_company_name_show">
                                <div class="form-group">
                                    <label for="ex2">Company Name</label>
                                    <input class="form-control" type="text" id ="e_contact_branch_name" name="branch_name" placeholder="Enter Company Name">
                                </div>
                            </div>
                            <div class="col-lg-6" id = "contact_other_name_show">
                                <div class="form-group">
                                    {{--specify name--}}
                                    <label for="ex2">Company Name</label>
                                    <input class="form-control" type="text" id ="e_contact_other_name" name="other_name" placeholder="Enter Company Name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="ex2">First Name</label>
                                    <input class="form-control" type="text" id = "e_first_name" name="first_name" placeholder="Enter First Name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="ex2">Last Name</label>
                                    <input class="form-control" type="text" id = "e_last_name" name="last_name" placeholder="Enter Last Name" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="ex2">Address</label>
                                    <input class="form-control" type="text" id = "e_address_1" name="address_1" placeholder="Enter Complete Address" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="ex2">City</label>
                                    <input class="form-control" type="text" id = "e_city" name="city" placeholder="Enter City" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="ex2">Province/State</label>
                                    {{--<input class="form-control" type="text" id = "state" name="state" placeholder="Enter State" required>--}}
                                    <select class="form-control" name = "state" id = "e_state" required>
                                        <option value = "" selected>Select</option>
                                        @for($i = 0; $i < COUNT($tax); $i++)
                                            <option value = "{{ $tax[$i]->province_code }}">
                                                [{{ $tax[$i]->province_code }}]
                                                {{ $tax[$i]->province_name }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="ex2">Postal/Zip Code</label>
                                    <input class="form-control" type="text" id = "e_zip_code" name="zip_code" placeholder="Email Postal/Zipcode" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="ex2">Email</label>
                                    <input class="form-control" type="text" id="e_email" name="email" placeholder="Enter Email" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="ex2">Landline</label>
                                    <input class="form-control" type="text" id = "e_landline" name="landline" placeholder="Enter Landline Number" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="ex2">Mobile</label>
                                    <input class="form-control" type="text" id = "e_mobile" name="mobile" placeholder="Enter Mobile Number" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="ex2">Position</label>
                                    <input class="form-control" type="text" id = "e_position" name="position" placeholder="Enter Position" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="ex2">Type</label>
                                    <select class="form-control" name = "type" id = "e_type" required>
                                        <option value="">--select--</option>
                                        @for($i = 0; $i < COUNT($ref); $i++)
                                            <option value="{{ $ref[$i]->Id }}">{{ $ref[$i]->name }}</option>
                                        @endfor
                                    </select>
                                    {{--<input class="form-control" type="text" name="b_type_designation" placeholder="Enter Type" required>--}}
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="ex2">Status</label>
                                    <div class="checkbox checkbox-primary">
                                        <input class="form-control" type="checkbox" id = "e_status" name="status">
                                        <label for="checkbox2">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="col-lg-6" id = "contact_same_as_show">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="ex2">Bill To Contact</label>--}}
                                    {{--<div class="checkbox checkbox-primary">--}}
                                        {{--<input class="styled" type="checkbox" id = "same_as" name="same_as">--}}
                                        {{--<label for="checkbox2">--}}
                                            {{--Same As Bill To Contact?--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_create_group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Create Group</h4>
                </div>
                <div class="modal-body form group">
                    <label for="ex2">Group Name</label>
                    <input class="form-control" type="text" id ="group_name" placeholder="Enter Group Name" required>
                    <label for="ex2">Category</label>
                    <select class="form-control" id = "category" required>
                        <option value="">--select--</option>
                        <option value="1">Print</option>
                        <option value="2">Digital</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id = "add_group">Save</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function(){

            $("#btnSave").hide();
            $("#company_name_show").hide();
            $("#other_name_show").hide();

            $('.ClientsListdataTables').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
//                "aaSorting": [4,'asc'],
                bSort:false,
                buttons: []
            });

            $("#role").change(function(){
                if($(this).val() == 3 || $(this).val() == 5){
                    $("#role_handler").removeClass('col-lg-12').addClass('col-lg-6');
                    $("#company_name_show").show();
                    $("#other_name_show").hide();

                }else if($(this).val() == 4){
                    $("#role_handler").removeClass('col-lg-12').addClass('col-lg-6');
                    $("#other_name_show").show();
                    $("#company_name_show").hide();

                }else{
                    $("#role_handler").removeClass('col-lg-6').addClass('col-lg-12');
                    $("#company_name_show").hide();
                    $("#other_name_show").hide();
                }
            });

            $("#add_more_contacts_press").click(function(){
                $("#btnSave").show();
            });

            $("#all_contacts_press").click(function(){
                $("#btnSave").hide();
            });

            $("#all_groups_press").click(function(){
                $("#btnSave").hide();
            });

            $("#btnSave").click(function(){
                $("#btnUpdate").click();
                return false;
            });

            $("#contact_role").change(function(){
                if($(this).val() == 3 || $(this).val() == 5) {
                    $("#contact_role_handler").removeClass('col-lg-12').addClass('col-lg-6');
                    $("#contact_company_name_show").show();
                    $("#contact_other_name_show").hide();

                }else if($(this).val() == 4){
                    $("#contact_role_handler").removeClass('col-lg-12').addClass('col-lg-6');
                    $("#contact_other_name_show").show();
                    $("#contact_company_name_show").hide();

                }else{
                    $("#contact_role_handler").removeClass('col-lg-6').addClass('col-lg-12');
                    $("#contact_company_name_show").hide();
                    $("#contact_other_name_show").hide();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){

            $("#all_groups_press").click(function(){
                populate_all_groups();
            });

            $("#add_group").click(function(){
                var group_name = $("#group_name").val();
                var category = $("#category").val();
                $.ajax({
                    url: "/client/add_group/{{ $company[0]->Id }}/" + group_name + "/" + category,
                    dataType: "text",
                    beforeSend: function () {
                    },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if (json == null)
                            return false;

                        if(json.status == 200)
                        {
                            $('#modal_create_group').modal('hide');
                            populate_all_groups();
                        }
                        else
                        {
                            console.log("Error");
                        }
                    }
                });
            });

            function populate_all_groups(){
                html_thmb = "";

                $.ajax({
                    url: "/client/list_group/{{ $company[0]->Id }}",
                    dataType: "text",
                    beforeSend: function () {
                    },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if (json == null)
                            return false;

                        if(json.status == 200)
                        {
                            $(json.result).each(function(i, tran){
                                html_thmb += "<tr>";
                                html_thmb += "<td style='text-align: left;'>"+tran.group_name+"</td>";

                                if(tran.category_id == 1){
                                    category = "Print";
                                }else if(tran.category_id == 2){
                                    category = "Digital"
                                }else if(tran.category_id == 3){
                                    category = "Bulletin"
                                }

                                html_thmb += "<td style='text-align: left;'>"+category+"</td>";
                                html_thmb += "<td style='text-align: left;'><a href = '{{ URL("/client/client_group") . "/"}}"+ tran.Id +"' class='btn btn-info btn-xs pull-right' style = 'padding: 0px 5px 0px 5px; margin: -5px -5px -5px -5px;'><i class='fa fa-plus' title = 'View Group'></i> View </a></td>";
                                html_thmb += "</tr>";

                            });
                            $('table#list_group_table > tbody').empty().prepend(html_thmb);
                        }
                        else
                        {
                            $('table#list_group_table > tbody').empty().prepend("<tr><td>No Result Found</td></tr>");
                        }
                    }
                });
            }

        });
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