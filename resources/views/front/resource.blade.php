@extends('front.layout')
@section('content')

<style>
    :root {
        --primary: #4361ee;
        --secondary: #3f37c9;
        --accent: #4895ef;
        --light: #f8f9fa;
        --dark: #212529;
        --success: #4cc9f0;
        --warning: #f72585;
    }
    
    .developer-profile {
        background: #f5f7ff;
        min-height: 100vh;
        padding: 3rem 0;
        margin-top: 220px;
    }
    .row img {
        margin-top: -30px;
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.18);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(31, 38, 135, 0.15);
    }
    
    .profile-header {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        padding: 2rem;
        text-align: center;
        position: relative;
        z-index: -1;
    }
    
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        margin: -70px auto 1rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .profile-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(255,255,255,0.2);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.35rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 0.5rem;
    }
    
    .status-badge i {
        margin-right: 0.3rem;
        font-size: 0.8rem;
    }
    
    .badge-not-approved {
        background: rgba(255, 193, 7, 0.2);
        color: #ffc107;
    }
    
    .badge-scheduled {
        background: rgba(23, 162, 184, 0.2);
        color: #17a2b8;
    }
    
    .badge-qualified {
        background: rgba(40, 167, 69, 0.2);
        color: #28a745;
    }
    
    .badge-active {
        background: rgba(0, 123, 255, 0.2);
        color: #007bff;
    }
    
    .detail-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    
    .detail-item {
        display: flex;
        margin-bottom: 1rem;
        align-items: flex-start;
    }
    
    .detail-icon {
        width: 40px;
        height: 40px;
        background: rgba(67, 97, 238, 0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: var(--primary);
        flex-shrink: 0;
    }
    
    .detail-content {
        flex: 1;
    }
    
    .detail-label {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 0.2rem;
    }
    
    .detail-value {
        font-weight: 500;
        color: var(--dark);
    }
    
    .skill-tag {
        display: inline-block;
        background: rgba(67, 97, 238, 0.1);
        color: var(--primary);
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
    }
    
    .timeline {
        position: relative;
        padding-left: 2rem;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 0.5rem;
        top: 0;
        bottom: 0;
        width: 2px;
        background: rgba(0,0,0,0.1);
    }
    
    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -2rem;
        top: 0.2rem;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: var(--primary);
        border: 2px solid white;
    }
    
    .timeline-date {
        font-size: 0.75rem;
        color: #6c757d;
    }
    
    .timeline-content {
        background: white;
        border-radius: 8px;
        padding: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
    }
    
    .action-btn i {
        margin-right: 0.5rem;
    }
    
    .btn-primary {
        background: var(--primary);
        color: white;
    }
    
    .btn-primary:hover {
        background: var(--secondary);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
    }
    
    .btn-outline {
        background: transparent;
        border: 1px solid var(--primary);
        color: var(--primary);
    }
    
    .btn-outline:hover {
        background: rgba(67, 97, 238, 0.1);
    }
    
    .tab-nav {
        display: flex;
        border-bottom: 1px solid rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
    }
    
    .tab-link {
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        color: #6c757d;
        position: relative;
        transition: all 0.3s ease;
    }
    
    .tab-link:hover {
        color: var(--primary);
    }
    
    .tab-link.active {
        color: var(--primary);
    }
    
    .tab-link.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 2px;
        background: var(--primary);
    }
    
    @media (max-width: 768px) {
        .profile-avatar {
            width: 90px;
            height: 90px;
            margin: -50px auto 1rem;
        }
        
        .detail-icon {
            width: 36px;
            height: 36px;
        }
    }
</style>

