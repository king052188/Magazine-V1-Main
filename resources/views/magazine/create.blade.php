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
                            <script type="text/javascript" src="http://cheappartsguy.com/query/assets/js/jquery-1.9.1.min.js"></script>
                            <script>
                                $(document).ready(function(){
                                    $('#magcountry').on('change', function() {
                                        var magc_id = $(this).val();
                                        $.ajax({
                                            url: "/magazine/company/get_country/" + magc_id,
                                            dataType: "text",
                                            success: function(data) {
                                                var json = $.parseJSON(data);
                                                if (json == null) return false;
                                                if (json.result == 404) {
                                                    $("#cid").empty().append("<option>--no data--</option>")
                                                } else {
                                                    $(json.result).each(function(i, country) {
                                                        $("#cid").empty().append("<option>--select--</option>");
                                                        $("#cid").empty().append("<option value = '" + country.Id + "'>" + country.company_name + "</option>")
                                                    })
                                                }
                                            }
                                        })
                                    });
                                });
                            </script>
                            <form role="form" action="/magazine/add-new" method="POST">
                                <div class="form-group">
                                    <label>Magazine Code</label>
                                    <input type="text" placeholder="Magazine Code" class="form-control"  name="magcode" required>
                                </div>
                                <div class="form-group">
                                    <label>Magazine Name</label>
                                    <input type="text" placeholder="Magazine Name" class="form-control" name="magname" required>
                                </div>
                                <div class="form-group">
                                    <label for="ex2">Country</label>
                                    <select class="form-control" name="magcountry" id = "magcountry" required>
                                        <option>--select--</option>
                                        <option value="1">USA</option>
                                        <option value="2">CANADA</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <select class="form-control" name="cid" id = "cid" required>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ex2">Status</label>
                                    <select class="form-control" name="status" required>
                                        <option value="1">Inactive</option>
                                        <option value="2">Active</option>
                                    </select>
                                </div>
                                <div>
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <button class="btn btn-sm btn-primary pull-right"><strong>Create New Magazine</strong></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="modal_add_company_magazine" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Company Name of Magazine</h4>
            </div>
            <form role="form" action="{{ url('/magazine/company/save') }}" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" placeholder="Company / Business Name" class="form-control"  name="company_name">
                        </div>
                        <div class="form-group">
                            <label>Address 1</label>
                            <input type="text" placeholder="Address 1" class="form-control" name="address_1">
                        </div>
                        <div class="form-group">
                            <label>Address 2 (OPTIONAL)</label>
                            <input type="text" placeholder="Address 2 (OPTIONAL)" class="form-control" name="address_2">
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" placeholder="City" class="form-control"  name="city">
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" placeholder="State" class="form-control"  name="state">
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <select class="form-control" name="country">
                                <option value="1">USA</option>
                                <option value="2">CANADA</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" placeholder="Email" class="form-control"  name="email">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" placeholder="Phone" class="form-control"  name="phone">
                        </div>
                        <div class="form-group">
                            <label>Fax</label>
                            <input type="text" placeholder="Fax" class="form-control"  name="fax">
                        </div>
                        <div>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit"><strong>Create New Company</strong></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="http://localhost:5304/js/jquery-2.1.1.js"></script>

<script>

    $(document).ready(function() {

        $("#tab_2").hide();
        $("#tab_3").hide();

        $("#btn_create_new_mag").click(function() {
            $("#tab_1").hide( 600 );
            $("#tab_2").show("slide", { direction: "right" }, 5000);
        })

        $("#btn_back_1").click(function() {
            $("#tab_2").hide( 600 );
            $("#tab_1").show("slide", { direction: "right" }, 5000);


        })


    })

</script>
@endsection