@extends('layout.magazine_main')

@section('title')
    Booking and Sales List
@endsection

@section('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
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
                <strong>List of all Booking and Sales</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>



<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Booking and Sales List</h5>
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
                            <th>Sales Representative Code</th>
                            <th>Client Code</th>
                            <th>Magazine Code</th>
                            <th>Agency Code</th>
                            <th>Contract ID</th>
                            <th>Ad Code</th>
                            <th>Ad Size</th>
                            <th>Contract Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->srepcode }}</td>
                                    <td>{{ $transaction->client_code }}</td>
                                    <td>{{ $transaction->magcode }}</td>
                                    <td>{{ $transaction->agencycode }}</td>
                                    <td>{{ $transaction->contract_id }}</td>
                                    <td>{{ $transaction->ad_code }}</td>
                                    <td>{{ $transaction->ad_size }}</td>
                                    <td>{{ $transaction->contract_amount }}</td>
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
@endsection