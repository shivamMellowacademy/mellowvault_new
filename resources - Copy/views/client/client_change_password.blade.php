@extends('client.layout')
@section('content')

<div class="page-content" style="padding-top:30px;">
    <div class="main-wrapper container">   
        <div class="row">
            <div class="col-xl">
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
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Change Password</h5>
                        <form method="post" action="{{route('client_update_password')}}">
                            @csrf
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Enter Old Password </label>
                                <input type="password" class="form-control" name="old" autocomplete="off" required="" >
                                @if ($errors->has('old'))
                                <strong class="text-danger">{{ $errors->first('old') }}</strong>                                    
                                @endif
                            </div>                      
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Enter New Password </label>
                                <input type="password" class="form-control" name="new"  autocomplete="off" required="" >
                                @if ($errors->has('new'))
                                <strong class="text-danger">{{ $errors->first('new') }}</strong>                                    
                                @endif
                            </div>
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Enter Confirm Password </label>
                                <input type="password" class="form-control" name="con"  autocomplete="off" required="" >
                                @if ($errors->has('con'))
                                <strong class="text-danger">{{ $errors->first('con') }}</strong>                                    
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Change Password</button>
                        </form>
                    </div>
                </div>
           	</div>
        </div>
   	</div>
</div>



@endsection