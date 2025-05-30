@extends('admin.layout')
@section('content')
@include('admin.flash')
<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All FAQ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title">All FAQs</h5>
                            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addFaqModal">
                                <i class="fa fa-plus"></i> Add FAQ
                            </button>
                        </div>
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white">Sl. No.</th>
                                    <th class="text-white">Question</th>
                                    <th class="text-white">Answer</th>
                                    <th style="width:20%; color: white;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($faq_detail as $index => $faq)
                                @php
                                $split = str_split($faq->description, 90);
                                $ans = $split[0].'...';
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $faq->heading }}</td>
                                    <td>{!! $ans !!}</td>
                                    <td>
                                        <a class="btn btn-outline-primary btn-sm" href="#" data-toggle="modal"
                                            data-target="#detailsModal{{ $faq->id }}" title="View Details"><i class="fa fa-eye"></i></a>

                                        <a class="btn btn-outline-success btn-sm" href="#" data-toggle="modal"
                                            data-target="#editModal{{ $faq->id }}" title="Edit"><i class="fa fa-edit"></i></a>

                                        <a class="btn btn-outline-danger btn-sm"
                                            href="{{ route('delete_faqs', ['id' => $faq->id]) }}" title="Delete FAQs"
                                            onclick="return confirm('Are You Sure To Delete This?')"><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $faq->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="editModalLabel{{ $faq->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title text-white">Edit FAQ</h5>
                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                    data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('update_faqs') }}">
                                                    @csrf
                                                    <input type="hidden" name="update" value="{{ $faq->id }}">

                                                    <div class="form-group">
                                                        <label for="heading_{{ $faq->id }}"
                                                            class="font-weight-bold">Heading <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="heading"
                                                            value="{{ $faq->heading }}" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="description_{{ $faq->id }}"
                                                            class="font-weight-bold">Description <span
                                                                class="text-danger">*</span></label>
                                                        <textarea class="form-control ckeditor" name="description"
                                                            rows="4" required>{{ $faq->description }}</textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success btn-block">Update
                                                            FAQ</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Details Modal -->
                                <div class="modal fade" id="detailsModal{{ $faq->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="detailsModalLabel{{ $faq->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header bg-info">
                                                <h5 class="modal-title text-white">FAQ Details</h5>
                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                    data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <h5><strong>Question:</strong> {{ $faq->heading }}</h5>
                                                <hr>
                                                <p><strong>Answer:</strong></p>
                                                <div>{!! $faq->description !!}</div>
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

<!-- Add FAQ Modal -->
<div class="modal fade" id="addFaqModal" tabindex="-1" role="dialog" aria-labelledby="addFaqModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Add FAQ</h5>
                <button type="button" class="btn btn-outline-danger btn-sm text-white"
                    data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('submit_faqs') }}">
                    @csrf
                    <div class="form-group">
                        <label for="heading" class="font-weight-bold">Question <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="heading" id="heading" placeholder="Enter Question"
                            required>
                        @error('heading')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="font-weight-bold">Answer <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control ckeditor" name="description" rows="4" placeholder="Description"
                            required></textarea>
                        @error('description')
                        <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">Add FAQ</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection