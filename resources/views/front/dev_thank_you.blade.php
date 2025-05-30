@extends('front.layout')
@section('content')

<section>
    <br><br><br><br>
    <center>
        <div class="row">  
            
            <div class="col-8 col-lg-8 col-sm-8 col-md-8" style=" background-color: #d9d0d02e;border-radius: 20px;padding: 20px 20px 20px 20px;left: 20%;">
                
                <h1 class="">YOUR PAYMENT IS COMPLETED!</h1>
                <h5 class=""><img src="public/front/assets/images/checkmark-clipart-right-sign-15.png" width="120px" height="120px"></h5>
                <h5 class="">Thank You!</h5>
                <p class="">Creating robust Eco-system For Employment and Delivering Fastest Code Blocks.</p>
                <hr style="width:97%">
                <a class="btn  btn-primary btn-lg" href="{{route('resource')}}" role="button">Go to Profile <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                 
            </div>
        </div>
    </center>
    
</section>



 @endsection