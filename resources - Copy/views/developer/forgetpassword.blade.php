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
    <link href="{{asset('public/asset/css/style.css')}}" rel="stylesheet">


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
                         @if(session('success'))
                            <div class="alert alert-success alert-flash">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>{{ session('success') }}</strong>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-flash">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>{{ session('error') }}</strong>
                            </div>
                        @endif
                        
                        <!-- Logo -->
                        <div class="logo-box">
                            <a href="{{ url('/') }}">
                                <img src="{{ URL::asset('public/front/assets/images/Logo-01.png') }}" alt="Mellow Vault">
                            </a>
                        </div>
                        
                        <h1 class="form-title auth-heading">Reset Password</h1>
                        <p class="form-description">Enter your email to receive a password reset link</p>
                        
                        
                        <!-- Reset Form -->
                        <form id="forgot-password-form" method="post" action="{{ route('password.email') }}">
                            @csrf
                            
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" 
                                    placeholder="Email Address *" required>
                                <strong id="email-error" class="text-danger d-block mt-1"></strong>
                            </div>
                            
                            
                            <button type="submit" class="btn btn-primary btn-block btn-submit" id="submitBtn">
                                <span class="btn-text">Send Reset Link</span>
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
                                    <p class="text-white">We prioritize the security of your account and personal information.</p>
                                </div>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Instant Delivery</h4>
                                    <p class="text-white">Password reset links are sent immediately to your registered email.</p>
                                </div>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fa fa-lock"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Secure Process</h4>
                                    <p class="text-white">Our password reset process uses industry-standard encryption.</p>
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
        $('#forgot-password-form').on('submit', function(e) {
            e.preventDefault();
            let email = $('#email').val();
            let token = $('input[name="_token"]').val();
            let emailError = $('#email-error');
            let submitBtn = $('#submitBtn');
            
            // Reset errors
            emailError.text('');
            $('.loader').fadeIn();
            submitBtn.prop('disabled', true);
            submitBtn.find('.btn-text').text('Sending...');
            submitBtn.find('.spinner-border').removeClass('d-none');
            
            $.ajax({
                url: "{{ route('password.email') }}",
                type: "POST",
                data: {
                    email: email,
                    _token: token
                },
                success: function(response) {
                    $('.loader').fadeOut();
                    submitBtn.prop('disabled', false);
                    submitBtn.find('.btn-text').text('Send Reset Link');
                    submitBtn.find('.spinner-border').addClass('d-none');
                    
                    // Show success message
                    showFlash('success', response.message || 
                        'Password reset link has been sent to your email.');
                    
                    // Clear form
                    $('#forgot-password-form')[0].reset();
                },
                error: function(xhr) {
                    $('.loader').fadeOut();
                    submitBtn.prop('disabled', false);
                    submitBtn.find('.btn-text').text('Send Reset Link');
                    submitBtn.find('.spinner-border').addClass('d-none');
                    
                    if (xhr.status === 422 && xhr.responseJSON.errors.email) {
                        emailError.text(xhr.responseJSON.errors.email[0]);
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        showFlash('error', xhr.responseJSON.message);
                    }
                }
            });
        });
        
        function showFlash(type, message) {
            let alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            let flashHtml = `
                <div class="alert ${alertClass} alert-flash">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>${message}</strong>
                </div>
            `;
            
            // Replace any existing flash messages
            $('.alert-flash').remove(); // Remove old messages
            $('.auth-form-side').prepend(flashHtml);
            
            setTimeout(() => {
                $('.alert-flash').remove();
            }, 5000);
        }
    });
    </script>
</body>
</html>