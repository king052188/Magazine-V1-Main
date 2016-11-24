<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Magazine v1 | Login</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <h3>Welcome to (Company Name or Logo)</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>Login in. To see it in action.</p>
                <div class="form-group">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required="">
                    <div id="chk_username"></div>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
                    <div id="chk_password"></div>
                </div>
                <input type="submit" class="btn btn-primary block full-width m-b" name="login" value="Log In" id="login_button" tabindex="3" >
                <div id="chk_login"></div>


                <a href="#"><small>Forgot password?</small></a>
 
            <p class="m-t"> <small>VMK Developers &copy; 2016</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-3.0.0.js') }}"></script>
    <script src="{{ asset('js/plugins/cookie/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/login.js') }}" type="text/javascript"></script>
</body>

</html>