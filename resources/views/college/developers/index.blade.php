@extends('college.layout')
@section('content')

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('college.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Developers</li>
            </ol>
        </nav>
    </div>

    <div class="main-wrapper container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Developer List</h5>
                            <a href="{{ route('college.developers.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus mr-1"></i> Add New Developer
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Profile Complete</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($college_list as $developer)
                                        <tr>
                                            <td>{{ $developer->dev_id }}</td>
                                            <td>{{ $developer->name }}</td>
                                            <td>{{ $developer->email }}</td>
                                            <td>
                                                <span class="badge badge-{{ $developer->profile_complete == 'Yes' ? 'success' : 'warning' }}">
                                                    {{ $developer->profile_complete }}
                                                </span>
                                            </td>
                                            
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('college.developers.show', $developer->dev_id) }}" class="btn btn-sm btn-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4">
                                                <div class="empty-state">
                                                    <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                                                    <h5>No developers found</h5>
                                                    <p class="text-muted">You haven't registered any developers yet.</p>
                                                    <a href="{{ route('college.developers.create') }}" class="btn btn-primary mt-2">
                                                        <i class="fas fa-plus mr-1"></i> Add Your First Developer
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p class="text-muted">Showing {{ $college_list->firstItem() }} to {{ $college_list->lastItem() }} of {{ $college_list->total() }} entries</p>
                            </div>
                            <div class="col-md-6">
                                <nav class="float-right">
                                    {{ $college_list->appends(request()->query())->links() }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<style>
    .avatar-placeholder {
        background-color: #f8f9fa;
        color: #6c757d;
    }
    
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
        font-size: 0.85em;
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    
    .empty-state {
        padding: 2rem;
        text-align: center;
    }
    
    .btn-group .btn {
        padding: 0.25rem 0.5rem;
    }
</style>

<script>
    $(document).ready(function() {
        // Initialize tooltips
        $('[title]').tooltip();
        
        // Status toggle functionality
        
    });
</script>
@endsection