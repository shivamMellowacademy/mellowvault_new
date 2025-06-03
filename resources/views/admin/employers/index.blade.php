@extends('admin.layout')
@section('content')
@include('admin.flash')
<!-- In your layout or head section -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-message">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="flash-message">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Employer List</a></li>
                <!-- <li class="breadcrumb-item active" aria-current="page">Details</li> -->
                  
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                    <a href="{{ route('export.employers') }}" class="btn btn-success btn-sm mb-3">
                        <i class="fas fa-file-excel me-1"></i> Export to Excel
                    </a>
                        <table id="complex-header" class="table table-striped table-bordered">
                            <thead class="bg-primary">
                                <tr>

                                    <th class="text-white">Sno.</th>
                                    <th class="text-white">Full Name</th>
                                    <th class="text-white">Email</th>
                                    <th class="text-white">Phone</th>
                                    <th class="text-white">Company Name</th>
                                    <th class="text-white">Is_Kyc Done?</th>
                                    <th class="text-white">Is Bank Details Done?</th>
                                    <th class="text-white">Status</th>
                                    <th class="text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employers as $key=>$emp)

                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $emp->fname  ?? 'Na' }} {{ $emp->lname ?? 'Na' }}</td>
                                    <td>{{ $emp->email ?? 'Na' }}</td>
                                    <td>{{ $emp->phone ?? 'Na' }}</td>
                                    <td>{{ $emp->company_name ?? 'Na' }}</td>

                                    {{-- KYC Status --}}
                                    <td>
                                        <span class="badge badge-{{ $emp->is_kyc_done ? 'success' : 'warning' }}">
                                            {{ $emp->is_kyc_done ? 'Completed' : 'Pending' }}
                                        </span>
                                    </td>

                                    {{-- Bank Status --}}
                                    <td>
                                        <span class="badge badge-{{ $emp->is_bank_done ? 'success' : 'warning' }}">
                                            {{ $emp->is_bank_done ? 'Completed' : 'Pending' }}
                                        </span>
                                    </td>

                                    {{-- Status Badge --}}
                                    <td>
                                        <span class="badge badge-{{ $emp->status ? 'success' : 'danger' }}">
                                            {{ $emp->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>

                                    {{-- Actions --}}
                                    <td>
                                        {{-- View Button --}}
                                        <a class="btn btn-info btn-sm" href="javascript:void(0);" data-bs-toggle="modal" 
                                        data-bs-target="#detailsModal{{ $emp->id }}">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        {{-- Delete Button --}}
                                        <!--<a class="btn btn-danger btn-sm"-->
                                        <!--    onclick="return confirm('Are you sure to delete this?')"-->
                                        <!--    href="{{ route('delete_blog', ['id' => $emp->id]) }}">-->
                                        <!--    <i class="fa fa-trash"></i>-->
                                        <!--</a>-->

                                        {{-- Toggle Status Button --}}
                                        <a class="btn btn-{{ $emp->status ? 'danger' : 'success' }} btn-sm"
                                            href="{{ route('toggle_user_status', ['id' => $emp->id]) }}" title="{{ $emp->status ? 'Deactivate' : 'Activate' }}">
                                            <i class="fa fa-user"></i>
                                            {{-- {{ $emp->status ? 'Deactivate' : 'Activate' }} --}}
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal per employer -->
                                <div class="modal fade" id="detailsModal{{ $emp->id }}" tabindex="-1"
                                    aria-labelledby="modalLabel{{ $emp->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title text-white" id="modalLabel{{ $emp->id }}">
                                                    Employer Profile - {{ $emp->fname }} {{ $emp->lname }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">

                                            </div>

                                            <div class="modal-body">
                                                <div class="row mb-4">
                                                    <div class="col-md-3 text-center">
                                                        <img src="{{ $emp->profile_image ?? asset('public\upload\1745081330.jpg') }}"
                                                            class="img-thumbnail rounded-circle shadow"
                                                            alt="Profile Image" style="width: 150px; height: 150px;">
                                                        <h5 class="mt-3">{{ $emp->fname }} {{ $emp->lname }}</h5>
                                                        <p class="text-muted">{{ $emp->company_name }}</p>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="row mb-2">
                                                            <div class="col-md-6">
                                                                <strong>Email:</strong> {{ $emp->email ?? 'N/A' }}
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Company:</strong> {{ $emp->company_name ?? 'N/A' }}
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Address:</strong> {{ $emp->address ?? 'N/A' }}
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Phone:</strong> {{ $emp->phone }}
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>KYC Status:</strong>
                                                                {{ $emp->is_kyc_done == 1 ? 'Completed' : 'Pending' }}
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Bank Details:</strong>
                                                                {{ $emp->is_bank_done == 1 ? 'Completed' : 'Pending' }}
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <ul class="nav nav-tabs mb-3" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-bs-toggle="tab"
                                                            href="#kycTab{{ $emp->id }}">KYC Details</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-bs-toggle="tab"
                                                            href="#bankTab{{ $emp->id }}">Bank Details</a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content">
                                                    <!-- KYC Details Tab -->
                                                    <div class="tab-pane fade show active" id="kycTab{{ $emp->id }}">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2"><strong>GST Number:</strong>
                                                                {{ $emp->kyc->gst_number ?? 'N/A' }}</div>
                                                            <div class="col-md-6 mb-2"><strong>Business Type:</strong>
                                                                {{ $emp->kyc->business_type ?? 'N/A' }}</div>
                                                            <div class="col-md-6 mb-2"><strong>PAN Number:</strong>
                                                                {{ $emp->kyc->pan_number ?? 'N/A' }}</div>
                                                            <div class="col-md-6 mb-2"><strong>Aadhaar Number:</strong>
                                                                {{ $emp->kyc->adhar_number ?? 'N/A' }}</div>
                                                            <div class="col-md-6 mb-2"><strong>KYC
                                                                    Document:</strong><br>
                                                                @if(!empty($emp->kyc->kyc_document))
                                                                <a href="{{ asset('public/' . $emp->kyc->kyc_document) }}"
                                                                    target="_blank">View Document</a>
                                                                @else
                                                                N/A
                                                                @endif
                                                            </div>
                                                            <div class="col-md-3 mb-2">
                                                                <strong>Aadhaar Image:</strong><br>
                                                                @if(!empty($emp->kyc->adhar_img))   
                                                                <img src="{{ asset('public/' . $emp->kyc->adhar_img) }}"
                                                                    class="img-fluid rounded">
                                                                @else
                                                                N/A
                                                                @endif
                                                            </div>
                                                            <div class="col-md-3 mb-2">
                                                                <strong>PAN Image:</strong><br>
                                                                @if(!empty($emp->kyc->pan_img))
                                                                <img src="{{ asset('public/' . $emp->kyc->pan_img) }}"
                                                                    class="img-fluid rounded">
                                                                @else
                                                                N/A
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Bank Details Tab -->
                                                    <div class="tab-pane fade" id="bankTab{{ $emp->id }}">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2"><strong>Account Holder
                                                                    Name:</strong>
                                                                {{ $emp->bankDetail->account_holder_name ?? 'N/A' }}
                                                            </div>
                                                            <div class="col-md-6 mb-2"><strong>Account Number:</strong>
                                                                {{ $emp->bankDetail->account_number ?? 'N/A' }}</div>
                                                            <div class="col-md-6 mb-2"><strong>IFSC Code:</strong>
                                                                {{ $emp->bankDetail->ifsc_code ?? 'N/A' }}</div>
                                                            <div class="col-md-6 mb-2"><strong>Bank Name:</strong>
                                                                {{ $emp->bankDetail->bank_name ?? 'N/A' }}</div>
                                                            <div class="col-md-6 mb-2"><strong>Branch Name:</strong>
                                                                {{ $emp->bankDetail->branch_name ?? 'N/A' }}</div>
                                                            <div class="col-md-6 mb-2"><strong>Account Type:</strong>
                                                                {{ ucfirst($emp->bankDetail->account_type ?? 'N/A')  }}
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <strong>Bank Proof:</strong><br>
                                                                @if(!empty($emp->bankDetail->bank_doc_proof))
                                                                <a href="{{ asset('public/' . $emp->bankDetail->bank_doc_proof) }}"
                                                                    target="_blank">View Document</a>
                                                                @else
                                                                N/A
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Auto-hide flash message after 3 seconds
    setTimeout(function () {
        let alert = document.getElementById('flash-message');
        if (alert) {
            alert.classList.remove('show'); // Bootstrap 5 fade-out
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 300); // Fully remove after fade
        }
    }, 3000); // 3 seconds
</script>

@endsection