@extends('layout.magazine_main')

@section('title')
    Update Contacts
@endsection

@section('styles')
@endsection

@section('magazine_content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Client</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Client</a>
                </li>
                <li>
                    <a href="index.html">Create Client</a>
                </li>
                <li class="active">
                    <strong>Add New Contact</strong>
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
                        <h5>Create New Client <small> *all fields are required</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" action="{{ url('/client/save_contact') . '/' . $result_contact[0]->Id .'/'. $result_contact[0]->client_id }}" method="post">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ex2">Branch Name</label>
                                            <input class="form-control d" id="ex2" type="text" value = "{{ strtoupper($result_contact[0]->branch_name) }}" name = "branch_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="ex2">First Name</label>
                                            <input class="form-control" id="ex2" type="text" name="first_name" value = "{{ $result_contact[0]->first_name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="ex2">Middle Name</label>
                                            <input class="form-control" id="ex2" type="text" name="middle_name" value = "{{ $result_contact[0]->middle_name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="ex2">Last Name</label>
                                            <input class="form-control" id="ex2" type="text" name="last_name" value = "{{ $result_contact[0]->last_name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="ex2">Address</label>
                                            <input class="form-control" id="ex2" type="text" name="address_1" value = "{{ $result_contact[0]->address_1 }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="ex2">Email</label>
                                            <input class="form-control" id="ex2" type="text" name="email" value = "{{ $result_contact[0]->email }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ex2">Landline</label>
                                            <input class="form-control" id="ex2" type="text" name="landline" value = "{{ $result_contact[0]->landline }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="ex2">Mobile</label>
                                            <input class="form-control" id="ex2" type="text" name="mobile" value = "{{ $result_contact[0]->mobile }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="ex2">Primary?</label>
                                            <input type="checkbox" name="type" {{ $result_contact[0]->type == 1 ? "checked" : "" }}>
                                        </div>
                                        <div class="form-group">
                                            {{--<label for="ex2">Status</label>--}}
                                            <input disabled class="form-control" value="1" type="hidden" name="status">
                                        </div>
                                    </div>
                                    <div>
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                        <button class="btn btn-primary pull-right" type="submit">Add New Contact</button>
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