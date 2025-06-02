@extends('front.layout')

@section('content')
<br><br><br><br><br>
<section class="icons-category" style="background-color: #fff; padding: 40px 0;">
    @if($order_details_empty > 0 || $dev_order_details_empty > 0)
        <header>
            <div class="container">
                <h5 class="title text-center">All Invoice Details</h5>
            </div>
        </header>
        
        <br>
        
        <div class="container">
            <div class="row">
                <div class="col-md-3" style="padding-bottom: 12px;">
                    <div class="sticky-top">
                        <div class="card shadow-sm">
                            @foreach($user_details as $uu)
                                @if(Session::get('user_login_id') === $uu->id)
                                    <div class="card-header text-center">
                                        <h6 class="mb-0">Hi! {{ $uu->fname }}</h6>
                                    </div>
                                @endif
                            @endforeach

                            <div class="list-group">
                                <a href="{{ route('user_profile') }}" class="list-group-item">
                                    <i class="fa fa-user" aria-hidden="true"></i> My Profile <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </a>
                                <!-- <a href="{{ route('my_download') }}" class="list-group-item">
                                    <i class="fa fa-download" aria-hidden="true"></i> Downloads <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </a> -->
                                <!-- <a href="{{ route('act_setting') }}" class="list-group-item">
                                    <i class="fa fa-gear" aria-hidden="true"></i> Account Settings <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </a> -->
                                <a href="{{ route('show_invoice') }}" class="list-group-item">
                                    <i class="fa fa-yelp" aria-hidden="true"></i> Invoice <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </a>

                                @if($developer_order_details > 0)
                                    <a href="{{ route('client_dashboard') }}" class="list-group-item">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Work Space <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('resource') }}" class="list-group-item">
                                        <i class="fa fa-child" aria-hidden="true"></i> Resource <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('assign_work') }}" class="list-group-item">
                                        <i class="fa fa-suitcase" aria-hidden="true"></i> Assign Work <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </a>
                                @endif
                                
                                <a href="{{ route('user_logout') }}" class="list-group-item">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i> Logout <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="row">
                        @foreach($order_details as $order)
                            @if(Session::get('user_login_id') == $order->u_id)
                                <div class="col-6 col-md-4 mb-3">
                                    <a href="{{ route('invoice', $order->order_id) }}" target="_blank">
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <h6 class="card-title">Order ID: {{ $order->order_id }}</h6>
                                                <p>Order Date: <b>{{ $order->date }}</b></p>
                                                <p>Payment Status: <b class="text-success">{{ $order->payment_status }}</b></p>
                                                <button class="btn btn-info btn-sm w-100">
                                                    <i class="fa fa-eye"></i> View Invoice
                                                </button>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    @else
        <div class="container">
            <div class="cart-wrapper">
                <div class="row">
                    <div class="col-md-3">
                        <div class="sticky-top">
                            <div class="card shadow-sm">
                                @foreach($user_details as $uu)
                                    @if(Session::get('user_login_id') === $uu->id)
                                        <div class="card-header text-center">
                                            <h6 class="mb-0">Hi! {{ $uu->fname }}</h6>
                                        </div>
                                    @endif
                                @endforeach

                                <div class="list-group">
                                    <a href="{{ route('user_profile') }}" class="list-group-item">
                                        <i class="fa fa-user" aria-hidden="true"></i> My Profile <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </a>
                                    <!-- <a href="{{ route('my_download') }}" class="list-group-item">
                                        <i class="fa fa-download" aria-hidden="true"></i> Downloads <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </a> -->
                                    <!-- <a href="{{ route('act_setting') }}" class="list-group-item">
                                        <i class="fa fa-gear" aria-hidden="true"></i> Account Settings <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </a> -->
                                    <a href="{{ route('show_invoice') }}" class="list-group-item">
                                        <i class="fa fa-yelp" aria-hidden="true"></i> Invoice <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </a>
                                    
                                    @if($developer_order_details > 0)
                                        <a href="{{ route('client_dashboard') }}" class="list-group-item">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Work Space <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('resource') }}" class="list-group-item">
                                            <i class="fa fa-child" aria-hidden="true"></i> Resource <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('assign_work') }}" class="list-group-item">
                                            <i class="fa fa-suitcase" aria-hidden="true"></i> Assign Work <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('user_logout') }}" class="list-group-item">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i> Logout <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <center>
                            <h5><img src="{{ asset('public/front/assets/images/2.png') }}" class="rounded-circle" width="310px" height="250px"></h5>
                            <h4 class="card-title">There are no Elements here!</h4>
                            <small class="card-title">Start adding your Elements</small>
                            <hr style="width: 550px;">
                            <a class="btn btn-primary btn-lg" href="{{ route('index') }}" role="button">Continue <i class="fa fa-arrow-right"></i></a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>
@endsection
