<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Mellow Elements</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="{{ URL::asset('public/admin/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/admin/assets/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to right, #f0f4f8, #d9e2ec);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .login-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            min-height: 100vh;
        }

        .login-box {
            background: #fff;
            padding: 40px;
            max-width: 500px;
            width: 100%;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        }

        .login-box .logo {
            display: block;
            margin: 0 auto 30px;
            width: 150px;
        }

        .login-box h4 {
            margin-bottom: 25px;
            font-weight: 600;
            text-align: center;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 15px;
        }

        .btn-submit {
            border-radius: 10px;
            font-weight: 600;
            padding: 10px 0;
        }

        .form-check-label {
            user-select: none;
        }

        .alert {
            font-size: 14px;
        }

        @media (max-width: 576px) {
            .login-box {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-box">
        <img src="{{ URL::asset('public/front/assets/images/Logo-01.png') }}" alt="Logo" class="logo">

        <h4>College Login</h4>

        <!-- Display success message -->
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        <!-- Display error message -->
        @if(Session::has('message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('message') }}</strong>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        <!-- Display login errors -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <strong>{{ $error }}</strong><br>
                @endforeach
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        <form method="post" action="{{ route('college.login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required>
                @if ($errors->has('email'))
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                @endif
            </div>

            <div class="form-group">
                <label for="password">Password <span class="text-danger">*</span></label>
                <input type="password" name="password" id="passwordInput" class="form-control" placeholder="Enter password" required>
                @if ($errors->has('password'))
                    <small class="text-danger">{{ $errors->first('password') }}</small>
                @endif
            </div>

            <div class="form-group form-check mb-3">
                <input type="checkbox" onclick="togglePassword()" class="form-check-input" id="showPass">
                <label class="form-check-label" for="showPass">Show Password</label>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-submit">Sign In</button>
        </form>
    </div>
</div>

<!-- JS -->
<script src="{{ URL::asset('public/admin/assets/plugins/jquery/jquery-3.4.1.min.js')}}"></script>
<script src="{{ URL::asset('public/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script>
    function togglePassword() {
        var x = document.getElementById("passwordInput");
        x.type = x.type === "password" ? "text" : "password";
    }
</script>

</body>
</html>
