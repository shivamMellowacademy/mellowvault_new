@extends('front.layout')

@section('content')
<section class="profile-section py-4" style="margin-top: 164px; background-color: #f5f7fa;">
    <div class="container">
        <div class="row">
            <!-- Sidebar Navigation -->
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm">
                    @php $id = Session::get('user_login_id'); @endphp
                    @foreach($user_details as $uu)
                        @if($id === $uu->id)
                        <div class="card-header bg-white text-center py-3 border-bottom">
                            <h5 class="mb-0 font-weight-bold text-dark">Welcome, <span class="text-primary">{{ $uu->fname }}</span></h5>
                        </div>
                        @endif
                    @endforeach

                    <div class="list-group list-group-flush rounded-bottom">
                        <a href="{{ route('user_profile') }}" class="list-group-item list-group-item-action py-3 active">
                            <i class="fa fa-user-circle mr-2 text-primary"></i> My Profile
                            <i class="fa fa-angle-right float-right mt-1 text-muted"></i>
                        </a>
                        <a href="{{ route('show_invoice') }}" class="list-group-item list-group-item-action py-3">
                            <i class="fa fa-file-text mr-2 text-primary"></i> Invoices
                            <i class="fa fa-angle-right float-right mt-1 text-muted"></i>
                        </a>
                        <a href="{{ route('kycForm') }}" class="list-group-item list-group-item-action py-3">
                            <i class="fa fa-id-card mr-2 text-primary"></i> KYC
                            <i class="fa fa-angle-right float-right mt-1 text-muted"></i>
                        </a>
                        <a href="{{ route('bankForm') }}" class="list-group-item list-group-item-action py-3">
                            <i class="fa fa-university mr-2 text-primary"></i> Bank Details
                            <i class="fa fa-angle-right float-right mt-1 text-muted"></i>
                        </a>
                        <a href="{{ route('upgrade_plan') }}" class="list-group-item list-group-item-action py-3">
                            <i class="fa fa-rocket mr-2 text-primary"></i> Upgrade Plan
                            <i class="fa fa-angle-right float-right mt-1 text-muted"></i>
                        </a>

                        @if($developer_order_details > 0)
                        <a href="{{ route('client_dashboard') }}" class="list-group-item list-group-item-action py-3">
                            <i class="fa fa-briefcase mr-2 text-primary"></i> Work Space
                            <i class="fa fa-angle-right float-right mt-1 text-muted"></i>
                        </a>
                        <a href="{{ route('resource') }}" class="list-group-item list-group-item-action py-3">
                            <i class="fa fa-users mr-2 text-primary"></i> Resources
                            <i class="fa fa-angle-right float-right mt-1 text-muted"></i>
                        </a>
                        <a href="{{ route('assign_work') }}" class="list-group-item list-group-item-action py-3">
                            <i class="fa fa-tasks mr-2 text-primary"></i> Assign Work
                            <i class="fa fa-angle-right float-right mt-1 text-muted"></i>
                        </a>
                        @endif

                        <a href="{{ route('user_logout') }}" class="list-group-item list-group-item-action py-3 text-danger">
                            <i class="fa fa-sign-out mr-2"></i> Logout
                            <i class="fa fa-angle-right float-right mt-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Profile Content -->
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 font-weight-bold text-dark">Profile Settings</h4>
                            <div class="badge badge-primary p-2">Account Details</div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        @if(Session::has('errmsg'))
                        <div class="alert alert-{{ Session::get('message') }} alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-{{ Session::get('message') == 'success' ? 'check-circle' : 'exclamation-triangle' }} mr-2"></i>
                                <strong>{{ Session::get('errmsg') }}</strong>
                            </div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {{ Session::forget('message') }}
                        {{ Session::forget('errmsg') }}
                        @endif

                        @foreach($user_details as $user)
                            @if($id == $user->id)
                            <div class="row align-items-center mb-4">
                                <!-- Profile Picture Section -->
                                <div class="col-md-3 text-center mb-4 mb-md-0">
                                    <div class="position-relative d-inline-block">
                                        <div class="avatar-container">
                                            <img class="img-fluid rounded-circle shadow" 
                                                 src="{{ asset('public/upload/profile_image/' . $user->image) }}" 
                                                 alt="Profile Image"
                                                 style="width: 120px; height: 120px; object-fit: cover;">
                                            
                                            <form method="POST" action="{{ route('update_image') }}" enctype="multipart/form-data" id="imageForm">
                                                @csrf
                                                <input type="hidden" name="update" value="{{ $user->id }}">
                                                <input type="file" name="image" class="d-none" accept="image/*" id="imageInput">
                                                
                                                <label for="imageInput" class="avatar-edit">
                                                    <i class="fa fa-camera"></i>
                                                </label>
                                            </form>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary btn-sm mt-3" form="imageForm">
                                        <i class="fa fa-upload mr-1"></i> Update Photo
                                    </button>
                                </div>

                                <!-- Profile Form -->
                                <div class="col-md-9">
                                    <form method="POST" action="{{ route('edit_profile') }}">
                                        @csrf
                                        <input type="hidden" name="update" value="{{ $user->id }}">

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold text-secondary">First Name <span class="text-danger">*</span></label>
                                                <input type="text" name="fname" class="form-control border-2" value="{{ $user->fname }}">
                                                @error('fname')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold text-secondary">Last Name <span class="text-danger">*</span></label>
                                                <input type="text" name="lname" class="form-control border-2" value="{{ $user->lname }}">
                                                @error('lname')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold text-secondary">Username <span class="text-danger">*</span></label>
                                                <input type="text" name="user_name" class="form-control border-2" value="{{ $user->user_name }}">
                                                @error('user_name')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold text-secondary">Email <span class="text-danger">*</span></label>
                                                <input type="email" name="email" class="form-control border-2" value="{{ $user->email }}">
                                                @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold text-secondary">Company Name</label>
                                                <input type="text" name="company_name" class="form-control border-2" value="{{ $user->company_name }}">
                                                @error('company_name')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold text-secondary">Phone <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light">+91</span>
                                                    </div>
                                                    <input type="tel" name="phone" class="form-control border-2" maxlength="10" value="{{ $user->phone }}">
                                                </div>
                                                @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold text-secondary">Purpose</label>
                                                <select name="purpose" class="form-control border-2">
                                                    <option value="">Select Purpose</option>
                                                    <option value="For Myself" {{ $user->purpose == 'For Myself' ? 'selected' : '' }}>For Myself</option>
                                                    <option value="For Organization" {{ $user->purpose == 'For Organization' ? 'selected' : '' }}>For Organization</option>
                                                    <option value="For Designer" {{ $user->purpose == 'For Designer' ? 'selected' : '' }}>For Designer</option>
                                                </select>
                                                @error('purpose')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-bold text-secondary">Current Purpose</label>
                                                <input type="text" class="form-control bg-light border-2" value="{{ $user->purpose }}" readonly>
                                            </div>
                                        </div>

                                        <div class="text-right mt-4 pt-3 border-top">
                                            <button type="reset" class="btn btn-outline-secondary mr-2 px-4">
                                                <i class="fa fa-undo mr-1"></i> Reset
                                            </button>
                                            <button type="submit" class="btn btn-primary px-4">
                                                <i class="fa fa-save mr-1"></i> Save Changes
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.profile-section {
    min-height: calc(100vh - 164px);
}

