@extends('admin.layout')
@section('content')
@include('admin.flash')
<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Terms & Conditions</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>

    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <!-- Add Button -->
                        <div class="mb-3 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addTermModal">
                                <i class="fa fa-plus"></i> Add Terms & Conditions
                            </button>
                        </div>

                        <!-- Table -->
                        <table id="complex-header" class="table table-striped table-bordered">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white">Sl. No.</th>
                                    <th class="text-white">Heading</th>
                                    <th class="text-white">Description</th>
                                    <th style="width: 20%; color: white;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($term_condition as $index => $tc)
                                @php
                                $split = str_split($tc->description, 120);
                                $desc = $split[0].'...';
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $tc->heading }}</td>
                                    <td>{!! $desc !!}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="javascript:void(0);" data-toggle="modal"
                                            data-target="#detailsModal{{ $tc->id }}"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-success btn-sm" href="javascript:void(0);" data-toggle="modal"
                                            data-target="#myeditModal{{ $tc->id }}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are You Sure To Delete This?')"
                                            href="{{ route('delete_term_condition', ['id' => $tc->id]) }}"><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="myeditModal{{ $tc->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="editModalLabel{{ $tc->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h4 class="modal-title text-white">Update Terms & Conditions</h4>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('update_term_condition') }}">
                                                    @csrf
                                                    <input type="hidden" name="update" value="{{ $tc->id }}">

                                                    <div class="form-group">
                                                        <label>Enter Heading <span class="text-danger">*</span></label>
                                                        <input type="text" name="heading" value="{{ $tc->heading }}"
                                                            class="form-control" required>
                                                        @if ($errors->has('heading'))
                                                        <strong
                                                            class="text-danger">{{ $errors->first('heading') }}</strong>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Enter Description <span
                                                                class="text-danger">*</span></label>
                                                        <textarea name="description" class="form-control ckeditor"
                                                            required>{{ $tc->description }}</textarea>
                                                        @if ($errors->has('description'))
                                                        <strong
                                                            class="text-danger">{{ $errors->first('description') }}</strong>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit"
                                                            class="btn btn-success btn-block">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Details Modal -->
                                <div class="modal fade" id="detailsModal{{ $tc->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info">
                                                <h4 class="modal-title text-white">Privacy Policy Details</h4>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <h5><strong>Heading:</strong></h5>
                                                <p>{{ $tc->heading }}</p>

                                                <h5><strong>Description:</strong></h5>
                                                <div class="border p-3" style="background-color: #f9f9f9;">
                                                    {!! $tc->description !!}
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

<!-- Add Terms & Conditions Modal -->
<div class="modal fade" id="addTermModal" tabindex="-1" role="dialog" aria-labelledby="addTermModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Add Terms & Conditions</h5>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('submit_term_condition') }}">
                    @csrf

                    <div class="form-group">
                        <label>Heading <span class="text-danger">*</span></label>
                        <input type="text" name="heading" placeholder="Enter Heading" class="form-control" required>
                        @if ($errors->has('heading'))
                        <strong class="text-danger">{{ $errors->first('heading') }}</strong>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Description <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control ckeditor" placeholder="Enter Description" required></textarea>
                        @if ($errors->has('description'))
                        <strong class="text-danger">{{ $errors->first('description') }}</strong>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Add Terms & Conditions</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
$(document).ready(function() {
    CKEDITOR.replaceAll('ckeditor');
});
</script>
@endpush

@endsection