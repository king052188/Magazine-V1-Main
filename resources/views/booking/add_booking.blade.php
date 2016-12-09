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
                $('.resultheader').removeClass('hidden');
            }else{
                $('#searchResultClient').html("");
                $('.resultheader').addClass('hidden');
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
                $('.resultheader').removeClass('hidden');
            }else{
                $('#searchResultAgency').html("");
                $('.resultheader').addClass('hidden');
            }
        }
    });
});

$(document).ajaxComplete(function (data) {
    $(".list_client").click(function() {
        $('#clientIdField').val($(this).closest('tr').attr('id'));
        $('#clientIdFieldView').val($(this).closest('tr').attr('class'));
    });

    $(".list_agency").click(function() {
        $('#agencyIdField').val($(this).closest('tr').attr('id'));
        $('#agencyIdFieldView').val($(this).closest('tr').attr('class'));
    });
});

</script>

@endsection