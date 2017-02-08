<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>CRM Login | Lester Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="{{ asset('css/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link class="main-stylesheet" href="{{ asset('css/vmk.css') }}" rel="stylesheet" type="text/css" />
    <!--[if lte IE 9]>
        <link href="pages/css/ie9.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <script type="text/javascript">
    window.onload = function()
    {
      // fix for windows 8
      if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
        document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/pace/windows.chrome.fix.css') }}" />'
    }
    </script>
  </head>
  <body class="fixed-header ">
    <div class="login-wrapper ">
      <!-- START Login Background Pic Wrapper-->
      <div class="bg-pic">
        <!-- START Background Pic-->
        <img src="{{ asset('img/bg.png') }}" data-src="{{ asset('img/bg.png') }}" data-src-retina="{{ asset('img/bg.png') }}" alt="" class="lazy">
        <!-- END Background Pic-->
        <!-- START Background Caption-->
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
          <h2 class="semi-bold text-white"></h2>
          <p class="small" style="color: #1a1a1a;">
            &copy {{ date("Y") }} | <a href="/ph/developers">Developers</a>
          </p>
        </div>
        <!-- END Background Caption-->
      </div>
      <!-- END Login Background Pic Wrapper-->
      <!-- START Login Right Container-->
      <div class="login-container bg-white">
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
          <img src="{{ asset('img/lester_logo.png') }}" alt="logo" data-src="{{ asset('img/lester_logo.png') }}" data-src-retina="{{ asset('img/lester_logo.png') }}">
          <p class="p-t-35">Sign into your account</p>
          <!-- START Login Form -->
          <form id="form-login" class="p-t-15" role="form" action="index.html">
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>Login</label>
              <div class="controls">
                <input type="text" name="username" id="username" placeholder="Enter your username" class="form-control" required>
              </div>
            </div>
            <!-- END Form Control-->
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>Password</label>
              <div class="controls">
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password." required>
              </div>
            </div>
            <!-- START Form Control-->
            <div class="row">
              <div class="col-md-6 no-padding">
                <div class="checkbox ">
                  {{--<input type="checkbox" value="1" id="checkbox1">--}}
                  {{--<label for="checkbox1">Keep Me Signed in</label>--}}
                  <a href="#" class="text-info small">Forgot Password?</a>
                </div>
              </div>
              <div class="col-md-6 text-right">
                <input type="submit" class="btn btn-primary btn-cons m-t-10" name="login" value="Login" id="login_button" tabindex="3" >
              </div>
            </div> 
            <!-- END Form Control-->

          </form>
          <!--END Login Form-->
          
        </div>
      </div>
      <!-- END Login Right Container-->
    </div>

    <!-- BEGIN VENDOR JS -->
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery-2.1.1.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/modernizr.custom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <!-- END VENDOR JS -->
    <script src="{{ asset('js/plugins/cookie/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/login.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/vmk.js') }}"></script>
    <script>
    $(function()
    {
      $('#form-login').validate()
    })
    </script>
  </body>
</html>



{{-- <!DOCTYPE html>
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

</html> --}}