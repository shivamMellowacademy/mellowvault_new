@extends('front.layout')
@section('content')

<?php 
    
    if($order_history_emprty > 0  || $dev_order_history_empty > 0){
?>


        <section class="checkout pt-0">
            <header>
                <div class="container">
                    <h2 class="title">Order History</h2>
                    <div class="text">
                        <p>Your Order History</p>
                    </div>
                </div>
            </header>


            <div class="container">
                <div class="cart-wrapper">
                    <div class="cart-block cart-block-header clearfix">
                        <div><span><b>Product image</b></span></div>
                        <div style="padding-left:200px;"><span><b>Product name</b></span></div>
                        <div style="padding-left:20px;"><span><b>Price</span></b></div>
                        <div class="text-right"><span><b>Purchase time and date</b></span></div>
                    </div>

                    <?php 
                    $id= Session::get('user_login_id');
                    foreach($order_history as $orderhistory) { 
                        if($id == $orderhistory->u_id )
                        { ?>
                
                    <div class="clearfix">
                        <div class="cart-block cart-block-item clearfix">
                            <div class="image">
                                <a href="#"><img src="<?php echo URL::asset('public/upload/product/'.$orderhistory->image);?>" alt="" /></a>
                            </div>
                            <div class="title">
                                <div style="padding-left:180px;"><a href="#"><?php echo $orderhistory->name; ?></a></div>
                            </div>
                            <div class="price">
                                <span>Rs.<?php echo $orderhistory->price; ?></span>
                            </div>
                            <div class="price">
                                <span><?php echo $orderhistory->date; ?></span>
                            </div>
                        </div> 
                    </div><br>
                    <?php }
                    } ?>



                    <?php 
                    $id= Session::get('user_login_id');
                    foreach($dev_order_history as $devorderhistory) { 
                        if($id == $devorderhistory->u_id )
                        { ?>
                
                    <div class="clearfix">
                        <div class="cart-block cart-block-item clearfix">
                            <div class="image">
                                <a href="#"><img src="<?php echo URL::asset('public/upload/developer/'.$devorderhistory->image);?>" alt="" /></a>
                            </div>
                            <div class="title">
                                <div style="padding-left:180px;"><a href="#"><?php echo $devorderhistory->name; ?></a></div>
                            </div>
                            <div class="price">
                                <span>Rs.<?php echo $devorderhistory->perhr; ?></span>
                            </div>
                            <div class="price">
                                <span><?php echo $devorderhistory->date; ?></span>
                            </div>
                        </div> 
                    </div><br>
                    <?php }
                    } ?>
                </div>
            </div> 
        </section>
<?php }else{ ?>
    
    <br><br><br><br><br><bR><bR>
        <div class="container">            
            <div class="cart-wrapper">
                <div class="row">
                    
                    <div class="col-md-12">
                       <center> <h5><img src="{{ URL::asset('public/front/assets/images/2.png') }}" class="rounded-circle" width="310px" height="250px"></h5>
                        <h4 class="card-title">Oops! No Any Order Placed.</h4>
                        <hr style="width:550px;">
                        <a class="btn btn-primary btn-lg" href="{{route('index')}}" role="button">Go    <i class="fa fa-arrow-right"></i></a> 
                        </center> 
                    </div>
                </div> 
            </div>
        </div> 
<?php } ?>

       @endsection