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
                            {{--<div class="input-group">--}}
                                {{--<input type="hidden" class="form-control" name="client_id" id="clientIdField" value="">--}}
                                {{--<input type="text" class="form-control" placeholder="(Company Name) Click Search..." id="clientIdFieldView" required disabled>--}}
                                {{--<span class="input-group-btn">--}}
                                    {{--<button class="btn btn-info" type="button" data-toggle="modal" data-target="#modal_client">Search <i class="fa fa-search"></i></button>--}}
                                {{--</span>--}}
                            {{--</div>--}}
                            <select class="form-control chosen-select" style = "background: none;" name = "client_id" id = "clientIdField">
                                <option value="">Select</option>
                                @for($i = 0; $i < COUNT($clients); $i++)
                                    <option value = "{{ $clients[$i]->Id }}">{{ $clients[$i]->company_name }}</option>
                                @endfor
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

</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $("#clientIdField").change(function(){

            var client_id = $(this).val();

            $.ajax({
                url: "/search/bill-to/" + client_id,
                dataType: "text",
                beforeSend: function () {
                },
                success: function(data) {
                    var json = $.parseJSON(data);
                    if (json == null)
                        return false;

                    if(json.status == 200)
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