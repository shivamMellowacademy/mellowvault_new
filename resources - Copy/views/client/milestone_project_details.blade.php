@extends('client.layout')
@section('content')



<div class="page-content">
    <div class="row">
        <div class="col-lg-8 ml-auto mr-auto">
            @if(Session::has('errmsg'))                 
                <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                       <strong>{{Session::get('errmsg')}}</strong>
                </div>
                {{Session::forget('message')}}
                {{Session::forget('errmsg')}}
            @endif
            <br><br>
        </div>
    </div>
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Created Project</a></li>
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
                                        <th>Project Name</th>
                                        <th>Project Duration (In Months)</th>
                                        <th>Project Price</th>
                                        <th>Advance Price (40 %)</th>
                                        <th>Advance Payment</th>
                                        <th>Due Payment</th>
                                        <th>Last Date Of Payment</th>
                                        <th>Send Milestone Details</th>
                                        <th>Project Status</th>
                                        
                                    </tr>
                                </thead>
    	                        <tbody>
                                   <?php
                                    foreach($milestone_project as $s) { ?>
                                        <tr>
                                            <td><?php echo $s->project_name; ?></td>
                                            <td><?php echo $s->project_duration; ?></td>
                                            <td><?php echo $s->project_price; ?></td>
                                            <td>
                                                <?php $tprice = $s->project_price; 
                                                echo $total_price = $tprice - $calculate_price = (( 40 / 100 ) * $tprice ); ?>
                                                <?php session(['total_price' => $total_price]); ?>
                                            </td>

                                            <?php 
                                                if( $s->advance_payment == ''){
                                            ?>
                                                <td><a href="{{route('client_advance_payment',['sow_id'=>''.$s->sow_id.''])}}" class="btn btn-success btn-sm">Advance payment</a></td>
                                            <?php }elseif($s->advance_payment == '1'){ ?>
                                                
                                                <td><a href="" class="btn btn-success btn-sm">Successfull</a></td>
                                            <?php } ?>
                                            
                                            <?php 
                                                if( $s->advance_payment == ''){
                                            ?>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            <?php }elseif($s->advance_payment == '1'){?>
                                                <td>
                                                    <?php 
                                                        $tprice = $s->project_price; 
                                                        $total_price = $tprice - $calculate_price = (( 40 / 100 ) * $tprice ); 
                                                        echo $due_price = $tprice - $total_price;
                                                    ?>
                                                </td>
                                                 <td>

                                                    <a href="" class="btn btn-danger" >
                                                        <?php 
                                                            $effectiveDate = $s->date; 
                                                            $project_duration = $s->project_duration;
                                                            echo $effectiveDate = date('Y-m-d', strtotime("+$project_duration months", strtotime($effectiveDate)));
                                                        ?>
                                                    </a>

                                                    <?php 
                                                        $current_date = date("Y-m-d");
                                                        if( $current_date == $effectiveDate){

                                                    ?>
                                                        <a class="btn btn-success" href="" style="margin-top:10px;"><i class="fa fa-show"></i>Due Payment</a>
                                                    <?php  }?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $current_date = date("Y-m-d");
                                                        if( $current_date == $effectiveDate){

                                                    ?>
                                                        <p>You can't send milestone</p>
                                                    <?php }else{ ?>
                                                        <a class="btn btn-success" href="<?php echo route('milestone',['project_id'=>''.$s->id.'']) ?>"><i class="fa fa-show"></i>Send</a></td>
                                                    <?php } ?>
                                                <td><p class="btn btn-warning"><?php echo $s->project_status; ?></p></td>
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
</div>



@endsection