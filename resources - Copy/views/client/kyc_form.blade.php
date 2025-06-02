@extends('front.layout')

@section('content')

<div class="container" style="margin-top:200px; margin-bottom: 100px;">
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

                        <a href="{{ route('kycForm') }}" class="list-group-item">
                            <i class="fa fa-user"></i> 
                            KYC 
                            <i class="fa fa-angle-right float-right"></i>
                        </a>

                        <a href="{{ route('bankForm') }}" class="list-group-item">
                            <i class="fa fa-user"></i> 
                            Bank Details 
                            <i class="fa fa-angle-right float-right"></i>
                        </a>

                        <a href="{{ route('upgrade_plan') }}" class="list-group-item">
                            <i class="fa fa-user"></i> 
                            Upgrade Plan
                            <i class="fa fa-angle-right float-right"></i>
                        </a>



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
        <div class="card shadow-lg">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">KYC Details</h5>
            </div>
            <div class="card-body">

                {{-- Success Message --}}
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                {{-- Error Message --}}
                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                {{-- Validation Errors Summary (optional) 
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif --}}

            {{-- Form --}}
            <form action="{{ route('kycStore') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">GST Number <span class="text-danger">*</span></label>
                        <input type="text" name="gst_number" class="form-control @error('gst_number') is-invalid @enderror"
                            placeholder="e.g. 22AAAAA0000A1Z5" value="{{ old('gst_number', $kyc->gst_number ?? '') }}">
                        @error('gst_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">PAN Number <span class="text-danger">*</span></label>
                        <input type="text" name="pan_number" class="form-control @error('pan_number') is-invalid @enderror"
                            placeholder="e.g. ABCDE1234F" value="{{ old('pan_number', $kyc->pan_number ?? '') }}">
                        @error('pan_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Adhar Number <span class="text-danger">*</span></label>
                        <input type="text" name="adhar_number"
                            class="form-control @error('adhar_number') is-invalid @enderror"
                            placeholder="e.g. 1234 5678 9012" value="{{ old('adhar_number', $kyc->adhar_number ?? '') }}">
                        @error('adhar_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Business Type <span class="text-danger">*</span></label>
                        <select name="business_type"
                            class="form-select form-control @error('business_type') is-invalid @enderror">
                            <option value="">Select Business Type</option>
                            <option value="Private"
                                {{ old('business_type', $kyc->business_type ?? '') == 'Private' ? 'selected' : '' }}>
                                Private</option>
                            <option value="Public"
                                {{ old('business_type', $kyc->business_type ?? '') == 'Public' ? 'selected' : '' }}>Public
                            </option>
                            <option value="Partnership"
                                {{ old('business_type', $kyc->business_type ?? '') == 'Partnership' ? 'selected' : '' }}>
                                Partnership</option>
                            <option value="Proprietorship"
                                {{ old('business_type', $kyc->business_type ?? '') == 'Proprietorship' ? 'selected' : '' }}>
                                Proprietorship</option>
                        </select>
                        @error('business_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label">KYC Document</label>
                    <input type="file" name="kyc_document" class="form-control @error('kyc_document') is-invalid @enderror">
                    <small class="text-muted">Upload any KYC-related document (PDF, JPG, PNG)</small>
                    @if (!empty($kyc->kyc_document))
                    <p>Current: <a href="{{ asset('public/' . $kyc->kyc_document) }}" target="_blank">View Document</a></p>
                    @endif
                    @error('kyc_document')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Adhar Image</label>
                        <input type="file" name="adhar_img" class="form-control @error('adhar_img') is-invalid @enderror">
                        @if (!empty($kyc->adhar_img))
                        <p>Current: <a href="{{ asset('public/' . $kyc->adhar_img) }}" target="_blank">View Aadhar</a></p>
                        @endif
                        @error('adhar_img')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">PAN Image</label>
                        <input type="file" name="pan_img" class="form-control @error('pan_img') is-invalid @enderror">
                        @if (!empty($kyc->pan_img))
                        <p>Current: <a href="{{ asset('public/' . $kyc->pan_img) }}" target="_blank">View PAN</a></p>
                        @endif
                        @error('pan_img')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Submit KYC Details
                </button>
            </form>
        </div>
        </div>
    </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Auto dismiss alerts after 5 seconds
setTimeout(function() {
    let alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        alert.classList.remove('show');
        alert.classList.add('fade');
        setTimeout(() => alert.remove(), 500);
    });
}, 5000);
</script>
@endpush