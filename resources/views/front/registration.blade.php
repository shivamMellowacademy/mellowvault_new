@extends('front.layout')
@section('content')
<style>
.employer-portal {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.portal-hero {
    padding: 5rem 0;
    position: relative;
    overflow: hidden;
}

.portal-hero::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: url('https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center;
    background-size: cover;
    opacity: 0.1;
}

.portal-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transform: translateY(0);
    transition: transform 0.3s ease;
}

.portal-card:hover {
    transform: translateY(-5px);
}

.portal-tabs {
    border-bottom: 1px solid #e9ecef;
    padding: 0 1.5rem;
}

.portal-tabs .nav-link {
    color: #6c757d;
    border: none;
    padding: 1rem 0;
    margin-right: 2rem;
    font-weight: 500;
    position: relative;
}

.portal-tabs .nav-link.active {
    color: #4361ee;
    background: transparent;
}

.portal-tabs .nav-link.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 3px;
    background: #4361ee;
    border-radius: 3px 3px 0 0;
}

.portal-tab-content {
    padding: 2rem;
}

.input-group-text {
    background-color: #f8f9fa;
    border-right: none;
    min-width: 45px;
    justify-content: center;
}

.form-control {
    border-left: none;
    height: 45px;
}

.form-control:focus {
    box-shadow: none;
    border-color: #ced4da;
}

.toggle-password {
    border-left: none;
    background-color: #f8f9fa;
}

.btn-lg {
    padding: 12px;
    font-weight: 500;
    letter-spacing: 0.5px;
}

.portal-features {
    background-color: #f8fafc;
}

.feature-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.feature-icon {
    color: #4361ee;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
}

