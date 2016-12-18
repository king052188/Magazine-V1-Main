@extends('layout.magazine_main')

@section('title')
    Add New Magazine
@endsection

@section('styles')
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Magazine</h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>Add Magazine</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal_add_company_magazine">Add New Company</a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">

        <div id="tab_1" class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Create New Magazine<small> *all fields are required</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" action="/magazine/add-new" method="POST">
                                <div class="form-group">
                                    <label>Magazine Code</label>
                                    <input type="text" placeholder="Magazine Code" class="form-control" name="magcode" id="magcode" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Magazine Name</label>
                                    <input type="text" placeholder="Magazine Name" class="form-control" name="magname" id="magname">
                                </div>
                                <div class="form-group">
                                    <label for="ex2">Country</label>
                                    <select class="form-control" name="magcountry" id = "magcountry" required>
                                        <option>--select--</option>
                                        <option value="1">USA</option>
                                        <option value="2">CANADA</option>
                                    </select>
                                </div>
                                <div class="form-group" id = "hidden">
                                    <label>Company Name</label>
                                    <select class='form-control' name='cid' id = 'cid' required>
                                    </select>
                                </div>
                                <div class="form-group col-lg-4" id = "hidden">
                                    <label>Status</label>
                                    <select class='form-control' name='status' required><option value='1'>Inactive</option><option value='2'>Active</option></select>
                                </div>
                                <div class="form-group col-lg-4" id = "hidden">
                                    <label>Year Issue</label>
                                    <select class='form-control' name='year_issue' id = 'year_issue_selected' required>
                                        @for($i = date('Y'); $i < date('Y') + 10; $i++)
                                            <option value='{{ $i }}'>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group col-lg-4" id = "hidden">
                                    <label>Numbers of Issue</label>
                                    <input type='number' placeholder='Enter Issue Number' min="1" max="125" class='form-control' name='number_issue' id = "number_issue" value = '1'>
                                </div>
                                <div id = "hidden">
                                    <input type='hidden' name='_token' id='csrf-token' value='{{ Session::token() }}' /><button class='btn btn-sm btn-primary pull-right' id='btn_submit'>Create New Magazine</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="tab_1" class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Create New Magazine<small> *all fields are required</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class = "form-group">
                                <input type = "hidden" name = "logo_uid" value = "{{ $logo_uid['id_magazine'] }}">
                                <?php
                                $assembly = new \App\Http\Controllers\AssemblyClass();
                                $url_api = $assembly::get_reports_api();
                                $logo_uploader_url = 'http://'. $url_api["Url_Logo_Uploader"] .'type=MAGAZINE&uid='. $logo_uid['id_magazine'];
                                ?>
                                <iframe src = "{{ $logo_uploader_url }}" style="width: 100%; height: 375px" frameborder="0" scrolling="no"> </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="modal_add_company_magazine" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Company Name of Magazine</h4>
            </div>
            <form role="form" action="{{ url('/magazine/company/save') }}" method="post">
                <div class="col-lg-12">
                    <div class="modal-body form group">
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
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Create New Company</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {

    $("div#hidden").hide();

//    function readURL(input) {
//        if (input.files && input.files[0])
//        {
//            var reader = new FileReader();
//            reader.onload = function (e) {
//                $('#logo_preview').attr('src', e.target.result);
//            }
//            reader.readAsDataURL(input.files[0]);
//        }
//    }

    $('#magname').keyup(function() {
        var value = $(this).val().replace(/ /g, "-");
        $('#magcode').val(value.toLowerCase());
    });

    $("#logo").change(function(){
        readURL(this);
    });

    $("#tab_2").hide();
    $("#tab_3").hide();

    $("#btn_create_new_mag").click(function() {
        $("#tab_1").hide( 600 );
        $("#tab_2").show("slide", { direction: "right" }, 5000);
    });

    $("#btn_back_1").click(function() {
        $("#tab_2").hide( 600 );
        $("#tab_1").show("slide", { direction: "right" }, 5000);
    });

    $('#magcountry').on('change', function() {
        var magc_id = $(this).val();
        $.ajax({
            url: "/magazine/company/get_country/" + magc_id,
            dataType: "text",
            success: function(data) {
                var json = $.parseJSON(data);
                if (json == null) return false;
                if (json.result == 404) {
                    $("div#hidden").hide();
                    $("#cid").empty().append("<option>--no data--</option>");
                } else {
                    $("div#hidden").show();
                    $("#cid").empty();
                    $(json.result).each(function(i, country) {
                        $("#cid").append("<option value = '" + country.Id + "'>" + country.company_name + "</option>")
                    });
                }
            }
        });
    });
});
</script>

<script>
    $('#btn_submit').on('click',function(){
        var magname = $("#magname").val();
        var number_issue = $("#number_issue").val();
        if(magname == ""){
            swal(
                    'Oops...',
                    'Magazine Name is required!',
                    'warning'
            )
            return false;
        }
        if(number_issue == ""){
            swal(
                    'Oops...',
                    'Number of Issue is required!',
                    'warning'
            )
            return false;
        }
        if(parseInt(number_issue) > 125){
            swal(
                    'Oops...',
                    'Maximum number of Ad Amount is 125!',
                    'warning'
            )
            return false;
        }
    });
</script>
@endsection