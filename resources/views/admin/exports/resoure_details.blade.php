<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Address</th>
            <!-- Add other required columns -->
        </tr>
    </thead>
    <tbody>
        @foreach($payout as $dev)
        <tr>
            <td>{{ $dev->dev_id }}</td>
            <td>{{ $dev->name }}</td>
            <td>{{ $dev->last_name }}</td>
            <td>{{ $dev->email }}</td>
            <td>{{ $dev->phone }}</td>
            <td>{{ $dev->country }}</td>
            <td>{{ $dev->state }}</td>
            <td>{{ $dev->city }}</td>
            <td>{{ $dev->address_one }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
