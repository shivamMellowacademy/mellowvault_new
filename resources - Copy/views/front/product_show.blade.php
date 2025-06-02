@extends('front.layout')
@section('content')
    
  
<section class="about">
    
    <div class="container">
        <div class="row">
            <?php 
                foreach ($allproduct as $ap) {
            ?>
           
                <div class="col-md-12">
                    <div class="product-flex-gallery">
                        <div class="product__carousel">
                            <div class="gallery-parent">
                                <div class="embed-responsive embed-responsive-16by9 portfolio-vid" >
                                    <video controls controlsList="nodownload" autoplay><source class="embed-responsive-item" src="<?php echo URL::asset('public/upload/video/'.$ap->video.'') ?>" type="video/mp4" allowfullscreen></video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                
                
            <?php } ?>                          
        </div>
    </div>

</section>
   



@endsection