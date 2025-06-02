@extends('developer.layout')
@section('content')

<div class="page-content">
        <div class="page-info container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Wallet</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </nav>
        </div>
        <div class="main-wrapper container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table id="complex-header" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Milestone Name</th>
                                                <th>Milestone Amount</th>
                                                <th>Withdraw Amount</th>
                                                <th>Transaction Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php foreach($developer_wallet_milestone as $d) { ?>
                                                <tr>
                                                    <td><?php echo $d->milestone_name; ?></td>
                                                    <td>
                                                        <?php 
                                                            
                                                            $price = $d->perhr; 
                                                            $days = $d->days;
                                                            echo $total_price = $days * $price;
                                                        ?>
                                                    </td>

                                                    <td><a href="{{route('withdraw',['milestone_id'=>''.$d->id.''])}}" class="btn btn-info bt-sm">Request For withdraw</a></td>
                                                    
                                                    <td><a href="{{route('all_transaction_details')}}" class="btn btn-success"> Transaction</a></td>
                                                </tr>  

                                                                                        
                                            <?php } ?>

                                        </tbody>                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <button id="rzp-button1" hidden>Pay</button>  
            <script src="https://api.razorpay.com/v1/payouts"></script>
            <script>
            var options = {
                "key": "{{$response['razorpayId']}}", // Enter the Key ID generated from the Dashboard
                "amount": "{{$response['amount']}}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "currency": "{{$response['currency']}}",
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
            <form action="{{url('withdraw_payment')}}" method="POST" hidden>
                    <input type="hidden" value="{{csrf_token()}}" name="_token" /> 
                    <input type="text" class="form-control" id="rzp_paymentid"  name="rzp_paymentid">
                    <input type="text" class="form-control" id="rzp_orderid" name="rzp_orderid">
                    <input type="text" class="form-control" id="rzp_signature" name="rzp_signature">
                <button type="submit" id="rzp-paymentresponse" class="btn btn-primary">Submit</button>
            </form>


@endsection