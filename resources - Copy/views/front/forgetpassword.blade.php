@extends('front.layout')
@section('content')
       
    <section class="login">
        <div class="container">
            
            <div class="row">
                <!-- <div class="col-md-3">
                    
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
                                <a href="{{route('add_work_space')}}" class="list-group-item"><i class="fa fa-plus" aria-hidden="true"></i>   Add Work Space <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <a href="{{route('resource')}}" class="list-group-item"><i class="fa fa-child" aria-hidden="true"></i>   Resource <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <a href="{{route('assign_work')}}" class="list-group-item"><i class="fa fa-suitcase" aria-hidden="true"></i>    Assign Work <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <a href="{{route('user_logout')}}" class="list-group-item"><i class="fa fa-sign-out" aria-hidden="true"></i>    Logout <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                                      
                </div> -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-8 ml-auto mr-auto">
                            @if(Session::has('errmsg'))                 
                                <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                      <center> <strong>{{Session::get('errmsg')}}</strong></center>
                                </div>
                                {{Session::forget('message')}}
                                {{Session::forget('errmsg')}}
                            @endif
                        </div>
                    </div>
                    <div class="login-wrapper">
                        <div class="login-block login-block-signup">
                            <div class="h4">Forgot Password </div>
                            <hr />
                            <form method="post" action="{{route('sendforgetpassword')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" value="" class="form-control" name="email" placeholder="Email: *">
                                        @if ($errors->has('email'))
                                            <strong class="text-danger">{{ $errors->first('email') }}</strong>                                   
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-outline-dark">Forgot Password</button>
                                </div>
                            </div>
                        </form>
                        </div> 
                    </div> 
                </div> 
            </div>
        </div>
    </section>

@endsection