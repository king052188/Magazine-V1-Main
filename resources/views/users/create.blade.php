@extends('layout.magazine_main')

@section('title')
    Add New Salesperson
@endsection

@section('styles')
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Salesperson</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Salesperson</a>
            </li>
            <li class="active">
                <strong>Create Salesperson</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Create New Salesperson <small> *all fields are required</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" action="{{ url('users/store') }}" method="post">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="Client Code" placeholder="First Name" class="form-control"  name="first_name">
                                </div>
                                <div class="form-group">
                                    <label>Middle Name</label>
                                    <input type="Agency Code" placeholder="Middle Name" class="form-control"  name="middle_name">
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="Address" placeholder="Last Name" class="form-control" name="last_name">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" placeholder="Email" class="form-control" name="email">
                                </div>
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="Landline Number" placeholder="Mobile" class="form-control"  name="mobile">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="Landline Number" placeholder="Username" class="form-control"  name="username">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="Landline Number" placeholder="Password" class="form-control"  name="password">
                                </div>
                                <div class="form-group">
                                    <label>Role</label><br />
                                    <input type="radio" name="role" value="1"><label>&nbsp;Admin</label><br />
                                    <input type="radio" name="role" value="2"><label>&nbsp;Manager</label><br />
                                    <input type="radio" name="role" value="3" checked="checked"><label>&nbsp;Salesperson</label>
                                </div>
                                <div>
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <button class="btn btn-sm btn-primary pull-right" type="submit"><strong>Create New User</strong></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection