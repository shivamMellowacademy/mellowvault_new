@extends('admin.layout')
@section('content')




<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Requested Developer Details</a></li>
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
                                    <th>Email</th>
                                    <th>Description</th>
                                    <th>Conatct Number</th>
                                    <th>Job</th>
                                    <th>Per Hr</th>
                                    <th>Total Hours</th>
                                    <th>Rating</th>
                                    <th>Address</th>
                                    <th>Language</th>
                                    <th>Education</th>
                                    <th>Skills</th>
                                    <th>Resume</th>
                                    <th>Completed Job</th>
                                    <th>National Id</th>
                                    <th>National Image</th>
                                    <th>Image</th>
                                    <th>Portfolio</th>
                                    <th>Signature</th>
                                   
                                </tr>
                            </thead>
	                        <tbody>
                               <?php
                                foreach($developer_profile_details as $s) { ?>
                                    <tr>
                                        
                                        <td><?php echo $s->email; ?></td>
                                        <td><?php echo $s->description; ?></td>
                                        <td><?php echo $s->phone; ?></td>
                                        <td><?php echo $s->job; ?></td>                                                                     
                                        <td><?php echo $s->perhr; ?></td>
                                        <td><?php echo $s->total_hours; ?></td>
                                        <td><?php echo $s->rating; ?></td>
                                        <td><?php echo $s->address; ?></td>
                                        <td><?php echo $s->language; ?></td>
                                        <td><?php echo $s->education; ?></td>
                                        <td><?php echo $s->skills; ?></td>
                                        <td><?php echo $s->resume; ?></td>
                                        <td><?php echo $s->completed_job; ?></td>
                                        <td><?php echo $s->national_id_name; ?></td>
                                        <td><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/national_image/'.$s->national_id_image.'') ?>" style="height:80px"></td>
                                        <td><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/developer/'.$s->image.'') ?>" style="height:80px"></td>
                                        <td><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/portfolio/'.$s->portfolio_image.'') ?>" style="height:80px"></td>
                                        <td><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/signature/'.$s->signature.'') ?>" style="height:80px"></td>
                                        
                                    </tr>

                                   
                                   
                                    <?php
                                    } ?>
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