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
                <li class="breadcrumb-item"><a href="">Client</a></li>
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
                                    <th>Client Name</th>
                                    <!--<th>Client Phone</th>-->
                                    <!--<th>Client Email</th>-->
                                    <th>Require Docs</th>
                                    <th>Short Message</th>
                                    <th>SOW</th>
                                </tr>
                            </thead>
	                        <tbody>
                               <?php $i=1;
                                foreach($resource_details as $s) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $s->fname; ?> <?php echo $s->lname; ?></td>
                                        <!--<td>< ?php echo $s->phone; ?></td>-->
                                        <!--<td>< ?php echo $s->email; ?></td>-->
                                        <td><a class="btn btn-success" href="<?php echo route('developer_require_docs',['dev_id'=>''.$s->dev_id.'','u_id'=>''.$s->u_id.'']) ?>"><i class="fa fa-show"></i>Details</a></td>
                                        <td><a class="btn btn-success" href="<?php echo route('developer_short_message',['dev_id'=>''.$s->dev_id.'','u_id'=>''.$s->u_id.'']) ?>"><i class="fa fa-show"></i>View</a></td>
                                        <td><a class="btn btn-success" href="<?php echo route('developer_sow_docs',['dev_id'=>''.$s->dev_id.'','u_id'=>''.$s->u_id.'']) ?>"><i class="fa fa-show"></i>Details</a></td>
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

@endsection