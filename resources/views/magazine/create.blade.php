@extends('layout.magazine_main')

@section('title')
    Add New Magazine
@endsection

@section('styles')
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Magazine</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Magazine</a>
            </li>
            <li class="active">
                <strong>Create Magazine</strong>
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
                    <h5>Create New Magazine <small> *all fields are required</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" action="{{ url('/magazine/store') }}" method="post">
                                <div class="form-group">
                                    <label>Magazine Code</label>
                                    <input type="text" placeholder="Magazine Code" class="form-control"  name="magcode">
                                </div>
                                <div class="form-group">
                                    <label>Client Code</label>
                                    <input type="text" placeholder="Client Code" class="form-control"  name="clientcode"></div>
                                <div class="form-group">
                                    <label>Agency Code</label>
                                    <input type="text" placeholder="Agency Code" class="form-control" name="agencycode"></div>
                                <div class="form-group">
                                    <label>Magazine Name</label>
                                    <input type="text" placeholder="Magazine Name" class="form-control" name="magname"></div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" placeholder="Status" class="form-control"  name="status">
                                </div>
                                <div>
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <button class="btn btn-sm btn-primary pull-right" type="submit"><strong>Create New Magazine</strong></button>
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