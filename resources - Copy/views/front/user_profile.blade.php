@extends('front.layout')

@section('content')
<br>
<br>
<br>
<br>
<section class="profile-section">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="sticky-top">
                    <div class="card">
                        @php $id = Session::get('user_login_id'); @endphp
                        @foreach($user_details as $uu)
                        @if($id === $uu->id)
                        <div class="card-header text-center">
                            <a href="#">Hi, {{ $uu->fname }}</a>
                        </div>
                        @endif
                        @endforeach

                        <div class="list-group">
                            <a href="{{ route('user_profile') }}" class="list-group-item"><i class="fa fa-user"></i> My
                                Profile <i class="fa fa-angle-right float-right"></i></a>
                            <!-- <a href="{{ route('my_download') }}" class="list-group-item"><i class="fa fa-download"></i>
                                Downloads <i class="fa fa-angle-right float-right"></i></a>
                            <a href="{{ route('act_setting') }}" class="list-group-item"><i class="fa fa-gear"></i>
                                Account Settings <i class="fa fa-angle-right float-right"></i></a> -->
                            <a href="{{ route('show_invoice') }}" class="list-group-item"><i class="fa fa-yelp"></i>
                                Invoice <i class="fa fa-angle-right float-right"></i></a>

                            @if($developer_order_details > 0)
                            <a href="{{ route('client_dashboard') }}" class="list-group-item"><i class="fa fa-plus"></i>
                                Work Space <i class="fa fa-angle-right float-right"></i></a>
                            <a href="{{ route('resource') }}" class="list-group-item"><i class="fa fa-child"></i>
                                Resource <i class="fa fa-angle-right float-right"></i></a>
                            <a href="{{ route('assign_work') }}" class="list-group-item"><i class="fa fa-suitcase"></i>
                                Assign Work <i class="fa fa-angle-right float-right"></i></a>
                            @endif

                            <a href="{{ route('user_logout') }}" class="list-group-item"><i class="fa fa-sign-out"></i>
                                Logout <i class="fa fa-angle-right float-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Main Content -->
            <div class="col-md-9">
                <div class="card shadow-sm">
                    <div class="card-body">
                        @if(Session::has('errmsg'))
                        <div class="alert alert-{{ Session::get('message') }} alert-dismissible fade show" role="alert">
                            <center><strong>{{ Session::get('errmsg') }}</strong></center>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {{ Session::forget('message') }}
                        {{ Session::forget('errmsg') }}
                        @endif

                        @foreach($user_details as $user)
                        @if($id == $user->id)
                        <div class="row mb-4">
                            <!-- Profile Picture -->
                            <div class="col-md-3 text-center">
                                <!-- Avatar Icon -->
                                <img class="img-fluid rounded-circle"
                                    src="{{ asset('public/upload/profile_image/' . $user->image) }}" alt="Profile Image"
                                    style="max-width: 100px;">

                                <!-- Hidden File Input, triggered by the edit icon -->
                                <form method="POST" action="{{ route('update_image') }}" enctype="multipart/form-data"
                                    style="display: none;" id="imageForm">
                                    @csrf
                                    <input type="hidden" name="update" value="{{ $user->id }}">
                                    <input type="file" name="image" class="form-control-file" accept="image/*"
                                        id="imageInput">
                                </form>

                                <!-- Edit Icon to Trigger File Input -->
                                <label for="imageInput" style="cursor: pointer;">
                                    <i class="fa fa-camera" style="font-size: 25px; color: #007bff;"></i>
                                </label>

                                <!-- Change Photo Button -->
                                <button type="submit" class="btn btn-primary btn-sm mt-2" form="imageForm">Change
                                    Photo</button>
                            </div>

                            <!-- Profile Form -->
                            <form method="POST" action="{{ route('edit_profile') }}">
                                @csrf
                                <input type="hidden" name="update" value="{{ $user->id }}">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>First Name *</label>
                                        <input type="text" name="fname" class="form-control" value="{{ $user->fname }}">
                                        @error('fname')
                                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Last Name *</label>
                                        <input type="text" name="lname" class="form-control" value="{{ $user->lname }}">
                                        @error('lname')
                                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>User Name *</label>
                                        <input type="text" name="user_name" class="form-control"
                                            value="{{ $user->user_name }}">
                                        @error('user_name')
                                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Email *</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $user->email }}">
                                        @error('email')
                                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Company Name</label>
                                        <input type="text" name="company_name" class="form-control"
                                            value="{{ $user->company_name }}">
                                        @error('company_name')
                                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Phone *</label>
                                        <input type="tel" name="phone" class="form-control" maxlength="10"
                                            value="{{ $user->phone }}">
                                        @error('phone')
                                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Purpose</label>
                                        <select name="purpose" class="form-control">
                                            <option value="#">Select Purpose</option>
                                            <option value="For Myself"
                                                {{ $user->purpose == 'For Myself' ? 'selected' : '' }}>For Myself
                                            </option>
                                            <option value="For Organization"
                                                {{ $user->purpose == 'For Organization' ? 'selected' : '' }}>For
                                                Organization</option>
                                            <option value="For Designer"
                                                {{ $user->purpose == 'For Designer' ? 'selected' : '' }}>For Designer
                                            </option>
                                        </select>
                                        @error('purpose')
                                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Selected Purpose</label>
                                        <input type="text" class="form-control" value="{{ $user->purpose }}" readonly>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-success btn-block">Update Profile</button>
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
@endsection

@section('styles')
<style>
.profile-section .card {
    border-radius: 10px;
    overflow: hidden;
}

.card-header a {
    font-weight: bold;
    font-size: 18px;
}

.list-group-item {
    border-radius: 5px;
    font-size: 16px;
}

.form-control {
    border-radius: 5px;
    font-size: 14px;
}

.form-group label {
    font-weight: bold;
}

.btn-sm {
    padding: 5px 15px;
}

.row.mb-4 {
    margin-bottom: 15px !important;
}

.alert {
    border-radius: 5px;
}
</style>
@endsection

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">