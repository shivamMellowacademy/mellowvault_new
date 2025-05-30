@extends('front.layout')
@section('content')


        <!-- ======================== Products ======================== -->

        <section class="products">
            <br><br>
            <header>
                <div class="container">
                    <h4 class="title">Our Sub Products Details</h4>
                </div>
            </header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <br>
                        <div class="filters">
                            <div class="filter-scroll-list">
                                <div class="filter-header d-block d-sm-none">
                                    <span class="h4">Filter products</span>
                                    <br />Select your options
                                    <hr />
                                </div>
                                    
                                <?php 
                                    foreach($category as $d) {
                                    $url = route('product',['id'=>''.$d->id.'']); ?>
                                        <div class="filter-box active">
                                            <div class="title">
                                               <?php echo $d->name; ?>
                                            </div>
                                            <div class="filter-content">
                                                <?php 
                                                foreach($subcategorys as $scate) { 
                                                    if($d->id === $scate->category_id) {
                                                     $urll = route('subproduct',['id'=>''.$scate->id.'']); ?>
                                                
                                                    <span class="checkbox">
                                                        <input type="radio" onclick="window.location.href='<?php echo $urll; ?>'" name="radiogroup-type" id="typeId<?php echo $scate->id ?>">
                                                        <label for="typeId<?php echo $scate->id ?>"><a href="<?php echo $urll; ?>"> <?php echo $scate->name; ?></a></label>
                                                    </span>
                                                <?php } } ?>
                                                <span class="checkbox">
                                                <input type="radio" onclick="window.location.href='<?php echo $url; ?>'" name="radiogroup-type" id="typeId<?php echo $d->id ?>">
                                                <label for="typeId<?php echo $d->id ?>"><a href="<?php echo $url; ?>"> All <?php echo $d->name; ?></a></label>
                                            </span>
                                            </div>
                                            
                                        </div>
                                <?php } ?>
                        
                            </div> 
                            <div class="toggle-filters-close btn btn-circle">
                                <i class="icon icon-cross"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9">
                        <span class="grid-list">
                            <a href="javascript:void(0);" class="toggle-filters-mobile d-inline-block d-md-none">
                                <span class="spinner-grow spinner-grow-sm text-warning" role="status" aria-hidden="true"></span>
                                <i class="fa fa-sliders"></i>
                            </a>
                        </span>
                        <div class="row">
                            <?php
                             foreach($product_detail as $scd) {   
                                $url = route('product_details',['id'=>''.$scd->id.'']); ?>
                            <div class="col-12 col-lg-4 col-md-6">
                                <article>
                                    <div class="info">
                                        <span>
                                            <a href="<?php echo $url; ?>" data-title="Details show">
                                                <i class="icon icon-eye"></i>
                                            </a>
                                        </span>
                                    </div>

                                    <?php 
                                       

                                        if(empty(Session::get('user_login_id'))) { ?>

                                            <div class="btn btn-add">
                                                <a href="{{route('login')}}" class="add_to_cart" value="{{$scd->id}}" style="color:white;"><i class="icon icon-cart"></i></a>
                                            </div>

                                        <?php } else{ ?>

                                            <div class="btn btn-add">
                                                <a href="javascript:void(0);" class="add_to_cart" value="{{$scd->id}}" style="color:white;"><i class="icon icon-cart"></i></a>
                                            </div>

                                    <?php } ?>

                                    <div class="figure-grid">
                                        <?php if($scd->image == ''){ ?>
                                            <div class="image">
                                                <a href="<?php echo $url; ?>">
                                                    <video width="400" height="200" controls controlsList="nodownload" data-play="hover" muted="muted" onmouseover="this.play()" onmouseout="this.pause();" ><source class="embed-responsive-item" src="<?php echo URL::asset('public/upload/video/'.$scd->video.'') ?>" type="video/mp4" allowfullscreen></video>
                                                </a>
                                            </div>
                                        <?php }else{ ?>
                                            <div class="image">
                                                <a href="<?php echo $url; ?>">
                                                    <img src="<?php echo URL::asset('public/upload/product/'.$scd->image);?>" alt="image">
                                                </a>
                                            </div>
                                        <?php } ?>
                                        <div class="text">
                                            <h6 class="title">
                                                <a href="<?php echo $url; ?>"><?php echo $scd->name; ?></a>
                                            </h6>
                                            <sup>INR <?php echo $scd->price; ?> </sup>
                                             
                                        </div>
                                    </div>
                                </article>
                            </div>  
                            <?php
                                }
                            ?>                          
                        </div>
                    </div> 
                </div>

                


            </div>


            <div class="row">
                <div class="col-sm-12 col-xs-12 pagination-wrapper">
                    <div class="pagination justify-content-center"
                        <?php echo $product_detail->links("pagination::bootstrap-4"); ?> 
                    </div>      
                </div>
            </div>

            
        </section>   

@endsection