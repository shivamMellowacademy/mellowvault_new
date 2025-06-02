@extends('developer.layout')
@section('content')


<div class="page-content">
    <div class="row">
        <div class="col-lg-8 ml-auto mr-auto">
            @if(Session::has('bankerrmsg'))
            <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <strong>{{Session::get('bankerrmsg')}}</strong>
            </div>
            {{Session::forget('message')}}
            {{Session::forget('bankerrmsg')}}
            @endif
        </div>
    </div>
</div>

<div class="page-content" style="padding-top:30px;">
    <div class="main-wrapper container">
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update Bank Details</h5>
                        <?php 
                            foreach($developer_details as $p) { ?>
                        <form method="post" action="{{ route('update_developer_bank') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Name Of Bank</label>
                                        <input type="hidden" class="form-control" name="update"
                                            value="<?php echo $p->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control" name="bank_name"
                                            value="<?php echo $p->bank_name; ?>" autocomplete="off" required="">
                                        @if ($errors->has('bank_name'))
                                        <strong class="text-danger">{{ $errors->first('bank_name') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Branch Name</label>
                                        <input type="hidden" class="form-control" name="update"
                                            value="<?php echo $p->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control" name="branch_name"
                                            value="<?php echo $p->branch_name; ?>" autocomplete="off" required="">
                                        @if ($errors->has('branch_name'))
                                        <strong class="text-danger">{{ $errors->first('branch_name') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Account Name</label>
                                        <input type="hidden" class="form-control" name="update"
                                            value="<?php echo $p->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control" name="acct_name"
                                            value="<?php echo $p->acct_name; ?>" autocomplete="off" required="">
                                        @if ($errors->has('acct_name'))
                                        <strong class="text-danger">{{ $errors->first('acct_name') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Account Number</label>
                                        <input type="hidden" class="form-control" name="update"
                                            value="<?php echo $p->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control" name="account_number"
                                            value="<?php echo $p->account_number; ?>" autocomplete="off" required="">
                                        @if ($errors->has('account_number'))
                                        <strong class="text-danger">{{ $errors->first('account_number') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">IFC Code</label>
                                        <input type="hidden" class="form-control" name="update"
                                            value="<?php echo $p->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control" name="ifc_code"
                                            value="<?php echo $p->ifc_code; ?>" autocomplete="off" required="">
                                        @if ($errors->has('ifc_code'))
                                        <strong class="text-danger">{{ $errors->first('ifc_code') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Swift Code</label>
                                        <input type="hidden" class="form-control" name="update"
                                            value="<?php echo $p->dev_id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control" name="micr_number"
                                            value="<?php echo $p->micr_number; ?>" autocomplete="off" required="">
                                        @if ($errors->has('micr_number'))
                                        <strong class="text-danger">{{ $errors->first('micr_number') }}</strong>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Upload Passbook</label>
                                        <input type="file" class="form-control" name="passbook" autocomplete="off">
                                        <input type="hidden" class="form-control" name="old_passbook"
                                            value="<?php echo $p->passbook; ?>" autocomplete="off">
                                        <img class="img-fluid img-thumbnail"
                                            src="<?php echo URL::asset('public/upload/passbook/'.$p->passbook.'') ?>"
                                            style="height:30px;width:40px;">
                                        @if ($errors->has('passbook'))
                                        <strong class="text-danger">{{ $errors->first('passbook') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label for="image">Type Of Account:</label><br>

                                    <label>
                                        <input type="radio" name="account_Type" value="Saving"
                                            {{ old('account_Type', $p->account_Type ?? '') == 'Saving' ? 'checked' : '' }}>
                                        Saving Account
                                    </label>

                                    <label>
                                        <input type="radio" name="account_Type" value="Current"
                                            {{ old('account_Type', $p->account_Type ?? '') == 'Current' ? 'checked' : '' }}>
                                        Current Account
                                    </label>

                                    <label>
                                        <input type="radio" name="account_Type" value="Others"
                                            {{ old('account_Type', $p->account_Type ?? '') == 'Others' ? 'checked' : '' }}>
                                        Others
                                    </label>

                                    @if ($errors->has('account_Type'))
                                    <strong class="text-danger">{{ $errors->first('account_Type') }}</strong>
                                    @endif
                                </div>


                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <button type="submit" class="btn btn-success btn-block">Update KYC
                                            Details</button>
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


@endsection