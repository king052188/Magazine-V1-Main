@extends('layout.magazine_main')

@section('title')
    Magazines List
@endsection

@section('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Magazine</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Magazine</a>
            </li>
            <li class="active">
                <strong>List of all Magazine</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Magazine List</h5>
                </div>
                <div class="ibox-content">
                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-responsive MagazineListdataTables" >
                            <thead>
                            <tr>
                                <th style="text-align: center; width: 200px;">Code</th>
                                <th style="text-align: center; ">Magazine Name</th>
                                <th style="text-align: center; width: 100px;">Country</th>
                                <th style="text-align: center; width: 120px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($magazines as $magazine)
                                    <tr>
                                        <td>{{ $magazine->mag_code }}</td>
                                        <td>{{ $magazine->magazine_name }}</td>
                                        <td style="text-align: center;">{{ $magazine->magazine_country == 1 ? "US" : "CANADA" }}</td>
                                        <td style="text-align: center;">
                                            <a href = "{{ URL('/magazine/add-ad-color-and-size') . '/'. $magazine->Id }}" class="btn btn-xs btn-primary" style = "padding: 0px 5px 0px 5px; margin: -5px -5px -5px -5px;"><i class="fa fa-list-alt"></i>&nbsp;&nbsp;View</a>
                                            &nbsp;
                                            <a href = "" onclick="return edit_magazine({{ $magazine->Id }});" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_edit_magazine" style = "padding: 0px 5px 0px 5px; margin: -5px -5px -5px 2px;"><i class="fa fa-edit" title = "Edit Magazine"></i> Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function edit_magazine($magazine_uid) {
        var magazine_uid = $magazine_uid;

        console.log(magazine_uid);

        $.ajax({
            url: "/magazine/update/" + magazine_uid,
            dataType: "text",
            success: function(data) {
                var json = $.parseJSON(data);
                if (json == null) return false;
                if (json.result == 404) {
                    console.log("error " . magazine_uid);
                } else {
                    $(json.result).each(function(i, magazine) {
                        console.log(magazine.mag_code);
                        $("div#hidden").show();
//                            $("#cid").append("<option value = '" + country.Id + "'>" + country.company_name + "</option>")
//                        if(contact.role == 3){
//
//                            $("#contact_role_handler").removeClass('col-lg-12').addClass('col-lg-6');
//                            $("#contact_company_name_show").show();
//                        }else{
//                            $("#contact_company_name_show").hide();
//                            $("#contact_role_handler").removeClass('col-lg-6').addClass('col-lg-12');
//                        }
//
//                        if(contact.status == 2){
//                            $('#status').prop('checked', true);
//                        }else{
//                            $('#status').prop('checked', false);
//                        }

//
                        $("#magazine_uid").val(magazine.Id);
                        $("#magcode").val(magazine.mag_code);
                        $("#magname").val(magazine.magazine_name);
                        $("#magcountry").val(magazine.magazine_country);
                        $("#cid").val(magazine.company_id);
                        $("#status").val(magazine.status);
                        $("#year_issue_selected").val(magazine.magazine_year);
                        $("#number_issue").val(magazine.magazine_issues);



                        populate_cid(magazine.company_id, magazine.magazine_country);

                    });
                }
            }
        });

        function populate_cid(magc_id, mag_country)
        {
            console.log("Company ID: " + magc_id);
            console.log("Mag Country: " + mag_country);

            $.ajax({
                url: "/magazine/company/get_country/" + mag_country,
                dataType: "text",
                success: function(data) {
                    var json = $.parseJSON(data);
                    if (json == null) return false;
                    if (json.result == 404) {
//                        $("div#hidden").hide();
                        $("#cid").empty().append("<option>--no data--</option>");
                    } else {
                        $("div#hidden").show();

//                        $(".comp_name").empty().append("<select class='form-control' name='cid' id = 'cid' required>");
                        $(json.result).each(function(i, country) {
                            var sel = "";
                            if(country.Id == magc_id)
                            {
                                sel = "selected";
                            }

                            $("#cid").empty().append("<option value = '" + country.Id + "' selected = '"+ sel +"'>" + country.company_name +"-"+ country.Id + "</option>")
                        });
//                        $(".comp_name").append("</select>");
                    }
                }
            });
        }
    }
</script>

<div class="modal fade" id="modal_edit_magazine" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form role="form" action="{{ URL('/magazine/update/save') }}" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Edit Magazine</h4>
                </div>

                <div class="col-lg-12">
                    <div class="modal-body form group">
                            <div class="form-group">
                                <label>Magazine Code</label>
                                <input type="hidden" placeholder="Magazine Code" name="magazine_uid" id="magazine_uid">
                                <input type="text" placeholder="Magazine Code" class="form-control" name="magcode" id="magcode" readonly>
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
                            <div class="form-group comp_name" id = "hidden">
                                <label>Company Name</label>

                                <select class='form-control' name='cid' id = 'cid' required>

                                </select>
                            </div>
                            <div class="form-group col-lg-4" id = "hidden">
                                <label>Status</label>
                                <select class='form-control' id = "status" name='status' required><option value='1'>Inactive</option><option value='2'>Active</option></select>
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
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
<script>
    $(document).ready( function() {
        $("div#hidden").hide();

        $('.MagazineListdataTables').DataTable({
        dom: '<"html5buttons"B>lTfgitp',
        buttons: []
        });

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
@endsection