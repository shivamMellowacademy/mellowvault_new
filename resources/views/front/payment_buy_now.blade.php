@extends('front.layout')
@section('content')

        <!-- ========================  Checkout ======================== -->
<?php
    foreach ($hosting as $h) {
?>
<section class="checkout pt-0">
    <div class="container">
        <div class="cart-wrapper">
            <div class="note-block">
                <form name="myForm" id="payment_form" class="payment_com" method="post" action="{{route('payment_initiate_buy_now',['id'=>''.$h->id.''])}}">
                @csrf
                    <?php 
                    $id= Session::get('user_login_id');
                    

                    foreach($user_details as $user) { 
                        if($id == $user->id )
                        { ?>
                            <div class="row">
                                <div class="col-md-8 .text-xl-center">
                                    
                                        <div class="row">
                                            
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" name="fname" id="fname" class="form-control" placeholder="Your name" value="<?php echo $user->fname; ?>" required="required">
                                                        @if ($errors->has('fname'))
                                                            <strong class="text-danger">{{ $errors->first('fname') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" name="lname" id="lname" class="form-control" placeholder="Your name" value="<?php echo $user->lname; ?>" required="required">
                                                        @if ($errors->has('lname'))
                                                            <strong class="text-danger">{{ $errors->first('lname') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                           
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="email" name="email" id="email" class="form-control" placeholder="Your email" value="<?php echo $user->email; ?>" required="required">
                                                        @if ($errors->has('email'))
                                                            <strong class="text-danger">{{ $errors->first('email') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="tel" name="phone" id="phone" class="form-control" maxlength="10" placeholder="Enter Phone" value="<?php echo $user->phone; ?>"  required="required">
                                                        @if ($errors->has('phone'))
                                                            <strong class="text-danger">{{ $errors->first('phone') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter Company Name" value="<?php echo $user->company_name; ?>">
                                                        @if ($errors->has('company_name'))
                                                            <strong class="text-danger">{{ $errors->first('company_name') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="country" id="country" class="form-control" placeholder="Enter Country">
                                                        
                                                        @if ($errors->has('country'))
                                                            <strong class="text-danger">{{ $errors->first('country') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="state" id="state" class="form-control" placeholder="Enter State" required="required">
                                                        @if ($errors->has('state'))
                                                            <strong class="text-danger">{{ $errors->first('state') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="city" id="city" class="form-control" placeholder="Enter City" required="required">
                                                        @if ($errors->has('city'))
                                                            <strong class="text-danger">{{ $errors->first('city') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea type="text" name="address_one" id="address_one" class="form-control" placeholder="Address Line 1" required="required"></textarea>
                                                        @if ($errors->has('address_one'))
                                                            <strong class="text-danger">{{ $errors->first('address_one') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea type="text" name="address_two" id="address_two" class="form-control" placeholder="Address Line 2"></textarea>
                                                        @if ($errors->has('address_two'))
                                                            <strong class="text-danger">{{ $errors->first('address_two') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="number" name="code" id="code" class="form-control" placeholder="Enter Zip / Postal Code" required="required">
                                                        @if ($errors->has('code'))
                                                            <strong class="text-danger">{{ $errors->first('code') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="gst" id="gst" class="form-control" placeholder="Enter GSTIN">
                                                        @if ($errors->has('gst'))
                                                            <strong class="text-danger">{{ $errors->first('gst') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>         

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control" id="purpose" name="purpose" placeholder="Your Purpose" rows="10"></textarea>
                                                        @if ($errors->has('purpose'))
                                                            <strong class="text-danger">{{ $errors->first('purpose') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                               
                                        </div>
                                  
                                </div>

                                <div class="col-md-4 text-xl-center">
                                    
                                        <div class="row">
                                            
                                                <div class="col-md-12">
                                                    <h4>Price</h4>
                                                    <hr/>
                                                    
                                                    <center>
                                                        <table>
                                                            <tr>
                                                                <td><b> Price : </b></td>
                                                                <td>INR <?php echo $total_price = $h->hostingprice; ?> </td>
                                                            </tr>
                                                           
                                                        </table>
                                                    </center>

                                                 
                                                   
                                                </div>

                                               
                                                
                                            
                                        </div>
                                        <div style="padding-top:20px">
                                            <button type="submit" class="btn btn-primary">Continue <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                                        </div>
                                    
                                </div>
                            </div>

                    <?php  }

                    } ?>
                </form>
            </div>
        </div>
        <hr />
    </div>

    <button id="rzp-button1" hidden>Pay</button>  
            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
            <script>
            var options = {
                "key": "{{$response['razorpayId']}}", // Enter the Key ID generated from the Dashboard
                "amount": "{{$response['amount']}}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "currency": "{{$response['currency']}}",
                "fname": "{{$response['fname']}}",
                "description": "{{$response['description']}}",
                //"image": "http://sharpcard.in/public/upload/img/logo.png", // You can give your logo url
                "order_id": "{{$response['orderId']}}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                "handler": function (response){
                    // After payment successfully made response will come here
                    // Let's send this response to Controller for update the payment response
                    // Create a form for send this data
                    // Set the data in form
                    document.getElementById('rzp_paymentid').value = response.razorpay_payment_id;
                    document.getElementById('rzp_orderid').value = response.razorpay_order_id;
                    document.getElementById('rzp_signature').value = response.razorpay_signature;

                    // // Let's submit the form automatically
                    document.getElementById('rzp-paymentresponse').click();
                },
                "prefill": {
                    "fname": "{{$response['fname']}}",
                    "lname": "{{$response['lname']}}",
                    "email": "{{$response['email']}}",
                    "phone": "{{$response['phone']}}",
                    "company_name": "{{$response['company_name']}}",
                    "country": "{{$response['country']}}",
                    "state": "{{$response['state']}}",
                    "city": "{{$response['city']}}",
                    "address_one": "{{$response['address_one']}}",
                    "address_two": "{{$response['address_two']}}",
                    "code": "{{$response['code']}}",
                    "gst": "{{$response['gst']}}",
                    "purpose": "{{$response['purpose']}}"
                },
                
                "theme": {
                    "color": "#800000"
                }
            };
            var rzp1 = new Razorpay(options);
            window.onload = function(){
                document.getElementById('rzp-button1').click();
            };

            document.getElementById('rzp-button1').onclick = function(e){
                rzp1.open();
                e.preventDefault();
            }
            </script>

            <!-- I'l copy the form  -->
            <!-- This form is hidden -->
            <!-- Let's crate the controller function -->
            <form action="{{url('checkout_buy_now',['id'=>''.$h->id.''])}}" method="POST" hidden>
                    <input type="hidden" value="{{csrf_token()}}" name="_token" /> 
                    <input type="text" class="form-control" id="rzp_paymentid"  name="rzp_paymentid">
                    <input type="text" class="form-control" id="rzp_orderid" name="rzp_orderid">
                    <input type="text" class="form-control" id="rzp_signature" name="rzp_signature">
                <button type="submit" id="rzp-paymentresponse" class="btn btn-primary">Submit</button>
            </form>
 </section>  

    <?php session(['total_price' => $total_price]); } ?>


    @endsection