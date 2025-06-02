<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password | Mellow Vault</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ URL::asset('public/front/assets/images/Logo-01.png') }}">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- CSS -->
    <link href="{{ URL::asset('public/developer/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4bb543;
            --error-color: #ff3333;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fb;
            color: #333;
        }
        
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .auth-wrapper {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            background: white;
        }
        
        .auth-form-side {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }
        
        .auth-feature-side {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 3rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .logo-box {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .logo-box img {
            max-width: 180px;
            height: auto;
        }
        
        .form-title {
            font-weight: 600;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }
        
        .form-description {
            color: #6c757d;
            margin-bottom: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-control {
            height: 50px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            padding: 0.5rem 1rem;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            height: 50px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .form-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #6c757d;
        }
        
        .form-footer a {
            color: var(--primary-color);
            font-weight: 500;
        }
        
        .feature-heading {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 2rem;
        }
        
        .feature-list {
            margin-top: 2rem;
        }
        
        .feature-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2rem;
        }
        
        .feature-icon {
            background-color: rgba(255, 255, 255, 0.1);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }
        
        .feature-icon i {
            font-size: 1.25rem;
        }
        
        .feature-content h4 {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            display: none;
        }
        
        .password-strength {
            height: 5px;
            background: #e9ecef;
            margin-top: 5px;
            border-radius: 3px;
            overflow: hidden;
        }
        
        .strength-meter {
            height: 100%;
            width: 0;
            transition: width 0.3s;
        }
        
        .password-hint {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 5px;
        }
        
        @media (max-width: 991.98px) {
            .auth-wrapper {
                max-width: 100%;
                border-radius: 0;
            }
            
            .auth-feature-side {
                display: none;
            }
            
            .auth-form-side {
                padding: 2rem;
            }
        }
    </style>
</head>

<body class="auth-page">
    <!-- Loader -->
    <div class='loader'>
        <div class='spinner-border text-primary' role='status'>
            <span class='sr-only'>Loading...</span>
        </div>
    </div>

    <div class="auth-wrapper">
        <div class="auth-container">
            <div class="row no-gutters">
                <!-- Form Section -->
                <div class="col-lg-6">
                    <div class="auth-form-side">
                        <!-- Flash Messages -->
                        <div id="flash-messages">
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>{{ session('success') }}</strong>
                            </div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>{{ session('error') }}</strong>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Logo -->
                        <div class="logo-box">
                            <a href="{{ url('/') }}">
                                <img src="{{ URL::asset('public/front/assets/images/Logo-01.png') }}" alt="Mellow Vault">
                            </a>
                        </div>
                        
                        <h1 class="form-title">Reset Password</h1>
                        <p class="form-description">Create a new password for your account</p>
                        
                        <!-- Reset Form -->
                        <form id="reset-password-form" method="post" action="{{ route('password.new.set') }}">
                            @csrf
                            
                            <!-- Hidden Inputs -->
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            
                            <!-- New Password -->
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="password" 
                                    placeholder="New Password *" required>
                                <div class="password-strength">
                                    <div class="strength-meter" id="strength-meter"></div>
                                </div>
                                <div class="password-hint">Use 6 or more characters with a mix of letters, numbers & symbols</div>
                                <strong id="password-error" class="text-danger d-block mt-1"></strong>
                            </div>
                            
                            <!-- Confirm Password -->
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation" 
                                    id="password_confirmation" placeholder="Confirm New Password *" required>
                                <strong id="password-confirmation-error" class="text-danger d-block mt-1"></strong>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block btn-submit" id="submitBtn">
                                <span class="btn-text">Reset Password</span>
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                            
                            <div class="form-footer">
                                Remember your password? <a href="{{ route('developer_admin') }}">Sign In</a>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Feature Section -->
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="auth-feature-side">
                        <h2 class="feature-heading">Secure Your Account</h2>
                        
                        <div class="feature-list">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fa fa-shield-alt"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Account Security</h4>
                                    <p>We prioritize the security of your account and personal information.</p>
                                </div>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fa fa-lock"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Strong Encryption</h4>
                                    <p>Your password is encrypted using industry-standard protocols.</p>
                                </div>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fa fa-user-shield"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Privacy Protection</h4>
                                    <p>We never share your personal data with third parties.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ URL::asset('public/developer/assets/plugins/jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ URL::asset('public/developer/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <script>
    $(document).ready(function() {
        // Password strength indicator
        $('#password').on('input', function() {
            let password = $(this).val();
            let strength = 0;
            
            // Length check
            if (password.length >= 6) strength += 1;
            if (password.length >= 8) strength += 1;
            
            // Character variety
            if (password.match(/[a-z]/)) strength += 1;
            if (password.match(/[A-Z]/)) strength += 1;
            if (password.match(/[0-9]/)) strength += 1;
            if (password.match(/[^a-zA-Z0-9]/)) strength += 1;
            
            // Update strength meter
            let width = 0;
            let color = '#ff0000';
            
            if (strength <= 2) {
                width = 33;
                color = '#ff3333'; // Weak
            } else if (strength <= 4) {
                width = 66;
                color = '#ffcc00'; // Medium
            } else {
                width = 100;
                color = '#4bb543'; // Strong
            }
            
            $('#strength-meter').css({
                'width': width + '%',
                'background-color': color
            });
        });
        
        // Form validation
        $('#reset-password-form').on('submit', function(e) {
            e.preventDefault();
            let password = $('#password').val();
            let confirmPassword = $('#password_confirmation').val();
            let passwordError = $('#password-error');
            let confirmError = $('#password-confirmation-error');
            let isValid = true;
            
            // Reset errors
            passwordError.text('');
            confirmError.text('');
            
            // Validate password
            if (!password) {
                passwordError.text('Please enter a new password');
                isValid = false;
            } else if (password.length < 6) {
                passwordError.text('Password must be at least 6 characters');
                isValid = false;
            }
            
            // Validate confirmation
            if (!confirmPassword) {
                confirmError.text('Please confirm your password');
                isValid = false;
            } else if (password !== confirmPassword) {
                confirmError.text('Passwords do not match');
                isValid = false;
            }
            
            if (isValid) {
                $('.loader').fadeIn();
                $('#submitBtn').prop('disabled', true);
                $('#submitBtn .btn-text').text('Processing...');
                $('#submitBtn .spinner-border').removeClass('d-none');
                
                // Submit the form
                this.submit();
            }
        });
        
        // Auto-dismiss alerts after 5 seconds
        setTimeout(() => {
            $('.alert').fadeOut('slow');
        }, 5000);
    });
    </script>
</body>
</html>