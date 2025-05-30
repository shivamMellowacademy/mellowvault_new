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
                <li class="breadcrumb-item"><a href="#">Short Message</a></li>
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
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Subject</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
	                        <tbody>
                               <?php $i=1;
                                foreach($short_message_details as $s) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                       <td><?php echo $s->subject; ?></td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myModal<?php echo $s->id; ?>" >More Details</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myeditModal<?php echo $s->id; ?>" ><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>

                                    <div class="modal" id="myModal<?php echo $s->id; ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Details</h4>
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                </div>
                                                <!-- Modal body -->
                                                 <div class="modal-body">
                                                    
                                                    <p>Description : <?php echo $s->description; ?></p>
                                                </div>                                               
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal" id="myeditModal<?php echo $s->id; ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Reply</h4>
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                </div>
                                                <!-- Modal body -->
                                                 <div class="modal-body">
                                                    <form method="post" action="{{route('developer_short_message_reply')}}">
                                                        @csrf
                                                        <div class="row">
                                                            <input type="hidden" class="form-control" name="client_id" value="<?php echo $s->u_id; ?>" autocomplete="off" required="" >
                                                            <input type="hidden" class="form-control" name="short_id" value="<?php echo $s->id; ?>" autocomplete="off" required="" >

                                                            <div class="col-sm-12">
                                                                <div class="form-group bmd-form-group">
                                                                    <label class="bmd-label-floating">Enter Subject</label>
                                                                    
                                                                    <input type="text" class="form-control" name="subject" autocomplete="off" required="" >
                                                                    @if ($errors->has('subject'))
                                                                    <strong class="text-danger">{{ $errors->first('subject') }}</strong>                                   
                                                                    @endif
                                                                </div>                      
                                                            </div>  
                                                                                                                    
                                                            <div class="col-sm-12">
                                                                <div class="form-group bmd-form-group">
                                                                    <label class="bmd-label-floating">Enter Description</label>
                                                                    <textarea class="ckeditor" name="description" autocomplete="off" required=""></textarea>
                                                                    @if ($errors->has('description'))
                                                                    <strong class="text-danger">{{ $errors->first('description') }}</strong>                                   
                                                                    @endif
                                                                </div>                      
                                                            </div>      
                                                            <div class="col-sm-4">
                                                                <div class="form-group bmd-form-group">
                                                                    <button type="submit" class="btn btn-success btn-block">Send</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>                                               
                                            </div>
                                        </div>
                                    </div>
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