.card {
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.card-header {
    background: linear-gradient(to right, #f8f9fa, #fff);
}

.list-group-item {
    border-left: 0;
    border-right: 0;
    transition: all 0.2s;
    border-color: rgba(0,0,0,.05);
}

.list-group-item:first-child {
    border-top: 0;
}

.list-group-item.active {
    background-color: #f0f7ff;
    color: #2c3e50;
    border-left: 4px solid #3490dc;
    font-weight: 500;
}

.list-group-item-action:hover {
    background-color: #f8f9fa;
    transform: translateX(3px);
}

.avatar-container {
    position: relative;
    display: inline-block;
}

.avatar-edit {
    position: absolute;
    bottom: 10px;
    right: 10px;
    background: #3490dc;
    color: white;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
}

.avatar-edit:hover {
    background: #227dc7;
    transform: scale(1.1);
}

.form-control {
    border-radius: 6px;
    padding: 10px 15px;
    transition: all 0.3s;
}

.form-control:focus {
    border-color: #3490dc;
    box-shadow: 0 0 0 0.2rem rgba(52, 144, 220, 0.25);
}

.border-2 {
    border-width: 2px !important;
}

.btn-outline-primary {
    border-width: 2px;
    font-weight: 500;
}

.badge {
    font-size: 0.8rem;
    font-weight: 500;
    letter-spacing: 0.5px;
}

.alert {
    border-radius: 8px;
    border-left: 4px solid;
}

.alert-success {
    border-left-color: #28a745;
}

.alert-danger {
    border-left-color: #dc3545;
}

.text-secondary {
    color: #5a6a7e !important;
}
</style>
@endsection