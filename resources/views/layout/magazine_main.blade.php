<?php
    $report_api = \App\Http\Controllers\AssemblyClass::get_reports_api();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        var report_url_api          = "{{ $report_api["Url_Port"] }}";
        var Url_Client_Dashboard    = "{{ $report_api["Url_Client_Dashboard"] }}";
        var Url_Insertion_Order     = "{{ $report_api["Url_Insertion_Order"] }}";
        var Url_Logo_Uploader       = "{{ $report_api["Url_Logo_Uploader"] }}";
    </script>
    <title>Magazine | @yield('title')</title>
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ asset('css/animate.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/checkbox.css') }}">
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">

    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/1.5.6/numeral.min.js"></script>
    @yield('styles')
</head> 

<body>
    <div id="wrapper">
        @include('partials.nav')
        <div id="page-wrapper" class="dark-gray-bg">
            @include('partials.header')
            @yield('magazine_content')
            @include('partials.footer')
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-2.1.1.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js')}}"></script>

    <!-- FooTable -->
    <link href="{{ asset('css/plugins/footable/footable.core.css')}}" rel="stylesheet">
    <script src="{{ asset('js/plugins/footable/footable.all.min.js')}}"></script>
    <!-- FooTable -- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $('.footable').footable();
            $('.footable2').footable();
        });
    </script>
    @yield('scripts')

</body>
</html>
