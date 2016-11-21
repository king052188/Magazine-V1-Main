@extends('layout.magazine_main')

@section('title')
    Add New Contract
@endsection

@section('styles')
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Booking</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Booking List</a>
            </li>
            <li>
                <a href="index.html">Add Booking</a>
            </li>
            <li>
                <a href="index.html">Add Magazine</a>
            </li>
            <li class="active">
                <strong>Add Issue</strong>
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
                    <h5>Add Issue <small> *all fields are required</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" action="{{ url('/v2/save_issue') . '/' . $client_id }}" method="post">
                                    <div class="form-group">
                                        <label for="ex2">Magazine Transaction #</label>
                                        <input class="form-control" id="ex2" type="text" value = "{{ $mag_trans_uid }}" name = "magazine_trans_id" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="ex2">Ad Criteria</label>
                                        <select class="form-control" name = "ad_criteria_id" id = "ad_criteria_id">
                                            @for($i = 0; $i < COUNT($ad_c); $i++)
                                                <option value = "{{ $ad_c[$i]->Id }}">{{ $ad_c[$i]->name }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ex2">Pages</label>
                                        <select class="form-control" name = "ad_package_id">
                                            @for($i = 0; $i < COUNT($ad_p); $i++)
                                                <option value = "{{ $ad_p[$i]->Id }}">{{ $ad_p[$i]->package_name }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div>
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                        <button class="btn btn-primary pull-right" type="submit">Save Issue</button>
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
<script>
    $('#ad_criteria_id').on('change', function()
    {
        alert( this.value );
    });
</script>
@endsection