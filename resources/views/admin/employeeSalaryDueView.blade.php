<!-- resources/views/admin/partials/salary_due_details.blade.php -->
<div class="salary-due-details">
    @if($payout->isEmpty())
        <div class="alert alert-warning">No unpaid salary records found for this developer.</div>
    @else
        <div class="developer-info mb-4">
            <h5>Developer Information</h5>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Name:</strong> {{ $payout[0]->fname }} {{ $payout[0]->lname }}</p>
                    <p><strong>Email:</strong> {{ $payout[0]->email }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Developer ID:</strong> {{ $payout[0]->u_id }}</p>
                    <p><strong>Total Unpaid Employee:</strong> {{ count($payout) }}</p>
                </div>
            </div>
        </div>

        <div class="payment-details">
            <h5>Unpaid Salary Records</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payout as $payment)
                        <tr>
                            <td>
                                @php
                                    // Convert month to integer if it's a string
                                    $month = is_numeric($payment->payment_month) ? (int)$payment->payment_month : date('n', strtotime($payment->payment_month));
                                    echo date('F', mktime(0, 0, 0, $month, 1));
                                @endphp
                            </td>
                            <td>{{ $payment->payment_year }}</td>
                            <td>{{ number_format($payment->payment_amount, 2) }} INR</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">Total Due</th>
                            <th>{{ number_format($payout->sum('payment_amount'), 2) }} INR</th>
                            <th colspan="2"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="action-buttons mt-4 text-right">
            <button type="button" class="btn btn-primary send-reminder" data-id="{{ $payout[0]->u_id }}">
                <i class="fas fa-envelope"></i> Send Reminder
            </button>
        </div>
    @endif
</div>