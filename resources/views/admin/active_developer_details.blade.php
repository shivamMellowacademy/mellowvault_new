@extends('admin.layout')
@section('content')
@include('admin.flash')
<style>
    .dropdown-item {
        cursor: pointer;
    }
</style>

<div class="page-content" style="padding-top:30px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Developer Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>

    <div class="main-wrapper container">
    <div class="row mb-2">
    <div class="col text-right">
        <a href="{{ route('developer_details') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add Developer
        </a>
    </div>
    </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-white">Sl. No.</th>
                                        <th class="text-white">Higher Professional</th>
                                        <th class="text-white">Full Name</th>
                                        <th class="text-white">Change Status</th>
                                        <th class="text-white">Is Login Active?</th>
                                        <th class="text-white">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($developer_details as $i => $s)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $s->heading }}</td>
                                        <td>{{ $s->name }} {{ $s->last_name }}</td>
                                        <td>
                                            <select name="developer_status"
                                                onchange="update_status(this.value, {{ $s->dev_id }})"
                                                class="form-control">
                                                <option value="">Select Status</option>
                                                <option value="Booked"
                                                    {{ $s->developer_status == 'Booked' ? 'selected' : '' }}>Booked
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            @if($s->login_status == 0)
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ route('developer_login_status', ['dev_id' => $s->dev_id]) }}">
                                                <i class="fa fa-times"></i> No
                                            </a>
                                            @else
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('developer_login_status', ['dev_id' => $s->dev_id]) }}">
                                                <i class="fa fa-check"></i> Yes
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-success dropdown-toggle" type="button"
                                                    data-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" data-toggle="modal"
                                                        data-target="#myModal{{ $s->dev_id }}">
                                                        <i class="fa fa-user"></i> Profile
                                                    </a>
                                                    <a class="dropdown-item" data-toggle="modal"
                                                        data-target="#myBankModal{{ $s->dev_id }}">
                                                        <i class="fa fa-university"></i> Bank
                                                    </a>
                                                    <a class="dropdown-item" data-toggle="modal"
                                                        data-target="#myprojectModal{{ $s->dev_id }}">
                                                        <i class="fa fa-folder-open"></i> Project
                                                    </a>
                                                    <a class="dropdown-item" data-toggle="modal"
                                                        data-target="#myeditModal{{ $s->dev_id }}">
                                                        <i class="fa fa-calendar"></i> Availability
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('developer_transaction_details', ['dev_id' => $s->dev_id]) }}"
                                                        target="_blank">
                                                        <i class="fa fa-credit-card"></i> Transaction
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('developer_details_update', ['dev_id' => $s->dev_id]) }}">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item text-danger"
                                                        href="{{ route('delete_developer_details', ['dev_id' => $s->dev_id]) }}"
                                                        onclick="return confirm('Are you sure?')">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                    {{-- Profile Modal --}}
                                    <div class="modal fade" id="myModal{{ $s->dev_id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                                <div class="modal-header bg-primary text-white">
                                                    <h4 class="modal-title text-white">{{ $s->name }}
                                                        {{ $s->last_name }} - Profile
                                                    </h4>
                                                    <button type="button" class="close text-white"
                                                        data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="row">

                                                        {{-- Profile Image & Info --}}
                                                        <div class="col-md-4 text-center">
                                                            @if(!empty($s->image))
                                                            <img src="{{ asset('public/upload/developer/'.$s->image) }}"
                                                                class="rounded-circle img-thumbnail mb-3"
                                                                style="width:150px; height:150px;">
                                                            @else
                                                            <img src="{{ asset('public/client/assets/images/avatars/profile-image.png') }}"
                                                                class="rounded-circle img-thumbnail mb-3"
                                                                style="width:150px; height:150px;">
                                                            @endif


                                                            <h5 class="font-weight-bold">{{ $s->name }}
                                                                {{ $s->last_name }}</h5>
                                                            <p class="text-muted">{{ $s->job }}</p>
                                                            <span class="badge badge-info">Rating:
                                                                {{ $s->rating }}/5</span><br><br>
                                                            <span
                                                                class="badge badge-success">{{ $s->developer_status }}</span>
                                                        </div>

                                                        {{-- Developer Details --}}
                                                        <div class="col-md-8">
                                                            <h5>Summary</h5>
                                                            <p>{!! $s->description !!}</p>

                                                            <div class="row mt-3">
                                                                <div class="col-sm-6">
                                                                    <p><strong>Email:</strong> {{ $s->email }}</p>
                                                                    <p><strong>Phone:</strong> {{ $s->phone }}</p>
                                                                    <p><strong>Per Hour:</strong> ₹{{ $s->perhr }}</p>
                                                                    <p><strong>Total Hours:</strong>
                                                                        {{ $s->total_hours }}</p>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <p><strong>Address:</strong> {{ $s->address }}</p>
                                                                    <p><strong>Language:</strong> {{ $s->language }}</p>
                                                                    <p><strong>Available:</strong>
                                                                        @if($s->available_start_date)
                                                                        <span
                                                                            class="text-success">{{ $s->available_start_date }}
                                                                            to {{ $s->available_end_date }}</span>
                                                                        @else
                                                                        <span class="text-danger">Not set</span>
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <h5>Education</h5>
                                                            <p><strong>University:</strong> {{ $s->education }}</p>
                                                            <p><strong>College:</strong> {{ $s->clg_name }}</p>
                                                            <p><strong>Degree:</strong> {{ $s->degree }}
                                                                ({{ $s->passing_year }})</p>
                                                            <p><strong>Percentage:</strong> {{ $s->percentage }}%</p>

                                                            <hr>

                                                            <h5>Skills</h5>
                                                            @foreach(explode(',', $s->skills) as $skill)
                                                            <p>{!! trim($skill) !!}</p>
                                                            @endforeach

                                                            <hr>

                                                            <h5>Resume</h5>
                                                            <a href="{{ asset('public/upload/resume/'.$s->resume) }}"
                                                                target="_blank" class="btn btn-outline-primary btn-sm">
                                                                View Resume
                                                            </a>

                                                            <h5 class="mt-4">Portfolio</h5>
                                                            <img src="{{ asset('public/upload/portfolio/'.$s->portfolio_image) }}"
                                                                class="img-fluid rounded shadow-sm"
                                                                style="height:120px;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer bg-light">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    {{-- Availability Modal --}}
                                    <div class="modal fade" id="myeditModal{{ $s->dev_id }}">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Available Dates</h5>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST"
                                                        action="{{ route('developer_available_update') }}">
                                                        @csrf
                                                        <input type="hidden" name="update" value="{{ $s->dev_id }}">
                                                        <div class="form-group">
                                                            <label>Start Date</label>
                                                            <input type="date" name="available_start_date"
                                                                class="form-control" required>
                                                            @error('available_start_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>End Date</label>
                                                            <input type="date" name="available_end_date"
                                                                class="form-control" required>
                                                            @error('available_end_date')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <button type="submit" class="btn btn-success">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Add your bank details modal --}}
                                    <div class="modal fade" id="myBankModal{{ $s->dev_id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="bankModalLabel{{ $s->dev_id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title text-white"
                                                        id="bankModalLabel{{ $s->dev_id }}">Bank Details</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal"
                                                        aria-label="Close">&times;</button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="row">
                                                        @php
                                                        $fields = [
                                                        'Name Of Bank' => $s->bank_name,
                                                        'Branch Name' => $s->branch_name,
                                                        'Account Name' => $s->acct_name,
                                                        'Account Number' => $s->account_number,
                                                        'IFC Code' => $s->ifc_code,
                                                        'Swift Code' => $s->micr_number,
                                                        'Type Of Account' => $s->account_Type,
                                                        ];
                                                        @endphp

                                                        @foreach($fields as $label => $value)
                                                        <div class="col-md-6 mb-3">
                                                            <div class="card h-100">
                                                                <div class="card-body">
                                                                    <h6 class="card-title font-weight-bold">{{ $label }}
                                                                    </h6>
                                                                    <p class="card-text">{{ $value ?: 'N/A' }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach

                                                        @if(!empty($s->passbook))
                                                        <div class="col-12 mt-3">
                                                            <div class="card">
                                                                <div class="card-body text-center">
                                                                    <h6 class="card-title font-weight-bold">Passbook
                                                                        Image</h6>
                                                                    <a href="{{ asset('public/upload/passbook/' . $s->passbook) }}"
                                                                        target="_blank">
                                                                        <img src="{{ asset('public/upload/passbook/' . $s->passbook) }}"
                                                                            class="img-fluid img-thumbnail"
                                                                            style="max-height: 250px;">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Add your project details modal --}}
                                    <div class="modal fade" id="myprojectModal{{ $s->dev_id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="projectModalLabel{{ $s->dev_id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title text-white"
                                                        id="projectModalLabel{{ $s->dev_id }}">
                                                        Project Details</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal"
                                                        aria-label="Close">&times;</button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="row">
                                                        @foreach($developer_project_details as $k)
                                                        @if($k->developer_id == $s->dev_id)
                                                        <div class="col-md-6 mb-4">
                                                            <div class="card h-100">
                                                                <div class="card-body text-center">
                                                                    <h6 class="card-title font-weight-bold">Project
                                                                        Screenshot</h6>
                                                                    <a href="{{ asset('public/upload/screenshot/' . $k->screenshot_image) }}"
                                                                        target="_blank">
                                                                        <img src="{{ asset('public/upload/screenshot/' . $k->screenshot_image) }}"
                                                                            class="img-fluid img-thumbnail"
                                                                            style="max-height: 200px;">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <div class="card h-100">
                                                                <div class="card-body">
                                                                    <h6 class="card-title font-weight-bold">Project Link
                                                                    </h6>
                                                                    <p class="card-text">
                                                                        <a href="{{ $k->project_link }}" target="_blank"
                                                                            class="btn btn-sm btn-primary">Click
                                                                            here</a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
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
</div>

<script>
function update_status(status, dev_id) {
    if (status !== '') {
        if (confirm('Are you sure you want to update status?')) {
            window.location.href = `/update-status/${dev_id}/${status}`;
        }
    }
}
</script>

@endsection