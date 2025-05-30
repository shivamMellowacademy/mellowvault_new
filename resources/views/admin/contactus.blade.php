@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:30px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Contact Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <a href="{{ route('export') }}" class="btn btn-primary">Excel</a><br>
            </div>
        </div><br>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white">Sl. No.</th>
                                    <th class="text-white">Name</th>
                                    <th class="text-white">Email</th>
                                    <th class="text-white">Contact Number</th>
                                    <th class="text-white">Subject</th>
                                    <th class="text-white">Date</th>
                                    <th class="text-white">Action</th>
                                </tr>
                            </thead>
	                        <tbody>
                                @php $i = 1; @endphp
                                @foreach($info as $c)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $c->name }}</td>
                                        <td>{{ $c->email }}</td>
                                        <td>{{ $c->phone }}</td>
                                        <td>{{ $c->subject }}</td>
                                        <td>{{ $c->date }}</td>
                                        <td>
                                            <!-- Trigger modal -->
                                            <a class="btn btn-info btn-sm" href="javascript:void();" data-toggle="modal" data-target="#contactDetailsModal{{ $c->id }}"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>

                                    <!-- Modal for Contact Details -->
                                    <div class="modal fade" id="contactDetailsModal{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="contactDetailsModalLabel{{ $c->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title text-white" id="contactDetailsModalLabel{{ $c->id }}">Contact Details - {{ $c->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <p><strong>Name:</strong> {{ $c->name }}</p>
                                                            <p><strong>Email:</strong> {{ $c->email }}</p>
                                                            <p><strong>Contact Number:</strong> {{ $c->phone }}</p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <p><strong>Date:</strong> {{ $c->date }}</p>
                                                            <p><strong>Subject:</strong> {{ $c->subject }}</p>
                                                            <p><strong>Message:</strong> {{ $c->mesage }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal Footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @php $i++; @endphp
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
