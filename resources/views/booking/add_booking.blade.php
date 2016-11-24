@extends('layout.magazine_main')

@section('title')
    Add New Magazine
@endsection

@section('styles')
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Booking</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/booking/add-booking') }}">Booking List</a>
            </li>
            <li class="active">
                <strong>Add Booking</strong>
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
                    <h5>Create New Booking <small> *all fields are required</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" action="{{ url('/booking/magazine-transaction-save-process') }}" method="post">
                                <div class="form-group">
                                    <label>Trans Code</label>
                                    <input class="form-control" id="ex2" type="text" value = "{{ $n_booking['id'] }}" name = "trans_num">
                                </div>

                                <input class="form-control" placeholder="Sales Representative Code" id="ex2" type="hidden" value = "{{ $_COOKIE['Id'] }}" name = "sales_rep_code">

                                <div class="form-group">
                                    <label>Client ID <i>(UID of client_contacts_table)</i></label>
                                    <select class="form-control" name="client_id">
                                        @for($i = 0; $i < COUNT($subscriber); $i++)
                                            <option value = {{ $subscriber[$i]->child_uid }}>{{ $subscriber[$i]->company_name . "-" . $subscriber[$i]->branch_name }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ex2">Agency ID</label>
                                    <select class="form-control" name="agency_id">
                                        @for($i = 0; $i < COUNT($agency); $i++)
                                            <option value = {{ $agency[$i]->child_uid }}>{{ $agency[$i]->company_name . "-" . $agency[$i]->branch_name }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ex2">Status</label>
                                    <input class="form-control" id="ex2" type="text" value = "1" name = "status" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="ex2">Select Country</label>
                                    <select class = "form-control" name = "which_country">
                                        <option value = "1">US</option>
                                        <option value = "2">Canada</option>
                                    </select>
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