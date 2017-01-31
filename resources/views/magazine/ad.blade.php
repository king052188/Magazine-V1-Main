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
                <form role="form" action="{{ URL('/magazine/add-color-size-discount') . '/' . $mag_uid }}" method="POST">
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
                                <div class="form-group">
                                    <label for="ex2">Ad Color</label>
                                    <select class="form-control" name = "ad_color" id = "ad_color">
                                        <option value = "" selected>select</option>
                                        @for($i = 0; $i < COUNT($ad_c); $i++)
                                            <option value = "{{ $ad_c[$i]->Id }}">{{ $ad_c[$i]->name }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ex2">Ad Size</label>
                                    <select class="form-control" name = "ad_size" id = "ad_size">
                                        <option value = "" selected>select</option>
                                        @for($i = 0; $i < COUNT($ad_s); $i++)
                                            <option value = "{{ $ad_s[$i]->Id }}">{{ $ad_s[$i]->package_name }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Ad Amount</label>
                                    <input id="original_amount" type="text" placeholder="Enter amount" class="form-control" name="ad_amount">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="ibox float-e-margins">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#discount_issue"> Discount Issue</a></li>
                                <li class=""><a data-toggle="tab" href="#discount_qty"> Discount Quantity</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="discount_qty" class="tab-pane">
                                    <div class="ibox-title">
                                        <h5> Amount Discount by 1 or more quantity <small> </small></h5>
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
                                                    <input id="2x_per" type="text" placeholder="Enter Discount" class="form-control" name="discount[]">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>2x Amount</label>
                                                    <input id="2x_amount" type="text" placeholder="Amount" class="form-control" name="cid" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="col-sm-6">
                                                    <label>3x Percent Discount</label>
                                                    <input id="3x_per" type="text" placeholder="Enter Discount" class="form-control" name="discount[]">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>3x Amount</label>
                                                    <input id="3x_amount" type="text" placeholder="Amount" class="form-control" name="cid" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="col-sm-6">
                                                    <label>4x Percent Discount</label>
                                                    <input id="4x_per" type="text" placeholder="Enter Discount" class="form-control" name="discount[]">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>4x Amount</label>
                                                    <input id="4x_amount" type="text" placeholder="Amount" class="form-control" name="cid" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="col-sm-6">
                                                    <label>5x Percent Discount</label>
                                                    <input id="5x_per" type="text" placeholder="Enter Discount" class="form-control" name="discount[]">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>5x Amount</label>
                                                    <input id="5x_amount" type="text" placeholder="Amount" class="form-control" name="cid" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 m-t-sm">
                                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                                <button class="btn btn-sm btn-primary pull-right" id = "btn_submit">Save</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div id="discount_issue" class="tab-pane active">
                                    <div class="ibox-title">
                                        <h5> Amount Discount by 1 or more issue <small> </small></h5>
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
                                                    <input type="text" placeholder="Enter Discount" class="form-control" id = "discount_2">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>3x Percent Discount</label>
                                                    <input type="text" placeholder="Enter Discount" class="form-control" id = "discount_3">
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="col-sm-6">
                                                    <label>4x Percent Discount</label>
                                                    <input type="text" placeholder="Enter Discount" class="form-control" id = "discount_4">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>5x Percent Discount</label>
                                                    <input type="text" placeholder="Enter Discount" class="form-control" id = "discount_5">
                                                </div>
                                            </div>

                                            <div class="col-sm-12 m-t-sm">
                                                <a class="btn btn-sm btn-primary pull-right" id = "btn_discount_issue">Save Issue</a>
                                            </div>

                                        </div>
                                    </div>
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
                                    <th data-toggle="true" style="width: 50px; text-align: center;">#</th>
                                    <th style="width: 200px; text-align: center;">MAG Code</th>
                                    <th style="text-align: center;">Magazine Name</th>
                                    <th style="text-align: center;">Company Name</th>
                                    <th style="width: 100px; text-align: center;">Country</th>
                                    <th style="width: 50px; text-align: center;" data-hide="all"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $n = 1 ?>
                                    @for($i=0; $i < COUNT($mag); $i++)
                                        <tr>
                                            <td style = "padding: 5px; text-align: center;">{{ $n++ }}</td>
                                            <td style = "padding: 5px; text-align: center;">{{ $mag[$i]['mag_code'] }}</td>
                                            <td style = "padding: 5px; text-align: center;">{{ $mag[$i]['magazine_name'] }}</td>
                                            <td style = "padding: 5px; text-align: center;">{{ $mag[$i]['company_id'] }}</td>
                                            <td style = "padding: 5px; text-align: center;">{{ $mag[$i]['magazine_country'] }}</td>
                                            <td style = "padding: 5px; text-align: center;"><a data-toggle="collapse" data-target="#demox_{{ $mag[$i]['Id'] }}"><i class="fa fa-plus" aria-hidden="true"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td colspan = "7" class="p0">
                                                <div id="demox_{{ $mag[$i]['Id'] }}" class="collapse">
                                                    @if(COUNT($mag[$i]['ad_result']) > 0)
                                                        <div style="width: 100%; text-align: center; background: #133b63; color: #ffffff;">
                                                            <div style="padding: 5px;">
                                                                <h3>{{ $mag[$i]['magazine_name'] }} [ Price List ] </h3>
                                                            </div>
                                                        </div>
                                                        <table class="table table-striped table-bordered mb0">
                                                            <thead>
                                                                <tr>
                                                                    <th data-toggle="true" style = "width: 250px; padding: 5px; text-align: center; background: #a4a4a4; color: #000000;">Ad Color</th>
                                                                    <th style = "padding: 5px; text-align: center; background: #a4a4a4; color: #000000;">Ad Size</th>
                                                                    <th style = "width: 120px; padding: 5px; text-align: right; background: #a4a4a4; color: #000000;">Ad Amount</th>
                                                                    <th style = "width: 50px; background: #a4a4a4; color: #000000;"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($mag[$i]['ad_result'] as $ad)
                                                                <tr>
                                                                    <td style = "padding: 5px; text-align: center;">{{ $ad['ad_color'] }}</td>
                                                                    <td style = "padding: 5px; text-align: center;">{{ $ad['ad_size'] }}</td>
                                                                    <td style = "padding: 5px; text-align: right;">{{ number_format($ad['ad_amount'], 2, '.', ',') }}</td>
                                                                    <td style = "padding: 5px; text-align: center;">
                                                                        <a data-toggle="collapse" data-target="#demo_{{ $ad['ad_Id'] }}"><i class="fa fa-plus" aria-hidden="true"></i></a>  |
                                                                        <a class = "delete_ad" data-target = "{{ $ad['ad_Id'] }}"><i class="fa fa-trash-o"></i></a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan = "6" class="p0">
                                                                        <div id="demo_{{ $ad['ad_Id'] }}" class="collapse">
                                                                            <div style="width: 100%; text-align: center; background: #550c6d; color: #ffffff;">
                                                                                <div style="padding: 5px;">
                                                                                    <h3>{{ $mag[$i]['magazine_name'] }} [ Discount List ]</h3>
                                                                                </div>
                                                                            </div>
                                                                            <table class="table table-striped table-bordered mb0">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th style = "padding: 5px; text-align: center; background: #a4a4a4; color: #000000;">Ad Color & Size</th>
                                                                                    <th style = "padding: 5px; text-align: center; width: 100px; background: #a4a4a4; color: #000000;">Qty</th>
                                                                                    <th data-toggle="true" style = "padding: 5px; text-align: right; width: 100px; background: #a4a4a4; color: #000000;">Percent</th>
                                                                                    <th data-toggle="true" style = "padding: 5px; text-align: right; width: 120px; background: #a4a4a4; color: #000000;">Amount</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <?php $percent_cache = 0; ?>
                                                                                @foreach ($ad['discount_result'] as $dis)
                                                                                    <tr>
                                                                                        <td style = "padding: 5px; text-align: center;">{{ $ad['ad_color'] .' - '. $ad['ad_size'] }}</td>
                                                                                        <td style = "padding: 5px; text-align: center;">{{ $dis->type }}</td>
                                                                                        <td style = "padding: 5px; text-align: center;">{{ ($dis->percent * 100) }}%</td>
                                                                                        <?php
                                                                                            $real_amount = (float)$ad['ad_amount'];
                                                                                            $qty = (int)$dis->type;
                                                                                            $percent = (float)$dis->percent;
                                                                                            if($qty == 2) {
                                                                                                if($percent > 0) {
                                                                                                    $percent_cache = $percent;
                                                                                                    $sub_amount = $real_amount * $qty;
                                                                                                    $total_amount = $sub_amount - ($sub_amount * (float)$dis->percent);
                                                                                                }
                                                                                                else {
                                                                                                    $sub_amount = $real_amount * $qty;
                                                                                                    $total_amount = $sub_amount;
                                                                                                }
                                                                                            }
                                                                                            if($qty == 3) {
                                                                                                if($percent > 0) {
                                                                                                    $percent_cache = $percent;
                                                                                                    $sub_amount = $real_amount * $qty;
                                                                                                    $total_amount = $sub_amount - ($sub_amount * (float)$dis->percent);
                                                                                                }
                                                                                                else {
                                                                                                    $sub_amount = $real_amount * $qty;
                                                                                                    $total_amount = $sub_amount - ($sub_amount * $percent_cache);
                                                                                                }
                                                                                            }
                                                                                            if($qty == 4) {
                                                                                                if($percent > 0) {
                                                                                                    $percent_cache = $percent;
                                                                                                    $sub_amount = $real_amount * $qty;
                                                                                                    $total_amount = $sub_amount - ($sub_amount * (float)$dis->percent);
                                                                                                }
                                                                                                else {
                                                                                                    $sub_amount = $real_amount * $qty;
                                                                                                    $total_amount = $sub_amount - ($sub_amount * $percent_cache);
                                                                                                }
                                                                                            }
                                                                                            if($qty == 5) {
                                                                                                if($percent > 0) {
                                                                                                    $percent_cache = $percent;
                                                                                                    $sub_amount = $real_amount * 5;
                                                                                                    $total_amount = $sub_amount - ($sub_amount * (float)$dis->percent);
                                                                                                }
                                                                                                else {
                                                                                                    $sub_amount = $real_amount * 5;
                                                                                                    $total_amount = $sub_amount - ($sub_amount * $percent_cache);
                                                                                                }
                                                                                            }
                                                                                        ?>
                                                                                        <td style = "padding: 5px; text-align: right;">{{ number_format($total_amount, 2, '.', ',') }}</td>
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
            var orig_amount = (parseFloat(origin_amount) * parseFloat(value))/100;
            var new_amount = parseFloat(origin_amount) - orig_amount;
            $('#2x_amount').val(new_amount);
        });

        $('#3x_per').on('keyup', function(){
            var origin_amount = $('#original_amount').val();
            var value = $(this).val();
            var orig_amount = (parseFloat(origin_amount) * parseFloat(value))/100;
            var new_amount = parseFloat(origin_amount) - orig_amount;
            $('#3x_amount').val(new_amount);
        });

        $('#4x_per').on('keyup', function(){
            var origin_amount = $('#original_amount').val();
            var value = $(this).val();
            var orig_amount = (parseFloat(origin_amount) * parseFloat(value))/100;
            var new_amount = parseFloat(origin_amount) - orig_amount;
            $('#4x_amount').val(new_amount);
        });

        $('#5x_per').on('keyup', function(){
            var origin_amount = $('#original_amount').val();
            var value = $(this).val();
            var orig_amount = (parseFloat(origin_amount) * parseFloat(value))/100;
            var new_amount = parseFloat(origin_amount) - orig_amount;
            $('#5x_amount').val(new_amount);
        });

        $('.delete_ad').on('click', function() {
            var ad_uid = $(this).attr("data-target");
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
                delete_ad_confirm(ad_uid);
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

        $("#btn_discount_issue").click(function(){

            var d_2 = $("#discount_2").val();
            var d_3 = $("#discount_3").val();
            var d_4 = $("#discount_4").val();
            var d_5 = $("#discount_5").val();

            if(d_2 == ""){ d_2 = 0;}
            if(d_3 == ""){ d_3 = 0;}
            if(d_4 == ""){ d_4 = 0;}
            if(d_5 == ""){ d_5 = 0;}

            console.log({{ $mag_uid }});
            console.log(d_2);
            console.log(d_3);
            console.log(d_4);
            console.log(d_5);

            $.ajax({
                url: "/magazine/add-issue-discount/" + {{ $mag_uid }} + "/" + d_2 + "/" + d_3 + "/" + d_4 + "/" + d_5,
                dataType: "text",
                beforeSend: function(){},
                success: function(data){
                    var json = $.parseJSON(data);
                    if(json.status == 200)
                    {
                        swal(
                            '',
                            'Add Successful',
                            'success'
                        ).then(
                                function () {
                                    location.reload();
                                }
                        )
                    }
                }
            });
        });
    });

    populate_discount_issue({{ $mag_uid }});
    function populate_discount_issue(mag_uid){
        var m_uid = mag_uid;
        $.ajax({
            url: "/magazine/get-discount-issue/" + m_uid,
            dataType: "text",
            beforeSend: function(){},
            success: function(data){
                var json = $.parseJSON(data);

                if(json.status == 200)
                {
                    $(json.result).each(function(i, tran){
                        console.log(tran.type);
                        if(tran.type == 2){
                            $('#discount_2').val(tran.percent);
                        }
                        if(tran.type == 3){
                            $('#discount_3').val(tran.percent);
                        }
                        if(tran.type == 4){
                            $('#discount_4').val(tran.percent);
                        }
                        if(tran.type == 5){
                            $('#discount_5').val(tran.percent);
                        }
                    });
                }
            }
        });
    }

    function delete_ad_confirm(ad_uid){
        var url = "/magazine/ad/delete/" + ad_uid;
        $(document).ready( function() {
            $.ajax({
                url: url,
                dataType: "text",
                beforeSend: function () {
                },
                success: function(data) {
                    var json = $.parseJSON(data);
                    if(json.status == 404)
                    {
                        swal(
                                'Oops...',
                                'Delete Failed!',
                                'error'
                        )
                        return false;
                    }else if(json.status == 202)
                    {
                        swal(
                                '',
                                'Delete Successful!',
                                'success'
                        ).then(
                            function () {
                                location.reload();
                            }
                        )
                    }
                }
            });
        } );
    }
</script>
<script>
    $('#btn_submit').on('click',function(){
        var ad_color = $("#ad_color").val();
        var ad_size = $("#ad_size").val();
        var original_amount = $("#original_amount").val();
        if(ad_color == ""){
            swal(
                    'Oops...',
                    'Ad Color is required!',
                    'warning'
            )
            return false;
        }
        if(ad_size == ""){
            swal(
                    'Oops...',
                    'Ad Size is required!',
                    'warning'
            )
            return false;
        }
        if(original_amount == ""){
            swal(
                    'Oops...',
                    'Ad Amount is required!',
                    'warning'
            )
            return false;
        }
        if(isNaN(original_amount)){
            swal(
                    'Oops...',
                    'Ad Amount should be a numbers!',
                    'warning'
            )
            return false;
        }
    });

</script>
@endsection