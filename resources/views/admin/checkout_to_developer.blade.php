@extends('admin.layout')
@section('content')

<div class="page-content">
    <div class="main-wrapper container">   
        <div class="row">
            <div class="col-xl">
                
                <div class="card">
                    <div class="card-body">
                        <?php foreach($developer_details as $deve) { ?>
                            <h5 class="card-title">Transaction To <?php echo $deve->name; ?> <?php echo $deve->last_name; ?></h5>
                        <?php } ?>
                        <form method="post" action="{{ route('payment_initiate_to_developer',['id'=>''.$deve->id.'']) }}" enctype="multipart/form-data">
                            @csrf
                            <?php foreach($developer_details as $deve) { 
                               $original_price = $deve->original_price;
                                $dev_id = $deve->dev_id;
                                session(['original_price' => $original_price]);
                                session(['dev_id' => $deve->dev_id]);
                                session(['order_id' => $deve->order_id]);
                            ?>
                            <div class="form-row">
                                <div class="col-md-9">
                                    <div class="form-group col-md-12">
                                        <label for="heading">First Name</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Heading" value="<?php echo $deve->name; ?>"  required="">
                                        @if ($errors->has('name'))
                                        <strong class="text-danger">{{ $errors->first('name') }}</strong>                                  
                                        @endif
                                    </div>
                                    
                                   
                                    <div class="form-group col-md-12">
                                        <label for="heading">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Heading" value="<?php echo $deve->last_name; ?>"  required="">
                                        @if ($errors->has('last_name'))
                                        <strong class="text-danger">{{ $errors->first('last_name') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="heading">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter Heading" value="<?php echo $deve->email; ?>"  required="">
                                        @if ($errors->has('email'))
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="heading">Address</label>
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Enter Heading" value="<?php echo $deve->address; ?>"  required="">
                                        @if ($errors->has('address'))
                                        <strong class="text-danger">{{ $errors->first('address') }}</strong>                                  
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="heading">Contact No.</label>
                                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Heading" value="<?php echo $deve->phone; ?>"  required="">
                                        @if ($errors->has('phone'))
                                        <strong class="text-danger">{{ $errors->first('phone') }}</strong>                                  
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <center>
                                        <h4>Transfer Amount</h4>
                                        <hr/>
                                        <table>
                                            <tr>
                                                <td><b> Amount : </b></td>
                                                <td>INR <?php echo $deve->original_price; ?></td>
                                            </tr>
                                        </table>
                                        <div  style="padding-top:20px">
                                            <button type="submit" class="btn btn-primary">Continue</button>
                                        </div>
                                    </center>
                                </div>
                            </div>
                           
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection