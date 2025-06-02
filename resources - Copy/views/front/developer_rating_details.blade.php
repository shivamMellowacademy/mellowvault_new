@extends('front.layout')
@section('content')

<section class="icons-category">
   <?php 
        if( $developer_rating_total > 0 ){
   ?>
            <header>
                <div class="container">
                    <h5 class="title">Developer Rating Details</h5>
                </div>
            </header>
            
            <br>
            
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="row">

                            <?php
                                foreach ($dev_rating_details as $k) {
                            ?>
                                <div class="col-6 col-md-4">
                                    <a href="#">
                                        <figure>
                                            <div>
                                              Project Name: <?php echo $k->subject; ?></div>
                                             
                                            <figcaption><a href="javascript:void();" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myRatingModal<?php echo $k->sow_id; ?>"><i class="fa fa-eye"></i></a></figcaption>
                                            <div>
                                              Project Status :<b style="color:#77c24b;">  </b>
                                            </div>
                                        </figure>
                                    </a>
                                </div>                               
                             

                                <div class="modal" id="myRatingModal<?php echo $k->sow_id; ?>">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Rating Deatils</h4>
                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <?php 
                                                foreach ($developer_rating as $dr) {
                                                    if($dr->sow_id == $k->sow_id)
                                              
                                            ?>
                                                <?php foreach ($developer_milestone as $dm) {
                                                    if($dm->id == $dr->milestone_id){

                                                       
                                                ?>
                                                    <div class="modal-body">
                                                        <p style=" text-decoration: underline;"><?php  echo $dm->milestone_name; ?> : </p>
                                                    </div>
                                                <?php } }?>
                                                

                                                    <div class="modal-body">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            Logical Stability : <?php echo $dr->logical_stability; ?> Out Of 5
                                                          </div>
                                                        </div>  
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            Code Quality : <?php echo $dr->code_quality; ?> Out Of 5
                                                          </div>
                                                        </div>  
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            Understanding : <?php echo $dr->understanding; ?> Out Of 5
                                                          </div>
                                                        </div>  
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            Communication : <?php echo $dr->communication; ?> Out Of 5
                                                          </div>
                                                        </div>  
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            Behaviour : <?php echo $dr->behaviour; ?> Out Of 5
                                                          </div>
                                                        </div>  
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            Work Performance : <?php echo $dr->work_performance; ?> Out Of 5
                                                          </div>
                                                        </div>  
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="card">
                                                          <div class="card-body">
                                                            Delivary Review : <?php echo $dr->delivary_review; ?> Out Of 5
                                                          </div>
                                                        </div>  
                                                    </div> 

                                            <?php }  ?> 
                                        </div>
                                    </div>
                                </div>
                                  <?php } ?>     
                        </div>
                </div>
            </div>
    <?php }else{ ?>
             <div class="container">            
            <div class="cart-wrapper">
                <div class="row">
                   
                    <div class="col-md-12">
                       <center> <h5><img src="{{ URL::asset('public/front/assets/images/2.png') }}" class="rounded-circle" width="310px" height="250px"></h5>
                        <h4 class="card-title">There are no rating details here!</h4>
                        <!--<small class="card-title">Start adding personal details</small>-->
                        <hr style="width:550px;">
                        <a class="btn btn-primary btn-lg" href="{{ route('higher_professional') }}" role="button">Continue    <i class="fa fa-arrow-right"></i></a> 
                        </center> 
                    </div>
                </div> 
            </div>
        </div> 
    <?php } ?>
    
</section>
 @endsection