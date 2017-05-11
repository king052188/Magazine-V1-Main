<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-1.12.3.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <script src = "https://cdn.jsdelivr.net/sweetalert2/6.2.1/sweetalert2.min.js"></script>
        <link href = "https://cdn.jsdelivr.net/sweetalert2/6.2.1/sweetalert2.min.css" rel="stylesheet">
        <link href = "https://cdn.jsdelivr.net/sweetalert2/6.2.1/sweetalert2.css" rel="stylesheet">
        <script src = "https://cdn.jsdelivr.net/sweetalert2/6.2.1/sweetalert2.js"></script>

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 80vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .form-control{
                font-color: #000 !important;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Player ID:
                    <div class="input-group add-on flex-center">
                        <input class="form-control col-sm-5" style = "font-family: verdana; font-weight: bold; color: #FFF; background-color: #000;" placeholder="Search" type="text">
                        <div class="input-group-btn">
                            <button class="btn btn-default" id = "go" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </div>

                <div class="links">
                    <a href = "#" id = "details_img" style = "display: none; color: #FF0000; font-size: 20px; font-family: verdana; font-weight: normal; text-align: left;">1 ISSUE FOUND FOR Player ID <b>197258</b></a>
                    <br />
                    <a href = "#" id = "view_img" style = "display: none; color: #FF0000; font-size: 20px; font-family: verdana; font-weight: normal; text-align: left; text-decoration: underline;">click here to view issue</a>
                    <br /><br />
                    <a href = "#" id = "display_img" style = "display: none;"><img src = "//i.imgur.com/ZjMJeRm.jpg"></a>
                </div>
            </div>
        </div>

        <script>
            $(function () {
                $("#go").click(function(){
                    swal({
                        title: "1 Player Found",
                        text: "Fetching all issue... Please Wait...",
                        type: "success"
                    }).then(
                        function() {
                            $("#details_img").fadeIn(2000, function(){
                                $("#view_img").fadeIn(2000);
                            });

                        }
                    )
                });

                $("#view_img").click(function(){
                    $("#display_img").fadeIn(2000);
                });
            });

            function all_issue(){

            }
        </script>
    </body>
</html>


