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
                            <form role="form" action="{{ url('/salesperson/store') }}" method="post">
                                <div class="form-group">
                                    <label>Salesperson Code</label>
                                    <input type="Client Code" placeholder="Client Code" class="form-control"  name="srepcode">
                                </div>
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="Agency Code" placeholder="Agency Code" class="form-control"  name="srepfname"></div>
                                <div class="form-group">
                                    <label>Middle Name</label>
                                    <input type="Address" placeholder="Company Name" class="form-control" name="sremname"></div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" placeholder="First Name" class="form-control" name="srepsurname"></div>
                                <div class="form-group">
                                    <label>Salesperson Address</label>
                                    <input type="Landline Number" placeholder="Middle Name" class="form-control"  name="srepadd1">
                                </div>
                                <div class="form-group">
                                    <label>Salesperson Address Line 2</label>
                                    <input type="text" placeholder="Last Name" class="form-control" name="srepadd2">
                                </div>
                                <div class="form-group">
                                    <label>Salesperson Landline</label>
                                    <input type="text" placeholder="Address" class="form-control" name="slandline">
                                </div>
                                <div class="form-group">
                                    <label>Salesperson Mobile Number</label>
                                    <input type="text" placeholder="Address Line 2" class="form-control" name ="srepmobile">
                                </div>
                                <div class="form-group">
                                    <label>Salesperson Email</label>
                                    <input type="text" placeholder="Landline" class="form-control" name="srepemail">
                                </div>
                                <div class="form-group">
                                    <label>Salesperson Statu</label>
                                    <input type="text" placeholder="Mobile Number" class="form-control" name="srepstatus">
                                </div>
                                <div>
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <button class="btn btn-sm btn-primary pull-right" type="submit"><strong>Create New Salesperson</strong></button>
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