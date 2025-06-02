@extends('admin.layout')
@section('content')

<div class="page-content">
    <div class="main-wrapper container">   
        <div class="row">
            <div class="col-xl">
                
                <div class="card">
                    <div class="card-body">
                        <?php foreach($developer_details as $deve) { ?>
                            <h5 class="card-title">Transaction To <?php echo $deve->name; ?> <?php echo $deve->last_name; ?></h5>
                        <?php } ?>
                        <form method="post" action="{{ route('payment_initiate_to_developer',['id'=>''.$deve->id.'']) }}" enctype="multipart/form-data">
                            @csrf
                            <?php foreach($developer_details as $deve) { 
                               $original_price = $deve->original_price;
                                $dev_id = $deve->dev_id;
                                session(['original_price' => $original_price]);
                                session(['dev_id' => $deve->dev_id]);
                                session(['order_id' => $deve->order_id]);
                            ?>
                            <div class="form-row">
                                <div class="col-md-9">
                                    <div class="form-group col-md-12">
                                        <label for="heading">First Name</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Heading" value="<?php echo $deve->name; ?>"  required="">
                                        @if ($errors->has('name'))
                                        <strong class="text-danger">{{ $errors->first('name') }}</strong>                                  
                                        @endif
                                    </div>
                                    
                                   
                                    <div class="form-group col-md-12">
                                        <label for="heading">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Heading" value="<?php echo $deve->last_name; ?>"  required="">
                                        @if ($errors->has('last_name'))
                                        <strong class="text-danger">{{ $errors->first('last_name') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="heading">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter Heading" value="<?php echo $deve->email; ?>"  required="">
                                        @if ($errors->has('email'))
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="heading">Address</label>
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Enter Heading" value="<?php echo $deve->address; ?>"  required="">
                                        @if ($errors->has('address'))
                                        <strong class="text-danger">{{ $errors->first('address') }}</strong>                                  
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="heading">Contact No.</label>
                                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Heading" value="<?php echo $deve->phone; ?>"  required="">
                                        @if ($errors->has('phone'))
                                        <strong class="text-danger">{{ $errors->first('phone') }}</strong>                                  
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <center>
                                        <h4>Transfer Amount</h4>
                                        <hr/>
                                        <table>
                                            <tr>
                                                <td><b> Amount : </b></td>
                                                <td>INR <?php echo $deve->original_price; ?></td>
                                            </tr>
                                        </table>
                                        <div  style="padding-top:20px">
                                            <button type="submit" class="btn btn-primary">Continue</button>
                                        </div>
                                    </center>
                                </div>
                            </div>
                           
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button id="rzp-button1" hidden>Pay</button>  
            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
            <script>
            var options = {
                "key": "{{$response['razorpayId']}}", // Enter the Key ID generated from the Dashboard
                "amount": "{{$response['amount']}}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "currency": "{{$response['currency']}}",
                "name": "{{$response['name']}}",
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
                    "name": "{{$response['name']}}",
                    "last_name": "{{$response['last_name']}}",
                    "email": "{{$response['email']}}",
                    "phone": "{{$response['phone']}}",
                    "address": "{{$response['address']}}",
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
            <form action="{{url('amount_transfer')}}" method="POST" hidden>
                    <input type="hidden" value="{{csrf_token()}}" name="_token" /> 
                    <input type="text" class="form-control" id="rzp_paymentid"  name="rzp_paymentid">
                    <input type="text" class="form-control" id="rzp_orderid" name="rzp_orderid">
                    <input type="text" class="form-control" id="rzp_signature" name="rzp_signature">
                <button type="submit" id="rzp-paymentresponse" class="btn btn-primary">Submit</button>
            </form>

</div>

@endsection