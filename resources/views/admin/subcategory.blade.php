@extends('admin.layout')

@section('content')
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
@include('admin.flash')
<style>
.form-group label {
    font-weight: 600;
}

.modal-title {
    font-weight: 700;
}

.img-thumbnail {
    border: 1px solid #ccc;
    padding: 3px;
}

.form-control,
.custom-select {
    border-radius: 0.4rem;
}
</style>
<br>
<div class="container-fluid mt-4">
    <div class="card shadow rounded">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Sub Category List</h4>
            <div class="d-flex align-items-center">
                <!-- Search box -->
                <input type="text" id="searchInput" class="form-control form-control-sm mr-3 searchInput" placeholder="Search...">

                <!-- Add new button -->
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addSubCategoryModal">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="subcategoryTable" class="table table-striped table-bordered">
                    <thead style="background-color: #3646C9;">
                        <tr>
                            <th class="text-white">#</th>
                            <th class="text-white">Heading</th>
                            <th class="text-white">Name</th>
                            <th class="text-white">Category Name</th>
                            <th class="text-white">Image</th>
                            <th class="text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subcategory as $index => $subcat)
                        @php
                        $cat = DB::table('category_tb')->where('id', $subcat->category_id)->first();
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $subcat->heading }}</td>
                            <td>{{ $subcat->name }}</td>
                            <td>{{ $cat->name ?? 'Na' }}</td>
                            <td>
                                <img src="{{ asset('public/upload/subcategory/' . $subcat->image) }}"
                                    class="img-thumbnail" style="height: 60px;">
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#editModal{{ $subcat->id }}">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <a href="{{ route('delete_subcategory', $subcat->id) }}" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this?')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $subcat->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('update_subcategory') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="update" value="{{ $subcat->id }}">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Sub Category</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Heading</label>
                                                    <input type="text" class="form-control" name="heading"
                                                        value="{{ $subcat->heading }}" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ $subcat->name }}" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Category</label>
                                                    <select name="category_id" class="form-control" required>
                                                        <option value="">Select</option>
                                                        @foreach($category as $cat)
                                                        <option value="{{ $cat->id }}"
                                                            {{ $subcat->category_id == $cat->id ? 'selected' : '' }}>
                                                            {{ $cat->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Image</label>
                                                    <input type="file" name="image" class="form-control">
                                                    <input type="hidden" name="old_image" value="{{ $subcat->image }}">
                                                    <img src="{{ asset('public/upload/subcategory/' . $subcat->image) }}"
                                                        class="img-thumbnail mt-2" style="height: 60px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $subcategory->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addSubCategoryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('submit_subcategory') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Sub Category</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Heading</label>
                            <input type="text" name="heading" class="form-control" placeholder="Enter heading" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Category</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">Select</option>
                                @foreach($category as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add Sub Category</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('.searchInput').on('keyup', function() {
        var query = $(this).val();
        console.log("Search query:", query);  // Debugging line to check if the function is triggered

        $.ajax({
            url: "{{ route('search_subcategory') }}", // Ensure this route is correct
            type: 'GET',
            data: { search: query },
            success: function(response) {
                console.log("AJAX Success:", response);  // Debugging line to check if the response is correct
                $('#subcategoryTable tbody').html(response);
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error:", error);  // Debugging line to check if there are any errors
            }
        });
    });
});


</script>
@endsection