@extends('developer.layout')
@section('content')


<?php 
    foreach ($sow_details as $k) {
   
?>
<div class="page-content">
    <div class="main-wrapper container">   
        <div class="row">
            <div class="col-xl">
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
                
                <div class="page-info container">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Create</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Milestone</li>
                        </ol>
                    </nav>
                </div>
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Add Milestone Details</h5>
                        <form method="post" action="{{ route('developer_submit_milestone') }}" enctype="multipart/form-data">
	                        @csrf

                            <input type="hidden" class="form-control" name="sow_id" value="<?php echo $k->id ;?>" required="">

	                        <div class="form-row">
	                            <div class="form-group col-md-4">
	                            	<label for="heading">Milestone Name</label>
	                                <input type="text" class="form-control" name="milestone_name" id="milestone_name" placeholder="Enter Milestone Name" required="">
	                                @if ($errors->has('milestone_name'))
	                                <strong class="text-danger">{{ $errors->first('milestone_name') }}</strong>                                  
	                               	@endif
	                            </div>

                                <div class="form-group col-md-4">
                                    <label for="heading">Days</label>
                                    <input type="number" class="form-control" name="days" id="days" placeholder="Enter Days" required="">
                                    @if ($errors->has('days'))
                                    <strong class="text-danger">{{ $errors->first('days') }}</strong>                                  
                                    @endif
                                </div>

                                <!-- <div class="form-group col-md-6">
                                    <label for="heading">Payment Price</label>
                                    <input type="number" class="form-control" name="payment_price" id="payment_price" placeholder="Enter Payment Price" required="">
                                    @if ($errors->has('payment_price'))
                                    <strong class="text-danger">{{ $errors->first('payment_price') }}</strong>                                  
                                    @endif
                                </div> -->

                                <div class="form-group col-sm-4">
                                    <label for="image">Choose PDF</label>
                                    <input type="file" class="form-control" name="milestone_pdf" id="milestone_pdf" required="" >
                                    @if ($errors->has('milestone_pdf'))
                                    <strong class="text-danger">{{ $errors->first('milestone_pdf') }}</strong>                                  
                                    @endif
                                </div>
								
								<div class="form-group col-md-12">
	                                <label for="description">Work Description</label>
	                                <textarea type="text"  class="ckeditor" name="work" id="work" placeholder="Enter Work" required=""></textarea>
	                                @if ($errors->has('work'))
	                                <strong class="text-danger">{{ $errors->first('work') }}</strong>                                  
	                                @endif
	                            </div>

	                        </div>
	                        <button type="submit" class="btn btn-primary">Add Milestone</button>
                        </form>
                    </div>
                </div>
           	</div>
        </div>
   	</div>
</div>

<?php } ?>


@endsection