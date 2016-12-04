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

            <div id="tab_1" class="col-lg-6">
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
                                <form role="form" action="/magazine/add-new" method="POST">

                                    <div class="form-group">
                                        <label for="ex2">Color</label>
                                        <select class="form-control" name="status">
                                            <option value="0"> -- Select -- </option>
                                            <option value="1">4 Color</option>
                                            <option value="2">1 Spot Color</option>
                                            <option value="3">Black & White</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="ex2">Color</label>
                                        <select class="form-control" name="status">
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
                                        <input id="original_amount" type="text" placeholder="Enter amount" class="form-control" name="cid">
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="tab_1" class="col-lg-6">
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
                            <div class="col-sm-12">
                                <form role="form" action="/magazine/add-new" method="POST">

                                    <div class="form-group ">
                                        <div class="inline">
                                            <label>2x Percent Discount</label>
                                            <input id="2x_per" type="text" placeholder="Enter amount" class="form-control" name="cid">
                                        </div>
                                        <div class="inline">
                                            <label>2x Amount</label>
                                            <input id="2x_amount" type="text" placeholder="Enter amount" class="form-control" name="cid">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="inline">
                                            <label>3x Percent Discount</label>
                                            <input id="3x_per" type="text" placeholder="Enter amount" class="form-control" name="cid">
                                        </div>
                                        <div class="inline">
                                            <label>3x Amount</label>
                                            <input id="3x_amount" type="text" placeholder="Enter amount" class="form-control" name="cid">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="inline">
                                            <label>4x Percent Discount</label>
                                            <input id="4x_per" type="text" placeholder="Enter amount" class="form-control" name="cid">
                                        </div>
                                        <div class="inline">
                                            <label>4x Amount</label>
                                            <input id="4x_amount" type="text" placeholder="Enter amount" class="form-control" name="cid">
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <div class="inline">
                                            <label>5x Percent Discount</label>
                                            <input id="5x_per" type="text" placeholder="Enter amount" class="form-control" name="cid">
                                        </div>
                                        <div class="inline">
                                            <label>5x Amount</label>
                                            <input id="5x_amount" type="text" placeholder="Enter amount" class="form-control" name="cid">
                                        </div>
                                    </div>

                                    <div>
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                        <button class="btn btn-sm btn-primary pull-right"><strong>Create New Magazine</strong></button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="modal_add_company_magazine" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Company Name of Magazine</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <form role="form" action="{{ url('/magazine/company/save') }}" method="post">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" placeholder="Company / Business Name" class="form-control"  name="magcode">
                            </div>
                            <div class="form-group">
                                <label>Address 1</label>
                                <input type="text" placeholder="Address 1" class="form-control" name="magname">
                            </div>
                            <div class="form-group">
                                <label>Address 2 (OPTIONAL)</label>
                                <input type="text" placeholder="Address 2 (OPTIONAL)" class="form-control" name="magname">
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" placeholder="City" class="form-control"  name="status">
                            </div>
                            <div class="form-group">
                                <label>State</label>
                                <input type="text" placeholder="State" class="form-control"  name="status">
                            </div>
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" placeholder="Country" class="form-control"  name="status">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" placeholder="Email" class="form-control"  name="status">
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" placeholder="Phone" class="form-control"  name="status">
                            </div>
                            <div>
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

                            </div>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit"><strong>Create new Magazine</strong></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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