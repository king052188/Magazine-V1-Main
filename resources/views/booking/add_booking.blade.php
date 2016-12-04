@extends('layout.magazine_main')

@section('title')
    Add New Magazine
@endsection

@section('styles')
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Booking</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/booking/add-booking') }}">Booking List</a>
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
    <div class="row">
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Create New Booking <small> *all fields are required</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" action="{{ url('/booking/magazine-transaction-save-process') }}" method="post">
                                <div class="form-group">
                                    <label>Trans Code</label>
                                    <input class="form-control" id="ex2" type="text" value = "{{ $n_booking['id'] }}" name = "trans_num" readonly>
                                </div>

                                <input class="form-control" placeholder="Sales Representative Code" id="ex2" type="hidden" value = "{{ $_COOKIE['Id'] }}" name = "sales_rep_code">

                                <div class="form-group">
                                    <label>Client ID <i>(UID of client_contacts_table)</i></label>

                                    <div class="input-group">
                                        <input type="text" class="form-control hidden" name="client_id" id="clientIdField" value="" required>
                                        <input type="text" class="form-control" placeholder="Client ID" id="clientIdFieldView">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#modal_client"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="ex2">Agency ID</label>

                                    <div class="input-group">
                                        <input type="text" class="form-control hidden" name="agency_id" id="agencyIdField" value="">
                                        <input type="text" class="form-control" placeholder="Agency ID"  id="agencyIdFieldView">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#modal_agency"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="ex2">Select Country</label>
                                    <select class = "form-control" name = "which_country">
                                        <option value = "1">US</option>
                                        <option value = "2">Canada</option>
                                    </select>
                                </div>
                                <div>
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <button class="btn btn-sm btn-primary pull-right" type="submit"><strong>Create New Magazine</strong></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <style>

                    .m_button {
                        display: inline-block;
                        padding: 0px 12px;
                        margin-bottom: 0;
                        font-weight: 400;
                        line-height: 1.42857143;
                        text-align: center;
                        -ms-touch-action: manipulation;
                        touch-action: manipulation;
                        -webkit-user-select: none;
                        -moz-user-select: none;
                        -ms-user-select: none;
                        user-select: none;
                        background-image: none;
                        border: 1px solid transparent;
                        border-radius: 4px;
                    }

                    .m_button_design {
                        background-color: #3FD127;
                        border-color: #3FD127;
                        color: #FFFFFF;
                    }

                    .m_button_design:hover {
                        background-color: #FFFFFF;
                        border-color: #3FD127;
                        color: #3FD127;
                    }

                </style>

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
                                      <input type="text" class="form-control" id="executeSearchClient" placeholder="Search for...">
                                </div>

                                <ul class="list-group list_client" id="searchResultClient">
                                </ul>
                                
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
                                      <input type="text" class="form-control" id="executeSearchAgency" placeholder="Search for...">
                                </div>
                                <ul class="list-group list_agency" id="searchResultAgency">
                
                                </ul>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
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

$('#executeSearchClient').on('keyup', function(){
    $value = $(this).val();
    $.ajax({
        type    : 'get',
        url     : '{{ URL::to('executeSearchClient') }}',
        data    : {'search':$value},
        success : function(data){
            if($value.length > 0){
                $('#searchResultClient').html(data);
            }else{
                $('#searchResultClient').html("");
            }
        }
    });
});

$('#executeSearchAgency').on('keyup', function(){
    $value = $(this).val();
    $.ajax({
        type    : 'get',
        url     : '{{ URL::to('executeSearchAgency') }}',
        data    : {'search':$value},
        success : function(data){
            if($value.length > 0){
                $('#searchResultAgency').html(data);
            }else{
                $('#searchResultAgency').html("");
            }
        }
    });
});

$(document).ajaxComplete(function (data) {
    $(".list_client li").click(function() {
        $('#clientIdField').val($(this).attr('id'));
        $('#clientIdFieldView').val($(this).text());
    });

    $(".list_agency li").click(function() {
        $('#agencyIdField').val($(this).attr('id'));
        $('#agencyIdFieldView').val($(this).text());
    });
});
</script>

@endsection