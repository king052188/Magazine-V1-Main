@extends('layout.magazine_main')

@section('title')
    Magazines List
@endsection

@section('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Booking</h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>Booking List</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <a href="/booking/add-booking" class="btn btn-primary">Add New Booking</a>
        </div>
    </div>
</div>



<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Booking List</h5>
            </div>

            <div class="ibox-content">
                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    {{ Session::get('success') }}
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>TRANSACTION NUMBER</th>
                            <th>SALES AGENT NAME</th>
                            <th>CLIENT NAME</th>
                            <th>AGENCY NAME</th>
                            <th>STATUS</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1; ?>
                            @for($i = 0; $i < COUNT($booking); $i++)
                                <tr>
                                    <td>{{ $n++ }}</td>
                                    <td><a href = "{{ URL('/booking/magazine-transaction' . '/' . $booking[$i]->Id . '/' . $booking[$i]->magazine_country . '/' . $booking[$i]->client_id ) }}">{{ $booking[$i]->trans_num }}</a></td>
                                    <td>{{ $booking[$i]->sales_name }}</td>
                                    <td>{{ $booking[$i]->client_name }}</td>
                                    <td>{{ $booking[$i]->agency_name }}</td>
                                    <td>
                                        @if($booking[$i]->status == 1)
                                            Pending
                                        @elseif($booking[$i]->status == 2)
                                            On Process
                                        @else
                                            Approved
                                        @endif
                                    </td>
                                    <td>
                                        <a href = "http://192.168.43.132/kpa/work/transaction/generate/pdf/{{ $booking[$i]->trans_num }}" target = "_blank">Share</a>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection