@extends('admin.layout')
@section('content')
@include('admin.flash')
<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Refund Policy</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <div class="mb-3 text-right">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal">
                                <i class="fa fa-plus"></i> Add Refund Policy
                            </button>
                        </div>

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
                                @foreach($refund_policy as $index => $pp)
                                @php
                                $split = str_split($pp->description, 90);
                                $desc = $split[0].'...';
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pp->heading }}</td>
                                    <td>{!! $desc !!}</td>
                                    <td>
                                        <a class="btn btn-success btn-sm" href="javascript:void(0);" data-toggle="modal" data-target="#myeditModal{{ $pp->id }}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure To Delete This?')" href="{{ route('delete_refund', ['id' => $pp->id]) }}"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal" id="myeditModal{{ $pp->id }}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h4 class="modal-title text-white">Update Refund Policy</h4>
                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('update_refund') }}">
                                                    @csrf
                                                    <input type="hidden" name="update" value="{{ $pp->id }}">
                                                    <div class="form-group">
                                                        <label>Heading</label>
                                                        <input type="text" class="form-control" name="heading" value="{{ $pp->heading }}" required>
                                                        @error('heading')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea class="ckeditor form-control" name="description" required>{{ $pp->description }}</textarea>
                                                        @error('description')
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                        @enderror
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

                        <!-- Add Modal -->
                        <div class="modal" id="addModal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h4 class="modal-title text-white">Add Refund Policy</h4>
                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('submit_refund') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label>Heading</label>
                                                <input type="text" class="form-control" placeholder="Enter Heading" name="heading" required>
                                                @error('heading')
                                                <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="ckeditor form-control" name="description" required></textarea>
                                                @error('description')
                                                <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </div> <!-- /.main-wrapper -->
</div> <!-- /.page-content -->

@endsection
