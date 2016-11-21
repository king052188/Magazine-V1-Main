@extends('layout.magazine_main')

@section('styles')
<link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('magazine_content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Reports</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Reports</a>
            </li>
            <li class="active">
                <strong>Sales Report</strong>
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
                <h5>Sales Report</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>Magazine Name</th>
                            <th>Cient Name</th>
                            <th>Contract Number</th>
                            <th>Contract Date</th>
                            <th>Date Issued</th>
                            <th>Ad Size</th>
                            <th>Ad Cost</th>
                            <th>Sales Rep</th>
                            <th>Count Percent</th>
                            <th>Comm Acount</th>
                            <th>Gross Sales</th>
                            <th>Remarks</th>
                        </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < COUNT($result); $i++)
                                <tr>
                                    <td>{{ $result[$i]->magname }}</td>
                                    <td>{{ $result[$i]->client_name }}</td>
                                    <td>{{ $result[$i]->contract_num }}</td>
                                    <td>{{ $result[$i]->date_contract }}</td>
                                    <td>{{ $result[$i]->date_issued }}</td>
                                    <td>{{ $result[$i]->ad_size }}</td>
                                    <td>{{ $result[$i]->ad_cost }}</td>
                                    <td>{{ $result[$i]->sales_rep }}</td>
                                    <td>{{ $result[$i]->count_percent }}</td>
                                    <td>{{ $result[$i]->comm_amount }}</td>
                                    <td>{{ $result[$i]->gross_sales }}</td>
                                    <td>{{ $result[$i]->remarks }}</td>
                                </tr>
                            @endfor

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
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]

        });



    });

    function fnClickAddRow() {
        $('#editable').dataTable().fnAddData( [
            "Custom row",
            "New row",
            "New row",
            "New row",
            "New row" ] );

    }
</script>
@endsection