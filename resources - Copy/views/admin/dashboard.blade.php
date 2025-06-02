@extends('admin.layout')

@section('content')
<!-- <br><br><br><br> -->
<main class="container-fluid py-4">
    {{-- Breadcrumb --}}
    <div class="row mb-4">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light p-2 rounded">
                    <li class="breadcrumb-item"><a href="#">Elements</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(Session::has('errmsg'))
        <div class="alert alert-{{ Session::get('message') }} alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('errmsg') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        {{ Session::forget('message') }}
        {{ Session::forget('errmsg') }}
    @endif

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">
        @php
            $cards = [
                ['route' => 'contactus', 'title' => $total_contact, 'label' => 'Total Contacts'],
                ['route' => 'hig_prof', 'title' => $higher_professional, 'label' => 'Higher Professionals'],
                ['route' => 'products', 'title' => $total_product, 'label' => 'Total Products'],
                ['route' => 'all_visitor', 'title' => $total_visitor, 'label' => 'Total Visitors'],
            ];
        @endphp

        @foreach($cards as $card)
        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <a href="{{ route($card['route']) }}" class="text-decoration-none text-dark">
                    <div class="card-body">
                        <h5 class="card-title">{{ $card['title'] }}</h5>
                        <p class="text-muted mb-0">{{ $card['label'] }}</p>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Savings and Popular Products --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Savings</h5>
                    <h4 class="text-success">
                        ₹ {{ $total_saving->sum('tprice') }}
                    </h4>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Popular Products <span class="text-muted small">(Today)</span></h5>
                    @foreach($popular_product->take(3) as $pp)
                        <div class="d-flex align-items-center mb-3">
                            @if(empty($pp->image))
                                <video width="50" height="50" muted autoplay loop class="rounded">
                                    <source src="{{ asset('public/upload/video/' . $pp->video) }}" type="video/mp4">
                                </video>
                            @else
                                <img src="{{ asset('public/upload/product/' . $pp->image) }}" width="50" height="50" class="rounded me-2">
                            @endif
                            <span class="fw-semibold">{{ $pp->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Transactions --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-between align-items-center">
                        Transactions
                        <a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-arrow-clockwise"></i></a>
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Product</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaction->take(10) as $t)
                                <tr>
                                    <td>{{ $t->order_id }}</td>
                                    <td>{{ $t->name }}</td>
                                    <td>INR {{ $t->tprice }}</td>
                                    <td><span class="badge bg-success">{{ $t->payment_status }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
