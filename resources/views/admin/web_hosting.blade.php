@extends('admin.layout')
@section('content')
@include('admin.flash')
<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Web Hosting</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="card-title">Web Hosting List</h5>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addHostingModal">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <table id="complex-header" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Hosting Name</th>
                                    <th>Hosting Price</th>
                                    <th>Features</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach($web_hosting as $pp)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $pp->hostingname }}</td>
                                        <td>{{ $pp->hostingprice }}</td>
                                        <td>{!! \Illuminate\Support\Str::limit(strip_tags($pp->feature), 60, '...') !!}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewModal{{ $pp->id }}"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal{{ $pp->id }}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure To Delete This?')" href="{{ route('delete_web_hosting', ['id' => $pp->id]) }}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    <!-- View Detail Modal -->
                                    <div class="modal fade" id="viewModal{{ $pp->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title text-white">Hosting Details</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Hosting Name:</strong> {{ $pp->hostingname }}</p>
                                                    <p><strong>Hosting Price:</strong> {{ $pp->hostingprice }}</p>
                                                    <p><strong>Features:</strong></p>
                                                    <div>{!! $pp->feature !!}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $pp->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title text-white">Update Web Hosting</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ route('update_web_hosting') }}">
                                                        @csrf
                                                        <input type="hidden" name="update" value="{{ $pp->id }}">
                                                        <div class="form-group">
                                                            <label>Hosting Name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="hostingname" value="{{ $pp->hostingname }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Hosting Price <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="hostingprice" value="{{ $pp->hostingprice }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Features</label>
                                                            <textarea class="form-control ckeditor" name="feature" rows="5">{{ $pp->feature }}</textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-success">Update</button>
                                                    </form>
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

<!-- Add Hosting Modal -->
<div class="modal fade" id="addHostingModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white">Add Web Hosting</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('submit_web_hosting') }}">
                    @csrf
                    <div class="form-group">
                        <label>Hosting Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="hostingname" placeholder="Enter Hosting name" required>
                    </div>
                    <div class="form-group">
                        <label>Hosting Price <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="hostingprice" placeholder="Enter Hosting price" required>
                    </div>
                    <div class="form-group">
                        <label>Features</label>
                        <textarea class="form-control ckeditor" name="feature" placeholder="Enter Features" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Web Hosting</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
