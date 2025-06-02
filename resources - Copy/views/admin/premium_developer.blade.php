@extends('admin.layout')
@section('content')

<!-- Include DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-2">
                <li class="breadcrumb-item"><a href="#">Premium Developer</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>

    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card shadow-sm rounded">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Premium Developer Details</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="complex-header" class="table table-hover table-bordered mb-0">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-white">Sl. No.</th>
                                        <th class="text-white">Order ID</th>
                                        <th class="text-white">Full Name</th>
                                        <th class="text-white">Email</th>
                                        <th class="text-white">Phone</th>
                                        <th class="text-white">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($premium_developer_details as $index => $pp)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $pp->order_id }}</td>
                                            <td>{{ $pp->name }} {{ $pp->last_name }}</td>
                                            <td>{{ $pp->email }}</td>
                                            <td>{{ $pp->phone }}</td>
                                            <td>
                                                <button 
                                                    class="btn btn-sm btn-info view-details-btn" 
                                                    data-toggle="modal" 
                                                    data-target="#detailsModal"
                                                    data-details='@json($pp)'
                                                    title="View Details"
                                                >
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">No records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-right">
                        Last updated: {{ now()->format('d M Y, h:i A') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Developer Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="detailsModalLabel">Developer Full Details</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <tbody>
                        <tr><th>Order ID</th><td id="modal-order-id"></td></tr>
                        <tr><th>Name</th><td id="modal-name"></td></tr>
                        <tr><th>Email</th><td id="modal-email"></td></tr>
                        <tr><th>Phone</th><td id="modal-phone"></td></tr>
                        <tr><th>Country</th><td id="modal-country"></td></tr>
                        <tr><th>State</th><td id="modal-state"></td></tr>
                        <tr><th>City</th><td id="modal-city"></td></tr>
                        <tr><th>Pincode</th><td id="modal-code"></td></tr>
                        <tr><th>Price</th><td id="modal-price"></td></tr>
                        <tr><th>Status</th><td id="modal-status"></td></tr>
                        <tr><th>Payment</th><td id="modal-payment"></td></tr>
                        <tr><th>Date</th><td id="modal-date"></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<!-- Moment.js for date formatting -->
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

<!-- DataTables & Modal Script -->
<script>
    $(document).ready(function () {
        $('#complex-header').DataTable({
            "pageLength": 10,
            "order": [],
            "language": {
                "search": "Search records:"
            }
        });

        $('.view-details-btn').on('click', function () {
            const data = $(this).data('details');

            $('#modal-order-id').text(data.order_id ?? '');
            $('#modal-name').text((data.name ?? '') + ' ' + (data.last_name ?? ''));
            $('#modal-email').text(data.email ?? '');
            $('#modal-phone').text(data.phone ?? '');
            $('#modal-country').text(data.country ?? '');
            $('#modal-state').text(data.state ?? '');
            $('#modal-city').text(data.city ?? '');
            $('#modal-code').text(data.code ?? '');
            $('#modal-price').text('₹' + parseFloat(data.tprice ?? 0).toFixed(2));
            $('#modal-status').html(`<span class="badge ${data.status === 'active' ? 'badge-success' : 'badge-warning'}">${data.status}</span>`);
            $('#modal-payment').html(`<span class="badge ${data.payment_status === 'SUCCESS' ? 'badge-success' : 'badge-danger'}">${data.payment_status}</span>`);
            $('#modal-date').text(moment(data.date).format('D MMM YYYY, h:mm A'));
        });
    });
</script>

@endsection
