@extends('layout.magazine_main')

@section('title')
    Add New Magazine
@endsection

@section('styles')

@endsection

@section('magazine_content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>{{ $mag[0]->magazine_name }}</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Digital Magazine Settings</strong>
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
                <form role="form" action="{{ URL('/magazine/add-color-size-discount') . '/' . $mag[0]->Id }}" method="POST">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Create Digital Size with Price<small> *all fields are required</small></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="ex2">Type</label>
                                        <input id="original_amount" type="text" placeholder="Enter amount" class="form-control" name="ad_amount">
                                    </div>
                                    <div class="form-group">
                                        <label for="ex2">Size</label>
                                        <input id="original_amount" type="text" placeholder="Enter amount" class="form-control" name="ad_amount">
                                    </div>

                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input id="original_amount" type="text" placeholder="Enter amount" class="form-control" name="ad_amount">
                                    </div>
                                    <div class="form-group">
                                        <label for="ex2">Issue</label>
                                        <select class="form-control" name = "ad_size" id = "ad_size">
                                            <option value = "0">-- Select --</option>
                                            <option value = "1">Monthly</option>
                                            <option value = "2">Weekly</option>
                                            <option value = "3">Both</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal fade" id="discount_issue_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelDiscountIssue" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalLabel">Discount Issue s<small> Amount Discount by 1 or more issues </small></h4>

                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group ">
                                    <div class="col-sm-6">
                                        <label>2x Percent Discount</label>
                                        <input type="text" placeholder="Enter Discount" class="form-control" id = "discount_2" name = "discount_2">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>3x Percent Discount</label>
                                        <input type="text" placeholder="Enter Discount" class="form-control" id = "discount_3" name = "discount_3">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-sm-6" style = "margin-top: 10px;">
                                        <label>4x Percent Discount</label>
                                        <input type="text" placeholder="Enter Discount" class="form-control" id = "discount_4" name = "discount_4">
                                    </div>
                                    <div class="col-sm-6" style = "margin-top: 10px;">
                                        <label>5x Percent Discount</label>
                                        <input type="text" placeholder="Enter Discount" class="form-control" id = "discount_5" name = "discount_5">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-sm-6" style = "margin-top: 10px;">
                                        <label>6x Percent Discount</label>
                                        <input type="text" placeholder="Enter Discount" class="form-control" id = "discount_6" name = "discount_6">
                                    </div>
                                    <div class="col-sm-6" style = "margin-top: 10px;">
                                        <label>7x Percent Discount</label>
                                        <input type="text" placeholder="Enter Discount" class="form-control" id = "discount_7" name = "discount_7">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-sm-6" style = "margin-top: 10px;">
                                        <label>8x Percent Discount</label>
                                        <input type="text" placeholder="Enter Discount" class="form-control" id = "discount_8" name = "discount_8">
                                    </div>
                                    <div class="col-sm-6" style = "margin-top: 10px;">
                                        <label>9x Percent Discount</label>
                                        <input type="text" placeholder="Enter Discount" class="form-control" id = "discount_9" name = "discount_9">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-sm-6" style = "margin-top: 10px;">
                                        <label>10x Percent Discount</label>
                                        <input type="text" placeholder="Enter Discount" class="form-control" id = "discount_10" name = "discount_10">
                                    </div>
                                    <div class="col-sm-6" style = "margin-top: 10px;">
                                        <label>11x Percent Discount</label>
                                        <input type="text" placeholder="Enter Discount" class="form-control" id = "discount_11" name = "discount_11">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-sm-6" style = "margin-top: 10px;">
                                        <label>12x Percent Discount</label>
                                        <input type="text" placeholder="Enter Discount" class="form-control" id = "discount_12" name = "discount_12">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-primary" id = "btn_discount_issue">Save</button>
                        </div>
                    </div>
                </div>
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
                                        <th data-toggle="true" style="width: 50px; text-align: center;">#</th>
                                        <th style="width: 200px; text-align: center;">MAG Code</th>
                                        <th style="text-align: center;">Magazine Name</th>
                                        <th style="text-align: center;">Company Name</th>
                                        <th style="width: 100px; text-align: center;">Country</th>
                                        <th style="width: 50px; text-align: center;" data-hide="all"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
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
@endsection