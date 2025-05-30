@extends('front.layout')
@section('content')
       
<section class="login-section bg-light py-5" style="margin-top: 100px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <!-- Alert Messages -->
                 @if(Session::has('errmsg'))                 
                <div class="alert alert-{{Session::get('message')}} alert-dismissible fade show" role="alert">
                    <strong>{{Session::get('errmsg')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{Session::forget('message')}}
                {{Session::forget('errmsg')}}
                @endif
                
                <!-- Login Card -->
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h2 class="font-weight-bold text-primary">Welcome Back</h2>
                            <p class="text-muted">Sign in to access your account</p>
                        </div>
                        
                        <form method="post" action="{{route('verify_login')}}">
                            @csrf
                            <div class="form-group">
                                <label for="phone" class="font-weight-bold text-dark">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white">
                                            <i class="fa fa-user text-muted"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" name="email_login" 
                                           placeholder="Enter your email">
                                </div>
                                @if ($errors->has('email_login'))
                                    <small class="text-danger">{{ $errors->first('email_login') }}</small>                                   
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="password" class="font-weight-bold text-dark">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white">
                                            <i class="fa fa-lock text-muted"></i>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" 
                                           id="passwordInput" name="password_login" placeholder="Enter your password">
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
                            
                            <div class="form-group d-flex justify-content-between align-items-center">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="rememberMe">
                                    <label class="custom-control-label text-dark" for="rememberMe">Remember me</label>
                                </div>
                                <a href="{{route('forgetpassword')}}" class="text-dark">Forgot password?</a>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block btn-lg mt-4">
                                <i class="fa fa-sign-in mr-2"></i> Sign In
                            </button>
                            
                            <div class="text-center mt-4">
                                <p class="text-muted">Don't have an account? 
                                    <a href="{{url('registration')}}" class="font-weight-bold text-primary">Sign up</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .login-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    
    .card {
        border-radius: 10px;
        overflow: hidden;
        border: none;
    }
    
    .divider {
        position: relative;
        text-align: center;
    }
    
    .divider:before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background-color: #e0e0e0;
        z-index: -1;
    }
    
    .divider span {
        position: relative;
        display: inline-block;
        z-index: 1;
    }
    
    .btn-lg {
        padding: 0.75rem 1.5rem;
    }
    
    .input-group-text {
        border-right: none;
    }
    
    .form-control {
        border-left: none;
    }
    
    .form-control:focus {
        box-shadow: none;
        border-color: #ced4da;
    }
</style>

<script>
    // Toggle password visibility
    document.querySelector('.toggle-password').addEventListener('click', function() {
        const passwordInput = document.getElementById('passwordInput');
        const icon = this.querySelector('i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>

@endsection