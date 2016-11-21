@extends('layout.magazine_main')

@section('title')
    Add New Contract
@endsection

@section('styles')
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Contract</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Contract</a>
            </li>
            <li class="active">
                <strong>Create Contract</strong>
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
                    <h5>Create New Contract <small> *all fields are required</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" action="{{ url('/contract/store') }}" method="post">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contract Number</label>
                                        <input type="text" placeholder="Contract Number" class="form-control"  name="srepcode" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Magazine Code</label>
                                        <input type="text" placeholder="Magazine Code" class="form-control"  name="magcode">
                                    </div>
                                    <div class="form-group">
                                        <label>Contract ID</label>
                                        <input type="text" placeholder="Contract ID" class="form-control" name="contid">
                                    </div>
                                    <div class="form-group">
                                        <label>Client Code</label>
                                        <input type="text" placeholder="Client Code" class="form-control" name="clientcode">
                                    </div>
                                    <div class="form-group">
                                        <label>Agency Code</label>
                                        <input type="text" placeholder="Agency Code" class="form-control"  name="agencycode">
                                    </div>
                                    <div class="form-group">
                                        <label>Date Issue</label>
                                        <input type="text" placeholder="Date Issue" class="form-control" name="cdateissue">
                                    </div>
                                    <div class="form-group">
                                        <label>Contract Date</label>
                                        <input type="text" placeholder="Contract Date" class="form-control" name="contdate">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ad Size</label>
                                        <input type="text" placeholder="Ad Size" class="form-control" name="adsize">
                                    </div>
                                    <div class="form-group">
                                        <label>Charges</label>
                                        <input type="text" placeholder="Charges" class="form-control" name="charges">
                                    </div>
                                    <div class="form-group">
                                        <label>Charge Date</label>
                                        <input type="text" placeholder="Charge Date" class="form-control" name="chargedate">
                                    </div>
                                    <div class="form-group">
                                        <label>Reference Number</label>
                                        <input type="text" placeholder="Reference Number" class="form-control" name="refno">
                                    </div>
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <input type="text" placeholder="Remarks" class="form-control" name="remarks">
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <input type="text" placeholder="Status" class="form-control" name="status">
                                    </div>
                                    <div>
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                        <button class="btn btn-primary pull-right" type="submit"><strong>Create New Contract</strong></button>
                                    </div>
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