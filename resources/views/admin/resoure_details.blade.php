@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:30px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Resource Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white">Sl. No.</th>
                                    <th class="text-white">Developer Full Name</th>
                                    <th class="text-white">Developer Email</th>
                                    <th class="text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resoure_details as $i => $rd)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $rd->name }} {{ $rd->last_name }}</td>
                                    <td>{{ $rd->email }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal{{ $rd->dev_id }}">Developer Details</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myeditModal{{ $rd->u_id }}">Client Details</a>
                                                <a class="dropdown-item" href="{{ route('require_docs_details', ['u_id' => $rd->u_id, 'dev_id' => $rd->dev_id]) }}">Require Docs</a>
                                                <a class="dropdown-item" href="{{ route('short_message_details', ['u_id' => $rd->u_id, 'dev_id' => $rd->dev_id]) }}">Short Message</a>
                                                <a class="dropdown-item" href="{{ route('sow_details', ['u_id' => $rd->u_id, 'dev_id' => $rd->dev_id]) }}">SOW</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Developer Modal -->
<div class="modal fade" id="editModal{{ $rd->dev_id }}" tabindex="-1" role="dialog"
    aria-labelledby="developerModalLabel{{ $rd->dev_id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content shadow-sm rounded">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="developerModalLabel{{ $rd->dev_id }}">Developer Profile</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-4 text-center">
                        <!-- Profile Image -->
                         @if(!empty($rd->image))
                        <img src="{{ asset('public/upload/developer/' . $rd->image) }}" class="img-fluid rounded-circle" style="width: 120px; height: 120px;">
                        @else 
                        <img src="{{ asset('public/client/assets/images/avatars/profile-image.png') }}" class="img-fluid rounded-circle" style="width: 120px; height: 120px;">
                        @endif
                        <h4 class="mt-3">{{ $rd->name }} {{ $rd->last_name }}</h4>
                        <p class="text-muted">{{ $rd->job }}</p>
                    </div>
                    <div class="col-md-8">
                        <!-- Developer Information -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Phone:</strong> {{ $rd->dev_phone }}
                            </div>
                            <div class="col-md-6">
                                <strong>Email:</strong> {{ $rd->email }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Location:</strong> {{ $rd->address }}
                            </div>
                            <div class="col-md-6">
                                <strong>Per Hour Rate:</strong> ${{ $rd->perhr }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Completed Jobs:</strong> {!! $rd->completed_job !!}
                            </div>
                            <div class="col-md-6">
                                <strong>Rating:</strong> {{ $rd->rating }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <strong>Skills:</strong>
                        <p>{!! $rd->skills !!}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <strong>Education:</strong> {{ $rd->education }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Languages:</strong> {{ $rd->language }}
                    </div>
                    <div class="col-md-6">
                        <strong>Job Type:</strong> {{ $rd->job }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Total Hours:</strong> {{ $rd->total_hours }}
                    </div>
                    <div class="col-md-6">
                        <strong>Portfolio:</strong><br>
                        <img src="{{ asset('public/upload/portfolio/' . $rd->portfolio_image) }}" class="img-fluid" style="max-height: 120px;">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <strong>Description:</strong>
                        <p>{!! $rd->description !!}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <strong>Resume:</strong> <span class="text-muted">{{ $rd->resume }}</span>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

                                <!-- Client Modal -->
                                <div class="modal fade" id="myeditModal{{ $rd->u_id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="clientModalLabel{{ $rd->u_id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                                        <div class="modal-content shadow-sm rounded">
                                            <div class="modal-header bg-info text-white">
                                                <h5 class="modal-title" id="clientModalLabel{{ $rd->u_id }}">Client
                                                    Details</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <strong>Phone:</strong> {{ $rd->phone }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Email:</strong> {{ $rd->email }}
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <strong>Address:</strong> {{ $rd->address_one }}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>Payment Status:</strong>
                                                        <span
                                                            class="badge {{ $rd->payment_status == 'SUCCESS' ? 'badge-success' : 'badge-warning' }}">
                                                            {{ $rd->payment_status }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-4">
                                                        <strong>Country:</strong> {{ $rd->country }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <strong>State:</strong> {{ $rd->state }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <strong>City:</strong> {{ $rd->city }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-dismiss="modal">Close</button>
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

@endsection
