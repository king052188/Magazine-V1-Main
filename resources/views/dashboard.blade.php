@extends('layout.magazine_main')
@section('title', 'Dashboard')

@section('magazine_content')

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">Sample</span>
                        <h5>Sample</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">40 886,200</h1>
                        <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                        <small>Sample</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">Sample</span>
                        <h5>Sample</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">275,800</h1>
                        <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                        <small>Sample</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">Sample</span>
                        <h5>Sample</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">106,120</h1>
                        <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                        <small>Sample</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-danger pull-right">Sample</span>
                        <h5>Sample</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">80,600</h1>
                        <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
                        <small>Sample</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function gcd_more_than_two_numbers(input) {
            if (toString.call(input) !== "[object Array]")
                return  false;
            var len, a, b;
            len = input.length;
            if ( !len ) {
                return null;
            }
            a = input[ 0 ];
            for ( var i = 1; i < len; i++ ) {
                b = input[ i ];
                a = gcd_two_numbers( a, b );
            }
            return a;
        }

        function gcd_two_numbers(x, y) {
            if ((typeof x !== 'number') || (typeof y !== 'number'))
                return false;
            x = Math.abs(x);
            y = Math.abs(y);
            while(y) {
                var t = y;
                y = x % y;
                x = t;
            }
            return x;
        }
        console.log(gcd_more_than_two_numbers([27,9,12]));
        //console.log(gcd_more_than_two_numbers([5,10,15,25]));
    </script>
@endsection