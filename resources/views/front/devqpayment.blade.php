@extends('front.layout')
@section('content')

<!-- ========================  Checkout ======================== -->
<br><br>
<?php
 foreach($developer_resourcequl as $user) { ?>
<section class="checkout pt-0">
    <div class="container">
        <div class="cart-wrapper">
            <div class="note-block">
                <form name="myForm" id="payment_form" class="payment_com" method="post" action="{{route('devq_payment_initiate',['dev_id'=>''.$user->dev_id.''])}}">
                @csrf
                    <!--< ?php -->
                    <!--$id= Session::get('dev_id');-->
                    <!--$tprice= Session::get('perhr');-->
                    <!--//echo $id; exit();-->
                 
                    <!--foreach($developer_resources as $user) { -->
                    <!--    if($id == $user->dev_id )-->
                    <!--    { ?>-->
                            <div class="row">
                                <div class="col-md-8 .text-xl-center">
                                    
                                        <div class="row">
                                            
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" name="name" id="fname" class="form-control" placeholder="Your name" value="<?php echo $user->name; ?>" required="required">
                                                        @if ($errors->has('name'))
                                                            <strong class="text-danger">{{ $errors->first('name') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" name="last_name" id="lname" class="form-control" placeholder="Your name" value="<?php echo $user->last_name; ?>" required="required">
                                                        @if ($errors->has('	last_name'))
                                                            <strong class="text-danger">{{ $errors->first('	last_name') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                           
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="hidden" name="email" id="email" class="form-control" placeholder="Your email" value="<?php echo $user->email; ?>" required="required">
                                                        @if ($errors->has('email'))
                                                            <strong class="text-danger">{{ $errors->first('email') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="hidden" name="phone" id="phone" class="form-control" maxlength="10" placeholder="Enter Phone" value="<?php echo $user->phone; ?>"  required="required">
                                                        @if ($errors->has('phone'))
                                                            <strong class="text-danger">{{ $errors->first('phone') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select name="country" id="country" class="form-control" required>
                                                            <option value="">Country</option>
                                                            <option value="Afghanistan">Afghanistan</option>
                                                            <option value="Albania">Albania</option>
                                                            <option value="Algeria">Algeria</option>
                                                            <option value="American Samoa">American Samoa</option>
                                                            <option value="Andorra">Andorra</option>
                                                            <option value="Anguilla">Anguilla</option>
                                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                            <option value="Argentina">Argentina</option>
                                                            <option value="Armenia">Armenia</option>
                                                            <option value="Aruba">Aruba</option>
                                                            <option value="Australia">Australia</option>
                                                            <option value="Austria">Austria</option>
                                                            <option value="Azerbaijan">Azerbaijan</option>
                                                            <option value="Bahamas">Bahamas</option>
                                                            <option value="Bahrain">Bahrain</option>
                                                            <option value="Bangladesh">Bangladesh</option>
                                                            <option value="Barbados">Barbados</option>
                                                            <option value="Belarus">Belarus</option>
                                                            <option value="Belgium">Belgium</option>
                                                            <option value="Belize">Belize</option>
                                                            <option value="Benin">Benin</option>
                                                            <option value="Bermuda">Bermuda</option>
                                                            <option value="Bhutan">Bhutan</option>
                                                            <option value="Bolivia">Bolivia</option>
                                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                            <option value="Botswana">Botswana</option>
                                                            <option value="Brazil">Brazil</option>
                                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                            <option value="Bulgaria">Bulgaria</option>
                                                            <option value="Burkina Faso">Burkina Fasotan</option>
                                                            <option value="Burkina Faso">Burkina Faso</option>
                                                            <option value="Cambodia">Cambodia</option>
                                                            <option value="Cameroon">Cameroon</option>
                                                            <option value="Canada">Canada</option>
                                                            <option value="Cape Verde">Cape Verde</option>
                                                            <option value="Cayman Islands">Cayman Islands</option>
                                                            <option value="Central African Republic">Central African Republic</option>
                                                            <option value="Chad">Chad</option>
                                                            <option value="Chile">Chile</option>
                                                            <option value="China">China</option>
                                                            <option value="Christmas Island">Christmas Island</option>
                                                            <option value="Cocos Islands">Cocos Islands</option>
                                                            <option value="Colombia">Colombia</option>
                                                            <option value="Comoros">Comoros</option>
                                                            <option value="Kinshasa">Kinshasa</option>
                                                            <option value="Brazzaville">Brazzaville</option>
                                                            <option value="Cook Islands">Cook Islands</option>
                                                            <option value="Costa Rica">Costa Rica</option>
                                                            <option value="C么te D'ivoire">C么te D'ivoire </option>
                                                            <option value="Croatia">Croatia</option>
                                                            <option value="Cuba">Cuba</option>
                                                            <option value="Cyprus">Cyprus</option>
                                                            <option value="Czech Republic">Czech Republic</option>
                                                            <option value="Denmark">Denmark</option>
                                                            <option value="Djibouti">Djibouti</option>
                                                            <option value="Dominica">Dominica</option>
                                                            <option value="Dominican Republic">Dominican Republic</option>
                                                            <option value="East Timor">East Timor</option>
                                                            <option value="Ecuador">Ecuador</option>
                                                            <option value="Egypt">Egypt</option>
                                                            <option value="El Salvador">El Salvador</option>
                                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                            <option value="Eritrea">Eritrea</option>
                                                            <option value="Estonia">Estonia</option>
                                                            <option value="Ethiopia">Ethiopia</option>
                                                            <option value="Falkland Islands">Falkland Islands</option>
                                                            <option value="Faroe Islands">Faroe Islands</option>
                                                            <option value="Fiji">Fiji</option>
                                                            <option value="Finland">Finland</option>
                                                            <option value="France">France</option>
                                                            <option value="French Guiana">French Guiana</option>
                                                            <option value="French Polynesia">French Polynesia</option>
                                                            <option value="French Southern Territories">French Southern Territories</option>
                                                            <option value="Gabon">Gabon</option>
                                                            <option value="The Gambia">The Gambia</option>
                                                            <option value="Georgia">Georgia</option>
                                                            <option value="Germany">Germany</option>
                                                            <option value="Ghana">Ghana</option>
                                                            <option value="Gibraltar">Gibraltar</option>
                                                            <option value="Greece">Greece</option>
                                                            <option value="Greenland">Greenland</option>
                                                            <option value="Grenada">Grenada</option>
                                                            <option value="Guadeloupe">Guadeloupe</option>
                                                            <option value="Guam">Guam</option>
                                                            <option value="Guatemala">Guatemala</option>
                                                            <option value="Guinea">Guinea</option>
                                                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                            <option value="Guyana">Guyana</option>
                                                            <option value="Haiti">Haiti</option>
                                                            <option value="Holy See">Holy See</option>
                                                            <option value="Honduras">Honduras</option>
                                                            <option value="Hong Kong">Hong Kong</option>
                                                            <option value="Hungary">Hungary</option>
                                                            <option value="Iceland">Iceland</option>
                                                            <option value="India">India</option>
                                                            <option value="Indonesia">Indonesia</option>
                                                            <option value="Iran">Iran</option>
                                                            <option value="Iraq">Iraq</option>
                                                            <option value="Ireland">Ireland</option>
                                                            <option value="Israel">Israel</option>
                                                            <option value="Italy">Italy</option>
                                                            <option value="Ivory Coast">Ivory Coast</option>
                                                            <option value="Jamaica">Jamaica</option>
                                                            <option value="Japan">Japan</option>
                                                            <option value="Jordan">Jordan</option>
                                                            <option value="Kazakhstan">Kazakhstan</option>
                                                            <option value="Kenya">Kenya</option>
                                                            <option value="Kiribati">Kiribati</option>
                                                            <option value="North Korea">North Korea</option>
                                                            <option value="South Korea">South Korea</option>
                                                            <option value="Kosovo">Kosovo</option>
                                                            <option value="Kuwait">Kuwait</option>
                                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                            <option value="Lao">Lao</option>
                                                            <option value="Latvia">Latvia</option>
                                                            <option value="Lebanon">Lebanon</option>
                                                            <option value="Lesotho">Lesotho</option>
                                                            <option value="Liberia">Liberia</option>
                                                            <option value="Libya">Libya</option>
                                                            <option value="Liechtenstein">Liechtenstein</option>
                                                            <option value="Lithuania">Lithuania</option>
                                                            <option value="Luxembourg">Luxembourg</option>
                                                            <option value="Macau">Macau</option>
                                                            <option value="Malawi">Malawi</option>
                                                            <option value="Malaysia">Malaysia</option>
                                                            <option value="Maldives">Maldives</option>
                                                            <option value="Mali">Mali</option>
                                                            <option value="Malta">Malta</option>
                                                        </select>
                                                        @if ($errors->has('country'))
                                                            <strong class="text-danger">{{ $errors->first('country') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" name="state" id="state" class="form-control" placeholder="Enter State" required="required">
                                                        @if ($errors->has('state'))
                                                            <strong class="text-danger">{{ $errors->first('state') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="address_one" id="address_one" class="form-control" placeholder="Address Line 1" required="required">
                                                        
                                                        @if ($errors->has('address_one'))
                                                            <strong class="text-danger">{{ $errors->first('address_one') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" name="city" id="city" class="form-control" placeholder="Enter City" required="required">
                                                        @if ($errors->has('city'))
                                                            <strong class="text-danger">{{ $errors->first('city') }}</strong>                                  
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="number" name="code" id="code" class="form-control" placeholder="Enter Zip / Postal Code" required="required">
                                                        <!--<input type="number" name="devid" id="devid" class="form-control" placeholder="Enter Zip / Postal Code" required="required">-->
                                                        @if ($errors->has('code'))
                                                            <strong class="text-danger">{{ $errors->first('code') }}</strong>                                  
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
                                                    <h4>Premium Total</h4>
                                                    <hr/>
                                                    <center>
                                                        <table>
                                                            <?php 
                                                                foreach($dev_qualified_table_details as $premium) { ?>
                                                           
                                                            <tr>
                                                                <td><b> Monthly Price : </b></td>
                                                                <td><?php echo $premium->perhr; ?> INR</td>
                                                            </tr>
                                                           
                                                            <?php } ?> 
                                                            
                                                            <tr>
                                                                <td><b> Total Price : </b></td>
                                                                <td><?php echo $total_price = $premium->perhr * 1 ?> INR</td>
                                                            </tr>
                                                            
                                                        </table>
                                                    </center>
                                                </div>
                                                
                                                <?php session(['total_price' => $total_price]); ?>

                                        </div>
                                        <div style="padding-top:20px">
                                            <button type="submit" class="btn btn-primary">Continue <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                                        </div>
                                </div>
                            </div>

                    <!--// < ?php  }-->

                    <!--} ?>-->
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
                    "country": "{{$response['country']}}",
                    "state": "{{$response['state']}}",
                    "city": "{{$response['city']}}",
                    "address_one": "{{$response['address_one']}}",
                    "code": "{{$response['code']}}",
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

            <!-- Let's crate the controller function -->
            <form action="{{url('dev_qcheckout', ['dev_id'=>''.$user->dev_id.''])}}" method="POST" hidden>
                    <input type="hidden" value="{{csrf_token()}}" name="_token" /> 
                    <input type="text" class="form-control" id="rzp_paymentid"  name="rzp_paymentid">
                    <input type="text" class="form-control" id="rzp_orderid" name="rzp_orderid">
                    <input type="text" class="form-control" id="rzp_signature" name="rzp_signature">
                <button type="submit" id="rzp-paymentresponse" class="btn btn-primary">Submit</button>
            </form>
 </section>  

<?php } ?>    


@endsection