@extends('developer.layout')
@section('content')

<div class="page-content">
    <div class="row">
        <div class="col-lg-8 ml-auto mr-auto">
            @if(Session::has('devkycerrmsg'))                 
                <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                       <strong>{{Session::get('devkycerrmsg')}}</strong>
                </div>
                {{Session::forget('message')}}
                {{Session::forget('devkycerrmsg')}}
            @endif
        </div>
    </div>
</div>

<?php 
    foreach ($developer_details as $k) {
    
    if($k->adharcard == '' && $k->pancard == '' && $k->national_id_name == '' && $k->national_id_image == '' && $k->signature == '' && $k->signature == ''){
?>

<div class="page-content" style="padding-top:30px;">
    <div class="main-wrapper container">   
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add KYC Details</h5>
                        <form method="post" action="{{ route('add_developer_kyc') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Upload Residence Proof/Aadhaar Card</label>
                                        <input type="file" class="form-control" name="adharcard" autocomplete="off" required>
                                        
                                        @if ($errors->has('adharcard'))
                                        <strong class="text-danger">{{ $errors->first('adharcard') }}</strong>                                  
                                        @endif
                                    </div>
                                </div>
                                
                                
                                <div class="col-sm-6">
                                    <label>Aadhar Card Number <span class="text-danger">*</span></label>
                                    <input type="text" name="adhar_number" class="form-control">
                                    <span class="text-danger error-adhar_number"></span>
                                    @if ($errors->has('adhar_number'))
                                        <strong class="text-danger">{{ $errors->first('adhar_number') }}</strong>                                  
                                    @endif
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Upload PAN/TAX Card</label>
                                        <input type="file" class="form-control" name="pancard"  autocomplete="off" required>
                                        @if ($errors->has('pancard'))
                                            <strong class="text-danger">{{ $errors->first('pancard') }}</strong>                                  
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>PAN Card Number <span class="text-danger">*</span></label>
                                    <input type="text" name="pan_number" class="form-control">
                                    <span class="text-danger error-pan_number"></span>
                                    @if ($errors->has('pan_number'))
                                        <strong class="text-danger">{{ $errors->first('pan_number') }}</strong>                                  
                                    @endif
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">National Identification</label>
                                        <select name="national_id_name" id="national_id_name" class="form-control" required>
                                            <option value="">Choose</option>
                                            <option value="Passport">Passport</option>
                                            <option value="Driving License">Driving License</option>
                                            <option value="Voter Card">Voter Card</option>
                                        </select>
                                        @if ($errors->has('national_id_name'))
                                        <strong class="text-danger">{{ $errors->first('national_id_name') }}</strong>                                   
                                        @endif
                                    </div>                      
                                </div> 

                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Upload National Id Image</label>
                                        <input type="file" class="form-control" name="national_id_image" accept="image/*"  autocomplete="off" required>
                                        
                                        @if ($errors->has('national_id_image'))
                                        <strong class="text-danger">{{ $errors->first('national_id_image') }}</strong>                                  
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Upload Profile Image</label>
                                        <input type="file" class="form-control" name="image" accept="image/*"  autocomplete="off" required>
                                       
                                        @if ($errors->has('image'))
                                        <strong class="text-danger">{{ $errors->first('image') }}</strong>                                  
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Upload Signature</label>
                                        <input type="file" class="form-control" name="signature" autocomplete="off" required>
                                        
                                        @if ($errors->has('signature'))
                                        <strong class="text-danger">{{ $errors->first('signature') }}</strong>                                  
                                        @endif
                                    </div>
                                </div>    

                                <div class="col-sm-12">             
                                    <p  href="#" class="text-primary font-size-md">Agrement : The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: "Client", "You" and "Your" refers to you, the person log on this website and compliant to the Company’s terms and conditions.</p>
                                </div>
                                <div class="col-sm-4">
                                     <div class="form-checkbox">

                                            <input type="checkbox" class="custom-checkbox" id="remember" name="remember" required="">
                                            
                                            <label for="remember" class="font-size-md">  <a  href="#" class="text-primary font-size-md">I Accept</a></label>
                                        </div>
                                    <div class="form-group bmd-form-group">
                                        <button type="submit" class="btn btn-success btn-block">Add KYC Details</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php }else{ ?>

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">KYC</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>National Id</th>
                                        <th>National Id Image</th>
                                        <th>Residance Proofe/Aadhar Card</th>
                                        <th>PAN/Tax Card</th>
                                        <th>Profile Image</th>
                                        <th>Signature</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php $i=1;
                                    foreach($developer_details as $dd) { ?>
                                        <tr>
                                            <td><?php echo $dd->national_id_name; ?></td>
                                            
                                            <td><x-file-preview :fileName="$dd->national_id_image" filePath="upload/national_image" /></td>
                                            <td><x-file-preview :fileName="$dd->adharcard" filePath="upload/adhar_card" /></td>
                                            <td><x-file-preview :fileName="$dd->pancard" filePath="upload/pan_card" /></td>
                                            <td><x-file-preview :fileName="$dd->image" filePath="upload/developer" /></td>
                                            <td><x-file-preview :fileName="$dd->signature" filePath="upload/signature" /></td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="<?php echo route('update_developer_kyc_details',['id'=>''.$dd->dev_id.'']) ?>" ><i class="fa fa-edit"></i></a>
                                                                                            
                                            </td>                                                                         
                                        </tr>
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

<?php } } ?>

@endsection