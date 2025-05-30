@extends('front.layout')
@section('content')

        <section class="checkout">
           
                <header>
                    <div class="container">
                        <h2 class="title">Invoice</h2>
                        <!-- <div class="text">
                            <p>Dear customer, your payment for your online Elements placed and has been approved order reference number : (order id). To get further payment support for your purchase, please sign up using your email address at Mellow Elements.</p>
                        </div> -->
                    </div>
                </header>

                <div class="container">
                    <div class="cart-wrapper">
                        <div class="note-block">
                            <div class="row">
                                @foreach ($invoice as $inv)
                                @foreach ($payment as $p)
                                @endforeach
                                @endforeach

                                <div class="col-md-6">
                                    <div class="h4">Shipping info</div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Name</strong> <br />
                                                <span>{{$inv->fname}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Email</strong><br />
                                                <span>{{$inv->email}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Phone</strong><br />
                                                <span>{{$inv->phone}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Code</strong><br />
                                                <span>{{$inv->code}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>City</strong><br />
                                                <span>{{$inv->city}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Address</strong><br />
                                                <span>{{$inv->address_one}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Company name</strong><br />
                                                <span>{{$inv->company_name}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="h4">Order details</div>
                                    <hr />

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Order no.</strong> <br />
                                                <span>{{ $inv->order_id }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Transaction ID</strong> <br />
                                                <span>{{ $p->razorpay_payment_id }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>Order date</strong> <br />
                                                <span>{{ $inv->date }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />

                    <div class="cart-wrapper">
                        <div class="cart-block cart-block-header clearfix">
                            <div  class="text-center"><span></span></div>
                            <div class="text-center"><span></span></div>
                            <div><span></span></div>
                            <div class="text-center"><span></span></div>
                        </div>
                        <div class="clearfix">
                            <?php
                            $i=1;
                            
                            foreach($details as $d) {
                            $price = $d->tprice; ?>
                                <div class="cart-block cart-block-item clearfix">
                                    <?php if($d->image == ''){ ?>
                                        <div class="image text-center">
                                            <video width="100%" height="auto" controls controlsList="nodownload" data-play="hover" muted="muted" onmouseover="this.play()" onmouseout="this.pause();" ><source class="embed-responsive-item" src="<?php echo URL::asset('public/upload/video/'.$d->video.'') ?>" type="video/mp4" allowfullscreen></video>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="image text-center">
                                            <img src="<?php echo URL::asset('public/upload/product/'.$d->image); ?>" width="100" height="100" alt="Product Image">
                                        </div>
                                    <?php } ?>
                                    <div class="title">
                                        <div class="text-center">{{$d->name}} </div>
                                        <div></div>
                                    </div>
                                    <div class="quantity">
                                        
                                    </div>
                                    <div class="price">
                                    <span class="final"></span>
                                        <span class="text-center">
                                         Price: INR {{$d->price}}  ( Tax: {{$d->tax}} % )
                                        </span>
                                        
                                    </div>
                                </div>
                            <?php $i++;
                            } ?>
                        </div>

                        <div class="clearfix">
                            <div class="cart-block cart-block-footer cart-block-footer-price clearfix">
                                <div>
                                    <span class="checkbox">
                                        <span class="alert alert-info">Your payment completed successfully! </span>
                                    </span>
                                </div>
                                <div>
                                    <div class="h2">INR {{$price}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix">
                        <div class="row">
                            <div class="col-6 offset-6 text-right">
                                <a href="{{route('invoice_pdf', $inv->order_id)}}" class="btn btn-success"><span class="icon icon-download"></span>Download Bill</a>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
@endsection