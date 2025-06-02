@extends('front.layout')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@section('content')
<br>
<br>
<br>
<br>
<br>
<br>
<div class="container pt-4">
    @foreach ($developer_resource as $resource)
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Developer Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Full Name:</strong> {{ $resource->name }} {{ $resource->last_name }}</p>
                            </div>
                        </div>

                        <ul class="nav nav-tabs mb-3" id="profileTabs-{{ $loop->index }}" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="docs-tab-{{ $loop->index }}" data-bs-toggle="tab" data-bs-target="#docs-{{ $loop->index }}" type="button" role="tab">Require Docs</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="message-tab-{{ $loop->index }}" data-bs-toggle="tab" data-bs-target="#message-{{ $loop->index }}" type="button" role="tab">Short Message</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="sow-tab-{{ $loop->index }}" data-bs-toggle="tab" data-bs-target="#sow-{{ $loop->index }}" type="button" role="tab">SOW</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="profileTabsContent-{{ $loop->index }}">
                            {{-- Require Docs Tab --}}
                            <div class="tab-pane fade show active" id="docs-{{ $loop->index }}" role="tabpanel">
                                <div class="row">
                                    @foreach ($require_docs_details as $require)
                                        <div class="col-md-6 mb-3">
                                            <div class="border p-3 rounded">
                                                <h6>{{ $require->subject }}</h6>
                                                <small><i class="fa fa-clock-o"></i> {{ $require->date }}</small>
                                                <br>
                                                <a href="{{ route('require_docs_download', $require->id) }}" class="btn btn-sm btn-primary mt-2">
                                                    <i class="fa fa-download"></i> Download
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Short Message Tab --}}
                            <div class="tab-pane fade" id="message-{{ $loop->index }}" role="tabpanel">
                                <div class="border p-3 rounded" style="max-height: 350px; overflow-y: auto;">
                                    @foreach ($short_message_details as $short)
                                        <div class="mb-3 p-2 border-bottom">
                                            <h6 class="mb-1">{{ $short->subject }}</h6>
                                            <small class="text-muted">{{ $short->date }}</small>
                                            <p class="mt-2">{!! $short->description !!}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- SOW Tab --}}
                            <div class="tab-pane fade" id="sow-{{ $loop->index }}" role="tabpanel">
                                <div class="row">
                                    @foreach ($sow_details as $sow)
                                        <div class="col-md-6 mb-3">
                                            <div class="border p-3 rounded">
                                                <h6>{{ $sow->subject }}</h6>
                                                <small><i class="fa fa-clock-o"></i> {{ $sow->date }}</small>
                                                <br>
                                                <a href="{{ route('sow_docs_download', $sow->id) }}" class="btn btn-sm btn-primary mt-2">
                                                    <i class="fa fa-download"></i> Download
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div> <!-- tab-content -->
                    </div> <!-- card-body -->
                </div>
            </div>
        </div>
    @endforeach
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
