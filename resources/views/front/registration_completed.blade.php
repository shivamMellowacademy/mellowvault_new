@extends('front.layout')

@section('content')

<style>
    .success-animation {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 80vh;
        padding: 2rem;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4f2fe 100%);
    }

    .checkmark {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        box-shadow: 0 10px 30px rgba(40, 167, 69, 0.2);
        margin-bottom: 2rem;
        position: relative;
        animation: scaleIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .checkmark::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 8px solid rgba(40, 167, 69, 0.1);
        animation: pulse 2s infinite;
    }

    .checkmark svg {
        width: 80px;
        height: 80px;
        color: #3a3d45;
        transform: scale(0);
        animation: checkmark 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.4s forwards;
    }

    .success-content {
        text-align: center;
        max-width: 500px;
    }

    .success-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
        background: linear-gradient(90deg, #3a3d45, #3a3d45);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .success-message {
        font-size: 1.1rem;
        line-height: 1.6;
        color: #576574;
        margin-bottom: 2rem;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .btn-primary {
        padding: 0.8rem 1.8rem;
        background: linear-gradient(135deg, #3a3d45, #3a3d45);
        color: white;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        transition: all 0.3s ease;
    }

    .btn-outline {
        padding: 0.8rem 1.8rem;
        background: transparent;
        color: #3a3d45;
        border: 2px solid #3a3d45;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
    }

    .btn-outline:hover {
        background: rgba(40, 167, 69, 0.1);
    }

    @keyframes scaleIn {
        0% { transform: scale(0); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }

    @keyframes checkmark {
        0% { transform: scale(0); }
        80% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        70% { transform: scale(1.4); opacity: 0; }
        100% { transform: scale(1.4); opacity: 0; }
    }
</style>

<section class="success-animation">
    <div class="checkmark">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
        </svg>
    </div>

    <div class="success-content">
        <h1 class="success-title">Account Created Successfully!</h1>
        <p class="success-message">
            Welcome aboard! Your account has been successfully created. We've sent a verification link to your email address. 
            Please verify your email to unlock all features.
        </p>
        
        <div class="action-buttons">
            <a href="{{ route('login') }}" class="btn-primary">Sign In Now</a>
            <a href="{{ url('/') }}" class="btn-outline">Back to Home</a>
        </div>
    </div>
</section>

@endsection