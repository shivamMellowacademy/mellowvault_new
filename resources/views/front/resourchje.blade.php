@extends('front.layout')
@section('content')


<?php 
    foreach ($developer_order_resource as $k) {
    if($k->status = "Not Approved"){ 
        echo $k->status;
?>
            <div class="container bootstrap snippets bootdeys pt-0">
                <div class="row">
                        <div class="col-lg-8 ml-auto mr-auto">
                            @if(Session::has('schedule_errmsg'))                 
                                <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                       <center><strong>{{Session::get('schedule_errmsg')}}</strong></center>
                                </div>
                                {{Session::forget('message')}}
                                {{Session::forget('schedule_errmsg')}}
                            @endif
                        </div>
                    </div>
              <?php 
                foreach ($developer_resources as $resource) {
              ?>
                <div class="row" id="user-profile">
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="main-box clearfix">
                            <h2><?php echo $resource->name; ?> <?php echo $resource->last_name; ?></h2>
                            <div class="profile-status">
                                <i class="fa fa-star"></i> <span> <?php echo $resource->rating; ?>/5</span>
                            </div>
                           
                            <img src="<?php echo URL::asset('public/upload/developer/'.$resource->image.'') ?>" alt="" class="profile-img img-responsive center-block">
                            <div class="profile-label">
                                <span class="label btn-success"> <?php echo $resource->perhr; ?> INR / Hr.</span>
                            </div>

                            <div class="profile-details">
                                <ul class="fa-ul">
                                    <li><i class="fa-li fa fa-language"></i> Language: <span><?php echo $resource->language; ?></span></li>
                                    <li><i class="fa-li fa fa-edit"></i>Education: <span><?php echo $resource->degree; ?></span></li>
                                    <li><i class="fa-li fa fa-tasks"></i>Total Jobs: <span><?php echo $resource->job; ?></span></li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-9 col-md-8 col-sm-8">
                        <div class="main-box clearfix">
                            <div class="profile-header">
                                <h3><span>Interview Schedule</span></h3>
                            </div>
                            <div class="row profile-user-info">
                                <div class="col-sm-12">
                                    <form method="post" action="{{route('schedule_interview_resource')}}" enctype="multipart/form-data">
                                        @csrf
                                        <?php 
                                            $id= Session::get('dev_id');
                                            //echo $id; exit();
                                        ?>
                                        <input type="hidden" class="form-control" name="dev_id" value="<?php echo $resource->dev_id; ?>" placeholder="Subject" required="">
                                        <div class="form-group">
                                            <label><b>1st Schedule Interview Date and Time:</b></label>
                                            <input type="datetime-local" class="form-control" name="interviewdateone" id="subject" placeholder="1st Interview Date and Time" required="">
                                            @if ($errors->has('interviewdateone'))
                                                <strong class="text-danger">{{ $errors->first('interviewdateone') }}</strong>                                  
                                            @endif
                                        </div>
                                        
                                        <div class="form-group">
                                            <label><b>2nd Schedule Interview Date and Time:</b></label>
                                            <input type="datetime-local" class="form-control" name="interviewdatetwo" id="subject" placeholder="2nd Interview Date and Time" required="">
                                            @if ($errors->has('interviewdatetwo'))
                                                <strong class="text-danger">{{ $errors->first('interviewdatetwo') }}</strong>                                  
                                            @endif
                                        </div>
                                        
                                        <div class="form-group">
                                            <label><b>3rd Schedule Interview Date and Time:</b></label>
                                            <input type="datetime-local" class="form-control" name="interviewdatethree" id="subject" placeholder="3rd Interview Date and Time" required="">
                                            @if ($errors->has('interviewdatethree'))
                                                <strong class="text-danger">{{ $errors->first('interviewdatethree') }}</strong>                                  
                                            @endif
                                        </div>
                                                    
                                        <div class="clearfix">
                                            <button type="submit" class="btn btn-success pull-right">Schedule</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              <?php } ?>
            </div>
                    
<?php }elseif($k->status = "Interview Schedule"){   ?>
  
            <div class="container bootstrap snippets bootdeys pt-0">
                <div class="row">
                        <div class="col-lg-8 ml-auto mr-auto">
                            @if(Session::has('schedule_errmsg'))                 
                                <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                       <center><strong>{{Session::get('schedule_errmsg')}}</strong></center>
                                </div>
                                {{Session::forget('message')}}
                                {{Session::forget('schedule_errmsg')}}
                            @endif
                        </div>
                    </div>
              <?php 
                foreach ($developer_resourceSELE as $resource) {
                
              ?>
                <div class="row" id="user-profile">
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="main-box clearfix">
                            <h2><?php echo $resource->name; ?> <?php echo $resource->last_name; ?></h2>
                            <div class="profile-status">
                                <i class="fa fa-star"></i> <span> <?php echo $resource->rating; ?>/5</span>
                            </div>
                           
                            <img src="<?php echo URL::asset('public/upload/developer/'.$resource->image.'') ?>" alt="" class="profile-img img-responsive center-block">
                            <div class="profile-label">
                                <span class="label btn-success"> <?php echo $resource->perhr; ?> INR / Hr.</span>
                            </div>

                            <div class="profile-details">
                                <ul class="fa-ul">
                                    <li><i class="fa-li fa fa-language"></i> Language: <span><?php echo $resource->language; ?></span></li>
                                    <li><i class="fa-li fa fa-edit"></i>Education: <span><?php echo $resource->degree; ?></span></li>
                                    <li><i class="fa-li fa fa-tasks"></i>Total Jobs: <span><?php echo $resource->job; ?></span></li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-9 col-md-8 col-sm-8">
                        <div class="main-box clearfix">
                            <div class="profile-header">
                                <h3><span>Interview Schedule Date&Time</span></h3>
                                
                            </div>

                            <div class="row profile-user-info">
                        
                                <div class="col-sm-12">
                                    <?php 
                                        foreach ($developer_interview_resource as $resource) {
                 
                                    ?>
                                    <form method="post" action="#" enctype="multipart/form-data">
                                        @csrf
                                        <?php 
                                            $id= Session::get('dev_id');
                                            //echo $id; exit();
                                        ?>
                                        <input type="hidden" class="form-control" name="dev_id" value="<?php echo $resource->dev_id; ?>" placeholder="Subject" required="">
                                        <div class="form-group">
                                            <label><b>1st Schedule Interview Date and Time:</b></label>
                                            <input type="text" class="form-control" name="interviewdateone" id="subject" value="<?php echo $resource->interviewdateone; ?>" placeholder="Interview Date and Time" required="" readonly>
                                            @if ($errors->has('interviewdateone'))
                                                <strong class="text-danger">{{ $errors->first('interviewdateone') }}</strong>                                  
                                            @endif
                                        </div>
                                        
                                        <div class="form-group">
                                            <label><b>2nd Schedule Interview Date and Time:</b></label>
                                            <input type="text" class="form-control" name="interviewdatetwo" id="subject" value="<?php echo $resource->interviewdatetwo; ?>" placeholder="Interview Date and Time" required="" readonly>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label><b>3rd Schedule Interview Date and Time:</b></label>
                                            <input type="text" class="form-control" name="interviewdatethree" id="subject" value="<?php echo $resource->interviewdatethree; ?>" placeholder="Interview Date and Time" required="" readonly>
                                        </div>
                                        
                                    </form>
                                    <?php } ?>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


              <?php } ?>
            </div>
            
<?php }elseif( $k->status = "Scheduled" ){   ?>

            <div class="container bootstrap snippets bootdeys pt-0">
                <div class="row">
                        <div class="col-lg-8 ml-auto mr-auto">
                            @if(Session::has('schedule_errmsg'))                 
                                <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                       <center><strong>{{Session::get('schedule_errmsg')}}</strong></center>
                                </div>
                                {{Session::forget('message')}}
                                {{Session::forget('schedule_errmsg')}}
                            @endif
                        </div>
                    </div>
              <?php 
                foreach ($developer_resource as $resource) {
              ?>
                <div class="row" id="user-profile">
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="main-box clearfix">
                            <h2><?php echo $resource->name; ?> <?php echo $resource->last_name; ?></h2>
                            <div class="profile-status">
                                <i class="fa fa-star"></i> <span> <?php echo $resource->rating; ?>/5</span>
                            </div>
                           
                            <img src="<?php echo URL::asset('public/upload/developer/'.$resource->image.'') ?>" alt="" class="profile-img img-responsive center-block">
                            <div class="profile-label">
                                <span class="label btn-success"> <?php echo $resource->perhr; ?> INR / Hr.</span>
                            </div>

                            <div class="profile-details">
                                <ul class="fa-ul">
                                    <li><i class="fa-li fa fa-language"></i> Language: <span><?php echo $resource->language; ?></span></li>
                                    <li><i class="fa-li fa fa-edit"></i>Education: <span><?php echo $resource->degree; ?></span></li>
                                    <li><i class="fa-li fa fa-tasks"></i>Total Jobs: <span><?php echo $resource->job; ?></span></li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-9 col-md-8 col-sm-8">
                        <div class="main-box clearfix">
                            <div class="profile-header">
                                <h3><span>Interview Review</span></h3>
                            </div>

                            <div class="row profile-user-info">
                        
                                <div class="col-sm-12">
                                    
                                        <div class="form-group">
                                         
                                            <div class="col-md-6">
                                                <button class="btn btn-success pull-right" style="margin-left: 10px;" id="myBtn">Feedback</button>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="modal" id="myModal">

                                              <div class="modal-content">
                                                <span class="close">&times;</span>
                                                <div class="col-md-12">
                                                    <div class="main-box clearfix">
                                                        <div class="profile-header">
                                                            <h3><span>Interview Review/Feedback</span></h3>
                                                        </div>
                                                        
                                                        <div class="row profile-user-info">
                                                            <div class="col-sm-12">
                                                                <?php 
                                                                    foreach ($developer_interview_resource as $resource) {
                                                                   
                                                                ?>
                                                                <form method="post" action="{{route('schedule_interview_qualified')}}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <?php 
                                                                        $id= Session::get('dev_id');
                                                                        //echo $resource->dev_id; exit();
                                                                        $dev_id =Session::put('dev_id', $resource->dev_id);
                                                                    ?>
                                                                    <input type="hidden" class="form-control" name="dev_id" value="<?php echo $resource->dev_id; ?>" placeholder="Subject" required="">
                                                                    
                                                                    <div class="form-group">
                                                                        <label><b>Schedule Interview Feedback:</b></label>
                                                                        
                                                                        <select class="form-control" name="status" required="">
                                                                            <option>-- Select Here --</option>
                                                                            <option name="status" value="Qualified">Qualified</option>
                                                                            <option name="status" value="Disqualified">Disqualified</option>
                                                                        </select>
                                                                        @if ($errors->has('status'))
                                                                            <strong class="text-danger">{{ $errors->first('status') }}</strong>                                  
                                                                        @endif
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label><b>Schedule Interview Review:</b></label>
                                                                        <!--<input type="hidden" class="form-control" name="update" value="<?php echo $resource->dev_id; ?>" autocomplete="off" required="" >-->
                                                                        <textarea class="form-control" name="review" id="review" placeholder="Interview Review" required=""></textarea>
                                                                        @if ($errors->has('review'))
                                                                            <strong class="text-danger">{{ $errors->first('review') }}</strong>                                  
                                                                        @endif
                                                                    </div>
                                                                    
                                                                    <div class="clearfix">
                                                                        <button type="submit" class="btn btn-success pull-right">Send</button>
                                                                    </div>
                                                                </form>
                                                                 <?php } ?>
                                                            </div>
                            
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                              </div>

                                        </div>
          
                                    
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
              <?php } ?>
            </div>
            
<?php }elseif( $k->status = "Qualified" ){ ?>

            <div class="container bootstrap snippets bootdeys pt-0">
                <div class="row">
                        <div class="col-lg-8 ml-auto mr-auto">
                            @if(Session::has('schedule_errmsg'))                 
                                <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                       <center><strong>{{Session::get('schedule_errmsg')}}</strong></center>
                                </div>
                                {{Session::forget('message')}}
                                {{Session::forget('schedule_errmsg')}}
                            @endif
                        </div>
                    </div>
              <?php 
                foreach ($developer_resource as $resource) {
                 
              ?>
                <div class="row" id="user-profile">
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="main-box clearfix">
                            <h2><?php echo $resource->name; ?> <?php echo $resource->last_name; ?></h2>
                            <div class="profile-status">
                                <i class="fa fa-star"></i> <span> <?php echo $resource->rating; ?>/5</span>
                            </div>
                           
                            <img src="<?php echo URL::asset('public/upload/developer/'.$resource->image.'') ?>" alt="" class="profile-img img-responsive center-block">
                            <div class="profile-label">
                                <span class="label btn-success"> <?php echo $resource->perhr; ?> INR / Hr.</span>
                            </div>

                            <div class="profile-details">
                                <ul class="fa-ul">
                                    <li><i class="fa-li fa fa-language"></i> Language: <span><?php echo $resource->language; ?></span></li>
                                    <li><i class="fa-li fa fa-edit"></i>Education: <span><?php echo $resource->degree; ?></span></li>
                                    <li><i class="fa-li fa fa-tasks"></i>Total Jobs: <span><?php echo $resource->job; ?></span></li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-9 col-md-8 col-sm-8">
                        <div class="main-box clearfix">
                            <div class="profile-header">
                                <h3><span>You are successfully submitted your request!</span></h3>
                                
                            </div>

                            <div class="row profile-user-info">
                        
                                <div class="col-sm-12">
                                    
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


              <?php } ?>
            </div>

<?php }elseif( $k->status = 1 ){  ?>

 
<?php if( $dev_order_details_empty > 0 && $k->status = "Qualified") {  echo $k->status; ?>
            <div class="container bootstrap snippets bootdeys pt-0">
                <div class="row">
                        <div class="col-lg-8 ml-auto mr-auto">
                            @if(Session::has('require_docs_errmsg'))                 
                                <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                       <center><strong>{{Session::get('require_docs_errmsg')}}</strong></center>
                                </div>
                                {{Session::forget('message')}}
                                {{Session::forget('require_docs_errmsg')}}
                            @endif
                        </div>
                    </div>
              <?php 
                foreach ($developer_resource as $resource) {
                 
              ?>
                <div class="row" id="user-profile">
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="main-box clearfix">
                            <h2><?php echo $resource->name; ?> </h2>
                            <div class="profile-status">
                                <i class="fa fa-check-circle"></i> Online
                            </div>
                            <img src="<?php echo URL::asset('public/upload/developer/'.$resource->image.'') ?>" alt="" class="profile-img img-responsive center-block">
                            <div class="profile-label">
                                <span class="label btn-success"> <?php echo $resource->perhr; ?> INR / Hr.</span>
                            </div>

                            <div class="profile-stars">
                                <i class="fa fa-star"></i>
                               <span> <?php echo $resource->rating; ?>/5</span>
                                
                            </div>

                            <div class="profile-since">
                               <?php echo $resource->date; ?>
                            </div>

                            <div class="profile-details">
                                <ul class="fa-ul">
                                    <li><i class="fa-li fa fa-language"></i> Language: <span><?php echo $resource->language; ?></span></li>
                                    <li><i class="fa-li fa fa-edit"></i>Education: <span><?php echo $resource->degree; ?></span></li>
                                    <li><i class="fa-li fa fa-tasks"></i>Total Jobs: <span><?php echo $resource->job; ?></span></li>
                                </ul>
                            </div>

                            <?php 
                                foreach($sow_details as $k) {
                                    if($k->dev_id == $resource->dev_id){
                                        if($k->sow_status == '1'){
                                        ?>
                                            <div class="profile-message-btn center-block text-center">
                                                <a href="#" class="btn btn-success">
                                                    <i class="fa fa-check-square-o"></i> SOW Accepted
                                                </a>
                                            </div>
                                <?php }elseif($k->sow_status == '2'){?>
                                    <div class="profile-message-btn center-block text-center">
                                        <a href="#" class="btn btn-warning">
                                            <i class="fa fa-times-circle"></i> SOW Rejected
                                        </a>
                                    </div>
                            <?php } } } ?>
                           
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-8 col-sm-8">
                        <div class="main-box clearfix">
                            <div class="profile-header">
                                <h3><span>Developer Information</span></h3>
                                
                            </div>

                            <div class="row profile-user-info">
                                <div class="col-sm-8">
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            First Name
                                        </div>
                                        <div class="profile-user-details-value">
                                            <?php echo $resource->name; ?>
                                        </div>
                                    </div>

                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Last Name
                                        </div>
                                        <div class="profile-user-details-value">
                                            <?php echo $resource->last_name; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Address
                                        </div>
                                        <div class="profile-user-details-value">
                                            <?php echo $resource->address; ?>
                                        </div>
                                    </div>
                                    
                                    <!-- <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Email
                                        </div>
                                        <div class="profile-user-details-value">
                                           <?php echo $resource->email; ?>
                                        </div>
                                    </div>
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Phone
                                        </div>
                                        <div class="profile-user-details-value">
                                            <?php echo $resource->phone; ?>
                                        </div>
                                    </div> -->

                                </div>

                                <?php 
                                foreach($sow_details as $k) {
                                    if($k->dev_id == $resource->dev_id){
                                        if($k->sow_status == '1'){
                                        ?>
                                        <div class="col-sm-4">
                                            <a href="javascript:void(0);" class="btn btn-success" data-toggle="modal" data-target="#createMilestone<?php echo $resource->dev_id; ?>">
                                                <i class="fa fa-clipboard"></i> Create Milestone
                                            </a>
                                        </div>
                                <?php } } } ?>
                            </div>


                             

                            <div class="tabs-wrapper profile-tabs">

                                <ul class="nav nav-tabs">
                                  
                                    <li><a href="#tab-chat<?php echo $resource->dev_id; ?>" data-toggle="tab">SOW</a></li>
                                    
                                    <li><a href="#tab-activity<?php echo $resource->dev_id; ?>" data-toggle="tab">Require Docs</a></li>
                                    <li><a href="#tab-friends<?php echo $resource->dev_id; ?>" data-toggle="tab">Short Message</a></li>                                     
                                </ul>

                                <div class="tab-content">
                                    
                                    <div class="tab-pane fade in" id="tab-activity<?php echo $resource->dev_id; ?>">

                                         <div class="conversation-new-message">
                                            <form  method="post" action="{{route('submit_require_docs')}}" enctype="multipart/form-data">
                                                @csrf

                                                 <input type="hidden" class="form-control" name="dev_id" value="<?php echo $resource->dev_id; ?>" placeholder="Subject" required="">
                                                <div class="form-group">
                                                   <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required="">
                                                   @if ($errors->has('subject'))
                                                        <strong class="text-danger">{{ $errors->first('subject') }}</strong>                                  
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <input type="file" class="form-control" name="require_docs" id="require_docs" required="" >
                                                    @if ($errors->has('require_docs'))
                                                    <strong class="text-danger">{{ $errors->first('require_docs') }}</strong>                                  
                                                    @endif
                                                </div>
                                                <div class="clearfix">
                                                    <button type="submit" class="btn btn-success pull-right">Send message</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab-friends<?php echo $resource->dev_id; ?>">
                                      
                                        <div class="conversation-wrapper">

                                            <div class="conversation-new-message">
                                                <form method="post" action="{{route('submit_short_message')}}">
                                                    @csrf
                                                    <input type="hidden" class="form-control" name="dev_id" value="<?php echo $resource->dev_id; ?>" placeholder="Subject" required="">

                                                    <div class="form-group">
                                                       <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required="">
                                                       @if ($errors->has('subject'))
                                                            <strong class="text-danger">{{ $errors->first('subject') }}</strong>                                  
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <textarea type="text"  class="ckeditor" name="description" id="description" placeholder="Enter Description" required=""></textarea>
                                                        @if ($errors->has('description'))
                                                            <strong class="text-danger">{{ $errors->first('description') }}</strong>                                  
                                                        @endif
                                                    </div>

                                                    <div class="clearfix">
                                                        <button type="submit" class="btn btn-success pull-right">Send message</button>
                                                    </div>
                                                </form>
                                            </div>

                                           
                                        </div>
                                        
                                    </div>

                                    <div class="tab-pane fade active show" id="tab-chat<?php echo $resource->dev_id; ?>">
                                        <div class="conversation-wrapper">
                                            <!--<div class="conversation-content">
                                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 340px;">
                                                    <div class="conversation-inner" style="overflow: hidden; width: auto; height: 340px;">

                                                        <div class="conversation-item item-left clearfix">
                                                            <div class="conversation-user">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-responsive"  alt="">
                                                            </div>
                                                            <div class="conversation-body">
                                                                <div class="name">
                                                                    Ryan Gossling
                                                                </div>
                                                                <div class="time hidden-xs">
                                                                    September 21, 2013 18:28
                                                                </div>
                                                                <div class="text">
                                                                    I don't think they tried to market it to the billionaire, spelunking, base-jumping crowd.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-item item-right clearfix">
                                                            <div class="conversation-user">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-responsive"  alt="">
                                                            </div>
                                                            <div class="conversation-body">
                                                                <div class="name">
                                                                    Mila Kunis
                                                                </div>
                                                                <div class="time hidden-xs">
                                                                    September 21, 2013 12:45
                                                                </div>
                                                                <div class="text">
                                                                    Normally, both your asses would be dead as fucking fried chicken, but you happen to pull this shit while I'm in a transitional period so I don't wanna kill you, I wanna help you.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-item item-right clearfix">
                                                            <div class="conversation-user">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-responsive"  alt="">
                                                            </div>
                                                            <div class="conversation-body">
                                                                <div class="name">
                                                                    Mila Kunis
                                                                </div>
                                                                <div class="time hidden-xs">
                                                                    September 21, 2013 12:45
                                                                </div>
                                                                <div class="text">
                                                                    Normally, both your asses would be dead as fucking fried chicken, but you happen to pull this shit while I'm in a transitional period so I don't wanna kill you, I wanna help you.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-item item-left clearfix">
                                                            <div class="conversation-user">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-responsive"  alt="">
                                                            </div>
                                                            <div class="conversation-body">
                                                                <div class="name">
                                                                    Ryan Gossling
                                                                </div>
                                                                <div class="time hidden-xs">
                                                                    September 21, 2013 18:28
                                                                </div>
                                                                <div class="text">
                                                                    I don't think they tried to market it to the billionaire, spelunking, base-jumping crowd.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-item item-right clearfix">
                                                            <div class="conversation-user">
                                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-responsive"  alt="">
                                                            </div>
                                                            <div class="conversation-body">
                                                                <div class="name">
                                                                    Mila Kunis
                                                                </div>
                                                                <div class="time hidden-xs">
                                                                    September 21, 2013 12:45
                                                                </div>
                                                                <div class="text">
                                                                    Normally, both your asses would be dead as fucking fried chicken, but you happen to pull this shit while I'm in a transitional period so I don't wanna kill you, I wanna help you.
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 0, 0);"></div>
                                                    <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div>
                                                </div>
                                            </div>-->
                                            
                                                        <div class="conversation-new-message">
                                                            <form method="post" action="{{route('submit_sow_docs')}}" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" class="form-control" name="dev_id" value="<?php echo $resource->dev_id; ?>" placeholder="Subject" required="">
                                                                
                                                                <div class="form-group">
                                                                   <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required="">
                                                                    @if ($errors->has('subject'))
                                                                        <strong class="text-danger">{{ $errors->first('subject') }}</strong>                                  
                                                                    @endif
                                                                </div>

                                                                <div class="form-group">
                                                                    <input type="file" class="form-control" name="sow_docs" id="sow_docs" required="" >
                                                                    @if ($errors->has('sow_docs'))
                                                                        <strong class="text-danger">{{ $errors->first('sow_docs') }}</strong>                                  
                                                                    @endif
                                                                </div>

                                                                <div class="clearfix">
                                                                    <button type="submit" class="btn btn-success pull-right">Send message</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                             
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal" id="createMilestone<?php echo $resource->dev_id; ?>">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="row">
                                            <div class="col-lg-8 ml-auto mr-auto">
                                                @if(Session::has('freemsg'))                 
                                                    <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                                           <strong>{{Session::get('freemsg')}}</strong>
                                                    </div>
                                                    {{Session::forget('message')}}
                                                    {{Session::forget('freemsg')}}
                                                @endif
                                            </div>
                                        </div>
                                      
                                            <div class="modal-body">
                                                <h6 style="color:black;text-transform: capitalize;font-size:12px">Create Milestone For, <?php echo $resource->name; ?> <?php echo $resource->last_name; ?> <b style="color:blue;font-size:15px"><i class="fa fa-certificate"></i></b></h6>
                                                <button type="button" style="float:right;margin-top:-43px;" class="btn btn-sm btn-danger" data-dismiss="modal">X</button>                                           
                                                   <hr>
                                                    <?php 
                                                        foreach($sow_details as $k) {
                                                            if($k->dev_id == $resource->dev_id){ ?>
                                                            <form  method="post" action="{{ route('submit_milestone') }}" runat="server" onsubmit="ShowLoading()" enctype="multipart/form-data">
                                                                @csrf

                                                                
                                                                <input type="hidden" class="form-control" name="sow_id" value="<?php echo $k->id; ?>" placeholder="Subject" required="">

                                                                <div class="form-group">
                                                                    <label class="control-label col-sm-12" for="project_name">Milestone Name:</label>
                                                                    <div class="col-sm-12">
                                                                       <input type="text" class="form-control" name="milestone_name" id="milestone_name" placeholder="Enter Milestone Name" required="">
                                                                        @if ($errors->has('milestone_name'))
                                                                        <strong class="text-danger">{{ $errors->first('milestone_name') }}</strong>                                  
                                                                        @endif
                                                                    </div>
                                                                  </div>

                                                                  <div class="form-group">
                                                                    <label class="control-label col-sm-12" for="project_price">Days : </label>
                                                                    <div class="col-sm-12">
                                                                        <input type="number" class="form-control" name="days" id="days" placeholder="Enter Days" required="">
                                                                        @if ($errors->has('days'))
                                                                        <strong class="text-danger">{{ $errors->first('days') }}</strong>                                  
                                                                        @endif
                                                                    </div>
                                                                  </div>

                                                                  <div class="form-group">
                                                                    <label class="control-label col-sm-12" for="milestone_pdf">Choose PDF : </label>
                                                                    <div class="col-sm-12">
                                                                        <input type="file" class="form-control" name="milestone_pdf" id="milestone_pdf" required="" >
                                                                        @if ($errors->has('milestone_pdf'))
                                                                        <strong class="text-danger">{{ $errors->first('milestone_pdf') }}</strong>                                  
                                                                        @endif
                                                                    </div>
                                                                  </div>

                                                                  <div class="form-group">
                                                                    <label class="control-label col-sm-12" for="project_duration">Work Description : </label>
                                                                    <div class="col-sm-12">
                                                                        <textarea type="text"  rows="4" cols="50" class="form-control" name="work" id="work" placeholder="Enter Work" required=""></textarea>
                                                                        @if ($errors->has('work'))
                                                                        <strong class="text-danger">{{ $errors->first('work') }}</strong>                                  
                                                                        @endif
                                                                    </div>
                                                                  </div>
                                                              
                                                                  <hr>
                                                                  <div class="form-group">
                                                                    <div class="col-sm-offset-2 col-sm-12">
                                                                      <button type="submit" class="btn btn-primary">Create</button>
                                                                    </div>
                                                                  </div>

                                                                </form> 
                                                        <?php } } ?>
                                            </div>
                                       
                                    </div>
                                </div>
                            </div> 

                        </div>
                    </div>
                </div>


              <?php } ?>
            </div>

<?php } else { ?>

            <div class="container pt-0">            
            <div class="cart-wrapper">
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
                                    <!-- <a href="{{route('add_work_space')}}" class="list-group-item"><i class="fa fa-plus" aria-hidden="true"></i>   Add Work Space <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                                    <a href="{{route('resource')}}" class="list-group-item"><i class="fa fa-child" aria-hidden="true"></i>   Resource <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <a href="{{route('assign_work')}}" class="list-group-item"><i class="fa fa-suitcase" aria-hidden="true"></i>    Assign Work <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    <a href="{{route('user_logout')}}" class="list-group-item"><i class="fa fa-sign-out" aria-hidden="true"></i>    Logout <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>               
                    </div>
                    <div class="col-md-9">
                       <center> <h5><img src="{{ URL::asset('public/front/assets/images/2.png') }}" class="rounded-circle" width="310px" height="250px"></h5>
                        <h4 class="card-title">Hire us for your Project Now!.</h4>
                        <hr style="width:550px;">
                        <a class="btn btn-primary btn-lg" href="{{route('index')}}" role="button">Go    <i class="fa fa-arrow-right"></i></a> 
                        </center> 
                    </div>
                </div> 
            </div>
        </div> 

<?php } ?>

<?php }elseif( $k->status = "Disqualified"){  ?>

      <div class="container bootstrap snippets bootdeys pt-0">
                <div class="row">
                        <div class="col-lg-8 ml-auto mr-auto">
                            @if(Session::has('schedule_errmsg'))                 
                                <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                       <center><strong>{{Session::get('schedule_errmsg')}}</strong></center>
                                </div>
                                {{Session::forget('message')}}
                                {{Session::forget('schedule_errmsg')}}
                            @endif
                        </div>
                    </div>
              <?php 
                foreach ($developer_resource as $resource) {
                 
              ?>
                <div class="row" id="user-profile">
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="main-box clearfix">
                            <h2><?php echo $resource->name; ?> <?php echo $resource->last_name; ?></h2>
                            <div class="profile-status">
                                <i class="fa fa-star"></i> <span> <?php echo $resource->rating; ?>/5</span>
                            </div>
                           
                            <img src="<?php echo URL::asset('public/upload/developer/'.$resource->image.'') ?>" alt="" class="profile-img img-responsive center-block">
                            <div class="profile-label">
                                <span class="label btn-success"> <?php echo $resource->perhr; ?> INR / Hr.</span>
                            </div>

                            <div class="profile-details">
                                <ul class="fa-ul">
                                    <li><i class="fa-li fa fa-language"></i> Language: <span><?php echo $resource->language; ?></span></li>
                                    <li><i class="fa-li fa fa-edit"></i>Education: <span><?php echo $resource->degree; ?></span></li>
                                    <li><i class="fa-li fa fa-tasks"></i>Total Jobs: <span><?php echo $resource->job; ?></span></li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-9 col-md-8 col-sm-8">
                        <div class="main-box clearfix">
                            <div class="profile-header">
                                <h3><span>Interview Schedule</span></h3>
                                
                            </div>

                            <div class="row profile-user-info">
                        
                                <div class="col-sm-12">
                                    <form method="post" action="{{route('schedule_interview_resource')}}" enctype="multipart/form-data">
                                        @csrf
                                        <?php 
                                            $id= Session::get('dev_id');
                                            //echo $id; exit();
                                        ?>
                                        <input type="hidden" class="form-control" name="dev_id" value="<?php echo $resource->dev_id; ?>" placeholder="Subject" required="">
                                        <div class="form-group">
                                            <label><b>1st Schedule Interview Date and Time:</b></label>
                                            <input type="datetime-local" class="form-control" name="interviewdateone" id="subject" placeholder="Interview Date and Time" required="">
                                            @if ($errors->has('interviewdateone'))
                                                <strong class="text-danger">{{ $errors->first('interviewdateone') }}</strong>                                  
                                            @endif
                                        </div>
                                        
                                        <div class="form-group">
                                            <label><b>2nd Schedule Interview Date and Time:</b></label>
                                            <input type="datetime-local" class="form-control" name="interviewdatetwo" id="subject" placeholder="Interview Date and Time" required="">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label><b>3rd Schedule Interview Date and Time:</b></label>
                                            <input type="datetime-local" class="form-control" name="interviewdatethree" id="subject" placeholder="Interview Date and Time" required="">
                                        </div>
                                                    
                                        <div class="clearfix">
                                            <button type="submit" class="btn btn-success pull-right">Schedule</button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


              <?php } ?>
            </div>

<?php } } ?>

   
          
@endsection