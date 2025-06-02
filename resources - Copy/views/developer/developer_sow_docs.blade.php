@extends('developer.layout')
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
                <li class="breadcrumb-item"><a href="#">SOW</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
        <nav aria-label="breadcrumb" style="float:right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item back"><a href="{{route('developer_resource')}}" class="btn btn-primary">Back</a></li>
                
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
                                        <th>Client Name</th>
                                        <!--<th>Client Phone</th>-->
                                        <!--<th>Client Email</th>-->
                                        <!--<th>Client Address</th>-->
                                        <th>Subject</th>
                                        <th>Description</th>
                                        <th>SOW Status</th>
                                        <th>Milestone Status</th>
                                        <th>Create Milestone</th>
                                        <th>Milestone Details</th>
                                    </tr>
                                </thead>
    	                        <tbody>
                                   <?php $i=1;
                                    foreach($sow_details as $s) {  
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $s->fname; ?> <?php echo $s->lname; ?></td>
                                            <!--<td>< ?php echo $s->phone; ?></td>-->
                                            <!--<td>< ?php echo $s->email; ?></td>-->
                                            <!--<td>< ?php echo $s->address; ?></td>-->
                                            <td><?php echo $s->subject; ?></td>
                                            <td>
                                                <a href="{{route('developer_sow_download', $s->id )}}" type="button" class="btn btn-danger"><i class="fa fa-download"></i>  Download</a>
                                            </td>
                                            <?php if($s->sow_status == 0){ ?>
                                                <td> <a href="{{route('sow_approve',['sow_value' => 1 ,'id' => $s->id])}}" class="btn btn-success">Accept</a> <a href="{{route('sow_approve',['sow_value' => 2 ,'id' => $s->id])}}" class="btn btn-danger" style="margin-top: 10px;">Reject</a></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            <?php }elseif( $s->sow_status == '1'){ ?>
                                                <td><p class="btn btn-success">Accepted</p></td>
                                                <td><p class="btn btn-warning">Ongoing</p></td>
                                                <td><a class="btn btn-success btn-sm" href="<?php echo route('developer_create_milestone',['u_id'=>''.$s->u_id.'','dev_id'=>''.$s->dev_id.'']) ?>">Create</a></td>

                                                <td><a class="btn btn-success btn-sm" href="<?php echo route('developer_milestone_details',['sow_id'=>''.$s->id.'']) ?>" >Show</a></td>
                                                <!-- <td><a class="btn btn-success btn-sm" href="<?php echo route('developer_milestone_project_details',['sow_id'=>''.$s->id.'']) ?>" ><i class="fa fa-eye"></i></a></td> -->
                                            <?php }elseif( $s->sow_status == '2'){ ?>
                                                <td><p class="btn btn-danger">Rejected</p></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            <?php } ?> 
                                        </tr>
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
</div>

@endsection