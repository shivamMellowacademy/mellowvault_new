@extends('admin.layout')
@section('content')


<div class="page-content" style="margin-top:100px">
    <div class="main-wrapper container">
        <div class="page-info d-flex justify-content-between align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">College</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </nav>
            <div class="page-actions">
                <a href="{{ route('admin.college.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New College
                </a>
            </div>
        </div>
        
        <!-- Rest of your content remains the same -->
        <div class="row">
            <div class="col-xl">
                <div class="row">
                    <div class="col-lg-12 ml-auto mr-auto">
                        @if(Session::has('success'))                 
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                <strong>{{Session::get('success')}}</strong>
                            </div>
                            {{Session::forget('message')}}
                            {{Session::forget('success')}}
                        @endif
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
            
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Name</th>
                                    <th>e-mail</th>
                                    <th>Count</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($college as $key => $collegeItem)
                                <tr>
                                    <td>{{ $key + 1 + ($college->currentPage() - 1) * $college->perPage() }}</td>
                                    <td>{{ $collegeItem->name }}</td>
                                    <td>{{ $collegeItem->email }}</td>
                                    <td>{{ $collegeItem->count }}</td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input status-toggle" 
                                                   id="status-{{ $collegeItem->id }}" 
                                                   data-id="{{ $collegeItem->id }}"
                                                   {{ $collegeItem->status ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="status-{{ $collegeItem->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.college.edit', $collegeItem->id) }}" 
                                               class="btn btn-sm btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.college.destroy', $collegeItem->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Are you sure you want to delete this college?')"
                                                        title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $college->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Status toggle functionality
    $('.status-toggle').change(function() {
        const collegeId = $(this).data('id');
        const isActive = $(this).is(':checked') ? 1 : 0;
        
        $.ajax({
            url: "{{ route('admin.college.status') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: collegeId,
                status: isActive
            },
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                    // Revert the toggle if failed
                    $('.status-toggle[data-id="' + collegeId + '"]').prop('checked', !isActive);
                }
            },
            error: function() {
                toastr.error('An error occurred. Please try again.');
                $('.status-toggle[data-id="' + collegeId + '"]').prop('checked', !isActive);
            }
        });
    });
});
</script>
@endpush