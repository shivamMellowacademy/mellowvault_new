<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="stacks">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Title -->
        <title>Please Login Here - Mellow Elements</title>
        
        <link rel="icon" href="{{ URL::asset('public/front/assets/images/Logo-01.png') }}">

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
        <link href="{{URL::asset('public/admin/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('public/admin/assets/plugins/font-awesome/css/all.min.css')}}" rel="stylesheet">

      
        <!-- Theme Styles -->
        <link href="{{URL::asset('public/admin/assets/css/connect.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('public/admin/assets/css/admin2.css')}}" rel="stylesheet">
        <link href="{{URL::asset('public/admin/assets/css/dark_theme.css')}}" rel="stylesheet">
        <link href="{{URL::asset('public/admin/assets/css/custom.css')}}" rel="stylesheet">

    </head>
    <body class="auth-page sign-in">
        
        <div class='loader'>
            <div class='spinner-grow text-primary' role='status'>
                <span class='sr-only'>Loading...</span>
            </div>
        </div>
        <div class="connect-container align-content-stretch d-flex flex-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5">

                        <div class="auth-form">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-lg-8 ml-auto mr-auto">
                                            @if(Session::has('errmsg'))                 
                                            <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                                <strong>{{Session::get('errmsg')}}</strong>
                                            </div>
                                            {{Session::forget('message')}}
                                            {{Session::forget('errmsg')}}
                                            @endif
                                            <br><br>
                                        </div>
                                    </div>
                                    <div class="logo-box"><a href="#" class="logo-text"><img src="{{ URL::asset('public/front/assets/images/Logo-01.png') }}" alt=""  width="150" height="95"/></a></div>

                                    <form method="post" action="{{route('client_login')}}">
                                        @csrf
                                        <div class="form-group">
                                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Email Address">
                                            @if ($errors->has('email'))
                                                <strong class="text-danger">{{ $errors->first('email') }}</strong>                                  
                                            @endif                                        
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" id="myInput" placeholder="Password">
                                            @if ($errors->has('password'))
                                                <strong class="text-danger">{{ $errors->first('password') }}</strong>                                  
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" onclick="myFunction()"> Show Password
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block btn-submit">Sign In</button>
                                        
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block d-xl-block">
                        <div class="auth-image"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Javascripts -->
        <script src="{{ URL::asset('public/admin/assets/plugins/jquery/jquery-3.4.1.min.js')}}"></script>
        <script src="{{ URL::asset('public/admin/assets/plugins/bootstrap/popper.min.js')}}"></script>
        <script src="{{ URL::asset('public/admin/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{ URL::asset('public/admin/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{ URL::asset('public/admin/assets/js/connect.min.js')}}"></script>

        <script type="text/javascript">
            function myFunction() {
              var x = document.getElementById("myInput");
              if (x.type === "password") {
                x.type = "text";
              } else {
                x.type = "password";
              }
            }
        </script>
        
    </body>
</html>