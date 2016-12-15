@extends('layout.magazine_main')

@section('title')
    Add New Client
@endsection

@section('styles')
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
            <div class="col-lg-12">
                <div class="ibox float-e-margins"> {{-- ibox start --}}

                    <div class="ibox-title">
                        <h5>Create Client <small> *all fields are required</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="col-lg-6">
                                    <h3 class="m-t-none m-b">Company Details</h3>
                                    <div class="form-group">
                                        <label>Client/Company Name</label>
                                        <input type="text" placeholder="Client / Company Name" class="form-control"  name="company_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="ex2">Type</label>
                                        <select class="form-control" name = "type" required>
                                            @for($i = 0; $i < COUNT($result); $i++)
                                                <option value = "{{ $result[$i]->Id }}">{{ $result[$i]->name }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox checkbox-primary">
                                            <input id="checkbox2" class="styled" type="checkbox" name="is_member" unchecked>
                                            <label for="checkbox2">
                                                Member?
                                            </label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <h3 class="m-t-none m-b">Primary Contact Details</h3>
                                    <div class="col-lg-6">   
                                        <div class="form-group">
                                            <label for="ex2">First Name</label>
                                            <input class="form-control" type="text" name="first_name" placeholder="First Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">   
                                        <div class="form-group">
                                            <label for="ex2">Middle Name</label>
                                            <input class="form-control" type="text" name="middle_name" placeholder="Middle Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ex2">Last Name</label>
                                            <input class="form-control" type="text" name="last_name" placeholder="Last Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ex2">Address</label>
                                            <input class="form-control" type="text" name="address_1" placeholder="Complete Address" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">   
                                        <div class="form-group">
                                            <label for="ex2">Email</label>
                                            <input class="form-control" type="text" name="email" placeholder="Email Address" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ex2">Landline</label>
                                            <input class="form-control" type="text" name="landline" placeholder="Landline Number" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ex2">Mobile</label>
                                            <input class="form-control" type="text" name="mobile" placeholder="Mobile Number" required>
                                        </div>
                                    </div>
                        
                                </div>
                                            <div class="form-group" >
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                        <button class="btn btn-primary pull-right" type="submit">Create new client</button>
                                    </div>


                            </div>
                        </div>
                    </div>

                </div> {{-- ibox end  --}}
                
            </div>
        </div> {{-- row end --}}
    </form> {{-- form end --}}
</div>{{-- wrapper end --}}
@endsection


@section('scripts')
@endsection