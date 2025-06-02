@extends('front.layout')
@section('content')

<!-- ========================  Checkout ======================== -->
<section class="checkout">
    
    <header>
                <div class="container">
                    <h2 class="title">Please fill out the form below.</h2>
                    <div class="text">
                        <p>Proceed To Hiring!</p>
                    </div>
                </div>
    </header>
    <div class="container">
        <div class="cart-wrapper">
            <div class="note-block">
                <div class="row">
                    <div class="col-md-12 .text-xl-center">
                        <form name="myForm" id="payment_form" class="payment_com" method="post" action="{{route('developer_payment_initiate')}}">
                           @csrf
                            <div class="row">
                                <?php 
                                $id= Session::get('user_login_id');
                                $dev_id= Session::get('dev_id');
                                $tperhr= Session::get('tperhr');
                
                                foreach($user_details as $user) { 
                                    if($id == $user->id )
                                    { ?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="fname" id="fname" class="form-control" placeholder="Your name" value="<?php echo $user->fname; ?>" required="required">
                                            @if ($errors->has('fname'))
                                                <strong class="text-danger">{{ $errors->first('fname') }}</strong>                                  
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
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
                                            <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Enter Company Name" value="<?php echo $user->company_name; ?>" required="required">
                                            @if ($errors->has('company_name'))
                                                <strong class="text-danger">{{ $errors->first('company_name') }}</strong>                                  
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            
                                             <input type="text"name="country" id="country" class="form-control" placeholder="Enter Country" required="required">
                                            </select>
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
                                    <div class="col-6 ">
                                        <button type="submit" class="btn btn-primary">Continue <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                                    </div>
                                <?php }
                                } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr />
    </div>
    </section>  
    @endsection