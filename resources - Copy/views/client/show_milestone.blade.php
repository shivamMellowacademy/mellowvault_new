@extends('client.layout')
@section('content')


<div class="row">
    <div class="col-lg-8 ml-auto mr-auto">
        @if(Session::has('milestoneerrmsg'))                 
            <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                   <strong>{{Session::get('milestoneerrmsg')}}</strong>
            </div>
            {{Session::forget('message')}}
            {{Session::forget('milestoneerrmsg')}}
        @endif
       
    </div>
</div>
<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Milestone</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Milestone Name</th>
                                        <th>work Description</th>
                                        <th>Days</th>
                                        <th>Price</th>
                                        <th>Advance Price (40 %)</th>
                                        <th>Due Price</th>
                                        <th>Status</th>
                                        <th>Advance Payment</th>
                                        <th>Completion Request</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                        <th>Reward</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;
                                        foreach($milestone as $m) { ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $m->milestone_name; ?></td>
                                                <td> <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myworkModal<?php echo $m->id; ?>" >Details</a></td>
                                                <td><?php echo $m->days; ?></td>

                                                <?php 
                                                    foreach ($developer_price_details as $dpd) {
                                                        if($dpd->dev_id == $m->dev_id){
                                                ?>
                                                    <td>
                                                        <?php
                                                            $price = $dpd->perhr; 
                                                            $days = $m->days;
                                                            echo $total_price = $days * $price;
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php 
                                                            $price = $dpd->perhr; 
                                                            $days = $m->days;
                                                            $tprice = $days * $price;
                                                            
                                                            echo $total_price = $tprice - $calculate_price = (( 40 / 100 ) * $tprice ); 
                                                             session(['total_price' => $total_price]);
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php 
                                                            $price = $dpd->perhr; 
                                                            $days = $m->days;
                                                            $tprice = $days * $price;
                                                            
                                                            $total_price = $tprice - $calculate_price = (( 40 / 100 ) * $tprice ); 
                                                            echo $due_price = $tprice - $total_price;
                                                        ?>
                                                    </td>

                                                <?php }

                                                 } ?>



                                               <?php
                                                    if( $m->status == '0' ){
                                                ?>
                                                    <td><p class="btn btn-danger">Rejected</p>
                                                        <a href="javascript:void();" data-toggle="modal" data-target="#myRejectReasonModal<?php echo $m->id; ?>" class="btn btn-danger">Reason</a>
                                                    </td>
                                                    
                                                    <td></td>
                                                    <td></td>
                                                <?php } elseif( $m->status == '1' ){ ?>
                                                    <td><p class="btn btn-success btn-sm" ><i class="fa fa-check-square"></i>Accepted</p></td>

                                                    <?php 
                                                        if($m->advance_payment_status == ''){
                                                    ?>
                                                        <td><a href="{{route('client_advance_payment',['sow_id'=>''.$m->sow_id.''])}}" class="btn btn-success btn-sm">Advance payment</a></td>
                                                        <td></td>
                                                      

                                                    <?php }elseif($m->advance_payment_status == '1'){?>
                                                        <td><p class="btn btn-success">Advance Payment Completed</p></td>
                                                        <?php
                                                            if( $m->completion_status == '0'){
                                                        ?> 
                                                            <td><a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myRequestModal<?php echo $m->id; ?>" >Requested Details </a></td>
                                                        <?php }elseif( $m->completion_status == '1' ){ ?>
                                                            <td><p class="btn btn-success">Completion Accepted</p></td>
                                                        <?php }elseif( $m->completion_status == '2' ){ ?>
                                                            <td><p class="btn btn-danger"><b>Completion Reject</b></p></td>
                                                        <?php } ?>
                                                    <?php } ?>

                                                <?php }elseif( $m->status == 'Null' ){ ?>
                                                    <td> <a href="{{route('milestone_accept',['sow_value' => 1 ,'id' => $m->id])}}" class="btn btn-success">Accept</a> <a href="javascript:void();" data-toggle="modal" data-target="#myRejectModal<?php echo $m->id; ?>"  class="btn btn-danger" style="margin-top: 10px;">Reject</a></td>
                                                    <td></td>
                                                    <td></td>
                                                <?php } ?> 
                                                
                                                <td><?php echo $m->date; ?></td> 


                                                <?php
                                                    if( $m->status == '0' ){
                                                ?>
                                                    <td>
                                                        <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myeditModal<?php echo $m->id; ?>" ><i class="fa fa-edit"></i></a>
                                                        <a class="btn btn-danger btn-sm" onclick="alert('Are You Sure To Delete This?')" href="<?php echo route('delete_milestone',['id'=>''.$m->id.'']) ?>" ><i class="fa fa-trash"></i></a>
                                                    </td> 
                                                <?php }elseif( $m->status == '1' ){ ?>
                                                    <td>
                                                        <p class="btn btn-danger">You Can't change Now!</p>
                                                    </td>
                                                <?php }elseif( $m->status == 'Null' ){ ?>
                                                    <td>
                                                        <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myeditModal<?php echo $m->id; ?>" ><i class="fa fa-edit"></i></a>
                                                        <a class="btn btn-danger btn-sm" onclick="alert('Are You Sure To Delete This?')" href="<?php echo route('delete_milestone',['id'=>''.$m->id.'']) ?>" ><i class="fa fa-trash"></i></a>
                                                    </td> 
                                                <?php } ?>

                                                <?php 
                                                    if($m->completion_status == '0'){
                                                ?>
                                                    <td></td>
                                                <?php }elseif( $m->completion_status == '1' ){


                                                    if( $m->rating_status == ''){
                                                        ?>

                                                            <td><a class="btn btn-info btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myRewardModal<?php echo $m->id; ?>" >Reward </a></td>
                                                    <?php }else{ ?>
                                                            <td><p class="btn btn-success btn-sm" >Thanks For Reward</p></td>

                                                <?php } } elseif( $m->completion_status == '2' ){ ?>
                                                    <td></td>
                                                <?php } ?>


                                            </tr>
                                            <div class="modal" id="myeditModal<?php echo $m->id; ?>">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Update Milestone Details</h4>
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                         <div class="modal-body">
                                                            <form method="post" action="{{route('update_milestone')}}" enctype="multipart/form-data">
                                                                @csrf

                                                                <input type="hidden" class="form-control" name="sow_id" value="<?php echo $m->sow_id; ?>" autocomplete="off" required="" >

                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group bmd-form-group">
                                                                            <label class="bmd-label-floating">Enter Milestone Name</label>
                                                                            <input type="hidden" class="form-control" name="update" value="<?php echo $m->id; ?>" autocomplete="off" required="" >
                                                                            <input type="text" class="form-control" name="milestone_name" value="<?php echo $m->milestone_name; ?>" autocomplete="off" required="" >
                                                                            @if ($errors->has('milestone_name'))
                                                                            <strong class="text-danger">{{ $errors->first('milestone_name') }}</strong>                                   
                                                                            @endif
                                                                        </div>                      
                                                                    </div> 

                                                                    <div class="col-sm-6">
                                                                        <div class="form-group bmd-form-group">
                                                                            <label class="bmd-label-floating">Enter Days</label>
                                                                            <input type="hidden" class="form-control" name="update" value="<?php echo $m->id; ?>" autocomplete="off" required="" >
                                                                            <input type="text" class="form-control" name="days" value="<?php echo $m->days; ?>" autocomplete="off" required="" >
                                                                            @if ($errors->has('days'))
                                                                            <strong class="text-danger">{{ $errors->first('days') }}</strong>                                   
                                                                            @endif
                                                                        </div>                      
                                                                    </div> 

                                                                   

                                                                    <div class="form-group col-sm-12">
                                                                        <label for="image">Choose PDF</label>
                                                                        <input type="hidden" class="form-control" name="old_milestone_pdf" value="<?php echo $m->milestone_pdf; ?>"  autocomplete="off" >
                                                                        <input type="file" class="form-control" name="milestone_pdf" id="milestone_pdf">
                                                                        <?php echo $m->milestone_pdf; ?>
                                                                        @if ($errors->has('milestone_pdf'))
                                                                        <strong class="text-danger">{{ $errors->first('milestone_pdf') }}</strong>                                  
                                                                        @endif
                                                                    </div>   
                                                                    
                                                                    
                                                                     <div class="col-sm-12">
                                                                        <div class="form-group bmd-form-group">
                                                                            <label class="bmd-label-floating">Enter Work Description</label>
                                                                            <input type="hidden" class="form-control" name="update" value="<?php echo $m->id; ?>" autocomplete="off" required="" >
                                                                            <!--<input type="text" class="form-control" name="description" value="< ?php echo $s->description; ?>" autocomplete="off" required="" >-->
                                                                            <textarea class="ckeditor" name="work" autocomplete="off" required=""><?php echo $m->work; ?></textarea>
                                                                            @if ($errors->has('work'))
                                                                            <strong class="text-danger">{{ $errors->first('work') }}</strong>                                   
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

                                            <div class="modal" id="myworkModal<?php echo $m->id; ?>">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Work Description</h4>
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="card">
                                                              <div class="card-body">
                                                                <?php echo $m->work; ?>
                                                              </div>
                                                            </div>  
                                                        </div> 

                                                        <div class="modal-body">
                                                            <div class="card">
                                                              <div class="card-body">
                                                                <a href="{{route('milestone_pdf_download', $m->id )}}" type="button" class="btn btn-danger"><i class="fa fa-download"></i>  Download Milestone</a>
                                                              </div>
                                                            </div>  
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal" id="myRequestModal<?php echo $m->id; ?>">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Completion Request</h4>
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <?php 
                                                            foreach ($project_complition_details as $pcd) {
                                                                if( $pcd->milestone_id == $m->id ){
                                                        ?>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                              <div class="card-body">
                                                                <?php 
                                                                    $img=$pcd->project_screenshot;
                                                                    $images = explode(',',$img);
                                                                    foreach($images as $image) 
                                                                        { 
                                                                ?>
                                                                    <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/project_screenshot/'.$image.'') ?>" style="height:80px">
                                                                <?php } ?>
                                                              </div>
                                                            </div>  
                                                        </div> 

                                                        <div class="modal-body">
                                                            <div class="card">
                                                              <div class="card-body">
                                                                <?php echo $pcd->message; ?>
                                                              </div>
                                                            </div>  
                                                        </div> 

                                                        <?php } } ?>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <a href="<?php echo route('completion_approve',['id'=>''.$m->id.'']) ?>" class="btn btn-success">APPROVE</a>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <a href="javascript:void();" data-toggle="modal" data-target="#myCompletioDisapproveModal<?php echo $m->id; ?>" class="btn btn-danger">DISAPPROVE</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal" id="myRewardModal<?php echo $m->id; ?>">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Rating</h4>
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        

                                                         <div class="modal-body">
                                                                <form method="post" action="{{ route('developer_rating') }}" enctype="multipart/form-data">
                                                                @csrf
                                                                    <div class="row">

                                                                        <input type="hidden" class="form-control" name="milestone_id" value="<?php echo $m->id; ?>" required="">
                                                                        <input type="hidden" class="form-control" name="sow_id" value="<?php echo $m->sow_id; ?>" required="">

                                                                        <div class="form-group col-md-6">
                                                                            <label for="logical_stability">Logical Stability</label>
                                                                            <input type="number" class="form-control" name="logical_stability" id="logical_stability" placeholder="Enter Logical Stability" maxlength="5" required="">
                                                                            <p style="color:red">(Rating out of 5)</p>
                                                                            @if ($errors->has('logical_stability'))
                                                                            <strong class="text-danger">{{ $errors->first('logical_stability') }}</strong>                                  
                                                                            @endif
                                                                        </div>

                                                                        <div class="form-group col-md-6">
                                                                            <label for="code_quality">Code Quality</label>
                                                                            <input type="number" class="form-control" name="code_quality" id="code_quality" placeholder="Enter Code Quality" required="">
                                                                            <p style="color:red">(Rating out of 5)</p>
                                                                            @if ($errors->has('code_quality'))
                                                                            <strong class="text-danger">{{ $errors->first('code_quality') }}</strong>                                  
                                                                            @endif
                                                                        </div>


                                                                        <div class="form-group col-md-6">
                                                                            <label for="understanding">Understanding</label>
                                                                            <input type="number" class="form-control" name="understanding" id="understanding" placeholder="Enter Understanding" required="">
                                                                            <p style="color:red">(Rating out of 5)</p>
                                                                            @if ($errors->has('understanding'))
                                                                            <strong class="text-danger">{{ $errors->first('understanding') }}</strong>                                  
                                                                            @endif
                                                                        </div>

                                                                        <div class="form-group col-md-6">
                                                                            <label for="communication">Communication</label>
                                                                            <input type="number" class="form-control" name="communication" id="communication" placeholder="Enter Communication" required="">
                                                                            <p style="color:red">(Rating out of 5)</p>
                                                                            @if ($errors->has('communication'))
                                                                            <strong class="text-danger">{{ $errors->first('communication') }}</strong>                                  
                                                                            @endif
                                                                        </div>

                                                                        <div class="form-group col-md-6">
                                                                            <label for="behaviour">Behaviour</label>
                                                                            <input type="number" class="form-control" name="behaviour" id="behaviour" placeholder="Enter Behaviour" required="">
                                                                            <p style="color:red">(Rating out of 5)</p>
                                                                            @if ($errors->has('behaviour'))
                                                                            <strong class="text-danger">{{ $errors->first('behaviour') }}</strong>                                  
                                                                            @endif
                                                                        </div>

                                                                        <div class="form-group col-md-6">
                                                                            <label for="work_performance">Work Performance</label>
                                                                            <input type="number" class="form-control" name="work_performance" id="work_performance" placeholder="Enter Work Performance" required="">
                                                                            <p style="color:red">(Rating out of 5)</p>
                                                                            @if ($errors->has('work_performance'))
                                                                            <strong class="text-danger">{{ $errors->first('work_performance') }}</strong>                                  
                                                                            @endif
                                                                        </div>

                                                                        <div class="form-group col-md-12">
                                                                            <label for="delivary_review">Delivery Review</label>
                                                                            <input type="number" class="form-control" name="delivary_review" id="delivary_review" placeholder="Enter Delivery Review" required="">
                                                                            <p style="color:red">(Rating out of 5)</p>
                                                                            @if ($errors->has('delivary_review'))
                                                                            <strong class="text-danger">{{ $errors->first('delivary_review') }}</strong>                                  
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                            
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group bmd-form-group">
                                                                            <button type="submit" class="btn btn-success btn-block">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </form> 
                                                            </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal" id="myCompletioDisapproveModal<?php echo $m->id; ?>">
                                                <br><br>
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content" style="background-color: lightskyblue;border: 2px solid black;">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Disapprove</h4>
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        
                                                         <div class="modal-body">
                                                                <form method="post" action="{{ route('completion_disapprove_reason') }}">
                                                                @csrf
                                                                    <div class="row">
                                                                        <input type="hidden" class="form-control" name="update" value="<?php echo $m->id; ?>" autocomplete="off">
                                                                        <div class="form-group col-md-12">
                                                                            <label for="completion_disapp_res">Reason For Disapprove</label>
                                                                            <input type="text" class="form-control" name="completion_disapp_res" id="completion_disapp_res" placeholder="Enter reason" required="">
                                                                            @if ($errors->has('completion_disapp_res'))
                                                                            <strong class="text-danger">{{ $errors->first('completion_disapp_res') }}</strong>                                  
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                            
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group bmd-form-group">
                                                                            <button type="submit" class="btn btn-success btn-block">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </form> 
                                                            </div>

                                                    </div>
                                                </div>
                                            </div>



                                            <div class="modal" id="myRejectModal<?php echo $m->id; ?>">
                                                <br><br>
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content" style="background-color: lightskyblue;border: 2px solid black;">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Rejection Reason</h4>
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        
                                                         <div class="modal-body">
                                                                <form method="post" action="{{route('milestone_reject',['sow_value' => '0' ,'id' => $m->id])}}">
                                                                @csrf
                                                                    <div class="row">
                                                                        
                                                                        <div class="form-group col-md-12">
                                                                            <label for="milestone_reject">Reason For Rejection</label>
                                                                            <input type="text" class="form-control" name="milestone_reject" id="milestone_reject" placeholder="Enter Remark" required="">
                                                                            @if ($errors->has('milestone_reject'))
                                                                            <strong class="text-danger">{{ $errors->first('milestone_reject') }}</strong>                                  
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                            
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group bmd-form-group">
                                                                            <button type="submit" class="btn btn-success btn-block">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </form> 
                                                            </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal" id="myRejectReasonModal<?php echo $m->id; ?>">
                                                <br><br>
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content" style="border: 2px solid black;">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Rejection Reason</h4>
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        
                                                        <div class="modal-body">
                                                            <p><?php echo $m->milestone_reject; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                    <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
       	</div>
    </div>
</div>


@endsection