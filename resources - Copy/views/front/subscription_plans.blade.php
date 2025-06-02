@extends('front.layout')

@section('content')
<br><br><br><br><br>
<section class="icons-category" style="background-color: #fff; padding: 40px 0;">
    <div class="container">
        <header class="mb-5">
            <h5 class="title text-center">Choose Your Subscription Plan</h5>
        </header>

        <div class="row">
            @foreach($subscriptionPlans as $plan)
                @php
                    $gstRate = 18;
                    $gstAmount = $plan->price * ($gstRate / 100);
                    $totalAmount = $plan->price + $gstAmount;
                @endphp
                <div class="col-md-4 mb-4">
                    <div class="card shadow rounded-4 h-100 border-0">
                        <div class="card-body text-center p-4">
                            <h5 class="card-title text-dark mb-3">{{ ucfirst($plan->plan_type) }} Plan</h5>

                            <ul class="list-unstyled mb-4">
                                <li class="text-muted d-flex justify-content-between">
                                    <span>Base Price:</span> 
                                    <strong>₹{{ number_format($plan->price, 2) }}</strong>
                                </li>
                                <li class="text-muted d-flex justify-content-between">
                                    <span>GST (18%):</span> 
                                    <strong>₹{{ number_format($gstAmount, 2) }}</strong>
                                </li>
                                <li class="text-dark fw-bold d-flex justify-content-between border-top pt-2 mt-2">
                                    <span>Total:</span> 
                                    <span class="text-primary">₹{{ number_format($totalAmount, 2) }}</span>
                                </li>
                            </ul>

                            <p class="text-secondary mb-1"><strong>Duration:</strong> {{ ucfirst($plan->duration) }}</p>
                            <p class="text-secondary mb-3"><strong>User Limit:</strong> {{ $plan->no_of_user_allowed }}</p>

                            @if(in_array($plan->id, $purchasedPlanIds) || strtolower($plan->plan_type) == 'free')
                                <button class="btn btn-outline-success w-100" disabled>Plan Activated</button>
                            @else
                                <form action="{{ route('razorpay.process') }}" method="POST" class="mt-3">
                                    @csrf
                                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                    <input type="hidden" name="price" value="{{ $totalAmount * 100 }}">
                                    <input type="hidden" name="gst" value="{{ $gstRate }}">
                                    <input type="hidden" name="tax_price" value="{{ $gstAmount }}">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fa fa-lock me-2"></i>Purchase / Upgrade Now
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
<style>
    .card:hover {
        transform: translateY(-5px);
        transition: 0.3s ease-in-out;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
    }
</style>
