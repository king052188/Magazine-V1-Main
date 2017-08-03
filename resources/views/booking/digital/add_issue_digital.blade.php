@extends('layout.magazine_main')

@section('title')
    Add Product
@endsection

@section('styles')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <style>
        #notes_modal_content{
            overflow-y: scroll;
            height: 500px;
            max-height:500px;
        }
    </style>
@endsection

@section('magazine_content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Booking</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/booking/booking-list') }}">Booking List</a>
                </li>
                <li>
                    <a href="#">Add Product</a>
                </li>
                <li class="active">
                    <strong>Add Schedule</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="container col-md-12">

            <div class="row form-group mb0 mrl15">
                <div class="col-xs-12">
                    <ul class="nav nav-pills nav-justified thumbnail setup-panel">
                        <li class="disabled"><a href="#step-1">
                                <h4 class="list-group-item-heading">Step 1</h4>
                                <p class="list-group-item-text">Add Booking Details</p>
                            </a></li>
                        <li class="disabled"><a href="#step-2">
                                <h4 class="list-group-item-heading">Step 2</h4>
                                <p class="list-group-item-text">Select Product</p>
                            </a></li>
                        <li class="active"><a href="#step-3">
                                <h4 class="list-group-item-heading">Step 3</h4>
                                <p class="list-group-item-text">Add Schedule</p>
                            </a></li>
                    </ul>
                </div>
            </div>

            <div class="row setup-content" id="step-1">
                <div class="col-md-12 well">
                    <div class="col-lg-3" id = "once_approved_aa">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Add Schedule <small> *all fields are required</small></h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <section class="panel">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <label for="ex2">Position</label>
                                                    <select class="form-control" name = "position" id = "position">
                                                        <option value = "" disabled selected>select</option>
                                                        @if($ad_c != null)
                                                            @for($i = 0; $i < COUNT($ad_c); $i++)
                                                                <option value = "{{ $ad_c[$i]->Id }}">{{ $ad_c[$i]->ad_type . " " . $ad_c[$i]->ad_size }}</option>
                                                            @endfor
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row show_me" style = "display: none; margin-top: 5px;">
                                                <div class="col-xs-12">
                                                    <label id = "ad_amount_label">Amount</label>
                                                    <input type = "text" class="form-control" id = "ad_amount_area" required readonly />
                                                </div>
                                            </div>

                                            <div class="row show_me" style = "display: none; margin-top: 5px;">
                                                <div class="col-xs-12">
                                                    <label id = "ad_issue_label">Issue</label>
                                                    <input type = "hidden" class="form-control" id = "ad_issue_area_id" required readonly />
                                                    <input type = "text" class="form-control" id = "ad_issue_area" required readonly />
                                                </div>
                                            </div>

                                            <div class="row" id = "show_me_month" style = "display: none; margin-top: 5px;">
                                                <div class="col-xs-12">
                                                    <label id = "ad_monthly_label">Month</label>
                                                    <select class="form-control" id='ad_monthly' required>
                                                        <option value='1'>January</option>
                                                        <option value='2'>February</option>
                                                        <option value='3'>March</option>
                                                        <option value='4'>April</option>
                                                        <option value='5'>May</option>
                                                        <option value='6'>June</option>
                                                        <option value='7'>July</option>
                                                        <option value='8'>August</option>
                                                        <option value='9'>September</option>
                                                        <option value='10'>October</option>
                                                        <option value='11'>November</option>
                                                        <option value='12'>December</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row" id = "show_me_year" style = "display: none; margin-top: 5px;">
                                                <div class="col-xs-12">
                                                    <label id = "ad_year_label">Year</label>
                                                    <select class="form-control" id='ad_year' required>
                                                        @for($i = date('Y') - 3; $i < date('Y') + 3; $i++)
                                                            <option value='{{ $i }}' {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row" id = "show_me_weeks" style = "display: none; margin-top: 5px;">
                                                <div class="col-xs-12">
                                                    <label id = "ad_weeks_label">Weeks</label>
                                                    <select class="form-control" id='ad_weekly' required>
                                                        <option value='1'>Week 1</option>
                                                        <option value='2'>Week 2</option>
                                                        <option value='3'>Week 3</option>
                                                        <option value='4'>Week 4</option>
                                                        <option value='5'>Week 5</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row show_me" style = "display: none; margin-top: 5px;">
                                                <div class="col-xs-12 " id = "btn_save_box">
                                                    <div id = "btn_save_box">
                                                        <input type="submit" class="btn btn-primary pull-right" id = "save_digital_issue" value = "Save">
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9" id = "once_approved_bb">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                @if($is_member != null)
                                    <h5>Company: <b>{{ $is_member[0]->company_name }}</b> |
                                    <h5>Type: <b>{{  $is_member[0]->is_member == 1 ? "MEMBER" : "NON" }}</b> |
                                    <h5>Product: <b>{{ $mag_name[0]->magazine_name }} </b></h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-sm-12">

                                        @if(Session::has('success'))
                                            <div class="alert alert-success alert-dismissable">
                                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                {{ Session::get('success') }}
                                            </div>
                                        @elseif(Session::has('fail'))
                                            <div class="alert alert-danger alert-dismissable">
                                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                {{ Session::get('fail') }}
                                            </div>
                                        @endif

                                        <table class="table table-striped table-bordered table-hover dataTables-example" id="digital_issue_table">
                                            <thead>
                                            <tr>
                                                <th style="width: 60px; text-align: center;">ITEM#</th>
                                                <th style="text-align: left;">MAGAZINE</th>
                                                <th style="width: 200px; text-align: center;">SIZE</th>
                                                <th style="width: 100px; text-align: center;">MODE</th>
                                                <th style="width: 180px; text-align: center;">ISSUE</th>
                                                <th style="width: 100px; text-align: center;">YEAR</th>
                                                <th style="width: 100px; text-align: right;">AMOUNT</th>
                                                <th style="width: 100px; text-align: right;">DISCOUNT</th>
                                                <th style="width: 100px; text-align: right;">TOTAL</th>
                                                <th style="width: 130px; text-align: center;">ACTION</th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        <div id="total_result" style="margin-top: 15px;" class="pull-right">
                                            <style>
                                                .issues_amount_table tr td { font-size: 1em; font-weight: 600; padding: 2px; text-align: right; }
                                            </style>
                                            <table class="issues_amount_table" style="width: 240px" border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td>Amount:</td>
                                                    <td><span id="issues_total"></span></td>
                                                </tr>
                                                <tr>
                                                    <td><span id = "discretionary_discount_label">Discount:</span></td>
                                                    <td><span id="discretionary_discount"></span></td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top: 1px solid #C7C7C7;">Total:</td>
                                                    <td style="border-top: 1px solid #C7C7C7;"><span id="issues_total_amount"></span></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div id="show_button" style="margin-top: 45px;" class="pull-left"></div>
                                        </section>
                                    </div>
                                </div>

                                {{--<a href = "#" id="btnDDiscount" style="margin-right: 5px;" class="btn btn-warning hide_if_approved" data-toggle="modal" data-target="#discount">Discount</a>--}}
                                <button data-toggle="modal" id = "btn_payment_method_modal" data-target="#payment_method_modal" class="btn btn-primary" style="margin-right: 5px;">Payment Method</button>
                                <a data-toggle="modal" id = "btn_notes_modal" data-target="#notes_modal" class="btn btn-warning" style="margin-right: 5px;">Notes</a>
                                <a href = "{{ URL('/booking/digital-list') }}" class="btn btn-primary" style="margin-right: 5px; background-color: #5cb85c; border-color: #4cae4c; color: #fff;">Done</a>
                                <a href = "#" id = "btn_digital_preview" style="margin-right: 5px;" class = "btn btn-preview-kpa">Preview</a>

                                <div id="status_discretionary_discount" style="height: 35px; margin-top: 10px; display: none;"> </div>
                                <div id="approval_discretionary_discount" style="width: 100%; margin-top: 10px; display: none;">
                                    <h3>Discretionary Discount</h3>
                                    <table style="width: 100%; padding: 10px;" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="width: 250px; padding: 5px; border-bottom: 1px solid #C7C7C7;"> Sales Rep: </td>
                                            <td style="text-align: right; padding: 5px; border-bottom: 1px solid #C7C7C7; font-weight: 600;"> <span id="approval_sales_rep"></span> </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 250px; padding: 5px; border-bottom: 1px solid #C7C7C7;"> Date & Time: </td>
                                            <td style="text-align: right; padding: 5px; border-bottom: 1px solid #C7C7C7; font-weight: 600;"> <span id="approval_date"></span> </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 250px; padding: 5px; border-bottom: 1px solid #C7C7C7;"> Remarks: </td>
                                            <td style="text-align: right; padding: 5px; border-bottom: 1px solid #C7C7C7; font-weight: 600;"> <span id="approval_remarks"></span> </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 250px; padding: 5px; border-bottom: 1px solid #C7C7C7;"> Origin Total: </td>
                                            <td style="text-align: right; padding: 5px; border-bottom: 1px solid #C7C7C7; font-weight: 600;"> <span id="approval_total"></span> </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 250px; padding: 5px; border-bottom: 1px solid #C7C7C7;"> <span id="approval_discount_label"></span> Discretionary Discount: </td>
                                            <td style="text-align: right; padding: 5px; border-bottom: 1px solid #C7C7C7; color: red; font-weight: 600;"> <span id="approval_discount"></span> </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 250px; padding: 5px;"> Total Amount: </td>
                                            <td style="text-align: right; padding: 5px; font-weight: 600;"> <span id="approval_amount"></span> </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding: 5px;">
                                                <div id="button_approve" style="float: right; margin-top: 20px;">
                                                    <button data-toggle="modal" data-target="#approved_modal" class="btn btn-primary">Approve</button>
                                                    <button data-toggle="modal" data-target="#declined_modal" class="btn btn-danger">Decline</button>
                                                </div>
                                                <h3 id="text_status"> Approved </h3>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style = "clear: both;"></div>
    </div>
    <div class="bd-example">
        {{--discount modal area--}}
        <div class="modal fade" id="discount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" action = "{{ url('/booking/save/discount') . '/' . $booking_trans_num[0]->trans_num . '/' . $mag_trans_uid . '/' . $client_id . '/digital' }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalLabel">Discretionary Discount</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Base Amount:</label>
                                <input type="text" class="form-control" id="txtBaseAmount" name = "txtBaseAmount" readonly>
                                <input type="hidden" class="form-control" id="txtItemIdHidden" name = "txtItemIdHidden" readonly>
                                <input type="hidden" class="form-control" id="txtBaseAmountHidden" name = "txtBaseAmountHidden" readonly>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Discount: <i>by percentage (1-100)</i></label>
                                <input type="text" class="form-control" id="txtDiscount" name = "txtDiscount" placeholder="Enter discount. I.e: 2 / 12" >
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Remarks: <i>300 Characters</i> </label>
                                <textarea type="number" class="form-control" id="txtRemarks" name = "txtRemarks" placeholder="Enter remarks" maxlength="300" rows="3"></textarea>
                            </div>

                            <div id="discounts_table_div" class="form-group" style="display: none;">
                                <label for="recipient-name" class="form-control-label">Discounts Table: </label>
                                <table id="discounts_table" style="width: 100%; ">
                                    <thead>
                                        <th style="text-align: center;">Sales</th>
                                        <th style="text-align: center; width: 100px;">Percent</th>
                                        <th style="text-align: center; width: 200px;">Date</th>
                                        <th style="text-align: center; width: 30px;">Action</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Total Amount:</label>
                                <input type="text" class="form-control" id="txtAmount" disabled>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <a type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{--approve modal area--}}
        <div class="modal fade" id="approved_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelApprove" aria-hidden="true">
            <form method="post" action = "{{ url('/booking/digital/discount/approve') . '/' . $booking_trans_num[0]->trans_num . '/' . $mag_trans_uid . '/' . $client_id }}">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <input type = "hidden" id = "sls_rep" name = "sls_rep">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalLabel">Approve</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Remarks: <i>300 Characters</i> </label>
                                <textarea type="number" class="form-control" id="txtApproveRemarks" name = "txtApproveRemarks" placeholder="Enter remarks" maxlength="300" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <button type="submit" id = "btn_approve_skip" class="btn btn-info pull-left">Skip</button>
                            <a type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
                            <button type="submit" id = "btn_approve_save" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{--declined modal area--}}
        <div class="modal fade" id="declined_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelDecline" aria-hidden="true">
            <form method="post" action = "{{ url('/booking/digital/discount/decline') . '/' . $booking_trans_num[0]->trans_num . '/' . $mag_trans_uid . '/' . $client_id }}">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <input type = "hidden" id = "sls_rep_dec" name = "sls_rep">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalLabel">Decline</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Remarks: <i>300 Characters</i> </label>
                                <textarea type="number" class="form-control" id="txtDeclineRemarks" name = "txtDeclineRemarks" placeholder="Enter remarks" maxlength="300" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <button type="submit" id = "btn_decline_skip" class="btn btn-info pull-left">Skip</button>
                            <a type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
                            <button type="submit" id = "btn_decline_save" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{--discount modal area--}}
        <div class="modal fade" id="artwork_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelArtwork" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" action = "{{ url('/booking/save/artwork') . '/' . $booking_trans_num[0]->trans_num . '/' . $mag_trans_uid . '/' . $client_id }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalLabel">Add Artwork</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Artwork</label>
                                <select class="form-control" id = "selArtwork" name = "selArtwork">
                                    <option value = "0">--select--</option>
                                    <option value = "1">Supplied</option>
                                    <option value = "2">Build</option>
                                    <option value = "3">Renewal</option>
                                    <option value = "4">Renewal with changes</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Directions</label>
                                <textarea class="form-control" id="txtDirections" name = "txtDirections" placeholder="Enter Directions" maxlength="300" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <a type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="notes_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelNotes" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Booking Notes <b class = "pull-right" style = "font-weight: 600; margin-right: 10px;">Booking Ref. {{ $booking_trans_num[0]->trans_num }}</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" id = "notes_modal_content">
                            <table class="table" id = "notes_lists">
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Notes</label>
                            <textarea class="form-control" id="txtNotes"  placeholder="Enter Your Notes" maxlength="300" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <a type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
                        <button class="btn btn-primary" id = "btn_notes_save">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="payment_method_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelPaymentMethod" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="exampleModalLabel">Bank Accounts and Credit Cards <div class = "pull-right">Company: <b style = "font-weight: bold; margin-right: 10px;">{{ $is_member[0]->company_name }}</b></div></h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-group payments-method" id="accordion">
                            <div class="alert alert-success alert-dismissable" id ="cc_success" style = "display:none;">
                                Add Successful
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            </div>
                            <div class="alert alert-danger alert-dismissable" id = "cc_failed" style = "display:none;">
                                Add Failed
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            </div>
                            {{--CREDIT CARD FORM--}}
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="pull-right">
                                        <i class="fa fa-cc-amex text-success"></i>
                                        <i class="fa fa-cc-mastercard text-warning"></i>
                                        <i class="fa fa-cc-discover text-danger"></i>
                                    </div>
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" class = "cc_form" data-parent="#accordion" href="#collapseTwo">Credit Card</a>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse in">
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group">
                                                            <label>BANK NAME</label>
                                                            <input type="text" class="form-control cc_info" name="bank_name" id = "bank_name" placeholder="BANK NAME"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group">
                                                            <label>CARD NUMBER</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control cc_info" name="Number" id = "card_number" placeholder="Valid Card Number" required />
                                                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-7 col-md-7">
                                                        <div class="form-group">
                                                            <label>EXPIRATION DATE</label>
                                                            <input type="text" class="form-control cc_info" id = "expiry_date" name="Expiry" placeholder="MM / YY"  required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-5 col-md-5 pull-right">
                                                        <div class="form-group">
                                                            <label>CV CODE</label>
                                                            <input type="text" class="form-control cc_info" id = "cvc_code" name="CVC" placeholder="CVC"  required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group">
                                                            <label>CARD HOLDER NAME</label>
                                                            <input type="text" class="form-control cc_info" name="card_holder_name" id = "card_holder_name" placeholder="NAME AND SURNAME"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--LIST OF BANK ACCOUNTS--}}
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="pull-right">

                                    </div>
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" class = "list_of_bank" href="#collapseOne">List of Bank Accounts</a>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-md-12">

                                                <input type="text" class="form-control input-sm m-b-xs" style = "border-color: #aaaaaa; width: 300px;" id="filter" placeholder="Search in table">
                                                <table class="footable table table-stripped" id = "cc_table" data-page-size="10" data-filter=#filter>
                                                    <thead>
                                                    <tr>
                                                        <th style = "text-align: left;">Card Bank</th>
                                                        <th style = "text-align: center;">Card #</th>
                                                        <th style = "text-align: center;">Card Holder Name</th>
                                                        <th style = "text-align: center;">Card Validity</th>
                                                        <th style = "text-align: center;">Card Pin</th>
                                                        <th style = "text-align: center;">Set Primary</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr><td colspan = '6'></td></tr>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="6">
                                                            <ul class="pagination pull-right"></ul>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>

                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <a type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
                        <button class="btn btn-primary" id = "btn_cc_save">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <style>
        .btn-preview-kpa {
            background: #7f7f7f;
            color: #ffffff;
        }
        .btn-preview-kpa:hover {
            background: #8d8d8d;
            color: #ffffff;
        }
    </style>
    <script>

        var mag_trans_uid = '{{ $mag_trans_uid }}';
        var d_client_id = '{{ $is_member[0]->Id }}';
        var d_mag_id = '{{ $mag_name[0]->Id }}';
        var is_member = {{ $is_member[0]->is_member }};

        var discretionary_discount = 0.0;
        var issues_total_amount = 0.0;

        var trans_id = '{{ $transaction_uid[0]->transaction_id }}';

        $(document).ready(function(){

            $('#position').on('change',function(){
                var position_uid = $(this).val();
                $.ajax({
                    url: "/api/api_get_digital_price/" + position_uid,
                    dataType: 'text',
                    success: function(data)
                    {
                        var json = $.parseJSON(data);
                        if(json == null)
                            return false;

                        $("#ad_amount_area").val(json.ad_amount);

                        var a_issue = "";
                        if(json.ad_issue == 1){
                            a_issue = "Monthly";
                            $("#show_me_month").show();
                            $("#show_me_year").show();
                            $("#show_me_weeks").hide();

                        }else if(json.ad_issue == 2){
                            a_issue = "Weekly";
                            $("#show_me_month").show();
                            $("#show_me_year").show();
                            $("#show_me_weeks").show();
                        }

                        $("#ad_issue_area").val(a_issue);
                        $("#ad_issue_area_id").val(json.ad_issue);
                        $(".show_me").show();
                    }
                });
            });

            $("#save_digital_issue").click(function(){

                var d_position = $("#position").val();
                var d_monthly = $("#ad_monthly").val();
                var d_year = $("#ad_year").val();
                var d_weekly = $("#ad_weekly").val();
                var d_amount = $("#ad_amount_area").val();
                var d_issue = $("#ad_issue_area_id").val();

                var url = "";
                if(d_issue == 1){ //1 = Monthly
                    d_weekly = 0;
                    url = "/booking/digital/add_issue/save/" + mag_trans_uid + "/" + d_mag_id + "/" + d_client_id + "/" + d_position + "/" + d_monthly + "/" + d_year + "/" + d_weekly + "/" + d_amount;
                }else if(d_issue == 2){ //2 = Weekly
                    url = "/booking/digital/add_issue/save/" + mag_trans_uid + "/" + d_mag_id + "/" + d_client_id + "/" + d_position + "/" + d_monthly + "/" + d_year + "/" + d_weekly + "/" + d_amount;
                }

                $.ajax({
                    url: url,
                    dataType: 'text',
                    success: function(data)
                    {
                        var json = $.parseJSON(data);
                        if(json == null)
                            return false;

                        if(json.Code == 200){
                            swal(
                                '',
                                'Add Successful!',
                                'success'
                            ).then(
                                function () {
                                    api_get_digital_transaction(d_mag_id, d_client_id);
                                }
                            )
                        }
                    }
                });
            });

            $("#digital_issue_table").on("click", "#d_delete", function(){
                var d_uid = $(this).attr("data-target");

                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then(function() {
                    delete_d_confirm(d_uid);
                }, function(dismiss) {
                    if (dismiss === 'cancel') {
                        swal(
                                'Cancelled',
                                'Your data file is safe :)',
                                'error'
                        )
                    }
                })
            });

            function delete_d_confirm(d_uid) {
                var url = "/api/api_delete_digital_transaction/" + d_uid;
                $(document).ready(function () {
                    $.ajax({
                        url: url,
                        dataType: "text",
                        beforeSend: function () {
                        },
                        success: function (data) {
                            var json = $.parseJSON(data);
                            if (json.status == 200) {
                                swal(
                                        '',
                                        'Delete Successful!',
                                        'success'
                                ).then(
                                        function () {
                                            api_get_digital_transaction({{ $mag_name[0]->Id }},{{ $is_member[0]->Id }});
                                        }
                                )
                            }
                        }
                    });
                });
            }

            $("#btn_approve_save").click(function(){
                var remarks = $("#txtApproveRemarks").val();
                if(remarks == "")
                {
                    swal({
                        title: "Remarks is required",
                        text: "",
                        timer: 2000,
                        showConfirmButton: false
                    });

                    return false;
                }
            });

            $("#btn_decline_save").click(function(){
                var remarks = $("#txtDeclineRemarks").val();
                if(remarks == "")
                {
                    swal({
                        title: "Remarks is required",
                        text: "",
                        timer: 2000,
                        showConfirmButton: false
                    });

                    return false;
                }
            });

            populate_notes('{{ $booking_trans_num[0]->trans_num }}');
            $("#btn_notes_save").click(function(){
                var notes = $("#txtNotes").val();

                var isValid = true;
                $('#txtNotes').each(function() {
                    if ($.trim($(this).val()) == '') {
                        isValid = false;
                        $(this).css({
                            "border": "1px solid red",
                            "background": "#FFCECE"
                        });
                    }
                    else {
                        $(this).css({
                            "border": "",
                            "background": ""
                        });
                    }
                });

                if (isValid == true){
                    $.ajax({
                        url: "/booking/notes/save/" + '{{ $booking_trans_num[0]->trans_num }}' + "/" + notes,
                        dataType: 'text',
                        success: function(data)
                        {
                            var json = $.parseJSON(data);
                            if(json == null)
                                return false;

                            if(json.Code == 200)
                            {
                                $("#txtNotes").val("");
                                populate_notes(json.trans_num);
                            }
                        }
                    });
                }

            });

            $('#txtAmount').val("0.00");
            $('#txtDiscount').on('keyup', function(){
                //var origin_amount = issues_total_amount;
                var origin_amount = $("#txtBaseAmountHidden").val();
                var value = $(this).val();
                if(value != "") {
                    var orig_amount = (parseFloat(origin_amount) * parseFloat(value)) / 100;
                    var new_amount = parseFloat(origin_amount) - orig_amount;
                    $('#txtAmount').val(numeral(new_amount).format('0,0.00'));
                }
                else {
                    $('#txtAmount').val(numeral(origin_amount).format('0,0.00'));
                }
            });
        });

        function onCallDiscount(item_id, item_amount) {
            $(document).ready(function(){
                $('#discount').modal({
                    show: 'true'
                });

                $('#discounts_table_div').show();

                $('#exampleModalLabel').text("Discretionary Discount for ITEM#: " + item_id);
                $('#txtItemIdHidden').val(item_id);
                $('#txtBaseAmountHidden').val(item_amount);
                $('#txtBaseAmount').val(numeral(item_amount).format('0,0.00'));
                $('#txtAmount').val(numeral(item_amount).format('0,0.00'));

                var html_thmb = "";

                $.ajax({
                    url: "http://"+report_url_api+"/kpa/work/magazine-digital-discount-item//"+item_id,
                    dataType: "text",
                    beforeSend: function () {
                        $('table#discounts_table > tbody').empty().prepend('<tr> <td colspan="9" style="text-align: center; font-size: 15px; padding-top: 20px;"> <img src="{{ asset('img/ripple.gif') }}"  /> <br /> Fetching All Data... Please wait...</td> </tr>');
                    },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if(json == null)
                            return false;

                        var total_discount = 0;

                        if(json.Count > 0) {

                            $(json.Data).each(function(i, item){

                                var total_discount_item = parseFloat(item.discount_percent);
                                total_discount += total_discount_item;

                                html_thmb += "<tr>";
                                html_thmb += "<td style='text-align: center; padding: 5px;'>"+ item.sales_name +"</td>";
                                html_thmb += "<td style='text-align: right; padding: 5px;'>"+ total_discount_item +"%</td>";
                                html_thmb += "<td style='text-align: center; padding: 5px;'>"+ item.created_at +"</td>";
                                html_thmb += "<td style='text-align: center; padding: 5px;'>";
                                html_thmb += "<a class='btn btn-danger' data-target = '"+ item.Id +"' data-target-aa = '"+ item_id +"' data-target-bb = '"+ item.amount +"' id = 'd_delete_x' title='Delete'><i class='fa fa-trash'></i></a>";
                                html_thmb += "</td>";
                                html_thmb += "</tr>";
                            });

                            html_thmb += "<tr>";
                            html_thmb += "<td style='text-align: right; padding: 5px; font-weight: 600;'>Total Discount</td>";
                            html_thmb += "<td style='text-align: right; padding: 5px; font-weight: 600;'>"+ total_discount +"%</td>";
                            html_thmb += "<td style='text-align: center; padding: 5px;'>&nbsp;</td>";
                            html_thmb += "<td style='text-align: center; padding: 5px;'>&nbsp;</td>";
                            html_thmb += "</tr>";

                            $('#discounts_table_div').show();
                            $('table#discounts_table > tbody').empty().prepend(html_thmb);
                        }
                        else {
                            $('#discounts_table_div').hide();
                        }
                    }
                });
            })
        }

        $("#discounts_table_div").on("click", "#d_delete_x", function(){
            var d_uid = $(this).attr("data-target");
            var item_id = $(this).attr("data-target-aa");
            var item_amount = $(this).attr("data-target-bb");

            console.log(item_id + "-" + item_amount);

            bootbox.confirm({
                size: "small",
                title: "Confirm",
                message: "Are you sure do you want to delete?",
                callback: function(result){
                    /* result is a boolean; true = OK, false = Cancel*/
                    if(result == true){
                        delete_discount_confirm(d_uid, item_id, item_amount);
                    }
                }
            });

        });

        function delete_discount_confirm(d_uid, item_id, item_amount){
            var url = "/delete/discount/" + d_uid;
            $(document).ready( function() {
                $.ajax({
                    url: url,
                    dataType: "text",
                    beforeSend: function () {
                    },
                    success: function(data) {
                        var json = $.parseJSON(data);

                        if(json.Code == 200){
                            onCallDiscount(item_id, item_amount);

                            api_get_digital_transaction(trans_id);
                        }
                    }
                });
            });
        }

        function populate_notes(n_book_trans_num){
            var html_thmb = "";
            $.ajax({
                url: "/booking/notes/get/" + n_book_trans_num,
                dataType: 'text',
                success: function(data)
                {
                    var json = $.parseJSON(data);
                    if(json == null)
                        return false;

                    if(json.Code == 200)
                    {
                        $(json.result).each(function(i, tran){
                            html_thmb += "<tr>";
                            html_thmb += "<td style='text-align: left;'>" + tran.notes;
                            html_thmb += "<br /><br /><b style = 'margin-right: 10px;'>Sales Rep </b>" + tran.sales_rep_name;
                            html_thmb += "<b style = 'margin-left: 50px; margin-right: 10px;'>Date </b>" + tran.created_at;
                            html_thmb += "</td>";
                            html_thmb += "</tr>";
                        });

                        $("#notes_modal_content").animate({ scrollTop: $(document).height() }, "slow");
                        //return false;
                    }
                    else
                    {
                        html_thmb += "<tr>";
                        html_thmb += "<td style='text-align: left;'>No Notes Available<td/>";
                        html_thmb += "</tr>";
                    }
                    $('table#notes_lists > tbody').empty().prepend(html_thmb);
                }
            });
        }

        function open_preview(trans_number) {
            window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/insertion-order-contract/" + trans_number + "/preview",
                    "mywindow","location=1,status=1,scrollbars=1,width=800,height=760");
        }

        function ConfirmDelete() {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }

        api_get_digital_transaction(trans_id);

        function api_get_digital_transaction(trans_id){

            console.log(trans_id);

            var issues_amount = 0.0;
            var issues_discount = 0.0;
            var issues_total = 0.0;

            var html_thmb = "";

            var booking_trans = "";

            $(document).ready( function() {
                $.ajax({
                    url: "http://"+report_url_api+"/kpa/work/magazine-digital-lists/"+trans_id,
                    dataType: "text",
                    beforeSend: function () {
                        $('table#digital_issue_table > tbody').empty().prepend('<tr> <td colspan="9" style="text-align: center; font-size: 15px; padding-top: 20px;"> <img src="{{ asset('img/ripple.gif') }}"  /> <br /> Fetching All Data... Please wait...</td> </tr>');
                    },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if(json == null)
                            return false;

                        if(json.Count > 0) {
                            booking_trans = json.Bookings[0].trans_num;
                            $(json.Data).each(function(i, tran){
                                var trans_number = tran.Id;
                                html_thmb += "<tr>";
                                html_thmb += "<td style='text-align: center;'>"+ tran.Id +"</td>";
                                html_thmb += "<td style='text-align: left;'>"+ tran.mag_name +"</td>";
                                html_thmb += "<td style='text-align: left;'>"+ tran.ad_size +"</td>";
                                var month = getMonth(tran.month_id);
                                if(tran.week_id > 0) {
                                    html_thmb += "<td style='text-align: center;'>WEEK</td>";
                                    html_thmb += "<td style='text-align: center;'> "+month +" | Week"+ tran.week_id +"</td>";
                                }
                                else {
                                    html_thmb += "<td style='text-align: center;'>MONTH</td>";
                                    html_thmb += "<td style='text-align: center;'>"+ month +"</td>";
                                }
                                html_thmb += "<td style='text-align: center;'>"+ tran.year +"</td>";


                                var amount = parseFloat(tran.amount);
                                var discount = tran.dollar_discount != null ? parseFloat(tran.dollar_discount) : 0.00;
                                var total_discount = amount * discount;
                                var total = amount - total_discount;

                                issues_amount += amount;

                                issues_discount += total_discount;

                                issues_total += total;

                                html_thmb += "<td style='text-align: right;'>"+ numeral(amount).format('0,0.00') +"</td>";

                                if(total_discount > 0) {
                                    html_thmb += "<td style='text-align: right;'>-"+ numeral(total_discount).format('0,0.00') +"<br />"+ numeral(discount * 100).format('0,0.0') +"%</td>";
                                }
                                else {
                                    html_thmb += "<td style='text-align: right;'>"+ numeral(total_discount).format('0,0.00') +"</td>";
                                }

                                html_thmb += "<td style='text-align: right;'>"+ numeral(total).format('0,0.00') +"</td>";
                                html_thmb += "<td style='text-align: center;'>";
                                html_thmb += "<a href='#' class='btn btn-success' data-value = '"+ tran.Id +"' id = 'd_discount"+ tran.Id +"' title='Discount' onclick='onCallDiscount("+ tran.Id +", "+ tran.amount +")'><i class='fa fa-handshake-o'></i></a> ";
                                html_thmb += "<a class='btn btn-danger' data-target = '"+ tran.Id +"' id = 'd_delete' title='Delete'><i class='fa fa-trash'></i></a>";
                                html_thmb += "</td>";
                                html_thmb += "</tr>";
                                $("#btn_digital_preview").click(function(){
                                    open_preview(booking_trans);
                                });
                            });
                        }
                        else {
                            html_thmb += '<tr> <td colspan="9" style="text-align: center; font-size: 15px; padding-top: 20px;"> No Data Available </td> </tr>';
                        }

                        function open_preview(trans_number) {
                            window.open("http://"+ report_url_api +"/kpa/work/transaction/generate/insertion-order-contract/" + trans_number + "/DIGITAL",
                                    "mywindow","location=1,status=1,scrollbars=1,width=800,height=760");
                        }

                        $('table#digital_issue_table > tbody').empty().prepend(html_thmb);

                        if(json.Issue_Discounts.length == 0) {
                            $('#total_result').show();
                            $('#issues_total').empty().text(numeral(issues_amount).format('0,0.00'));
                          $('#discretionary_discount').empty().text("(" + numeral(issues_discount).format('0,0.00') + ")");
                            $("#approval_discount_label").text("0%");
                            $("#issues_total_amount").text(numeral(issues_total).format('0,0.00'));
                        }
                        else {

                            $(json.Issue_Discounts).each(function(i, dis_discount) {

                                $('#btnDDiscount').hide();
                                $('#issues_total').empty().text(numeral(issues_total).format('0,0.00'));
                                discretionary_discount = dis_discount.discount_percent / 100;
                                var d_discount = issues_total * discretionary_discount;
                                $('#discretionary_discount').empty().text("(" + numeral(d_discount).format('0,0.00') + ")");
                                var total_amount = issues_total - d_discount;

                                if(Role > 1) {

                                    if(parseInt( dis_discount.status ) == 2) {
                                        $('#btnDDiscount').hide();
                                        $('#status_discretionary_discount').show();
                                        var x_wrapper = "<div id='wrapper_discretionary_discount' style='text-align: center; border: 2px solid green; padding: 5px; border-radius: 5px;'>";
                                        x_wrapper += "<h3 style='color: green;'>Discretionary Discount has been Approved</h3>";
                                        x_wrapper += "</div>";
                                        $('#status_discretionary_discount').empty().append(x_wrapper);
                                    }
                                    else if(parseInt( dis_discount.status ) == 3) {
                                        $('#btnDDiscount').hide();
                                        $('#status_discretionary_discount').show();
                                        var x_wrapper = "<div id='wrapper_discretionary_discount' style='text-align: center; border: 2px solid red; padding: 5px; border-radius: 5px;'>";
                                        x_wrapper += "<h3 style='color: red;'>Discretionary Discount has been Declined</h3>";
                                        x_wrapper += "</div>";
                                        $('#status_discretionary_discount').empty().append(x_wrapper);
                                    }
                                    else {
                                        $('#btnDDiscount').hide();
                                        $('#status_discretionary_discount').show();
                                        var x_wrapper = "<div id='wrapper_discretionary_discount' style='text-align: center; border: 2px solid #1976D2; padding: 5px; border-radius: 5px;'>";
                                        x_wrapper += "<h3 style='color: #1976D2;'>Discretionary Discount is not yet Approved</h3>";
                                        x_wrapper += "</div>";
                                        $('#status_discretionary_discount').empty().append(x_wrapper);
                                    }

                                    $("#issues_total_amount").text(numeral(total_amount).format('0,0.00'));
                                }
                                else {
                                    $('#approval_discretionary_discount').show();
                                    $('#total_result').hide();
                                    $("#approval_discount_label").text(numeral(dis_discount.discount_percent).format('0') + "%");
                                    $("#approval_sales_rep").text(dis_discount.sales_rep_name);
                                    $("#sls_rep").val(dis_discount.sales_rep_id);
                                    $("#sls_rep_dec").val(dis_discount.sales_rep_id);
                                    $("#approval_date").text(dis_discount.created_at);
                                    $("#approval_remarks").text(dis_discount.remarks);
                                    $("#approval_total").text(numeral(issues_total).format('0,0.00'));
                                    //$("#approval_sub_total").text(numeral(total_with_discount).format('0,0.00'));
                                    $("#approval_discount").text( "(" + numeral(d_discount).format('0,0.00') + ")");
                                    $("#approval_amount").text(numeral(total_amount).format('0,0.00'));

                                    if(parseInt( dis_discount.status ) == 2) {
                                        $("#button_approve").hide();
                                        $('#btnDDiscount').hide();
                                        $("#text_status").text("Approved Discount");
                                        $("#text_status").attr("style", "color: green;");
                                    }
                                    else if(parseInt( dis_discount.status ) == 3) {
                                        $("#button_approve").hide();
                                        $("#text_status").text("Declined Discount");
                                        $("#text_status").attr("style", "color: red;");
                                    }
                                    else {
                                        $("#text_status").hide();
                                    }
                                }
                            })
                        }
                    }
                });
            })
        }

        function getMonth(id) {
            switch (id) {
                case 1 : return "January";
                case 2 : return "February";
                case 3 : return "March";
                case 4 : return "April";
                case 5 : return "May";
                case 6 : return "June";
                case 7 : return "July";
                case 8 : return "August";
                case 9 : return "September";
                case 10 : return "October";
                case 11 : return "November";
                case 12 : return "December";
            }
        }

        $(".cc_form").click(function(){
            $("#btn_cc_save").show();
        });

        $(".list_of_bank").click(function(){
            $("#btn_cc_save").hide();
        });

        $("#btn_cc_save").click(function(){

            var client_id = {{ $client_id }};

            var bank_name = $("#bank_name").val();
            var card_number = $("#card_number").val();
            var expiry_date = $("#expiry_date").val();
            var expiry_date = expiry_date.replace(/\//g, "-");
            var cvc_code = $("#cvc_code").val();
            var card_holder_name = $("#card_holder_name").val();

            var isValid = true;
            $('.cc_info').each(function() {
                if ($.trim($(this).val()) == '') {
                    isValid = false;
                    $(this).css({
                        "border": "1px solid red",
                        "background": "#FFCECE"
                    });
                }
                else {
                    $(this).css({
                        "border": "",
                        "background": ""
                    });
                }
            });

            if (isValid == true){
                $.ajax({
                    url: "/api/credit_card_info/" + client_id + "/" + bank_name + "/" + card_number + "/" + expiry_date + "/" + cvc_code + "/" + card_holder_name,
                    dataType: 'text',
                    success: function(data)
                    {
                        var json = $.parseJSON(data);
                        if(json == null)
                            return false;

                        if(json.Code == 200)
                        {
                            $("#cc_success").show();
                            $("#cc_failed").hide();
                            $('.cc_info').val("");
                            credit_card_info();
                        }else{
                            $("#cc_failed").show();
                            $("#cc_success").hide();
                        }

                    }
                });
            }

        });
        credit_card_info();
        function credit_card_info(){
            var client_id = {{ $client_id }};
            var html_thmb = "";
            $.ajax({
                url: "/api/cc_info/list/" + client_id,
                dataType: "text",
                beforeSend: function () {
                    //$('table#cc_table > tbody').empty().prepend('<tr> <td colspan="5" style="text-align: center; font-size: 15px; padding-top: 20px;"> <img src="{{ asset('img/ripple.gif') }}"  /> <br /> Fetching All Data... Please wait...</td> </tr>');
                },
                success: function(data) {
                    var json = $.parseJSON(data);
                    if(json == null)
                        return false;

                    if(json.Code == 404){
                        html_thmb += '<tr> <td colspan="5" style="text-align: center; font-size: 15px; padding-top: 20px;"> No Data Available </td> </tr>';
                        //return false;
                    }

                    if(json.Code == 200){
                        $(json.Result).each(function(i, tran){

                            var on = '';
                            if(tran.status == 1){
                                on = 'checked';
                            }

                            html_thmb += "<tr>";
                            html_thmb += "<td style='text-align: left;'>"+ tran.card_bank +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.card_number +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.card_holder_name +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.card_validity +"</td>";
                            html_thmb += "<td style='text-align: center;'>"+ tran.card_pin +"</td>";
                            html_thmb += "<td style='text-align: center;'>";
                            html_thmb += '<div class="switch">';
                            html_thmb +=    '<div class="onoffswitch">';
                            html_thmb +=        '<input type="checkbox" '+ on +' class="onoffswitch-checkbox set_primary" data-target = "'+ tran.Id +'" id="example1_'+ tran.Id +'">';
                            html_thmb +=            '<label class="onoffswitch-label" for="example1_'+ tran.Id +'">';
                            html_thmb +=            '<span class="onoffswitch-inner"></span>';
                            html_thmb +=            '<span class="onoffswitch-switch"></span>';
                            html_thmb +=        '</label>';
                            html_thmb +=    '</div>';
                            html_thmb += '</div>';
                            html_thmb += "</td>";
                            html_thmb += "</tr>";
                        });
                    }

                    $('table#cc_table > tbody').empty().prepend(html_thmb);
                }
            });
        }

        $("#cc_table").on("click", ".set_primary", function(){
            var cc_uid = $(this).attr("data-target");
            credit_card_set_primary(cc_uid)
        });

        function credit_card_set_primary(cc_uid){

            $.ajax({
                url: "/api/cc_set_primary/" + cc_uid,
                dataType: "text",
                success: function(data) {
                    var json = $.parseJSON(data);
                    if(json == null)
                        return false;

                    if(json.Code == 200){
                        credit_card_info();
                    }

                }
            });
        }
    </script>
    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>


@endsection