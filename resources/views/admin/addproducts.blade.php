@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:40px;">
    <div class="main-wrapper container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-3 rounded shadow-sm">
                <li class="breadcrumb-item"><a href="{{ route('products') }}">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Product</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-xl">
                <div class="row">
                    <div class="col-lg-8 ml-auto mr-auto">
                        @if(Session::has('errmsg'))
                        <div class="alert alert-{{ Session::get('message') }} alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>{{ Session::get('errmsg') }}</strong>
                        </div>
                        {{ Session::forget('message') }}
                        {{ Session::forget('errmsg') }}
                        @endif
                        <br><br>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0">Add Product</h5>
                            <a href="{{ route('products') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left mr-1"></i> Back
                            </a>
                        </div>

                        <form method="POST" action="{{ route('submit_product') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-row">

                                {{-- Category --}}
                                <div class="form-group col-md-4">
                                    <label for="category">Choose Category: <span class="text-danger">*</span> </label>
                                    <select name="c_id" id="c_id" class="form-control rounded-0">
                                        <option value="#">Choose Category</option>
                                        @foreach($cat as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('c_id')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                {{-- Subcategory --}}
                                <div class="form-group col-md-4">
                                    <label for="subcategory_id">Choose Sub Category: <span class="text-danger">*</span> </label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-control rounded-0"></select>
                                    @error('subcategory_id')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                {{-- Product Name --}}
                                <div class="form-group col-md-4">
                                    <label for="name">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-0" name="name" id="name"
                                        placeholder="Enter Product Name" required>
                                    @error('name')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                {{-- Product Type --}}
                                <div class="form-group col-md-4">
                                    <label for="pro_type">Product Type</label>
                                    <input type="text" class="form-control rounded-0" name="pro_type" id="pro_type"
                                        placeholder="Enter Product Type">
                                    @error('pro_type')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                {{-- Price --}}
                                <div class="form-group col-md-4">
                                    <label for="price">Product Price <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-0" name="price" id="price"
                                        placeholder="Enter Price" required>
                                    @error('price')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                {{-- Tax --}}
                                <div class="form-group col-md-4">
                                    <label for="tax">Product Tax</label>
                                    <input type="text" class="form-control rounded-0" name="tax" id="tax"
                                        placeholder="Enter Tax">
                                    @error('tax')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                {{-- Size --}}
                                <div class="form-group col-md-4">
                                    <label for="pro_size">Product Size</label>
                                    <input type="text" class="form-control rounded-0" name="pro_size" id="pro_size"
                                        placeholder="Enter Product Size">
                                    @error('pro_size')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                {{-- Preview Link --}}
                                <div class="form-group col-md-4">
                                    <label for="link">Preview Link</label>
                                    <input type="text" class="form-control rounded-0" name="link" id="link"
                                        placeholder="Enter Preview Link">
                                    @error('link')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                {{-- Resolution --}}
                                <div class="form-group col-md-4">
                                    <label for="resolution">Resolution</label>
                                    <input type="text" class="form-control rounded-0" name="resolution" id="resolution"
                                        placeholder="Enter Resolution">
                                    @error('resolution')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                {{-- Multiple Images --}}
                                <div class="form-group col-md-4">
                                    <label>Choose Product Details Image</label>
                                    <input type="file" class="form-control rounded-0" name="multiple_image[]"
                                        accept="image/*" multiple autocomplete="off">
                                    @error('multiple_image')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                {{-- Upload ZIP --}}
                                <div class="form-group col-md-4">
                                    <label for="source_code">Upload Zip</label>
                                    <input type="file" class="form-control rounded-0" name="source_code" id="source_code">
                                    @error('source_code')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                {{-- Video --}}
                                <div class="form-group col-md-4">
                                    <label for="video">Video</label>
                                    <input type="file" class="form-control rounded-0" name="video" id="video">
                                    @error('video')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                {{-- PSD --}}
                                <div class="form-group col-md-6">
                                    <label for="psd">PSD</label>
                                    <input type="file" class="form-control rounded-0" name="psd" id="psd">
                                    @error('psd')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                {{-- Product Image --}}
                                <div class="form-group col-md-6">
                                    <label for="image">Product Image</label>
                                    <input type="file" class="form-control rounded-0" name="image" id="image" accept="image/*">
                                    @error('image')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                {{-- Description --}}
                                <div class="form-group col-md-6">
                                    <label for="content">Product Features</label>
                                    <textarea class="form-control rounded-0" name="description" id="content" rows="5"
                                        placeholder="Description"></textarea>
                                    @error('description')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                {{-- Additions --}}
                                <div class="form-group col-md-6">
                                    <label for="Additions">Product Additions</label>
                                    <textarea class="form-control rounded-0" name="additions" id="Additions" rows="5"
                                        placeholder="Additions"></textarea>
                                    @error('additions')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                {{-- Overview --}}
                                <div class="form-group col-md-12">
                                    <label for="Overview">Product Overview</label>
                                    <textarea class="form-control rounded-0" name="overview" id="Overview" rows="5"
                                        placeholder="Overview"></textarea>
                                    @error('overview')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">💾 Submit Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
