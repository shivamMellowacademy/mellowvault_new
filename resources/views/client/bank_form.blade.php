@extends('client.layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Bank Details</h5>
        </div>
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('bankForm') }}" method="POST" enctype="multipart/form-data">
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
@endsection