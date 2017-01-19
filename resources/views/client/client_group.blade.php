@extends('layout.magazine_main')

@section('title')
    Add New Client
@endsection

@section('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{  asset('css/plugins/chosen/chosen.css')  }}" rel="stylesheet">
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
                        <h5>Add Contacts To Your Group</h5>
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
                                    <label>Contact Name</label>
                                    <select class="form-control chosen-select" style = "background: none;" id = "add_contact" required>
                                        <option value="">Select</option>
                                        @for($i = 0; $i < COUNT($contacts); $i++)
                                            <option value = "{{ $contacts[$i]->Id }}">{{ $contacts[$i]->first_name }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ex2">Role</label>
                                    <select class="form-control" name = "role" id = "role" required>
                                        <option value="">--select--</option>
                                        <option value="1">Primary Contact</option>
                                        <option value="2">Secondary Contact</option>
                                        <option value="3">Bill To Contact</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <a class='btn btn-primary' id = "add_contacts_to_group">Add</a>
                            </div>
                        </div>
                    </div>
                </div> {{-- ibox end  --}}
            </div>

            <div class="col-lg-8">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li id = "list_clients_tab_show" class="active"><a data-toggle="tab" href="#all_contacts"> List of Contact In {{ $group[0]->group_name }}</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="all_contacts" class="tab-pane active">
                            <div class="panel-body">
                                <table class="table table-striped table-bordered table-hover table-responsive" id = "list_contact_in_group">
                                    <thead>
                                        <tr>
                                            <th style = "text-align: center;">Name</th>
                                            <th style = "text-align: center;">Role</th>
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
    <script>
        $(document).ready(function(){

            list_of_contacts_in_group();

            $("#add_contacts_to_group").click(function(){

                var add_contact = $("#add_contact").val();
                var role = $("#role").val();
                if(add_contact == "")
                {
                    swal(
                            'Oops...',
                            'Contact name is required!',
                            'warning'
                    )
                    return false;
                }
                if(role == "")
                {
                    swal(
                            'Oops...',
                            'Role is required!',
                            'warning'
                    )
                    return false;
                }

                $.ajax({
                    url: "/client/add_contacts_in_group/{{ $company[0]->Id }}/{{ $group[0]->Id }}/" + add_contact + "/" + role,
                    dataType: "text",
                    beforeSend: function () {
                    },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if (json == null)
                            return false;

                        if(json.status == 200)
                        {
                            list_of_contacts_in_group();
                        }
                        else if(json.status == 404)
                        {
                            swal(
                                    'Oops...',
                                    'This contact is already in your group!',
                                    'warning'
                            )
                            return false;
                        }
                        else if(json.status == 403)
                        {
                            swal(
                                    'Oops...',
                                    'This role is already in your group!',
                                    'warning'
                            )
                            return false;
                        }
                    }
                });
            });

            function list_of_contacts_in_group()
            {
                html_thmb = "";
                $.ajax({
                    url: "/client/list_of_contacts_in_group/{{ $company[0]->Id }}",
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

                                if(tran.role_id == 1){
                                    r_role = "Primary Contact";
                                }else if(tran.role_id == 2){
                                    r_role = "Secondary Contact";
                                }else if(tran.role_id == 3){
                                    r_role = "Bill To Contact";
                                }

                                html_thmb += "<tr>";
                                html_thmb += "<td style='text-align: center;'>"+ tran.first_name + " " + tran.last_name +"</td>";
                                html_thmb += "<td style='text-align: center;'>"+ r_role +"</td>";
                                html_thmb += "</tr>";

                            });
                            $('table#list_contact_in_group > tbody').empty().prepend(html_thmb);
                        }
                        else
                        {
                            $('table#list_contact_in_group > tbody').empty().prepend("<tr><td colspan = '2'>No Result Found</td></tr>");
                        }
                    }
                });
            }
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