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
                    <a href="#">Add Magazine</a>
                </li>
                <li class="active">
                    <strong>Add Issue</strong>
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
                                <p class="list-group-item-text">Select Magazine</p>
                            </a></li>
                        <li class="active"><a href="#step-3">
                                <h4 class="list-group-item-heading">Step 3</h4>
                                <p class="list-group-item-text">Add Issue</p>
                            </a></li>
                    </ul>
                </div>
            </div>

            <div class="row setup-content" id="step-1">
                <div class="col-md-12 well">
                    <div class="col-lg-3" id = "once_approved_aa">
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
                                    <h5>Magazine: <b>{{ $mag_name[0]->magazine_name }} </b></h5>
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

                                        <table class="table table-striped table-bordered table-hover dataTables-example" id="digital_issue_table">
                                            <thead>
                                            <tr>
                                                <th style="width: 60px; text-align: center;">ITEM#</th>
                                                <th style="text-align: left;">MAGAZINE</th>
                                                <th style="width: 200px; text-align: center;">SIZE</th>
                                                <th style="width: 100px; text-align: center;">MONTH</th>
                                                <th style="width: 100px; text-align: center;">YEAR</th>
                                                <th style="width: 100px; text-align: center;">WEEK</th>
                                                <th style="width: 100px; text-align: right;">AMOUNT</th>
                                                <th style="width: 30px; text-align: center;">ACTION</th>
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
                                <label for="recipient-name" class="form-control-label">Discount: <i>by percentage</i></label>
                                <input type="number" class="form-control" id="txtDiscount" name = "txtDiscount" placeholder="Enter discount. I.e: 2 / 12" >
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
            api_get_digital_transaction({{ $mag_name[0]->Id }},{{ $is_member[0]->Id }});

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

                var mag_trans_uid = '{{ $mag_trans_uid }}';
                var d_client_id = '{{ $is_member[0]->Id }}';
                var d_mag_id = '{{ $mag_name[0]->Id }}';
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

            function api_get_digital_transaction(mag_id, client_id){

                var issues_total = 0.0;

                var html_thmb = "";

                $.ajax({
                    url: "/api/api_get_digital_transaction/" + mag_id + "/" + client_id,
                    dataType: "text",
                    beforeSend: function () {
                        $('table#digital_issue_table > tbody').empty().prepend('<tr> <td colspan="9" style="text-align: center; font-size: 15px; padding-top: 20px;"> <img src="{{ asset('img/ripple.gif') }}"  /> <br /> Fetching All Data... Please wait...</td> </tr>');
                    },
                    success: function(data) {
                        var json = $.parseJSON(data);
                        if(json == null)
                            return false;

                        if(json.Code == 404){
                            html_thmb += '<tr> <td colspan="9" style="text-align: center; font-size: 15px; padding-top: 20px;"> No Data Available </td> </tr>';
                        }

                        if(json.Code == 200){

                            $(json.Result).each(function(i, tran){

                                html_thmb += "<tr>";
                                html_thmb += "<td style='text-align: center;'>"+ tran.d_num +"</td>";
                                html_thmb += "<td style='text-align: left;'>"+ tran.mag_name +"</td>";
                                html_thmb += "<td style='text-align: left;'>"+ tran.ad_type + "-" + tran.ad_size +"</td>";
                                html_thmb += "<td style='text-align: center;'>"+ tran.ad_months +"</td>";
                                html_thmb += "<td style='text-align: center;'>"+ tran.ad_year +"</td>";

                                if(tran.ad_weeks != "") {
                                    html_thmb += "<td style='text-align: center;'>"+ tran.ad_weeks +"</td>";
                                }
                                else {
                                    html_thmb += "<td style='text-align: center;'>N/A</td>";
                                }

                                issues_total += parseFloat(tran.ad_amount);
                                html_thmb += "<td style='text-align: right;'>"+ tran.ad_amount +"</td>";
                                html_thmb += "<td style='text-align: center;'>";
                                html_thmb += "<a class='btn btn-danger' data-target = '"+ tran.d_uid +"' id = 'd_delete' title='Delete'><i class='fa fa-trash'></i></a>";
                                html_thmb += "</td>";
                                html_thmb += "</tr>";
                            });
                        }

                        $('table#digital_issue_table > tbody').empty().prepend(html_thmb);
                        $('#issues_total').empty().text(numeral(issues_total).format('0,0.00'));

                        var issues_discount = 0;
                        $('#issues_discount').empty().text(numeral(issues_discount).format('0,0.00'));

                        var issues_sub_total = issues_total;
                        $('#issues_sub_total').empty().text(numeral(issues_sub_total).format('0,0.00'));

                        var discretionary_discount = 0;
                        $('#discretionary_discount').empty().text(numeral(discretionary_discount).format('0,0.00'));

                        var issues_total_amount = issues_sub_total;
                        $('#issues_total_amount').empty().text(numeral(issues_total).format('0,0.00'));

                    }
                });
            }


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
            });

            //$("#notes_modal_content").animate({scrollTop: position}).anchor.position().top + $("#notes_modal_content").scrollTop()

        });

        function populate_notes(n_book_trans_num)
        {
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
                            if(issue.Total_Issue > 1) {
                                if(issue.Total_Issue_Discount != null) {
                                    var issues_discount_origin = parseFloat(issue.Total_Issue_Discount);
                                    var issues_discount = total_with_discount * issues_discount_origin;
                                    total_with_discount = total_with_discount - issues_discount;
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
                                                x_wrapper += "</div>";
                                                $('#status_discretionary_discount').empty().append(x_wrapper);
                                            }
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
                                            }
                                            else if(parseInt( discount.status ) == 3) {
                                                $("#button_approve").hide();
                                                $("#text_status").text("Declined Discount");
                                                $("#text_status").attr("style", "color: red;");
                                            }
                                            else {
                                                $("#text_status").hide();
                                            }
                                        }
                                    });

                                    $('#show_button').append('<button data-toggle="modal" id = "btn_artwork_modal" data-target="#artwork_modal" class="btn btn-primary" style="margin-right: 5px;">Artwork</button>');
                                    $('#show_button').append('<a href = "#" onclick=open_preview("{{ $booking_trans_num[0]->trans_num }}"); style="margin-right: 5px;" class = "btn btn-preview-kpa">Preview</a>');
                                    $('#show_button').append('<a href = "{{ URL('/booking/booking-list') }}" class="btn btn-primary" style="margin-right: 5px;">Done</a>');
                                    $('#show_button').append('<button data-toggle="modal" id = "btn_notes_modal" data-target="#notes_modal" class="btn btn-warning" style="margin-right: 5px;">Notes</button>');

                                }
                                else {
                                    $('#discretionary_discount').text("(" + numeral("0").format('0,0.00') + ")");
                                    $('#issues_total_amount').text(numeral(total_with_discount).format('0,0.00'));
                                    if({{ $booking_trans_num[0]->status }} != 1) {
                                        $('#show_button').append('<button data-toggle="modal" id = "btn_artwork_modal" data-target="#artwork_modal" class="btn btn-primary" style="margin-right: 5px;">Artwork</button>');
                                        $('#show_button').append('<a href = "#" onclick=open_preview("{{ $booking_trans_num[0]->trans_num }}"); style="margin-right: 5px;" class = "btn btn-preview-kpa">Preview</a>');
                                        $('#show_button').append('<a href = "{{ URL('/booking/booking-list') }}" class="btn btn-primary" style="margin-right: 5px;">Done</a>');
                                        $('#show_button').append('<button data-toggle="modal" id = "btn_notes_modal" data-target="#notes_modal" class="btn btn-warning" style="margin-right: 5px;">Notes</button>');
                                    }else {
                                        $('#show_button').append('<button data-toggle="modal" id = "btn_artwork_modal" data-target="#artwork_modal" class="btn btn-primary" style="margin-right: 5px;">Artwork</button>');
                                        $('#show_button').append('<a href = "#" style="margin-right: 5px;" class="btn btn-warning hide_if_approved" data-toggle="modal" data-target="#discount">Discount</a>');
                                        $('#show_button').append('<a href = "#" onclick=open_preview("{{ $booking_trans_num[0]->trans_num }}"); style="margin-right: 5px;" class = "btn btn-preview-kpa">Preview</a>');
                                        $('#show_button').append('<a href = "{{ URL('/booking/booking-list') }}" class="btn btn-primary" style="margin-right: 5px;">Done</a>');
                                        $('#show_button').append('<button data-toggle="modal" id = "btn_notes_modal" data-target="#notes_modal" class="btn btn-warning" style="margin-right: 5px;">Notes</button>');
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
                $('#txtDiscount').on('keyup', function(){
                    var origin_amount = BaseTotalAmount;
                    var value = $(this).val();
                    if(value != "") {
                        var orig_amount = (parseFloat(origin_amount) * parseFloat(value)) / 100;
                        var new_amount = parseFloat(origin_amount) - orig_amount;
                        $('#txtAmount').val(numeral(new_amount).format('0,0.00'));
                    }
                    else {
                        $('#txtAmount').val("0.00");
                    }
                });

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