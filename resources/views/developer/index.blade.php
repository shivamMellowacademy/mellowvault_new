<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mellow Vault - Secure Login">
    <meta name="keywords" content="login, vault, security">
    <meta name="author" content="Mellow Vault">
    <title>Login | Mellow Vault</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ URL::asset('public/front/assets/images/Logo-01.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Round" rel="stylesheet">
    
    <!-- CSS -->
    <link href="{{URL::asset('public/developer/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/developer/assets/plugins/font-awesome/css/all.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/developer/assets/css/custom.css')}}" rel="stylesheet">
     <link href="{{asset('public/asset/css/style.css')}}" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --success-color: #4cc9f0;
            --danger-color: #f72585;
            --warning-color: #f8961e;
        }
        
        body {
            height: 100vh;
            display: flex;
            align-items: center;
        }
        
        
    </style>
</head>
<body>
    <!-- Loading Indicator -->
    <div class='loader'>
        <div class='spinner-grow text-primary' role='status'>
            <span class='sr-only'>Loading...</span>
        </div>
    </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="auth-container">
                    <div class="row no-gutters">
                        <!-- Login Form -->
                        <div class="col-lg-6">
                            <div class="auth-form">
                                <!-- Logo -->
                                <div class="logo-box">
                                    <img src="{{ URL::asset('public/front/assets/images/Logo-01.png') }}" alt="Mellow Vault">
                                </div>
                                
                                <h2 class="form-title auth-heading">Welcome Back</h2>
                                <p class="text-center mb-4">Please sign in to access your account</p>
                                
                                <!-- Error Messages -->
                            @if(session('error'))
                                <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
                                    <i class="fa fa-exclamation-circle me-2"></i>
                                    <strong>{{ session('error') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(session('success'))
                                <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
                                    <i class="fa fa-check-circle me-2"></i>
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                                
                                <!-- Login Form -->
                                <form method="post" action="{{route('login_verification')}}" id="loginForm">
                                    @csrf
                                    
                                    <!-- Email Field -->
                                    <div class="form-group">
                                        <span class="input-icon"><i class="material-icons-round pt-2">mail</i></span>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
                                        @if ($errors->has('email'))
                                            <small class="text-danger">{{ $errors->first('email') }}</small>
                                        @endif
                                    </div>
                                    
                                    <!-- Password Field -->
                                    <div class="form-group">
                                        <span class="input-icon"><i class="material-icons-round pt-2">lock</i></span>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                        @if ($errors->has('password'))
                                            <small class="text-danger">{{ $errors->first('password') }}</small>
                                        @endif
                                    </div>
                                    
                                    <!-- Show Password Toggle -->
                                    <div class="show-password">
                                        <input type="checkbox" id="showPassword" class="mb-2" onclick="togglePassword()">
                                        <label for="showPassword" class="mt-1">Show Password</label>
                                    </div>
                                    
                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary btn-block btn-submit mb-3">
                                        Sign In
                                    </button>
                                    
                                    <!-- Form Footer Links -->
                                    <div class="form-footer">
                                        <a href="{{ route('dvlprFrgtPassForm') }}">Forgot Password?</a>
                                        <a href="{{ route('developer_registration') }}">Create Account</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Right Side Image/Content -->
                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="auth-image">
                                <div class="auth-image-content">
                                    <img src="{{ URL::asset('public/front/assets/images/Logo-01.png') }}" alt="Secure Login">
                                    <h2>Secure Access</h2>
                                    <p class="text-white">Your security is our top priority. All data is encrypted and protected.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Javascripts -->
    <script src="{{ URL::asset('public/developer/assets/plugins/jquery/jquery-3.4.1.min.js')}}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/bootstrap/popper.min.js')}}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    
    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordField = document.getElementById('password');
            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        }
        
        // Form submission loading indicator
        $(document).ready(function() {
            $('#loginForm').on('submit', function() {
                $('.loader').addClass('active');
            });
            
            // Hide loader if it's still visible after 5 seconds
            setTimeout(function() {
                $('.loader').removeClass('active');
            }, 5000);
        });
    </script>
</body>
</html>