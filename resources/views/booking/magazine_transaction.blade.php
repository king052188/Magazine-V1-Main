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
                <a href="#">Booking List</a>
            </li>
            <li class="active">
                <strong>Add Magazine</strong>
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
                        <p class="list-group-item-text">Select Magazine</p>
                    </a></li>
                    <li class="disabled"><a href="#step-3">
                        <h4 class="list-group-item-heading">Step 3</h4>
                        <p class="list-group-item-text">Add Issue</p>
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

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 30px; text-align: center;">#</th>
                            <th style="width: 250px; text-align: center;">Magazine Code</th>
                            <th style="text-align: center;">Magazine Name</th>
                            <th style="width: 100px; text-align: center;">Country</th>
                            <th style="width: 90px; text-align: center;">Action</th>
                        </tr>
                        </thead>
                        <tbody id="magactive">
                              <?php $n = 1; ?>
                                @for($i = 0; $i < COUNT($mag_l); $i++)
                                    <tr>
                                        <td style="text-align: center;">{{ $n++ }}</td>
                                        <td>{{ $mag_l[$i]->mag_code }}</td>
                                        <td>{{ $mag_l[$i]->magazine_name }}</td>
                                        <td style="text-align: center;">
                                            @if($mag_l[$i]->magazine_country == 1)
                                                USA
                                            @elseif($mag_l[$i]->magazine_country == 2)
                                                CANADA
                                            @endif
                                        </td>
                                        <td><button class='btn btn-primary btn-sm list_client' onclick="do_select_row('{{$mag_l[$i]->Id}}', '{{$client_id}}')"><i class='fa fa-check'></i>&nbsp;&nbsp;Select</button></td>
                                    </tr>
                                @endfor
                        </tbody>
                    </table>

                    <form role="form" action="{{ url('/booking/save-magazine-transaction/'. $booking_uid .'/'. $which_country . '/' . $client_id) }}" method="post">
                        <div class="form-group">
                            <label for="ex2">Select Magazine</label>
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