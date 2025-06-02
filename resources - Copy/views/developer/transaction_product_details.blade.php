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
                                <table id="complex-header" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Product Image</th>
                                            <th>Product Price</th>
                                            <th>Product Tax</th>
                                            <th>Product Size</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;
                                            foreach($product_details as $tp) { ?>
                                                <tr>
                                                    <td><?php echo $tp->name; ?></td>
                                                    <?php if($tp->image == ''){ ?>
                                                        <td><video controls style="height:80px" controlsList="nodownload" data-play="hover" muted="muted" onmouseover="this.play()" onmouseout="this.pause();" ><source src="<?php echo URL::asset('public/upload/video/'.$tp->video.'') ?>" type="video/mp4" allowfullscreen style="height:80px"></video></td>
                                                    <?php }else{?>
                                                        <td><img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/product/'.$tp->image.'') ?>" style="height:80px"></td>
                                                    <?php } ?>
                                                    <td><?php echo $tp->price; ?> INR</td>
                                                    <td><?php echo $tp->tax; ?> %</td>
                                                    <td><?php echo $tp->pro_size; ?></td>
                                                                                                                              
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