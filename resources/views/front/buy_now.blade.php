@extends('front.layout')
@section('content')

        <!-- ========================  Checkout ======================== -->


<?php 
    if($hosting_order_Details_total > 0){
?>

    <br><br><br><br><br>
    <?php 
        foreach ($hosting_order_Details as $k) {
   
    ?>
        <center>
            <div class="container">            
                <div class="cart-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                           <center> <h5><img src="{{ URL::asset('public/front/assets/images/buynow.png') }}" class="rounded-circle" width="310px" height="250px"></h5>
                            <h4 class="card-title">You Already Purchased Hosting.</h4>
                            <hr style="width:550px;">
                            <a class="btn btn-primary btn-lg" href="{{route('view_invoice',['order_id'=>''.$k->order_id.''])}}" target="_blank" role="button">Invoice    <i class="fa fa-arrow-right"></i></a> 
                            </center> 
                        </div>
                    </div> 
                </div>
            </div> 
        </center>
    <?php }?>


<?php } else{
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
</section>  

<?php 
    session(['total_price' => $total_price]);
 } } ?>

    @endsection