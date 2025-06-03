@extends('front.layout')

@section('content')

<style>
    :root {
        --primary-color: #4361ee;
        --primary-light: #eef2ff;
        --secondary-color: #3f37c9;
        --text-dark: #1e293b;
        --text-light: #64748b;
        --border-color: #e2e8f0;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
        --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
        --shadow-lg: 0 10px 25px rgba(0,0,0,0.1);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .auth-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 2rem 0;
        background-color: #f8fafc;
        background-image: radial-gradient(circle at 10% 20%, var(--primary-light) 0%, transparent 20%);
    }
    
    .auth-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        transition: var(--transition);
    }
    
    .auth-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(67, 97, 238, 0.15);
    }
    
    .auth-header {
        text-align: center;
        padding: 2rem 0 1rem;
    }
    
    .auth-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .auth-subtitle {
        color: var(--text-light);
        font-size: 1rem;
    }
    
    .auth-form {
        padding: 2rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--text-dark);
    }
    
    .input-group {
        position: relative;
        display: flex;
        align-items: center;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        transition: var(--transition);
    }
    
    .input-group:focus-within {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
    }
    
    .input-icon {
        padding: 0 1rem;
        color: var(--text-light);
    }
    
    .form-control {
        flex: 1;
        padding: 0.875rem 1rem;
        border: none;
        background: transparent;
        font-size: 1rem;
    }
    
    .form-control:focus {
        outline: none;
        box-shadow: none;
    }
    
    .password-toggle {
        padding: 0 1rem;
        background: transparent;
        border: none;
        color: var(--text-light);
        cursor: pointer;
        transition: var(--transition);
    }
    
    .password-toggle:hover {
        color: var(--primary-color);
    }
    
    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 1.5rem 0;
    }
    
    .remember-me {
        display: flex;
        align-items: center;
    }
    
    .remember-me input {
        margin-right: 0.5rem;
        accent-color: var(--primary-color);
    }
    
    .forgot-password {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        transition: var(--transition);
    }
    
    .forgot-password:hover {
        text-decoration: underline;
    }
    
    .auth-btn {
        width: 100%;
        padding: 1rem;
        border: none;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
    }
    
    .auth-btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    
    .auth-footer {
        text-align: center;
        margin-top: 1.5rem;
        color: var(--text-light);
    }
    
    .auth-link {
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
    }
    
    .auth-link:hover {
        text-decoration: underline;
    }
    
    .alert-custom {
        border-radius: 8px;
        border-left: 4px solid;
    }
    
    @media (max-width: 768px) {
        .auth-section {
            padding: 1rem;
        }
        
        .auth-card {
            border-radius: 12px;
        }
    }
</style>

<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                @if(Session::has('errmsg'))
                <div class="alert alert-{{Session::get('message')}} alert-custom alert-dismissible fade show mb-4" role="alert">
                    <strong>{{Session::get('errmsg')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{Session::forget('message')}}
                {{Session::forget('errmsg')}}
                @endif
                
                <div class="auth-card bg-white">
                    <div class="auth-header">
                        <h1 class="auth-title">Welcome Back</h1>
                        <p class="auth-subtitle">Sign in to access your account</p>
                    </div>
                    
                    <div class="auth-form">
                        <form method="post" action="{{route('verify_login')}}">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                    </span>
                                    <input type="email" class="form-control" id="email" name="email_login" placeholder="you@example.com">
                                </div>
                                @if ($errors->has('email_login'))
                                    <small class="text-danger">{{ $errors->first('email_login') }}</small>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                        </svg>
                                    </span>
                                    <input type="password" class="form-control" id="password" name="password_login" placeholder="••••••••">
                                    <button type="button" class="password-toggle" id="togglePassword">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </button>
                                </div>
                                @if ($errors->has('password_login'))
                                    <small class="text-danger">{{ $errors->first('password_login') }}</small>
                                @endif
                            </div>
                            
                            <div class="form-options">
                                <div class="remember-me text-dark">
                                    <input type="checkbox" id="rememberMe" name="remember">
                                    <label for="rememberMe">Remember me</label>
                                </div>
                                <a href="{{route('forgetpassword')}}" class="forgot-password">Forgot password?</a>
                            </div>
                            
                            <button type="submit" class="auth-btn">
                                Sign In
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 8px;">
                                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </button>
                            
                            <div class="auth-footer">
                                <p>Don't have an account? <a href="{{url('registration')}}" class="auth-link">Sign up</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    
    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Toggle icon
        this.innerHTML = type === 'password' ? 
            '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>' :
            '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>';
    });
</script>

@endsection