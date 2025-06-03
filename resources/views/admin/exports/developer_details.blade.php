<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Heading</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Description</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Per Month</th>
            <th>Total Hours</th>
            <th>Rating</th>
            <th>Address</th>
            <th>Language</th>
            <th>Education</th>
            <th>Skills</th>
            <th>Completed Job</th>
            <th>Bank Name</th>
            <th>Branch Name</th>
            <th>Account Name</th>
            <th>Account Number</th>
            <th>IFSC Code</th>
            <th>MICR Number</th>
            <th>Account Type</th>
            <!-- Add other required columns -->
        </tr>
    </thead>
    <tbody>
        @foreach($developers as $dev)
        <tr>
            <td>{{ $dev->dev_id }}</td>
            <td>{{ $dev->heading }}</td>
            <td>{{ $dev->name }}</td>
            <td>{{ $dev->last_name }}</td>
            <td>{{ $dev->description }}</td>
            <td>{{ $dev->email }}</td>
            <td>{{ $dev->phone }}</td>
            <td>{{ $dev->perhr }}</td>
            <td>{{ $dev->total_hours }}</td>
            <td>{{ $dev->rating }}</td>
            <td>{{ $dev->address }}</td>
            <td>{{ $dev->language }}</td>
            <td>{{ $dev->education }}</td>
            <td>{{ $dev->skills }}</td>
            <td>{{ $dev->completed_job }}</td>
            <td>{{ $dev->bank_name }}</td>
            <td>{{ $dev->branch_name }}</td>
            <td>{{ $dev->acct_name }}</td>
            <td>{{ $dev->account_number }}</td>
            <td>{{ $dev->ifc_code }}</td>
            <td>{{ $dev->micr_number }}</td>
            <td>{{ $dev->account_Type }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
