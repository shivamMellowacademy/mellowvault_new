@extends('admin.layout')
@section('content')
@include('admin.flash')
<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Blogs</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addBlogModal">
                                <i class="fa fa-plus"></i> Add Blog
                            </button>
                        </div>

                        <table id="complex-header" class="table table-striped table-bordered">
                            <thead class="bg-primary">
                                <tr>

                                    <th class="text-white">Heading</th>
                                    <th class="text-white">Description</th>
                                    <th class="text-white">Day</th>
                                    <th class="text-white">Month</th>
                                    <th class="text-white">Year</th>
                                    <th class="text-white">Image</th>
                                    <th class="text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blog_detail as $b)
                                @php
                                $split = str_split($b->description, 90);
                                $desc = $split[0].'...';
                                @endphp

                                <tr>
                                    <td>{{ $b->heading }}</td>
                                    <td>{!! $desc !!}</td>
                                    <td>{{ $b->day }}</td>
                                    <td>{{ $b->month }}</td>
                                    <td>{{ $b->year }}</td>
                                    <td>
                                        <img class="img-fluid img-thumbnail"
                                            src="{{ asset('public/upload/blog/'.$b->image) }}"
                                            style="height:80px; width: 80px;">
                                    </td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="javascript:void(0);" data-toggle="modal"
                                            data-target="#detailsModal{{ $b->id }}">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a class="btn btn-success btn-sm" href="javascript:void(0);" data-toggle="modal"
                                            data-target="#myeditModal{{ $b->id }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure to delete this?')"
                                            href="{{ route('delete_blog', ['id' => $b->id]) }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal" id="myeditModal{{ $b->id }}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h4 class="modal-title text-white">Update Blogs</h4>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('update_blog') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="update" value="{{ $b->id }}">

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Heading</label>
                                                                <input type="text" class="form-control rounded-0"
                                                                    name="heading" value="{{ $b->heading }}" required>
                                                                @error('heading')
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Day</label>
                                                                <input type="text" class="form-control rounded-0"
                                                                    name="day" value="{{ $b->day }}" required>
                                                                @error('day')
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Month</label>
                                                                <input type="text" class="form-control rounded-0"
                                                                    name="month" value="{{ $b->month }}" required>
                                                                @error('month')
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Year</label>
                                                                <input type="text" class="form-control rounded-0"
                                                                    name="year" value="{{ $b->year }}" required>
                                                                @error('year')
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="form-group bmd-form-group is-filled">
                                                                <label class="bmd-label-floating">Upload Image</label>
                                                                <input type="file" class="form-control rounded-0"
                                                                    name="image" accept="image/*">
                                                                <input type="hidden" name="existing_image"
                                                                    value="{{ $b->image }}">
                                                                <img class="img-fluid img-thumbnail"
                                                                    src="{{ asset('public/upload/blog/'.$b->image) }}"
                                                                    style="height:30px;width:40px;">
                                                                @error('image')
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter
                                                                    Description</label>
                                                                <textarea class="ckeditor" name="description"
                                                                    required>{{ $b->description }}</textarea>
                                                                @error('description')
                                                                <strong class="text-danger">{{ $message }}</strong>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <button type="submit"
                                                                    class="btn btn-success btn-block">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Details Modal -->
                                <div class="modal fade" id="detailsModal{{ $b->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="detailsModalLabel{{ $b->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info">
                                                <h5 class="modal-title text-white">Blog Details</h5>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col-sm-12">
                                                        <h5><strong>Heading:</strong> {{ $b->heading }}</h5>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <p><strong>Day:</strong> {{ $b->day }}</p>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <p><strong>Month:</strong> {{ $b->month }}</p>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <p><strong>Year:</strong> {{ $b->year }}</p>
                                                    </div>
                                                    <div class="col-sm-12 mb-3">
                                                        <strong>Image:</strong><br>
                                                        <img class="img-fluid img-thumbnail"
                                                            src="{{ asset('public/upload/blog/'.$b->image) }}"
                                                            style="height: 120px; width: 120px;">
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <strong>Description:</strong>
                                                        <div class="border p-3 rounded"
                                                            style="background-color: #f9f9f9;">
                                                            {!! $b->description !!}
                                                        </div>
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
<!-- Add Blog Modal -->
<div class="modal fade" id="addBlogModal" tabindex="-1" role="dialog" aria-labelledby="addBlogModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Add New Blog</h4>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form method="post" action="{{ route('submit_blog') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 mb-3">
                            <label>Heading <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0" placeholder="Heading" name="heading"
                                required>
                        </div>

                        <div class="col-sm-4 mb-3">
                            <label>Day <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0" placeholder="DD" name="day" required>
                        </div>

                        <div class="col-sm-4 mb-3">
                            <label>Month <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0" name="month" placeholder="MM" required>
                        </div>

                        <div class="col-sm-4 mb-3">
                            <label>Year <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0" name="year" placeholder="YYYY" required>
                        </div>

                        <div class="col-sm-12 mb-3">
                            <label>Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control rounded-0" name="image" accept="image/*" required>
                        </div>

                        <div class="col-sm-12 mb-3">
                            <label>Description <span class="text-danger">*</span></label>
                            <textarea class="ckeditor form-control rounded-0" name="description" required></textarea>
                        </div>

                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-success btn-block">Add Blog</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection