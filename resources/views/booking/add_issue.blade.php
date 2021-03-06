@extends('layout.magazine_main')

@section('title')
    Add New Contract
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
                    <div class="col-lg-4" id = "once_approved_aa">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Add Issue <small> *all fields are required</small></h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form method="post" action = "{{ url('/booking/save_issue') . '/' . $mag_trans_uid . '/' . $client_id}}">
                                            <section class="panel">

                                              <div class="row">
                                                  <div class="col-xs-12">
                                                      <label id = "quarter_issues_label">Issue</label>
                                                      <select class='form-control' name = 'quarter_issue' id = 'quarter_issued_select'>
                                                        <option value = '' disabled selected>select</option>
                                                        @for($i = 1; $i <= 12; $i++)
                                                        <option value = "{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                      </select>
                                                  </div>
                                              </div>

                                               <div class="row">
                                                    <div class="col-xs-12"  style="margin: 20px 0 0 0;">
                                                        <label for="ex2">Ad Color</label>
                                                        <select class="form-control" name = "ad_criteria_id" id = "ad_criteria_id">
                                                            <option value = "" disabled selected>select</option>
                                                            @for($i = 0; $i < COUNT($ad_c); $i++)
                                                                <option value = "{{ $ad_c[$i]->c_uid }}">{{ $ad_c[$i]->name }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-12"  style="margin: 20px 0 0 0;">
                                                        <label id = "package_label"></label>
                                                        <div id = "ad_package_id"></div>
                                                    </div>
                                                </div>



                                                <div class="row">
                                                    <div class="col-xs-12" style="margin: 20px 0 0 0;">
                                                        <label id = "amount_label"></label>
                                                        <div id = "amount_box"></div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xs-12"  style="margin: 20px 0 0 0;">
                                                        <label id = "line_item_qty_label"></label>
                                                        <div id = "line_item_qty"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <label id = "artwork_label"></label>
                                                        <div id = "artwork"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <label id = "directions_label"></label>
                                                        <div id = "directions"></div>
                                                    </div>
                                                </div>
                                                <input type = "hidden" id = "mag_id_for_discount" name = "mag_id_for_discount">
                                                <input type = "hidden" id = "line_issue_count" name = "line_issue_count">
                                                <input type = "hidden" id = "trans_num_for_discount" name = "trans_num_for_discount">
                                                <br />
                                                <div class="row">
                                                    <div class="col-xs-12 " id = "btn_save_box">
                                                        <div id = "btn_save_box"></div>
                                                    </div>
                                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                                </div>
                                            </section>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8" id = "once_approved_bb">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Company: <b style="color: #bd154d;">{{ $is_member[0]->company_name }}</b> |
                                <h5>Type: <b style="color: #bd154d;">{{  $is_member[0]->is_member == 1 ? "MEMBER - " . $is_member[0]->magazine_name : "NON" }}</b> |
                                <h5>Product: <b style="color: #bd154d;">{{ $mag_name[0]->magazine_name }} </b></h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php
                                            $report_api = \App\Http\Controllers\AssemblyClass::get_reports_api();
                                        ?>
                                        <section class="panel">
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

                                            <table class="table table-striped table-bordered table-hover dataTables-example" id="issue_reports">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10%; text-align: center;">Item #</th>
                                                        <th style="width: 20%; text-align: left;">TYPE</th>
                                                        <th style="width: 20%; text-align: left;">SIZE</th>
                                                        <th style="width: 10%; text-align: center;">ISSUE</th>
                                                        <th style="width: 10%; text-align: center;">QTY</th>
                                                        <th style="width: 10%; text-align: center;">DISCOUNT</th>
                                                        <th style="width: 10%; text-align: right;">AMOUNT</th>
                                                        @if($booking_trans_num[0]->status != 1)
                                                        <th style="width: 10%; text-align: center;"></th>
                                                        @else
                                                        <th style="width: 10%; text-align: center;">ACTION</th>
                                                        @endif
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
                                                        <td>Total:</td>
                                                        <td><span id="issues_total"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span id="issues_discount_label">Issue Discount:</span></td>
                                                        <td><span id="issues_discount"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border-top: 1px solid #C7C7C7;">Sub Total:</td>
                                                        <td style="border-top: 1px solid #C7C7C7;"><span id="issues_sub_total"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span id = "discretionary_discount_label">0% Discretionary Discount:</span></td>
                                                        <td><span id="discretionary_discount"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border-top: 1px solid #C7C7C7;">Total Amount:</td>
                                                        <td style="border-top: 1px solid #C7C7C7;"><span id="issues_total_amount"></span></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div id="show_button" style="margin-top: 45px;" class="pull-left"></div>

                                        </section>
                                    </div>
                                 </div>
                                <div id="status_discretionary_discount" style="height: 35px; margin-top: 10px;"> </div>
                                <div id="approval_discretionary_discount" style="width: 100%; margin-top: 10px; display: none; ">
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
                                            <td style="width: 250px; padding: 5px; border-bottom: 1px solid #C7C7C7;"><span id="issues_discount_label2">Issue Discount:</span></td>
                                            <td style="text-align: right; padding: 5px; border-bottom: 1px solid #C7C7C7; color: red; font-weight: 600;"><span id="issues_discount2"></span></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 250px; padding: 5px; border-bottom: 1px solid #C7C7C7;"> Sub Total: </td>
                                            <td style="text-align: right; padding: 5px; border-bottom: 1px solid #C7C7C7; font-weight: 600;"> <span id="approval_sub_total"></span> </td>
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
</div>

<div class="bd-example">

    {{--discount modal area--}}
    <div class="modal fade" id="discount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action = "{{ url('/booking/save/discount') . '/' . $booking_trans_num[0]->trans_num . '/' . $mag_trans_uid . '/' . $client_id }}">
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
                            <input type="hidden" class="form-control" id="txtBaseAmountHidden" name = "txtBaseAmountHidden" readonly>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Discount: <i>by dollar amount</i></label>
                            <input type="text" class="form-control" id="txtDiscountDollar" name = "txtDiscountDollar" placeholder="Enter dollar amount. I.e: 10 or 750" >
                            <input type="hidden" class="form-control" id="txtDiscount" name = "txtDiscount" placeholder="Enter discount. I.e: from 0.0100 to 1" >
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Remarks: <i>300 Characters</i> </label>
                            <textarea type="number" class="form-control" id="txtRemarks" name = "txtRemarks" placeholder="Enter remarks" maxlength="300" rows="4"></textarea>
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
        <form method="post" action = "{{ url('/booking/issue/discount/approve') . '/' . $booking_trans_num[0]->trans_num . '/' . $mag_trans_uid . '/' . $client_id }}">
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
        <form method="post" action = "{{ url('/booking/issue/discount/decline') . '/' . $booking_trans_num[0]->trans_num . '/' . $mag_trans_uid . '/' . $client_id }}">
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
                        <textarea class="form-control" id="txtNotes" placeholder="Enter Your Notes" maxlength="300" rows="4"></textarea>
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

    <div class="modal fade" id="edit_notes_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelNotes" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="exampleModalLabel">Edit Notes <b class = "pull-right" style = "font-weight: 600; margin-right: 10px;">Booking Ref. {{ $booking_trans_num[0]->trans_num }}</b></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Notes</label>
                        <textarea class="form-control" id="edit_txtNotes" placeholder="Enter Your Notes" maxlength="300" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <a type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
                    <button class="btn btn-primary" id = "btn_edit_notes_save">Save</button>
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
                                    <a data-toggle="collapse" class = "list_of_bank" data-parent="#accordion" href="#collapseOne">List of Bank Accounts</a>
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
var is_member = {{ $is_member[0]->is_member }};

$(document).ready(function(){

    var client_id = {{ $client_id }};
    var trans_status = {{ $booking_trans_num[0]->status }};
    if(trans_status != 1) {
        $("#once_approved_aa").hide();
        $("#once_approved_bb").removeClass('col-lg-8').addClass('col-lg-12');
        $("#once_approved_cc").hide();
    }

    $('#ad_criteria_id').on('change',function(){
        var mag_uid = {{ $transaction_uid[0]->magazine_id }};
        var criteria_id = $(this).val();
        $.ajax({
            url: "/booking/getPackageName/" + criteria_id + "/" + mag_uid,
            dataType: 'text',
            success: function(data)
            {
                var json = $.parseJSON(data);
                if(json == null)
                    return false;

                // $('#ad_package_id').empty();
                $('#package_label').empty().append("Ad Size");
                $('#ad_package_id').empty().append("<select class='form-control' name = 'ad_package_id' id = 'ad_package_id_select'>");
                $('#ad_package_id_select').empty().append("<option value = '' disabled selected>select</option>");
                $(json.list).each(function(g, gl){
                    $('#ad_package_id_select').append("<option value = "+ gl.ad_size + ";" + gl.ad_amount + ";" + gl.price_uid +">"+ gl.package_name +"</option>");
                });
                $('#ad_package_id').append("</select>");

                //select package and call quarter issue
                $('#ad_package_id_select').on('change',function()
                {
                    var i;
                    var ad_size = $(this).val();
                    var ad_sizes = ad_size.split(';');

                    $('#amount_label').empty().append("Amount");
                    $('#amount_box').empty().append('<input type="hidden" value = "'+ ad_sizes[2] +'" name = "price_uid"><input type="hidden" value = "'+ ad_sizes[0] +'" name = "ad_p_split"><input type="text" value = "'+ ad_sizes[1] +'" name = "ad_amount" class="form-control" readonly>');

                    // $('#quarter_issues_label').empty().append("Issue");
                    // $('#quarter_issued_box').empty().append("<select class='form-control' name = 'quarter_issue' id = 'quarter_issued_select'>");
                    // $('#quarter_issued_select').append("<option value = '' disabled selected>select</option>");
                    // for(i = 1; i <= 12; i++) {
                    //     $('#quarter_issued_select').append("<option value = "+ i +"> " + i + "</option>");
                    // }
                    // $('#quarter_issued_box').append('</select>');

                    //select quarter
                    $('#line_item_qty_label').empty().append("Line Item QTY");
                    $('#line_item_qty').empty().append('<input type="number" name = "line_item_qty" class="form-control" value = "1">');
                    $('#btn_save_box').empty().append('<input type="submit" class="btn btn-primary pull-right" value = "Save">');
                });
            }
        });
    });

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

    //$("#notes_modal_content").animate({scrollTop: position}).anchor.position().top + $("#notes_modal_content").scrollTop()

});

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
                html_thmb += '<tr> <td colspan="6" style="text-align: center; font-size: 15px; padding-top: 20px;"> No Data Available </td> </tr>';
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
                var sales_red_uid = {{ $_COOKIE['Id'] }};

                $(json.result).each(function(i, tran){

                    var pencil_update = "";
                    if(sales_red_uid == tran.sales_rep_id){
                        pencil_update = "<a class = 'edit_notes' data-target = '"+ tran.Id +"' data-target-notes = '"+ tran.notes +"' title = 'Edit your notes'><i class='fa fa-pencil' aria-hidden='true'></i></a>";
                    }

                    html_thmb += "<tr>";
                    html_thmb += "<td style='text-align: left;'>" + tran.notes;
                    html_thmb += "<br /><br /><b style = 'margin-right: 10px;'>Sales Rep </b>" + tran.sales_rep_name;
                    html_thmb += "<b style = 'margin-left: 50px; margin-right: 10px;'>Date </b>" + tran.created_at;
                    html_thmb += "</td><td>"+ pencil_update +"</td>";
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


    $("#notes_lists").on("click", ".edit_notes", function(){
        var note_uid = $(this).attr("data-target");
        var notes = $(this).attr("data-target-notes");

        $("#edit_txtNotes").val(notes);

        $('#edit_notes_modal').modal({
            show: true
        });

        $('#notes_modal').modal('hide');

        $("#btn_edit_notes_save").click(function(){

            var updated_notes = $("#edit_txtNotes").val();

            var isValid = true;
            $('#edit_txtNotes').each(function() {
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
                    url: "/booking/edit/notes/save/" + note_uid + "/" + updated_notes,
                    dataType: 'text',
                    success: function(data)
                    {
                        var json = $.parseJSON(data);
                        if(json == null)
                            return false;

                        if(json.Code == 200)
                        {
                            $('#edit_notes_modal').modal('hide');

                            $('#notes_modal').modal({
                                show: true
                            });

                            populate_notes(n_book_trans_num);
                        }

                    }
                });
            }

        });

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
var trans_id = {{ $transaction_uid[0]->transaction_id }};
console.log(trans_id);
populate_issues_transaction(trans_id);
function populate_issues_transaction(uid) {
    var html_thmb = "";
    var isFirstLoad = true;

    $(document).ready( function() {
        var hasDiscount = 0;
        var BaseTotalAmount = 0;
        $.ajax({
            url: "http://"+report_url_api+"/kpa/work/magazine-issue-lists/"+uid,
            dataType: "text",
            beforeSend: function () {
                if(isFirstLoad) {
                    isFirstLoad = false;
                    $('table#issue_reports > tbody').empty().prepend('<tr> <td colspan="8" style="text-align: center;"> <img src="{{ asset('img/ripple.gif') }}" style="width: 90px;"  />  Fetching All Transactions... Please wait...</td> </tr>');
                }
            },
            success: function(data) {
                var json = $.parseJSON(data);
                if(json == null)
                    return false;

                //$("#count_line_item").val(json.Count);
                //json.Issue_Discounts[0]['Total_Issue']
                var issue_discount_new = 0;
                if(json.Count != 0)
                {
                    issue_discount_new = json.Count;
                }

                {{--console.log("Transaction ID: " + {{ $transaction_uid[0]->transaction_id }});--}}
                {{--console.log("Mag UID: " + json.Mag_Uid);--}}
                {{--console.log("Line Issue Count: " + issue_discount_new);--}}
                {{--console.log("Trans Num: " + '{{ $booking_trans_num[0]->trans_num }}');--}}

                $("#mag_id_for_discount").val(json.Mag_Uid);
                $("#line_issue_count").val(issue_discount_new);
                $("#trans_num_for_discount").val('{{ $booking_trans_num[0]->trans_num }}');

                if(json.Status == 404) {
                    $('table#issue_reports > tbody').empty().prepend('<tr> <td colspan="8">' + json.Message + '</td> </tr>');
                    return;
                }
                $('#mag_trans_container').empty().prepend('<h3>'+ json.Magazine_Name +' [ <span>'+ json.Mag_Code +'</span> ] | '+ json.Mag_Country +' </h3>');

                var total_with_discount = 0;
                var item_count = 1;
                var i_sub_total = 0;
                var i_discount = 0;
                var i_total_less_discount = 0;
                var i_total = 0;

                $(json.Data).each(function(i, tran){
                    html_thmb += "<tr>";
                    html_thmb += "<td style='text-align: center;'>"+item_count+"</td>";
                    html_thmb += "<td style='text-align: left;'>"+tran.ad_color+"</td>";
                    html_thmb += "<td style='text-align: left;'>"+tran.ad_size+"</td>";
                    html_thmb += "<td style='text-align: center;'> IS"+tran.quarter_issued+"</td>";
                    html_thmb += "<td style='text-align: center;'> "+tran.line_item_qty+"</td>";

                    var discount = 0;
                    var qty_discount = tran.total_discount_by_percent;
                    var new_price = tran.total_amount_with_discount;
                    if(qty_discount == null) {
                        new_price = tran.sub_total_amount;
                    }

                    if(is_member > 0) {
                        discount = new_price * 0.15;
                        new_price = new_price - (new_price * 0.15);
                    }

                    html_thmb += "<td style='text-align: center;'> Member: "+numeral(discount).format('0,0.00')+"</td>";

                    var n_status = "Void";
                    var p_status = parseInt(tran.status);
                    if(p_status == 1){
                        n_status = "Pending";
                    }else if(p_status == 2){
                        n_status = "For Approval";
                    }else if(p_status == 3){
                        n_status = "Approved";
                    }else if(p_status == 4){
                        n_status = "Declined";
                    }
                    html_thmb += "<td style='text-align: right;'>"+ numeral(new_price).format('0,0.00') +"</td>";
                    html_thmb += "<td style='text-align: center;'>";
                    if({{ $booking_trans_num[0]->status }} != 1)
                    {
                        html_thmb += "";
                    }else{
                        html_thmb += "<a id = 'once_approved_cc' onclick='return ConfirmDelete();' href = '{{ URL("/booking/delete_issue") ."/" }}"+ tran.id + "/" + tran.magazine_trans_id +"/{{ $client_id }}' class='btn btn-danger' data-toggle='trashbin' title='Delete'><i class='fa fa-trash'></i></a>";
                    }
                    html_thmb += "</td>";

                    html_thmb += "</tr>";
                    item_count++;
                    total_with_discount += parseFloat(new_price);
                });

                $("#issues_total").text(numeral(total_with_discount).format('0,0.00'));
                $("#approval_total").text(numeral(total_with_discount).format('0,0.00'));
                $(json.Issue_Discounts).each(function(i, issue){

                    if(issue.Issue_Total > 1) {
                        if(issue.Issue_Percent > 0) {
                            var issues_discount_origin = parseFloat(issue.Issue_Percent);
                            var issues_discount = total_with_discount * issues_discount_origin;
                            total_with_discount = total_with_discount - issues_discount;

                            console.log(issues_discount_origin);
                            console.log(issues_discount);
                            console.log(total_with_discount);

                            $("#issues_discount").text( "(" + numeral(issues_discount).format('0,0.00') + ")");
                            $("#issues_discount2").text( "(" + numeral(issues_discount).format('0,0.00') + ")");

                            var get_percentage = issues_discount_origin * 100;
                            $("#issues_discount_label").text(numeral(get_percentage).format('0.00') + "% Issue Discount:");
                            $("#issues_discount_label2").text(numeral(get_percentage).format('0.00') + "% Issue Discount:");
                        }
                        else {
                            $("#issues_discount").text( "(" + numeral(0).format('0,0.00') + ")");
                            $("#issues_discount2").text( "(" + numeral(0).format('0,0.00') + ")");

                            $("#issues_discount_label").text(numeral(0).format('0.00') + "% Issue Discount:");
                            $("#issues_discount_label2").text(numeral(0).format('0.00') + "% Issue Discount:");
                        }
                    }
                    else {
                        $("#issues_discount").text( "(" + numeral(0).format('0,0.00') + ")");
                        $("#issues_discount2").text( "(" + numeral(0).format('0,0.00') + ")");
                    }
                });

                //issues_discount
                $("#approval_discount_label").text("0%");

                $('table#issue_reports > tbody').empty().prepend(html_thmb);

                $('#issues_sub_total').text(numeral(total_with_discount).format('0,0.00'));

                $.ajax({
                    url: "/booking/get_discount_transaction/" + '{{ $booking_trans_num[0]->trans_num }}',
                    dataType: "text",
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if (json.status == 202) {

                            $(json.result).each(function(i, discount) {

                                i_sub_total = total_with_discount;
                                i_discount = discount.discount_percent / 100;
                                i_total_less_discount = (i_sub_total * i_discount);
                                i_total = i_sub_total - i_total_less_discount;

                                if(Role > 1) {

                                    $("#discretionary_discount").text( "(" + numeral(i_total_less_discount).format('0.00') + ")");
                                    $("#issues_total_amount").text(numeral(i_sub_total - i_total_less_discount).format('0,0.00'));
                                    if(parseInt( discount.status ) == 2) {
                                        $('#status_discretionary_discount').show();
                                        var x_wrapper = "<div id='wrapper_discretionary_discount' style='text-align: center; border: 2px solid green; padding: 5px; border-radius: 5px;'>";
                                        x_wrapper += "<h3 style='color: green;'>Discretionary Discount has been Approved</h3>";
                                        x_wrapper += "</div>";
                                        $('#status_discretionary_discount').empty().append(x_wrapper);
                                    }
                                    else if(parseInt( discount.status ) == 3) {
                                        $('#status_discretionary_discount').show();
                                        var x_wrapper = "<div id='wrapper_discretionary_discount' style='text-align: center; border: 2px solid red; padding: 5px; border-radius: 5px;'>";
                                        x_wrapper += "<h3 style='color: red;'>Discretionary Discount has been Declined</h3>";
                                        x_wrapper += "</div>";
                                        $('#status_discretionary_discount').empty().append(x_wrapper);
                                    }
                                    else {
                                        $('#status_discretionary_discount').show();
                                        var x_wrapper = "<div id='wrapper_discretionary_discount' style='text-align: center; border: 2px solid #1976D2; padding: 5px; border-radius: 5px;'>";
                                        x_wrapper += "<h3 style='color: #1976D2;'>Discretionary Discount is not yet Approved</h3>";
                                        x_wrapper += "</div> <br /> <a id = 'cancel_discretionary_discount' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-remove-sign'></span> Click here if you want to cancel discretionary discount.</a>";
                                        $('#status_discretionary_discount').empty().append(x_wrapper);
                                    }

                                    $("#cancel_discretionary_discount").click(function(){

                                        var salesperson_uid = $.cookie("Id");
                                        var trans_num = '{{ $booking_trans_num[0]->trans_num }}';
                                        var mag_trans_uid = '{{ $mag_trans_uid }}';
                                        var client_id = '{{ $client_id }}';

                                        swal({
                                            title: '',
                                            text: "Are you sure do you want to cancel?",
                                            type: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Yes',
                                            cancelButtonText: 'Cancel'
                                        }).then(function() {

                                            $.ajax({
                                                url: "/cancel_discretionary_discount/" + trans_num + "/" + salesperson_uid + "/" + mag_trans_uid + "/" + client_id,
                                                dataType: "text",
                                                success: function(data){
                                                    var json = $.parseJSON(data);
                                                    if(json.Code == 404){
                                                        swal({
                                                            title: "",
                                                            text: "This is not your discretionary discount.",
                                                            type: "warning"
                                                        }).then(
                                                            function() {
                                                                location.reload();
                                                            }
                                                        )
                                                        return false;
                                                    }

                                                    if(json.Code == 200){
                                                        swal({
                                                            title: "",
                                                            text: "You have successfully cancelled discretionary discount.",
                                                            type: "success"
                                                        }).then(
                                                                function() {
                                                                    location.reload();
                                                                }
                                                        )
                                                        return false;
                                                    }
                                                }
                                            });

                                        }, function(dismiss) {
                                            if (dismiss === 'cancel') {
                                                swal(
                                                    '',
                                                    'Cancelled',
                                                    'error'
                                                )
                                            }
                                        })

                                    });
                                }
                                else {
                                    $('#approval_discretionary_discount').show();
                                    $('#total_result').hide();
                                    $("#approval_discount_label").text(numeral(discount.discount_percent).format('0,0.00') + "%");
                                    $("#approval_sales_rep").text(discount.sales_rep_name);
                                    $("#sls_rep").val(discount.sales_rep_id);
                                    $("#sls_rep_dec").val(discount.sales_rep_id);
                                    $("#approval_date").text(discount.created_at);
                                    $("#approval_remarks").text(discount.remarks);
                                    $("#approval_sub_total").text(numeral(total_with_discount).format('0,0.00'));
                                    $("#approval_discount").text( "(" + numeral(i_total_less_discount).format('0,0.00') + ")");
                                    $("#approval_amount").text(numeral(i_total).format('0,0.00'));

                                    if(parseInt( discount.status ) == 2) {

                                        $("#button_approve").hide();
                                        $("#text_status").text("Approved Discount");
                                        $("#text_status").attr("style", "color: green;");
                                        $("#text_status").append(" <br /><br /> <a id = 'revoke_discretionary_discount' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-remove-sign'></span> Click here if you want to revoke discretionary discount.</a>");
                                    }
                                    else if(parseInt( discount.status ) == 3) {
                                        $("#button_approve").hide();
                                        $("#text_status").text("Declined Discount");
                                        $("#text_status").attr("style", "color: red;");
                                        $("#text_status").append(" <br /><br /> <a id = 'revoke_discretionary_discount' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-remove-sign'></span> Click here if you want to revoke discretionary discount.</a>");
                                    }
                                    else {
                                        $("#text_status").hide();
                                    }

                                    $("#revoke_discretionary_discount").click(function(){

                                        var salesperson_uid = discount.sales_rep_id;
                                        var trans_num = '{{ $booking_trans_num[0]->trans_num }}';
                                        var mag_trans_uid = '{{ $mag_trans_uid }}';
                                        var client_id = '{{ $client_id }}';

                                        swal({
                                            title: '',
                                            text: "Are you sure do you want to revoke?",
                                            type: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Yes',
                                            cancelButtonText: 'Cancel'
                                        }).then(function() {

                                            $.ajax({
                                                url: "/revoke_discretionary_discount/" + trans_num + "/" + salesperson_uid + "/" + mag_trans_uid + "/" + client_id,
                                                dataType: "text",
                                                success: function(data){
                                                    var json = $.parseJSON(data);
                                                    if(json.Code == 404){
                                                        swal({
                                                            title: "",
                                                            text: "This is not your discretionary discount.",
                                                            type: "warning"
                                                        }).then(
                                                                function() {
                                                                    location.reload();
                                                                }
                                                        )
                                                        return false;
                                                    }

                                                    if(json.Code == 200){
                                                        swal({
                                                            title: "",
                                                            text: "You have successfully revoke discretionary discount.",
                                                            type: "success"
                                                        }).then(
                                                                function() {
                                                                    location.reload();
                                                                }
                                                        )
                                                        return false;
                                                    }
                                                }
                                            });

                                        }, function(dismiss) {
                                            if (dismiss === 'cancel') {
                                                swal(
                                                        '',
                                                        'Cancelled',
                                                        'error'
                                                )
                                            }
                                        })

                                    });
                                }
                            });

                            $('#show_button').append('<button data-toggle="modal" id = "btn_artwork_modal" data-target="#artwork_modal" class="btn btn-primary" style="margin-right: 5px;">Artwork</button>');
                            $('#show_button').append('<button data-toggle="modal" id = "btn_payment_method_modal" data-target="#payment_method_modal" class="btn btn-primary" style="margin-right: 5px;">Payment Method</button>');
                            $('#show_button').append('<button data-toggle="modal" id = "btn_notes_modal" data-target="#notes_modal" class="btn btn-warning" style="margin-right: 5px;">Notes</button>');
                            $('#show_button').append('<a href = "{{ URL('/booking/booking-list') }}" class="btn btn-success" style="margin-right: 5px; background-color: #5cb85c; border-color: #4cae4c; color: #fff;">Done</a>');
                            $('#show_button').append('<a href = "#" onclick=open_preview("{{ $booking_trans_num[0]->trans_num }}"); style="margin-right: 5px;" class = "btn btn-preview-kpa">Preview</a>');

                        }
                        else {
                            $('#discretionary_discount').text("(" + numeral("0").format('0,0.00') + ")");
                            $('#issues_total_amount').text(numeral(total_with_discount).format('0,0.00'));
                            if({{ $booking_trans_num[0]->status }} != 1) {
                                $('#show_button').append('<button data-toggle="modal" id = "btn_artwork_modal" data-target="#artwork_modal" class="btn btn-primary" style="margin-right: 5px;">Artwork</button>');
                                $('#show_button').append('<button data-toggle="modal" id = "btn_payment_method_modal" data-target="#payment_method_modal" class="btn btn-primary" style="margin-right: 5px;">Payment Method</button>');
                                $('#show_button').append('<button data-toggle="modal" id = "btn_notes_modal" data-target="#notes_modal" class="btn btn-warning" style="margin-right: 5px;">Notes</button>');
                                $('#show_button').append('<a href = "{{ URL('/booking/booking-list') }}" class="btn btn-success" style="margin-right: 5px; background-color: #5cb85c; border-color: #4cae4c; color: #fff;">Done</a>');
                                $('#show_button').append('<a href = "#" onclick=open_preview("{{ $booking_trans_num[0]->trans_num }}"); style="margin-right: 5px;" class = "btn btn-preview-kpa">Preview</a>');
                            }else {
                                $('#show_button').append('<button data-toggle="modal" id = "btn_artwork_modal" data-target="#artwork_modal" class="btn btn-primary" style="margin-right: 5px;">Artwork</button>');
                                $('#show_button').append('<a href = "#" style="margin-right: 5px;" class="btn btn-primary hide_if_approved" data-toggle="modal" data-target="#discount">Discount</a>');
                                $('#show_button').append('<button data-toggle="modal" id = "btn_payment_method_modal" data-target="#payment_method_modal" class="btn btn-primary" style="margin-right: 5px;">Payment Method</button>');

                                $('#show_button').append('<button data-toggle="modal" id = "btn_notes_modal" data-target="#notes_modal" class="btn btn-warning" style="margin-right: 5px;">Notes</button>');
                                $('#show_button').append('<a href = "{{ URL('/booking/booking-list') }}" class="btn btn-success" style="margin-right: 5px; background-color: #5cb85c; border-color: #4cae4c; color: #fff;">Done</a>');
                                $('#show_button').append('<a href = "#" onclick=open_preview("{{ $booking_trans_num[0]->trans_num }}"); style="margin-right: 5px;" class = "btn btn-preview-kpa">Preview</a>');
                            }
                        }

                        $("#btn_artwork_modal").click(function(){
                            var book_trans_num = '{{ $booking_trans_num[0]->trans_num }}';
                            populate_get_artwork(book_trans_num);
                        });
                    }
                });
                BaseTotalAmount = total_with_discount;
                $('#txtBaseAmount').val(numeral(BaseTotalAmount).format('0,0.00'));
                $('#txtBaseAmountHidden').val(BaseTotalAmount);
            }
        });

        $('#txtAmount').val("0.00");
        $('#txtDiscountDollar').on('keyup', function(){
            var origin_amount = BaseTotalAmount;
            var value = $(this).val();
            if(value != "") {
                var new_amount = parseFloat(origin_amount) - parseFloat(value);
                var orig_amount_percentage = parseFloat(value) / parseFloat(origin_amount)
                orig_amount_percentage = orig_amount_percentage * 100;
                $('#txtDiscount').val(numeral(orig_amount_percentage).format('0.00'));
                $('#txtAmount').val(numeral(new_amount).format('0,0.00'));
            }
            else {
                $('#txtAmount').val("0.00");
            }
        });

        // $('#txtDiscount').on('keyup', function(){
        //     var origin_amount = BaseTotalAmount;
        //     var value = $(this).val();
        //     if(value != "") {
        //
        //       // var orig_amount = (parseFloat(origin_amount) * parseFloat(value)) / 100;
        //       // var new_amount = parseFloat(origin_amount) - orig_amount;
        //
        //         var orig_amount = parseFloat(value) / parseFloat(origin_amount)
        //         orig_amount = orig_amount * 100;
        //
        //         console.log(orig_amount);
        //
        //         // var new_amount = parseFloat(origin_amount) - orig_amount;
        //
        //
        //         $('#txtAmount').val(numeral(orig_amount).format('0,0.00'));
        //     }
        //     else {
        //         $('#txtAmount').val("0.00");
        //     }
        // });

    }); //add semi colon
}

function populate_get_artwork(book_trans_num) {
    $(document).ready( function() {
        $.ajax({
            url: "/booking/get_artwork/" + book_trans_num,
            dataType: "text",
            beforeSend: function () {
            },
            success: function(data) {
                var json = $.parseJSON(data);
                if(json == null)
                    return false;

                if(json.Code == 200)
                {
                    $(json.result).each(function(i, tran){
                        $("#selArtwork").val(tran.artwork);
                        $("#txtDirections").val(tran.directions);
                    });
                }
                else if(json.Code == 404)
                {
                    $("#selArtwork").val();
                    $("#txtDirections").val();
                }
            }
        });
    })
}
</script>

@endsection
