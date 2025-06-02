@extends('admin.layout')
@section('content')

<div class="page-content" style="">
    <div class="main-wrapper container">   
        <div class="row">
            <div class="col-xl">
                <div class="row">
                    <div class="col-lg-8 ml-auto mr-auto">
                        @if(Session::has('errmsg'))                 
                            <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                                <strong>{{Session::get('errmsg')}}</strong>
                            </div>
                            {{Session::forget('message')}}
                            {{Session::forget('errmsg')}}
                        @endif
                        <br><br>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Employee Salary Due</h5>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">  
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Developer ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($payout as $payment)
                                            <tr>
                                                <td>{{ $payment->u_id }}</td>
                                                <td>{{ $payment->fname }} {{ $payment->lname }}</td>
                                                <td>{{ $payment->email }}</td>
                                                <td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-info btn-sm view-details" 
                                                            data-id="{{ $payment->u_id }}"
                                                            title="View Details">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        
                                                        <button type="button" class="btn btn-primary btn-sm send-email">
                                                            <i class="fas fa-envelope"></i>
                                                        </button>

                                                    </div>
                                                </td>
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
    </div>
</div>

<!-- Modal for View Details -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Payment Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailsContent">
                Loading details...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // View Details button click
        $('.view-details').on('click', function() {
            var userId = $(this).data('id');
            
            // Show loading in modal
            $('#detailsContent').html('Loading details...');
            $('#detailsModal').modal('show');
            
            // AJAX call to get details
            $.get("{{ url('employee-salary-due-id') }}/" + userId, function(data) {
                $('#detailsContent').html(data);
            }).fail(function() {
                $('#detailsContent').html('Failed to load details. Please try again.');
            });
        });
        
        // Send Email button click
        $('.send-email').on('click', function() {
            var userId = $(this).data('id');
            var userEmail = $(this).data('email');
            
            $('#emailUserId').val(userId);
            $('#emailTo').val(userEmail);
            $('#emailModal').modal('show');
        });
        
        // Pay Now button click
        $('.pay-now').on('click', function() {
            var userId = $(this).data('id');
            
            if(confirm('Are you sure you want to process payment for this developer?')) {
                window.location.href = '/admin/process-payment/' + userId;
            }
        });
        
        // Initialize tooltips
        $('[title]').tooltip();
    });
</script>

<style>
    .btn-group .btn {
        margin-right: 5px;
    }
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    .badge {
        font-size: 12px;
        padding: 5px 10px;
    }
</style>

@endsection