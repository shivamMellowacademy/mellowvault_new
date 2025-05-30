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
                <li class="breadcrumb-item"><a href="#">Ongoing Resource Details</a></li>
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
                                        <th>Developer Name</th>
                                        <!--<th>Developer Phone</th>-->
                                        <!--<th>Developer Email</th>-->
                                        <th>Status</th>
                                        <th>Require Docs</th>
                                        <th>Short Message</th>
                                        <th>SOW</th>
                                    </tr>
                                </thead>
    	                        <tbody>
                                   <?php $i=1;
                                    foreach($client_ongoing_resource_details as $s) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $s->name; ?> <?php echo $s->last_name; ?></td>
                                            <!--<td>< ?php echo $s->phone; ?></td>-->
                                            <!--<td>< ?php echo $s->email; ?></td>-->
                                            <td><b style="color:#072d72; font-weight: 700; border-color: #3c5570; background-color: #f9f6f6; border: 2px solid transparent; padding: 0.375rem 2.75rem; border-radius: 11px;">ONGOING</b></td>
                                            <td><a class="btn btn-success" href="<?php echo route('client_require_docs',['id'=>''.$s->devs_id.'','u_id'=>''.$s->u_id.'']) ?>"><i class="fa fa-show"></i>Docs</a></td>
                                            <td><a class="btn btn-success" href="<?php echo route('client_short_message',['id'=>''.$s->devs_id.'','u_id'=>''.$s->u_id.'']) ?>"><i class="fa fa-show"></i>View</a></td>
                                            <td><a class="btn btn-success" href="<?php echo route('client_sow',['id'=>''.$s->devs_id.'','u_id'=>''.$s->u_id.'']) ?>"><i class="fa fa-show"></i>Details</a></td>
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