<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Month</th>
            <th>Language</th>
            <th>Country</th>
            <th>Education</th>
            <th>Description</th>
            <th>Skills</th>
            <th>Completed Job</th>
            <th>State</th>
            <th>City</th>
            <th>Address</th>
            <th>Zip Code</th>
            <th>Total Price</th>
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
            <td>{{ $dev->dev_phone }}</td>
            <td>{{ $dev->perhr }}</td>
            <td>{{ $dev->language }}</td>
            <td>{{ $dev->country }}</td>
            <td>{{ $dev->education }}</td>
            <td>{{ $dev->description }}</td>
            <td>{{ $dev->skills }}</td>
            <td>{{ $dev->completed_job }}</td>
            <td>{{ $dev->state }}</td>
            <td>{{ $dev->city }}</td>
            <td>{{ $dev->address }}</td>
            <td>{{ $dev->code }}</td>
            <td>{{ $dev->tprice }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
