@extends('front.layout')
@section('content')

<section class="products developer py-5 bg-light">

    @if(count($higher_professional) > 0)
        @php $data = $higher_professional[0]->heading; @endphp
        <header class="mb-5 text-center">
            <div class="container">
                <h2 class="font-weight-bold mb-2">Hire the Best {{ $data }}</h2>
                <p class="text-muted lead">Hire in 24 Hrs — from a pool of 60,000+ professionals across 10+ categories.</p>
            </div>
        </header>
    @endif

    <div class="container">
        @if($developer == 0)
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <img src="{{ asset('public/front/assets/images/nodeveloper.png') }}" class="rounded-circle mb-4" width="230" height="200" alt="No Developer">
                    <h5 class="text-danger font-weight-bold">Seems, Developers are Occupied With Others. We will Notify You Shortly!!</h5>
                </div>
            </div>
        @else
            <div class="row">
                @foreach($developer_details as $dev)
                    @php $url = route('developer_detail', ['id' => $dev->dev_id]); @endphp
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm border-0 developer-card transition">
                            <div class="card-body text-center">
                                <a href="{{ $url }}">
                                    <img src="{{ $dev->image ? asset('public/upload/developer/' . $dev->image) : asset('public/upload/profile_image/1640871620.png') }}"
                                         class="rounded-circle mb-3 shadow" width="100" height="100" alt="{{ $dev->name }}">
                                </a>
                                <h5 class="mb-1">
                                    <a href="{{ $url }}" class="text-dark font-weight-bold">{{ $dev->name }}</a>
                                </h5>
                                <p class="text-primary small mb-2">{{ $dev->heading }}</p>
                                <div class="mb-2">
                                    <span class="badge badge-warning"><i class="fa fa-star"></i> {{ $dev->rating }}/5</span>
                                    <small class="text-muted">({{ $dev->job }} Jobs)</small>
                                </div>
                                <p class="mb-3"><span class="badge badge-success" style="font-size: medium;">₹{{ number_format($dev->perhr, 2) }} / Month</span></p>
                                <a href="{{ $url }}" class="btn btn-outline-primary btn-sm">View Profile</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<style>
    .developer-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .developer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    .developer-card .card-body {
        padding: 1.5rem;
    }
</style>

@endsection
