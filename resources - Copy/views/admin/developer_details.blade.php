@extends('admin.layout')
@section('content')

<div class="page-content" style="">
    <div class="main-wrapper container">
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> Add Developer Details</h5>
                        <form method="post" action="{{ route('submit_developer_details') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">

                                {{-- Higher Professional --}}
                                <div class="form-group col-md-4">
                                    <label for="pro_id">Choose Higher Professional <span
                                            class="text-danger">*</span></label>
                                    <select name="pro_id" id="pro_id" class="form-control rounded-0" required>
                                        <option value="">Select</option>
                                        @foreach($higher_professional as $c)
                                        <option value="{{ $c->id }}"   {{ old('pro_id') == $c->id ? 'selected' : '' }}>{{ $c->heading }}</option>
                                        @endforeach
                                    </select>
                                    @error('pro_id') <strong class="text-danger">{{ $message }}</strong> @enderror
                                </div>

                                {{-- First Name --}}
                                <div class="form-group col-md-4">
                                    <label for="name">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-0" value="{{ old('name') }}" name="name" id="name"
                                        placeholder="Enter First Name" required>
                                    @error('name') <strong class="text-danger">{{ $message }}</strong> @enderror
                                </div>

                                {{-- Last Name --}}
                                <div class="form-group col-md-4">
                                    <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-0" name="last_name" value="{{ old('last_name') }}" id="last_name"
                                        placeholder="Enter Last Name" required>
                                    @error('last_name') <strong class="text-danger">{{ $message }}</strong> @enderror
                                </div>

                                {{-- Profile Image --}}
                                <div class="form-group col-md-4">
                                    <label for="image">Profile Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control rounded-0" name="image" id="image"
                                        accept="image/*" required>
                                    @error('image') <strong class="text-danger">{{ $message }}</strong> @enderror
                                </div>

                                {{-- Portfolio Image --}}
                                <div class="form-group col-md-4">
                                    <label for="portfolio_image">Portfolio Image <span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control rounded-0" name="portfolio_image"
                                        id="portfolio_image" accept="image/*" required>
                                    @error('portfolio_image') <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                {{-- Resume --}}
                                <div class="form-group col-md-4">
                                    <label for="resume">Upload Resume <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control rounded-0" name="resume" id="resume"
                                        required>
                                    @error('resume') <strong class="text-danger">{{ $message }}</strong> @enderror
                                </div>

                                {{-- Phone --}}
                                <div class="form-group col-md-6">
                                    <label for="phone">Contact No. <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control rounded-0" name="phone" id="phone"
                                        maxlength="10" placeholder="Enter Phone Number" value="{{ old('phone') }}" required>
                                    @error('phone') <strong class="text-danger">{{ $message }}</strong> @enderror
                                </div>

                                {{-- Total Jobs --}}
                                <div class="form-group col-md-6">
                                    <label for="job">Total Jobs <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-0" value="{{ old('job') }}" name="job" id="job"
                                        placeholder="Enter Total Jobs" required>
                                    @error('job') <strong class="text-danger">{{ $message }}</strong> @enderror
                                </div>

                                {{-- Email --}}
                                <div class="form-group col-md-6">
                                    <label for="email">Email Id <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control rounded-0" value="{{ old('email') }}" name="email" id="email"
                                        placeholder="Enter Email Address" required>
                                    @error('email') <strong class="text-danger">{{ $message }}</strong> @enderror
                                </div>

                                {{-- Password --}}
                                <div class="form-group col-md-6">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control rounded-0" name="password" id="password"
                                        placeholder="Enter Password" required>
                                    @error('password') <strong class="text-danger">{{ $message }}</strong> @enderror
                                </div>

                                {{-- Total Hours --}}
                                <div class="form-group col-md-4">
                                    <label for="total_hours">Total Hours <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-0" value="{{ old('total_hours') }}" name="total_hours"
                                        id="total_hours" placeholder="Enter Total Working Hours" required>
                                    @error('total_hours') <strong class="text-danger">{{ $message }}</strong> @enderror
                                </div>

                                {{-- Per Hour Rate --}}
                                <div class="form-group col-md-4">
                                    <label for="perhr">Per Months Rate <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-0" name="perhr" value="{{ old('perhr') }}" id="perhr"
                                        placeholder="Enter Per Hour Rate" value="{{ old('name') }}" required>
                                    @error('perhr') <strong class="text-danger">{{ $message }}</strong> @enderror
                                </div>

                                {{-- Rating --}}
                                <div class="form-group col-md-4">
                                    <label for="rating">Rating <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-0" name="rating" id="rating"
                                        placeholder="Enter Rating" value="{{ old('rating') }}" required>
                                    @error('rating') <strong class="text-danger">{{ $message }}</strong> @enderror
                                </div>

                                {{-- Address --}}
                                <div class="form-group col-md-6">
                                    <label for="address">Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-0" name="address" id="address"
                                        placeholder="Enter Address" value="{{ old('address') }}" required>
                                    @error('address') <strong class="text-danger">{{ $message }}</strong> @enderror
                                </div>

                                {{-- Language --}}
                                <div class="form-group col-md-6">
                                    <label for="language">Language <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-0" name="language" id="language"
                                        placeholder="e.g. English, Hindi" value="{{ old('language') }}" required>
                                    @error('language') <strong class="text-danger">{{ $message }}</strong> @enderror
                                </div>

                                {{-- Education Details --}}
                                <div class="form-group col-md-12">
                                    <label>Education Details <span class="text-danger">*</span></label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dynamic_field">
                                            <thead>
                                                <tr>
                                                    <th>University</th>
                                                    <th>College Name</th>
                                                    <th>Degree</th>
                                                    <th>Percentage</th>
                                                    <th>Passing Year</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" class="form-control rounded-0"
                                                            name="education[]" placeholder="University" required></td>
                                                    <td><input type="text" class="form-control rounded-0"
                                                            name="clg_name[]" placeholder="College Name" required></td>
                                                    <td><input type="text" class="form-control rounded-0"
                                                            name="degree[]" placeholder="Degree" required></td>
                                                    <td><input type="text" class="form-control rounded-0"
                                                            name="percentage[]" placeholder="%" required></td>
                                                    <td><input type="text" class="form-control rounded-0"
                                                            name="passing_year[]" placeholder="YYYY" required></td>
                                                    <td><button type="button" class="btn btn-primary add">+</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="description">Description</label>
                                    <textarea id="content" class="form-control rounded-0"
                                        placeholder="Describe yourself or experience..." name="description"
                                        placeholder="Description" rows="5"></textarea>
                                    @if ($errors->has('description'))
                                    <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                    @endif
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="skills">Skills</label>
                                    <textarea id="Additions" class="form-control rounded-0"
                                        placeholder="List your skills..." name="skills" placeholder="skills"
                                        rows="5"></textarea>
                                    @if ($errors->has('skills'))
                                    <strong class="text-danger">{{ $errors->first('skills') }}</strong>
                                    @endif
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="completed_job">Completed Job</label>
                                    <textarea id="Overview" placeholder="Mention completed job summaries..."
                                        class="form-control rounded-0" name="completed_job" placeholder="completed_job"
                                        rows="5"></textarea>
                                    @if ($errors->has('completed_job'))
                                    <strong class="text-danger">{{ $errors->first('completed_job') }}</strong>
                                    @endif
                                </div>

                            </div>
                            {{-- Submit --}}
                            <div class="form-group col-md-12 text-center">
                                <button type="submit" class="btn btn-primary px-4">Add Details</button>
                            </div>
                        </form>
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
            '" class="dynamic-added"><td><input type="text" class="form-control rounded-0" name="education[]" placeholder="University" id="task" required="" ></td><td><input type="text" class="form-control rounded-0" name="clg_name[]" placeholder="College Name" id="task" required="" ></td><td><input type="text" class="form-control rounded-0" placeholder="Degree" name="degree[]" id="task" required="" ></td><td><input type="text" class="form-control rounded-0" name="percentage[]" placeholder="%" id="task" required="" ></td><td><input type="text" class="form-control rounded-0" placeholder="YYYY" name="passing_year[]" id="task" required="" ></td><td><button type="button" name="remove" id="' +
            i + '" class="btn btn-danger btn_remove">X</button></td></tr>');

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

    });
});
</script>



@endsection