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
                            <th>Salesperson First Name</th>
                            <th>Salesperson Middle Name</th>
                            <th>Salesperson Last Name</th>
                            <th>Salesperson Email</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($salesperson as $salesrep)
                                <tr>
                                    <td>{{ $salesrep->first_name }}</td>
                                    <td>{{ $salesrep->middle_name }}</td>
                                    <td>{{ $salesrep->last_name }}</td>
                                    <td>{{ $salesrep->email }}</td>
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