@extends('front.layout')

@section('content')
<style>
    /* Custom Color Variables */
    :root {
        --primary-color: #00264d;
        --secondary-color: #3498db;
        --accent-color: #ff6b35;
        --light-bg: #f8fafc;
        --dark-text: #2d3748;
        --muted-text: #4a5568;
    }
    
    /* Base Styles */
    body {
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
        color: var(--dark-text);
    }
    
    /* Banner Styles */
    .hero-banner {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .banner-img {
        width: 100%;
        height: 500px;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    
    .owl-carousel .item:hover .banner-img {
        transform: scale(1.05);
    }
    
    .banner-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 100%);
        padding: 2rem;
        color: white;
    }
    
    /* Section Headers */
    .section-header {
        position: relative;
        margin-bottom: 3rem;
    }
    
    .section-title {
        font-weight: 700;
        color: var(--primary-color);
        position: relative;
        display: inline-block;
        margin-bottom: 1rem;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        border-radius: 2px;
    }
    
    .section-subtitle {
        color: var(--muted-text);
        font-weight: 400;
        font-size: 1.2rem;
    }
    
    /* Professional Cards */
    .professional-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
    }
    
    .professional-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .professional-image-wrapper {
        position: relative;
        padding-top: 100%;
        overflow: hidden;
        background: #f1f5f9;
    }
    
    .professional-image-wrapper img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .professional-card:hover .professional-image-wrapper img {
        transform: scale(1.08);
    }
    .product-image {
        width: 100% !important;
        height: 100% !important;
    }
    
    .professional-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 38, 77, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .professional-card:hover .professional-overlay {
        opacity: 1;
    }
    
    .view-btn {
        padding: 8px 16px;
        background: white;
        color: var(--primary-color);
        border-radius: 30px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .view-btn:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
    }
    
    .professional-name {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .professional-name a {
        color: var(--dark-text);
        transition: color 0.3s ease;
    }
    
    .professional-name a:hover {
        color: var(--primary-color);
        text-decoration: none;
    }
    
    /* Benefit Cards */
    .benefit-card {
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        border: none;
        border-radius: 10px;
        padding: 2rem 1.5rem;
        height: 100%;
        background: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
    }
    
    .benefit-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
    }
    
    .benefit-icon {
        width: 70px;
        height: 70px;
        font-size: 30px;
        background: rgba(0, 38, 77, 0.1);
        color: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        transition: all 0.3s ease;
    }
    
    .benefit-card:hover .benefit-icon {
        background: var(--primary-color);
        color: white;
        transform: rotateY(180deg);
    }
    
    .benefit-title {
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--primary-color);
    }
    
    /* Product Cards */
    .product-card {
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.4s ease;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
    }
    
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .product-media {
        position: relative;
        padding-top: 75%;
        overflow: hidden;
        background: #f1f5f9;
    }
    
    .product-image, .product-video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .product-card:hover .product-image {
        transform: scale(1.1);
    }
    
    .product-title {
        font-weight: 600;
        color: var(--dark-text);
        transition: color 0.3s ease;
    }
    
    .product-card:hover .product-title {
        color: var(--primary-color);
    }
    
    .product-price {
        color: var(--accent-color);
        font-weight: 700;
    }
    
    /* Testimonial Cards */
    .testimonial-card {
        border: none;
        border-radius: 10px;
        background: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        padding: 4rem 0;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .cta-section::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .cta-section::after {
        content: '';
        position: absolute;
        bottom: -80px;
        left: -80px;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }
    
    /* Partners Section */
    .partner-tile {
        transition: all 0.4s ease;
        border-radius: 10px;
        padding: 1.5rem;
        background: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    
    .partner-tile:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .partner-logo-wrapper {
        height: 80px;
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    .partner-tile img {
        max-height: 100%;
        max-width: 100%;
        width: auto;
        filter: grayscale(100%);
        opacity: 0.7;
        transition: all 0.4s ease;
    }
    
    .partner-tile:hover img {
        filter: grayscale(0%);
        opacity: 1;
        transform: scale(1.1);
    }
    
    /* Buttons */
    .btn-gradient {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.4s ease;
        box-shadow: 0 5px 15px rgba(0, 38, 77, 0.2);
    }
    
    .btn-gradient:hover {
        background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 38, 77, 0.3);
    }
    
    .btn-light {
        background: white;
        color: var(--primary-color);
        font-weight: 600;
        border-radius: 50px;
        padding: 0.75rem 2rem;
        transition: all 0.3s ease;
    }
    
    .btn-light:hover {
        background: var(--primary-color);
        color: white;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .banner-img {
            height: 300px;
        }
        
        .section-title {
            font-size: 1.8rem;
        }
        
        .section-subtitle {
            font-size: 1.1rem;
        }
        
        .professional-card, .benefit-card, .product-card {
            margin-bottom: 1rem;
        }
    }
    
    @media (max-width: 575.98px) {
        .banner-img {
            height: 250px;
        }
        
        .section-header {
            margin-bottom: 2rem;
        }
    }
</style>

<!-- Hero Banner Carousel -->
<section class="header-content py-0 mb-5">
    <div class="container-fluid px-lg-5">
        <div class="owl-carousel owl-theme owl-slider">
            @foreach($banner as $b)
                <div class="item hero-banner">
                    <img src="{{ asset('public/upload/banner/' . $b->image) }}" alt="Banner" class="banner-img">
                    <div class="banner-overlay">
                        <div class="container">
                            <h2 class="text-white font-weight-bold mb-2">Find Top Talent</h2>
                            <p class="lead text-white mb-0">Hire pre-vetted professionals for your projects</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Professionals Section -->
<section class="py-5">
    <div class="container">
        <div class="section-header text-center">
            <h2 >Hire High-Performance Individuals & Teams</h2>
            <p class="section-subtitle">On your terms, when you need them</p>
        </div>

        <div class="row">
            @forelse($higher_professional_show as $hp)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="professional-card">
                        <a href="{{ route('dev_details', $hp->id) }}" class="professional-image-link">
                            <div class="professional-image-wrapper">
                                <img src="{{ asset('public/upload/hig_prof/' . $hp->image) }}"
                                     class="card-img-top"
                                     alt="{{ $hp->heading }}"
                                     loading="lazy">
                                <div class="professional-overlay">
                                    <span class="view-btn">View Profile</span>
                                </div>
                            </div>
                        </a>
                        <div class="card-body text-center">
                            <h5 class="professional-name mb-1">
                                <a href="{{ route('dev_details', $hp->id) }}">{{ $hp->heading }}</a>
                            </h5>
                            <p class="text-muted small mb-0">{{ $hp->designation ?? 'Professional' }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4">
                    <div class="alert alert-info">No professionals available at the moment. Check back soon!</div>
                </div>
            @endforelse
        </div>

        @if($higher_professional_show->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $higher_professional_show->links('pagination::bootstrap-4') }}
            </div>
        @endif
        
        <div class="text-center mt-5">
            <a href="{{url('higher_professional')}}" class="btn btn-gradient px-4">
                Browse All Professionals <i class="fa fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 >Why Choose Our Platform?</h2>
            <p class="section-subtitle">We make hiring exceptional talent simple and risk-free</p>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="benefit-card text-center">
                    <div class="benefit-icon">
                        <i class="fa fa-money"></i>
                    </div>
                    <h5 class="benefit-title">Hire with confidence</h5>
                    <p class="text-muted">no upfront costs! Find the right candidates for your open positions, assess their fit, and pay only for the work you approve.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="benefit-card text-center">
                    <div class="benefit-icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <h5 class="benefit-title">Schedule & Conduct Interviews</h5>
                    <p class="text-muted">Gain insights into the quality of work you can expect when you hire through Talent Finder.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="benefit-card text-center">
                    <div class="benefit-icon">
                        <i class="fa fa-handshake-o"></i>
                    </div>
                    <h5 class="benefit-title">Hire a Pro</h5>
                    <p class="text-muted">We connect busy professionals with the right opportunities, customizing solutions to fit your needs and fostering lasting partnerships for success..</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="benefit-card text-center">
                    <div class="benefit-icon">
                        <i class="fa fa-shield"></i>
                    </div>
                    <h5 class="benefit-title"> Take full control </h5>
                    <p class="text-muted">Take full control of when, where, and how you work! Mellow Vault ensures the perfect talent match for every role, boosting efficiency and meeting critical deadlines.</p>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Products Section -->
<section class="py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 >Create Success Stories</h2>
            <p class="section-subtitle">Hire Developers & Marketers | Instant Interviews | Fast & Reliable Hiring</p>
            <p class="lead text-muted mx-auto" style="max-width: 700px;">
                Work with hand-picked talent, tailored to fit your scale and needs.
            </p>
        </div>

        <div class="row">
            @forelse($allproduct as $product)
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="product-card h-100">
                        <a href="{{ route('product_details', $product->id) }}" class="text-decoration-none">
                            <div class="product-media">
                                @if(empty($product->image))
                                    <div class="video-wrapper">
                                        <video class="product-video" controls controlsList="nodownload">
                                            <source src="{{ asset('public/upload//' . $product->video) }}" type="video/mp4">
                                        </video>
                                    </div>
                                @else
                                    <img src="{{ asset('public/upload/product/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="product-image">
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="product-title mb-1">{{ $product->name }}</h5>
                                @if($product->price)
                                    <div class="product-price mt-2">${{ number_format($product->price, 2) }}</div>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4">
                    <div class="alert alert-info">No products available at the moment. Check back soon!</div>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-4">
            <a href="{{url('subproduct/16')}}" class="btn btn-gradient px-4">
                View All Products <i class="fa fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 >What Our Clients Say</h2>
            <p class="section-subtitle">Trusted by businesses worldwide</p>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="testimonial-card h-100 p-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <i class="fa fa-quote-left text-muted"></i>
                            <p class="d-inline-block pl-2 mb-0">The developers we hired through this platform exceeded our expectations. Their expertise helped us launch our product ahead of schedule.</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle mr-3" width="50" alt="Client">
                            <div>
                                <h6 class="mb-0">John Smith</h6>
                                <small class="text-muted">CEO, TechStart Inc.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="testimonial-card h-100 p-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <i class="fa fa-quote-left text-muted"></i>
                            <p class="d-inline-block pl-2 mb-0">The hiring process was incredibly smooth. We found the perfect candidate within 48 hours and they've been a valuable addition to our team.</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle mr-3" width="50" alt="Client">
                            <div>
                                <h6 class="mb-0">Sarah Johnson</h6>
                                <small class="text-muted">CTO, Digital Solutions</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="testimonial-card h-100 p-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <i class="fa fa-quote-left text-muted"></i>
                            <p class="d-inline-block pl-2 mb-0">The quality of talent on this platform is exceptional. We've hired multiple developers and each one has delivered outstanding work.</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="https://randomuser.me/api/portraits/men/75.jpg" class="rounded-circle mr-3" width="50" alt="Client">
                            <div>
                                <h6 class="mb-0">Michael Chen</h6>
                                <small class="text-muted">Product Manager, InnovateCo</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h2 class="text-white mb-3">Ready to Find Your Perfect Hire?</h2>
                <p class="lead mb-0 text-white-50">Join thousands of companies who have hired top talent through our platform.</p>
            </div>
            <div class="col-lg-4 text-lg-right">
                <a href="{{ route('registration') }}" class="btn btn-light btn-lg px-4">Get Started Now</a>
            </div>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section class="py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 >Trusted by Industry Leaders</h2>
            <p class="section-subtitle">We collaborate with top organizations to deliver exceptional results</p>
        </div>

        <div class="row justify-content-center">
            @php
                $partners = [
                    [
                        'logo' => 'https://mellowcorporation.com/public/upload/header/1628345113.png',
                        'name' => 'Mellow Corporation',
                        'url' => 'https://mellowcorporation.com/'
                    ],
                    [
                        'logo' => 'https://seminator.in/images/logo.png',
                        'name' => 'Seminator Infosystem Pvt Ltd.',
                        'url' => 'https://seminator.in/'
                    ],
                    [
                        'logo' => 'http://mellowacademy.com/public/front/images/logo.png',
                        'name' => 'Mellow Academy',
                        'url' => 'http://mellowacademy.com/'
                    ],
                    [
                        'logo' => 'https://via.placeholder.com/300x150?text=James+Sheldon',
                        'name' => 'James E. Sheldon',
                        'url' => '#'
                    ]
                ];
            @endphp
            
            @foreach($partners as $partner)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <a href="{{ $partner['url'] }}" target="_blank" class="partner-tile">
                    <div class="partner-logo-wrapper">
                        <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }} Logo" loading="lazy">
                    </div>
                    <h6 class="text-center mb-0">{{ $partner['name'] }}</h6>
                </a>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('registration') }}" class="btn btn-gradient px-4">
                Become a Partner <i class="fa fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        $('.owl-slider').owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            responsive: {
                0: { items: 1 },
                768: { items: 1 },
                1200: { items: 1 }
            }
        });
        
        // Add smooth scrolling to all links
        $("a").on('click', function(event) {
            if (this.hash !== "") {
                event.preventDefault();
                var hash = this.hash;
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function(){
                    window.location.hash = hash;
                });
            }
        });
    });
</script>

@endsection