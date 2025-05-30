@extends('front.layout')
@section('content')

    <section class="blog blog-category blog-animated pt-0">
        <div class="container">            
            <div class="cart-wrapper">
                <div class="row">
                    
                    <div class="col-md-12">
                       <center> <h5><img src="{{ URL::asset('public/front/assets/images/icon 1-03.png') }}" class="rounded-circle" width="310px" height="310px"></h5>
                        <h4 class="card-title">Oops! Login Failed ? Mobile Number / Email & Password Wrong....</h4>
                        <hr style="width:800px;">
                        <a class="btn btn-primary btn-lg" href="{{route('login')}}" role="button">Back To Login   <i class="fa fa-arrow-right"></i></a> 
                        </center> 
                    </div>
                </div> 
            </div>
        </div> 
    </section>
@endsection