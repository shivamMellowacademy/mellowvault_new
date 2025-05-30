@extends('front.layout')
@section('content')

<section class="blog blog-category blog-animated">
    <?php 
        if($order_empty > 0 ) { ?>
        
            <br>

            <header>
                <div class="container">
                    <h2 class="title">Downloads </h2>
                </div>
            </header>
            
            <div class="container">
                <div class="row">
                    <div class="col-md-3" style="padding-bottom:12px;">
                        <div class="sticky-top">
                            <div class="card">
                                <?php 
                                $id=Session::get('user_login_id');
                                foreach($user_details as $uu) { 
                                    if($id === $uu->id) { ?>
                                    <div class="card-header">
                                        <a href="#">Hi!  <?php echo $uu->fname;?></a>
                                    </div>
                                <?php }
                                } ?>
                                <div class="list-group">
                                    <a href="{{route('user_profile')}}" class="list-group-item"><i class="fa fa-user" aria-hidden="true"></i>   My Profile <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <a href="{{route('my_download')}}" class="list-group-item"><i class="fa fa-download" aria-hidden="true"></i>    Downloads <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <a href="{{route('act_setting')}}" class="list-group-item"><i class="fa fa-gear" aria-hidden="true"></i>    Account Settings <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <a href="{{route('show_invoice')}}" class="list-group-item"><i class="fa fa-yelp" aria-hidden="true"></i>   Invoice <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    
                                    <?php 
                                    if($developer_order_details > 0) {
                                    ?>
                                        <a href="{{route('client_dashboard')}}" class="list-group-item"><i class="fa fa-plus" aria-hidden="true"></i>   Work Space <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <a href="{{route('resource')}}" class="list-group-item"><i class="fa fa-child" aria-hidden="true"></i>   Resource <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <a href="{{route('assign_work')}}" class="list-group-item"><i class="fa fa-suitcase" aria-hidden="true"></i>    Assign Work <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <?php } ?>
                                    <a href="{{route('user_logout')}}" class="list-group-item"><i class="fa fa-sign-out" aria-hidden="true"></i>    Logout <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                </div> 
                            </div> 
                        </div>               
                    </div>
                    <div class="col-lg-9">
                        <div class="clearfix">
                           <?php 
                            $id= Session::get('user_login_id');
                            foreach($order_details as $order) { 
                                if($id == $order->u_id ) { ?>
                                <article class="article-table">
                                    <div class="row">
                                        <?php if($order->image == ''){ ?>
                                            <div class="col-md-4">
                                                <video width="100%" height="auto" controls controlsList="nodownload" data-play="hover" muted="muted" onmouseover="this.play()" onmouseout="this.pause();" ><source src="<?php echo URL::asset('public/upload/video/'.$order->video.'') ?>" type="video/mp4" allowfullscreen></video>
                                            </div>
                                        <?php }else{ ?>
                                            <div class="col-md-4">
                                                <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/product/'.$order->image.'') ?>" style="height:201px;width:100%;">
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-4 text">
                                            <div class="title">
                                                <h2 class="h5"><?php echo $order->name; ?></h2>
                                                <?php 
                                                foreach($pro_rating as $prate) { 
                                                    if( $order->p_id == $prate->p_id ) { 
                                                $rate = $prate->rating; 
                                                if($rate == 1) { ?>
                                                <i class="fa fa-star" style="color:red"></i>
                                                <?php } elseif($rate == 2) { ?>
                                                    <i class="fa fa-star" style="color:yellow"></i>
                                                    <i class="fa fa-star" style="color:yellow"></i>
                                                <?php } elseif($rate == 3) { ?>
                                                    <i class="fa fa-star" style="color:yellow"></i>
                                                    <i class="fa fa-star" style="color:yellow"></i>
                                                    <i class="fa fa-star" style="color:yellow"></i>
                                                <?php  } elseif($rate == 4) { ?>
                                                    <i class="fa fa-star" style="color:green"></i>
                                                    <i class="fa fa-star" style="color:green"></i>
                                                    <i class="fa fa-star" style="color:green"></i>
                                                    <i class="fa fa-star" style="color:green"></i>
                                                <?php } else { ?>
                                                    <i class="fa fa-star" style="color:green"></i>
                                                    <i class="fa fa-star" style="color:green"></i>
                                                    <i class="fa fa-star" style="color:green"></i>
                                                    <i class="fa fa-star" style="color:green"></i>
                                                    <i class="fa fa-star" style="color:green"></i>
                                                <?php } } } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text">
                                            <div class="text-intro">
                                                <a href="{{route('download', $order->p_id )}}" type="button" class="btn btn-success">Download    <i class="fa fa-download"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            <?php  } 
                            } ?>
                        </div>
                    </div>                 
                </div> 
            </div>
             
      
    <?php }
    else { ?>
<br><br><br><br><br>
        <div class="container">            
            <div class="cart-wrapper">
                <div class="row">
                    <div class="col-md-3">
                    <div class="sticky-top">
                        <div class="card">
                            <?php 
                            $id=Session::get('user_login_id');
                            foreach($user_details as $uu) { 
                                if($id === $uu->id) { ?>
                                <div class="card-header">
                                    <a href="#">Hi!  <?php echo $uu->fname;?></a>
                                </div>
                            <?php }
                            } ?>
                            <div class="list-group">
                                <a href="{{route('user_profile')}}" class="list-group-item"><i class="fa fa-user" aria-hidden="true"></i>   My Profile <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <a href="{{route('my_download')}}" class="list-group-item"><i class="fa fa-download" aria-hidden="true"></i>    Downloads <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <a href="{{route('act_setting')}}" class="list-group-item"><i class="fa fa-gear" aria-hidden="true"></i>    Account Settings <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <a href="{{route('show_invoice')}}" class="list-group-item"><i class="fa fa-yelp" aria-hidden="true"></i>   Invoice <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                
                                <?php 
                                if($developer_order_details > 0) {
                                ?>
                                    <a href="{{route('client_dashboard')}}" class="list-group-item"><i class="fa fa-plus" aria-hidden="true"></i>   Work Space <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <a href="{{route('resource')}}" class="list-group-item"><i class="fa fa-child" aria-hidden="true"></i>   Resource <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <a href="{{route('assign_work')}}" class="list-group-item"><i class="fa fa-suitcase" aria-hidden="true"></i>    Assign Work <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <?php } ?>
                                <a href="{{route('user_logout')}}" class="list-group-item"><i class="fa fa-sign-out" aria-hidden="true"></i>    Logout <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div> 
                        </div>
                    </div>                 
                </div>
                    <div class="col-md-9">
                       <center> <h5><img src="{{ URL::asset('public/front/assets/images/2.png') }}" class="rounded-circle" width="310px" height="250px"></h5>
                        <h4 class="card-title">Oops! Your Purchase Could Not Be Completed.</h4>
                        <hr style="width:550px;">
                        <a class="btn btn-primary btn-lg" href="{{route('index')}}" role="button">Go    <i class="fa fa-arrow-right"></i></a> 
                        </center> 
                    </div>
                </div> 
            </div>
        </div> 

    <?php } ?>
</section>
 @endsection