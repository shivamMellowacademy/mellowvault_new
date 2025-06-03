<table>
    <thead>
        <tr>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Monthly Payments</th>
            <th>Payment Amount</th>
            <th>Difference</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payout as $payment)
        <tr>
            <td>{{ $payment->u_id }}</td>
            <td>{{ $payment->fname }} {{ $payment->lname }}</td>
            <td>{{ $payment->email }}</td>
            <td>{{ $payment->perhr }}</td>
            <td>{{ $payment->payment_amount }}</td>
            <td>{{ abs($payment->perhr - $payment->payment_amount) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>