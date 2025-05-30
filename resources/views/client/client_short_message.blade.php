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
                <li class="breadcrumb-item"><a href="#">Short Message Docs</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
        <nav aria-label="breadcrumb" style="float:right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item back"><a href="{{route('client_resource')}}" class="btn btn-primary">Back</a></li>
                
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
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Developer Send Details</th>
                                </tr>
                            </thead>
	                        <tbody>
                               <?php $i=1;
                                foreach($client_short_message_details as $s) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $s->subject; ?></td>
                                        <td><?php echo $s->description; ?></td>
                                        <td><a class="btn btn-success" href="<?php echo route('client_short_message_reply',['id'=>''.$s->id.'']) ?>"><i class="fa fa-show"></i>Details</a></td>
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