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
        <h2>Booking</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/booking/booking_list') }}">Booking List</a>
            </li>
            <li>
                <a href="{{ url('/booking/add_booking') }}">Add Booking</a>
            </li>
            <li class="active">
                <strong>Add Magazine</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Magazine Added</h5>
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

                        <table class="table table-stripe">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Magazine Code</th>
                                <th>Magazine Name</th>
                                <th>Country</th>
                            </tr>
                            </thead>
                            <tbody>
                                  <?php $n = 1; ?>
                                    @for($i = 0; $i < COUNT($mag_l); $i++)
                                        <tr>
                                            <td>{{ $n++ }}</td>
                                            <td><a href = "{{ URL('/booking/add_issue/' . $mag_l[$i]->Id . '/' . $client_id) }}">{{ $mag_l[$i]->mag_code }}</a></td>
                                            <td>{{ $mag_l[$i]->magazine_name }}</td>
                                            <td>
                                                @if($mag_l[$i]->magazine_country == 1)
                                                    US
                                                @elseif($mag_l[$i]->magazine_country == 2)
                                                    CANADA
                                                @endif
                                            </td>
                                        </tr>
                                    @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Select Magazine to Add</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" action="{{ url('/booking/save-magazine-transaction/'. $booking_uid .'/'. $which_country . '/' . $client_id) }}" method="post">
                                        <div class="form-group">
                                            <label for="ex2">Magazine</label>
                                            <select class="form-control" name = "magazine_id">
                                                @for($i = 0; $i < COUNT($mag_list); $i++)
                                                    <option value = "{{ $mag_list[$i]->Id }}">{{ $mag_list[$i]->magazine_name }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div>
                                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                            <input type="submit" class="btn btn-primary pull-right" value = "Save" {{ $disabled["set"] }}>
                                        </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 