@extends('layout.magazine_main')

@section('title')
    Add New Client
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
    <form role="form" action="{{ url('/client/save_client') }}" method="post">
        <div class="row">
        <div class="col-lg-4">
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
                        <div class="col-sm-6">
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
                                        <label>Member?</label>
                                        <input type="checkbox" name="is_member">
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Create Primary Contact <small> *all fields are required</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <label for="ex2">First Name</label>
                                    <input class="form-control" id="ex2" type="text" name="first_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="ex2">Middle Name</label>
                                    <input class="form-control" id="ex2" type="text" name="middle_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="ex2">Last Name</label>
                                    <input class="form-control" id="ex2" type="text" name="last_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="ex2">Address</label>
                                    <input class="form-control" id="ex2" type="text" name="address_1" required>
                                </div>
                                <div class="form-group">
                                    <label for="ex2">Email</label>
                                    <input class="form-control" id="ex2" type="text" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="ex2">Landline</label>
                                    <input class="form-control" id="ex2" type="text" name="landline" required>
                                </div>
                                <div class="form-group">
                                    <label for="ex2">Mobile</label>
                                    <input class="form-control" id="ex2" type="text" name="mobile" required>
                                </div>
                            </div>
                            <div>
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                <button class="btn btn-primary pull-right" type="submit">Create new client</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection


@section('scripts')
<script type="text/javascript">
    var max_fields      = 15; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

     //Add button ID

    var x = 1; //initial text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();

            var i      = 1;
        if(x < max_fields){ //max input box allowed
            //text box 
            $(wrapper).append("<div class='row'>",
                    "<div class='col-sm-4'>",
                        "<div class='form-group'>",
                            "<label>Client First Name</label>",
                            "<input class='inc' type='text' name='contact[" + x +"][first_name]' />",
                        "</div>",
                    "</div>",
                    "<div class='col-sm-4'>",
                        "<div class='form-group'>","<label>Client First Name</label>",
                            "<input type='text' name='contact[" + x +"][first_name]' />",
                        "</div>",
                    "</div>",
                    "<div class='col-sm-4'>",
                        "<div class='form-group'>",
                        "<label>Client First Name</label>",
                            "<input type='text' name='contact[" + x +"][first_name]' />",
                        '</div>',
                    '</div>',
                '</div>',
                    '<a href="#" class="remove_field">Remove</a></div>'); //add input box
          x++;
        };
  




    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
</script>
@endsection