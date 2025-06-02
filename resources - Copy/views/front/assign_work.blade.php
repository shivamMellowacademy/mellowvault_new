@extends('front.layout')

@section('content')

<section class="blog blog-category blog-animated py-5 mt-5"> {{-- Added mt-5 for top margin --}}
    @if($dev_order_details_empty > 0)
        <header>
            <div class="container">
                <h2 class="title mb-4">Developer Details</h2>
            </div>
        </header>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="clearfix">
                        @php $id = Session::get('user_login_id'); @endphp
                        @foreach($dev_order_details as $dev_order)
                            @if($id == $dev_order->u_id)
                                <article class="article-table mb-4 p-4 border rounded shadow-sm bg-white">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 mb-3 mb-md-0">
                                            <img class="img-fluid img-thumbnail"
                                                 src="{{ asset('public/upload/developer/'.$dev_order->image) }}"
                                                 alt="Developer Image"
                                                 style="height:200px; width:100%; object-fit:cover;">
                                        </div>

                                        <div class="col-md-4 text-secondary">
                                            <h5 class="fw-bold text-dark">{{ $dev_order->name }}</h5>
                                            <p class="mb-1">(Rating: {{ $dev_order->rating }}/5)</p>
                                            @foreach($profession as $p)
                                                @if($dev_order->pro_id === $p->id)
                                                    <p class="mb-1">Profession: {{ $p->heading }}</p>
                                                @endif
                                            @endforeach
                                            <p class="mb-1">Email: {{ $dev_order->email ?? 'N/A' }}</p>
                                            <p class="mb-0">Experience: {{ $dev_order->experience ?? 'Not specified' }} yrs</p>
                                        </div>

                                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                            <a href="{{ route('assign_work_details', $dev_order->dev_id) }}"
                                               class="btn btn-outline-danger">Initiate For Work <i class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                </article>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container py-5 mt-5">
            <div class="row">
                <div class="col-md-3">
                    <div class="sticky-top">
                        <div class="card shadow">
                            @php $id = Session::get('user_login_id'); @endphp
                            @foreach($user_details as $uu)
                                @if($id === $uu->id)
                                    <div class="card-header bg-primary text-white">
                                        <span>Hi, {{ $uu->fname }}</span>
                                    </div>
                                @endif
                            @endforeach

                            <div class="list-group list-group-flush">
                                <a href="{{ route('user_profile') }}" class="list-group-item"><i class="fa fa-user"></i> My Profile</a>
                                <a href="{{ route('my_download') }}" class="list-group-item"><i class="fa fa-download"></i> Downloads</a>
                                <a href="{{ route('act_setting') }}" class="list-group-item"><i class="fa fa-gear"></i> Account Settings</a>
                                <a href="{{ route('show_invoice') }}" class="list-group-item"><i class="fa fa-yelp"></i> Invoice</a>
                                <a href="{{ route('resource') }}" class="list-group-item"><i class="fa fa-child"></i> Resource</a>
                                <a href="{{ route('assign_work') }}" class="list-group-item"><i class="fa fa-suitcase"></i> Assign Work</a>
                                <a href="{{ route('user_logout') }}" class="list-group-item text-danger"><i class="fa fa-sign-out"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 text-center">
                    <img src="{{ asset('public/front/assets/images/2.png') }}" class="rounded-circle mb-4" width="250px" height="250px" alt="Not Available">
                    <h4 class="card-title mb-3 text-secondary">Oops! Your Assigning Work Not Available.</h4>
                    <hr style="max-width: 550px; margin: auto;">
                    <a class="btn btn-primary btn-lg mt-3" href="{{ route('index') }}">Go <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    @endif
</section>

@endsection
