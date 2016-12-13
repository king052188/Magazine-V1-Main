@extends('layout.magazine_main')

@section('title')
    Add New Magazine
@endsection

@section('styles')

@endsection

@section('magazine_content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Magazine</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Add Ad Colors & Sizes</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-4">
            {{--<div class="title-action">--}}
                {{--<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal_add_company_magazine">Add New Company</a>--}}
            {{--</div>--}}
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div id="tab_1" class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Create Ad Color & Size<small> *all fields are required</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" action="{{ URL('/magazine/add-color-size-discount') . '/' . $mag_uid }}" method="POST">
                                    <div class="form-group">
                                        <label for="ex2">Color</label>
                                        <select class="form-control" name="ad_color">
                                            <option value="0"> -- Select -- </option>
                                            <option value="1">4 Color</option>
                                            <option value="2">1 Spot Color</option>
                                            <option value="3">Black & White</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ex2">Ad Size</label>
                                        <select class="form-control" name="ad_size">
                                            <option value="0"> -- Select -- </option>
                                            <option value="1">Double Page Spread</option>
                                            <option value="2">Full Page</option>
                                            <option value="3">1/2 DPS</option>
                                            <option value="4">1/2 Page Island</option>
                                            <option value="5">1/2 Page</option>
                                            <option value="6">1/3 Page</option>
                                            <option value="7">1/4 Page</option>
                                            <option value="8">1/6 Page</option>
                                            <option value="9">1/8 Page</option>
                                            <option value="10">2/3 Page</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input id="original_amount" type="text" placeholder="Enter amount" class="form-control" name="ad_amount" required>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5> Amount Discount by 1 or more Line Items <small> *all fields are required</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                        
                                <div class="form-group ">
                                    <div class="col-sm-6">
                                        <label>2x Percent Discount</label>
                                        <input id="2x_per" type="text" placeholder="Enter Discount (0.000)" class="form-control" name="discount[]">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>2x Amount</label>
                                        <input id="2x_amount" type="text" placeholder="Amount" class="form-control" name="cid" readonly>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-sm-6">
                                        <label>3x Percent Discount</label>
                                        <input id="3x_per" type="text" placeholder="Enter Discount (0.000)" class="form-control" name="discount[]">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>3x Amount</label>
                                        <input id="3x_amount" type="text" placeholder="Amount" class="form-control" name="cid" readonly>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-sm-6">
                                        <label>4x Percent Discount</label>
                                        <input id="4x_per" type="text" placeholder="Enter Discount (0.000)" class="form-control" name="discount[]">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>4x Amount</label>
                                        <input id="4x_amount" type="text" placeholder="Amount" class="form-control" name="cid" readonly>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-sm-6">
                                        <label>5x Percent Discount</label>
                                        <input id="5x_per" type="text" placeholder="Enter Discount (0.000)" class="form-control" name="discount[]">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>5x Amount</label>
                                        <input id="5x_amount" type="text" placeholder="Amount" class="form-control" name="cid" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-12 m-t-sm">
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <button class="btn btn-sm btn-primary pull-right">Save</button>
                                </div>
                        
                        </div>
                    </div>
                </div>
               </form>
            </div>

            <div class="col-lg-8">
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

                        <div class="col-lg-12">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th data-toggle="true">No</th>
                                    <th>Company ID</th>
                                    <th>Magazine Code</th>
                                    <th>Magazine Name</th>
                                    <th>Magazine Country</th>
                                    <th data-hide="all"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $n = 1 ?>
                                    @for($i=0; $i < COUNT($mag); $i++)
                                        <tr>
                                            <td style = "padding: 5px; text-align: center;">{{ $n++ }}</td>
                                            <td style = "padding: 5px; text-align: center;">{{ $mag[$i]['company_id'] }}</td>
                                            <td style = "padding: 5px; text-align: center;">{{ $mag[$i]['mag_code'] }}</td>
                                            <td style = "padding: 5px; text-align: center;">{{ $mag[$i]['magazine_name'] }}</td>
                                            <td style = "padding: 5px; text-align: center;">{{ $mag[$i]['magazine_country'] }}</td>
                                            <td style = "padding: 5px; text-align: center;"><a data-toggle="collapse" data-target="#demo_{{ $mag[$i]['Id'] }}"><i class="fa fa-plus" aria-hidden="true"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td colspan = "7" class="p0">
                                                <div id="demo_{{ $mag[$i]['Id'] }}" class="collapse">
                                                    @if(COUNT($mag[$i]['ad_result']) > 0)
                                                        <b>&raquo; Prices</b>
                                                        <table class="table table-striped table-bordered mb0">
                                                            <thead>
                                                            <tr>
                                                                <th data-toggle="true" style = "padding: 5px; text-align: center;">Ad Color</th>
                                                                <th style = "padding: 5px; text-align: center;">Ad Size</th>
                                                                <th style = "padding: 5px; text-align: center;">Ad Amount</th>
                                                                <th style = "padding: 5px; text-align: center;">Ad Created</th>
                                                                <th></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($mag[$i]['ad_result'] as $ad)
                                                                <tr style="background-color: rgba(196, 218, 255, 0.3);">
                                                                    <td style = "padding: 5px; text-align: center;">{{ $ad['ad_color'] }}</td>
                                                                    <td style = "padding: 5px; text-align: center;">{{ $ad['ad_size'] }}</td>
                                                                    <td style = "padding: 5px; text-align: center;">{{ $ad['ad_amount'] }}</td>
                                                                    <td style = "padding: 5px; text-align: center;">{{ $ad['ad_created'] }}</td>
                                                                    <td style = "padding: 5px; text-align: center;"><a data-toggle="collapse" data-target="#demo_{{ $ad['ad_Id'] }}"><i class="fa fa-plus" aria-hidden="true"></i></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan = "6" class="p0">
                                                                        <div id="demo_{{ $ad['ad_Id'] }}" class="collapse">
                                                                            <b>&raquo Discount</b>
                                                                            <table class="table table-striped table-bordered mb0">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th style = "padding: 5px; text-align: center;">Quantity</th>
                                                                                    <th data-toggle="true" style = "padding: 5px; text-align: center;">Percent</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                @foreach ($ad['discount_result'] as $dis)
                                                                                    <tr>
                                                                                        <td style = "padding: 5px; text-align: center;">{{ $dis->type }}</td>
                                                                                        <td style = "padding: 5px; text-align: center;">{{ $dis->percent }}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        <b>No Data</b>
                                                    @endif
                                                </div>
                                            </td>
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
</div>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script>

        $(document).ready(function() {

            $('#2x_per').on('keyup', function(){
                var origin_amount = $('#original_amount').val();
                var value = $(this).val();
                var orig_amount = parseFloat(origin_amount) * parseFloat(value);
                var new_amount = parseFloat(origin_amount) - orig_amount;
                $('#2x_amount').val(new_amount);
            });

            $('#3x_per').on('keyup', function(){
                var origin_amount = $('#original_amount').val();
                var value = $(this).val();
                var orig_amount = parseFloat(origin_amount) * parseFloat(value);
                var new_amount = parseFloat(origin_amount) - orig_amount;
                $('#3x_amount').val(new_amount);
            });

            $('#4x_per').on('keyup', function(){
                var origin_amount = $('#original_amount').val();
                var value = $(this).val();
                var orig_amount = parseFloat(origin_amount) * parseFloat(value);
                var new_amount = parseFloat(origin_amount) - orig_amount;
                $('#4x_amount').val(new_amount);
            });

            $('#5x_per').on('keyup', function(){
                var origin_amount = $('#original_amount').val();
                var value = $(this).val();
                var orig_amount = parseFloat(origin_amount) * parseFloat(value);
                var new_amount = parseFloat(origin_amount) - orig_amount;
                $('#5x_amount').val(new_amount);
            });



        })

    </script>
@endsection