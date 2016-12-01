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
                            <form role="form" action="{{ url('/client/save_client') }}" method="post">
                                <div class="form-group">
                                    <label>Client/Company Name</label>
                                    <input type="text" placeholder="Client Code" class="form-control"  name="company_name">
                                </div>
                                <div class="form-group">
                       
                            <label for="ex2">Type</label>
                            <select class="form-control" name = "type">
                                @for($i = 0; $i < COUNT($result); $i++)
                                    <option value = "{{ $result[$i]->Id }}">{{ $result[$i]->name }}</option>
                                @endfor
                            </select>
                                </div>

                                <div>
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <button class="btn btn-primary pull-right" type="submit"><strong>Create New Client</strong></button>
                                </div>


   <!--                      <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Client First Name</label>
                                    <input type='text' name='contact[0][first_name]' />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Client middle Name</label>
                                    <input type='text' name='contact[0][middle_name]' />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Client last Name</label>
                                    <input type='text' name='contact[0][last_name]' />
                                </div>
                            </div>
                        </div>


                                    <div class="input_fields_wrap">
                                        <a class="add_field_button">Add</a>
                                    </div>
 -->





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