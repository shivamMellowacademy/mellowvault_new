@extends('developer.layout')
@section('content')

<div class="page-content">
        <div class="page-info container">
            <nav aria-label="breadcrumb">
                
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Milestone</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
               
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-8 ml-auto mr-auto">
                @if(Session::has('projectcomplitionerrmsg'))                 
                    <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                           <strong>{{Session::get('projectcomplitionerrmsg')}}</strong>
                    </div>
                    {{Session::forget('message')}}
                    {{Session::forget('projectcomplitionerrmsg')}}
                @endif
            </div>
        </div>
        <div class="main-wrapper container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table id="complex-header" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Milestone Name</th>
                                                <th>Work</th>
                                                <th>Days</th>
                                                <th>Status</th>
                                                <th>Advance Payment</th>
                                                <th>Completion Request</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; foreach($developer_milestone as $dm) { ?>
                                                <tr>
                                                    <td><?php echo $dm->milestone_name; ?></td>
                                                    <td> <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myworkModal<?php echo $dm->id; ?>" >Details</a></td>
                                                    <td><?php echo $dm->days; ?></td>
                                                    

                                                    <?php
                                                        if( $dm->status == '0' ){
                                                    ?>
                                                        <td>
                                                            <p class="btn btn-danger">Rejected</p>
                                                            <a href="javascript:void();" data-toggle="modal" data-target="#myRejectReasonModal<?php echo $dm->id; ?>" class="btn btn-danger">Reason</a>
                                                        </td>
                                                        <td></td>
                                                        <td></td>

                                                    <?php } elseif( $dm->status == '1' ){ ?>

                                                        <td><p class="btn btn-success"><i class="fa fa-check-square">Accepted</p></td>

                                                        <?php 
                                                            if($dm->advance_payment_status == ''){
                                                        ?>
                                                            <td></td>
                                                            <td></td>

                                                        <?php }elseif($dm->advance_payment_status == '1'){ ?>

                                                                <td><p class="btn btn-success">Advance Payment Completed</p></td>
                                                                <?php
                                                                    if( $dm->completion_status == '0' ){
                                                                ?>
                                                                   <td><a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myRequestModal<?php echo $dm->id; ?>" >Request</a></td>
                                                                <?php } elseif( $dm->completion_status == '1' ) {?> 
                                                                    <td><p class="btn btn-success">Completion Approved</p></td>
                                                                <?php }elseif( $dm->completion_status == '2' ){ ?>
                                                                    <td>
                                                                        <a class="btn btn-danger btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myRequestModal<?php echo $dm->id; ?>" >Disapprove</a>
                                                                        <a class="btn btn-danger btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myDisapproveReasonModal<?php echo $dm->id; ?>" style="margin-top: 10px">Disapprove Reason</a>
                                                                    </td>
                                                                <?php } ?>
                                                        <?php } ?>


                                                    <?php }elseif( $dm->status == 'Null' ){ ?>
                                                        <td> <a href="{{route('developer_milestone_accept',['sow_value' => 1 ,'id' => $dm->id])}}" class="btn btn-success">Accept</a> <a href="javascript:void();" data-toggle="modal" data-target="#myRejectModal<?php echo $dm->id; ?>"  class="btn btn-danger" style="margin-top: 10px;">Reject</a></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?php } ?>

                                                    
                                                    <td><?php echo $dm->date; ?></td> 

                                                       

                                                    <?php
                                                    if( $dm->status == '0' ){
                                                ?>
                                                    <td>
                                                        <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myeditModal<?php echo $dm->id; ?>" ><i class="fa fa-edit"></i></a>
                                                        <a class="btn btn-danger btn-sm" onclick="alert('Are You Sure To Delete This?')" href="<?php echo route('developer_delete_milestone',['id'=>''.$dm->id.'']) ?>" ><i class="fa fa-trash"></i></a>
                                                    </td> 
                                                <?php }elseif( $dm->status == '1' ){ ?>
                                                    <td>
                                                        <p class="btn btn-danger">You Can't change Now!</p>
                                                    </td>
                                                <?php }elseif( $dm->status == 'Null' ){ ?>
                                                    <td>
                                                        <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myeditModal<?php echo $dm->id; ?>" ><i class="fa fa-edit"></i></a>
                                                        <a class="btn btn-danger btn-sm" onclick="alert('Are You Sure To Delete This?')" href="<?php echo route('developer_delete_milestone',['id'=>''.$dm->id.'']) ?>" ><i class="fa fa-trash"></i></a>
                                                    </td> 
                                                <?php } ?>   

                                                 
                                                </tr>   
                                                <div class="modal" id="myworkModal<?php echo $dm->id; ?>">
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
                                                                    <?php echo $dm->work; ?>
                                                                  </div>
                                                                </div>  
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="card">
                                                                  <div class="card-body">
                                                                    <a href="{{route('developer_milestone_pdf_download', $dm->id )}}" type="button" class="btn btn-danger"><i class="fa fa-download"></i>  Download Milestone</a>
                                                                  </div>
                                                                </div>  
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="modal" id="myRequestModal<?php echo $dm->id; ?>">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Completion Request Form</h4>
                                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">

                                                                

                                                                <form method="post" action="{{ route('submit_complition_request') }}" enctype="multipart/form-data">
                                                                @csrf
                                                                    <div class="row">

                                                                        <input type="hidden" class="form-control" name="milestone_id" value="<?php echo $dm->id; ?>" autocomplete="off" required="" >
                                                                        
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group bmd-form-group is-filled">
                                                                                <label class="bmd-label-floating">Choose Screen Shoot</label>
                                                                                <input type="file" class="form-control" name="project_screenshot[]" accept="image/*" multiple autocomplete="off">
                                                                                @if ($errors->has('project_screenshot'))
                                                                                <strong class="text-danger">{{ $errors->first('project_screenshot') }}</strong>                                 
                                                                                @endif
                                                                            </div>
                                                                        </div> 

                                                                        <div class="form-group col-md-12">
                                                                            <label for="message">Message</label>
                                                                            <textarea type="text"  class="ckeditor" name="message" id="message" placeholder="Enter Message" required=""></textarea>
                                                                            @if ($errors->has('message'))
                                                                            <strong class="text-danger">{{ $errors->first('message') }}</strong>                                  
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                            
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group bmd-form-group">
                                                                            <button type="submit" class="btn btn-success btn-block">Send</button>
                                                                        </div>
                                                                    </div>
                                                                </form> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 


                                                <div class="modal" id="myDisapproveReasonModal<?php echo $dm->id; ?>">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Project Disapprove Reason</h4>
                                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">

                                                                <div class="card">
                                                                  <div class="card-body">
                                                                    <?php echo $dm->completion_disapp_res; ?>
                                                                  </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 


                                                <div class="modal" id="myeditModal<?php echo $dm->id; ?>">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Update Milestone Details</h4>
                                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                            </div>
                                                            <!-- Modal body -->
                                                             <div class="modal-body">
                                                                <form method="post" action="{{route('developer_update_milestone')}}" enctype="multipart/form-data">
                                                                    @csrf

                                                                    <input type="hidden" class="form-control" name="sow_id" value="<?php echo $dm->sow_id; ?>" autocomplete="off" required="" >

                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group bmd-form-group">
                                                                                <label class="bmd-label-floating">Enter Milestone Name</label>
                                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $dm->id; ?>" autocomplete="off" required="" >
                                                                                <input type="text" class="form-control" name="milestone_name" value="<?php echo $dm->milestone_name; ?>" autocomplete="off" required="" >
                                                                                @if ($errors->has('milestone_name'))
                                                                                <strong class="text-danger">{{ $errors->first('milestone_name') }}</strong>                                   
                                                                                @endif
                                                                            </div>                      
                                                                        </div> 

                                                                        <div class="col-sm-6">
                                                                            <div class="form-group bmd-form-group">
                                                                                <label class="bmd-label-floating">Enter Days</label>
                                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $dm->id; ?>" autocomplete="off" required="" >
                                                                                <input type="text" class="form-control" name="days" value="<?php echo $dm->days; ?>" autocomplete="off" required="" >
                                                                                @if ($errors->has('days'))
                                                                                <strong class="text-danger">{{ $errors->first('days') }}</strong>                                   
                                                                                @endif
                                                                            </div>                      
                                                                        </div> 

                                                                         

                                                                        <div class="form-group col-sm-12">
                                                                            <label for="image">Choose PDF</label>
                                                                            <input type="hidden" class="form-control" name="old_milestone_pdf" value="<?php echo $dm->milestone_pdf; ?>"  autocomplete="off" >
                                                                            <input type="file" class="form-control" name="milestone_pdf" id="milestone_pdf">
                                                                            <?php echo $dm->milestone_pdf; ?>
                                                                            @if ($errors->has('milestone_pdf'))
                                                                            <strong class="text-danger">{{ $errors->first('milestone_pdf') }}</strong>                                  
                                                                            @endif
                                                                        </div>   
                                                                        
                                                                        
                                                                         <div class="col-sm-12">
                                                                            <div class="form-group bmd-form-group">
                                                                                <label class="bmd-label-floating">Enter Work Description</label>
                                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $dm->id; ?>" autocomplete="off" required="" >
                                                                                <!--<input type="text" class="form-control" name="description" value="< ?php echo $s->description; ?>" autocomplete="off" required="" >-->
                                                                                <textarea class="ckeditor" name="work" autocomplete="off" required=""><?php echo $dm->work; ?></textarea>
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

                                                <div class="modal" id="myRejectModal<?php echo $dm->id; ?>">
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
                                                                    <form method="post" action="{{route('developer_milestone_reject',['sow_value' => '0' ,'id' => $dm->id])}}">
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

                                                <div class="modal" id="myRejectReasonModal<?php echo $dm->id; ?>">
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
                                                                <p><?php echo $dm->milestone_reject; ?></p>
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
    </div>


@endsection