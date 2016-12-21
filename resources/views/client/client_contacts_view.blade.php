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
                <a href="#" class="btn btn-primary" id="btnSave">Save, Client Profile</a>
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
                            <li class=""><a data-toggle="tab" href="#add_more_contacts" id = "add_more_contacts_press">Add More Contacts</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="all_contacts" class="tab-pane active">
                                <div class="panel-body">

                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style = "font-size: 15px;">Main Contact Details</a>
                                                </h5>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="col-lg-4">
                                                        <div class="panel panel-primary">
                                                            <div class="panel-heading" style = "padding: 5px; font-size: 15px;">
                                                                <strong>Primary Contact Details</strong>
                                                            </div>
                                                            <div class="panel-body" style = "padding: 10px;">
                                                                @if(COUNT($p) != 0)
                                                                    <h3 style = "text-align: left; margin-left: 15px;"><strong>{{ $p[0]->first_name . " " . $p[0]->middle_name . " " . $p[0]->last_name}}</strong> ({{ $p[0]->position }})</h3>
                                                                    <div class="col-lg-4">
                                                                        <i class="fa fa-envelope" aria-hidden="true"></i> <strong> Email: </strong>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        {{ $p[0]->email }}
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <i class="fa fa-mobile" aria-hidden="true"></i> <strong> Mobile: </strong>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        {{ $p[0]->mobile }}
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <i class="fa fa-phone" aria-hidden="true"></i> <strong>Landline: </strong>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        {{ $p[0]->landline }}
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <i class="fa fa-tag" aria-hidden="true"></i> <strong>Type: </strong>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        {{ $p[0]->type == 1 ? "Subscribers" : ($p[0]->type == 2 ? "Agency" : "Lead") }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="panel panel-warning">
                                                            <div class="panel-heading" style = "padding: 5px; font-size: 15px;">
                                                                <strong>Secondary Contact Details</strong>
                                                            </div>
                                                            <div class="panel-body" style = "padding: 10px;">
                                                                @if(COUNT($s) != 0)
                                                                    <h3 style = "text-align: left; margin-left: 15px;"><strong>{{ $s[0]->first_name . " " . $s[0]->middle_name . " " . $s[0]->last_name}}</strong> ({{ $s[0]->position }})</h3>
                                                                    <div class="col-lg-4">
                                                                        <i class="fa fa-envelope" aria-hidden="true"></i> <strong> Email: </strong>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        {{ $s[0]->email }}
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <i class="fa fa-mobile" aria-hidden="true"></i> <strong> Mobile: </strong>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        {{ $s[0]->mobile }}
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <i class="fa fa-phone" aria-hidden="true"></i> <strong>Landline: </strong>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        {{ $s[0]->landline }}
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <i class="fa fa-tag" aria-hidden="true"></i> <strong>Type: </strong>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        {{ $s[0]->type == 1 ? "Subscribers" : ($s[0]->type == 2 ? "Agency" : "Lead") }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="panel panel-info">
                                                            <div class="panel-heading" style = "padding: 5px; font-size: 15px;">
                                                                <strong>Bill To Contact Details</strong>
                                                            </div>
                                                            <div class="panel-body" style = "padding: 10px;">
                                                                @if(COUNT($b) != 0)
                                                                    <h3 style = "text-align: left; margin-left: 15px;"><strong>{{ $b[0]->first_name . " " . $b[0]->middle_name . " " . $b[0]->last_name}}</strong> ({{ $b[0]->position }})</h3>
                                                                    <div class="col-lg-4">
                                                                        <i class="fa fa-envelope" aria-hidden="true"></i> <strong> Email: </strong>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        {{ $b[0]->email }}
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <i class="fa fa-mobile" aria-hidden="true"></i> <strong> Mobile: </strong>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        {{ $b[0]->mobile }}
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <i class="fa fa-phone" aria-hidden="true"></i> <strong>Landline: </strong>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        {{ $b[0]->landline }}
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <i class="fa fa-tag" aria-hidden="true"></i> <strong>Type: </strong>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        {{ $b[0]->type == 1 ? "Subscribers" : ($b[0]->type == 2 ? "Agency" : "Lead") }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style = "font-size: 15px;">List of all Contacts Details</a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover table-responsive ClientsListdataTables" >
                                                            <thead>
                                                            <tr>
                                                                <th style = "width:100px; text-align: center;">Firstname</th>
                                                                <th style = "width:30px; text-align: center;">Middlename</th>
                                                                <th style = "width:100px; text-align: center;">Lastname</th>
                                                                <th style = "width:150px; text-align: center;">Position</th>
                                                                <th style = "width:50px; text-align: center;">Type</th>
                                                                <th style="width:30px;">&nbsp;</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $n = 1; ?>
                                                            @for($i = 0; $i < COUNT($results); $i++)
                                                                <tr>
                                                                    <td>{{ $results[$i]->first_name }}</td>
                                                                    <td>{{ $results[$i]->middle_name }}</td>
                                                                    <td>{{ $results[$i]->last_name }}</td>
                                                                    <td>{{ $results[$i]->position }}</td>
                                                                    <td>{{ $results[$i]->type == 1 ? "Subscriber" : ($results[$i]->type == 2 ? "Agency" : "Lead") }}</td>
                                                                    <td><a href = "#" class="btn btn-primary btn-xs" style = "padding: 0px 5px 0px 5px; margin: -5px -5px -5px -5px;"><i class="fa fa-edit" title = "Edit Company"></i> Edit</a></td>
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
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6" id = "company_name_show">
                                        <div class="form-group">
                                            <label for="ex2">Company Name</label>
                                            <input class="form-control" type="text" name="branch_name" placeholder="Enter Company Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="ex2">First Name</label>
                                            <input class="form-control" type="text" name="first_name" placeholder="Enter First Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="ex2">Middle Name</label>
                                            <input class="form-control" type="text" name="middle_name" placeholder="Enter Middle Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
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
                                            <input class="form-control" type="text" name="state" placeholder="Enter State" required>
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
                                    <div class="form-group" >
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                        <button id="btnUpdate" class="btn btn-primary btn-lg pull-right" type="submit" style = "width: 200px; display: none;">Create</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> {{-- row end --}}
        </form> {{-- form end --}}
    </div>{{-- wrapper end --}}
@endsection


@section('scripts')
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("#btnSave").hide();
            $("#company_name_show").hide();
            $('.ClientsListdataTables').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                "aaSorting": [0,'asc'],
                buttons: []
            });

            $("#role").change(function(){

                if($(this).val() == 3){
                    $("#role_handler").removeClass('col-lg-12').addClass('col-lg-6');
                    $("#company_name_show").show();
                }else{
                    $("#role_handler").removeClass('col-lg-6').addClass('col-lg-12');
                    $("#company_name_show").hide();
                }
            });

            $("#add_more_contacts_press").click(function(){
                $("#btnSave").show();
            });

            $("#all_contacts_press").click(function(){
                $("#btnSave").hide();
            });

            $("#btnSave").click(function(){
                $("#btnUpdate").click();
                return false;
            });
        });
    </script>
@endsection