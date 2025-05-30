@extends('admin.layout')
@section('content')

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light px-3 py-2 rounded">
                <li class="breadcrumb-item"><a href="#">Web Setting</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>

    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Web Settings</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="thead-green">
                                <tr>
                                    <th>Facebook</th>
                                    <th>Instagram</th>
                                    <th>LinkedIn</th>
                                    <th>Twitter</th>
                                    <th>Header Logo</th>
                                    <th>Footer Logo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($web_detail as $web)
                                <tr>
                                    <td><a href="{{ $web->fb }}" target="_blank">Click here</a></td>
                                    <td><a href="{{ $web->insta }}" target="_blank">Click here</a></td>
                                    <td><a href="{{ $web->linkedin }}" target="_blank">Click here</a></td>
                                    <td><a href="{{ $web->twitter }}" target="_blank">Click here</a></td>
                                    <td><img src="{{ asset('public/upload/header/'.$web->header_logo) }}"
                                            class="img-thumbnail" style="height:60px;"></td>
                                    <td><img src="{{ asset('public/upload/footer/'.$web->footer_logo) }}"
                                            class="img-thumbnail" style="height:60px;"></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                            data-target="#editModal{{ $web->id }}"><i class="fa fa-edit"></i>
                                            Edit</button>
                                    </td>
                                </tr>


                                <!-- Modal -->
                                <div class="modal fade" id="editModal{{ $web->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $web->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info text-white">
                                                <h5 class="modal-title" id="editModalLabel{{ $web->id }}">Update Web
                                                    Setting</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('update_web_setting') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="update" value="{{ $web->id }}">
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label>Facebook Link</label>
                                                            <input type="url" class="form-control" name="fb"
                                                                value="{{ $web->fb }}" required>
                                                            @error('fb') <small
                                                                class="text-danger">{{ $message }}</small> @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Instagram Link</label>
                                                            <input type="url" class="form-control" name="insta"
                                                                value="{{ $web->insta }}" required>
                                                            @error('insta') <small
                                                                class="text-danger">{{ $message }}</small> @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>LinkedIn Link</label>
                                                            <input type="url" class="form-control" name="linkedin"
                                                                value="{{ $web->linkedin }}" required>
                                                            @error('linkedin') <small
                                                                class="text-danger">{{ $message }}</small> @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Twitter Link</label>
                                                            <input type="url" class="form-control" name="twitter"
                                                                value="{{ $web->twitter }}" required>
                                                            @error('twitter') <small
                                                                class="text-danger">{{ $message }}</small> @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Header Logo</label>
                                                            <input type="file" class="form-control" name="header_logo"
                                                                accept="image/*">
                                                            <input type="hidden" name="old_header_logo"
                                                                value="{{ $web->header_logo }}">
                                                            <div class="mt-2">
                                                                <img src="{{ asset('public/upload/header/'.$web->header_logo) }}"
                                                                    class="img-thumbnail"
                                                                    style="height:40px;width:60px;">
                                                            </div>
                                                            @error('header_logo') <small
                                                                class="text-danger">{{ $message }}</small> @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Footer Logo</label>
                                                            <input type="file" class="form-control" name="footer_logo"
                                                                accept="image/*">
                                                            <input type="hidden" name="old_footer_logo"
                                                                value="{{ $web->footer_logo }}">
                                                            <div class="mt-2">
                                                                <img src="{{ asset('public/upload/footer/'.$web->footer_logo) }}"
                                                                    class="img-thumbnail"
                                                                    style="height:40px;width:60px;">
                                                            </div>
                                                            @error('footer_logo') <small
                                                                class="text-danger">{{ $message }}</small> @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Update</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel</button>
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

@endsection