<style>
    .modern-pay-btn {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.7rem 1.8rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        color: white;
        background: linear-gradient(135deg,rgb(36, 5, 150),rgb(12, 4, 120));
        box-shadow: 0 4px 6px -1px rgba(5, 150, 105, 0.2), 0 2px 4px -1px rgba(5, 150, 105, 0.1);
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        cursor: pointer;
        z-index: 1;
    }
    
    .modern-pay-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(5, 150, 105, 0.3), 0 4px 6px -2px rgba(5, 150, 105, 0.15);
        background: linear-gradient(135deg,rgb(36, 5, 150),rgb(12, 4, 120));
    }
    
    .modern-pay-btn:active {
        transform: translateY(0);
    }
    
    .modern-pay-btn__text {
        position: relative;
        z-index: 2;
        margin-right: 0.5rem;
        transition: transform 0.3s ease;
    }
    
    .modern-pay-btn:hover .modern-pay-btn__text {
        transform: translateX(4px);
    }
    
    .modern-pay-btn__icon {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }
    
    .modern-pay-btn:hover .modern-pay-btn__icon {
        transform: translateX(4px);
    }
    
    .modern-pay-btn__border {
        position: absolute;
        background: white;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 0;
    }
    
    .modern-pay-btn__border--top,
    .modern-pay-btn__border--bottom {
        width: 0;
        height: 2px;
        left: 0;
    }
    
    .modern-pay-btn__border--left,
    .modern-pay-btn__border--right {
        width: 2px;
        height: 0;
        top: 0;
    }
    
    .modern-pay-btn__border--top {
        top: 0;
    }
    
    .modern-pay-btn__border--right {
        right: 0;
    }
    
    .modern-pay-btn__border--bottom {
        bottom: 0;
    }
    
    .modern-pay-btn__border--left {
        left: 0;
    }
    
    .modern-pay-btn:hover .modern-pay-btn__border--top,
    .modern-pay-btn:hover .modern-pay-btn__border--bottom {
        width: 100%;
    }
    
    .modern-pay-btn:hover .modern-pay-btn__border--left,
    .modern-pay-btn:hover .modern-pay-btn__border--right {
        height: 100%;
    }
</style>


