@extends('layout.magazine_main')

@section('title')
    Add New Company
@endsection

@section('styles')
@endsection

@section('magazine_content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Company</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Add Company</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Company Name of Magazine<small> *all fields are required</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <form role="form" action="{{ url('/magazine/company/save') }}" method="post">
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input type="text" placeholder="Company / Business Name" class="form-control"  name="company_name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Address 1</label>
                                        <input type="text" placeholder="Address 1" class="form-control" name="address_1">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Address 2 (Optional)</label>
                                        <input type="text" placeholder="Address 2 (Optional)" class="form-control" name="address_2">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" placeholder="City" class="form-control"  name="city">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input type="text" placeholder="State" class="form-control"  name="state">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select class="form-control" name="country">
                                            <option value="1">USA</option>
                                            <option value="2">CANADA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" placeholder="Email" class="form-control"  name="email">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" placeholder="Phone" class="form-control"  name="phone">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Fax</label>
                                        <input type="text" placeholder="Fax" class="form-control"  name="fax">
                                    </div>
                                </div>
                            </div>
                            <div class = "col-lg-12">
                                <div class="form-group">
                                    <input type = "hidden" name = "logo_uid" value = "{{ $logo_uid['id_company'] }}">
                                    <?php
                                    $assembly = new \App\Http\Controllers\AssemblyClass();
                                    $url_api = $assembly::get_reports_api();
                                    $logo_uploader_url = 'http://'. $url_api["Url_Logo_Uploader"] .'type=COMPANY&uid='. $logo_uid['id_company'];
                                    ?>
                                    <iframe src = "{{ $logo_uploader_url }}" style="width: 100%; height: 360px" frameborder="0" scrolling="no"> </iframe>
                                </div>
                            </div>
                            <div class = "col-lg-12">
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                <button class="btn btn-primary pull-right" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

@endsection