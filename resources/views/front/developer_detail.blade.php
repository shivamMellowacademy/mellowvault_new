@extends('front.layout')
@section('content')

<section class="developer-profile">
    <!-- Header Section -->
    <div class="profile-header">
        <div class="container">
            <!-- Alert Message -->
            @if(Session::has('errmsg'))
            <div class="alert-message">
                <div class="alert alert-{{Session::get('message')}} alert-dismissible fade show">
                    <strong>{{Session::get('errmsg')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{Session::forget('message')}}
                {{Session::forget('errmsg')}}
            </div>
            @endif

            <!-- Developer Profile Card -->
            <div class="developer-card">
                <div class="developer-intro">
                    @foreach($deve as $d)
                    <div class="developer-avatar">
                        @if($d->image)
                            <img src="{{ URL::asset('public/upload/developer/'.$d->image.'') }}" alt="Developer Avatar" class="avatar-img">
                        @else
                            <img src="{{ URL::asset('public/upload/profile_image/1640871620.png') }}" alt="Developer Avatar" class="avatar-img">
                        @endif
                        
                        <div class="availability-badge @if($d->developer_status == 'Booked') unavailable @else available @endif">
                            {{ $d->developer_status == 'Booked' ? 'Unavailable' : 'Available' }}
                        </div>
                    </div>
                    
                    <div class="developer-info">
                        <h1 class="developer-name">{{ $d->name }}</h1>
                        <div class="developer-meta">
                            <div class="meta-item location">
                                <i class="fa fa-map-marker-alt"></i>
                                <span class="text-dark">{{ $d->address }}</span>
                            </div>
                            <div class="meta-item rating">
                                <div class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star @if($i <= $d->rating) filled @endif"></i>
                                    @endfor
                                </div>
                                <!-- <span class="text-dark">{{ $d->rating }}/5</span> -->
                            </div>
                        </div>
                        
                        <div class="developer-stats">
                            @if( $d->language)
                                <div class="stat-item">
                                    <i class="fa fa-language"></i>
                                    <span class="text-dark">{{ $d->language }}</span>
                                </div>
                            @endif
                            @if( $d->perhr)
                                <div class="stat-item">
                                    <i class="fa fa-money" aria-hidden="true"></i>
                                    <span class="text-dark">{{ $d->perhr }} INR/month</span>
                                </div>
                            @endif
                            @if( $d->degree)
                                <div class="stat-item">
                                    <i class="fa fa-graduation-cap"></i>
                                    <span class="text-dark">{{ $d->degree }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="developer-actions">
                        @foreach($deve as $d)
                            @if($d->login_status == 1)
                                @if($d->developer_status == 'Book Now' || $d->developer_status == 'Active')
                                    @if(empty(Session::get('user_login_id')))
                                        <a href="{{route('login')}}" class="btn btn-hire">
                                            <i class="fa fa-handshake"></i> Hire Now
                                        </a>
                                        <a href="{{ route('developer_rating_details',['dev_id'=>$d->dev_id] ) }}" class="btn btn-view">
                                            <i class="fa fa-eye"></i> Full Profile
                                        </a>
                                    @else
                                        @if($hire_dev > 0)
                                            <a href="{{ route('developer_rating_details',['dev_id'=>$d->dev_id] ) }}" class="btn btn-view">
                                                <i class="fa fa-eye"></i> View Profile
                                            </a>
                                        @else
                                            <a href="{{route('developer_checkout', $d->dev_id)}}" class="btn btn-hire">
                                                <i class="fa fa-handshake"></i> Hire Now
                                            </a>
                                             <a href="{{ route('developer_rating_details',['dev_id'=>$d->dev_id] ) }}" class="btn btn-view">
                                                <i class="fa fa-eye"></i> Full Profile
                                            </a>
                                        @endif
                                    @endif
                                @elseif($d->developer_status == 'Booked')
                                    <div class="availability-info">
                                        <span class="btn btn-unavailable">
                                            <i class="fa fa-clock"></i> Not Available
                                        </span>
                                        @if($d->available_start_date != '')
                                        <small class="available-date">
                                            Available by {{ date('F jS, Y', strtotime($d->available_end_date)) }}
                                        </small>
                                        @endif
                                    </div>
                                @endif
                            @else
                                <span class="btn btn-deactivated">
                                    <i class="fa fa-user-slash"></i> Deactivated
                                </span>
                            @endif
                            

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container profile-content">
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- Profile Tabs -->
                <div class="profile-tabs">
                    <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="about-tab" data-toggle="tab" href="#about" role="tab">
                                <i class="fa fa-user"></i> About
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="skills-tab" data-toggle="tab" href="#skills" role="tab">
                                <i class="fa fa-code"></i> Skills
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="experience-tab" data-toggle="tab" href="#experience" role="tab">
                                <i class="fa fa-briefcase"></i> Experience
                            </a>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="profileTabsContent">
                        <!-- About Tab -->
                        <div class="tab-pane fade show active" id="about">
                            <div class="tab-section">
                                <h3 class="section-title text-dark">About Me</h3>
                                @foreach($deve as $d)
                                <div class="section-content">
                                    {!! $d->description !!}
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Skills Tab -->
                        <div class="tab-pane fade" id="skills">
                            <div class="tab-section">
                                <h3 class="section-title text-dark">Technical Skills</h3>
                                @foreach($deve as $d)
                                <div class="skills-container">
                                    @foreach(explode(',', $d->skills) as $skill)
                                    <span class="skill-tag">{!! trim($skill) !!}</span>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Experience Tab -->
                        <div class="tab-pane fade" id="experience">
                            <div class="tab-section">
                                <h3 class="section-title text-dark">Work Experience</h3>
                                @foreach($deve as $d)
                                <div class="experience-list">
                                    {!! $d->completed_job !!}
                                </div>
                                @endforeach
                                
                                <div class="stats-cards">
                                    <div class="stat-card">
                                        <div class="stat-icon">
                                            <i class="fa fa-tasks"></i>
                                        </div>
                                        <div class="stat-info">
                                            <h4>Total Jobs</h4>
                                            <p>{{ $d->job }}</p>
                                        </div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="stat-icon">
                                            <i class="fa fa-clock"></i>
                                        </div>
                                        <div class="stat-info">
                                            <h4>Total Hours</h4>
                                            <p>{{ $d->total_hours }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(!empty($developer_project) && count($developer_project) > 0)
                <!-- Portfolio Section -->
                <div class="portfolio-section">
                    <h3 class="section-title text-dark">Featured Projects </h3>
                    <div class="portfolio-grid">
                        @foreach($developer_project as $dd)
                        <div class="portfolio-item">
                            <a href="{{ $dd->project_link }}" target="_blank" class="portfolio-link">
                                <div class="portfolio-image">
                                    <img src="{{ URL::asset('public/upload/screenshot/'.$dd->screenshot_image.'') }}" alt="Project Screenshot">
                                    <div class="portfolio-overlay">
                                        <i class="fa fa-external-link-alt"></i>
                                        <span>View Project</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Right Column -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <!-- Portfolio Download -->
                    <div class="sidebar-card portfolio-card">
                        @foreach($deve as $d)
                        <div class="portfolio-preview">
                            <img src="{{ URL::asset('public/upload/portfolio/'.$d->portfolio_image.'') }}" alt="Portfolio Preview">
                        </div>
                        <a href="{{route('resume_download', $d->dev_id)}}" class="btn btn-download">
                            <i class="fa fa-download text-white"></i> Download Portfolio
                        </a>
                        @endforeach
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Base Styles */
    .developer-profile {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        line-height: 1.6;
    }
    
    /* Header Styles */
    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 40px 0 60px;
        color: white;
        position: relative;
        overflow: hidden;
        margin-top: 99px;
    }
    
    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjAzKSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3QgZmlsbD0idXJsKCNwYXR0ZXJuKSIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIvPjwvc3ZnPg==');
    }
    
    .alert-message {
        max-width: 800px;
        margin: 0 auto 30px;
    }
    
    /* Developer Card */
    .developer-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
        overflow: hidden;
    }
    
    .developer-intro {
        display: flex;
        flex-wrap: wrap;
        padding: 30px;
    }
    
    .developer-avatar {
        position: relative;
        width: 180px;
        margin-right: 30px;
    }
    
    .avatar-img {
        width: 180px;
        height: 180px;
        border-radius: 12px;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .availability-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        color: white;
    }
    
    .availability-badge.available {
        background: #4CAF50;
    }
    
    .availability-badge.unavailable {
        background: #F44336;
    }

    .section-content {
        line-height: 1.8;
        color: #555;
        white-space: pre-line; /* This respects both \n and <br> tags */
        word-wrap: break-word; /* Breaks long words if needed */
        overflow-wrap: break-word; /* Modern version of word-wrap */
    }

    .section-content p {
        margin-bottom: 1em;
    }
    /* For all text content areas to handle line breaks */
    .experience-list,
    .skills-container,
    .stat-info p {
        white-space: pre-line;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    
    .developer-info {
        flex: 1;
        min-width: 300px;
    }
    
    .developer-name {
        font-size: 28px;
        font-weight: 700;
        margin: 0 0 10px;
        color: #333;
    }
    
    .developer-meta {
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 15px;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        margin-right: 20px;
        margin-bottom: 10px;
    }
    
    .meta-item i {
        margin-right: 8px;
        color: #667eea;
    }
    
    .stars {
        display: inline-flex;
        margin-right: 8px;
    }
    
    .stars .filled {
        color: #FFC107;
    }
    
    .developer-stats {
        display: flex;
        flex-wrap: wrap;
        background: #f9f9f9;
        padding: 15px;
        border-radius: 8px;
        margin-top: 15px;
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        margin-right: 20px;
        margin-bottom: 5px;
    }
    
    .stat-item i {
        margin-right: 8px;
        color: #667eea;
    }
    
    .developer-actions {
        display: flex;
        flex-direction: column;
        min-width: 200px;
        margin-left: 20px;
    }
    
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-bottom: 10px;
        text-align: center;
    }
    
    .btn i {
        margin-right: 8px;
    }
    
    .btn-hire {
        background: #667eea;
        color: white;
        border: 2px solid #667eea;
    }
    
    .btn-hire:hover {
        background: #5a6fd1;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }
    
    .btn-view {
        background: white;
        color: #667eea;
        border: 2px solid #667eea;
    }
    
    .btn-view:hover {
        background: #f5f7ff;
        transform: translateY(-2px);
    }
    
    .btn-unavailable {
        background: #f8f9fa;
        color: #F44336;
        border: 2px solid #F44336;
        cursor: not-allowed;
    }
    
    .btn-deactivated {
        background: #f8f9fa;
        color: #9E9E9E;
        border: 2px solid #9E9E9E;
        cursor: not-allowed;
    }
    
    .availability-info {
        text-align: center;
    }
    
    .available-date {
        display: block;
        margin-top: 5px;
        font-size: 12px;
        color: #666;
    }
    
    /* Profile Content */
    .profile-content {
        padding: 40px 0;
    }
    
    /* Tabs */
    .profile-tabs {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        overflow: hidden;
    }
    
    .nav-tabs {
        border-bottom: 1px solid #eee;
        padding: 0 20px;
    }
    
    .nav-tabs .nav-link {
        border: none;
        color: #666;
        font-weight: 600;
        padding: 15px 20px;
        margin-right: 10px;
        border-bottom: 3px solid transparent;
    }
    
    .nav-tabs .nav-link.active {
        color: #667eea;
        border-bottom: 3px solid #667eea;
        background: transparent;
    }
    
    .nav-tabs .nav-link i {
        margin-right: 8px;
    }
    
    .tab-content {
        padding: 20px;
    }
    
    .tab-section {
        margin-bottom: 20px;
    }
    
    .section-title {
        font-size: 22px;
        font-weight: 700;
        margin: 0 0 20px;
        color: #333;
        position: relative;
        padding-bottom: 10px;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background: #667eea;
    }
    
    .section-content {
        line-height: 1.8;
        color: #555;
        p {
            margin-bottom: 1.2em;
        }
        /* Style lists if present */
        ul, ol {
            margin: 1em 0;
            padding-left: 2em;
        }
        li {
            margin-bottom: 0.5em;
        }
    }
    
    /* Skills */
    .skills-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .skill-tag {
        background: #f0f4ff;
        color: #667eea;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
    }
    
    /* Experience */
    .experience-list {
        line-height: 1.8;
    }
    
    .stats-cards {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }
    
    .stat-card {
        flex: 1;
        background: #f9f9f9;
        border-radius: 8px;
        padding: 15px;
        display: flex;
        align-items: center;
    }
    
    .stat-icon {
        width: 40px;
        height: 40px;
        background: #667eea;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }
    
    .stat-info h4 {
        font-size: 14px;
        color: #666;
        margin: 0 0 5px;
    }
    
    .stat-info p {
        font-size: 18px;
        font-weight: 700;
        margin: 0;
        color: #333;
    }
    
    /* Portfolio Section */
    .portfolio-section {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        padding: 20px;
        margin-bottom: 30px;
    }
    
    .portfolio-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }
    
    .portfolio-item {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .portfolio-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .portfolio-image {
        position: relative;
        padding-top: 75%;
        overflow: hidden;
    }
    
    .portfolio-image img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .portfolio-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(102, 126, 234, 0.8);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        opacity: 0;
        transition: all 0.3s ease;
    }
    
    .portfolio-item:hover .portfolio-overlay {
        opacity: 1;
    }
    
    .portfolio-overlay i {
        font-size: 30px;
        margin-bottom: 10px;
    }
    
    /* Sidebar */
    .sidebar {
        position: sticky;
        top: 20px;
    }
    
    .sidebar-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        padding: 20px;
        margin-bottom: 30px;
    }
    
    .card-title {
        font-size: 18px;
        font-weight: 700;
        margin: 0 0 20px;
        color: #333;
    }
    
    .portfolio-preview {
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 15px;
    }
    
    .portfolio-preview img {
        width: 100%;
        height: auto;
        display: block;
    }
    
    .btn-download {
        width: 100%;
        background: #667eea;
        color: white;
        padding: 12px;
        border: none;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-download:hover {
        background: #5a6fd1;
    }
    
    /* Contact Card */
    .contact-options {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .contact-option {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        background: #f9f9f9;
        border-radius: 8px;
        color: #333;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .contact-option:hover {
        background: #f0f4ff;
        color: #667eea;
        transform: translateX(5px);
    }
    
    .contact-option i {
        margin-right: 10px;
        font-size: 18px;
    }
    
    /* Responsive */
    @media (max-width: 992px) {
        .developer-intro {
            flex-direction: column;
        }
        
        .developer-avatar {
            margin: 0 auto 20px;
        }
        
        .developer-actions {
            margin: 20px 0 0;
            flex-direction: row;
            gap: 10px;
        }
        
        .developer-actions .btn {
            flex: 1;
            margin: 0;
        }
    }
    
    @media (max-width: 768px) {
        .stats-cards {
            flex-direction: column;
        }
        
        .portfolio-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
    
    @media (max-width: 576px) {
        .portfolio-grid {
            grid-template-columns: 1fr;
        }
        
        .nav-tabs .nav-link {
            padding: 10px 12px;
            font-size: 14px;
        }
    }
</style>

@endsection