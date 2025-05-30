@extends('admin.layout')
@section('content')

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Banner</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                    @include('admin.flash')
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>Banner List</h4>
                            <button class="btn btn-primary btn-sm" onclick="openBannerModal()">+ Add Banner</button>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Heading</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detail as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->heading }}</td>
                                    <td><img src="{{ asset('public/upload/banner/'.$item->image) }}" height="70"></td>
                                    <td>
                                        <button class="btn btn-sm btn-success"
                                            onclick="editBanner({{ json_encode($item) }})">Edit</button>
                                        <a href="{{ url('delete_banner/'.$item->id) }}" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure want to delete this?')">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="bannerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ url('submit_banner') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="banner_id">
            <input type="hidden" name="old_image" id="old_image">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Banner</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Heading <span class="text-danger">*</span></label>
                        <input type="text" name="heading" id="heading" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Image <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control">
                        <div id="previewImage" class="mt-2"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function openBannerModal() {
    document.getElementById('modalTitle').innerText = 'Add Banner';
    document.getElementById('banner_id').value = '';
    document.getElementById('heading').value = '';
    document.getElementById('old_image').value = '';
    document.getElementById('previewImage').innerHTML = '';
    $('#bannerModal').modal('show');
}

function editBanner(banner) {
    document.getElementById('modalTitle').innerText = 'Edit Banner';
    document.getElementById('banner_id').value = banner.id;
    document.getElementById('heading').value = banner.heading;
    document.getElementById('old_image').value = banner.image;
    document.getElementById('previewImage').innerHTML = `<img src="public/upload/banner/${banner.image}" height="50">`;
    $('#bannerModal').modal('show');
}
</script>

@endsection