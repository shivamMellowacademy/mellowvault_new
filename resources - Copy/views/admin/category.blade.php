@extends('admin.layout')

@section('content')
<br>
<br>
<div class="container">
    <h2 class="mt-4">Manage Categories</h2>
	@include('admin.flash')
    <!-- Search and Add -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <input type="text" id="searchInput" class="form-control w-50" placeholder="Search by Title or Category Name">
        <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#addCategoryModal">
            <i class="fa fa-plus"></i> Add Category
        </button>
    </div>

    <!-- Category Table -->
    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover" id="categoryTable">
                <thead style="background-color: #3646C9; color: white;">
                    <tr class="text-white">
                        <th class="text-white">#</th>
                        <th class="text-white">Title</th>
                        <th class="text-white">Category Name</th>
                        <th class="text-white">Category Image</th>
                        <th class="text-white">Details Images</th>
                        <th class="text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $index => $c)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $c->title }}</td>
                        <td>{{ $c->name }}</td>
                        <td>
                            <img src="{{ asset('public/upload/category/' . $c->image) }}" width="50" height="50" alt="Category">
                        </td>
                        <td>
                            @php
                            $img = $c->multiple_image;
                            $multipleImages = explode(',', $img);
                            @endphp
                            @if($multipleImages)
                            @foreach($multipleImages as $img)
                            <img src="{{ asset('public/upload/category/' . $img) }}" width="50" height="50" class="mr-1 mb-1">
                            @endforeach
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editCategoryModal{{ $c->id }}">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                        </td>
                    </tr>

                    <!-- Edit Category Modal -->
                    <div class="modal fade" id="editCategoryModal{{ $c->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="editCategoryModalLabel{{ $c->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <form action="{{ route('update_category') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $c->id }}">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Category</h5>
                                        <button type="button" class="close btn btn-danger btn-sm" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Title <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="title" value="{{ $c->title }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Category Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" value="{{ $c->name }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Category Image</label>
                                                <input type="file" class="form-control" name="image" accept="image/*">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Category Details Images</label>
                                                <input type="file" class="form-control" name="multiple_image[]" multiple accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('submit_category') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Category</h5>
                        <button type="button" class="close btn btn-danger btn-sm" data-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" placeholder="Enter Title" required>
                                @error('title') <strong class="text-danger">{{ $message }}</strong> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Category Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Category Name" required>
                                @error('name') <strong class="text-danger">{{ $message }}</strong> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Category Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="image" accept="image/*" required>
                                @error('image') <strong class="text-danger">{{ $message }}</strong> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Category Details Images <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="multiple_image[]" multiple accept="image/*" required>
                                @error('multiple_image') <strong class="text-danger">{{ $message }}</strong> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<!-- JavaScript for Search -->
<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        var input = this.value.toLowerCase();
        var rows = document.querySelectorAll("#categoryTable tbody tr");

        rows.forEach(function (row) {
            var title = row.cells[1].textContent.toLowerCase();
            var category = row.cells[2].textContent.toLowerCase();
            row.style.display = (title.includes(input) || category.includes(input)) ? "" : "none";
        });
    });
</script>
@endsection
