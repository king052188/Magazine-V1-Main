@extends('layout.magazine_main')

@section('title')
    Add Product
@endsection

@section('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Booking</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">Booking List</a>
                </li>
                <li class="active">
                    <strong>Add Product</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="container">

            <div class="row form-group mb0">
                <div class="col-xs-12">
                    <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                        <li class="disabled"><a href="#step-1">
                                <h4 class="list-group-item-heading">Step 1</h4>
                                <p class="list-group-item-text">Add Booking Details</p>
                            </a></li>
                        <li class="active"><a href="#step-2">
                                <h4 class="list-group-item-heading">Step 2</h4>
                                <p class="list-group-item-text">Select Product</p>
                            </a></li>
                        <li class="disabled"><a href="#step-3">
                                <h4 class="list-group-item-heading">Step 3</h4>
                                <p class="list-group-item-text">Add Schedule</p>
                            </a></li>
                    </ul>
                </div>
            </div>

            <div class="row setup-content" id="step-1">
                <div class="col-xs-12">
                    <div class="col-md-12 well white-bg">

                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        <form role="form" action="{{ url('/booking/digital/save-magazine-transaction/'. $booking_uid .'/' . $client_id) }}" method="post">
                            <div class="form-group">
                                <label for="ex2">Select Product</label>
                                <select class="form-control" name = "magazine_id">
                                    @for($i = 0; $i < COUNT($mag_list); $i++)
                                        <option value = "{{ $mag_list[$i]->Id }}">{{ $mag_list[$i]->magazine_name }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div>
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                <input type="submit" class="btn btn-primary pull-right" value="Save" {{ $disabled["set"] }} style="background-color: #1976d2; border-color: #1976d2;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        function do_select_row(id, cid) {
            var url = "{{ URL('/booking/add_issue/')}}/"+ id + "/" + cid;
            window.location.href=url;
        }
    </script>

@endsection