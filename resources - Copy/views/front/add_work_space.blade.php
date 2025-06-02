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
                                <a href="#" class="list-group-item"><i class="fa fa-user" aria-hidden="true"></i>   My Profile <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <a href="{{route('my_download')}}" class="list-group-item"><i class="fa fa-download" aria-hidden="true"></i>    Downloads <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <a href="{{route('act_setting')}}" class="list-group-item"><i class="fa fa-gear" aria-hidden="true"></i>    Account Settings <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <a href="{{route('show_invoice')}}" class="list-group-item"><i class="fa fa-yelp" aria-hidden="true"></i>   Invoice <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <a href="{{route('resource')}}" class="list-group-item"><i class="fa fa-child" aria-hidden="true"></i>   Resource <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                <a href="{{route('assign_work')}}" class="list-group-item"><i class="fa fa-suitcase" aria-hidden="true"></i>    Assign Work <i class="fa fa-angle-right" aria-hidden="true"></i></a>
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
                                                  <center> <strong>{{Session::get('errmsg')}}</strong></center>
                                            </div>
                                            {{Session::forget('message')}}
                                            {{Session::forget('errmsg')}}
                                        @endif
                                    </div>
                                </div>
                               
                                <div class="jumbotron">
                                    <?php 
                                    $id= Session::get('user_login_id');
                                    foreach($user_details as $user) { 
                                        if($id == $user->id )
                                    { ?>
                                    <form method="post" action="{{route('submit_developer_details')}}" enctype="multipart/form-data">
                                        @csrf
                                       
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <lable>Choose Higher Professional: </lable>
                                                    <select name="pro_id" id="pro_id" class="form-control">
                                                        <option value="">Choose Higher Professional:</option>
                                                        <?php
                                                            foreach($higher_professional as $c) { ?>
                                                                <option value="<?php echo $c->id; ?>"><?php echo $c->heading; ?></option>
                                                        <?php
                                                        } ?>
                                                    </select>
                                                    @if ($errors->has('pro_id'))
                                                        <strong class="text-danger">{{ $errors->first('pro_id') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                   <lable>Enter First Name: </lable>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter First Name" required="">
                                                    @if ($errors->has('name'))
                                                        <strong class="text-danger">{{ $errors->first('name') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group"> 
                                                    <lable>Enter Last Name: </lable>
                                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name" required="">
                                                    @if ($errors->has('last_name'))
                                                        <strong class="text-danger">{{ $errors->first('last_name') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                  <lable>Upload Profile Image: </lable>
                                                    <input type="file" class="form-control" name="image" placeholder="Upload Profile Image" id="image" accept="image/*" required="" >
                                                    @if ($errors->has('image'))
                                                    <strong class="text-danger">{{ $errors->first('image') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <lable>Upload Portfolio Image: </lable>
                                                    <input type="file" class="form-control" name="portfolio_image" placeholder="Upload Portfolio Image" id="portfolio_image" accept="image/*" required="" >
                                                    @if ($errors->has('portfolio_image'))
                                                    <strong class="text-danger">{{ $errors->first('portfolio_image') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <lable>Upload Resume: </lable>
                                                    <input type="file" class="form-control" name="resume" placeholder="Upload Resume" id="resume" required="" >
                                                    @if ($errors->has('resume'))
                                                    <strong class="text-danger">{{ $errors->first('resume') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <lable>Contact No.: </lable>
                                                    <input type="tel" class="form-control" name="phone" placeholder="Contact No." maxlength="10" id="phone" required="" >
                                                    @if ($errors->has('phone'))
                                                    <strong class="text-danger">{{ $errors->first('phone') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <lable>Total Jobs: </lable>
                                                    <input type="text" class="form-control" name="job" placeholder="Total Jobs" id="job"  required="" >
                                                    @if ($errors->has('job'))
                                                    <strong class="text-danger">{{ $errors->first('job') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <lable>Email Id: </lable>
                                                    <input type="email" class="form-control" name="email" placeholder="Email Id" id="email" accept="image/*" required="" >
                                                    @if ($errors->has('email'))
                                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <lable>Enter Password: </lable>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required="">
                                                    @if ($errors->has('password'))
                                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>  

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <lable>Total Hours: </lable>
                                                    <input type="text" class="form-control" name="total_hours" placeholder="Total Hours" id="total_hours" required="" >
                                                    @if ($errors->has('total_hours'))
                                                    <strong class="text-danger">{{ $errors->first('total_hours') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <lable>Per Hour Rate: </lable>  
                                                    <input type="text" class="form-control" name="perhr" placeholder="Per Hour Rate" id="perhr" required="" >
                                                    @if ($errors->has('perhr'))
                                                    <strong class="text-danger">{{ $errors->first('perhr') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <lable>Rating: </lable>  
                                                    <input type="text" class="form-control" name="rating" placeholder="Rating" id="rating" required="" >
                                                    @if ($errors->has('rating'))
                                                    <strong class="text-danger">{{ $errors->first('rating') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>
                                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <lable>Address: </lable> 
                                                    <input type="text" class="form-control" name="address" placeholder="Address" id="address" required="" >
                                                    @if ($errors->has('address'))
                                                    <strong class="text-danger">{{ $errors->first('address') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <lable>Language: </lable> 
                                                    <input type="text" class="form-control" name="language" placeholder="Language" id="language" required="" >
                                                    @if ($errors->has('language'))
                                                    <strong class="text-danger">{{ $errors->first('language') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <lable>Education: </lable> 
                                                    <input type="text" class="form-control" name="education" placeholder="Education" id="education" required="" >
                                                    @if ($errors->has('education'))
                                                    <strong class="text-danger">{{ $errors->first('education') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <lable>Description: </lable>    
                                                    <textarea id="content" class="form-control" name="description" placeholder="Description" rows="5"></textarea>
                                                    @if ($errors->has('description'))
                                                        <strong class="text-danger">{{ $errors->first('description') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <lable>Skills: </lable>      
                                                    <textarea id="Additions" class="form-control" name="skills" placeholder="skills" rows="5"></textarea>
                                                    @if ($errors->has('skills'))
                                                        <strong class="text-danger">{{ $errors->first('skills') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <lable>Completed Job: </lable>         
                                                    <textarea id="Overview" class="form-control" name="completed_job" placeholder="Completed Job" rows="5"></textarea>
                                                    @if ($errors->has('completed_job'))
                                                        <strong class="text-danger">{{ $errors->first('completed_job') }}</strong>                                  
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Add Details</button>
                                                </div>
                                            </div>
                                        </div>
                                     </form>
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