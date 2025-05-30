@extends('admin.layout')
@section('content')

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Contact</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <!-- Add Button -->
                        <div class="mb-3 text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addContactModal">
                                <i class="fa fa-plus"></i> Add Contact
                            </button>
                        </div>

                        <!-- Table -->
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white">Sl. No.</th>
                                    <th class="text-white">Address</th>
                                    <th class="text-white">Email ID</th>
                                    <th class="text-white">Contact No.</th>
                                    <th class="text-white" style="width:15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contact_details as $index => $cd)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $cd->address }}</td>
                                        <td>{{ $cd->email }}</td>
                                        <td>{{ $cd->phone }}</td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="javascript:void(0);" data-toggle="modal" data-target="#myeditModal{{ $cd->id }}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure To Delete This?')" href="{{ route('delete_add_contact', ['id' => $cd->id]) }}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal" id="myeditModal{{ $cd->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h4 class="modal-title text-white">Update Contact Details</h4>
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ route('update_add_contact') }}">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label>Enter Address</label>
                                                                    <input type="hidden" class="form-control rounded-0" name="update" value="{{ $cd->id }}" required>
                                                                    <input type="text" class="form-control rounded-0" name="address" value="{{ $cd->address }}" required>
                                                                    @error('address')
                                                                        <strong class="text-danger">{{ $message }}</strong>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label>Enter Email</label>
                                                                    <input type="hidden" class="form-control rounded-0" name="update" value="{{ $cd->id }}" required>
                                                                    <input type="email" class="form-control rounded-0" name="email" value="{{ $cd->email }}" required>
                                                                    @error('email')
                                                                        <strong class="text-danger">{{ $message }}</strong>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label>Enter Contact No.</label>
                                                                    <input type="hidden" class="form-control rounded-0" name="update" value="{{ $cd->id }}" required>
                                                                    <input type="text" class="form-control rounded-0" name="phone" value="{{ $cd->phone }}" required>
                                                                    @error('phone')
                                                                        <strong class="text-danger">{{ $message }}</strong>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-success btn-block">Update</button>
                                                                </div>
                                                            </div>
                                                        </div>
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

<!-- Add Contact Modal -->
<div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Add Contact</h5>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('submit_add_contact') }}">
                    @csrf

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control rounded-0" placeholder="Enter Address" name="address" required>
                                @error('address')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span> </label>
                                <input type="email" class="form-control rounded-0" placeholder="Enter Email" name="email" required>
                                @error('email')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Contact No. <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control rounded-0" placeholder="Enter Contact No." name="phone" required>
                                @error('phone')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Add Contact</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
