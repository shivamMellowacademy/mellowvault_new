@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:30px;">
    <div class="main-wrapper container">   
        <div class="row">
            <div class="col-xl">
                <div class="row">
                    <div class="col-lg-8 ml-auto mr-auto">
	                    @if(Session::has('commissionerrmsg'))                 
	                        <div class="alert alert-{{Session::get('message')}} alert-dismissible">
	                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
	                    	       <strong>{{Session::get('commissionerrmsg')}}</strong>
	                        </div>
	                        {{Session::forget('message')}}
	                        {{Session::forget('commissionerrmsg')}}
	                    @endif
	                    <br><br>
	                </div>
                </div>
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Add Commission</h5>
                        <form method="post" action="{{route('submit_commission')}}" enctype="multipart/form-data">
	                        @csrf
	                        <div class="form-row">
	                        
                                <div class="form-group col-sm-6">
                                    <label>Choose Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Choose Category</option>
                                        <?php $i=1;
                                            foreach($higher_professional_details as $h) { ?>
                                                <option value="<?php echo $h->id; ?>"><?php echo $h->heading; ?></option>
                                        <?php $i++;
                                        } ?>
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <strong class="text-danger">{{ $errors->first('category_id') }}</strong>                                  
                                    @endif
                                </div>	

                                <div class="form-group col-md-6">
                                    <label for="title">Add Commission</label>
                                    <input type="text" class="form-control" name="commission" id="commission" placeholder="Enter Commission" required="">
                                    @if ($errors->has('commission'))
                                        <strong class="text-danger">{{ $errors->first('commission') }}</strong>                                  
                                    @endif
                                </div>				

	                        </div>
	                        <button type="submit" class="btn btn-primary">Add Commission</button>
                        </form>
                    </div>
                </div>
           	</div>
        </div>
   	</div>
</div>

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Commission</a></li>
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
                                    <th>Category Name</th>
                                    <th>Commission</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;
                                foreach($commission_details as $c) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <?php 
                                        foreach ($higher_professional_details as $k) {

                                            if($k->id == $c->category_id){
                                       
                                    ?>
                                    <td><?php echo $k->heading; ?></td>

                                    <?php } } ?>

                                    <td><?php echo $c->commission; ?>%</td>
                                    
                                    <td>
                                        <a class="btn btn-success btn-sm" href="javascript:void();" data-toggle="modal" data-target="#myeditModal<?php echo $c->id; ?>" ><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-danger btn-sm" onclick="alert('Are You Sure To Delete This??')" href="<?php echo route('delete_commission',['id'=>''.$c->id.'']) ?>" ><i class="fa fa-trash"></i></a>
                                    </td>                                           
                                </tr> 


                                <div class="modal" id="myeditModal<?php echo $c->id; ?>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Commission Details</h4>
                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <form method="post" action="{{route('update_commission')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">                                                     

                                                        <div class="col-sm-6">
                                                            <div class="form-group bmd-form-group">
                                                                <label>Choose Category</label>
                                                                    <select name="category_id" id="category_id" class="form-control">
                                                                        <option value="#">Choose Category</option>
                                                                        <?php $j=1;
                                                                            foreach($higher_professional_details as $cat) { ?>
                                                                                <option value="<?php echo $cat->id; ?>"><?php echo $cat->heading; ?></option>
                                                                        <?php $j++;
                                                                        } ?>
                                                                    </select>
                                                                @if ($errors->has('category_id'))
                                                                <strong class="text-danger">{{ $errors->first('category_id') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div>  

                                                        <div class="col-sm-6">
                                                            <div class="form-group bmd-form-group">
                                                                <label class="bmd-label-floating">Enter Commission</label>
                                                                <input type="hidden" class="form-control" name="update" value="<?php echo $c->id; ?>" autocomplete="off" required="" >
                                                                <input type="text" class="form-control" name="commission" value="<?php echo $c->commission; ?>" autocomplete="off" required="" >
                                                                @if ($errors->has('commission'))
                                                                <strong class="text-danger">{{ $errors->first('commission') }}</strong>                                   
                                                                @endif
                                                            </div>                      
                                                        </div> 
                                                        
                                                        <div class="col-sm-4">
                                                            <div class="form-group bmd-form-group">
                                                                <button type="submit" class="btn btn-success btn-block">Update Commission</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
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

@endsection