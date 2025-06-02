@extends('admin.layout')
@section('content')


<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Requested Developer Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
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

            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-white">Sl. No.</th>
                                        <th class="text-white">Higher Professional</th>
                                        <th class="text-white">Full Name</th>
                                        <th class="text-white">Profile Status</th>
                                        <th class="text-white">Option</th>
                                        <th class="text-white">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;
                                foreach($developer_details as $s) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $s->heading; ?></td>
                                        <td><?php echo $s->name; ?> <?php echo $s->last_name; ?></td>

                                        <!-- <td><a class="btn btn-success btn-sm" href="<?php echo route('requested_developer_profile_details',['dev_id'=>''.$s->dev_id.'']) ?>" >Details</a></td> -->
                                        <!-- <td><a class="btn btn-success btn-sm" href="<?php echo route('requested_bank_details',['dev_id'=>''.$s->dev_id.'']) ?>" >Details</a></td>
                                        <td><a class="btn btn-success btn-sm" href="<?php echo route('requested_project_details',['dev_id'=>''.$s->dev_id.'']) ?>" >Details</a></td>
                                         -->

                                        <td><b style="color:red"><?php echo $s->profile_complete; ?> %</b></td>

                                        <td>

                                            <a class="btn btn-success btn-sm"
                                                href="<?php echo route('developer_login_status',['dev_id'=>''.$s->dev_id.'']) ?>"><i
                                                    class="fa fa-show"></i>Active</a>

                                        </td>

                                        <td>
                                            <!-- Action Dropdown -->
                                            <div class="dropdown">
                                                <button class="btn btn-info btn-sm dropdown-toggle" type="button"
                                                    id="actionDropdown<?php echo $s->dev_id; ?>" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu"
                                                    aria-labelledby="actionDropdown<?php echo $s->dev_id; ?>">
                                                    <a class="dropdown-item" href="javascript:void();"
                                                        data-toggle="modal"
                                                        data-target="#myprofileModal<?php echo $s->dev_id; ?>"><i
                                                            class="fa fa-show"></i> View Profile</a>
                                                    <a class="dropdown-item" href="javascript:void();"
                                                        data-toggle="modal"
                                                        data-target="#mybankModal<?php echo $s->dev_id; ?>"><i
                                                            class="fa fa-show"></i> View Bank Details</a>
                                                    <a class="dropdown-item" href="javascript:void();"
                                                        data-toggle="modal"
                                                        data-target="#myprojectModal<?php echo $s->dev_id; ?>"><i
                                                            class="fa fa-show"></i> View Project Details</a>
                                                    <a class="dropdown-item" href="javascript:void();"
                                                        data-toggle="modal"
                                                        data-target="#emailModal<?php echo $s->dev_id; ?>"><i
                                                            class="fa fa-show"></i> Email notification</a>
                                                    <!-- Create Action Button -->
                                                    <!-- <a class="dropdown-item" href="<?php echo url('developer_create_action', ['dev_id' => $s->dev_id]); ?>"><i class="fa fa-plus"></i> Create Action</a> -->
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="myprofileModal<?php echo $s->dev_id; ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title text-white" id="profileModalLabel">Profile
                                                        Details</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <!-- Profile Header Section -->
                                                    <div class="row mb-4">
                                                        <div class="col-md-3 text-center">
                                                            @if(!empty($s->image))
                                                            <img src="<?php echo URL::asset('public/upload/developer/' . $s->image); ?>"
                                                                class="img-fluid img-thumbnail"
                                                                style="height:150px; width:150px; object-fit:cover;">
                                                            @else
                                                            <img src="{{url('public/client/assets/images/avatars/profile-image.png')}}"
                                                                class="img-fluid img-thumbnail"
                                                                style="height:150px; width:150px; object-fit:cover;">
                                                            @endif
                                                        </div>
                                                        <div class="col-md-9">
                                                            <h4><?php echo $s->name; ?></h4>
                                                            <p class="text-muted"><?php echo $s->job; ?></p>
                                                            <p><strong>Email:</strong> <?php echo $s->email; ?></p>
                                                            <p><strong>Location:</strong> <?php echo $s->address; ?></p>
                                                            <p><strong>Languages:</strong> <?php echo $s->language; ?>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <!-- Profile Information Section -->
                                                    <div class="row">
                                                        <?php
                                                            $fields = [
                                                              'Description' => $s->description,
                                                              'Contact Number' => $s->phone,
                                                              'Hourly Rate' => $s->perhr,
                                                              'Total Hours Worked' => $s->total_hours,
                                                              'Rating' => $s->rating,
                                                              'University' => $s->education,
                                                              'College' => $s->clg_name,
                                                              'Degree' => $s->degree,
                                                              'Percentage' => $s->percentage,
                                                              'Passing Year' => $s->passing_year,
                                                              'Skills' => $s->skills,
                                                              'Completed Jobs' => $s->completed_job,
                                                              'National ID' => $s->national_id_name,
                                                            ];
                                                
                                                            foreach ($fields as $title => $value) {
                                                              echo '
                                                                <div class="col-md-6 mb-3">
                                                                  <div class="card">
                                                                    <div class="card-body">
                                                                      <h6 class="card-title">' . $title . '</h6>
                                                                      <p class="card-text">' . htmlspecialchars($value) . '</p>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                              ';
                                                            }
                                                          ?>
                                                    </div>

                                                    <!-- Images Section -->
                                                    <div class="row">
                                                        <?php
                                                      $images = [
                                                        'National ID Image' => 'public/upload/national_image/' . $s->national_id_image,
                                                        'Profile Image' => 'public/upload/developer/' . $s->image,
                                                        'Portfolio Image' => 'public/upload/portfolio/' . $s->portfolio_image,
                                                        'Signature' => 'public/upload/signature/' . $s->signature,
                                                      ];
                                          
                                                      foreach ($images as $label => $path) {
                                                        if (!empty($path)) {
                                                          echo '
                                                            <div class="col-md-6 mb-3">
                                                              <div class="card">
                                                                <div class="card-body text-center">
                                                                  <h6 class="card-title">' . $label . '</h6>
                                                                  <a href="' . URL::asset($path) . '" target="_blank">
                                                                    <img class="img-fluid img-thumbnail" src="' . URL::asset($path) . '" style="height:200px; object-fit:cover;">
                                                                  </a>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          ';
                                                        }
                                                      }
                                                    ?>
                                                    </div>
                                                </div>

                                                <!-- Modal Footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="modal fade" id="mybankModal<?php echo $s->dev_id; ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="bankModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title text-white" id="bankModalLabel">Bank Details
                                                    </h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <?php
                                                      // Array of bank fields
                                                      $bankFields = [
                                                        'Name Of Bank' => $s->bank_name,
                                                        'Branch Name' => $s->branch_name,
                                                        'Account Name' => $s->acct_name,
                                                        'Account Number' => $s->account_number,
                                                        'IFC Code' => $s->ifc_code,
                                                        'Swift Code' => $s->micr_number,
                                                        'Type Of Account' => $s->account_Type
                                                    ];
                                      
                                                    // Loop through the fields and display them in individual cards
                                                    foreach ($bankFields as $title => $value) {
                                                        echo '
                                                            <div class="card mb-2">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">' . $title . '</h5>
                                                                    <p class="card-text">' . htmlspecialchars($value) . '</p>
                                                                </div>
                                                            </div>
                                                        ';
                                                    }
                                                    ?>

                                                    <!-- Passbook Image Field -->
                                                    <?php if (!empty($s->passbook)) { ?>
                                                    <div class="card mb-2">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Passbook Image</h5>
                                                            <div class="text-center">
                                                                <a href="<?php echo URL::asset('public/upload/passbook/'.$s->passbook.'') ?>"
                                                                    target="_blank">
                                                                    <img class="img-fluid img-thumbnail"
                                                                        src="<?php echo URL::asset('public/upload/passbook/'.$s->passbook.'') ?>"
                                                                        style="height:200px;">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal fade" id="myprojectModal<?php echo $s->dev_id; ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title text-white" id="projectModalLabel">Project
                                                        Details</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <?php foreach ($requested_project_details as $k) { 
                                                      if($k->developer_id == $s->dev_id) {
                                                     ?>
                                                    <!-- Project Image Section -->
                                                    <div class="card mb-2">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Project Image</h5>
                                                            <div class="text-center">
                                                                <a href="<?php echo URL::asset('public/upload/screenshot/'.$k->screenshot_image.'') ?>"
                                                                    target="_blank">
                                                                    <img class="img-fluid img-thumbnail"
                                                                        src="<?php echo URL::asset('public/upload/screenshot/'.$k->screenshot_image.'') ?>"
                                                                        style="height:200px;">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Project Link Section -->
                                                    <div class="card mb-2">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Project Link</h5>
                                                            <p class="card-text">
                                                                <a href="<?php echo $k->project_link; ?>"
                                                                    target="_blank"
                                                                    class="text-primary"><?php echo $k->project_link; ?></a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <?php } } ?>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- mail modal -->
                                    <div class="modal fade" id="emailModal<?php echo $s->dev_id; ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('send.email.notification') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title text-white" id="projectModalLabel">Email
                                                            to {{ $s->name }}</h5>
                                                        <button type="button" class="close text-white"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <!-- Hidden Inputs -->
                                                        <input type="hidden" name="dev_id" value="{{ $s->dev_id }}">
                                                        <input type="hidden" name="email" value="{{ $s->email }}">

                                                        <!-- Subject Input -->
                                                        <div class="form-group">
                                                            <label for="subject">Subject <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control rounded-0"
                                                                name="subject" id="subject"
                                                                value="Please Complete Your Profile – KYC, Bank Details & More"
                                                                required>
                                                        </div>

                                                        <!-- Message Input -->
                                                        <div class="form-group">
                                                            <label for="message">Message <span
                                                                    class="text-danger">*</span></label>
                                                            <textarea class="form-control rounded-0" name="message"
                                                                id="message" rows="6" required>
Dear {{ $s->name }},

We noticed that your profile is incomplete. To proceed smoothly with our onboarding and compliance process, please update the following details:
- Personal Profile Information
- KYC (Know Your Customer)
- Bank Details

Visit your dashboard to complete the profile.

Thanks & Regards,  
Mellow Voult
                        </textarea>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Send
                                                            Email</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
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
</div>
@endsection