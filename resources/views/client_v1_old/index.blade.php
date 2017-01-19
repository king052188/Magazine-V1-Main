@extends('layout.magazine_main')

@section('title')
    All Clients
@endsection

@section('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Clients</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Clients</a>
            </li>
            <li class="active">
                <strong>List of all Clients</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>List of Clients</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
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
                        <table class="table table-striped table-bordered table-hover table-responsive ClientsListdataTables" >
                            <thead>
                                <tr>
                                    <th style="width:30px; text-align: center;">#</th>
                                    <th style = "text-align: center;">Company</th>
                                    <th style = "width:200px; text-align: center;">City</th>
                                    <th style = "width:200px; text-align: center;">State</th>
                                    <th style = "width:100px; text-align: center;">Member</th>
                                    <th style = "width:100px; text-align: center;">Type</th>
                                    <th style="width:30px;">&nbsp;</th>
                                    <th style="width:30px;">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $n = 1; ?>
                            @for($i = 0; $i < COUNT($results); $i++)
                                <tr>
                                    <td style = "text-align: center;">{{ $n++ }}</td>
                                    <td>{{ $results[$i]->company_name }}</td>
                                    <td>{{ $results[$i]->city }}</td>
                                    <td>{{ $results[$i]->state }}</td>
                                    <td style="text-align: center;">{{ $results[$i]->is_member == 1 ? "Yes" : "No"}}</td>
                                    <td style = "text-align: center;">{{ $results[$i]->type == 1 ? "Subscribers" : ($results[$i]->type == 2 ? "Agency" : "Lead")}}</td>
                                    <td><a href = "{{ URL('/client/update/' . $results[$i]->Id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" title = "Edit Company"></i> Edit</a></td>
                                    <td><a href = "{{ URL('/client/view_contacts/' . $results[$i]->Id) }}" class="btn btn-primary btn-sm" title = "Add more client"><i class="fa fa-user-plus"></i> View</a></td>
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
@endsection

@section('scripts')
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready( function() {
            $('.ClientsListdataTables').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: []
            });
        });
    </script>
@endsection