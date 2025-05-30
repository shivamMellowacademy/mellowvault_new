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
                        <h5 class="card-title">Update Developer Details</h5>
                        <?php
                        foreach($developer_details as $s) { ?>
                        <form method="post" action="{{route('update_developer_details')}}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="category">Choose Category:</label>
                                    <select name="pro_id" id="pro_id" class="form-control rounded-0">
                                        <option value="">Select</option>
                                        @foreach($higher_professional as $c)
                                        <option value="{{ $c->id }}"
                                            {{ old('pro_id', $s->pro_id) == $c->id ? 'selected' : '' }}>
                                            {{ $c->heading }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('pro_id'))
                                    <strong class="text-danger">{{ $errors->first('pro_id') }}</strong>
                                    @endif
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter First Name</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control rounded-0" name="name"
                                            value="<?php echo $s->name; ?>" autocomplete="off" required="">
                                        @if ($errors->has('name'))
                                        <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Last Name</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control rounded-0" name="last_name"
                                            value="<?php echo $s->last_name; ?>" autocomplete="off" required="">
                                        @if ($errors->has('last_name'))
                                        <strong class="text-danger">{{ $errors->first('last_name') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Conatct</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control rounded-0" name="phone"
                                            value="<?php echo $s->phone; ?>" autocomplete="off" required="">
                                        @if ($errors->has('phone'))
                                        <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Total Jobs</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="job" class="form-control rounded-0" name="job" value="<?php echo $s->job; ?>"
                                            autocomplete="off" required="">
                                        @if ($errors->has('job'))
                                        <strong class="text-danger">{{ $errors->first('job') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Per Hr</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="perhr" class="form-control rounded-0" name="perhr"
                                            value="<?php echo $s->perhr; ?>" autocomplete="off" required="">
                                        @if ($errors->has('perhr'))
                                        <strong class="text-danger">{{ $errors->first('perhr') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Email</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="email" class="form-control rounded-0" name="email"
                                            value="<?php echo $s->email; ?>" autocomplete="off" required="">
                                        @if ($errors->has('email'))
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Total Hours</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control rounded-0" name="total_hours"
                                            value="<?php echo $s->total_hours; ?>" autocomplete="off" required="">
                                        @if ($errors->has('total_hours'))
                                        <strong class="text-danger">{{ $errors->first('total_hours') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Rating</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control rounded-0" name="rating"
                                            value="<?php echo $s->rating; ?>" autocomplete="off" required="">
                                        @if ($errors->has('rating'))
                                        <strong class="text-danger">{{ $errors->first('rating') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Address</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control rounded-0" name="address"
                                            value="<?php echo $s->address; ?>" autocomplete="off" required="">
                                        @if ($errors->has('address'))
                                        <strong class="text-danger">{{ $errors->first('address') }}</strong>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Language</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control rounded-0" name="language"
                                            value="<?php echo $s->language; ?>" autocomplete="off" required="">
                                        @if ($errors->has('language'))
                                        <strong class="text-danger">{{ $errors->first('language') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="language">Education Details</label>

                                    <a href="<?php echo route('education_updates_details',['dev_id'=>''.$s->dev_id.'']) ?>"
                                        class="btn btn-success form-control rounded-0">Update</a>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Choose Image</label>
                                        <input type="file" class="form-control rounded-0" name="image" accept="image/*"
                                            autocomplete="off">
                                        <input type="hidden" class="form-control rounded-0" name="old_image"
                                            value="<?php echo $s->image; ?>" autocomplete="off">
                                        <img class="img-fluid img-thumbnail"
                                            src="<?php echo URL::asset('public/upload/developer/'.$s->image.'') ?>"
                                            style="height:30px;width:40px;">
                                        @if ($errors->has('image'))
                                        <strong class="text-danger">{{ $errors->first('image') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Choose Portfolio Image</label>
                                        <input type="file" class="form-control rounded-0" name="portfolio_image" accept="image/*"
                                            autocomplete="off">
                                        <input type="hidden" class="form-control rounded-0" name="old_portfolio_image"
                                            value="<?php echo $s->portfolio_image; ?>" autocomplete="off">
                                        <img class="img-fluid img-thumbnail"
                                            src="<?php echo URL::asset('public/upload/portfolio/'.$s->portfolio_image.'') ?>"
                                            style="height:30px;width:40px;">
                                        @if ($errors->has('portfolio_image'))
                                        <strong class="text-danger">{{ $errors->first('portfolio_image') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Choose Resume</label>
                                        <input type="file" class="form-control rounded-0" name="resume" autocomplete="off">
                                        <input type="hidden" class="form-control rounded-0" name="old_resume"
                                            value="<?php echo $s->resume; ?>" autocomplete="off">
                                        <?php echo $s->resume; ?>
                                        @if ($errors->has('resume'))
                                        <strong class="text-danger">{{ $errors->first('resume') }}</strong>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-sm-12">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Description</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <textarea id="content" class="form-control rounded-0"
                                            name="description"><?php echo $s->description; ?></textarea>
                                        @if ($errors->has('description'))
                                        <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter skills</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <textarea id="Additions" class="form-control rounded-0"
                                            name="skills"><?php echo $s->skills; ?></textarea>
                                        @if ($errors->has('skills'))
                                        <strong class="text-danger">{{ $errors->first('skills') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Completed Job</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $s->dev_id; ?>" autocomplete="off" required="">
                                        <textarea id="Overview" class="form-control rounded-0"
                                            name="completed_job"><?php echo $s->completed_job; ?></textarea>
                                        @if ($errors->has('completed_job'))
                                        <strong class="text-danger">{{ $errors->first('completed_job') }}</strong>
                                        @endif
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
    var i = 1;
    $('.add').on('click', function() {
        var task = $("#task").val();
        i++;
        $('#dynamic_field').append('<tr id="row' + i +
            '" class="dynamic-added"><td><input type="text" class="form-control rounded-0" name="education[]" id="task" required="" ></td><td><input type="text" class="form-control rounded-0" name="clg_name[]" id="task" required="" ></td><td><input type="text" class="form-control rounded-0" name="degree[]" id="task" required="" ></td><td><input type="text" class="form-control rounded-0" name="percentage[]" id="task" required="" ></td><td><input type="text" class="form-control rounded-0" name="passing_year[]" id="task" required="" ></td><td><button type="button" name="remove" id="' +
            i + '" class="btn btn-danger btn_remove">X</button></td></tr>');

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

    });
});
</script>

@endsection