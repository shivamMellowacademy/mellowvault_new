@extends('developer.layout')

@section('content')

<div class="page-content py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">

                {{-- Alert Message --}}
                @if(Session::has('errmsg'))
                    <div class="alert alert-{{ Session::get('message', 'info') }} alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('errmsg') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    {{ Session::forget('message') }}
                    {{ Session::forget('errmsg') }}
                @endif

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0">Change Password</h5>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('developer_update_password') }}">
                            @csrf

                            {{-- Old Password --}}
                            <div class="mb-3">
                                <label for="oldPassword" class="form-label">Old Password <span class="text-danger">*</span></label>
                                <input type="password" id="oldPassword" name="old" placeholder="Enter Old Password" class="form-control rounded-0 @error('old') is-invalid @enderror" autocomplete="off" required>
                                @error('old')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- New Password --}}
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">New Password <span class="text-danger">*</span></label>
                                <input type="password" id="newPassword" name="new" placeholder="Enter New Password" class="form-control rounded-0 @error('new') is-invalid @enderror" autocomplete="off" required>
                                @error('new')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div class="mb-4">
                                <label for="confirmPassword" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" id="confirmPassword" name="con" placeholder="Enter Confirm Password" class="form-control rounded-0 @error('con') is-invalid @enderror" autocomplete="off" required>
                                @error('con')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Submit Button --}}
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div> <!-- /col -->
        </div> <!-- /row -->
    </div> <!-- /container -->
</div>

@endsection
