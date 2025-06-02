@extends('developer.layout')
@section('content')

<div class="page-content" style="padding-top:30px;">
    <div class="main-wrapper container">   
        <div class="row">
            <div class="col-xl">
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
                      
                    </div>
                </div>
                <?php 
                    foreach ($developer_details as $k) {
                   
                    if($k->login_status == 0){
                ?>
                    <div class="alert alert-danger" role="alert"><span><center>Your Account Is Not Active</center></span></div>                                   
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Add Product</h5>
                            <form method="post" action="{{ route('add_work_space_error')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">

                                    <div class="form-group col-md-4">
                                        <label for="category">Choose Category:</label>
                                        <select name="c_id" id="c_id" class="form-control">
                                            <option value="#">Choose Category</option>
                                            <?php
                                                foreach($cat as $c) { ?>
                                                    <option value="<?php echo $c->id; ?>"><?php echo $c->name; ?></option>
                                            <?php
                                                } ?>
                                        </select>
                                        @if ($errors->has('c_id'))
                                            <strong class="text-danger">{{ $errors->first('c_id') }}</strong>                                  
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="category">Choose Sub Category:</label>
                                        <select name="subcategory_id" id="subcategory_id" class="form-control">
                                        </select>
                                        @if ($errors->has('subcategory_id'))
                                            <strong class="text-danger">{{ $errors->first('subcategory_id') }}</strong>                                  
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="name">Product Name</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Product Name" required="">
                                        @if ($errors->has('name'))
                                            <strong class="text-danger">{{ $errors->first('name') }}</strong>                                  
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="description">Product Type</label>
                                        <input type="text" class="form-control" name="pro_type" id="pro_type" placeholder="Enter Product Type">
                                        @if ($errors->has('pro_type'))
                                            <strong class="text-danger">{{ $errors->first('pro_type') }}</strong>                                  
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="description">Product Price</label>
                                        <input type="text" class="form-control" name="price" id="price" placeholder="Enter Price" required="">
                                        @if ($errors->has('price'))
                                            <strong class="text-danger">{{ $errors->first('price') }}</strong>                                  
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="description">Product Tax</label>
                                        <input type="text" class="form-control" name="tax" id="tax" placeholder="Enter Tax">
                                        @if ($errors->has('tax'))
                                            <strong class="text-danger">{{ $errors->first('tax') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="description">Product Size</label>
                                        <input type="text" class="form-control" name="pro_size" id="pro_size" placeholder="Enter Product Size">
                                        @if ($errors->has('pro_size'))
                                            <strong class="text-danger">{{ $errors->first('pro_size') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="description">Preview Link</label>
                                        <input type="text" class="form-control" name="link" id="pro_size" placeholder="Enter Preview Link">
                                        @if ($errors->has('link'))
                                            <strong class="text-danger">{{ $errors->first('link') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="image">Product Image</label>
                                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                                        @if ($errors->has('image'))
                                        <strong class="text-danger">{{ $errors->first('image') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label class="bmd-label-floating">Choose Product Details Image</label>
                                            <input type="file" class="form-control" name="multiple_image[]" accept="image/*" multiple autocomplete="off">
                                            @if ($errors->has('multiple_image'))
                                            <strong class="text-danger">{{ $errors->first('multiple_image') }}</strong>                                 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="source_code">Upload Zip</label>
                                        <input type="file" class="form-control" name="source_code" id="source_code">
                                        @if ($errors->has('source_code'))
                                        <strong class="text-danger">{{ $errors->first('source_code') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="source_code">Video</label>
                                        <input type="file" class="form-control" name="video" id="video">
                                        @if ($errors->has('video'))
                                        <strong class="text-danger">{{ $errors->first('video') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="psd">PSD</label>
                                        <input type="file" class="form-control" name="psd" id="psd">
                                        @if ($errors->has('psd'))
                                        <strong class="text-danger">{{ $errors->first('psd') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Resolution</label>
                                        <input type="text" class="form-control" name="resolution" id="resolution" placeholder="Enter Resolution">
                                        @if ($errors->has('resolution'))
                                            <strong class="text-danger">{{ $errors->first('resolution') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="description">Product Features</label>
                                        <textarea id="content" class="form-control" name="description" placeholder="Description" rows="5"></textarea>
                                        @if ($errors->has('description'))
                                            <strong class="text-danger">{{ $errors->first('description') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="description">Product Additions</label>
                                        <textarea id="Additions" class="form-control" name="additions" placeholder="Additions" rows="5"></textarea>
                                        @if ($errors->has('additions'))
                                            <strong class="text-danger">{{ $errors->first('additions') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="description">Product Overview</label>
                                        <textarea id="Overview" class="form-control" name="overview" placeholder="Overview" rows="5"></textarea>
                                        @if ($errors->has('overview'))
                                            <strong class="text-danger">{{ $errors->first('overview') }}</strong>                                  
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Product</button>
                            </form>
                        </div>
                    </div>
                <?php }else{?>

                     <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Add Product</h5>
                            <form method="post" action="{{ route('add_work_space')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">

                                    <div class="form-group col-md-4">
                                        <label for="category">Choose Category:</label>
                                        <select name="c_id" id="c_id" class="form-control">
                                            <option value="#">Choose Category</option>
                                            <?php
                                                foreach($cat as $c) { ?>
                                                    <option value="<?php echo $c->id; ?>"><?php echo $c->name; ?></option>
                                            <?php
                                                } ?>
                                        </select>
                                        @if ($errors->has('c_id'))
                                            <strong class="text-danger">{{ $errors->first('c_id') }}</strong>                                  
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="category">Choose Sub Category:</label>
                                        <select name="subcategory_id" id="subcategory_id" class="form-control">
                                        </select>
                                        @if ($errors->has('subcategory_id'))
                                            <strong class="text-danger">{{ $errors->first('subcategory_id') }}</strong>                                  
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="name">Product Name</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Product Name" required="">
                                        @if ($errors->has('name'))
                                            <strong class="text-danger">{{ $errors->first('name') }}</strong>                                  
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="description">Product Type</label>
                                        <input type="text" class="form-control" name="pro_type" id="pro_type" placeholder="Enter Product Type">
                                        @if ($errors->has('pro_type'))
                                            <strong class="text-danger">{{ $errors->first('pro_type') }}</strong>                                  
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="description">Product Price</label>
                                        <input type="text" class="form-control" name="price" id="price" placeholder="Enter Price" required="">
                                        @if ($errors->has('price'))
                                            <strong class="text-danger">{{ $errors->first('price') }}</strong>                                  
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="description">Product Tax</label>
                                        <input type="text" class="form-control" name="tax" id="tax" placeholder="Enter Tax">
                                        @if ($errors->has('tax'))
                                            <strong class="text-danger">{{ $errors->first('tax') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="description">Product Size</label>
                                        <input type="text" class="form-control" name="pro_size" id="pro_size" placeholder="Enter Product Size">
                                        @if ($errors->has('pro_size'))
                                            <strong class="text-danger">{{ $errors->first('pro_size') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="description">Preview Link</label>
                                        <input type="text" class="form-control" name="link" id="pro_size" placeholder="Enter Preview Link">
                                        @if ($errors->has('link'))
                                            <strong class="text-danger">{{ $errors->first('link') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="image">Product Image</label>
                                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                                        @if ($errors->has('image'))
                                        <strong class="text-danger">{{ $errors->first('image') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group bmd-form-group is-filled">
                                            <label class="bmd-label-floating">Choose Product Details Image</label>
                                            <input type="file" class="form-control" name="multiple_image[]" accept="image/*" multiple autocomplete="off">
                                            @if ($errors->has('multiple_image'))
                                            <strong class="text-danger">{{ $errors->first('multiple_image') }}</strong>                                 
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="source_code">Upload Zip</label>
                                        <input type="file" class="form-control" name="source_code" id="source_code">
                                        @if ($errors->has('source_code'))
                                        <strong class="text-danger">{{ $errors->first('source_code') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="source_code">Video</label>
                                        <input type="file" class="form-control" name="video" id="video">
                                        @if ($errors->has('video'))
                                        <strong class="text-danger">{{ $errors->first('video') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="psd">PSD</label>
                                        <input type="file" class="form-control" name="psd" id="psd">
                                        @if ($errors->has('psd'))
                                        <strong class="text-danger">{{ $errors->first('psd') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Resolution</label>
                                        <input type="text" class="form-control" name="resolution" id="resolution" placeholder="Enter Resolution">
                                        @if ($errors->has('resolution'))
                                            <strong class="text-danger">{{ $errors->first('resolution') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="description">Product Features</label>
                                        <textarea id="content" class="form-control" name="description" placeholder="Description" rows="5"></textarea>
                                        @if ($errors->has('description'))
                                            <strong class="text-danger">{{ $errors->first('description') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="description">Product Additions</label>
                                        <textarea id="Additions" class="form-control" name="additions" placeholder="Additions" rows="5"></textarea>
                                        @if ($errors->has('additions'))
                                            <strong class="text-danger">{{ $errors->first('additions') }}</strong>                                  
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="description">Product Overview</label>
                                        <textarea id="Overview" class="form-control" name="overview" placeholder="Overview" rows="5"></textarea>
                                        @if ($errors->has('overview'))
                                            <strong class="text-danger">{{ $errors->first('overview') }}</strong>                                  
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Product</button>
                            </form>
                        </div>
                    </div>

                <?php } } ?>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Work</a></li>
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
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Product Name</th>
                                    <th>Image</th>
                                    <th>Multipal Image</th>
                                    <th>Product Price</th>
                                    <th>Product Tax</th>
                                    <th>Price Including Tax</th>
                                    <th>More Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i=1;
                                    foreach($product as $p) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $p->name; ?></td>
                                            <td>
                                                <?php if($p->image == ''){ ?>
                                                    <video controls style="height:80px" controlsList="nodownload" data-play="hover" muted="muted" onmouseover="this.play()" onmouseout="this.pause();" ><source src="<?php echo URL::asset('public/upload/video/'.$p->video.'') ?>" type="video/mp4" allowfullscreen style="height:80px"></video>
                                                <?php }else{?>
                                                    <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/product/'.$p->image.'') ?>" style="height:80px">
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $img=$p->multiple_image;
                                                    $images = explode(',',$img);
                                                    foreach($images as $image) 
                                                    {  ?>
                                                        <img class="img-fluid img-thumbnail" src="<?php echo URL::asset('public/upload/product/'.$image.'') ?>" style="height:30px;width:40px;">
                                                <?php   
                                                    } ?>
                                            </td>
                                            <td><?php echo $price = $p->price; ?></td>
                                            <td><?php echo $tax = $p->tax; ?></td>
                                            <td><?php echo $total_price = $price + $calculate_price = (( $tax / 100 ) * $price ); ?></td>
                                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myshowModal<?php echo $p->id; ?>">More Details</button></td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="<?php echo route('work_space_updates',['id'=>''.$p->id.'']) ?>" ><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm" onclick="alert('Are You Sure To Delete This?')" href="<?php echo route('delete_work_space',['id'=>''.$p->id.'']) ?>" ><i class="fa fa-trash"></i></a>
                                            </td>                                                                        
                                        </tr>


                                        <div class="modal" id="myshowModal<?php echo $p->id; ?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h5 class="card-title">More Details</h5>
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">&nbsp;&times;&nbsp;</button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                   <div class="card">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Type</h5>
                                                                            <p class="card-text"><?php echo $p->pro_type; ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Product Feature</h5>
                                                                            <p class="card-text"><?php echo $p->description; ?></p>
                                                                        </div>
                                                                    </div>

                                                                    
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Product Size</h5>
                                                                            <p class="card-text"><?php echo $p->pro_size; ?></p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Addition</h5>
                                                                            <p class="card-text"><?php echo $p->additions; ?></p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Overview</h5>
                                                                            <p class="card-text"><?php echo $p->overview; ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Link</h5>
                                                                            <p class="card-text"><?php echo $p->link; ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Zip</h5>
                                                                            <p class="card-text"><?php echo $p->source_code; ?></p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Video</h5>
                                                                            <p class="card-text"><?php echo $p->video; ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">PSD</h5>
                                                                            <p class="card-text"><?php echo $p->psd; ?></p>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Resolution</h5>
                                                                            <p class="card-text"><?php echo $p->resolution; ?></p>
                                                                        </div>
                                                                    </div>                 
                                                                </div>  
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php
                                        $i++;
                                    }
                                    ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection