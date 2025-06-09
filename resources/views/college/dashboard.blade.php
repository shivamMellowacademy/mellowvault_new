@extends('college.layout')
@section('content')

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('college.dashboard') }}">College</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>

    <div class="main-wrapper container">
        <!-- Welcome Header -->
        <div class="row mb-4">
            <div class="col">
                <div class="card welcome-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            @if(session('college_logo'))
                            <div class="avatar avatar-lg me-3">
                                <img src="{{ asset('storage/'.session('college_logo')) }}" 
                                     alt="College Logo" class="avatar-img rounded-circle">
                            </div>
                            @endif
                            <div>
                                <h2 class="mb-1">Welcome, {{ session('college_name') }}</h2>
                                <p class="text-muted mb-0 text-light">
                                    <i class="fas fa-clock me-1"></i> Last login: 
                                    @if(session('last_login_at'))
                                        {{ \Carbon\Carbon::parse(session('last_login_at'))->format('d M Y') }}
                                    @else
                                        First login
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <!-- Total Developers Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Developers</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count }}</div>
                                <small class="text-muted">Registered in system</small>
                            </div>
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-users text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Remaining Developers Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-{{ ($college->count - $count) > 0 ? 'success' : 'danger' }} shadow h-100 py-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Remaining Capacity</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $college->count - $count }} / {{ $college->count }}
                                    @if(($college->count - $count) <= 0)
                                        <span class="badge badge-danger ml-2">Full</span>
                                    @endif
                                </div>
                                <small class="text-muted">Seats available</small>
                            </div>
                            <div class="icon-circle bg-{{ ($college->count - $count) > 0 ? 'success' : 'danger' }}">
                                <i class="fas fa-code text-white"></i>
                            </div>
                        </div>
                        @if(($college->count - $count) > 0)
                            <div class="mt-2">
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-{{ ($count/$college->count)*100 > 75 ? 'warning' : 'success' }}" 
                                        role="progressbar" 
                                        style="width: {{ ($count/$college->count)*100 }}%"
                                        aria-valuenow="{{ $count }}" 
                                        aria-valuemin="0" 
                                        aria-valuemax="{{ $college->count }}">
                                    </div>
                                </div>
                                <small class="text-muted">{{ number_format(($count/$college->count)*100, 1) }}% filled</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Active Developers Card -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Active Developers</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $active_count ?? 0 }}
                                </div>
                                <small class="text-muted">Currently active</small>
                            </div>
                            <div class="icon-circle bg-info">
                                <i class="fas fa-user-check text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Profile Completion Card -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Complete Profiles</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $complete_profiles ?? 0 }}
                                </div>
                                <small class="text-muted">Fully completed</small>
                            </div>
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-clipboard-check text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

        <!-- Recent Students Table -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Recently Added Developers</h6>
                        <a href="{{ route('college.developers.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-list mr-1"></i> View All
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Profile Status</th>
                                        <th>Account Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($college_list as $student)
                                        <tr>
                                            <td>{{ $student->dev_id }}</td>
                                            <td>{{ $student->name ?? 'N/A' }}</td>
                                            <td>{{ $student->email ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge badge-{{ $student->profile_complete == 'Yes' ? 'success' : 'warning' }}">
                                                    {{ $student->profile_complete ?? 'Incomplete' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $student->developer_status == 'active' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($student->developer_status ?? 'inactive') }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('college.developers.show', $student->dev_id) }}" 
                                                   class="btn btn-sm btn-info"
                                                   title="View Details"
                                                   data-toggle="tooltip">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">
                                                <i class="fas fa-user-slash fa-2x mb-2"></i>
                                                <p>No developers found</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .welcome-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
    }
    
    .icon-circle {
        height: 50px;
        width: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }
    
    .card:hover .icon-circle {
        transform: scale(1.1);
    }
    
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    
    .avatar-img {
        object-fit: cover;
        border: 3px solid white;
    }
</style>

<script>
    $(document).ready(function() {
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
        
        // Add animation to cards on load
        $('.card').each(function(i) {
            $(this).delay(i * 150).animate({ opacity: 1 }, 300);
        }).css('opacity', 0);
        
        // Update dashboard every 60 seconds
       
    });
</script>

@endsection
