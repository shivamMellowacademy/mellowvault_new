<table>
    <thead>
        <tr>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>User Name</th>
            <th>Company Name</th>
            <th>Location</th>
            <th>Address</th>
            <th>Purpose</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payout as $payment)
        <tr>
            <td>{{ $payment->id }}</td>
            <td>{{ $payment->fname }} {{ $payment->lname }}</td>
            <td>{{ $payment->email }}</td>
            <td>{{ $payment->phone }}</td>
            <td>{{ $payment->user_name }}</td>
            <td>{{ $payment->company_name }}</td>
            <td>{{ $payment->location }}</td>
            <td>{{ $payment->address }}</td>
            <td>{{ $payment->purpose }}</td>
        </tr>
        @endforeach
    </tbody>
</table>