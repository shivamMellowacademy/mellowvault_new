@extends('college.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-key mr-2"></i>Change Password</h4>
                </div>

                <div class="card-body">
                    <form id="changePasswordForm" method="POST" action="{{ route('college.password.update') }}">
                        @csrf

                        <!-- Current Password -->
                        <div class="form-group row">
                            <label for="current_password" class="col-md-4 col-form-label text-md-right">
                                Current Password
                            </label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="current_password" type="password" 
                                           class="form-control @error('current_password') is-invalid @enderror" 
                                           name="current_password" required autocomplete="current-password">
                                    <div class="input-group-append">
                                        <span class="input-group-text toggle-password" data-target="current_password">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                New Password
                            </label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="password" type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           name="password" required autocomplete="new-password">
                                    <div class="input-group-append">
                                        <span class="input-group-text toggle-password" data-target="password">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">
                                    Password must be at least 8 characters long
                                </small>
                                <div class="progress mt-2" style="height: 5px;">
                                    <div id="password-strength-bar" class="progress-bar" role="progressbar"></div>
                                </div>
                                <small id="password-strength-text" class="form-text"></small>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                Confirm New Password
                            </label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="password-confirm" type="password" class="form-control" 
                                           name="password_confirmation" required autocomplete="new-password">
                                    <div class="input-group-append">
                                        <span class="input-group-text toggle-password" data-target="password-confirm">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <div id="password-match" class="mt-1"></div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="submitBtn">
                                    <i class="fas fa-save mr-1"></i> Change Password
                                </button>
                                <a href="{{ route('college.dashboard') }}" class="btn btn-outline-secondary ml-2">
                                    <i class="fas fa-times mr-1"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
        margin-top: 30px;
        border: none;
    }
    .card-header {
        border-radius: 10px 10px 0 0 !important;
        padding: 15px 25px;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .input-group-text {
        cursor: pointer;
        background-color: #f8f9fa;
    }
    .progress {
        background-color: #e9ecef;
    }
    #password-strength-bar {
        width: 0%;
        transition: width 0.3s ease;
    }
    #password-match {
        font-size: 0.875rem;
    }
    .match {
        color: #28a745;
    }
    .no-match {
        color: #dc3545;
    }
</style>

<script>
    $(document).ready(function() {
        // Toggle password visibility
        $('.toggle-password').click(function() {
            const target = $(this).data('target');
            const input = $('#' + target);
            const icon = $(this).find('i');
            
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        // Password strength indicator
        $('#password').on('input', function() {
            const password = $(this).val();
            const strengthBar = $('#password-strength-bar');
            const strengthText = $('#password-strength-text');
            
            // Reset
            strengthBar.removeClass('bg-danger bg-warning bg-success');
            strengthText.text('');
            
            if (password.length === 0) {
                strengthBar.css('width', '0%');
                return;
            }
            
            // Calculate strength
            let strength = 0;
            
            // Length
            if (password.length >= 8) strength += 1;
            if (password.length >= 12) strength += 1;
            
            // Contains numbers
            if (password.match(/\d+/)) strength += 1;
            
            // Contains special chars
            if (password.match(/[!,@,#,$,%,^,&,*,?,_,~]/)) strength += 1;
            
            // Contains both lowercase and uppercase
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength += 1;
            
            // Update UI
            if (strength <= 2) {
                strengthBar.addClass('bg-danger').css('width', (strength/5*100) + '%');
                strengthText.text('Weak').css('color', '#dc3545');
            } else if (strength <= 4) {
                strengthBar.addClass('bg-warning').css('width', (strength/5*100) + '%');
                strengthText.text('Moderate').css('color', '#ffc107');
            } else {
                strengthBar.addClass('bg-success').css('width', '100%');
                strengthText.text('Strong').css('color', '#28a745');
            }
        });

        // Password confirmation check
        $('#password-confirm').on('input', function() {
            const password = $('#password').val();
            const confirmPassword = $(this).val();
            const matchDiv = $('#password-match');
            
            if (confirmPassword.length === 0) {
                matchDiv.text('').removeClass('match no-match');
                return;
            }
            
            if (password === confirmPassword) {
                matchDiv.text('Passwords match').addClass('match').removeClass('no-match');
            } else {
                matchDiv.text('Passwords do not match').addClass('no-match').removeClass('match');
            }
        });

        // Form submission validation
        $('#changePasswordForm').submit(function(e) {
            const password = $('#password').val();
            const confirmPassword = $('#password-confirm').val();
            
            if (password !== confirmPassword) {
                e.preventDefault();
                $('#password-confirm').focus();
                $('#password-match').addClass('no-match').text('Passwords must match before submitting');
            }
        });
    });
</script>
@endsection