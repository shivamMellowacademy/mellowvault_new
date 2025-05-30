@extends('developer.layout')
@section('content')

<div class="page-content">
        <div class="page-info container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Wallet</a></li>
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
                                                <th>Milestone Name</th>
                                                <th>Milestone Amount</th>
                                                <!--<th>Withdraw Amount</th>-->
                                                <th>Transaction Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php foreach($developer_wallet_milestone as $d) { ?>
                                                <tr>
                                                    <td><?php echo $d->milestone_name; ?></td>
                                                    <td>
                                                        <?php 
                                                            
                                                            $price = $d->perhr; 
                                                            $days = $d->days;
                                                            echo $total_price = $days * $price;
                                                        ?>
                                                    </td>

                                                    <!--<td><a href="{{route('withdraw',['milestone_id'=>''.$d->id.''])}}" class="btn btn-info bt-sm">Request For withdraw</a></td>-->
                                                    
                                                    <td><a href="{{route('all_transaction_details')}}" class="btn btn-success"> Transaction</a></td>
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