@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:0px;">
    <div class="main-wrapper container">
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-3 rounded shadow-sm">
                <li class="breadcrumb-item"><a href="{{ route('products') }}">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Product</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-xl">
                <div class="row">
                    <div class="col-lg-8 ml-auto mr-auto">
                        @if(Session::has('errmsg'))
                        <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>{{Session::get('errmsg')}}</strong>
                        </div>
                        {{Session::forget('message')}}
                        {{Session::forget('errmsg')}}
                        @endif
                        <br><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0">Update Product</h5>
                            <a href="{{ route('products') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left mr-1"></i> Back
                            </a>
                        </div>
                        <?php
                        foreach($product as $p) { ?>
                        <form method="post" action="{{route('update_product')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="category">Choose Category:</label>
                                    <select name="c_id" id="c_id" class="form-control rounded-0">
                                        <option value="#">Choose Category</option>
                                        @foreach($cat as $c)
                                        <option value="{{ $c->id }}" {{ $p->c_id == $c->id ? 'selected' : '' }}>
                                            {{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('c_id'))
                                    <strong class="text-danger">{{ $errors->first('c_id') }}</strong>
                                    @endif
                                </div>

                                {{-- Subcategory --}}
                                <div class="form-group col-md-6">
                                    <label for="subcategory_id">Choose Sub Category:</label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-control rounded-0">
                                        <option value="#">Choose Sub Category</option>
                                        @foreach($subcategory_details as $s)
                                        <option value="{{ $s->id }}"
                                            {{ $p->subcategory_id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('subcategory_id'))
                                    <strong class="text-danger">{{ $errors->first('subcategory_id') }}</strong>
                                    @endif
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Name</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $p->id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control rounded-0" name="name"
                                            value="<?php echo $p->name; ?>" autocomplete="off" required="">
                                        @if ($errors->has('name'))
                                        <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Product Type</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $p->id; ?>" autocomplete="off">
                                        <input type="text" class="form-control rounded-0" name="pro_type"
                                            value="<?php echo $p->pro_type; ?>" autocomplete="off">
                                        @if ($errors->has('pro_type'))
                                        <strong class="text-danger">{{ $errors->first('pro_type') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Preview link</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $p->id; ?>" autocomplete="off">
                                        <input type="text" class="form-control rounded-0" name="link"
                                            value="<?php echo $p->link; ?>" autocomplete="off">
                                        @if ($errors->has('link'))
                                        <strong class="text-danger">{{ $errors->first('link') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Product Price</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $p->id; ?>" autocomplete="off" required="">
                                        <input type="text" class="form-control rounded-0" name="price"
                                            value="<?php echo $p->price; ?>" autocomplete="off" required="">
                                        @if ($errors->has('price'))
                                        <strong class="text-danger">{{ $errors->first('price') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Product Tax</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $p->id; ?>" autocomplete="off">
                                        <input type="text" class="form-control rounded-0" name="tax"
                                            value="<?php echo $p->tax; ?>" autocomplete="off">
                                        @if ($errors->has('tax'))
                                        <strong class="text-danger">{{ $errors->first('tax') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Product Size</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $p->id; ?>" autocomplete="off">
                                        <input type="text" class="form-control rounded-0" name="pro_size"
                                            value="<?php echo $p->pro_size; ?>" autocomplete="off">
                                        @if ($errors->has('pro_size'))
                                        <strong class="text-danger">{{ $errors->first('pro_size') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="source_code">Upload Zip</label>
                                    <input type="file" class="form-control rounded-0" name="source_code" id="source_code">
                                    <input type="hidden" class="form-control rounded-0" name="update"
                                        value="<?php echo $p->id; ?>" autocomplete="off">
                                    <input type="hidden" class="form-control rounded-0" name="old_source_code"
                                        value="<?php echo $p->source_code; ?>" autocomplete="off">

                                    <?php echo $p->source_code; ?>

                                    @if ($errors->has('source_code'))
                                    <strong class="text-danger">{{ $errors->first('source_code') }}</strong>
                                    @endif
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="source_code">Upload Video</label>
                                    <input type="file" class="form-control rounded-0" name="video" id="video">
                                    <input type="hidden" class="form-control rounded-0" name="update"
                                        value="<?php echo $p->id; ?>" autocomplete="off">
                                    <input type="hidden" class="form-control rounded-0" name="old_video"
                                        value="<?php echo $p->video; ?>" autocomplete="off">

                                    <?php echo $p->video; ?>

                                    @if ($errors->has('video'))
                                    <strong class="text-danger">{{ $errors->first('video') }}</strong>
                                    @endif
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label class="bmd-label-floating">PSD</label>
                                        <input type="file" class="form-control rounded-0" name="psd" value="<?php echo $p->id; ?>"
                                            autocomplete="off">
                                        <input type="hidden" class="form-control rounded-0" name="old_psd"
                                            value="<?php echo $p->psd; ?>" autocomplete="off">

                                        <?php echo $p->psd; ?>

                                        @if ($errors->has('psd'))
                                        <strong class="text-danger">{{ $errors->first('psd') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Resolution</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $p->id; ?>" autocomplete="off">
                                        <input type="text" class="form-control rounded-0" name="resolution"
                                            value="<?php echo $p->resolution; ?>" autocomplete="off">
                                        @if ($errors->has('resolution'))
                                        <strong class="text-danger">{{ $errors->first('resolution') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Choose Image</label>
                                        <input type="file" class="form-control rounded-0" name="image" accept="image/*"
                                            autocomplete="off">
                                        <input type="hidden" class="form-control rounded-0" name="old_image"
                                            value="<?php echo $p->image; ?>" autocomplete="off">

                                        <img class="img-fluid img-thumbnail"
                                            src="<?php echo URL::asset('public/upload/product/'.$p->image.'') ?>"
                                            style="height:30px;width:40px;">

                                        @if ($errors->has('image'))
                                        <strong class="text-danger">{{ $errors->first('image') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group is-filled">
                                        <label class="bmd-label-floating">Choose Product Details Image</label>
                                        <input type="file" class="form-control rounded-0" name="multiple_image[]" accept="image/*"
                                            multiple autocomplete="off">
                                        <input type="hidden" class="form-control rounded-0" name="old_multiple_image"
                                            value="<?php echo $p->multiple_image; ?>" autocomplete="off">

                                        <?php
                                            $img=$p->multiple_image;
                                            $images = explode(',',$img);
                                            foreach($images as $image) 
                                            {  ?>
                                        <img class="img-fluid img-thumbnail"
                                            src="<?php echo URL::asset('public/upload/product/'.$image.'') ?>"
                                            style="height:30px;width:40px;">
                                        <?php   
                                        } ?>


                                        @if ($errors->has('multiple_image'))
                                        <strong class="text-danger">{{ $errors->first('multiple_image') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Feature</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $p->id; ?>" autocomplete="off">
                                        <textarea class="ckeditor" name="description" autocomplete="off"
                                            required=""><?php echo $p->description; ?></textarea>
                                        @if ($errors->has('description'))
                                        <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Additions</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $p->id; ?>" autocomplete="off">
                                        <textarea class="ckeditor" name="additions" autocomplete="off"
                                            required=""><?php echo $p->additions; ?></textarea>
                                        @if ($errors->has('additions'))
                                        <strong class="text-danger">{{ $errors->first('additions') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Enter Overview</label>
                                        <input type="hidden" class="form-control rounded-0" name="update"
                                            value="<?php echo $p->id; ?>" autocomplete="off">
                                        <textarea class="ckeditor" name="overview" autocomplete="off"
                                            required=""><?php echo $p->overview; ?></textarea>
                                        @if ($errors->has('overview'))
                                        <strong class="text-danger">{{ $errors->first('overview') }}</strong>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group bmd-form-group">
                                        <button type="submit" class="btn btn-primary btn-sm">💾 Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <?php
                    } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection