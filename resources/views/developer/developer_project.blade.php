@extends('developer.layout')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Developer Project</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>

    <div class="main-wrapper container">
        <div class="mb-3">
            <button type="button" class="btn btn-primary" onclick="openProjectModal()">Add Project Details</button>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sl. No.</th>
                            <th>Screenshot</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($developer_project_Details as $index => $dev_project)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <a href="{{ asset('public/upload/screenshot/'.$dev_project->screenshot_image) }}" target="_blank">
                                    <img src="{{ asset('public/upload/screenshot/'.$dev_project->screenshot_image) }}" class="img-fluid img-thumbnail" style="height:80px;width:80px;">
                                </a>
                            </td>
                            <td><strong>Project Link:👉 </strong> <a href="{{ $dev_project->project_link }}" target="_blank" title="{{ $dev_project->project_link }}">Click Here</a></td>
                            <td>
                                <button class="btn btn-success btn-sm editProjectBtn" data-project='@json($dev_project)'>
                                    <i class="fa fa-edit"></i>
                                </button>
                                <a class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure To Delete This?')" href="{{ route('delete_project_details', ['developer_id' => $dev_project->id]) }}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Single Add/Edit Modal -->
<div class="modal fade" id="projectModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form id="projectForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="update" id="updateId">
            <input type="hidden" name="old_screenshot_image" id="oldScreenshotImage">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Project Details</h5>
                    <button type="button" class="close btn btn-danger btn-sm" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Choose Screenshot Image <span class="text-danger">*</span></label>
                        <input type="file" name="screenshot_image" class="form-control" accept="image/*" id="screenshotInput">
                        <span class="text-danger error-text screenshot_image_error"></span>
                    </div>
                    <!-- Preview Area for Old Image -->
                    <div id="screenshotPreview" class="mt-2" style="display: none;">
                        <label>Old Screenshot Preview:</label><br>
                        <img id="previewImg" src="" class="img-fluid img-thumbnail" style="height: 100px; width: 100px;">
                    </div>
                    <div class="form-group">
                        <label>Project Link <span class="text-danger">*</span></label>
                        <input type="url" name="project_link" class="form-control" placeholder="Enter project link" id="projectLink">
                        <span class="text-danger error-text project_link_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Project</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if (session('message') === 'success')
        toastr.success("{{ session('devProjecterrmsg') }}");
    @elseif (session('message') === 'danger')
        toastr.error("{{ session('devProjecterrmsg') }}");
    @endif
</script>

<script>
    const baseScreenshotUrl = "{{ asset('public/upload/screenshot') }}";
    function openProjectModal(project = null) {
        $('#projectForm')[0].reset();
        $('.error-text').text('');
        $('#modalTitle').text('Add Project Details');
        $('#updateId').val('');
        $('#oldScreenshotImage').val('');
        $('#projectLink').val('');

        if (project) {
            $('#modalTitle').text('Update Project Details');
            $('#updateId').val(project.id);
            $('#projectLink').val(project.project_link);
            $('#oldScreenshotImage').val(project.screenshot_image);
            if (project.screenshot_image) {
            $('#screenshotPreview').show();
            $('#previewImg').attr('src', `${baseScreenshotUrl}/${project.screenshot_image}`);
        }
        }

        $('#projectModal').modal('show');
    }

    // Open modal with project data on edit button click
    $(document).on('click', '.editProjectBtn', function () {
        let project = $(this).data('project');
        console.log(project);
        openProjectModal(project);
    });

    // Submit form via AJAX
    $('#projectForm').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $('.error-text').text('');

        $.ajax({
            url: "{{ route('storeOrUpdateProjectDetails') }}",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status === 'success') {
                    $('#projectModal').modal('hide');
                    toastr.success(response.message);
                    setTimeout(() => location.reload(), 1500);
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $('.' + key + '_error').text(value[0]);
                    });
                } else {
                    toastr.error("Something went wrong. Please try again.");
                }
            }
        });
    });

     // Live preview of selected screenshot
     $('#screenshotInput').on('change', function () {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#screenshotPreview').show();
                $('#previewImg').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        } else {
            $('#screenshotPreview').hide();
            $('#previewImg').attr('src', '');
        }
    });
</script>

@endsection
