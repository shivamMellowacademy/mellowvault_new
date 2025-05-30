@extends('admin.layout')
@section('content')

<div class="page-content" style="">
    <div class="main-wrapper container">   
        <div class="row">
            <div class="col-xl">
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
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Update Developer Education Details</h5>
                    <?php 
                        foreach ($develoeper_education_details as $k) {
                       
                    ?>
                       <form method="post" action="{{ route('education_updates') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="form-group col-sm-12">
                                    <label for="language">Education Details</label>

                                    <input type="hidden" class="form-control" name="dev_id" value="<?php echo $k->dev_id; ?>" autocomplete="off">
                                    <div class="table-responsive">  
                                        <table class="table table-bordered" id="dynamic_field">
                                            <tr>
                                                <th>University</th>
                                                <th>Collage Name</th>
                                                <th>Degree</th>
                                                <th>Percentage</th>
                                                <th>Passing Year</th>
                                                <th>Option</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control" name="education[]" id="task" required="" >

                                                    @if ($errors->has('education'))
                                                    <strong class="text-danger">{{ $errors->first('education') }}</strong>                                  
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="clg_name[]" id="task" required="" >

                                                    @if ($errors->has('clg_name'))
                                                    <strong class="text-danger">{{ $errors->first('clg_name') }}</strong>                                  
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="degree[]" id="task" required="" >

                                                    @if ($errors->has('degree'))
                                                    <strong class="text-danger">{{ $errors->first('degree') }}</strong>                                  
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="percentage[]" id="task" required="" >

                                                    @if ($errors->has('percentage'))
                                                    <strong class="text-danger">{{ $errors->first('percentage') }}</strong>                                  
                                                    @endif                                                        
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="passing_year[]" id="task" required="" >

                                                    @if ($errors->has('passing_year'))
                                                    <strong class="text-danger">{{ $errors->first('passing_year') }}</strong>                                  
                                                    @endif   
                                                </td>
                                                <td><button type="button" class="btn btn-primary add">Add More</button></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            
                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <button type="submit" class="btn btn-success btn-block">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                    </div>
                </div>
           	</div>
        </div>
   	</div>
</div>

<script>
    $(document).ready(function() {
        var i=1;
        $('.add').on('click', function() {
            var task = $("#task").val();
            i++;  
            $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" class="form-control" name="education[]" id="task" required="" ></td><td><input type="text" class="form-control" name="clg_name[]" id="task" required="" ></td><td><input type="text" class="form-control" name="degree[]" id="task" required="" ></td><td><input type="text" class="form-control" name="percentage[]" id="task" required="" ></td><td><input type="text" class="form-control" name="passing_year[]" id="task" required="" ></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
            
            $(document).on('click', '.btn_remove', function(){  
                   var button_id = $(this).attr("id");   
                   $('#row'+button_id+'').remove();  
              });
            
        });
    });
</script>

@endsection