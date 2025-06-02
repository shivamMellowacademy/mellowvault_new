@extends('developer.layout')
@section('content')
<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Premium Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
   <!-- Loader HTML -->
    <div id="paymentLoader" class="loader-overlay" style="display: none;">
        <div class="loader-spinner">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <p class="mt-2">Processing payment...</p>
        </div>
    </div>


    <div class="page-content" style="padding-top:30px;">
        <div class="main-wrapper container">   
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-3">Why Go Premium Package?</h3>
                    <ul class="list-unstyled mx-3">
                        @foreach($premium as $val)
                            <li class="m-2"> 
                                <i class="fas fa-arrow-right"></i> &nbsp; {{$val->name}}
                            </li>
                        @endforeach
                        
                    </ul>
                </div>
                @if(isset($date))
                    @if($date->expired === null || $date->expired >= now())
                        {{-- Show "Thank you" for active or one-time subscriptions --}}
                        <div class="text-right m-4">
                            <button type="button" class="btn btn-outline-primary ml-3">Thank you</button>
                        </div>
                    @else
                        {{-- Show payment options only if subscription expired --}}
                        <div class="text-right m-4">
                            <label for="planPay" class="mr-2 font-weight-bold">Choose Your Plan:</label>
                            <select id="planPay" class="form-control d-inline w-auto">
                                @foreach($prices as $val)
                                    <option value="{{ $val->price }}" data-price="{{ $val->id }}">
                                        {{ ucfirst($val->name) }} - ₹{{ number_format($val->price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" onclick="pay()" class="btn btn-outline-primary ml-3">Pay</button>
                        </div>
                    @endif
                @else
                    {{-- No subscription exists - show all payment options --}}
                    <div class="text-right m-4">
                        <label for="planPay" class="mr-2 font-weight-bold">Choose Your Plan:</label>
                        <select id="planPay" class="form-control d-inline w-auto">
                            @foreach($prices as $val)
                                <option value="{{ $val->price }}" data-price="{{ $val->id }}">
                                    {{ ucfirst($val->name) }} - ₹{{ number_format($val->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                        <div id="priceDetails" class="mt-3 text-right d-inline-block w-100">
                            <p class="mb-1"><strong>Base Price:</strong> ₹<span id="basePrice">0.00</span></p>
                            <p class="mb-1 text-warning"><strong>{{ number_format($tax->tax, 2)}}% GST:</strong> ₹<span id="gstAmount">0.00</span></p>
                            <p class="mb-0"><strong>Total Price:</strong> ₹<span id="totalPrice">0.00</span></p>
                        </div>

                        <button type="button" onclick="pay()" class="btn btn-outline-primary ml-3">Pay</button>
                    </div>
                @endif
            </div>
        </div>
   	</div>
</div>
<style>
    /* Loader Styles */
    .loader-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .loader-spinner {
        background: white;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }
    
    .loader-spinner p {
        margin-top: 15px;
        font-weight: bold;
    }
    
    .spinner-border {
        width: 3rem;
        height: 3rem;
    }
</style>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    function pay() {
        const loader = document.getElementById('paymentLoader');
        loader.style.display = 'flex';

        let planSelect = document.getElementById('planPay');
        let plan = parseInt(planSelect.value);
        let priceId = planSelect.options[planSelect.selectedIndex].dataset.price;
        let taxRate = {{ $tax->tax }};
        let tax = plan * (taxRate / 100);
        let total = plan + tax;

        const options = {
            key: "{{ env('RAZORPAY_KEY') }}",
            amount: total * 100,
            currency: "INR",
            name: "Mellow Academy",
            description: "Test Transaction",

            handler: function (response) {
                fetch("{{ route('developer_premium_pay') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id: response.razorpay_order_id,
                        razorpay_signature: response.razorpay_signature,
                        razorpay_id: priceId,
                        amount: plan,
                        tax: tax,
                    })
                })
                .then(async res => {
                    try {
                        const data = await res.json();
                        if (!res.ok) throw new Error(data.message || 'Payment failed');

                        alert('Payment successful!');
                        window.location.reload();
                    } catch (error) {
                        alert(error.message);
                        console.error(error);
                    } finally {
                        loader.style.display = 'none';
                    }
                })
                .catch(error => {
                    alert("Payment failed or couldn't be saved.");
                    console.error(error);
                    loader.style.display = 'none';
                });
            },

            modal: {
                ondismiss: function () {
                    loader.style.display = 'none'; // Hide loader if modal is dismissed
                }
            }
        };

        const rzp = new Razorpay(options);
        rzp.open();

        // Optional: Catch unexpected error on open
        rzp.on('payment.failed', function () {
            loader.style.display = 'none';
        });
    }
</script>
<script>
   let taxRate = {{ $tax->tax }};

    document.addEventListener('DOMContentLoaded', function () {
        const planSelect = document.getElementById('planPay');
        const basePrice = document.getElementById('basePrice');
        const gstAmount = document.getElementById('gstAmount');
        const totalPrice = document.getElementById('totalPrice');

        // Function to calculate and display GST and total
        function updatePriceDisplay() {
            const selectedOption = planSelect.options[planSelect.selectedIndex];
            const price = parseFloat(selectedOption.value);

            const gst = price * (taxRate / 100);
            const total = price + gst;

            basePrice.textContent = price.toFixed(2);
            gstAmount.textContent = gst.toFixed(2);
            totalPrice.textContent = total.toFixed(2);
        }

        // Initial display
        updatePriceDisplay();

        // On change event
        planSelect.addEventListener('change', updatePriceDisplay);
    });
</script>

@endsection