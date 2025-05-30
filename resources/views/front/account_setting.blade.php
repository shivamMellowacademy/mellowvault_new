@extends('front.layout')
@section('content')

<section class="shortcodes">
    <div class="container">
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
                <div class="login-wrapper act-setting">
                    <div class="login-block login-block-signup">
                        <div class="h4">Account Setting </div>
                        <hr />
                        <div class="col-lg-8 ml-auto mr-auto">
                            @if(Session::has('errmsg'))                 
                                <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                       <strong>{{Session::get('errmsg')}}</strong>
                                </div>
                                {{Session::forget('message')}}
                                {{Session::forget('errmsg')}}
                            @endif
                        </div>
                        
                        <form method="post" action="{{route('update_change_password')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        
                                        <input type="password" name="old_password" class="form-control" placeholder="Old Password: *">
                                        @if ($errors->has('old_password'))
                                            <strong class="text-danger">{{ $errors->first('old_password') }}</strong>                                    
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        
                                        <input type="password" name="new_password" class="form-control" placeholder="New Password: *">
                                        @if ($errors->has('new_password'))
                                         <strong class="text-danger">{{ $errors->first('new_password') }}</strong>                                    
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        
                                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password: *">
                                        @if ($errors->has('confirm_password'))
                                            <strong class="text-danger">{{ $errors->first('confirm_password') }}</strong>                                    
                                        @endif
                                    </div>
                                </div>
                               <!--  <div class="col-md-12">
                                        
                                        <label for="checkBoxId3"><a href="{{route('forgetpassword')}}" style="color: #8b8b8b; text-decoration: underline;">Forgot password?</a></label>
                                        
                                </div> -->
                                <div class="col-md-12">
                                    <button class="btn btn-outline-dark" type="submit">Change Password</button>
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