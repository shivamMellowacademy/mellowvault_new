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
                    <div id="wellcome">
                        <div class="card">      
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8 ml-auto mr-auto">
                                        @if(Session::has('errmsg'))                 
                                            <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                                   <center><strong>{{Session::get('errmsg')}}</strong></center>
                                            </div>
                                            {{Session::forget('message')}}
                                            {{Session::forget('errmsg')}}
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5 class="card-title">
                                            <div class="circle" >
                                            <?php 
                                            $id= Session::get('user_login_id');
                                            foreach($user_details as $user) { 
                                                if($id == $user->id )
                                            { ?>
                                                <img class="profile-pic" src="<?php echo URL::asset('public/upload/profile_image/'.$user->image.'') ?>">
                                            <?php }
                                            } ?>
                                            </div>
                                        </h5>
                                    </div>
                                    <div class="col-md-6">
                                        <?php 
                                        $id= Session::get('user_login_id');
                                        foreach($user_details as $user) { 
                                            if($id == $user->id )
                                        { ?>
                                        <h5 class="card-title">
                                            <div class="text-center text-sm-left mb-2 mb-sm-0 change_img">
                                                <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap" style="text-transform: uppercase;"><?php echo $user->fname; ?> <?php echo $user->lname; ?></h4>
                                                
                                                    <div class="p-image">
                                                        <input type="hidden" class="form-control" name="update" value="<?php echo $user->id; ?>" autocomplete="off" required="" >
                                                        <i class="fa fa-camera upload-button"></i>
                                                        <input class="file-upload" type="file" name="image" accept="image/*"/>
                                                       
                                                    </div>
                                                    @if ($errors->has('image'))
                                                        <strong class="text-danger" style="font-size:10px;">{{ $errors->first('image') }}</strong>                                  
                                                    @endif
                                                   <br>
                                                    <a class="btn btn-success btn-sm" href="{{ route('user_profile') }}" ><i class="fa fa-edit"></i> Profile Image</a>
                                                
                                            </div>
                                        </h5>
                                        <?php }
                                        } ?>
                                    </div>
                                </div>
                                <div class="jumbotron">
                                    <?php 
                                    $id= Session::get('user_login_id');
                                    foreach($user_details as $user) { 
                                        if($id == $user->id )
                                    { ?>
                                    
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row show-icons">
                                                    <div class="col-md-12"><p><i class="fa fa-user-secret"></i>Full Name</p></div> 
                                                    <div class="col-md-12"><p><i class="fa fa-user"></i>User Name</p></div> 
                                                    <div class="col-md-12"><p><i class="fa fa-envelope-open"></i>Email Id</p></div>
                                                    <div class="col-md-12"><p><i class="fa fa-tag"></i>Company Name</p></div>  
                                                    <div class="col-md-12"><p><i class="fa fa-phone"></i>Contact Number</p></div> 
                                                    <div class="col-md-12"><p><i class="fa fa-refresh"></i>Purpose</p></div> 
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="hidden" class="form-control" name="update" value="<?php echo $user->id; ?>" autocomplete="off" required="" >
                                                            <input type="text" name="fname" value="<?php echo $user->fname; ?>" class="form-control" placeholder="First name: *" readonly>
                                                            @if ($errors->has('fname'))
                                                                <strong class="text-danger" style="font-size:10px">{{ $errors->first('fname') }}</strong>                                  
                                                            @endif   
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="hidden" class="form-control" name="update" value="<?php echo $user->id; ?>" autocomplete="off" required="" >
                                                            <input type="text" name="lname" value="<?php echo $user->lname; ?>" class="form-control" placeholder="Last name: *" readonly>
                                                            @if ($errors->has('lname'))
                                                                <strong class="text-danger" style="font-size:10px">{{ $errors->first('lname') }}</strong>                                  
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <a class="btn btn-success btn-sm" href="{{ route('user_profile') }}" ><i class="fa fa-edit"></i></a>   
                                                    </div>

                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <input type="hidden" class="form-control" name="update" value="<?php echo $user->id; ?>" autocomplete="off" required="" >
                                                            <input type="text" name="user_name" value="<?php echo $user->user_name; ?>" class="form-control" placeholder="User Name:" readonly>
                                                            @if ($errors->has('user_name'))
                                                                <strong class="text-danger" style="font-size:10px">{{ $errors->first('user_name') }}</strong>                                  
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a class="btn btn-success btn-sm" href="{{ route('user_profile') }}" ><i class="fa fa-edit"></i></a>   
                                                    </div>

                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <input type="hidden" class="form-control" name="update" value="<?php echo $user->id; ?>" autocomplete="off" required="" >
                                                            <input type="email" name="email" value="<?php echo $user->email; ?>" class="form-control" placeholder="Email:" readonly>
                                                            @if ($errors->has('email'))
                                                                <strong class="text-danger" style="font-size:10px">{{ $errors->first('email') }}</strong>                                  
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a class="btn btn-success btn-sm" href="{{ route('user_profile') }}" ><i class="fa fa-edit"></i></a>   
                                                    </div>

                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <input type="hidden" class="form-control" name="update" value="<?php echo $user->id; ?>" autocomplete="off">
                                                            <input type="text" name="company_name" value="<?php echo $user->company_name; ?>" class="form-control" placeholder="Company Name:" readonly>
                                                            @if ($errors->has('company_name'))
                                                                <strong class="text-danger" style="font-size:10px">{{ $errors->first('company_name') }}</strong>                                  
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <a class="btn btn-success btn-sm" href="{{ route('user_profile') }}" ><i class="fa fa-edit"></i></a>   
                                                    </div>

                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <input type="hidden" class="form-control" name="update" value="<?php echo $user->id; ?>" autocomplete="off" required="" >
                                                            <input type="tel" name="phone" value="<?php echo $user->phone; ?>" class="form-control" placeholder="Contact No.:" maxlength="10" readonly>
                                                            @if ($errors->has('phone'))
                                                                <strong class="text-danger" style="font-size:10px">{{ $errors->first('phone') }}</strong>                                  
                                                            @endif
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4">
                                                        <a class="btn btn-success btn-sm" href="{{ route('user_profile') }}" ><i class="fa fa-edit"></i></a>   
                                                    </div>

                                                    <div class="col-md-8">
                                                        <div class="form-group" id="user_purpose">  
                                                            <input type="text" name="purpose" value="<?php echo $user->purpose; ?>" class="form-control" placeholder="Company purpose:" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a class="btn btn-success btn-sm" href="{{ route('user_profile') }}" ><i class="fa fa-edit"></i></a>   
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    
                                    <?php } 
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection   