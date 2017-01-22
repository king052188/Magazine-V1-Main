@extends('layout.magazine_main')

@section('title')
    Add New Magazine
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{  asset('css/plugins/steps/jquery.steps.css')  }}">
<link href="{{  asset('css/plugins/chosen/chosen.css')  }}" rel="stylesheet">
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Booking</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/booking/booking-list') }}">Booking List</a>
            </li>
            <li class="active">
                <strong>Add Booking</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="container">
        <div class="row form-group mb0">
            <div class="col-xs-12">
                <ul class="nav nav-pills nav-justified thumbnail setup-panel" style="margin-bottom: 5px;">
                    <li class="active" style="background: #337ab7;"><a href="#step-1" style="padding: 0px 20px 0px 25px;">
                        <h4 class="list-group-item-heading">Step 1</h4>
                        <p class="list-group-item-text">Add Booking Details</p>
                    </a></li>
                    <li class="disabled"><a href="#step-2" style="padding: 0px 20px 0px 25px;>
                        <h4 class="list-group-item-heading">Step 2</h4>
                        <p class="list-group-item-text">Select Magazine</p>
                    </a></li>
                    <li class="disabled"><a href="#step-3" style="padding: 0px 20px 0px 25px;>
                        <h4 class="list-group-item-heading">Step 3</h4>
                        <p class="list-group-item-text">Add Issue</p>
                    </a></li>
                </ul>
            </div>
        </div>
        <div class="row setup-content" id="step-1">
            <div class="col-xs-12">
                <div class="col-md-12 well white-bg">

                    <form role="form" action="{{ url('/booking/magazine-transaction-save-process') }}" method="post">
                        <div class="form-group">
                            <label>Trans Code</label>
                            <input class="form-control" id="ex2" type="text" value = "{{ $n_booking['id'] }}" name = "trans_num" readonly>
                        </div>

                        <input class="form-control" placeholder="Sales Representative Code" id="ex2" type="hidden" value = "{{ $_COOKIE['Id'] }}" name = "sales_rep_code">

                        <div class="form-group">
                            <label>Company</label>

                            <select class="form-control chosen-select" style = "background: none;" name = "client_id" id = "clientIdField">
                                <option value="0">Select</option>
                                @for($i = 0; $i < COUNT($clients); $i++)
                                    <option value = "{{ $clients[$i]->Id }}">{{ $clients[$i]->company_name }}</option>
                                @endfor
                                <option value="99">aSelect</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="ex2">Agency <i>(if any)</i></label>
                            <input type="hidden" class="form-control" name="agency_id" id="agencyIdField" value="">
                            <input type="text" class="form-control" placeholder="(Agency Name) Click Search..."  id="agencyIdFieldView" disabled>
                            {{--<span class="input-group-btn">--}}
                                {{--<button class="btn btn-info" type="button" data-toggle="modal" data-target="#modal_agency" >Search <i class="fa fa-search"></i></button>--}}
                            {{--</span>--}}
                        </div>

                        <div class="form-group">
                            <label for="ex2">Select Country of Magazine</label>
                            <select class = "form-control" name = "which_country" id = "which_country">
                                <option value = "">-- Select Country --</option>
                                <option value = "1">USA</option>
                                <option value = "2">Canada</option>
                            </select>
                        </div>
                        <div>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <button class="btn btn-md btn-primary pull-right" id="btn_submit" type="submit">Create</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_client" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Client List</h4>
                </div>
                <div class="modal-body">

                   <div class="form-group">
                          <p><i>Type a Phrase or Keyword</i>*</p>
                          <input type="text" class="form-control" id="executeSearchClient" placeholder="Search for...">
                    </div>

                    <table class="table table-bordered">
                      <thead class="resultheader hidden">
                        <tr>
                          <th>Company Name</th>
                          <th>Type</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="searchResultClient">
                      </tbody>
                    </table>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_agency" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Agency List</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                          <p><i>Type a Phrase or Keyword</i>*</p>
                          <input type="text" class="form-control" id="executeSearchAgency" placeholder="Search for...">
                    </div>

                    <table class="table table-bordered">
                      <thead class="resultheader hidden">
                        <tr>
                          <th>Company Name</th>
                          <th>Type</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="searchResultAgency">
                      </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_search_category_and_group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Category and Group List</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p><i><b>Select Category</b></i></p>
                        <select class = "form-control" name = "category" id = "category">
                            <option value = "">--select--</option>
                            <option value = "1">Print</option>
                            <option value = "2">Digital</option>
                            <option value = "3">Bulletin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <p id = "select_group_label"></p>
                        <div id = "select_group"></div>
                    </div>

                    <p id = "contacts_label"></p>
                    <table class="table table-bordered" id = "contacts_of_group" style = "display: none;">
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning pull-left" id = "btn_default_bill_to" title = "Use Default Bill To">Use Default Billing Contact</button>
                    <button type="button" class="btn btn-secondary" id = "btn_category_close">Close</button>
                    <a class="btn btn-primary" id = "btn_category_done" style = "display: none;">Done</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){

        function search_group_by_category(client_id){
            //var category = $("#category").val();

            $("#category").change(function(){

                $("#contacts_of_group").hide();
                $("#contacts_label").hide();
                $("#select_group_label").hide();
                $("#select_group").hide();

                var category = $(this).val();

                if(category == "")
                {
                    $("#contacts_of_group").hide();
                    $("#contacts_label").hide();
                    $("#select_group_label").hide();
                    $("#select_group").hide();
                }
                else
                {
                    $.ajax({
                        url: "/search/search-group-by-category/" + client_id + "/" + category,
                        dataType: "text",
                        beforeSend: function () {
                        },
                        success: function (data) {
                            var json = $.parseJSON(data);
                            if (json == null)
                                return false;

                            if (json.Code == 200) {
                                $("#select_group_label").show();
                                $("#select_group").show();
                                $("#select_group_label").empty().append('<i><b>Select Group</b></i>');
                                $("#select_group").empty().append('<select class = "form-control" id = "list_group_select">');
                                $("#list_group_select").append('<option value = "">--select--</option>');
                                $(json.result).each(function(i, groups){
                                    $("#list_group_select").append('<option value = '+ groups.Id +'>'+ groups.group_name +'</option>');
                                });
                                $("#select_group").append('</select>');

                                $("#list_group_select").change(function(){
                                    search_contact_by_group($(this).val());
                                });
                            }
                        }
                    });
                }
            });
        }

        function search_contact_by_group(group_uid){
            if(group_uid == ""){

            }else{
                html_thmb = "";
                $.ajax({
                    url: "/search/search-contact-by-group/" + group_uid,
                    dataType: "text",
                    beforeSend: function () {
                    },
                    success: function (data) {
                        var json = $.parseJSON(data);
                        if (json == null)
                            return false;

                        if (json.Code == 200) {
                            console.log(group_uid);
                            $("#contacts_of_group").show();
                            $("#contacts_label").empty().append('<i><b>List Of Contacts</b></i>');
                            $(json.result).each(function (i, contact) {

                                if(contact.role_id == 1){
                                    var role = "Primary";
                                }else if(contact.role_id == 2){
                                    var role = "Secondary";
                                }else if(contact.role_id == 3){
                                    $("#btn_category_done").show();
                                    var role = "Bill To";
                                    var bill_to_contact_uid = contact.contact_id;
                                    var bill_to_name = contact.first_name + " " + contact.last_name + " (" + json.group_name + ")";
                                }

                                html_thmb += "<tr>";
                                html_thmb += "<td style='text-align: left; font-weight: bold;'>"+ role +"</td>";
                                html_thmb += "<td style='text-align: left;'>"+ contact.first_name + " " + contact.last_name +"</td>";
                                html_thmb += "</tr>";


                                $("#btn_category_done").click(function(){
                                    $("#agencyIdField").val(bill_to_contact_uid);
                                    $("#agencyIdFieldView").val(bill_to_name);
                                    $('#modal_search_category_and_group').modal('hide');
                                });

                            });

                            $('table#contacts_of_group > tbody').empty().prepend(html_thmb);
                        }
                        else if (json.Code == 404)
                        {
                            $("#btn_category_done").hide();
                            $('table#contacts_of_group > tbody').empty().prepend("<tr><td colspan = '3' style = 'color: #FF0000;'>"+ json.result +"</td></tr>");
                        }
                    }
                });
            }

        }

        $("#clientIdField").change(function(){

            var client_id = $(this).val();

            $.ajax({
                url: "/booking/get-client-contacts/" + client_id,
                dataType: "text",
                beforeSend: function () {
                },
                success: function(data) {
                    var json = $.parseJSON(data);
                    if (json == null)
                        return false;

                    if(json.Code == 200)
                    {
                        $('#modal_search_category_and_group').modal({
                            show: true
                        });

                        search_group_by_category(client_id);

                        $('#agencyIdFieldView').val("Searching...");

                        $('#btn_category_close').click(function () {
                            $('#modal_search_category_and_group').modal('hide');
                            $('#clientIdField').val("0");
                            if($('#clientIdField').val() == 0)
                            {
                                swal({
                                    title: "",
                                    text: "Please select group",
                                    type: "warning"
                                }).then(
                                        function() {
                                            location.reload();
                                        }
                                )
                            }
                        });

                        $("#btn_default_bill_to").click(function(){
                            $.ajax({
                                url: "/use-default-bill-to/" + client_id,
                                dataType: "text",
                                beforeSend: function () {
                                },
                                success: function (data) {
                                    var json = $.parseJSON(data);
                                    if (json == null)
                                        return false;

                                    if (json.Code == 200) {
                                        $(json.result).each(function(a, bill_to){
                                            $('#agencyIdField').val(bill_to.Id);
                                            $('#agencyIdFieldView').val(bill_to.first_name + " " + bill_to.last_name + " (Billing Contact)");
                                            $('#modal_search_category_and_group').modal('hide');
                                        });
                                    }
                                    else
                                    {
                                        $('#agencyIdField').val("");
                                        $('#agencyIdFieldView').val("No Agency");
                                    }
                                }
                            });
                        });
                    }
                    else if(json.Code == 201)
                    {
                        $('#agencyIdField').val(json.bill_to_uid);
                        $('#agencyIdFieldView').val(json.bill_to);
                    }
                    else
                    {
//                        console.log("Error in search_bill_to");
                        $('#agencyIdField').val("");
                        $('#agencyIdFieldView').val("No Agency");
                    }
                }
            });
        });


    });
