@extends('front.layout')
@section('content')

    <div class="site-section"  data-aos="fade">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-7">
            <div class="row mb-5">
              <div class="col-12 ">
                <h2 class="site-section-heading text-center">Portrait Gallery</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="row" id="lightgallery">
          <?php              
            $i=1;
            $img=$a->multiple_image;
            $tags = explode(',',$img);
            foreach($tags as $key) {   
            ?>
              <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 item" data-aos="fade" data-src="images/big-images/nature_big_1.jpg" data-sub-html="<h4>Fading Light</h4><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor doloremque hic excepturi fugit, sunt impedit fuga tempora, ad amet aliquid?</p>">
                <a href="#"><img src="<?php echo URL::asset('public/upload/category/'.$key.''); ?>" alt="IMage" class="img-fluid"></a>
              </div>
            <?php }
            ?>
        </div>
      </div>
    </div>
  </div>
@endsection