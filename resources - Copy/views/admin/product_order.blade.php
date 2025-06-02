@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:40px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Order Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table id="complex-header" class="table table-striped table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-white">Sl. No.</th>
                                    <th class="text-white">Order Id</th>
                                    <!-- <th class="text-white">User Id</th> -->
                                    <th class="text-white">User Name</th>
                                    <th class="text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach($product_order_details as $product_order)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $product_order->order_id }}</td>
                                    <!-- <td>{{ $product_order->u_id }}</td> -->
                                    <td>{{ $product_order->fname }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#orderModal{{ $product_order->p_id }}">
                                            <i class="fa fa-eye"></i> More Details
                                        </button>
                                        <button class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#txnModal{{ $product_order->order_id }}">
                                            <i class="fa fa-credit-card"></i> Payment
                                        </button>
                                    </td>
                                </tr>

                                <!-- Order Details Modal -->
                                <div class="modal fade" id="orderModal{{ $product_order->p_id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="orderModalLabel{{ $product_order->p_id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title text-white" id="orderModalLabel{{ $product_order->p_id }}">
                                                    Order Details</h5>
                                                <button type="button" class="close text-white"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <p><strong>Product Name:</strong> {{ $product_order->name }}</p>
                                                        <p><strong>Product Price:</strong> ₹{{ $product_order->price }}
                                                        </p>
                                                        <p><strong>Status:</strong> <span
                                                                class="text-success">{{ $product_order->payment_status }}</span>
                                                        </p>
                                                        <p><strong>Date:</strong> {{ $product_order->date }}</p>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        @if(empty($product_order->image))
                                                        <p><strong>Product Video:</strong><br>
                                                            <video width="100" height="100" controls
                                                                controlsList="nodownload" muted
                                                                onmouseover="this.play()" onmouseout="this.pause()">
                                                                <source
                                                                    src="{{ URL::asset('public/upload/video/'.$product_order->video) }}"
                                                                    type="video/mp4">
                                                            </video>
                                                        </p>
                                                        @else
                                                        <p><strong>Product Image:</strong><br>
                                                            <img src="{{ URL::asset('public/upload/product/'.$product_order->image) }}"
                                                                alt="Product Image" height="80">
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Transaction Details Modal -->
                                <div class="modal fade" id="txnModal{{ $product_order->order_id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="txnModalLabel{{ $product_order->order_id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title text-white"
                                                    id="txnModalLabel{{ $product_order->order_id }}">Transaction Details
                                                </h5>
                                                <button type="button" class="close text-white"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($transaction_details as $txn)
                                                @if($txn->order_id == $product_order->order_id)
                                                <p><strong>Razorpay Payment ID:</strong> {{ $txn->razorpay_payment_id }}
                                                </p>
                                                <p><strong>Date:</strong> {{ $txn->date }}</p>
                                                @endif
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- card-body -->
                </div> <!-- card -->
            </div> <!-- col -->
        </div> <!-- row -->
    </div> <!-- container -->
</div> <!-- page-content -->

@endsection