<!-- resources/views/admin/employeeAdvanceDueView.blade.php -->
<div class="employee-advance-due-details">
    <div class="row">
        <div class="col-md-12">
            @if($payout->isEmpty())
                <div class="alert alert-warning">No unpaid salary records found for this employee.</div>
            @else
                <!-- Employee Information Section -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Employee Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Employee ID:</strong> {{ $payout[0]->u_id }}</p>
                                <p><strong>Email:</strong> {{ $payout[0]->email }}</p>
                               
                            </div>
                            <div class="col-md-6">
                                <p><strong>Name:</strong> {{ $payout[0]->fname }} {{ $payout[0]->lname }}</p>
                                 <p><strong>Mobile:</strong> {{ $payout[0]->phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                

                <!-- Action Buttons -->
                <div class="mt-4 text-right">
                    <button type="button" class="btn btn-primary send-reminder" 
                            data-id="{{ $payout[0]->u_id }}" 
                            data-email="{{ $payout[0]->email }}">
                        <i class="fas fa-envelope"></i> Send Reminder
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .employee-advance-due-details {
        padding: 20px;
    }
    .table th {
        background-color: #f8f9fa;
    }
    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }
    .text-right {
        text-align: right;
    }
</style>