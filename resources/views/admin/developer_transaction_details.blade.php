@extends('admin.layout')
@section('content')




<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Developer Transaction</a></li>
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
                                    <th>Order Id</th>
                                    <th>Total Price</th>
                                    <th>Mellow Commission</th>
                                    <th>Transaction Account</th>
                                    <th>Transaction ID</th>
                                    <th>Transaction Status</th>
                                    <th>Transaction</th>
                                    
                                </tr>
                            </thead>
	                        <tbody>
                                <?php
                                    foreach ($wallet_details as $wd) {
                                ?>
                                    <tr>
                                        <td><?php echo $wd->order_id; ?></td>
                                        <td>INR <?php echo $wd->total_price; ?></td>
                                        <td><p class="btn btn-danger">30 %</p></td>
                                        <td>INR <?php echo $wd->original_price; ?></td>

                                        <td>
                                        <?php 
                                            foreach ($developer_payment_details as $k) {
                                                if($k->wallet_id == $wd->id){
                                        ?>
                                        <?php echo $k->razorpay_payment_id; ?>
                                        <?php }else{?>
                                            
                                        <?php } }?>
                                    </td>
                                        <?php if($wd->transaction_status == 0 ){ ?>
                                            <td><p class="btn btn-danger">Not Completed</p></td>
                                            <td><a href="{{ route('checkout_to_developer',['id'=>''.$wd->id.'']) }}" class="btn btn-primary">Transfer</a></td>
                                        <?php }elseif($wd->transaction_status == 1){?>
                                            <td><p class="btn btn-success">Success</p></td>
                                            <td><a href="" class="btn btn-info">Done</a></td>
                                        <?php } ?>
                                        
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



@endsection