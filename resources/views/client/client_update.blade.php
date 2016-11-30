@extends('layout.magazine_main')

@section('title')
    Update Client
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
                <li class="active">
                    <strong>Create Client</strong>
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
                                <form role="form" action="{{ url('/client/update/save') .'/'. $result_client[0]->Id }}" method="post">
                                    <div class="form-group">
                                        <label>Client/Company Name</label>
                                        <input type="text" placeholder="Client Code" class="form-control"  value = "{{ $result_client[0]->company_name }}" name="company_name">
                                    </div>
                                    <div class="form-group">

                                        <label for="ex2">Type</label>
                                        <select class="form-control" name = "type">
                                            @for($i = 0; $i < COUNT($result); $i++)
                                                <option value = "{{ $result[$i]->Id }}" {{ $result_client[0]->type == $result[$i]->Id ? 'selected' : '' }}>{{ $result[$i]->name }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div>
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                        <button class="btn btn-primary pull-right" type="submit"><strong>Create New Client</strong></button>
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


@section('scripts')

@endsection