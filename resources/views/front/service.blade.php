@extends('front.layout')
@section('content')

    <div class="site-section"  data-aos="fade">
      <div class="container-fluid">

        <div class="row justify-content-center">
          <div class="col-md-7">
            <div class="row mb-5">
              <div class="col-12 ">
                <h2 class="site-section-heading text-center">Our Services</h2>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <?php
            foreach($service as $ss)
            {
          ?>
            <div class="col-md-6 col-lg-6 col-xl-4 text-center mb-5 mb-lg-5">
              <div class="h-100 p-4 p-lg-5 site-block-feature-7">
                <span class="display-3 text-primary mb-4 d-block"><img src="<?php echo URL::asset('public/upload/service/'.$ss->image.'') ?>" alt="Images" class="img-fluid"></span>
                <h3 class="text-white h4"><?php echo $ss->heading ?></h3>
              </div>
            </div>
          <?php
            }
          ?>
        </div>

      </div>
    </div>
    
@endsection