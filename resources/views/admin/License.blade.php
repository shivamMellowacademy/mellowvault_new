@extends('admin.layout')
@section('content')

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-2">
                <li class="breadcrumb-item"><a href="#">ALL COMMERCIAL LICENSE</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>

    @include('admin.flash')

    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addLicenseModal">
                                <i class="fa fa-plus"></i> <span style="color: #FFFFFF;">Add Commercial License</span>
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table id="complex-header" class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Heading</th>
                                        <th>Description</th>
                                        <th width="150">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach($License as $lic)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $lic->heading }}</td>
                                        <td>{!! Str::limit($lic->description, 100) !!}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewLicenseModal{{ $lic->id }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#myeditModal{{ $lic->id }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure To Delete This?')" href="{{ route('delete_License', ['id' => $lic->id]) }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="myeditModal{{ $lic->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content shadow">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title text-white">Update Commercial License</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ route('update_License') }}">
                                                        @csrf
                                                        <input type="hidden" name="update" value="{{ $lic->id }}">
                                                        <div class="form-group">
                                                            <label>Heading <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="heading" value="{{ $lic->heading }}" required>
                                                            @error('heading') <small class="text-danger">{{ $message }}</small> @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description <span class="text-danger">*</span></label>
                                                            <textarea class="ckeditor form-control" name="description" required>{{ $lic->description }}</textarea>
                                                            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                                                        </div>
                                                        <button type="submit" class="btn btn-success">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- View Modal -->
                                    <div class="modal fade" id="viewLicenseModal{{ $lic->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content shadow">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title text-white">License Details</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label><strong>Heading:</strong></label>
                                                        <input type="text" class="form-control" value="{{ $lic->heading }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label><strong>Description:</strong></label>
                                                        <div class="border p-3 rounded" style="min-height: 150px;">
                                                            {!! $lic->description !!}
                                                        </div>
                                                    </div>
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

<!-- Add License Modal -->
<div class="modal fade" id="addLicenseModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content shadow">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Add Commercial License</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('submit_License') }}">
                    @csrf
                    <div class="form-group">
                        <label>Heading <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="heading" placeholder="Enter Heading" required>
                        @error('heading') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label>Description <span class="text-danger">*</span></label>
                        <textarea class="ckeditor form-control" name="description" rows="5" required></textarea>
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Add License</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- CKEditor Script -->
@push('scripts')
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
    $('#addLicenseModal, .modal').on('shown.bs.modal', function() {
        $(this).find('.ckeditor').each(function() {
            if (!this.id) this.id = 'ckeditor_' + Math.floor(Math.random() * 100000);
            if (!CKEDITOR.instances[this.id]) {
                CKEDITOR.replace(this.id);
            }
        });
    });
</script>
@endpush

@endsection
