@extends('college.layout')

@section('content')
<div class="main-wrapper container" style="margin-top: 30px; padding: 20px; background: #f8f9fa; border-radius: 10px;">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-user-tie mr-2"></i>Developer Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Dev ID:</span>
                        <span class="info-value">{{ $developer->dev_id ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Name:</span>
                        <span class="info-value">{{ $developer->name ?? 'N/A' }} {{ $developer->last_name ?? '' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Email:</span>
                        <span class="info-value">{{ $developer->email ?? 'N/A' }}</span>
                    </div>
                </div>
                <!-- Add all other fields in similar format -->
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Phone:</span>
                        <span class="info-value">{{ $developer->phone ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Job:</span>
                        <span class="info-value">{{ $developer->job ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Total Hours:</span>
                        <span class="info-value">{{ $developer->total_hours ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Per Month:</span>
                        <span class="info-value">₹{{ $developer->perhr ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Rating:</span>
                        <span class="info-value">
                            @if(isset($developer->rating))
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $developer->rating)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="far fa-star text-warning"></i>
                                    @endif
                                @endfor
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Address:</span>
                        <span class="info-value">{{ $developer->address ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Languages:</span>
                        <span class="info-value">{{ $developer->language ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Education:</span>
                        <span class="info-value">{{ $developer->education ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">College:</span>
                        <span class="info-value">{{ $developer->clg_name ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Degree:</span>
                        <span class="info-value">{{ $developer->degree ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Percentage:</span>
                        <span class="info-value">{{ $developer->percentage ?? 'N/A' }}%</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Passing Year:</span>
                        <span class="info-value">{{ $developer->passing_year ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Total Experience:</span>
                        <span class="info-value">{{ $developer->total_experience ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Current CTC:</span>
                        <span class="info-value">{{ $developer->current_ctc ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Expected CTC:</span>
                        <span class="info-value">{{ $developer->expected_ctc ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Notice Period:</span>
                        <span class="info-value">{{ $developer->notice_period ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Developer Status:</span>
                        <span class="info-value badge 
                            @if($developer->developer_status == 'Available') badge-success 
                            @elseif($developer->developer_status == 'Busy') badge-warning 
                            @elseif($developer->developer_status == 'Not Available') badge-danger 
                            @else badge-secondary @endif">
                            {{ $developer->developer_status ?? 'N/A' }}
                        </span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Available From:</span>
                        <span class="info-value">{{ $developer->available_start_date ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Available Until:</span>
                        <span class="info-value">{{ $developer->available_end_date ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Login Status:</span>
                        <span class="info-value badge {{ $developer->login_status == 1 ? 'badge-success' : 'badge-secondary' }}">
                            {{ $developer->login_status == 1 ? 'Online' : 'Offline' }}
                        </span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Profile Completion:</span>
                        <span class="info-value">
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $developer->profile_complete ?? 0 }}%;" aria-valuenow="{{ $developer->profile_complete ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
                                    {{ $developer->profile_complete ?? 0 }}%
                                </div>
                            </div>
                        </span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Date:</span>
                        <span class="info-value">{{ $developer->date ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-tasks mr-2"></i>Skills & Description</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="info-card">
                        <span class="info-label">Skills:</span>
                        <span class="info-value">
                            @if(isset($developer->skills))
                                @foreach(explode(',', $developer->skills) as $skill)
                                    <span class="badge badge-pill badge-info mr-1">{{ trim($skill) }}</span>
                                @endforeach
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="info-card">
                        <span class="info-label">Description:</span>
                        <span class="info-value">{{ $developer->description ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="info-card">
                        <span class="info-label">Completed Jobs:</span>
                        <span class="info-value">{{ $developer->completed_job ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-university mr-2"></i>Bank & ID Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Bank Name:</span>
                        <span class="info-value">{{ $developer->bank_name ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Branch:</span>
                        <span class="info-value">{{ $developer->branch_name ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Account Holder:</span>
                        <span class="info-value">{{ $developer->acct_name ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Account No:</span>
                        <span class="info-value">{{ $developer->account_number ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Account Type:</span>
                        <span class="info-value">{{ $developer->account_Type ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">IFSC:</span>
                        <span class="info-value">{{ $developer->ifc_code ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">MICR:</span>
                        <span class="info-value">{{ $developer->micr_number ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Aadhar No:</span>
                        <span class="info-value">{{ $developer->adhar_number ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">PAN No:</span>
                        <span class="info-value">{{ $developer->pan_number ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">National ID Name:</span>
                        <span class="info-value">{{ $developer->national_id_name ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-building mr-2"></i>Company Details (Working At)</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Company Name:</span>
                        <span class="info-value">{{ $companyDetails->company_name ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Country:</span>
                        <span class="info-value">{{ $companyDetails->country ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">State:</span>
                        <span class="info-value">{{ $companyDetails->state ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Address:</span>
                        <span class="info-value">{{ $companyDetails->address_one ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Zip Code:</span>
                        <span class="info-value">{{ $companyDetails->code ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">GST:</span>
                        <span class="info-value">{{ $companyDetails->gst ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Per Month:</span>
                        <span class="info-value">₹{{ $companyDetails->perhr ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">Status:</span>
                        <span class="info-value badge badge-success">Active (Onboard)</span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-card">
                        <span class="info-label">PAN No:</span>
                        <span class="info-value">{{ $companyDetails->pan_number ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-file-alt mr-2"></i>KYC & Documents</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="document-card">
                        <div class="document-label">Profile Image</div>
                        <div class="document-preview">
                            @if($developer->image)
                                <img src="{{ asset('public/upload/developer/'.$developer->image) }}" class="img-thumbnail document-image" data-toggle="modal" data-target="#imageModal" data-img="{{ asset('public/upload/developer/'.$developer->image) }}">
                            @else
                                <div class="no-document">N/A</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="document-card">
                        <div class="document-label">Portfolio</div>
                        <div class="document-preview">
                            @if($developer->portfolio_image)
                                <img src="{{ asset('public/upload/portfolio/'.$developer->portfolio_image) }}" class="img-thumbnail document-image" data-toggle="modal" data-target="#imageModal" data-img="{{ asset('public/upload/portfolio/'.$developer->portfolio_image) }}">
                            @else
                                <div class="no-document">N/A</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="document-card">
                        <div class="document-label">Resume</div>
                        <div class="document-preview">
                            @if($developer->resume)
                                <a href="{{ asset('public/upload/resume/'.$developer->resume) }}" target="_blank" class="btn btn-primary btn-sm document-btn">
                                    <i class="fas fa-file-pdf"></i> View PDF
                                </a>
                            @else
                                <div class="no-document">N/A</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="document-card">
                        <div class="document-label">Aadhar Card</div>
                        <div class="document-preview">
                            @if($developer->adharcard)
                                <a href="{{ asset('public/upload/adhar_card/'.$developer->adharcard) }}" target="_blank" class="btn btn-primary btn-sm document-btn">
                                    <i class="fas fa-id-card"></i> View
                                </a>
                            @else
                                <div class="no-document">N/A</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="document-card">
                        <div class="document-label">PAN Card</div>
                        <div class="document-preview">
                            @if($developer->pancard)
                                <a href="{{ asset('public/upload/pan_card/'.$developer->pancard) }}" target="_blank" class="btn btn-primary btn-sm document-btn">
                                    <i class="fas fa-credit-card"></i> View
                                </a>
                            @else
                                <div class="no-document">N/A</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="document-card">
                        <div class="document-label">National ID</div>
                        <div class="document-preview">
                            @if($developer->national_id_image)
                                <a href="{{ asset('public/upload/national_image/'.$developer->national_id_image) }}" target="_blank" class="btn btn-primary btn-sm document-btn">
                                    <i class="fas fa-passport"></i> View
                                </a>
                            @else
                                <div class="no-document">N/A</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="document-card">
                        <div class="document-label">Signature</div>
                        <div class="document-preview">
                            @if($developer->signature)
                                <img src="{{ asset('public/upload/signature/'.$developer->signature) }}" class="img-thumbnail document-image" data-toggle="modal" data-target="#imageModal" data-img="{{ asset('public/upload/signature/'.$developer->signature) }}">
                            @else
                                <div class="no-document">N/A</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="document-card">
                        <div class="document-label">Passbook</div>
                        <div class="document-preview">
                            @if($developer->passbook)
                                <a href="{{ asset('public/'.$developer->passbook) }}" target="_blank" class="btn btn-primary btn-sm document-btn">
                                    <i class="fas fa-file-invoice-dollar"></i> View
                                </a>
                            @else
                                <div class="no-document">N/A</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-project-diagram mr-2"></i>Project Details</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sl. No.</th>
                            <th>Screenshot</th>
                            <th>Link</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($devProjectDetails as $index => $dev_project)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($dev_project->screenshot_image)
                                    <img src="{{ asset('public/upload/screenshot/'.$dev_project->screenshot_image) }}" 
                                         class="img-thumbnail project-thumbnail" 
                                         data-toggle="modal" 
                                         data-target="#imageModal" 
                                         data-img="{{ asset('public/upload/screenshot/'.$dev_project->screenshot_image) }}">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($dev_project->project_link)
                                    <a href="{{ $dev_project->project_link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-external-link-alt"></i> Visit
                                    </a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $dev_project->description ?? 'N/A' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No projects found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Document Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid" alt="Document Preview">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="downloadLink" href="#" download class="btn btn-primary">
                        <i class="fas fa-download"></i> Download
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .info-card {
        background: white;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        height: 100%;
    }
    .info-label {
        display: block;
        font-size: 12px;
        color: #6c757d;
        margin-bottom: 5px;
        font-weight: 600;
    }
    .info-value {
        font-size: 14px;
        color: #343a40;
        font-weight: 500;
    }
    .document-card {
        background: white;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        height: 100%;
        text-align: center;
    }
    .document-label {
        font-size: 12px;
        color: #6c757d;
        margin-bottom: 10px;
        font-weight: 600;
    }
    .document-image {
        max-width: 100%;
        height: 120px;
        object-fit: contain;
        cursor: pointer;
        transition: transform 0.3s;
    }
    .document-image:hover {
        transform: scale(1.05);
    }
    .document-btn {
        width: 100%;
        margin-top: 10px;
    }
    .no-document {
        color: #6c757d;
        font-style: italic;
        padding: 20px 0;
    }
    .project-thumbnail {
        width: 80px;
        height: 60px;
        object-fit: cover;
        cursor: pointer;
    }
    .card-header {
        border-radius: 8px 8px 0 0 !important;
    }
    .badge-pill {
        padding: 5px 10px;
    }
</style>

<script>
    $(document).ready(function() {
        // Image modal handler
        $('#imageModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var imageUrl = button.data('img');
            var modal = $(this);
            modal.find('#modalImage').attr('src', imageUrl);
            modal.find('#downloadLink').attr('href', imageUrl);
        });
    });
</script>
@endsection