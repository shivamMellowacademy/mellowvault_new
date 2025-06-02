<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Register for Mellow Elements - Join our professional community">
    <meta name="keywords" content="register, account, signup, developer, freelancer">
    <meta name="author" content="Mellow Elements">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Join Our Developer Community - Mellow Elements</title>
    
    <link rel="icon" href="{{ URL::asset('public/front/assets/images/Logo-01.png') }}">

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{URL::asset('public/developer/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/asset/css/style.css')}}" rel="stylesheet">
    
</head>
<body>
    <div class="auth-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="auth-card">
                        <div class="row g-0">
                            <!-- Left Side - Registration Form -->
                            <div class="col-lg-7 auth-form-side">
                                <div class="logo-container">
                                    <a href="{{ route('index') }}">
                                        <img src="{{ URL::asset('public/front/assets/images/Logo-01.png') }}" alt="Mellow Elements" class="logo-img">
                                    </a>
                                </div>
                                
                                <h1 class="auth-heading">Join Our Developer Network</h1>
                                
                                @if(Session::has('errmsg'))
                                    <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
                                        <i class="fa fa-exclamation-circle me-2"></i>
                                        <strong>{{ Session::pull('errmsg') }}</strong>
                                    </div>
                                @endif
                                
                                <form method="post" action="{{ route('submit_developer_registration') }}" id="registrationForm">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="pro_id" class="form-label">I want to join as a:</label>
                                        <select name="pro_id" id="pro_id" class="form-select w-100" required>
                                            <option value="" disabled selected>Select your professional role</option>
                                            @foreach($higher_professional as $c)
                                                <option value="{{ $c->id }}" {{ old('pro_id') == $c->id ? 'selected' : '' }}>
                                                    {{ $c->heading }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('pro_id'))
                                            <strong class="text-danger">
                                                <i class="fa fa-exclamation-circle me-1"></i>
                                                {{ $errors->first('pro_id') }}
                                            </strong>
                                        @endif
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name" class="form-label">First Name</label>
                                                <input type="text" class="form-control" name="name" id="name" 
                                                    placeholder="John" value="{{ old('name') }}" required>
                                                @if ($errors->has('name'))
                                                    <strong class="text-danger">
                                                        <i class="fa fa-exclamation-circle me-1"></i>
                                                        {{ $errors->first('name') }}
                                                    </strong>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="last_name" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" name="last_name" id="last_name" 
                                                    placeholder="Doe" value="{{ old('last_name') }}" required>
                                                @if ($errors->has('last_name'))
                                                    <strong class="text-danger">
                                                        <i class="fa fa-exclamation-circle me-1"></i>
                                                        {{ $errors->first('last_name') }}
                                                    </strong>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <div class="input-group">
                                            <span class="input-group-text">+91</span>
                                            <input type="tel" class="form-control form-control-with-icon" name="phone" id="phone" 
                                                placeholder="9876543210" maxlength="10" value="{{ old('phone') }}" required>
                                        </div>
                                        @if ($errors->has('phone'))
                                            <strong class="text-danger">
                                                <i class="fa fa-exclamation-circle me-1"></i>
                                                {{ $errors->first('phone') }}
                                            </strong>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email" id="email" 
                                            placeholder="your@email.com" value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                            <strong class="text-danger">
                                                <i class="fa fa-exclamation-circle me-1"></i>
                                                {{ $errors->first('email') }}
                                            </strong>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" 
                                            placeholder="Create a strong password" required>
                                        <span class="password-toggle" onclick="togglePassword('password')">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                        <div class="progress-container mt-2">
                                            <div class="progress-bar" id="passwordStrength"></div>
                                        </div>
                                        <div class="password-strength" id="passwordStrengthText">Password strength</div>
                                        @if ($errors->has('password'))
                                            <strong class="text-danger">
                                                <i class="fa fa-exclamation-circle me-1"></i>
                                                {{ $errors->first('password') }}
                                            </strong>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group form-check mt-4">
                                        <input type="checkbox" class="form-check-input" id="termsCheck" required>
                                        <label class="form-check-label" for="termsCheck">
                                            I agree to the <a href="{{ url('term') }}" target="_blank">Terms of Service</a> and <a href="{{ url('privacy') }}" target="_blank">Privacy Policy</a>
                                        </label>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary btn-register btn-block mt-3">
                                        <i class="fa fa-user-plus me-2"></i> Create My Account
                                    </button>
                                    
                                    <div class="auth-footer mt-4">
                                        Already have an account? <a href="{{ route('developer_admin') }}">Sign in here</a>
                                    </div>
                                </form>
                            </div>
                            
                            <!-- Right Side - Features -->
                            <div class="col-lg-5 auth-feature-side">
                                <h2 class="feature-heading">Why Join Mellow Elements?</h2>
                                
                                <ul class="feature-list">
                                    <li class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fa fa-briefcase"></i>
                                        </div>
                                        <div class="feature-content">
                                            <h4>Quality Projects</h4>
                                            <p>Access to premium projects that match your skills and expertise level.</p>
                                        </div>
                                    </li>
                                    
                                    <li class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fa fa-chart-line"></i>
                                        </div>
                                        <div class="feature-content">
                                            <h4>Career Growth</h4>
                                            <p>Resources and mentorship to help you advance in your professional journey.</p>
                                        </div>
                                    </li>
                                    
                                    <li class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="feature-content">
                                            <h4>Community Support</h4>
                                            <p>Connect with a network of professionals and industry experts.</p>
                                        </div>
                                    </li>
                                    
                                    <li class="feature-item">
                                        <div class="feature-icon">
                                            <i class="fa fa-clock"></i>
                                        </div>
                                        <div class="feature-content">
                                            <h4>Flexible Work</h4>
                                            <p>Choose projects that fit your schedule and work preferences.</p>
                                        </div>
                                    </li>
                                </ul>
                                
                                <div class="mt-auto pt-4">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-shield-alt fa-2x me-3"></i>
                                        <div>
                                            <h5 class="mb-1">Secure Platform</h5>
                                            <p class="small opacity-75 mb-0">Your data is protected with enterprise-grade security</p>
                                        </div>
                                    </div>
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
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');
            
            if (field.type === "password") {
                field.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
        
        // Format phone number input
        document.getElementById('phone').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        
        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('passwordStrengthText');
            
            // Reset
            strengthBar.style.width = '0%';
            strengthBar.style.backgroundColor = '#ef233c';
            strengthText.textContent = 'Password strength';
            
            if (password.length === 0) return;
            
            // Calculate strength
            let strength = 0;
            
            // Length check
            if (password.length > 7) strength += 25;
            if (password.length > 11) strength += 25;
            
            // Complexity checks
            if (/[A-Z]/.test(password)) strength += 15;
            if (/[0-9]/.test(password)) strength += 15;
            if (/[^A-Za-z0-9]/.test(password)) strength += 20;
            
            // Update UI
            strengthBar.style.width = strength + '%';
            console.log(strength)
            if (strength < 40) {
                strengthBar.style.backgroundColor = '#ef233c';
                strengthText.textContent = 'Weak password';
                strengthText.style.color = '#ef233c';
            } else if (strength < 60) {
                strengthBar.style.backgroundColor = '#ff9e00';
                strengthText.textContent = 'Moderate password';
                strengthText.style.color = '#ff9e00';
            } else if (strength < 61) {
                strengthBar.style.backgroundColor = '#38b000';
                strengthText.textContent = 'Strong password';
                strengthText.style.color = '#38b000';
            }
        });
        
        // Form submission handler
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            const termsCheck = document.getElementById('termsCheck');
            if (!termsCheck.checked) {
                e.preventDefault();
                alert('Please agree to the Terms of Service and Privacy Policy');
                termsCheck.focus();
            }
        });
    </script>
</body>
</html>