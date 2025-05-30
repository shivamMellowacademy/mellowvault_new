@extends('admin.layout')
@section('content')
@include('admin.flash')
<div class="page-content">
    <div class="main-wrapper container">
        <!-- Breadcrumb -->
        <div class="page-info">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">All Project Details</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </nav>
        </div>

        <!-- Add Button -->
        <div class="row mb-3">
            <div class="col text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProjectModal">
                    <i class="fa fa-plus"></i> Add Project
                </button>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card">
            <div class="card-body">
                <table id="complex-header" class="table table-striped table-bordered">
                    <thead class="bg-primary">
                        <tr>
                            <th class="text-white">Sl. No.</th>
                            <th class="text-white">Developer Name</th>
                            <th class="text-white">Image</th>
                            <th class="text-white">Project Link</th>
                            <th class="text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($developer_project_details as $s)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $s->name }}</td>
                            <td>
                                <img class="img-fluid img-thumbnail"
                                    src="{{ asset('public/upload/screenshot/' . $s->screenshot_image) }}"
                                    style="height:80px; width: 80px;">
                            </td>
                            <td><a href="{{ $s->project_link }}">Click Here</a></td>
                            <td>
                                <a class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#myeditModal{{ $s->id }}"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are You Sure To Delete This Details?')"
                                    href="{{ route('delete_developer_project_details', ['developer_id' => $s->developer_id]) }}"><i
                                        class="fa fa-trash"></i></a>
                            </td>
                        </tr>

                        <!-- Edit Project Modal -->
                        <div class="modal fade" id="myeditModal{{ $s->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="editProjectLabel{{ $s->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <form method="post" action="{{ route('update_developer_project_details') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="update" value="{{ $s->id }}">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title text-white" id="editProjectLabel{{ $s->id }}"><i
                                                    class="fa fa-edit"></i> Edit Project</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal"
                                                aria-label="Close">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Choose Developer</label>
                                                <select name="developer_id" class="form-control">
                                                    <option value="#">-- Select --</option>
                                                    @foreach($all_developer_details as $ad)
                                                    <option value="{{ $ad->dev_id }}"
                                                        {{ $s->developer_id == $ad->dev_id ? 'selected' : '' }}>
                                                        {{ $ad->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Project Link</label>
                                                <input type="url" name="project_link" class="form-control"
                                                    value="{{ $s->project_link }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Screenshot Image</label>
                                                <input type="file" name="screenshot_image" class="form-control-file"
                                                    accept="image/*">
                                                <input type="hidden" name="old_screenshot_image"
                                                    value="{{ $s->screenshot_image }}">
                                                <div class="mt-2">
                                                    <img src="{{ asset('public/upload/screenshot/' . $s->screenshot_image) }}"
                                                        class="img-thumbnail" style="height: 60px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success w-100">
                                                <i class="fa fa-save"></i> Update Project
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Project Modal -->
        <div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="addProjectLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form method="post" action="{{ route('submit_developer_project_details') }}"
                    enctype="multipart/form-data" class="w-100">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title text-white" id="addProjectLabel"><i class="fa fa-plus-circle"></i> Add New
                                Project</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="font-weight-bold">Choose Developer <span
                                        class="text-danger">*</span></label>
                                <select name="developer_id" class="form-control" required>
                                    <option value="">-- Select Developer --</option>
                                    @foreach($all_developer_details as $ad)
                                    <option value="{{ $ad->dev_id }}">{{ $ad->name }}</option>
                                    @endforeach
                                </select>
                                @error('developer_id')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Project Link <span class="text-danger">*</span></label>
                                <input type="url" name="project_link" class="form-control"
                                    placeholder="https://example.com/project" required>
                                @error('project_link')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Screenshot Image <span
                                        class="text-danger">*</span></label>
                                <input type="file" name="screenshot_image" class="form-control-file" accept="image/*"
                                    required>
                                @error('screenshot_image')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fa fa-save"></i> Save Project
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
</div>

@endsection