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
    <title>Please Login Here - Mellow Vault</title>

    <link rel="icon" href="{{ URL::asset('public/front/assets/images/Logo-01.png') }}">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="{{URL::asset('public/developer/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/developer/assets/plugins/font-awesome/css/all.min.css')}}" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="{{URL::asset('public/developer/assets/css/connect.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/developer/assets/css/admin2.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/developer/assets/css/dark_theme.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/developer/assets/css/custom.css')}}" rel="stylesheet">

    <!-- JavaScript -->
    <script>
    function validateForm() {
        var email = document.getElementById("email").value;
        var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        var emailError = document.getElementById("email-error");

        // Clear any previous error messages
        emailError.textContent = '';

        if (!email) {
            emailError.textContent = "Email address is required.";
            return false;
        }

        if (!emailRegex.test(email)) {
            emailError.textContent = "Please enter a valid email address.";
            return false;
        }

        // If the form is valid, it will submit automatically
        return true;
    }
    </script>
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
                                        @if(session('success'))
                                        <div id="flash-message"
                                            class="alert alert-success alert-dismissible fade show position-fixed"
                                            style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong>{{ session('success') }}</strong>
                                        </div>
                                        @endif

                                        @if(session('error'))
                                        <div id="flash-message"
                                            class="alert alert-danger alert-dismissible fade show position-fixed"
                                            style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong>{{ session('error') }}</strong>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="logo-box"><a href="#" class="logo-text"><img
                                            src="{{ URL::asset('public/front/assets/images/Logo-01.png') }}" alt=""
                                            width="150" height="95" /></a></div>

                                <form method="post" action="{{ route('password.new.set') }}"
                                    onsubmit="return validateForm()">
                                    @csrf

                                    <!-- Hidden Inputs -->
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <input type="hidden" name="email" value="{{ $email }}">

                                    <!-- New Password -->
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="New Password *">
                                        <strong id="password-error" class="text-danger"></strong>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password_confirmation"
                                            id="password_confirmation" placeholder="Confirm New Password *">
                                        <strong id="password-confirmation-error" class="text-danger"></strong>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block btn-submit">Reset
                                        Password</button>
                                    <a href="{{ route('developer_admin') }}"><span>Sign In</span></a>
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
    <script src="{{ URL::asset('public/developer/assets/plugins/jquery/jquery-3.4.1.min.js')}}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/bootstrap/popper.min.js')}}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}">
    </script>
    <script src="{{ URL::asset('public/developer/assets/js/connect.min.js')}}"></script>
</body>
<script>
function validateForm() {
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("password_confirmation").value;

    // Clear previous errors
    document.getElementById("password-error").textContent = '';
    document.getElementById("password-confirmation-error").textContent = '';

    let isValid = true;

    if (!password) {
        document.getElementById("password-error").textContent = "Please enter your new password.";
        isValid = false;
    } else if (password.length < 6) {
        document.getElementById("password-error").textContent = "Password should be at least 6 characters.";
        isValid = false;
    }

    if (!confirmPassword) {
        document.getElementById("password-confirmation-error").textContent = "Please confirm your password.";
        isValid = false;
    } else if (password !== confirmPassword) {
        document.getElementById("password-confirmation-error").textContent = "Passwords do not match.";
        isValid = false;
    }

    return isValid;
}

// msg disapear 
setTimeout(() => {
        $('.alert').fadeOut('slow');
    }, 3000);
</script>

</html>