</script>
<script type="text/javascript">
$('#executeSearchClient').on('keyup', function(){
    $value = $(this).val();
    $.ajax({
        type    : 'get',
        url     : '{{ URL::to('/execute/search/booking-and-sales') }}',
        data    : {'search': $value, 'type': "1"},
        success : function(data){
            if($value.length > 0){
                $('#searchResultClient').html(data);
                $('.resultheader').removeClass('hidden');
            }else{
                $('#searchResultClient').html("");
                $('.resultheader').addClass('hidden');
            }
        }
    });
});



{{--$('#executeSearchAgency').on('keyup', function(){--}}
    {{--$value = $(this).val();--}}
    {{--$.ajax({--}}
        {{--type    : 'get',--}}
        {{--url     : '{{ URL::to('/execute/search/booking-and-sales') }}',--}}
        {{--data    : {'search': $value, 'type': "2"},--}}
        {{--success : function(data){--}}
            {{--if($value.length > 0){--}}
                {{--$('#searchResultAgency').html(data);--}}
                {{--$('.resultheader').removeClass('hidden');--}}
            {{--}else{--}}
                {{--$('#searchResultAgency').html("");--}}
                {{--$('.resultheader').addClass('hidden');--}}
            {{--}--}}
        {{--}--}}
    {{--});--}}
{{--});--}}

