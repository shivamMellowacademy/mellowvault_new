@extends('developer.layout')
@section('content')

<div class="page-content">
    <div class="main-wrapper container">   
        <div class="row">
            <div class="col-xl">
                <div class="row">
                    <div class="col-lg-8 ml-auto mr-auto">
                        @if(Session::has('errmsg'))                 
                            <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>  
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
                        <h5 class="card-title">Update Education Details</h5>

                        @foreach($developer_education_details as $k)
                        <form method="POST" action="{{ route('education_profile_update') }}" enctype="multipart/form-data" id="educationForm">
                            @csrf
                            <input type="hidden" name="dev_id" value="{{ $k->dev_id }}">

                            @php
                                $educations = explode(',', $k->education ?? '');
                                $colleges = explode(',', $k->clg_name ?? '');
                                $degrees = explode(',', $k->degree ?? '');
                                $percentages = explode(',', $k->percentage ?? '');
                                $passing_years = explode(',', $k->passing_year ?? '');
                                $total = max(count($educations), count($colleges), count($degrees), count($percentages), count($passing_years));
                            @endphp

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dynamic_field">
                                    <tr>
                                        <th>University <span class="text-danger">*</span></th>
                                        <th>College Name <span class="text-danger">*</span></th>
                                        <th>Degree <span class="text-danger">*</span></th>
                                        <th>Percentage(%) <span class="text-danger">*</span></th>
                                        <th>Passing Year <span class="text-danger">*</span></th>
                                        <th>Action</th>
                                    </tr>

                                    @for($i = 0; $i < $total; $i++)
                                    <tr id="row{{ $i + 1 }}" class="{{ $i > 0 ? 'dynamic-added' : '' }}">
                                        <td>
                                            <input type="text" class="form-control education" name="education[]" placeholder="University" value="{{ $educations[$i] ?? '' }}">
                                            <small class="text-danger error-education"></small>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control clg_name" name="clg_name[]" placeholder="College Name" value="{{ $colleges[$i] ?? '' }}">
                                            <small class="text-danger error-clg_name"></small>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control degree" name="degree[]" placeholder="Degree" value="{{ $degrees[$i] ?? '' }}">
                                            <small class="text-danger error-degree"></small>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control percentage" name="percentage[]" placeholder="Percentage" value="{{ $percentages[$i] ?? '' }}">
                                            <small class="text-danger error-percentage"></small>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control passing_year" name="passing_year[]" placeholder="Passing Year" value="{{ $passing_years[$i] ?? '' }}">
                                            <small class="text-danger error-passing_year"></small>
                                        </td>
                                        <td>
                                            @if($i == 0)
                                                <button type="button" class="btn btn-primary add">Add More</button>
                                            @else
                                                <button type="button" name="remove" id="{{ $i + 1 }}" class="btn btn-danger btn_remove">X</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endfor
                                </table>
                            </div>

                            <div class="form-group mt-3 col-sm-4">
                                <button type="submit" class="btn btn-success btn-block">Update</button>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    let i = $('#dynamic_field tr').length - 1; // count rows

    // Add More Row
    $('.add').on('click', function() {
        i++;
        $('#dynamic_field').append(`
        <tr id="row${i}" class="dynamic-added">
            <td>
                <input type="text" class="form-control education" name="education[]" placeholder="University">
                <small class="text-danger error-education"></small>
            </td>
            <td>
                <input type="text" class="form-control clg_name" name="clg_name[]" placeholder="College Name">
                <small class="text-danger error-clg_name"></small>
            </td>
            <td>
                <input type="text" class="form-control degree" name="degree[]" placeholder="Degree">
                <small class="text-danger error-degree"></small>
            </td>
            <td>
                <input type="text" class="form-control percentage" name="percentage[]" placeholder="Percentage">
                <small class="text-danger error-percentage"></small>
            </td>
            <td>
                <input type="text" class="form-control passing_year" name="passing_year[]" placeholder="Passing Year">
                <small class="text-danger error-passing_year"></small>
            </td>
            <td>
                <button type="button" name="remove" id="${i}" class="btn btn-danger btn_remove">X</button>
            </td>
        </tr>`);
    });

    // Remove Row
    $(document).on('click', '.btn_remove', function() {
        let button_id = $(this).attr("id");
        $('#row' + button_id).remove();
    });

    // Validate on submit
    $('#educationForm').on('submit', function(e) {
        e.preventDefault();
        let isValid = true;

        $('.text-danger').text('');

        $('#dynamic_field tr').each(function() {
            const education = $(this).find('.education').val();
            const clg_name = $(this).find('.clg_name').val();
            const degree = $(this).find('.degree').val();
            const percentage = $(this).find('.percentage').val();
            const passing_year = $(this).find('.passing_year').val();

            if (education === undefined) return;

            if (!education) {
                $(this).find('.error-education').text('University is required');
                isValid = false;
            }

            if (!clg_name) {
                $(this).find('.error-clg_name').text('College name is required');
                isValid = false;
            }

            if (!degree) {
                $(this).find('.error-degree').text('Degree is required');
                isValid = false;
            }

            if (!percentage || isNaN(percentage) || percentage < 0 || percentage > 100) {
                $(this).find('.error-percentage').text('valid percentage (0–100)');
                isValid = false;
            }

            if (!passing_year || isNaN(passing_year) || passing_year.length !== 4) {
                $(this).find('.error-passing_year').text('valid year (e.g., 2022)');
                isValid = false;
            }
        });

        if (isValid) {
            this.submit();
        }
    });
});
</script>

@endsection
