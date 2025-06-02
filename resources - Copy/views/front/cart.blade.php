@extends('front.layout')
@section('content')
<section class="blog blog-category blog-animated" style="margin-top:100px">
    @if($cart_empty > 0)
    <header class="py-4 bg-light">
        <div class="container">
            <h2 class="title text-dark">Your Shopping Cart ({{ $cart_empty }} items)</h2>
        </div>
    </header>
    
    <div class="container py-4">
        <div class="row mt-5">
            <div class="col-lg-8">
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        @php
                            $id = Session::get('user_login_id');
                            $tprice = 0;
                            $total_tax_amount = 0;
                        @endphp
                        
                        @foreach($cart_details as $cart)
                            @if($id == $cart->u_id)
                                @php
                                    $p_id = $cart->id;
                                    $tax_rate = $cart->tax; // This should be the tax percentage (e.g., 18)
                                    $tax_amount = ($cart->price * $tax_rate) / 100;
                                    $total_tax_amount += $tax_amount;
                                    $tprice += $cart->price;
                                    session(['p_id' => $p_id]);
                                    session(['tprice' => $tprice]);
                                    
                                    $url = route('product_details',['id'=>''.$cart->pro_id.'']);
                                @endphp
                                
                                <div class="cart-item mb-4 pb-4 border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col-md-3 mb-3 mb-md-0">
                                            <a href="{{ route('delete_cart',['id'=>''.$cart->id.'']) }}" class="btn btn-sm btn-danger rounded-circle" style="position: absolute; z-index: 1;">
                                                <i class="fa fa-times"></i>
                                            </a>
                                            @if($cart->image == '')
                                                <a href="{{ $url }}">
                                                    <div class="video-thumbnail ratio ratio-1x1">
                                                        <video width="100%" controls controlsList="nodownload" muted>
                                                            <source src="{{ URL::asset('public/upload/video/'.$cart->video.'') }}" type="video/mp4">
                                                        </video>
                                                    </div>
                                                </a>
                                            @else
                                                <a href="{{ $url }}">
                                                    <img class="img-fluid rounded" src="{{ URL::asset('public/upload/product/'.$cart->image.'') }}" alt="{{ $cart->name }}" style="max-height: 120px; width: auto;">
                                                </a>
                                            @endif
                                        </div>
                                        
                                        <div class="col-md-5 mb-3 mb-md-0">
                                            <h5 class="product-title text-dark mb-2">{{ $cart->name }}</h5>
                                            <div class="product-details small text-muted">
                                                @if($cart->tax > 0)
                                                <div>Tax: {{ $cart->tax }}%</div>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="product-price text-right">
                                                <div class="text-dark font-weight-bold">₹{{ number_format($cart->price, 2) }}</div>
                                                @if($tax_amount > 0)
                                                <div class="small text-muted">+ ₹{{ number_format($tax_amount, 2) }} tax</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card mb-4 border-0 shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fa fa-receipt mr-2"></i> Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal ({{ $cart_empty }} items):</span>
                            <span class="text-dark">₹{{ number_format($tprice, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Tax:</span>
                            <span class="text-dark">₹{{ number_format($total_tax_amount, 2) }}</span>
                            @php
                                session(['tax_amount' => $total_tax_amount]);
                            @endphp
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between font-weight-bold">
                            <span>Total Amount:</span>
                            <span class="text-primary">₹{{ number_format($tprice + $total_tax_amount, 2) }}</span>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('proceed_to_checkout') }}" class="btn btn-primary btn-block btn-lg py-3">
                            Proceed to Checkout <i class="fa fa-arrow-right ml-2"></i>
                        </a>
                        <a href="{{ route('index') }}" class="btn btn-outline-secondary btn-block mt-2 py-2">
                            <i class="fa fa-shopping-bag mr-2"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="container py-5 my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="empty-cart-icon mb-4">
                    <i class="fa fa-shopping-cart fa-5x text-muted"></i>
                </div>
                <h3 class="mb-3">Your cart is empty</h3>
                <p class="text-muted mb-4">Looks like you haven't added anything to your cart yet</p>
                <a href="{{ route('index') }}" class="btn btn-primary btn-lg px-5 py-3">
                    <i class="fa fa-shopping-bag mr-2"></i> Start Shopping
                </a>
            </div>
        </div>
    </div>
    @endif
</section>

<style>
    .cart-item {
        position: relative;
    }
    .product-title {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        word-break: break-word;
    }
    .product-price {
        font-size: 1.1rem;
    }
    .video-thumbnail {
        position: relative;
        overflow: hidden;
        border-radius: 0.25rem;
        background: #f8f9fa;
    }
    .video-thumbnail video {
        object-fit: cover;
        height: 100%;
    }
    .empty-cart-icon {
        opacity: 0.3;
    }
    @media (max-width: 991.98px) {
        .sticky-top {
            position: static !important;
        }
    }
</style>

@endsection