@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:40px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Developer Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
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
                                    <th>Sl. No.</th>
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>Order Id</th>
                                    <th>More Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;
                                foreach($developer_order_details as $developer_order) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $developer_order->u_id; ?></td>
                                        <td><?php echo $developer_order->fname; ?></td>
                                        <td><?php echo $developer_order->order_id; ?></td>

                                        <td><a class="btn btn-success" href="javascript:void();" data-toggle="modal" data-target="#myModal<?php echo $developer_order->dev_id; ?>" ><i class="fa fa-show"></i>Details</a></td>
                                    </tr>
                                    <div class="modal" id="myModal<?php echo $developer_order->dev_id; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Order Details</h4>
                                                    </div>
                                                  <div class="modal-body">
                                                    <p>Product Image : <img src="<?php echo URL::asset('public/upload/developer/'.$developer_order->image.'') ?>" alt="Alternate Text" height="50" /></p>
                                                    <p>Product Name : <?php echo $developer_order->name; ?></p>
                                                    <p>Product Price : <?php echo $developer_order->perhr; ?></p>
                                                    <p>Status : <b style="color:green"><?php echo $developer_order->payment_status; ?></b></p>
                                                    <p>Date : <?php echo $developer_order->date; ?></p>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div>
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
@endsection