@extends('admin.layout')
@section('content')

<br><br>
<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Interview Schedule Resource</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>

    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body" style="overflow-x:auto;">
                        <table id="complex-header" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Resource Name</th>
                                    <th>Email & Phone</th>
                                    <th>Address</th>
                                    <th>Per hour charge</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach($interview_schedule_developer_details as $pp)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $pp->name }} {{ $pp->last_name }}</td>
                                    <td>{{ $pp->email }}<br>{{ $pp->phone }}</td>
                                    <td>{{ $pp->address }}</td>
                                    <td>Rating: {{ $pp->rating }}/5<br>₹{{ $pp->perhr }}/-</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#myClientModal{{ $pp->dev_id }}">Client</a>

                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="{{ $pp->status == 'Interview Schedule' ? '#myModal'.$pp->dev_id : '#mySendLinkModal'.$pp->dev_id }}">
                                                    Interview Date & Time
                                                </a>

                                                <!-- <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="{{ $pp->status == 'Interview Schedule' ? '#mySendModal'.$pp->dev_id : '#mySendLinkModal'.$pp->dev_id }}">
                                                    Send Interview Details
                                                </a> -->

                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#myReviewModal{{ $pp->dev_id }}">Review</a>

                                                <div class="dropdown-divider"></div>

                                                @if($pp->status == "Qualified")
                                                <a class="dropdown-item text-danger"
                                                    href="{{ route('developer_approve_status', ['dev_id' => $pp->dev_id]) }}">
                                                    Disapprove
                                                </a>
                                                @else
                                                <a class="dropdown-item text-success"
                                                    href="{{ route('developer_approve_status', ['dev_id' => $pp->dev_id]) }}">
                                                    Approve
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Unified Modal: Client Details --}}
                                <div class="modal fade" id="myClientModal{{ $pp->dev_id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title text-white">Client Details</h5>
                                                <button type="button" class="close text-white"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Full Name:</strong> {{ $pp->fname }} {{ $pp->lname }}</p>
                                                <p><strong>Email:</strong> {{ $pp->email }}</p>
                                                <p><strong>Phone:</strong> {{ $pp->phone }}</p>
                                                <p><strong>Address:</strong> {{ $pp->address }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Unified Modal: Interview Date Options --}}
                                <div class="modal fade" id="myModal{{ $pp->dev_id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title text-white">Interview Date & Time Options</h5>
                                                <button type="button" class="close text-white"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>1st Option:</strong> {{ $pp->interviewdateone  ?? "Na" }}</p>
                                                <p><strong>2nd Option:</strong> {{ $pp->interviewdatetwo  ?? "Na" }}</p>
                                                <p><strong>3rd Option:</strong> {{ $pp->interviewdatethree  ?? "Na" }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Unified Modal: Send Interview Link --}}
                                <div class="modal fade" id="mySendModal{{ $pp->dev_id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('send_interview_link') }}">
                                                @csrf
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title text-white">Send Interview Link</h5>
                                                    <button type="button" class="close text-white"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="dev_id" value="{{ $pp->dev_id }}">
                                                    <div class="form-group">
                                                        <label>Choose Interview Date & Time:</label>
                                                        @foreach ([$pp->interviewdateone, $pp->interviewdatetwo,
                                                        $pp->interviewdatethree] as $date)
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input"
                                                                name="schinterviewdatetime" value="{{ $date }}"
                                                                required>
                                                            <label class="form-check-label">{{ $date }}</label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="interviewlink">Interview Link:</label>
                                                        <input type="text" name="interviewlink" id="interviewlink"
                                                            class="form-control" placeholder="Paste interview link"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Send</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- Unified Modal: View Sent Interview Link --}}
                                <div class="modal fade" id="mySendLinkModal{{ $pp->dev_id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-dark">
                                                <h5 class="modal-title text-white">Interview Details</h5>
                                                <button type="button" class="close text-dark"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Scheduled Date & Time:</strong>
                                                    {{ $pp->schinterviewdatetime ?? "Na" }}</p>
                                                <p><strong>Interview Link:</strong> <a href="{{ $pp->interviewlink }}"
                                                        target="_blank">{{ $pp->interviewlink ?? "Na" }}</a></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Unified Modal: Review --}}
                                <div class="modal fade" id="myReviewModal{{ $pp->dev_id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title text-white">Interview Review</h5>
                                                <button type="button" class="close text-white"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ $pp->review ?? 'No review submitted yet.' }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
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