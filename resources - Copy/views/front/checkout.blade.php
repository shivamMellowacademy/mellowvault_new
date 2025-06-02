@extends('front.layout')
@section('content')

<section class="checkout py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="text-dark">Hire Now!</h2>
            <p class="text-muted">Proceed To Hiring!</p>
        </div>

        @php
            $id = Session::get('user_login_id');
            $tperhr = 0;
        @endphp

        <div class="row">
            @foreach($developer_cart as $dcart)
                @php
                    $dev_id = $dcart->dev_id;
                    $tperhr += $dcart->perhr;
                    session(['dev_id' => $dev_id]);
                    session(['tperhr' => $tperhr]);
                @endphp

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="d-flex justify-content-center align-items-center" style="height: 200px; overflow: hidden;">
                            @if($dcart->image)
                                <img src="{{ URL::asset('public/upload/developer/' . $dcart->image) }}" 
                                    class="img-fluid mx-auto d-block" 
                                    alt="{{ $dcart->name }}"
                                    style="max-height: 100%; width: auto;">
                            @else
                                <img src="{{ URL::asset('public/upload/profile_image/1640871620.png') }}" 
                                    class="img-fluid mx-auto d-block" 
                                    alt="Developer Avatar"
                                    style="max-height: 100%; width: auto;">
                            @endif
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title text-dark text-center">{{ $dcart->name }}</h5>
                            <p class="card-text text-center text-muted">
                                @foreach($developer_cart_deatls as $p)
                                    @if($dcart->pro_id === $p->id)
                                        {{ $p->heading }}
                                    @endif
                                @endforeach
                            </p>
                            <div class="text-center">
                                <span class="badge p-2 text-dark">
                                  Price: INR {{ number_format($dcart->perhr , 2) }}
                                </span>
                            </div>
                            <div class="text-center">
                                <span class="badge p-2 text-dark">
                                  Tax: INR  {{ number_format(($dcart->perhr * $tax->tax) / 100, 2) }} ({{ number_format($tax->tax , 2) }})
                                </span>
                            </div>
                            <div class="text-center">
                                <span class="badge badge-success p-2">
                                   Total:  INR {{ number_format($dcart->perhr + ($dcart->perhr * $tax->tax / 100), 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(count($developer_cart) > 0)
            <div class="row mt-4">
                <div class="col-md-12 text-right">
                    <a href="{{ route('developer_proceed_checkout') }}" class="btn btn-warning btn-lg">
                        <i class="fa fa-shopping-cart mr-2"></i> Proceed to Hire
                    </a>
                </div>
            </div>
        @else
            <div class="text-center">
                <p class="text-muted">No developers added to hire.</p>
            </div>
        @endif
    </div>
</section>

@endsection
