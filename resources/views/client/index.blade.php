@extends('layout.magazine_main')

@section('title')
    All Clients
@endsection

@section('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Clients</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Clients</a>
            </li>
            <li class="active">
                <strong>List of all Clients</strong>
            </li>
        </ol>
    </div>
</div>



<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">

        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>List of Clients</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ Session::get('success') }}
                    </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width:30px;">#</th>
                            <th>Subscribers</th>
                            <th style="width:30px;">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $n = 1; ?>
                        @for($i = 0; $i < COUNT($subscribers); $i++)
                            <tr>
                                <td>{{ $n++ }}</td>
                                <td><a href = "{{ URL('/client/client_contacts/' . $subscribers[$i]->Id) }}">{{ $subscribers[$i]->company_name }}</a></td>
                                <td><a href = "{{ URL('/client/update/' . $subscribers[$i]->Id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a></td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width:30px;">#</th>
                            <th>Agency</th>
                            <th style="width:30px;">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $n = 1; ?>
                        @for($i = 0; $i < COUNT($agencies); $i++)
                            <tr>
                                <td>{{ $n++ }}</td>
                                <td><a href = "{{ URL('/client/client_contacts/' . $agencies[$i]->Id) }}">{{ $agencies[$i]->company_name }}</a></td>
                                <td><a href = "{{ URL('/client/update/' . $agencies[$i]->Id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a></td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection 