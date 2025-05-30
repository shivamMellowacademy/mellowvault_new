@extends('client.layout')
@section('content')



<div class="page-content">
    <div class="row">
        <div class="col-lg-8 ml-auto mr-auto">
            @if(Session::has('errmsg'))                 
                <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                       <strong>{{Session::get('errmsg')}}</strong>
                </div>
                {{Session::forget('message')}}
                {{Session::forget('errmsg')}}
            @endif
            <br><br>
        </div>
    </div>
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Full Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
	                        <tbody>
                               <?php $i=1;
                                foreach($client_profile_details as $c) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $c->fname; ?> <?php echo $c->lname; ?></td>
                                        <td><?php echo $c->phone; ?></td>
                                        <td><?php echo $c->email; ?></td>
                                        <td><?php echo $c->show_password; ?></td>
                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myshowModal<?php echo $c->id; ?>">More Details</button></td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myeditModal<?php echo $c->id; ?>" ><i class="fa fa-edit"></i></a>
                                            
                                        </td>  
                                    </tr>

                                    <div class="modal" id="myshowModal<?php echo $c->id; ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h5 class="card-title">More Details</h5>
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">User Name</h5>
                                                                        <p class="card-text"><?php echo $c->user_name; ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Company Name</h5>
                                                                        <p class="card-text"><?php echo $c->company_name; ?></p>
                                                                    </div>
                                                                </div>
                                                               <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Purpose</h5>
                                                                        <p class="card-text"><?php echo $c->purpose; ?></p>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Image</h5>
                                                                        <p class="card-text">
                                                                            
                                                                            <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/profile_image/'.$c->image.'') ?>" style="height:80px">
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Date</h5>
                                                                        <p class="card-text"><?php echo $c->date; ?></p>
                                                                    </div>
                                                                </div> 
                                                                
                                                            </div>  
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="modal" id="myeditModal<?php echo $c->id; ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Update Profile</h4>
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                </div>
                                                <!-- Modal body -->
                                                 <div class="modal-body">
                                                    <form method="post" action="{{route('client_profile_update')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        
                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter First Name</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $c->id; ?>" autocomplete="off" required="" >
                                                                <input type="text" class="form-control" name="fname" value="<?php echo $c->fname; ?>" autocomplete="off" required="" >
                                                                @if ($errors->has('fname'))
                                                                <strong class="text-danger">{{ $errors->first('fname') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Last Name</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $c->id; ?>" autocomplete="off" required="" >
                                                                <input type="text" class="form-control" name="lname" value="<?php echo $c->lname; ?>" autocomplete="off" required="" >
                                                                @if ($errors->has('lname'))
                                                                <strong class="text-danger">{{ $errors->first('lname') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter User Name</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $c->id; ?>" autocomplete="off" required="" >
                                                                <input type="text" class="form-control" name="user_name" value="<?php echo $c->user_name; ?>" autocomplete="off" required="" >
                                                                @if ($errors->has('user_name'))
                                                                <strong class="text-danger">{{ $errors->first('user_name') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Conatct</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $c->id; ?>" autocomplete="off" required="" >
                                                                <input type="text" class="form-control" name="phone" value="<?php echo $c->phone; ?>" autocomplete="off" required="" >
                                                                @if ($errors->has('phone'))
                                                                <strong class="text-danger">{{ $errors->first('phone') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div>   
 
                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Email</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $c->id; ?>" autocomplete="off" required="" >
                                                                <input type="email" class="form-control" name="email" value="<?php echo $c->email; ?>" autocomplete="off" required="" >
                                                                @if ($errors->has('email'))
                                                                <strong class="text-danger">{{ $errors->first('email') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div>

                                                        
                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group is-filled">
                                                                <label class="bmd-label-floating">Choose Profile Image</label>
                                                                <input type="file" class="form-control" name="image" accept="image/*"  autocomplete="off" >
                                                                <input type="hidden" class="form-control" name="old_image" value="<?php echo $c->image; ?>"  autocomplete="off" >
                                                                <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/profile_image/'.$c->image.'') ?>" style="height:30px;width:40px;">
                                                                @if ($errors->has('image'))
                                                                <strong class="text-danger">{{ $errors->first('image') }}</strong>                                  
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <button type="submit" class="btn btn-success btn-block">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                </div>                                               
                                            </div>
                                        </div>
                                    </div>
                                    
                                <?php $i++;
                                } ?>
	                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
       	</div>
    </div>
</div>

@endsection