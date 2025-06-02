@extends('developer.layout')

@section('content')

<div class="page-content">
    <div class="page-info container py-3">
        {{-- Flash Message --}}
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @if(Session::has('errmsg'))
                    <div class="alert alert-{{ Session::get('message') }} alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>  
                        <strong>{{ Session::get('errmsg') }}</strong>
                    </div>
                    @php
                        Session::forget('message');
                        Session::forget('errmsg');
                    @endphp
                @endif
            </div>
        </div>

        {{-- Breadcrumb --}}
        <div class="row mb-3">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white shadow-sm rounded">
                        <li class="breadcrumb-item"><a href="#">Developer</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    {{-- Dashboard Stats --}}
    <div class="main-wrapper container">
        <div class="row mb-4">
            @php $stats = [
                ['value' => $total_require_docs, 'label' => 'Total Require Document'],
                ['value' => $total_short_message, 'label' => 'Total Short Message'],
                ['value' => $total_sow, 'label' => 'Total SOW'],
                ['value' => $developer_wallet_details->sum('price'), 'label' => 'Total Earning', 'btnClass' => 'danger']
            ]; @endphp

            @foreach($stats as $index => $stat)
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm h-100 hover-shadow">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="font-weight-bold mb-0">
                                    @if(isset($stat['btnClass']))
                                        <span class="badge badge-{{ $stat['btnClass'] }} p-2">{{ $stat['value'] }}</span>
                                    @else
                                        {{ $stat['value'] }}
                                    @endif
                                </h5>
                                <small class="text-muted">{{ $stat['label'] }}</small>
                            </div>
                            <div class="text-muted">
                                <i class="material-icons">trending_up</i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Total Workspace --}}
        <div class="row mb-4">
            <div class="col-lg-3">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <h6 class="text-muted font-weight-bold">Total Work Space</h6>
                        <span class="badge badge-success p-2">{{ $total_work_space }}</span>
                    </div>
                </div>
            </div>

            {{-- Work Details Table --}}
            <div class="col-lg-9">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Work Details
                            <a href="#" class="text-secondary" title="Refresh">
                                <i class="material-icons">refresh</i>
                            </a>
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Size</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($work_space_details->take(5) as $wsd)
                                        <tr>
                                            <td>
                                                @if(empty($wsd->image))
                                                    <video controls style="height:80px" controlsList="nodownload" muted onmouseover="this.play()" onmouseout="this.pause();">
                                                        <source src="{{ asset('public/upload/video/'.$wsd->video) }}" type="video/mp4">
                                                    </video>
                                                @else
                                                    <img src="{{ asset('public/upload/product/'.$wsd->image) }}" class="img-thumbnail" style="height:80px;">
                                                @endif
                                            </td>
                                            <td>{{ $wsd->name }}</td>
                                            <td>${{ $wsd->price }}</td>
                                            <td>{{ $wsd->pro_size }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">No work details found.</td>
                                        </tr>
                                    @endforelse
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