$(document).ajaxComplete(function (data) {
    $(".list_client").click(function() {
        $('#clientIdField').val($(this).closest('tr').attr('id'));
        $('#clientIdFieldView').val($(this).closest('tr').attr('class'));

        $('#agencyIdField').val($(this).closest('tr').attr('get_data'));
        $('#agencyIdFieldView').val($(this).closest('tr').attr('name')); //bill to details

        $('.resultheader').addClass('hidden');
    });

    $(".list_agency").click(function() {
        $('#agencyIdField').val($(this).closest('tr').attr('id'));
        $('#agencyIdFieldView').val($(this).closest('tr').attr('class'));
        $('.resultheader').addClass('hidden');
    });
});
</script>
<script>
    $('#btn_submit').on('click',function(){
        var client_field = $("#clientIdField").val();
        var which_country = $("#which_country").val();
        if(client_field == ""){
            swal(
                    'Oops...',
                    'Company Name is required!',
                    'warning'
            )
            return false;
        }

        if(which_country == ""){
            swal(
                    'Oops...',
                    'Country name is required!',
                    'warning'
            )
            return false;
        }
    });
</script>

<!-- Chosen -->
<script src="{{ asset('js/plugins/chosen/chosen.jquery.js') }}"></script>
<script>
    var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
</script>

@endsection