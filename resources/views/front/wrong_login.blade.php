@extends('front.layout')

@section('content')

<style>
    .auth-error-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 2rem 0;
        background-color: #f8fafc;
        background-image: radial-gradient(circle at 10% 20%, rgba(239, 68, 68, 0.05) 0%, transparent 20%);
    }

    .error-card {
        max-width: 600px;
        margin: 0 auto;
        padding: 3rem 2.5rem;
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        text-align: center;
        border-top: 4px solid #ef4444;
        transform: translateY(0);
        transition: all 0.3s ease;
    }

    .error-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(239, 68, 68, 0.1);
    }

    .error-icon-container {
        width: 100px;
        height: 100px;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #fee2e2;
        border-radius: 50%;
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.2); }
        70% { box-shadow: 0 0 0 15px rgba(239, 68, 68, 0); }
        100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
    }

    .error-icon {
        width: 50px;
        height: 50px;
        color: #ef4444;
    }

    .error-heading {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1rem;
    }

    .error-description {
        font-size: 1.1rem;
        color: #4b5563;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .error-divider {
        display: flex;
        align-items: center;
        margin: 1.5rem 0;
        color: #9ca3af;
    }

    .error-divider::before,
    .error-divider::after {
        content: "";
        flex: 1;
        border-bottom: 1px solid #e5e7eb;
    }

    .error-divider::before {
        margin-right: 1rem;
    }

    .error-divider::after {
        margin-left: 1rem;
    }

    .error-action-btn {
        display: inline-flex;
        align-items: center;
        padding: 0.875rem 2rem;
        font-size: 1rem;
        font-weight: 600;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border: none;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .error-action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(59, 130, 246, 0.3);
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
    }

    .error-action-btn i {
        margin-left: 0.5rem;
        transition: transform 0.3s ease;
    }

    .error-action-btn:hover i {
        transform: translateX(3px);
    }

    .error-help-section {
        margin-top: 2.5rem;
        padding: 1.5rem;
        background-color: #f9fafb;
        border-radius: 12px;
        text-align: left;
    }

    .error-help-title {
        display: flex;
        align-items: center;
        font-size: 1.125rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 1rem;
    }

    .error-help-title svg {
        margin-right: 0.5rem;
        color: #3b82f6;
    }

    .error-help-list {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }

    .error-help-list li {
        position: relative;
        padding-left: 1.5rem;
        margin-bottom: 0.5rem;
        color: #4b5563;
    }

    .error-help-list li:last-child {
        margin-bottom: 0;
    }

    .error-help-list li::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0.5rem;
        width: 6px;
        height: 6px;
        background-color: #3b82f6;
        border-radius: 50%;
    }

    .error-alternate-actions {
        margin-top: 1.5rem;
        font-size: 0.95rem;
        color: #6b7280;
    }

    .error-alternate-actions a {
        color: #3b82f6;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .error-alternate-actions a:hover {
        color: #2563eb;
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .error-card {
            padding: 2rem 1.5rem;
        }
        
        .error-icon-container {
            width: 80px;
            height: 80px;
        }
        
        .error-icon {
            width: 40px;
            height: 40px;
        }
        
        .error-heading {
            font-size: 1.5rem;
        }
        
        .error-description {
            font-size: 1rem;
        }
    }
</style>

<section class="auth-error-section" style="margin-top: 100px;">
    <div class="container">
        <div class="error-card">
            <div class="error-icon-container">
                <svg class="error-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </div>
            
            <h2 class="error-heading">Login Unsuccessful</h2>
            <p class="error-description">
                We couldn't verify your credentials. Please double-check your email and password.
            </p>
            
            <div class="error-divider">or</div>
            
            <a href="{{route('login')}}" class="error-action-btn">
                Try Again
                <i class="fa fa-arrow-right"></i>
            </a>
            
            <div class="error-help-section">
                <h3 class="error-help-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                    Need Help Signing In?
                </h3>
                <ul class="error-help-list">
                    <li>Make sure your email/mobile number is correctly spelled</li>
                    <li>Check that your CAPS LOCK is turned off</li>
                    <li>Reset your password if you can't remember it</li>
                    <li>Contact support if you continue having issues</li>
                </ul>
            </div>
            
            <div class="error-alternate-actions">
                Still having trouble? <a href="{{route('forgetpassword')}}">Reset your password</a> or <a href="{{url('registration')}}">create a new account</a>.
            </div>
        </div>
    </div>
</section>

@endsection