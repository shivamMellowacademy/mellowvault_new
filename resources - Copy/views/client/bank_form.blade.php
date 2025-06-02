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
        <div class="col-md-9">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Bank Details</h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('bankFormSave') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Account Holder Name <span class="text-danger">*</span></label>
                                <input type="text" name="account_holder_name"
                                    class="form-control @error('account_holder_name') is-invalid @enderror"
                                    placeholder="e.g. John Doe"
                                    value="{{ old('account_holder_name', $bank->account_holder_name ?? '') }}">
                                @error('account_holder_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Account Number <span class="text-danger">*</span></label>
                                <input type="text" name="account_number"
                                    class="form-control @error('account_number') is-invalid @enderror"
                                    placeholder="e.g. 123456789012"
                                    value="{{ old('account_number', $bank->account_number ?? '') }}">
                                @error('account_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">IFSC Code <span class="text-danger">*</span></label>
                                <input type="text" name="ifsc_code"
                                    class="form-control @error('ifsc_code') is-invalid @enderror" placeholder="e.g. SBIN0001234"
                                    value="{{ old('ifsc_code', $bank->ifsc_code ?? '') }}">
                                @error('ifsc_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Bank Name <span class="text-danger">*</span></label>
                                <input type="text" name="bank_name"
                                    class="form-control @error('bank_name') is-invalid @enderror"
                                    placeholder="e.g. State Bank of India"
                                    value="{{ old('bank_name', $bank->bank_name ?? '') }}">
                                @error('bank_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Branch Name</label>
                                <input type="text" name="branch_name"
                                    class="form-control @error('branch_name') is-invalid @enderror"
                                    placeholder="e.g. Civil Lines Branch"
                                    value="{{ old('branch_name', $bank->branch_name ?? '') }}">
                                @error('branch_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Account Type</label>
                                <select name="account_type" class="form-select form-control">
                                    <option value="">-- Select --</option>
                                    <option value="Current"
                                        {{ old('account_type', $bank->account_type ?? '') == 'Current' ? 'selected' : '' }}>
                                        Current</option>
                                    <option value="Saving"
                                        {{ old('account_type', $bank->account_type ?? '') == 'Saving' ? 'selected' : '' }}>
                                        Saving</option>
                                    <option value="Other"
                                        {{ old('account_type', $bank->account_type ?? '') == 'Other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                                @error('account_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Bank Proof Document</label>
                            <input type="file" name="bank_doc_proof"
                                class="form-control @error('bank_doc_proof') is-invalid @enderror">
                            <small class="form-text text-muted">Upload passbook, statement, or bank certificate</small>
                            @if (!empty($bank->bank_doc_proof))
                            <p>Current: <a href="{{ asset('public/' . $bank->bank_doc_proof) }}" target="_blank">View
                                    Document</a></p>
                            @endif
                            @error('bank_doc_proof')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Submit Bank Details
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection