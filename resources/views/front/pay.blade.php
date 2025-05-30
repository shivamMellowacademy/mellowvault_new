@extends('front.layout')
@section('content')

<style>

.card{
    margin-top: 160px; !important
}






</style>

<div class="container my-5" style="max-width: 600px;">
    <div class="card shadow rounded-4 p-4">
        <div class="text-center mb-4">
            <h3 class="text-primary fw-bold">Pay Developer</h3>
            <p class="text-muted mb-1">Custom amount payment with tax included</p>
        </div>

        <div class="mb-3">
            <label for="pay-amount" class="form-label text-dark">Enter Amount (INR)</label>
            <input type="number" id="pay-amount" class="form-control form-control-lg"
                   placeholder="e.g. {{ number_format($developer_details->perhr) }}"
                   min="{{ $developer_details->perhr * 0.20 }}"
                   max="{{ $developer_details->perhr }}" required>
            <div class="form-text text-muted mt-1">
                Min: ₹{{ number_format($developer_details->perhr * 0.20, 2) }} |
                Max: ₹{{ number_format($developer_details->perhr, 2) }}
            </div>
        </div>

        <div class="form-check mb-4">
            <input type="checkbox" class="" id="terms-check">
            <label class="form-check-label text-dark" for="terms-check">
                I agree to the <a href="{{ url('term') }}" class="text-decoration-underline">terms & conditions</a>.
            </label>
        </div>

        <div class="d-grid mb-3">
            <button id="pay-button" class="btn btn-primary btn-lg">
                <i class="fa fa-credit-card me-2"></i>Pay Now
            </button>
        </div>

        <div id="loader" style="display: none; text-align: center;">
            <img src="{{ asset('public/upload/1746529029853.gif') }}" alt="Processing..." style="height: 40px;">
            <p class="mt-2 text-muted">Processing your payment...</p>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    document.getElementById('pay-button').onclick = function(e) {
        e.preventDefault();

        const amountInput = document.getElementById('pay-amount');
        const checkbox = document.getElementById('terms-check');
        const amount = parseFloat(amountInput.value);
        const min = parseFloat(amountInput.min);
        const max = parseFloat(amountInput.max);

        if (isNaN(amount) || amount < min || amount > max) {
            alert(`Amount must be between ₹${min.toLocaleString('en-IN', { minimumFractionDigits: 2 })} and ₹${max.toLocaleString('en-IN', { minimumFractionDigits: 2 })}.`);
            return;
        }

        if (!checkbox.checked) {
            alert('Please agree to the terms and conditions.');
            return;
        }

        const taxRate = {{ $tax->tax }};
        const tax = amount * (taxRate / 100);
        const total = amount + tax;

        document.getElementById('loader').style.display = 'block';
        document.getElementById('pay-button').style.display = 'none';

        const options = {
            "key": "{{ env('RAZORPAY_KEY') }}",
            "amount": total * 100, // in paise
            "currency": "INR",
            "name": "Mellow",
            "description": "Developer Custom Payment",
            "handler": function (response) {
                fetch("{{ route('developer_payment_initiate') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        razorpay_payment_id: response.razorpay_payment_id,
                        dev_id: {{ $developer_details->dev_id }},
                        amount: amount,
                        tax: tax
                    })
                })
                .then(res => res.json())
                .then(data => {
                    document.getElementById('loader').style.display = 'none';
                    document.getElementById('pay-button').style.display = 'block';

                    if (data.status === 'success') {
                        window.location.href = data.redirect;
                    } else {
                        alert('Payment failed. Please try again.');
                    }
                });
            },
            "theme": {
                "color": "#0d6efd"
            }
        };

        const rzp = new Razorpay(options);
        rzp.open();
    };
</script>

@endsection
