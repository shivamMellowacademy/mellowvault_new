@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:40px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <a href="{{ route('addproducts') }}" class="btn btn-primary">Add Product</a><br>
            </div>
        </div><br>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="complex-header" class="table table-striped table-bordered">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th  class="text-white">Sl. No.</th>
                                        <th  class="text-white">Product Name</th>
                                        <th  class="text-white">Image</th>
                                        <th  class="text-white">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach($product as $p)
                                    @php
                                    $split = str_split($p->name, 20);
                                    $prdName = $split[0].'...';
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $prdName }}</td>
                                        <td>
                                            @if($p->image == '')
                                            <video controls style="height:50px; width: 80px;" controlsList="nodownload" muted="muted"
                                                onmouseover="this.play()" onmouseout="this.pause();">
                                                <source src="{{ asset('public/upload/video/'.$p->video) }}"
                                                    type="video/mp4" allowfullscreen style="height:50px; width: 80px;">
                                            </video>
                                            @else
                                            <img class="img-fluid img-thumbnail"
                                                src="{{ asset('public/upload/product/'.$p->image) }}"
                                                style="height:50px; width: 80px;">
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#myshowModal{{ $p->id }}"><i
                                                    class="fa fa-eye"></i></button>
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('product_updates', ['id' => $p->id]) }}"><i
                                                    class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are You Sure To Delete This?')"
                                                href="{{ route('delete_product', ['id' => $p->id]) }}"><i
                                                    class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="myshowModal{{ $p->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered"
                                            style="max-width: 90% !important;">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title text-white" id="myModalLabel">Product Details
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <!-- Product Type (col-lg-6) -->
                                                        <div class="col-lg-6">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Type</h5>
                                                                    <p class="card-text">{{ $p->pro_type }}</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Product Size (col-lg-6) -->
                                                        <div class="col-lg-6">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Product Size</h5>
                                                                    <p class="card-text">{{ $p->pro_size }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!-- Product Type (col-lg-6) -->
                                                        <div class="col-lg-4">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Price</h5>
                                                                    <p class="card-text">₹{{ number_format($p->price, 2) }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Tax (%)</h5>
                                                                    <p class="card-text">{{ number_format($p->tax) }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php
                                                        $totalPrice = $p->price + (($p->tax / 100) * $p->price);
                                                        @endphp
                                                        
                                                        <!-- Product Size (col-lg-4) -->
                                                        <div class="col-lg-4">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Total Price With Included Tax</h5>
                                                                    <p class="card-text">₹{{ number_format($totalPrice, 2) }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Link and Source Code (col-lg-6) -->
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Link</h5>
                                                                    <p class="card-text">{{ $p->link }}</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Source Code (col-lg-6) -->
                                                        <div class="col-lg-6">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Zip</h5>
                                                                    <p class="card-text">{{ $p->source_code }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- PSD and Resolution (col-lg-6) -->
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">PSD</h5>
                                                                    <p class="card-text">{{ $p->psd }}</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Resolution (col-lg-6) -->
                                                        <div class="col-lg-6">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Resolution</h5>
                                                                    <p class="card-text">{{ $p->resolution }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Product Name (col-lg-12) -->
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Product Name</h5>
                                                                    <p class="card-text">{{ $p->name }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Product Feature (col-lg-12) -->
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Product Feature</h5>
                                                                    <p class="card-text">{!! $p->description !!}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Additions (col-lg-12) -->
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Additions</h5>
                                                                    <p class="card-text">{!! $p->additions !!}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Overview (col-lg-12) -->
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Overview</h5>
                                                                    <p class="card-text">{!! $p->overview !!}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Images & Videos (col-lg-12) -->
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Images & Videos</h5>
                                                                    <div class="row">
                                                                        @if($p->image != '')
                                                                        <div class="col-12">
                                                                            <img class="img-fluid img-thumbnail"
                                                                                src="{{ asset('public/upload/product/'.$p->image) }}"
                                                                                style="height:150px;">
                                                                        </div>
                                                                        @endif

                                                                        @php
                                                                        $additional_images = explode(',',
                                                                        $p->multiple_image);
                                                                        @endphp
                                                                        @foreach($additional_images as $image)
                                                                        @if($image)
                                                                        <div class="col-12">
                                                                            <img class="img-fluid img-thumbnail"
                                                                                src="{{ asset('public/upload/product/'.$image) }}"
                                                                                style="height:150px;">
                                                                        </div>
                                                                        @endif
                                                                        @endforeach

                                                                        @if($p->video != '')
                                                                        <div class="col-12">
                                                                            <video controls style="height:150px"
                                                                                controlsList="nodownload" muted="muted">
                                                                                <source
                                                                                    src="{{ asset('public/upload/video/'.$p->video) }}"
                                                                                    type="video/mp4" allowfullscreen
                                                                                    style="height:150px;">
                                                                            </video>
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal Footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                    $i++;
                                    @endphp
                                    @endforeach
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