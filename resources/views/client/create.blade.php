@extends('layout.magazine_main')

@section('title')
    Add New Client
@endsection

@section('styles')
    <style>
        .content.clearfix{
            height: 520px;
        }

        .ibox-content{
            height: 610px;
        }
    </style>
@endsection

@section('magazine_content')

<div class="row wrapper border-bottom white-bg page-heading"> {{-- breadcrumbs start --}}
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
</div> {{-- breadcrumbs end --}}

<div class="wrapper wrapper-content animated fadeInRight"> {{-- wrapper start --}}
    <form role="form" action="{{ url('/client/save_client') }}" method="post">{{-- form start --}}
        <div class="row">{{-- row start --}}
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    {{ Session::get('success') }}Suuccess
                </div>
            @endif
            {{--START COMPANY DETAILS--}}
            <div class="col-lg-4">
                <div class="ibox float-e-margins"> {{-- ibox start --}}
                    <div class="ibox-title">
                        <h5>Company Details <small> *all fields are required</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="text" placeholder="Enter Company Name" class="form-control"  name="c_company_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" placeholder="Enter Address" class="form-control"  name="c_address" required>
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" placeholder="Enter City" class="form-control"  name="c_city" required>
                                </div>
                                <div class="form-group">
                                    <label>Province/State</label>
                                    <input type="text" placeholder="Enter Province/State" class="form-control"  name="c_state" required>
                                </div>
                                <div class="form-group">
                                    <label>Postal/Zip Code</label>
                                    <input type="text" placeholder="Enter Postal/Zipcode" class="form-control"  name="c_zip_code" required>
                                </div>
                                <div class="form-group">
                                    <label>Type</label><br />
                                    <div class="radio radio-primary">
                                        @for($i = 0; $i < COUNT($result); $i++)
                                            <input type="radio" name="c_type" checked = "checked" value="{{ $result[$i]->Id }}"><label>&nbsp;{{ $result[$i]->name }}</label><br />
                                        @endfor
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkbox2" class="styled" type="checkbox" name="c_is_member" checked>
                                        <label for="checkbox2">
                                            Member?
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <button class="btn btn-primary btn-lg pull-right" type="submit" style = "width: 200px;">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> {{-- ibox end  --}}
            </div>
            {{--END COMPANY DETAILS--}}


            <div class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Contact Details</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div id="wizard">

                            {{--START PRIMARY CONTACT DETAILS--}}
                            <h1>Primary Contact Details</h1>
                            <div class="step-content">
                                <h3 class="m-t-none m-b">Primary Contact Details</h3>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">First Name</label>
                                        <input class="form-control" type="text" name="p_first_name" placeholder="Enter First Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">Middle Name</label>
                                        <input class="form-control" type="text" name="p_middle_name" placeholder="Enter Middle Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">Last Name</label>
                                        <input class="form-control" type="text" name="p_last_name" placeholder="Enter Last Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="ex2">Address</label>
                                        <input class="form-control" type="text" name="p_address_1" placeholder="Enter Complete Address" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="ex2">City</label>
                                        <input class="form-control" type="text" name="p_city" placeholder="Enter City" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">Province/State</label>
                                        <input class="form-control" type="text" name="p_state" placeholder="Enter State" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">Postal/Zip Code</label>
                                        <input class="form-control" type="text" name="p_zip_code" placeholder="Email Postal/Zipcode" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">Email</label>
                                        <input class="form-control" type="text" name="p_email" placeholder="Enter Email" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="ex2">Landline</label>
                                        <input class="form-control" type="text" name="p_landline" placeholder="Enter Landline Number" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="ex2">Mobile</label>
                                        <input class="form-control" type="text" name="p_mobile" placeholder="Enter Mobile Number" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="ex2">Position</label>
                                        <input class="form-control" type="text" name="p_position" placeholder="Enter Position" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="ex2">Type</label>
                                        <input class="form-control" type="text" name="p_type_designation" placeholder="Enter Type" required>
                                    </div>
                                </div>
                            </div>
                            {{--END PRIMARY CONTACT DETAILS--}}

                            {{--START SECONDARY CONTACT DETAILS--}}
                            <h1>Secondary Contact Details</h1>
                            <div class="step-content">
                                <h3 class="m-t-none m-b">Secondary Contact Details</h3>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">First Name</label>
                                        <input class="form-control" type="text" name="s_first_name" placeholder="Enter First Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">Middle Name</label>
                                        <input class="form-control" type="text" name="s_middle_name" placeholder="Enter Middle Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">Last Name</label>
                                        <input class="form-control" type="text" name="s_last_name" placeholder="Enter Last Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="ex2">Address</label>
                                        <input class="form-control" type="text" name="s_address_1" placeholder="Enter Complete Address" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="ex2">City</label>
                                        <input class="form-control" type="text" name="s_city" placeholder="Enter City" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">Province/State</label>
                                        <input class="form-control" type="text" name="s_state" placeholder="Enter State" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">Postal/Zip Code</label>
                                        <input class="form-control" type="text" name="s_zip_code" placeholder="Email Postal/Zipcode" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">Email</label>
                                        <input class="form-control" type="text" name="s_email" placeholder="Enter Email" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="ex2">Landline</label>
                                        <input class="form-control" type="text" name="s_landline" placeholder="Enter Landline Number" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="ex2">Mobile</label>
                                        <input class="form-control" type="text" name="s_mobile" placeholder="Enter Mobile Number" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="ex2">Position</label>
                                        <input class="form-control" type="text" name="s_position" placeholder="Enter Position" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="ex2">Type</label>
                                        <input class="form-control" type="text" name="s_type_designation" placeholder="Enter Type" required>
                                    </div>
                                </div>
                            </div>
                            {{--END SECONDARY CONTACT DETAILS--}}

                            {{--START BILL TO CONTACT DETAILS--}}
                            <h1>Bill To Contact Details</h1>
                            <div class="step-content">
                                <h3 class="m-t-none m-b">Bill To Contact Details</h3>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="ex2">Company Name</label>
                                        <input class="form-control" type="text" name="b_branch_name" placeholder="Enter Company Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">First Name</label>
                                        <input class="form-control" type="text" name="b_first_name" placeholder="Enter First Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">Middle Name</label>
                                        <input class="form-control" type="text" name="b_middle_name" placeholder="Enter Middle Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">Last Name</label>
                                        <input class="form-control" type="text" name="b_last_name" placeholder="Enter Last Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="ex2">Address</label>
                                        <input class="form-control" type="text" name="b_address_1" placeholder="Enter Complete Address" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">City</label>
                                        <input class="form-control" type="text" name="b_city" placeholder="Enter City" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">Province/State</label>
                                        <input class="form-control" type="text" name="b_state" placeholder="Enter State" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">Postal/Zip Code</label>
                                        <input class="form-control" type="text" name="b_zip_code" placeholder="Email Postal/Zipcode" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">Email</label>
                                        <input class="form-control" type="text" name="b_email" placeholder="Enter Email" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">Landline</label>
                                        <input class="form-control" type="text" name="b_landline" placeholder="Enter Landline Number" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ex2">Mobile</label>
                                        <input class="form-control" type="text" name="b_mobile" placeholder="Enter Mobile Number" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="ex2">Position</label>
                                        <input class="form-control" type="text" name="b_position" placeholder="Enter Position" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="ex2">Type</label>
                                        <input class="form-control" type="text" name="b_type_designation" placeholder="Enter Type" required>
                                    </div>
                                </div>
                            </div>
                            {{--START BILL TO CONTACT DETAILS--}}

                        </div>
                    </div>
                </div>
            </div>

        </div> {{-- row end --}}
    </form> {{-- form end --}}
</div>{{-- wrapper end --}}
@endsection


@section('scripts')
    <script>
        $(document).ready(function(){
            $("#wizard").steps();
            $(".actions.clearfix").hide();
            $("li").removeClass('disabled').addClass('done');
            $("li:first-child").removeClass('done');
        });
    </script>
@endsection