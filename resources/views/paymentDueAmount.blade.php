<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <script>
        const id = {{ $order->id }};
        console.log(id);
        
        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}",
            "amount": {{ $amountDue + $tax }} * 100, // Convert to paise
            "currency": "INR",
            "name": "Mellow vault",
            "description": "Advance Payment",
            "handler": function (response) {
                fetch("{{route('verify.payment')}}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        id: id,
                        amountDue: {{ $amountDue }} ,
                        tax: {{ $tax }} ,
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id: response.razorpay_order_id,
                        razorpay_signature: response.razorpay_signature
                    })
                })
                
                .then(data => {
                  
                    window.location.href = "{{ route('thank_you') }}";
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("Payment processing error");
                });
            },
            "prefill": {
                "name": "{{ $order->developer_name ?? 'Customer Name' }}",
                "email": "{{ $order->developer_email ?? 'customer@example.com' }}",
                "contact": "{{ $order->phone ?? '9999999999' }}"
            },
            "theme": {
                "color": "#3399cc"
            }
        };
        
        var rzp = new Razorpay(options);
        rzp.open();
       
    </script>
</body>
</html>