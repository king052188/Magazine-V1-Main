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
</div>



<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-10">
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
                        <table class="table table-striped table-bordered table-hover table-responsive MagazineListdataTables" >
                            <thead>
                            <tr>
                                <th style="text-align: center; width: 30%;">Magazine Code</th>
                                <th style="text-align: center;width: 30%;">Magazine Name</th>
                                <th style="text-align: center;width: 30%;">Magazine Country</th>
                                <th style="text-align: center;width: 10%;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($magazines as $magazine)
                                    <tr>
                                        <td>{{ $magazine->mag_code }}</td>
                                        <td>{{ $magazine->magazine_name }}</td>
                                        <td>{{ $magazine->magazine_country == 1 ? "US" : "CANADA" }}</td>
                                        <td style="text-align: center;"><a href = "{{ URL('/magazine/add-ad-color-and-size') . '/'. $magazine->Id }}" class="btn btn-sm btn-primary"><i class="fa fa-list-alt"></i>&nbsp;&nbsp;View</a></td>
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

@section('scripts')

<script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
<script>

    $(document).ready( function() {

        $('.MagazineListdataTables').DataTable({
        dom: '<"html5buttons"B>lTfgitp',
        buttons: []
        });

    });
</script>
@endsection