@extends('admin.layout')
@section('content')
@include('admin.flash')
<div class="page-content" style="padding-top:30px;">
    <div class="main-wrapper container">
        <!-- Add Button -->
        <div class="row mb-3">
            <div class="col text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addHigProfModal">
                    + Add Higher Professional
                </button>
            </div>
        </div>

        <!-- Data Table -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Higher Professional Details</h5>
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white">Sl. No.</th>
                                    <th class="text-white">Heading</th>
                                    <th class="text-white">Image</th>
                                    <th class="text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach($higher_professional as $hp)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $hp->heading }}</td>
                                        <td><img src="{{ asset('public/upload/hig_prof/' . $hp->image) }}" class="img-fluid img-thumbnail" style="height:80px;"></td>
                                        <td>
                                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#myeditModal{{ $hp->id }}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure To Delete This?')" href="{{ route('delete_hig_prof', ['id' => $hp->id]) }}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="myeditModal{{ $hp->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $hp->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title text-white" id="editModalLabel{{ $hp->id }}">Edit Higher Professional</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="{{ route('update_hig_prof') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label>Heading</label>
                                                                <input type="hidden" name="update" value="{{ $hp->id }}">
                                                                <input type="text" class="form-control" name="heading" value="{{ $hp->heading }}" required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Image</label>
                                                                <input type="file" class="form-control" name="image" accept="image/*">
                                                                <input type="hidden" name="old_image" value="{{ $hp->image }}">
                                                                <img src="{{ asset('public/upload/hig_prof/' . $hp->image) }}" class="img-fluid img-thumbnail mt-2" style="height:40px; width:50px;">
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
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addHigProfModal" tabindex="-1" role="dialog" aria-labelledby="addHigProfLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="addHigProfLabel">Add Higher Professional Details</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('submit_hig_prof') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="heading">Heading <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="heading" id="heading" placeholder="Enter Heading" required>
                            @if ($errors->has('heading'))
                                <small class="text-danger">{{ $errors->first('heading') }}</small>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="image">Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="image" id="image" accept="image/*" required>
                            @if ($errors->has('image'))
                                <small class="text-danger">{{ $errors->first('image') }}</small>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add Details</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
