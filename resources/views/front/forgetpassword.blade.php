@extends('front.layout')

@section('content')

<style>
    .forgot-password-section {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 80vh;
        background: linear-gradient(135deg, #f9f9f9, #e0f7fa);
        padding: 40px 20px;
    }

    .forgot-password-card {
        background: #ffffff;
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        width: 100%;
    }

    .forgot-password-card h3 {
        font-weight: 700;
        margin-bottom: 15px;
        color: #333;
    }

    .forgot-password-card p {
        font-size: 14px;
        color: #666;
        margin-bottom: 30px;
    }

    .form-control {
        border-radius: 8px;
    }

    .btn-forgot {
        width: 100%;
        padding: 12px;
        font-weight: 600;
        border-radius: 8px;
    }

    .alert {
        margin-top: 15px;
    }
</style>

<section class="forgot-password-section">
    <div class="forgot-password-card">
        <h3>Forgot Your Password?</h3>
        <p>Enter your email and we’ll send you a password reset link.</p>

        @if(Session::has('errmsg'))
            <div class="alert alert-{{ Session::get('message') }} alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('errmsg') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            {{ Session::forget('message') }}
            {{ Session::forget('errmsg') }}
        @endif

        <form method="POST" action="{{ route('sendforgetpassword') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label text-dark">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email" placeholder="Enter your email" required>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-outline-primary btn-forgot">
                Send Reset Link
            </button>
        </form>
    </div>
</section>

@endsection
