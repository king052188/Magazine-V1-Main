@extends('layout.magazine_main')

@section('title')
    Add New Magazine
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{  asset('css/plugins/steps/jquery.steps.css')  }}">
    <link href="{{  asset('css/plugins/chosen/chosen.css')  }}" rel="stylesheet">
@endsection

@section('magazine_content')

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="container">
            <div class="row setup-content" id="step-1">
                <div class="col-xs-12" style = "margin-top: 200px;">
                    <div class="col-md-5 well white-bg" style = "margin-right: 5px; text-align: center; font-size: 25px;">
                        <a href = "/booking/add-booking">PRINT</a>
                    </div>
                    <div class="col-md-5 well white-bg" style = "margin-left: 5px; text-align: center; font-size: 25px;">
                        <a href = "/booking/digital/add-booking">DIGITAL</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')


@endsection