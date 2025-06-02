    @extends('front.layout')
    @section('content')

    <!-- ========================  Checkout ======================== -->
    <section class="checkout py-5" style="margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0"><i class="fa fa-user-circle mr-2"></i> Billing Information</h4>
                        </div>
                        <div class="card-body">
                            <form id="payment_form">
                                @csrf
                                <?php 
                                $id = Session::get('user_login_id');
                                $p_id = Session::get('p_id');
                                $tprice = Session::get('tprice');
                                $tax_rate = Session::get('tax_amount'); // This should be the tax percentage (e.g., 18)
                                
                                // Calculate tax amount properly
                                $total_price = $tprice + $tax_rate;
                                
                                foreach($user_details as $user) { 
                                    if($id == $user->id) { ?>
                                        <div class="row">
                                            <!-- Personal Information -->
                                            <div class="col-md-6 mb-3">
                                                <label for="fname" class="form-label text-dark">First Name *</label>
                                                <input type="text" name="fname" id="fname" class="form-control" readonly value="<?php echo $user->fname; ?>" required>
                                                @if ($errors->has('fname'))
                                                    <small class="text-danger">{{ $errors->first('fname') }}</small>
                                                @endif
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="lname" class="form-label text-dark">Last Name *</label>
                                                <input type="text" name="lname" id="lname" class="form-control" readonly value="<?php echo $user->lname; ?>" required>
                                                @if ($errors->has('lname'))
                                                    <small class="text-danger">{{ $errors->first('lname') }}</small>
                                                @endif
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="email" class="form-label text-dark">Email *</label>
                                                <input type="email" name="email" id="email" class="form-control" readonly value="<?php echo $user->email; ?>" required>
                                                @if ($errors->has('email'))
                                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                                @endif
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="phone" class="form-label text-dark">Phone *</label>
                                                <input type="tel" name="phone" id="phone" class="form-control" readonly maxlength="10" value="<?php echo $user->phone; ?>" required>
                                                @if ($errors->has('phone'))
                                                    <small class="text-danger">{{ $errors->first('phone') }}</small>
                                                @endif
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="company_name" class="form-label text-dark">Company Name</label>
                                                <input type="text" name="company_name" id="company_name" readonly class="form-control" value="<?php echo $user->company_name; ?>">
                                                @if ($errors->has('company_name'))
                                                    <small class="text-danger">{{ $errors->first('company_name') }}</small>
                                                @endif
                                            </div>

                                            <!-- Address Information -->
                                            <div class="col-md-12 mb-3">
                                                <label for="country" class="form-label text-dark">Country *</label>
                                                <select name="country" id="country" class="form-control" readonly required>
                                                    <option value="">Select Country</option>
                                                    <option value="India" selected>India</option>
                                                    <option value="United States">United States</option>
                                                    <!-- Other country options -->
                                                </select>
                                                @if ($errors->has('country'))
                                                    <small class="text-danger">{{ $errors->first('country') }}</small>
                                                @endif
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="state" class="form-label text-dark">State *</label>
                                                <input type="text" name="state" id="state" class="form-control" required>
                                                @if ($errors->has('state'))
                                                    <small class="text-danger">{{ $errors->first('state') }}</small>
                                                @endif
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="city" class="form-label text-dark">City *</label>
                                                <input type="text" name="city" id="city" class="form-control" required>
                                                @if ($errors->has('city'))
                                                    <small class="text-danger">{{ $errors->first('city') }}</small>
                                                @endif
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="address_one" class="form-label text-dark">Address Line 1 *</label>
                                                <textarea name="address_one" id="address_one" class="form-control" rows="2" required></textarea>
                                                @if ($errors->has('address_one'))
                                                    <small class="text-danger">{{ $errors->first('address_one') }}</small>
                                                @endif
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="address_two" class="form-label text-dark">Address Line 2</label>
                                                <textarea name="address_two" id="address_two" class="form-control" rows="2"></textarea>
                                                @if ($errors->has('address_two'))
                                                    <small class="text-danger">{{ $errors->first('address_two') }}</small>
                                                @endif
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="code" class="form-label text-dark">Postal Code *</label>
                                                <input type="number" name="code" id="code" class="form-control" required>
                                                @if ($errors->has('code'))
                                                    <small class="text-danger">{{ $errors->first('code') }}</small>
                                                @endif
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="gst" class="form-label text-dark">GSTIN</label>
                                                <input type="text" name="gst" id="gst" class="form-control" placeholder="22AAAAA0000A1Z5">
                                                @if ($errors->has('gst'))
                                                    <small class="text-danger">{{ $errors->first('gst') }}</small>
                                                @endif
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="purpose" class="form-label text-dark">Purpose of Purchase</label>
                                                <textarea class="form-control" id="purpose" name="purpose" rows="3" placeholder="Let us know if you have any special requirements"></textarea>
                                                @if ($errors->has('purpose'))
                                                    <small class="text-danger">{{ $errors->first('purpose') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    <?php }
                                } ?>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card mb-4 border-0 shadow-sm sticky-top">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0"><i class="fa fa-shopping-cart mr-2"></i> Order Summary</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal:</span>
                                <span class="text-dark">₹{{ number_format($tprice, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Tax:</span>
                                <span class="text-dark">₹{{ number_format($tax_rate, 2) }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between font-weight-bold h5">
                                <span class="text-primary">Total Amount:</span>
                                <span class="text-primary">₹{{ number_format($total_price, 2) }}</span>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <button type="button" id="proceed_to_payment" class="btn btn-primary btn-block btn-lg py-3">
                                <i class="fa fa-lock mr-2"></i> Proceed to Payment
                            </button>
                            <a href="{{ route('index') }}" class="btn btn-outline-secondary btn-block mt-2 py-2">
                                <i class="fa fa-shopping-bag mr-2"></i> Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .checkout {
            background-color: #f8f9fa;
        }
        .form-label text-dark {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .form-label text-dark:after {
            content: ' *';
            color: #dc3545;
            display: none;
        }
        .form-label text-dark.required:after {
            display: inline;
        }
        .card {
            border-radius: 0.5rem;
        }
        .card-header {
            border-radius: 0.5rem 0.5rem 0 0 !important;
            padding: 1.25rem 1.5rem;
        }
        select.form-control:not([size]):not([multiple]) {
            height: calc(2.25rem + 8px);
        }
        @media (max-width: 991.98px) {
            .sticky-top {
                position: static !important;
            }
        }
        .btn-block {
            font-weight: 500;
        }
    </style>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
document.getElementById('proceed_to_payment').addEventListener('click', async function(e) {
    e.preventDefault();
    
    // Validate required fields
    const requiredFields = ['state', 'city', 'address_one', 'code'];
    let isValid = true;
    
    requiredFields.forEach(field => {
        const element = document.getElementById(field);
        if (!element.value.trim()) {
            element.classList.add('is-invalid');
            isValid = false;
        } else {
            element.classList.remove('is-invalid');
        }
    });
    
    if (!isValid) {
        alert('Please fill all required fields');
        return;
    }
    
    // Show loading state
    const submitBtn = this;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin mr-2"></i> Processing...';
    
    try {
        // First create an order on your server
        const amount = {{ $total_price }};
        
        // Get form data
        const formData = new FormData(document.getElementById('payment_form'));
        
        const options = {
            "key": "{{ env('RAZORPAY_KEY') }}",
            "amount": amount *100,
            "currency": "INR",
            "name": "Mellow Vault",
            "description": "Order Payment",
            "handler": function (response) {
                // Submit the form with payment details
               fetch("{{route('payment_initiate')}}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id: response.razorpay_order_id,
                        razorpay_signature: response.razorpay_signature,
                        order_data: Object.fromEntries(formData)
                    })
                })
                .then(res => res.json())
                .then(data => {
                  
                        window.location.href = data.redirect;
                   
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Payment verification failed');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fa fa-lock mr-2"></i> Proceed to Payment';
                })
            },
            "prefill": {
                "name": document.getElementById('fname').value + ' ' + document.getElementById('lname').value,
                "email": document.getElementById('email').value,
                "contact": document.getElementById('phone').value
            },
            "notes": {
                "address": document.getElementById('address_one').value,
                "purpose": document.getElementById('purpose').value
            },
            "theme": {
                "color": "#007bff"
            }
        };
        
        const rzp = new Razorpay(options);
        rzp.open();
        
        rzp.on('payment.failed', function (response) {
            alert('Payment failed. Please try again. Error: ' + response.error.description);
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fa fa-lock mr-2"></i> Proceed to Payment';
        });
        
    } catch (error) {
        console.error('Payment error:', error);
        alert('Payment initialization failed: ' + error.message);
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fa fa-lock mr-2"></i> Proceed to Payment';
    }
});
</script>
    @endsection