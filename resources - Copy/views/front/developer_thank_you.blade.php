@extends('front.layout')
@section('content')

<!-- <section class="shortcodes">
    <div class="container">
        <div class="row">            
            <center>
                <div class="col-sm-12 col-md-12">
                    <div id="wellcome">
                        <div class="card" style="padding: 100px 0px 0px 243px;">
                            <div class="card-body thank-body">
                                <div class="jumbotron">
                                    <h1 class="card-title thank">YOUR ORDER IS COMPLETED!</h1>
                                    <h5 class="thanks"><img src="public/front/assets/images/checkmark-clipart-right-sign-15.png" width="120px" height="120px"></h5>
                                    <h5 class="thanks">Thank You!</h5>
                                    <p class="thanks-you">We're review application. Your application is under process. We'll get back soon.</p>
                                    <hr class="my-4">
                                    <a class="btn thankyou btn-primary btn-lg" href="{{route('index')}}" role="button">CONTINUE SHOPPING</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </center>
        </div>
    </div>
</section> -->

<section><br><br><br><br><center>
         <div class="row">  
            
            <div class="col-8 col-lg-8 col-sm-8 col-md-8" style=" background-color: #d9d0d02e;border-radius: 20px;padding: 20px 20px 20px 20px;left: 20%;">
                
                <h3 class="text-dark">Now you are one step closer!</h3>
                <h5 class="text-dark"><img src="public/front/assets/images/checkmark-clipart-right-sign-15.png" width="120px" height="120px"></h5>
                <h5 class="text-dark">Thank You!</h5>
                <p class="text-dark">Please Go To Resource Tab and Complete SOW Work and Proceed!</p>
                <hr style="width:97%">
                <a class="btn  btn-primary btn-lg" href="{{route('resource')}}" role="button">CONTINUE <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                 
            </div>
        </div></center>
    
</section>



 @endsection