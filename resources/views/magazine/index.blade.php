@extends('layout.magazine_main')

@section('title')
    Magazines List
@endsection

@section('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Magazine</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Magazine</a>
            </li>
            <li class="active">
                <strong>List of all Magazine</strong>
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
                    <h5>Magazine List</h5>
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
                                <th>Magazine Code</th>
                                <th>Magazine Name</th>
                                <th>Magazine Country</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($magazines as $magazine)
                                    <tr>
                                        <td>{{ $magazine->mag_code }}</td>
                                        <td>{{ $magazine->magazine_name }}</td>
                                        <td>{{ $magazine->magazine_country }}</td>
                                        <td>{{ $magazine->status }}</td>
                                        <td><a href = "{{ URL('/magazine/add-ad-color-and-size') . '/'. $magazine->Id }}" class="btn btn-info btn-xs">View</a></td>
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