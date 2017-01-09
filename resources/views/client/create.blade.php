@extends('layout.magazine_main')

@section('title')
    Add New Client
@endsection

@section('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Create New Clients</h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>Add Client Details</strong>
            </li>
        </ol>
    </div>
    {{--<div class="col-sm-4">--}}
        {{--<div class="title-action">--}}
            {{--<a href="#" class="btn btn-primary" id="btnSave">Save, Client Profile</a>--}}
        {{--</div>--}}
    {{--</div>--}}
</div>

<div class="wrapper wrapper-content animated fadeInRight"> {{-- wrapper start --}}
    <form role="form" action="{{ url('/client/save_company') }}" method="post">{{-- form start --}}
        <div class="row">{{-- row start --}}
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    {!! Session::get('success') !!}
                </div>
            @endif
            {{--START COMPANY DETAILS--}}
            <div class="col-lg-4" >
                <div class="ibox float-e-margins"> {{-- ibox start --}}
                    <div class="ibox-title">
                        <h5>Company Details <small> *all fields are required</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="text" placeholder="Enter Company Name" class="form-control"  name="c_company_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" placeholder="Enter Address" class="form-control"  name="c_address" required>
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" placeholder="Enter City" class="form-control"  name="c_city" required>
                                </div>
                                <div class="form-group">
                                    <label>Province/State</label>
                                    <select class="form-control" name = "c_state" id = "c_state" required>
                                        <option value = "" selected>Select</option>
                                        @for($i = 0; $i < COUNT($tax); $i++)
                                            <option value = "{{ $tax[$i]->province_code }}">{{ $tax[$i]->province_name }} ({{ $tax[$i]->province_code }})</option>
                                        @endfor
                                        <option value = "1">Others</option>
                                    </select>
                                </div>
                                <div class="form-group" id = "specify_province_code_area" style = "display: none;">
                                    <label>Specify Province Code</label>
                                    <input type="text" placeholder="Specify Province Code" class="form-control"  id = "specify_province_code" name="specify_province_code">
                                </div>
                                <div class="form-group">
                                    <label>Postal/Zip Code</label>
                                    <input type="text" placeholder="Enter Postal/Zipcode" class="form-control"  name="c_zip_code" required>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkbox2" class="styled" type="checkbox" name="c_is_member" checked>
                                        <label for="checkbox2">
                                            Member?
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <button id="btnCreate" class="btn btn-primary pull-right" type="submit">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> {{-- ibox end  --}}
            </div>

            <div class="col-lg-8">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li id = "list_clients_tab_show" class="active"><a data-toggle="tab" href="#all_contacts"> List of Company</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="all_contacts" class="tab-pane active">
                            <div class="panel-body">
                                <table class="table table-striped table-bordered table-hover table-responsive ClientsListdataTables" >
                                    <thead>
                                    <tr>
                                        <th style = "text-align: center;">Company</th>
                                        <th style = "text-align: center;">City</th>
                                        <th style = "text-align: center;">State</th>
                                        <th style = "width:50px; text-align: center;">Member</th>
                                        <th style="width:25px;">&nbsp;</th>
                                        <th style="width:25px;">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $n = 1; ?>
                                    @for($i = 0; $i < COUNT($clients); $i++)
                                        <tr>
                                            <td style="padding-top: 15px;">{{ $clients[$i]->company_name }}</td>
                                            <td style="padding-top: 15px;">{{ $clients[$i]->city }}</td>
                                            <td style="padding-top: 15px;">{{ $clients[$i]->state }}</td>
                                            <td style="text-align: center;padding-top: 15px;">
                                                @if($clients[$i]->is_member == 1)
                                                    <i class="fa fa-check text-navy"></i>
                                                @else
                                                    <i class="fa fa-close text-red"></i>
                                                @endif
                                            </td>
                                            <td><a href = "{{ URL('/client/update/' . $clients[$i]->Id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" title = "Edit Company"></i>&nbsp;&nbsp;Edit</a></td>
                                            <td><a href = "{{ URL('/client/view_contacts/' . $clients[$i]->Id) }}" class="btn btn-info btn-sm" title="View Contacts"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Contacts</a></td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
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
    <script>
        $(document).ready(function(){
            $("#btnSave").click(function(){
                $("#btnCreate").click();
                return false;
            });

            $("#c_state").change(function(){

                if($(this).val() == 1)
                {
                    $("#specify_province_code_area").show();
                    $("#specify_province_code").prop('required',true);
                }else{
                    $("#specify_province_code_area").hide();
                }
            });
        });
    </script>
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready( function() {
            $('.ClientsListdataTables').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                "aaSorting": [0,'asc'],
                buttons: []
            });
        });
    </script>
@endsection