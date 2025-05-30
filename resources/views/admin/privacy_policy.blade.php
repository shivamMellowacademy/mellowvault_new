@extends('admin.layout')
@section('content')
@include('admin.flash')
<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Privacy Policy</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>

    <div class="main-wrapper container">
        <div class="row mb-3">
            <div class="col text-right">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addPolicyModal"><i
                        class="fa fa-plus"></i> Add Privacy Policy</button>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table id="complex-header" class="table table-striped table-bordered">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white">Sl. No.</th>
                                    <th class="text-white">Heading</th>
                                    <th class="text-white">Description</th>
                                    <th class="text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($privacy_policy as $index => $pp)
                                @php
                                $split = str_split($pp->description, 60);
                                $desc = $split[0].'...';
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pp->heading }}</td>
                                    <td>{!! $desc !!}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="javascript:void(0);" data-toggle="modal"
                                            data-target="#detailsModal{{ $pp->id }}"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-success btn-sm" href="javascript:void(0);" data-toggle="modal"
                                            data-target="#editModal{{ $pp->id }}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure to delete this?')"
                                            href="{{ route('delete_privacy_policy', ['id' => $pp->id]) }}"><i
                                                class="fa fa-trash"></i></a>
                                    </td>

                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $pp->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h4 class="modal-title text-white">Update Privacy Policy</h4>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('update_privacy_policy') }}">
                                                    @csrf
                                                    <input type="hidden" name="update" value="{{ $pp->id }}">
                                                    <div class="form-group">
                                                        <label>Enter Heading</label>
                                                        <input type="text" class="form-control" name="heading"
                                                            value="{{ $pp->heading }}" required>
                                                        @error('heading')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Enter Description</label>
                                                        <textarea class="ckeditor form-control" name="description"
                                                            required>{{ $pp->description }}</textarea>
                                                        @error('description')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Details Modal -->
                                <div class="modal fade" id="detailsModal{{ $pp->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info">
                                                <h4 class="modal-title text-white">Privacy Policy Details</h4>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <h5><strong>Heading:</strong></h5>
                                                <p>{{ $pp->heading }}</p>

                                                <h5><strong>Description:</strong></h5>
                                                <div class="border p-3" style="background-color: #f9f9f9;">
                                                    {!! $pp->description !!}
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

<!-- Add Modal -->
<div class="modal fade" id="addPolicyModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Add Privacy Policy</h4>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('submit_privacy_policy') }}">
                    @csrf
                    <div class="form-group">
                        <label>Enter Heading</label>
                        <input type="text" class="form-control" name="heading" required>
                        @error('heading')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Enter Description</label>
                        <textarea class="ckeditor form-control" name="description" required></textarea>
                        @error('description')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add Policy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection