@extends('layout.magazine_main')

@section('title')
    Add New Booking and Sales
@endsection

@section('styles')
<link href="{{ asset('css/plugins/select2/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Booking and Sales</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Booking and Sales</a>
            </li>
            <li class="active">
                <strong>New Booking and Sales</strong>
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
                    <h5>New Booking and Sales <small> *all fields are required</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" action="{{ url('/transaction/store') }}" method="post">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Sales Representative Code</label>
                                        <input type="text" placeholder="Sales Representative Code" class="form-control srepremove"  name="srepcode" id="srepfield">
                                        <a type="button" class="pull-right" data-toggle="modal" data-target="#srepcode"><i class="fa fa-search pull-right srepremove"
                                            style="float: right;
                                            margin-right: 6px;
                                            margin-top: -23px;
                                            position: relative;
                                            z-index: 2;"></i></a>
                                    </div>
                                    <div class="form-group">
                                        <label>Client Code</label>
                                        <input type="text" placeholder="Client Code" class="form-control"  name="client_code">

                                    </div>
                                    <div class="form-group">
                                        <label>Magazine Code</label>
                                        <input type="text" placeholder="Magazine Code" class="form-control" name="magcode" id="magcodefield">
                                        <a type="button" class="pull-right" data-toggle="modal" data-target="#magcode"><i class="fa fa-search pull-right"
                                            style="float: right;
                                            margin-right: 6px;
                                            margin-top: -23px;
                                            position: relative;
                                            z-index: 2;"></i></a>
                                    </div>
                                    <div class="form-group">
                                        <label>Agency Code</label>
                                        <input type="text" placeholder="Agency Code" class="form-control" name="agencycode">
                                    </div>
                                    <div class="form-group">
                                        <label>Contract ID</label>
                                        <input type="text" placeholder="Contract ID" class="form-control"  name="contract_id">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>AD Code</label>
                                        <input type="text" placeholder="AD Code" class="form-control"  name="ad_code">
                                    </div>
                                    <div class="form-group">
                                        <label>AD Size</label>
                                        <input type="text" placeholder="AD Size" class="form-control"  name="ad_size">
                                    </div>
                                    <div class="form-group">
                                        <label>Number of Issue</label>
                                        <input type="number" placeholder="Number of Issue" class="form-control"  name="numberofissue">
                                    </div>
                                    <div class="form-group">
                                        <label>Contract Amount</label>
                                        <input type="text" placeholder="Contract Amount" class="form-control"  name="contract_amount">
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <input type="text" placeholder="Status" class="form-control"  name="status">
                                    </div>
                                    <div>
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                        <button class="btn btn-primary pull-right" type="submit"><strong>Create New Transaction</strong></button>
                                    </div>
                                </div>
                            </form>

                            <div class="modal fade" id="srepcode" tabindex="-1" role="dialog" aria-labelledby="salesRepModal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title" id="salesRepModal">List of Sales Representative</h4>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group">
                                                @foreach ($salespersons as $salesperson)
                                                    <li class="list-group-item" id="srepvalue" data-dismiss="modal" onclick="get_srep_value('{{ $salesperson->srepcode }}');">{{ $salesperson->srepcode }} <span class="pull-right">{{ $salesperson->srepsurname }}, {{ $salesperson->srepfname }} {{ $salesperson->sremname }}</span></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div> {{-- End Modal --}}

                            <div class="modal fade" id="magcode" tabindex="-1" role="dialog" aria-labelledby="salesRepModal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title" id="salesRepModal">List of Magazine</h4>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group">
                                                @foreach ($magazines as $magazine)
                                                    <li class="list-group-item" id="srepvalue" data-dismiss="modal" onclick="get_magcode_value('{{ $magazine->magcode }}');">{{ $magazine->magcode }} <span class="pull-right">{{ $magazine->magname }}</span></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div> {{-- End Modal --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/plugins/select2/select2.full.min.js') }}"></script>

<script type="text/javascript">

        function get_srep_value(value) {
            $('#srepfield').val(value);
        }
        
        function get_magcode_value(value) {
            $('#magcodefield').val(value);
        }

</script>
@endsection