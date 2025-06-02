@extends('front.layout')
@section('content')

<section class="contact-hero py-5 bg-gradient-primary text-white" style="margin-top: 140px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="display-4 mb-3">Get in Touch</h1>
                <p class="lead">We'd love to hear from you. Reach out for inquiries, support, or just to say hello.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Contact Information -->
            <div class="col-lg-5 mb-5 mb-lg-0">
                <div class="contact-info-card p-4 h-100 shadow-sm rounded-lg">
                    <h3 class="mb-4">Contact Information</h3>
                    
                    <?php $contact = $cont->first(); ?>
                    <div class="media mb-4">
                        <div class="icon-circle bg-primary text-white mr-3">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                            <h5 class="mt-0 text-dark">Our Location</h5>
                            <p class="text-muted mb-0"><?php echo $contact->address; ?></p>
                        </div>
                    </div>
                    
                    <div class="media mb-4">
                        <div class="icon-circle bg-primary text-white mr-3">
                            <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                            <h5 class="mt-0 text-dark">Phone Number</h5>
                            <p class="text-muted mb-0"><?php echo $contact->phone; ?></p>
                        </div>
                    </div>
                    
                    <div class="media mb-4">
                        <div class="icon-circle bg-primary text-white mr-3">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="media-body">
                            <h5 class="mt-0 text-dark">Email Address</h5>
                            <p class="text-muted mb-0"><?php echo $contact->email; ?></p>
                        </div>
                    </div>
                    
                    <div class="media">
                        <div class="icon-circle bg-primary text-white mr-3">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                            <h5 class="mt-0 text-dark">Working Hours</h5>
                            <p class="text-muted mb-0">Monday - Friday: 9AM - 6PM</p>
                            <p class="text-muted mb-0">Saturday: 10AM - 4PM</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="contact-form-card p-4 h-100 shadow-sm rounded-lg">
                    <h3 class="mb-4">Send Us a Message</h3>
                    
                    @if(Session::has('errmsg'))
                    <div class="alert alert-{{Session::get('message')}} alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>  
                        <strong>{{Session::get('errmsg')}}</strong>
                    </div>
                    {{Session::forget('message')}}
                    {{Session::forget('errmsg')}}
                    @endif
                    
                    <form method="post" action="{{route('submit_query')}}" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Full Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="John Doe" required>
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="john@example.com" required>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone">Phone Number</label>
                                <input type="tel" name="phone" class="form-control" id="phone" maxlength="10" placeholder="1234567890" required>
                                @if ($errors->has('phone'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subject">Subject</label>
                                <input type="text" name="subject" class="form-control" id="subject" placeholder="How can we help?" required>
                                @if ($errors->has('subject'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('subject') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea class="form-control" name="mesage" id="message" rows="5" placeholder="Type your message here..." required></textarea>
                            @if ($errors->has('mesage'))
                                <div class="invalid-feedback d-block">{{ $errors->first('mesage') }}</div>
                            @endif
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg px-4">
                            <i class="fa fa-paper-plane mr-2"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-0">
    <div class="container-fluid px-0">
        <div class="map-container" style="height: 400px;">
            <div id="map" style="height: 100%;"></div>
            <div class="map-overlay d-none d-lg-block">
                <div class="map-overlay-content p-4 bg-white rounded shadow-sm">
                    <h5 class="font-weight-bold mb-3 text-dark">Our Headquarters</h5>
                    <p class="mb-2 text-dark"><i class="fa fa-map-marker-alt text-primary mr-2"></i> <?php echo $contact->address; ?></p>
                    <p class="mb-2 text-dark"><i class="fa fa-phone-alt text-primary mr-2"></i> <?php echo $contact->phone; ?></p>
                    <p class="mb-0 text-dark"><i class="fa fa-envelope text-primary mr-2"></i> <?php echo $contact->email; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .contact-hero {
        padding: 5rem 0;
    }
    
    .contact-info-card, .contact-form-card {
        background: white;
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .contact-info-card:hover, .contact-form-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .icon-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
    
    .map-container {
        position: relative;
    }
    
    .map-overlay {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 1000;
        max-width: 300px;
    }
    
    @media (max-width: 992px) {
        .contact-hero {
            padding: 3rem 0;
        }
        
        .display-4 {
            font-size: 2.5rem;
        }
    }
    
    @media (max-width: 768px) {
        .contact-info-card, .contact-form-card {
            padding: 1.5rem !important;
        }
    }
</style>

<script>
    function initMap() {
        var myLatLng = { lat: 40.7459772, lng: -74.0545504 };
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: myLatLng,
            styles: [
                {
                    "featureType": "all",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {"saturation": 36},
                        {"color": "#333333"},
                        {"lightness": 40}
                    ]
                },
                {
                    "featureType": "all",
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {"visibility": "on"},
                        {"color": "#ffffff"},
                        {"lightness": 16}
                    ]
                },
                {
                    "featureType": "all",
                    "elementType": "labels.icon",
                    "stylers": [
                        {"visibility": "off"}
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {"color": "#fefefe"},
                        {"lightness": 20}
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {"color": "#fefefe"},
                        {"lightness": 17},
                        {"weight": 1.2}
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [
                        {"color": "#f5f5f5"},
                        {"lightness": 20}
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [
                        {"color": "#f5f5f5"},
                        {"lightness": 21}
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {"color": "#ffffff"},
                        {"lightness": 17}
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {"color": "#ffffff"},
                        {"lightness": 29},
                        {"weight": 0.2}
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [
                        {"color": "#ffffff"},
                        {"lightness": 18}
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [
                        {"color": "#ffffff"},
                        {"lightness": 16}
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [
                        {"color": "#f2f2f2"},
                        {"lightness": 19}
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                        {"color": "#e9e9e9"},
                        {"lightness": 17}
                    ]
                }
            ]
        });
        
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: "Our Location",
            icon: {
                url: "https://maps.google.com/mapfiles/ms/icons/blue-dot.png"
            }
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap" async defer></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

@endsection