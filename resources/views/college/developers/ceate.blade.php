@extends('college.layout')
@section('content')
 <link href="{{URL::asset('public/developer/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/asset/css/style.css')}}" rel="stylesheet">
<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('college.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Developers</li>
            </ol>
        </nav>
    </div>

    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Add New Developer</h5>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('college.developers.store') }}" id="developerForm">
                            @csrf
                            
                            <div class="form-group">
                                <label for="specialization" class="form-label">Specialization:</label>
                                <select name="specialization" id="specialization" class="form-select w-100" required>
                                    <option value="" disabled selected>Select specialization</option>
                                    @foreach($college_list as $specialization)
                                        <option value="{{ $specialization }}" {{ old('specialization') == $specialization ? 'selected' : '' }}>
                                            {{ $specialization }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('specialization'))
                                    <strong class="text-danger">
                                        <i class="fa fa-exclamation-circle me-1"></i>
                                        {{ $errors->first('specialization') }}
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
                            
                            <div class="row">
                                <div class="col-md-6">
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
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" 
                                            placeholder="Confirm your password" required>
                                        <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            <button type="submit" class="btn btn-primary btn-block mt-3">
                                <i class="fa fa-user-plus me-2"></i> Create Developer Account
                            </button>
                            
                            <div class="text-center mt-3">
                                <a href="{{ route('college.developers.index') }}" class="text-muted">
                                    <i class="fa fa-arrow-left me-1"></i> Back to developers list
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Password toggle functionality
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.nextElementSibling.querySelector('i');
        
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // Password strength indicator
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const strengthBar = document.getElementById('passwordStrength');
        const strengthText = document.getElementById('passwordStrengthText');
        
        // Calculate password strength (simple version)
        let strength = 0;
        if (password.length > 0) strength += 1;
        if (password.length >= 8) strength += 1;
        if (/[A-Z]/.test(password)) strength += 1;
        if (/[0-9]/.test(password)) strength += 1;
        if (/[^A-Za-z0-9]/.test(password)) strength += 1;
        
        // Update UI
        const width = strength * 20;
        strengthBar.style.width = width + '%';
        
        if (strength <= 1) {
            strengthBar.style.backgroundColor = '#dc3545';
            strengthText.textContent = 'Weak';
        } else if (strength <= 2) {
            strengthBar.style.backgroundColor = '#ffc107';
            strengthText.textContent = 'Medium';
        } else {
            strengthBar.style.backgroundColor = '#28a745';
            strengthText.textContent = 'Strong';
        }
    });
</script>

<style>
    .password-toggle {
        position: absolute;
        right: 10px;
        top: 50px;
        cursor: pointer;
        color: #6c757d;
    }
    .progress-container {
        height: 5px;
        background-color: #e9ecef;
        border-radius: 3px;
        margin-bottom: 5px;
    }
    .progress-bar {
        height: 100%;
        border-radius: 3px;
        transition: width 0.3s, background-color 0.3s;
    }
    .password-strength {
        font-size: 12px;
        color: #6c757d;
    }
    .form-control-with-icon {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
</style>
@endsection