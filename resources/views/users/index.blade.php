@extends('layout.magazine_main')

@section('title')
    Users List
@endsection

@section('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Users</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Users</a>
            </li>
            <li class="active">
                <strong>List of all Users</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Users List</h5>
                <div class = "pull-right">
                    <select class="form-control" id = "filter" style = "margin-top: -7px;">
                        <option disabled>--select--</option>
                        <option value = "" {{ $filter == "" ? "selected" : "" }}>All</option>
                        <option value = "1" {{ $filter == 1 ? "selected" : "" }}>Admin</option>
                        <option value = "2" {{ $filter == 2 ? "selected" : "" }}>Manager</option>
                        <option value = "3" {{ $filter == 3 ? "selected" : "" }}>Sales Person</option>
                    </select>
                </div>
                <div style = "float: right; margin-right: 5px; font-size: 15px;"><label>Filter by Role:</label></div>
            </div>

            <div class="ibox-content">
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    {{ Session::get('success') }}
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover UserListdataTables" >
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $u)
                                <tr>
                                    <td>{{ $u->first_name }}</td>
                                    <td>{{ $u->middle_name }}</td>
                                    <td>{{ $u->last_name }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>
                                        <?php
                                            if($u->role == 1){
                                                echo "Admin";
                                            }elseif($u->role == 2){
                                                echo "Manager";
                                            }else{
                                                echo "Sales Person";
                                            }
                                        ?>
                                    </td>
                                </tr>
                            @endforeach

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
        $("#filter").on('change', function(){
            window.location.href = "/users/all/" + $(this).val();
        });

        $('.UserListdataTables').DataTable({
        dom: '<"html5buttons"B>lTfgitp',
        buttons: []
        });

    });
</script>
@endsection