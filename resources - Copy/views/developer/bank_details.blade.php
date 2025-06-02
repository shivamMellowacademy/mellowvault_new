@extends('developer.layout')
@section('content')


<div class="page-content">
    <div class="row">
        <div class="col-lg-8 ml-auto mr-auto">
            @if(Session::has('bankerrmsg'))                 
                <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                       <strong>{{Session::get('bankerrmsg')}}</strong>
                </div>
                {{Session::forget('message')}}
                {{Session::forget('bankerrmsg')}}
            @endif
        </div>
    </div>
</div>

<?php 
    foreach ($developer_details as $k) {
        if($k->bank_name == '' && $k->branch_name == '' && $k->acct_name == '' && $k->account_number == '' && $k->ifc_code == '' && $k->micr_number == '' && $k->account_Type == '' && $k->passbook == ''){
?>

    <div class="page-content" style="padding-top:30px;">
        <div class="main-wrapper container">   
            <div class="row">
                <div class="col-xl">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Submit Bank Details</h5>
                                <form method="post" action="{{ route('add_bank_details')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">

                                        <div class="form-group col-md-4">
                                            <label for="name">Name Of Bank</label>
                                            <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Enter Bank Name" required="">
                                            @if ($errors->has('bank_name'))
                                                <strong class="text-danger">{{ $errors->first('bank_name') }}</strong>                                  
                                            @endif
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="description">Branch Name</label>
                                            <input type="text" class="form-control" name="branch_name" id="branch_name" placeholder="Enter Branch Name">
                                            @if ($errors->has('branch_name'))
                                                <strong class="text-danger">{{ $errors->first('branch_name') }}</strong>                                  
                                            @endif
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="description">Account Name</label>
                                            <input type="text" class="form-control" name="acct_name" id="acct_name" placeholder="Enter Account Name" required="">
                                            @if ($errors->has('acct_name'))
                                                <strong class="text-danger">{{ $errors->first('acct_name') }}</strong>                                  
                                            @endif
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="description">Account Number</label>
                                            <input type="text" class="form-control" name="account_number" id="account_number" placeholder="Enter Account Number">
                                            @if ($errors->has('account_number'))
                                                <strong class="text-danger">{{ $errors->first('account_number') }}</strong>                                  
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="description">IFC Code</label>
                                            <input type="text" class="form-control" name="ifc_code" id="ifc_code" placeholder="Enter IFC Code">
                                            @if ($errors->has('ifc_code'))
                                                <strong class="text-danger">{{ $errors->first('ifc_code') }}</strong>                                  
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="description">Swift Code</label>
                                            <input type="text" class="form-control" name="micr_number" id="micr_number" placeholder="Enter MICR Number">
                                            @if ($errors->has('micr_number'))
                                                <strong class="text-danger">{{ $errors->first('micr_number') }}</strong>                                  
                                            @endif
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="image">Passbook Image</label>
                                            <input type="file" class="form-control" name="passbook" id="passbook" accept="image/*">
                                            @if ($errors->has('passbook'))
                                            <strong class="text-danger">{{ $errors->first('passbook') }}</strong>                                  
                                            @endif
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="image">Type Of Account : </label><br>
                                            
                                            <input type="radio" id="tres_important" name="account_Type" value="Saving"> Saving Account</label>
                                            <input type="radio" id="important" name="account_Type" value="Current"> Current Account</label>
                                            <input type="radio" id="important" name="account_Type" value="Others"> Others</label>
                                            @if ($errors->has('account_Type'))
                                                <strong class="text-danger">{{ $errors->first('account_Type') }}</strong>                                  
                                            @endif
                                        </div>
                                        
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Bank Details</button>
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
                    <li class="breadcrumb-item"><a href="#">Bank</a></li>
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
                                <table id="complex-header" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name Of Bank</th>
                                            <th>Branch Name</th>
                                            <th>Account Name</th>
                                            <th>Account Number</th>
                                            <th>IFC Code</th>
                                            <th>Swift Code</th>
                                            <th>Passbook Image</th>
                                            <th>Type Of Account</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;
                                            foreach($developer_details as $dd) { ?>
                                                <tr>
                                                    <td><?php echo $dd->bank_name; ?></td>
                                                    <td><?php echo $dd->branch_name; ?></td>
                                                    <td><?php echo $dd->acct_name; ?></td>
                                                    <td><?php echo $dd->account_number; ?></td>
                                                    <td><?php echo $dd->ifc_code; ?></td>
                                                    <td><?php echo $dd->micr_number; ?></td>
                                                    <td><div class="geeks"><a href="<?php echo URL::asset('public/upload/passbook/'.$dd->passbook.'') ?>" target="_blank"><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/passbook/'.$dd->passbook.'') ?>"></a></div></td>
                                                    <td><?php echo $dd->account_Type; ?></td>
                                                    
                                                    <td>
                                                        <a class="btn btn-success btn-sm" href="<?php echo route('update_developer_bank_details',['id'=>''.$dd->dev_id.'']) ?>" ><i class="fa fa-edit"></i></a>
                                                    </td>                                                                         
                                                </tr>
                                        <?php } ?>
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