@extends('layout.magazine_main')

@section('title')
    All Clients
@endsection

@section('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Clients</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Clients</a>
            </li>
            <li>
                <a href="/client/all">List of all Clients</a>
            </li>
            <li class="active">
                <strong>Client Contacts</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            {{--<a href="{{ url('/client/add_contact') . '/' . $company_uid }}" class="btn btn-primary">Add Another Contact</a>--}}
        </div>
    </div>
</div>



<div class="wrapper wrapper-content animated fadeInRight">
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            {{ Session::get('success') }}
        </div>
    @elseif(Session::has('failed'))
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            {{ Session::get('failed') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Contact Persons</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Branch Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Company Adress</th>
                            <th>Email</th>
                            <th>Landline</th>
                            <th>Mobile</th>
                            <th>Type</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                              <?php $n = 1; ?>
                                @for($i = 0; $i < COUNT($result); $i++)
                                    <tr>
                                        <td>{{ $n++ }}</td>
                                        <td>{{ strtoupper($branch_name[0]->company_name .'-'.$result[$i]->branch_name) }}</td>
                                        <td>{{ $result[$i]->first_name }}</td>
                                        <td>{{ $result[$i]->middle_name }}</td>
                                        <td>{{ $result[$i]->last_name }}</td>
                                        <td>{{ $result[$i]->address_1 }}</td>
                                        <td>{{ $result[$i]->email }}</td>
                                        <td>{{ $result[$i]->landline }}</td>
                                        <td>{{ $result[$i]->mobile }}</td>
                                        <td>{{ $result[$i]->type == 1 ? "Primary" : ($result[$i]->type == 2 ? "Secondary" : "Bill To") }}</td>
                                        {{--<td><a href = "{{ URL('/contact/update') . '/' . $result[$i]->Id }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit </a></td>--}}
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