<div class="developer-profile">
    <div class="container">
        <!-- Status Messages -->
        @if(Session::has('schedule_errmsg') || Session::has('require_docs_errmsg'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="glass-card alert alert-dismissible fade show" style="background: rgba(255,255,255,0.95)">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <div class="d-flex align-items-center">
                        <i class="fa fa-info-circle mr-3" style="font-size: 1.5rem; color: var(--primary)"></i>
                        <div>
                            <strong>{{Session::get('schedule_errmsg') ?? Session::get('require_docs_errmsg')}}</strong>
                        </div>
                    </div>
                </div>
                {{Session::forget('message')}}
                {{Session::forget('schedule_errmsg')}}
                {{Session::forget('require_docs_errmsg')}}
            </div>
        </div>
        @endif
        @foreach($developer_resources as $resource)
            <div class="row">
                <!-- Developer Profile Card -->
                <div class="col-lg-4 mb-4">
                    <div class="glass-card h-100">
                        <div class="profile-header">
                            <span class="profile-badge">
                                <i class="fa fa-certificate mr-1 text-dark"></i> Verified
                            </span>
                            <h3 class="mb-0">{{ $resource->name }} {{ $resource->last_name }}</h3>
                            <div class="d-flex justify-content-center align-items-center mt-2">
                                <div class="star-rating mr-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $resource->rating)
                                            <i class="fa fa-star text-warning"></i>
                                        @else
                                            <i class="fa fa-star text-secondary"></i>
                                        @endif
                                    @endfor
                                </div>
                               
                            </div>
                        </div>
                        
                        <div class="text-center">
                        @if(!empty($resource->image))
                                <img src="{{ asset('public/upload/developer/'.$resource->image) }}"  class="profile-avatar" alt="{{ $resource->name }}">
                            @else
                                <img src="{{ URL::asset('public/upload/profile_image/1640871620.png') }}"  class="img-fluid mx-auto d-block" alt="Developer Avatar" style="max-height: 100%; width: auto;">
                            @endif
                        </div>
                        
                        <div class="p-4">
                            <div class="detail-card">
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fa fa-language"></i>
                                    </div>
                                    <div class="detail-content">
                                        <div class="detail-label">Languages</div>
                                        <div class="detail-value">{{ $resource->language }}</div>
                                    </div>
                                </div>
                                
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fa fa-graduation-cap"></i>
                                    </div>
                                    <div class="detail-content">
                                        <div class="detail-label">Education</div>
                                        <div class="detail-value">{{ $resource->degree }}</div>
                                    </div>
                                </div>
                                
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fa fa-briefcase"></i>
                                    </div>
                                    <div class="detail-content">
                                        <div class="detail-label">Experience</div>
                                        <div class="detail-value">{{ $resource->job }} completed projects</div>
                                    </div>
                                </div>
                                
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="detail-content">
                                        <div class="detail-label">Rate</div>
                                        <div class="detail-value">{{ $resource->perhr }} INR/month</div>
                                    </div>
                                </div>
                            </div>
                            
                            @if($resource->status == "2")
                            <div class="detail-card bg-light-warning">
                                <div class="detail-item">
                                    <div class="detail-icon bg-warning-light">
                                        <i class="fa fa-clock-o text-warning"></i>
                                    </div>
                                    <div class="detail-content">
                                        <div class="detail-label">Project Timeline</div>
                                        @php
                                            $datetime1 = Carbon\Carbon::now();
                                            $datetime2 = $resource->qdate;
                                            $interval = $datetime1->diff($datetime2);
                                            $days = $interval->format('%a');
                                            $dueDate = 20-$days;
                                        @endphp
                                        <div class="detail-value">
                                            <span class="font-weight-bold">{{ $dueDate }} days</span> remaining
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <div class="detail-card">
                                <h6 class="mb-3">Technical Skills</h6>
                                @php
                                    $skills = explode(',', $resource->language);
                                @endphp
                                @foreach($skills as $skill)
                                    <span class="skill-tag">{{ trim($skill) }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Main Content Area -->
                <div class="col-lg-8">
                    @if($resource->status == "Not Approved")
                    <!-- Not Approved Status Content -->
                    <div class="glass-card">
                        <div class="profile-header">
                            <h3 class="mb-0">Schedule Interview</h3>
                        </div>
                        
                        <div class="p-4">
                            @if($resource->available_start_date && $resource->available_end_date)
                            <div class="detail-card">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="detail-icon bg-primary-light">
                                        <i class="fa fa-calendar text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 ml-3 text-dark">Available Time Slots</h5>
                                </div>
                                
                                <p class="text-muted mb-4 text-dark">
                                    {{ $resource->name }} is available between 
                                    <span class="font-weight-bold">{{ $resource->available_start_date }}</span> and 
                                    <span class="font-weight-bold">{{ $resource->available_end_date }}</span>
                                </p>
                                
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark">Select Interview Slot</label>
                                    <input type="text" class="form-control flatpickr" 
                                           id="interview_calendar_{{ $resource->dev_id }}" 
                                           placeholder="Select date & time"
                                           data-dev-id="{{ $resource->dev_id }}"
                                           data-min-date="{{ $resource->available_start_date }}"
                                           data-max-date="{{ $resource->available_end_date }}">
                                    <small class="text-muted">Choose a convenient time for your interview</small>
                                </div>
                            </div>
                            @else
                            <div class="alert alert-warning">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-exclamation-triangle mr-3" style="font-size: 1.5rem;"></i>
                                    <div>
                                        <strong>Interview scheduling is currently unavailable</strong>
                                        <p class="mb-0">This developer hasn't set available times yet.</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Interview Modal -->
                    <div class="modal fade" id="scheduleModal_{{ $resource->dev_id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content border-0 shadow-lg">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Confirm Interview Details</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                </div>
                                <form method="POST" action="{{ route('schedule_interview_resource') }}">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="dev_id" value="{{ $resource->dev_id }}">
                                        <input type="hidden" name="interviewdateone" id="modal_interview_date_{{ $resource->dev_id }}">
                                        <input type="hidden" name="email" value="{{ $resource->email }}">
                                        <input type="hidden" name="name" value="{{ $resource->name }}">
                                        
                                        <div class="form-group">
                                            <label class="font-weight-bold">Time Slot</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                        </div>
                                                        <input type="time" name="from_time" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                                        </div>
                                                        <input type="time" name="to_time" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-outline" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-calendar-check mr-2"></i>Confirm Interview
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @elseif($resource->status == "Scheduled")
                    <!-- Scheduled Status Content -->
                    <div class="glass-card">
                        <div class="profile-header">
                            <h3 class="mb-0">Interview Details</h3>
                        </div>
                        
                        <div class="p-4">
                            <div class="detail-card bg-light-info">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="detail-icon bg-info-light">
                                        <i class="fa fa-info-circle text-info"></i>
                                    </div>
                                    <h5 class="mb-0 ml-3 text-dark">Your Interview Is Scheduled</h5>
                                </div>
                                <p class="text-dark">Please join using the details below at the scheduled time.</p>
                            </div>
                            
                            <div class="detail-card">
                                <div class="detail-item">
                                    <div class="detail-icon bg-success-light">
                                        <i class="fa fa-link text-success"></i>
                                    </div>
                                    <div class="detail-content">
                                        <div class="detail-label">Meeting Link</div>
                                        <div class="detail-value">
                                            <a href="{{ $resource->interviewlink }}" target="_blank" class="text-primary">
                                                {{ $resource->interviewlink }}
                                                <i class="fa fa-external-link-alt ml-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="detail-item">
                                    <div class="detail-icon bg-primary-light">
                                        <i class="fa fa-calendar text-primary"></i>
                                    </div>
                                    <div class="detail-content">
                                        <div class="detail-label">Date & Time</div>
                                        <div class="detail-value">
                                            {{ $resource->date }} from {{ $resource->interviewdatetwo }} to {{ $resource->interviewdatethree ?? '' }}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-center mt-4">
                                    <button class="action-btn btn-primary" 
                                            data-toggle="modal" 
                                            data-target="#feedbackModal_{{ $resource->dev_id }}">
                                        <i class="fa fa-comment-dots mr-2"></i>Submit Feedback
                                    </button>
                                    
                                    <!--<a href="#" class="action-btn btn-outline ml-3">-->
                                    <!--    <i class="fa fa-calendar-plus mr-2"></i>Add to Calendar-->
                                    <!--</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Feedback Modal -->
                    <div class="modal fade feedback-modal" id="feedbackModal_{{ $resource->dev_id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content border-0 shadow-lg">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Interview Feedback</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                </div>
                                <form method="POST" action="{{ route('schedule_interview_qualified') }}">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="dev_id" value="{{ $resource->dev_id }}">
                                        
                                        <div class="form-group">
                                            <label class="font-weight-bold">Outcome</label>
                                            <select class="form-control" name="status" required>
                                                <option value="">Select your decision</option>
                                                <option value="Qualified">Qualified - Move to next step</option>
                                                <option value="Disqualified">Disqualified - Not a good fit</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="font-weight-bold">Your Feedback</label>
                                            <textarea class="form-control" name="review" rows="5" required 
                                                      placeholder="Please provide detailed feedback about the interview..."></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-outline" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-paper-plane mr-2"></i>Submit Feedback
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @elseif($resource->status == "Qualified")
                    <!-- Qualified Status Content -->
                    <div class="glass-card">
                        <div class="profile-header">
                            <h3 class="mb-0">Next Steps</h3>
                        </div>
                        
                        <div class="p-4">
                            <div class="detail-card bg-light-success">
                                <div class="d-flex align-items-center">
                                    <div class="detail-icon bg-success-light">
                                        <i class="fa fa-check-circle text-success"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h5 class="mb-1 text-dark">Congratulations!</h5>
                                        <p class="mb-0 text-dark">This developer has been qualified for your project.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="detail-card">
                                <h5 class="mb-4 text-dark">Secure Payment</h5>
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <p class="text-muted">
                                            To begin working with {{ $resource->name }}, please complete the secure payment process. 
                                            Your funds will be held in escrow until work is completed to your satisfaction.
                                        </p>
                                        <div class="d-flex align-items-center mt-4">
                                            <i class="fa fa-shield-alt fa-2x text-primary mr-3"></i>
                                            <div>
                                                <h6 class="mb-0">Secure Payment</h6>
                                                <small class="text-muted">SSL encrypted transaction</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 text-center">
                                        <!--<div class="p-4 bg-light rounded">-->
                                        <!--    <h4 class="text-primary mb-3">{{ number_format($resource->perhr, 2) }} INR</h4>-->
                                        <!--    <a href="{{ route('dev.pay', ['dev_id' => $resource->dev_id]) }}" -->
                                        <!--       class="action-btn btn-primary btn-block">-->
                                        <!--        <i class="fa fa-lock mr-2"></i>Proceed to Payment-->
                                        <!--    </a>-->
                                            <!-- <small class="text-muted mt-2 d-block">Monthly developer fee</small> -->
                                        <!--</div>-->
                                        
                                        <div class="p-4 bg-light rounded">
                                            @php
                                                $gstRate = 18;
                                                $gstAmount = $resource->perhr * ($gstRate / 100);
                                                $totalAmount = $resource->perhr + $gstAmount;
                                            @endphp
                                        
                                            <h4 class="text-dark mb-1">Breakdown</h4>
                                            <p class="mb-1 text-dark"><strong>Base:</strong> ₹{{ number_format($resource->perhr, 2) }}</p>
                                            <p class="mb-1 text-dark"><strong>GST ({{ $gstRate }}%):</strong> ₹{{ number_format($gstAmount, 2) }}</p>
                                            <hr>
                                            <h4 class="text-primary mb-3">Total: ₹{{ number_format($totalAmount, 2) }}</h4>
                                        
                                            <a href="{{ route('dev.pay', ['dev_id' => $resource->dev_id]) }}" 
                                               class="action-btn btn-primary btn-block">
                                                <i class="fa fa-lock mr-2"></i>Proceed to Payment
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif($resource->status == 1)
                    <div class="glass-card">
                            <div class="profile-header">
                                <h3 class="mb-0">Project Management</h3>
                            </div>
                            
                            <div class="p-4 text-center">
                                <button class="modern-pay-btn" id="startWorkBtn">
                                    <a class="text-white"  href="{{ env('URL') }}">
                                        <i class="fa fa-play-circle mr-2"></i>Start Your Work
                                    </a>
                                </button>
                            </div>
                        </div>
                    @elseif($resource->status == 2)
                    <div class="glass-card">
                            <div class="profile-header">
                                <h3 class="mb-0">Project Management</h3>
                            </div>
                            
                            <div class="p-4 text-center">
                                <button class="modern-pay-btn" id="startWorkBtn">
                                    <a class="text-white"  href="{{ env('URL') }}">
                                        <i class="fa fa-play-circle mr-2"></i>Start Your Work
                                    </a>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Flatpickr and Toastr JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
// Initialize date pickers for each developer
document.querySelectorAll('.flatpickr').forEach(picker => {
    const devId = picker.dataset.devId;
    const minDate = picker.dataset.minDate;
    const maxDate = picker.dataset.maxDate;
    
    flatpickr(picker, {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: minDate,
        maxDate: maxDate,
        onChange: function(selectedDates) {
            if (selectedDates.length > 0) {
                const selected = selectedDates[0].toISOString().slice(0, 16);
                document.getElementById(`modal_interview_date_${devId}`).value = selected;
                $(`#scheduleModal_${devId}`).modal('show');
            }
        }
    });
});

// Form submission handling with toast notifications
$('form').on('submit', function(e) {
    e.preventDefault();
    const form = $(this);
    const formData = new FormData(this);
    
    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            toastr.success(response.message || 'Action completed successfully');
            form.trigger('reset');
            $('.modal').modal('hide');
            
            // Refresh page after 2 seconds if needed
            if(response.refresh) {
                setTimeout(() => location.reload(), 2000);
            }
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                for (const field in errors) {
                    toastr.error(errors[field][0]);
                }
            } else {
                toastr.error('An error occurred. Please try again.');
            }
        }
    });
});

// Update custom file input label
$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});

    
$(document).ready(function() {
    $('.feedback-modal').on('hidden.bs.modal', function() {
        location.reload();
    });
});

</script>

@endsection