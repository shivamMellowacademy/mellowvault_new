@extends('developer.layout')
@section('content')

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
                                <div class="table-responsive">
                                    <table id="complex-header" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Order Id</th>
                                                <th>Product Details</th>
                                                <th>Transaction Id</th>
                                               
                                                <th>Amount</th>
                                                <th>Mellow Commission</th>
                                                <th>Date</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($wallet_details as $t) { ?>
                                                <tr>
                                                    <td><?php echo $t->order_id; ?></td>
                                                    <td><a href="<?php echo route('transaction_product_details',['p_id'=>''.$t->wallet_p_id.'']) ?>" class="btn btn-success">Details</a></td>
                                                    <td><?php echo $t->razorpay_payment_id; ?></td>
                                                    <td>INR <?php echo $t->price; ?> </td>
                                                    <td><b class="btn btn-danger">30%</b></td>
                                                    <td><?php echo $t->date; ?></td>                                                                
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
    </div>
@endsection