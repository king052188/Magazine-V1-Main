@extends('layout.magazine_main')

@section('title')
    Contracts List
@endsection

@section('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Contracts</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Contract</a>
            </li>
            <li class="active">
                <strong>List of all Contracts</strong>
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
                <h5>Contracts List</h5>
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
                            <th>Salesperson Code</th>
                            <th>Magazine Code</th>
                            <th>Contract ID</th>
                            <th>Client Code</th>
                            <th>Agency Code</th>
                            <th>Contract Date Issue</th>
                            <th>Contract Date</th>
                            <th>Ad Size</th>
                            <th>Charges</th>
                            <th>Charge Date</th>
                            <th>Reference Number</th>
                            <th>Remarks</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($contracts as $contract)
                                <tr>
                                    <td>{{ $contract->srepcode }}</td>
                                    <td>{{ $contract->magcode }}</td>
                                    <td>{{ $contract->contid }}</td>
                                    <td>{{ $contract->clientcode }}</td>
                                    <td>{{ $contract->agencycode }}</td>
                                    <td>{{ $contract->cdateissue }}</td>
                                    <td>{{ $contract->contdate }}</td>
                                    <td>{{ $contract->adsize }}</td>
                                    <td>{{ $contract->charges }}</td>
                                    <td>{{ $contract->chargedate }}</td>
                                    <td>{{ $contract->refno }}</td>
                                    <td>{{ $contract->remarks }}</td>
                                    <td>{{ $contract->status }}</td>
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