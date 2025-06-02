@extends('client.layout')
@section('content')

<div class="page-content">
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

    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All resources</a></li>
                <!-- <li class="breadcrumb-item active" aria-current="page">Hired Developers</li> -->
            </ol>
        </nav>
    </div>

    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="hired-developers-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Developer Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hiredDevelopersData as $index => $dev)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $dev->name }} {{ $dev->last_name }}</td>
                                            <td>{{ $dev->phone }}</td>
                                            <td>{{ $dev->email }}</td>
                                            <td><span class="badge badge-success">HIRED</span></td>
                                        </tr>
                                    @endforeach
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

@push('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
<!-- jQuery must come BEFORE DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#hired-developers-table').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            order: [[0, 'asc']],
            responsive: true
        });
    });
</script>
@endpush
