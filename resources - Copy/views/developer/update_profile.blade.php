@extends('developer.layout')
@section('content')
<!-- Toastr -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<div class="page-content" style="padding-top:30px;">
    <div class="main-wrapper container">
        <div class="row">
            <div class="col-xl">
                <div class="row">
                    <div class="col-lg-8 ml-auto mr-auto">
                        @if(Session::has('errmsg'))
                        <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
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
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0">Update Product</h5>
                            <a href="{{ route('developer_profile') }}"
                                class="btn btn-sm btn-secondary d-flex align-items-center">
                                <i class="material-icons me-1">arrow_back</i> Back
                            </a>
                        </div>
                        <?php
                         foreach($developer_details as $s) { ?>
                        <form id="updateDeveloperForm" method="post" action="{{route('developer_profile_update')}}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter First Name <span
                                                class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control required-field" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control" name="name"
                                            value="<?php echo $s->name; ?>" autocomplete="off"
                                            placeholder="Enter First Name">
                                        <span class="text-danger error-text name_error"></span>
                                        @if ($errors->has('name'))
                                        <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Last Name <span
                                                class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control" name="last_name"
                                            value="<?php echo $s->last_name; ?>" autocomplete="off"
                                            placeholder="Enter Last Name">
                                        <span class="text-danger error-text last_name_error"></span>
                                        @if ($errors->has('last_name'))
                                        <strong class="text-danger">{{ $errors->first('last_name') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Conatct No.<span
                                                class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control" placeholder="Enter Contact No."
                                            name="phone" value="<?php echo $s->phone; ?>" autocomplete="off">
                                        <span class="text-danger error-text phone_error"></span>
                                        @if ($errors->has('phone'))
                                        <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Total Jobs <span
                                                class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="job" class="form-control" placeholder="Enter Total Jobs" name="job"
                                            value="<?php echo $s->job; ?>" autocomplete="off">
                                        <span class="text-danger error-text job_error"></span>
                                        @if ($errors->has('job'))
                                        <strong class="text-danger">{{ $errors->first('job') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Monthly Payout <span
                                                class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="perhr" class="form-control" name="perhr"
                                            value="<?php echo $s->perhr; ?>" autocomplete="off"
                                            placeholder="Enter Monthly Payout">
                                        <span class="text-danger error-text perhr_error"></span>
                                        @if ($errors->has('perhr'))
                                        <strong class="text-danger">{{ $errors->first('perhr') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Email <span
                                                class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="email" class="form-control" name="email"
                                            value="<?php echo $s->email; ?>" autocomplete="off"
                                            placeholder="Enter Email">
                                        <span class="text-danger error-text email_error"></span>
                                        @if ($errors->has('email'))
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Total Hours <span
                                                class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control" name="total_hours"
                                            value="<?php echo $s->total_hours; ?>" autocomplete="off"
                                            placeholder="Enter Total Hours">
                                        <span class="text-danger error-text total_hours_error"></span>
                                        @if ($errors->has('total_hours'))
                                        <strong class="text-danger">{{ $errors->first('total_hours') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Rating your self (Outof 5)<span
                                                class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control" name="rating"
                                            value="<?php echo $s->rating; ?>" autocomplete="off"
                                            placeholder="Enter Rating your self (Outof 5)">
                                        <span class="text-danger error-text rating_error"></span>
                                        @if ($errors->has('rating'))
                                        <strong class="text-danger">{{ $errors->first('rating') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Address <span
                                                class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control" name="address"
                                            value="<?php echo $s->address; ?>" autocomplete="off"
                                            placeholder="Enter Address">
                                        <span class="text-danger error-text address_error"></span>
                                        @if ($errors->has('address'))
                                        <strong class="text-danger">{{ $errors->first('address') }}</strong>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Language <span
                                                class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control" name="language"
                                            value="<?php echo $s->language; ?>" autocomplete="off"
                                            placeholder="Enter Language">
                                        <span class="text-danger error-text language_error"></span>
                                        @if ($errors->has('language'))
                                        <strong class="text-danger">{{ $errors->first('language') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="language">Add Education Details(Click on below button)👇</label>

                                    <a href="<?php echo route('profile_education_update_Details',['dev_id'=>''.$s->dev_id.'']) ?>"
                                        class="btn btn-success form-control">Update</a>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Choose Portfolio Image</label>
                                        <input type="file" class="form-control" name="portfolio_image" accept="image/*"
                                            autocomplete="off">
                                        <input type="hidden" class="form-control" name="old_portfolio_image"
                                            value="<?php echo $s->portfolio_image; ?>" autocomplete="off">
                                        @if($s->portfolio_image)
                                            <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/portfolio/'.$s->portfolio_image.'') ?>" style="height:30px;width:40px;">
                                        @else
                                            <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/profile_image/1640871620.png') ?>" style="height:30px;width:40px;">
                                        @endif
                                        
                                        @if ($errors->has('portfolio_image'))
                                        <strong class="text-danger">{{ $errors->first('portfolio_image') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Choose Resume</label>
                                        <input type="file" class="form-control" name="resume" autocomplete="off">
                                        <input type="hidden" class="form-control" name="old_resume" autocomplete="off">
                                        
                                        @if($s->resume)
                                              <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/resume/'.$s->resume.'') ?>" style="height:30px;width:40px;">
                                        @endif
                                        @if ($errors->has('resume'))
                                        <strong class="text-danger">{{ $errors->first('resume') }}</strong>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-sm-12">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Description</label>
                                        <input type="hidden" class="form-control" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <textarea id="content" class="form-control"
                                            name="description"><?php echo $s->description; ?></textarea>
                                        @if ($errors->has('description'))
                                        <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter skills</label>
                                        <input type="hidden" class="form-control" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <textarea id="Additions" class="form-control"
                                            name="skills"><?php echo $s->skills; ?></textarea>
                                        @if ($errors->has('skills'))
                                        <strong class="text-danger">{{ $errors->first('skills') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Completed Job</label>
                                        <input type="hidden" class="form-control" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <textarea id="Overview" class="form-control"
                                            name="completed_job"><?php echo $s->completed_job; ?></textarea>
                                        @if ($errors->has('completed_job'))
                                        <strong class="text-danger">{{ $errors->first('completed_job') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group" id="loader-button">
                                        <button type="submit" class="btn btn-success btn-block">Update</button>
                                    </div>
                                    <div id="loader" style="display: none; text-align:center; margin-top:20px;">
                                        <img src="{{ asset('public/upload/1746529029853.gif') }}" alt="Loading..." style="height: 40px;">
                                    </div>
                                </div>
                            </div>

                           
                        </form>

                        <?php
                    } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "5000"
};
</script>
<script>
$(document).ready(function() {
    $('#updateDeveloperForm').on('submit', function(e) {
        e.preventDefault();

        var form = $(this)[0];
        var formData = new FormData(form);

        $('.error-text').text(''); // clear old errors
        $('#loader').show(); // Show loader
        $('#loader-button').hide(); // hide loader

        $.ajax({
            url: "{{ route('developer_profile_update') }}",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#loader').hide(); // Hide loader
                $('#loader-button').show(); // show loader
                if (response.status === 200) {
                    toastr.success(response.message);
                }
            },
            error: function(xhr) {
                $('#loader').hide(); // Hide loader
                $('#loader-button').show(); // show loader  
                if (xhr.status === 422) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $('.' + key + '_error').text(value[0]);
                    });
                }
            }
        });
    });
});
</script>
@endsection