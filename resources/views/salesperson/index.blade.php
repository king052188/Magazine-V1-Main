@extends('layout.magazine_main')

@section('title')
    Salesperson List
@endsection

@section('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Salesperson</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Salesperson</a>
            </li>
            <li class="active">
                <strong>List of all Salesperson</strong>
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
                <h5>Salesperson List</h5>
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
                            <th>Salesperson First Name</th>
                            <th>Salesperson Middle Name</th>
                            <th>Salesperson Last Name</th>
                            <th>Salesperson Address</th>
                            <th>Salesperson Address Line 2</th>
                            <th>Salesperson Landline</th>
                            <th>Salesperson Mobile Number</th>
                            <th>Salesperson Email</th>
                            <th>Salesperson Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($salesperson as $salesrep)
                                <tr>
                                    <td>{{ $salesrep->srepcode }}</td>
                                    <td>{{ $salesrep->srepfname }}</td>
                                    <td>{{ $salesrep->sremname }}</td>
                                    <td>{{ $salesrep->srepsurname }}</td>
                                    <td>{{ $salesrep->srepadd1 }}</td>
                                    <td>{{ $salesrep->srepadd2 }}</td>
                                    <td>{{ $salesrep->slandline }}</td>
                                    <td>{{ $salesrep->srepmobile }}</td>
                                    <td>{{ $salesrep->srepemail }}</td>
                                    <td>{{ $salesrep->srepstatus }}</td>
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