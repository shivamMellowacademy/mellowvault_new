@extends('front.layout')
@section('content')


<?php if($search_total > 0){ ?>

    <section class="products">
        <header>
            <div class="container">
                <h4 class="title" style="font-size: 19px; text-align: center;">Here is the result</h4>
            </div>
        </header>
        <div class="container">
            <div class="scroll-wrapper">
                <div class="row">
                    <?php
                    foreach($search as $ser) {  
                        $url = route('product_details',['id'=>''.$ser->id.'']); ?>
                    <div class="col-6 col-lg-4 col-sm-4 col-md-4">
                        <article>
                            <div class="info">
                                    <span>
                                        <a href="<?php echo $url; ?>" data-title="Details show"><i class="icon icon-eye"></i></a>
                                    </span>
                                </div>
                            <div class="btn btn-add">
                               <a href="javascript:void();" class="add_to_cart" value="{{$ser->id}}" style="color:white;"><i class="icon icon-cart"></i></a>
                            </div>
                            <div class="figure-grid">
                                <?php if($ser->image == ''){ ?>
                                    <div class="image">
                                        <a href="<?php echo $url; ?>">
                                           <video width="100%" height="auto" controls controlsList="nodownload" data-play="hover" muted="muted" onmouseover="this.play()" onmouseout="this.pause();" ><source class="embed-responsive-item" src="<?php echo URL::asset('public/upload/video/'.$ser->video.'') ?>" type="video/mp4" allowfullscreen></video>
                                        </a>
                                    </div>
                                <?php }else{ ?>
                                    <div class="image">
                                        <a href="<?php echo $url; ?>">
                                           <img src="<?php echo URL::asset('public/upload/product/'.$ser->image.'') ?>" alt="Alternate Text" />
                                        </a>
                                    </div>
                                <?php } ?>
                                <div class="text" style=" word-break: normal;">
                                    <h6 class="title" >
                                        <a href="<?php echo $url; ?>" ><?php echo $ser->name; ?></a>
                                    </h6>
                                </div>
                            </div>
                        </article>
                    </div>
                    
                    <?php
                    } ?>
                </div> 
            </div>
        </div>
    </section>
<?php }else{?>
    <section>
       <bR><bR>
        <div class="container">
            <div class="scroll-wrapper"><center>
                <div class="row">
                    <div class="col-md-12">
                       <center> <h5><img src="{{ URL::asset('public/front/assets/images/2.png') }}" class="rounded-circle" width="310px" height="250px"></h5>
                        <h4 class="card-title">Oops! No Products Found.</h4>
                        <hr style="width:550px;">
                        <a class="btn btn-primary btn-lg" href="{{route('index')}}" role="button">Go    <i class="fa fa-arrow-right"></i></a> 
                        </center> 
                    </div>
                </div> 
            </center>
            </div>
        </div>
         
    </section>
<?php } ?>

@endsection