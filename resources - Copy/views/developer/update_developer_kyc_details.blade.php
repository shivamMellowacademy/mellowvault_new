@extends('developer.layout')
@section('content')

<div class="page-content">
    <div class="main-wrapper container mt-4">   
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update KYC Details</h5>
                        @foreach($developer_details as $dd)
                        <form id="kycForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="developer_id" value="{{ $dd->dev_id }}">
                            <div class="row">

                                <div class="col-sm-6">
                                    <label>Residence Proof / Aadhar Card <span class="text-danger">*</span></label>
                                    <input type="file" name="adharcard" class="form-control">
                                    <input type="hidden" name="old_adharcard" value="{{ $dd->adharcard }}">
                                    <!-- preview file start -->
                                    <x-file-preview :fileName="$dd->adharcard" filePath="upload/adhar_card" />
                                    <!-- preview file end -->
                                    <span class="text-danger error-adharcard"></span>
                                </div>

                                <div class="col-sm-6">
                                    <label>Aadhar Card Number <span class="text-danger">*</span></label>
                                    <input type="text" name="adhar_number" value="{{ $dd->adhar_number }}" class="form-control">
                                    <span class="text-danger error-adhar_number"></span>
                                </div>

                                <div class="col-sm-6">
                                    <label>PAN / Tax Card <span class="text-danger">*</span></label>
                                    <input type="file" name="pancard" class="form-control">
                                    <input type="hidden" name="old_pancard" value="{{ $dd->pancard }}">
                                   <!-- preview file start -->
                                   <x-file-preview :fileName="$dd->pancard" filePath="upload/pan_card" />
                                    <!-- preview file end -->
                                    <span class="text-danger error-pancard"></span>
                                </div>

                                <div class="col-sm-6">
                                    <label>PAN Card Number <span class="text-danger">*</span></label>
                                    <input type="text" name="pan_number" value="{{ $dd->pan_number }}" class="form-control">
                                    <span class="text-danger error-pan_number"></span>
                                </div>

                                <div class="col-sm-6">
                                    <label>National ID Type <span class="text-danger">*</span></label>
                                    <select name="national_id_name" class="form-control">
                                        <option value="">Choose</option>
                                        <option value="Passport" {{ $dd->national_id_name == 'Passport' ? 'selected' : '' }}>Passport</option>
                                        <option value="Driving License" {{ $dd->national_id_name == 'Driving License' ? 'selected' : '' }}>Driving License</option>
                                        <option value="Voter Card" {{ $dd->national_id_name == 'Voter Card' ? 'selected' : '' }}>Voter Card</option>
                                    </select>
                                    <span class="text-danger error-national_id_name"></span>
                                </div>

                                <div class="col-sm-6">
                                    <label>National ID Image <span class="text-danger">*</span></label>
                                    <input type="file" name="national_id_image" class="form-control">
                                    <input type="hidden" name="old_national_id_image" value="{{ $dd->national_id_image }}">
                                    <!-- preview file start -->
                                    <x-file-preview :fileName="$dd->national_id_image" filePath="upload/national_image" />
                                    <!-- preview file end -->
                                    <span class="text-danger error-national_id_image"></span>
                                </div>

                                <div class="col-sm-6">
                                    <label>Profile Image <span class="text-danger">*</span></label>
                                    <input type="file" name="image" class="form-control">
                                    <input type="hidden" name="old_image" value="{{ $dd->image }}">
                                    <!-- preview file start -->
                                    <x-file-preview :fileName="$dd->image" filePath="upload/developer" />
                                     <!-- preview file end -->
                                    <span class="text-danger error-image"></span>
                                </div>

                                <div class="col-sm-6">
                                    <label>Signature <span class="text-danger">*</span></label>
                                    <input type="file" name="signature" class="form-control">
                                    <input type="hidden" name="old_signature" value="{{ $dd->signature }}">
                                    <!-- preview file start -->
                                    <x-file-preview :fileName="$dd->signature" filePath="upload/signature" />
                                     <!-- preview file end -->
                                    <span class="text-danger error-signature"></span>
                                </div>

                                <div class="col-sm-4 mt-3">
                                    <button type="submit" class="btn btn-success btn-block">Update KYC Details</button>
                                </div>

                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- jQuery Validate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
$(document).ready(function() {

    $('#kycForm').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        $('.text-danger').text(''); // Clear all error messages

        $.ajax({
            url: "{{ route('update_developer_kyc') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('button[type="submit"]').prop('disabled', true);
            },
            success: function(response) {
                toastr.success('KYC details updated successfully!');
                $('button[type="submit"]').prop('disabled', false);
                setTimeout(function() {
                    window.location.reload();
                }, 1500);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, val) {
                        $('.error-' + key).text(val[0]);
                    });
                } else {
                    toastr.error('Something went wrong. Please try again.');
                }
                $('button[type="submit"]').prop('disabled', false);
            }
        });
    });

});
</script>
@endsection