@media (max-width: 991.98px) {
    .portal-hero {
        text-align: center;
        padding: 3rem 0;
    }
    
    .portal-card {
        margin-top: 2rem;
    }
}
</style>
<div class="employer-portal" style="margin-top: 100px">
     
    <!-- Hero Section -->
    <div class="portal-hero bg-gradient-primary">
        <div class="container">
             @if(session()->has('errmsg'))
        <div class="container mt-4">
            <div class="alert alert-{{ session('message') }} alert-dismissible fade show" role="alert">
                {{ session('errmsg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-left">
                    <h1 class="display-4 text-white mb-3">Find Your Perfect Candidate</h1>
                    <p class="lead text-white mb-4">Join thousands of employers who found their ideal team members through our platform</p>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <div class="mr-3">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-check-circle fa-2x text-success mr-2"></i>
                                <span class="text-white">1M+ Candidates</span>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex align-items-center">
                                <i class="fa fa-check-circle fa-2x text-success mr-2"></i>
                                <span class="text-white">95% Satisfaction</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="portal-card">
                        <!-- Tab Navigation -->
                        <ul class="nav nav-tabs portal-tabs" id="portalTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="register-tab" data-toggle="tab" href="#register" role="tab">
                                    <i class="fa fa-user-plus mr-2"></i> Register
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="login-tab" data-toggle="tab" href="#login" role="tab">
                                    <i class="fa fa-sign-in-alt mr-2"></i> Sign In
                                </a>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content portal-tab-content">
                            <!-- Registration Form -->
                            <div class="tab-pane fade show active" id="register" role="tabpanel">
                                <form method="post" action="{{route('submit_registeration')}}">
                                    @csrf
                                    <!-- Personal Information Section -->
                                    <h5 class="text-muted mb-3"><i class="fa fa-user-circle mr-2"></i> Personal Information</h5>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="fname" placeholder="First Name" value="{{ old('fname') }}">
                                            </div>
                                            @if ($errors->has('fname'))
                                                <small class="text-danger">{{ $errors->first('fname') }}</small>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="lname" placeholder="Last Name" value="{{ old('lname') }}">
                                            </div>
                                            @if ($errors->has('lname'))
                                                <small class="text-danger">{{ $errors->first('lname') }}</small>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-at"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="user_name" placeholder="Username" value="{{ old('user_name') }}">
                                            </div>
                                            @if ($errors->has('user_name'))
                                                <small class="text-danger">{{ $errors->first('user_name') }}</small>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                </div>
                                                <input type="email" class="form-control" name="email" placeholder="Email Address" value="{{ old('email') }}">
                                            </div>
                                            @if ($errors->has('email'))
                                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                </div>
                                                <input type="password" class="form-control" name="password" id="regPassword" placeholder="Create Password">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @if ($errors->has('password'))
                                                <small class="text-danger">{{ $errors->first('password') }}</small>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                                </div>
                                                <input type="tel" class="form-control" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" maxlength="10">
                                            </div>
                                            @if ($errors->has('phone'))
                                                <small class="text-danger">{{ $errors->first('phone') }}</small>
                                            @endif
                                        </div>
                                    </div>

                                        <!-- Company Information Section -->
                                        <h5 class="text-muted mb-3 mt-4"><i class="fa fa-building mr-2"></i> Company Information</h5>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="company_name" placeholder="Company Name" value="{{ old('company_name') }}">
                                            </div>
                                            @if ($errors->has('company_name'))
                                                <small class="text-danger">{{ $errors->first('company_name') }}</small>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-crosshairs"></i></span>
                                                </div>
                                                <select name="purpose" class="form-control">
                                                    <option value="">Select Purpose</option>
                                                    <option value="For Myself" {{ old('purpose') == 'For Myself' ? 'selected' : '' }}>For Myself</option>
                                                    <option value="For Organization" {{ old('purpose') == 'For Organization' ? 'selected' : '' }}>For Organization</option>
                                                    <option value="For Designer" {{ old('purpose') == 'For Designer' ? 'selected' : '' }}>For Designer</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('purpose'))
                                                <small class="text-danger">{{ $errors->first('purpose') }}</small>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="location" placeholder="Location" value="{{ old('location') }}">
                                            </div>
                                            @if ($errors->has('location'))
                                                <small class="text-danger">{{ $errors->first('location') }}</small>
                                            @endif
                                        </div>
                                    

                                        <div class="form-group col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-home"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="address" placeholder="Company Address" value="{{ old('address') }}">
                                            </div>
                                            @if ($errors->has('address'))
                                                <small class="text-danger">{{ $errors->first('address') }}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group form-check mt-4">
                                        <input type="checkbox" class="" id="termsCheck" required>
                                        <label class="form-check-label text-dark" for="termsCheck">
                                            I agree to the <a href="#" target="_blank">Terms of Service</a> and <a href="#" target="_blank">Privacy Policy</a>
                                        </label>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block btn-lg mt-4">
                                        <i class="fa fa-user-plus mr-2"></i> Create Account
                                    </button>

                                    <div class="text-center mt-3">
                                        <p class="text-muted">Already have an account? <a href="#" class="text-primary switch-to-login">Sign In</a></p>
                                    </div>
                                </form>
                            </div>

                            <!-- Login Form -->
                            <div class="tab-pane fade" id="login" role="tabpanel">
                                <form method="post" action="{{route('verify_login')}}">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="email_login" placeholder="Email" value="{{ old('email_login') }}">
                                        </div>
                                        @if ($errors->has('email_login'))
                                            <small class="text-danger">{{ $errors->first('email_login') }}</small>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control" name="password_login" id="loginPassword" placeholder="password_login">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @if ($errors->has('password_login'))
                                            <small class="text-danger">{{ $errors->first('password_login') }}</small>
                                        @endif
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="" id="rememberMe">
                                            <label class="form-check-label text-dark" for="rememberMe">Remember me</label>
                                        </div>
                                        <a href="{{route('forgetpassword')}}" class="text-primary">Forgot password?</a>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                                        <i class="fa fa-sign-in-alt mr-2"></i> Sign In
                                    </button>

                                    <div class="text-center mt-3">
                                        <p class="text-muted">New to our platform? <a href="#" class="text-primary switch-to-register">Create Account</a></p>
                                        <a href="{{route('developer_registration')}}" target="_blank" class="btn btn-outline-secondary btn-sm mt-2">
                                            <i class="fa fa-users mr-2"></i> Resource Center
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="portal-features py-5">
        <div class="container">
            <h2 class="text-center mb-5">Why Employers Choose Us</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon mb-3">
                            <i class="fa fa-bullseye fa-3x text-primary"></i>
                        </div>
                        <h4 class="text-dark">Targeted Matching</h4>
                        <p class="text-dark">Our AI matches you with candidates who perfectly fit your requirements and company culture.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon mb-3">
                            <i class="fa fa-line-chart fa-3x text-primary"></i>
                        </div>
                        <h4 class="text-dark">Advanced Analytics</h4>
                        <p class="text-dark">Get detailed insights into candidate performance and hiring trends.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon mb-3">
                            <i class="fa fa-headphones fa-3x text-primary"></i>
                        </div>
                        <h4 class="text-dark">Dedicated Support</h4>
                        <p class="text-dark">Our team is available 24/7 to help you find and hire the best talent.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
$(document).ready(function() {
    // Toggle password visibility
    $('.toggle-password').click(function() {
        const input = $(this).closest('.input-group').find('input');
        const icon = $(this).find('i');
        
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Switch between login and register tabs
    $('.switch-to-login').click(function(e) {
        e.preventDefault();
        $('#register-tab').removeClass('active');
        $('#login-tab').addClass('active');
        $('#register').removeClass('show active');
        $('#login').addClass('show active');
    });

    $('.switch-to-register').click(function(e) {
        e.preventDefault();
        $('#login-tab').removeClass('active');
        $('#register-tab').addClass('active');
        $('#login').removeClass('show active');
        $('#register').addClass('show active');
    });

    
});
</script>

@endsection