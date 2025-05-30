@extends('front.layout')
@section('content')

<style>
    /* Modern Product Page Styling - Fixed Version */
    .product-header {
        background: #ffffff;
        padding: 50px 0 30px;
        margin-bottom: 30px;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .product-title {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 10px;
        font-size: 2.2rem;
    }
    
    .product-subtitle {
        color: #7f8c8d;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
    }
    
    .media-container {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        margin-bottom: 30px;
        background: #fff;
        border: none;
    }
    
    /* Fixed: Video container height and centering */
    .product-video {
        width: 100%;
        height: 500px;
        background: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    /* Fixed: Image container padding and centering */
    .product-image-container {
        padding: 20px;
        background: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 500px;
    }
    
    .product-image {
        max-width: 100vh !important;
        max-height: 100vh !important;
        object-fit: contain;
    }
    
    /* Fixed: Gallery thumbs styling */
    .gallery-thumbs {
        padding: 15px 0;
        background: #f8f9fa;
    }
    
    .gallery-thumbs .swiper-slide {
        opacity: 0.6;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid transparent;
        border-radius: 4px;
        overflow: hidden;
    }

    .swiper-slide {
            width: 10%;
    }
    
    .gallery-thumbs .swiper-slide:hover, 
    .gallery-thumbs .swiper-slide-thumb-active {
        opacity: 1;
        border-color: #00264d;
    }
    
    .thumb-image {
        width: 100%;
        height: 90px;
        object-fit: cover;
    }
    
    /* Fixed: Button alignment and sizing */
    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
        margin-bottom: 30px;
    }
    
    .action-btn {
        font-weight: 600;
        padding: 12px 30px;
        border-radius: 4px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-size: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        min-width: 200px;
        text-align: center;
    }
    
    .btn-primary {
        background-color: #00264d;
        border-color: #00264d;
    }
    
    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }
    
    .btn-danger {
        background-color: #e74c3c;
        border-color: #e74c3c;
    }
    
    .btn-danger:hover {
        background-color: #c0392b;
        border-color: #c0392b;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }
    
    /* Fixed: Detail card layout */
    .detail-card {
        background: #fff;
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        margin-bottom: 30px;
        border: none;
        height: 100%;
    }
    
    .detail-card-header {
        color: #2c3e50;
        border-bottom: 1px solid #f0f0f0;
        padding-bottom: 15px;
        margin-bottom: 20px;
        font-weight: 700;
        font-size: 1.2rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .detail-list {
        list-style: none;
        padding-left: 0;
    }
    
    .detail-list li {
        padding: 12px 0;
        border-bottom: 1px solid #f5f5f5;
        display: flex;
        align-items: center;
    }
    
    .detail-list li:last-child {
        border-bottom: none;
    }
    
    .detail-label {
        color: #2c3e50;
        min-width: 160px;
        font-weight: 600;
    }
    
    .detail-value {
        color: #7f8c8d;
    }
    
    .detail-value a {
        color: #00264d;
        text-decoration: none;
    }
    
    .detail-value a:hover {
        text-decoration: underline;
    }
    
    /* Fixed: Tab navigation */
    .nav-tabs {
        border-bottom: 2px solid #f0f0f0;
        margin-bottom: 0;
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }
    
    .nav-tabs::-webkit-scrollbar {
        display: none;
    }
    
    .nav-tabs .nav-link {
        color: #7f8c8d;
        font-weight: 600;
        padding: 15px 25px;
        border-radius: 0;
        margin-right: 0;
        border: none;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        white-space: nowrap;
    }
    
    .nav-tabs .nav-link:hover {
        color: #00264d;
        background: rgba(52, 152, 219, 0.05);
    }
    
    .nav-tabs .nav-link.active {
        color: #00264d;
        background: transparent;
        border-bottom: 2px solid #00264d;
    }
    
    /* Fixed: Tab content padding */
    .tab-content {
        padding: 30px;
        background: #fff;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        border: none;
        border-top: none;
        line-height: 1.8;
        color: #555;
    }
    
    /* Fixed: Comment section layout */
    .comment-section {
        background: #fff;
        border-radius: 8px;
        padding: 40px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        margin-top: 50px;
        border: none;
    }
    
    .section-title {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 30px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 1.5rem;
        position: relative;
        padding-bottom: 15px;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: #00264d;
    }
    
    /* Fixed: Comment styling */
    .comment {
        border-left: 3px solid #00264d;
        padding-left: 20px;
        margin-bottom: 30px;
        position: relative;
    }
    
    .comment-header {
        margin-bottom: 15px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }
    
    .comment-author {
        font-weight: 700;
        color: #2c3e50;
        margin-right: 15px;
        font-size: 1.1rem;
    }
    
    .comment-date {
        color: #95a5a6;
        font-size: 13px;
    }
    
    .comment-text {
        color: #555;
        line-height: 1.8;
    }
    
    /* Fixed: Reply styling */
    .reply {
        margin-left: 30px;
        margin-top: 25px;
        padding-left: 20px;
        border-left: 2px solid #e9ecef;
    }
    
    .reply-form {
        margin-top: 20px;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 4px;
    }
    
    /* Fixed: Rating stars alignment */
    .rating-stars {
        font-size: 28px;
        margin: 30px 0;
        text-align: center;
        display: flex;
        justify-content: center;
        gap: 5px;
    }
    
    .rating-stars a {
        color: #f1c40f;
        text-decoration: none;
        transition: all 0.3s ease;
        line-height: 1;
    }
    
    .rating-stars a:hover {
        transform: scale(1.2);
    }
    
    .rating-stars i.fa-star {
        color: #f1c40f;
    }
    
    .rating-stars i.fa-star-o {
        color: #ddd;
    }
    
    /* Fixed: Form controls */
    .form-control {
        border-radius: 4px;
        padding: 12px 15px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        border-color: #00264d;
    }
    
    .alert {
        border-radius: 4px;
        padding: 15px 20px;
    }
    
    /* Responsive adjustments - Fixed */
    @media (max-width: 992px) {
        .product-video, .product-image-container {
            height: 400px;
        }
        
        .action-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .action-btn {
            width: 100%;
            max-width: 300px;
        }
    }
    
    @media (max-width: 768px) {
        .product-video, .product-image-container {
            height: 350px;
        }
        
        .detail-list li {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .detail-label {
            margin-bottom: 5px;
            min-width: auto;
        }
        
        .comment-section {
            padding: 25px;
        }
        
        .reply {
            margin-left: 15px;
        }
    }
    
    @media (max-width: 576px) {
        .product-video, .product-image-container {
            height: 250px;
        }
        
        .product-title {
            font-size: 1.8rem;
        }
        
        .section-title {
            font-size: 1.3rem;
        }
        
        .rating-stars {
            font-size: 24px;
        }
    }

    /* Gallery container */
.gallery-top {
    height: 80vh;  /* Better than 100vh to account for other page elements */
}

/* Slides */
.swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}

/* Images */
.product-image {
    width: 100%;
    height: 80vh;
    object-fit: contain;
}

/* Thumbnail active state */
.swiper-slide-thumb-active {
    opacity: 1 !important;
    border: 2px solid #00264d;
}

/* Navigation buttons */
.swiper-button-next,
.swiper-button-prev {
    background-color: rgba(255,255,255,0.7);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    color: #00264d;
}
</style>

<section class="product-header">
    <div class="container">
        <?php foreach($allproduct as $ap) { ?>
            <h1 class="product-title text-center"><?php echo $ap->name; ?></h1>
            <?php if($ap->video == ''): ?>
                <p class="product-subtitle text-center">FILE TYPE: <?php echo $ap->pro_type; ?></p>
            <?php endif; ?>
        <?php } ?>
        
        @if(Session::has('errmsg'))
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="alert alert-{{Session::get('message')}} alert-dismissible fade show mt-5">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{Session::get('errmsg')}}
                </div>
                {{Session::forget('message')}}
                {{Session::forget('errmsg')}}
            </div>
        </div>
        @endif
    </div>
</section>

<div class="container">
    <!-- Product Media Gallery - Fixed -->
    <div class="">
        <div class="">
            <div class="media-container">
                @if(!empty($ap->video) && empty($ap->multiple_image) || empty($ap->image))
                    <video class="product-video" controls controlsList="nodownload">
                        <source src="{{ URL::asset('public/upload/video/'.$ap->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @elseif(empty($ap->multiple_image) && !empty($ap->image))
                    <div class="product-image-container">
                        <img src="{{ URL::asset('public/upload/product/'.$ap->image) }}" class="product-image" alt="{{ $ap->name }}">
                    </div>
                @elseif(!empty($ap->multiple_image) || empty($ap->video))
                    @php
                        $images = explode(',', $ap->multiple_image);
                    @endphp
                    <div class="product-gallery">
                        <div class="swiper-container gallery-top">
                            <div class="swiper-wrapper">
                                @foreach($images as $image)
                                    <div class="swiper-slide">
                                        <div class="product-image-container">
                                            <img src="{{ URL::asset('public/upload/product/'.$image) }}" class="product-image" alt="{{ $ap->name }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next swiper-button-white"></div>
                            <div class="swiper-button-prev swiper-button-white"></div>
                        </div>
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                @foreach($images as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ URL::asset('public/upload/product/'.$image) }}" class="thumb-image" alt="Thumbnail">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Product Actions - Fixed -->
    <div class="row">
        <div class="col-12">
            <div class="action-buttons">
                @if($product_purchase > 0)
                    <a href="{{route('download', $ap->id )}}" class="btn btn-danger action-btn">
                        <i class="fa fa-download"></i> Download Now
                    </a>
                    @if($ap->video != '')
                        <a href="{{route('product_show', ['id' => $ap->id])}}" target="_blank" class="btn btn-primary action-btn">
                            <i class="fa fa-eye"></i> Live Preview
                        </a>
                    @else
                        <a href="<?php echo $ap->link; ?>" target="_blank" class="btn btn-primary action-btn">
                            <i class="fa fa-eye"></i> Live Preview
                        </a>
                    @endif
                @elseif($product_go_to_cart > 0)
                    @if($ap->video != '')
                        <a href="{{route('product_show', ['id' => $ap->id])}}" target="_blank" class="btn btn-danger action-btn">
                            <i class="fa fa-eye"></i> Live Preview
                        </a>
                    @else
                        <a href="<?php echo $ap->link; ?>" target="_blank" class="btn btn-danger action-btn">
                            <i class="fa fa-eye"></i> Live Preview
                        </a>
                    @endif
                    <a href="{{route('cart')}}" class="btn btn-primary action-btn">
                        <i class="fa fa-shopping-cart"></i> Go To Cart
                    </a>
                @else
                    @if(empty(Session::get('user_login_id')))
                        <a href="{{route('registration')}}" class="btn btn-primary action-btn add_to_cart" value="{{$ap->id}}">
                            <i class="fa fa-cart-plus"></i> Add To Cart
                        </a>
                    @else
                        <a href="javascript:void(0);" class="btn btn-primary action-btn add_to_cart" value="{{$ap->id}}">
                            <i class="fa fa-cart-plus"></i> Add To Cart
                        </a>
                    @endif
                        @if($ap->video != '')
                        <a href="{{route('product_show', ['id' => $ap->id])}}" target="_blank" class="btn btn-primary action-btn">
                            <i class="fa fa-eye"></i> Live Preview
                        </a>
                    @else
                        <a href="<?php echo $ap->link; ?>" target="_blank" class="btn btn-primary action-btn">
                            <i class="fa fa-eye"></i> Live Preview
                        </a>
                    @endif
                @endif
                
            </div>
        </div>
    </div>
    
    <!-- Star Rating Display -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <div class="rating-stars d-inline-block">
                @if ($rate_value > 0 && count($rate))
                    @php $avgRating = round($rate->avg('rating')) @endphp
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $avgRating)
                            <i class="fa fa-star text-warning fa-lg"></i>
                        @else
                            <i class="fa fa-star-o text-muted fa-lg"></i>
                        @endif
                    @endfor
                    <div class="mt-2 text-muted small">Average Rating: {{ $avgRating }}/5</div>
                @else
                    @for ($i = 1; $i <= 5; $i++)
                        <a href="javascript:void(0);" class="stars text-warning" data-value="{{ $i }}">
                            <i class="fa fa-star-o fa-lg"></i>
                        </a>
                    @endfor
                    <div class="mt-2 text-muted small">No ratings yet</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Product Details Section - Fixed -->
   <div class="row mt-4">
    <div class="col-lg-4 col-md-5">
        <div class="detail-card">
            <h5 class="detail-card-header">Template Details</h5>

            @foreach($allproduct as $ap)
                <ul class="detail-list">
                    <li>
                        <span class="detail-label">Size:</span>
                        <span class="detail-value">{{ $ap->pro_size }}</span>
                    </li>
                    <li>
                        <span class="detail-label">Price:</span>
                        <span class="detail-value">
                            ₹{{ number_format($ap->price, 2, '.', ',') }}
                        </span>
                    </li>
                    @if(!empty($ap->resolution))
                        <li>
                            <span class="detail-label">Resolution:</span>
                            <span class="detail-value">{{ $ap->resolution }}</span>
                        </li>
                    @endif
                    <li>
                        <span class="detail-label">License:</span>
                        <span class="detail-value">
                            <a href="{{ route('commercial_license') }}">Commercial License</a>
                        </span>
                    </li>
                </ul>
            @endforeach
        </div>
    </div>

    <div class="col-lg-8 col-md-7">
        <ul class="nav nav-tabs" id="productTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab">Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="addition-tab" data-toggle="tab" href="#addition" role="tab">Addition</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="features-tab" data-toggle="tab" href="#features" role="tab">Features</a>
            </li>
        </ul>

        <div class="tab-content" id="productTabsContent">
            @foreach($allproduct as $ap)
                <div class="tab-pane fade show active" id="overview" role="tabpanel">
                    <p>{!! $ap->overview !!}</p>
                </div>
                <div class="tab-pane fade" id="addition" role="tabpanel">
                    <p>{!! $ap->additions !!}</p>
                </div>
                <div class="tab-pane fade" id="features" role="tabpanel">
                    <p>{!!$ap->description !!}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>


    <!-- Comments Section - Fixed -->
    <div class="comment-section container py-5">
    <h3 class="mb-4 text-center font-weight-bold border-bottom pb-2">🗨️ Customer Reviews</h3>

    {{-- Display Comments --}}
    @foreach ($comment as $com)
        @if ($ap->id === $com->p_id)
            <div class="card mb-4 border-0 shadow rounded">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="font-weight-bold mb-1 text-dark">{{ $com->name }}</h6>
                            <small class="text-muted text-dark">{{ $com->date }}</small>
                        </div>
                        <span class="badge badge-info align-self-start">Verified</span>
                    </div>
                    <p class="mt-3 mb-2 text-dark">{{ $com->comment }}</p>

                    {{-- Replies --}}
                    @foreach ($reply_comm as $reply_com)
                        @if ($ap->id === $reply_com->p_id && $reply_com->comment_id === $com->id)
                            <div class="bg-light p-3 rounded mt-3 ml-3">
                                <div class="d-flex justify-content-between">
                                    <span class="text-primary font-weight-bold">Admin</span>
                                    <small class="text-muted text-dark">{{ $reply_com->date }}</small>
                                </div>
                                <p class="mb-0 mt-2 text-dark">{{ $reply_com->reply_comment }}</p>
                            </div>
                        @endif
                    @endforeach

                    {{-- Reply Form --}}
                    <form method="POST" action="{{ route('reply') }}" class="mt-4 border-top pt-3">
                        @csrf
                        <input type="hidden" name="p_id" value="{{ $ap->id }}">
                        <input type="hidden" name="comment_id" value="{{ $com->id }}">

                        <div class="form-group">
                            <textarea name="reply_comment" class="form-control rounded" rows="2" placeholder="Write a reply..." required></textarea>
                            @error('reply_comment')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="text-right">
                            <button class="btn btn-sm btn-outline-primary">Reply</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endforeach

    {{-- Leave a Review --}}
    <div class="mt-5">
        <h4 class="mb-4 text-center font-weight-bold border-bottom pb-5 text-dark">📝 Leave a Review</h4>

        @if (Session::has('errmsg'))
            <div class="alert alert-{{ Session::get('message') }} alert-dismissible fade show">
                {{ Session::get('errmsg') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            {{ Session::forget('message') }}
            {{ Session::forget('errmsg') }}
        @endif

        <form method="POST" action="{{ route('leave_comment') }}" class="bg-white p-4 shadow rounded">
            @csrf
            <input type="hidden" name="p_id" value="{{ $ap->id }}">

            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" name="name" class="form-control rounded" placeholder="Your Name" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <input type="email" name="email" class="form-control rounded" placeholder="Your Email" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <textarea name="comment" class="form-control rounded" rows="4" placeholder="Your review..." required></textarea>
                @error('comment')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4 py-2">Submit Review</button>
            </div>
        </form>
    </div>
</div>

</div>

<script>
    $(document).ready(function() {
        var galleryThumbs = new Swiper('.gallery-thumbs', {
            spaceBetween: 10,
            slidesPerView: 5,
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            breakpoints: {
                992: {
                    slidesPerView: 4,
                },
                768: {
                    slidesPerView: 3,
                },
                576: {
                    slidesPerView: 2,
                }
            }
        });
        
        var galleryTop = new Swiper('.gallery-top', {
            spaceBetween: 10,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            thumbs: {
                swiper: galleryThumbs
            },
            // Better approach - set slide dimensions in Swiper config
            slidesPerView: 1,
            centeredSlides: true,
            slideToClickedSlide: true
        });
        
        // Ensure images are properly loaded
        $('.product-image').on('load', function() {
            galleryTop.update();
            galleryThumbs.update();
            
            // Better image styling approach
        
        });

        
    });
    
    $(document).on('click', '.stars', function() {
    var rating = $(this).data('value'); 
    console.log(rating)
    var v_token = "{{ csrf_token() }}";

    $.ajax({
        type: "POST",
        url: "{{ route('submit_rating') }}",
        data: { rating: rating, _token: v_token },
        beforeSend: function() {
            $('.rating-stars').html('<i class="fa fa-spinner fa-spin"></i>');
        },
        success: function(response) {
            console.log(response);
            // Optionally reload or update UI
        },
        error: function(xhr) {
            console.log(xhr);
            alert('Error submitting rating. Please try again.');
        }
    });
});

</script>

@endsection