@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:30px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <?php
                foreach($sow_pro_details as $sp) { ?>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><?php echo $sp->project_name; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
            <?php } ?>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Project Name</th>    
                                    <th>Project Duration (In Months)</th>
                                    <th>Project Price</th>
                                    <th>Advance Payment(40%)</th>
                                    <th>Advance Payment Status</th>
                                    <th>Due Payment</th>
                                    <th>Last Date Of Payment</th>
                                    <th>Project Status</th>
                                </tr>
                            </thead>
	                        <tbody>
                                <?php
                                    foreach($sow_pro_details as $sp) { ?>
                                        <tr>
                                                                                       
                                            <td>
                                                <?php echo $sp->project_name; ?>
                                            </td>

                                            <td>
                                                <?php echo $sp->project_duration; ?>
                                            </td>

                                            <td>
                                                <?php echo $sp->project_price; ?>
                                            </td> 

                                            <td>
                                                <?php $tprice = $sp->project_price; 
                                                echo $total_price = $tprice - $calculate_price = (( 40 / 100 ) * $tprice ); ?>
                                            </td>

                                            <?php if($sp->advance_payment == '1'){ ?>
                                                <td><a href="" class="btn btn-success btn-sm">Successful</a></td>
                                                <td>
                                                    <?php 
                                                        $tprice = $sp->project_price; 
                                                        $total_price = $tprice - $calculate_price = (( 40 / 100 ) * $tprice ); 
                                                        echo $due_price = $tprice - $total_price;
                                                    ?>
                                                </td>
                                                <td>
                                                    <p class="btn btn-danger"><?php 
                                                        $effectiveDate = $sp->date; 
                                                        $project_duration = $sp->project_duration;
                                                       echo $effectiveDate = date('Y-m-d', strtotime("+$project_duration months", strtotime($effectiveDate)));

                                                    ?></p>

                                                    
                                                </td>
                                                <td><p class="btn btn-success"><?php echo $sp->project_status; ?></p></td>
                                            <?php }else{?> 
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            <?php } ?>


                                            
                                        </tr>
                                        
                                <?php 
                                } ?>
	                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
       	</div>
    </div>
</div>
@endsection