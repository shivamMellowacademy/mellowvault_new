<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Password</th>
            <th>Job</th>
            <th>Total Hours</th>
            <th>Monthly Payout</th>
            <th>Rating</th>
            <th>Address</th>
            <th>Language</th>
            <th>Education</th>
            <th>Collage Name</th>
            <th>Degree</th>
            <th>Percentage</th>
            <th>Passing Year</th>
            <th>Description</th>
            <th>Skills</th>
            <th>Total Experience</th>
            <th>Current CTC</th>
            <th>Expected CTC</th>
            <th>Notice Period</th>
            <th>Completed Job</th>
            <th>Aadhar Number</th>
            <th>Pan Number</th>
            <th>National Name</th>
            <th>Bank Name</th>
            <th>Branch Name</th>
            <th>Account Name</th>
            <th>Account Number</th>
            <th>IFSC Code</th>
            <th>MIRC Number</th>
            <th>Account Type</th>
            <th>Developer Status</th>
            <th>Available Start Date</th>
            <th>Available End Date</th>
            <th>Profile Complete</th>
            <th>Project Link</th>
            <th>Company Name</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Address</th>
            <th>Code</th>
            <th>GST</th>
            <th>Monthly Payout</th>
            <th>Review</th>
            <th>Payment Amount</th>
            <th>Payment Amount Tax</th>
            <th>Payment Date</th>
            <th>Interview Link</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payout as $vals)
        <tr>
            <td>{{ $vals->dev_id ?? 'N/A' }}</td>
            <td>{{ $vals->name  ?? 'N/A' }} {{ $vals->last_name  ?? 'N/A' }}</td>
            <td>{{ $vals->email  ?? 'N/A' }}</td>
            <td>{{ $vals->phone  ?? 'N/A' }}</td>
            <td>{{ $vals->show_password  ?? 'N/A' }}</td>
            <td>{{ $vals->job  ?? 'N/A' }}</td>
            <td>{{ $vals->total_hours  ?? 'N/A' }}</td>
            <td>{{ $vals->perhr  ?? 'N/A' }}</td>
            <td>{{ $vals->rating  ?? 'N/A' }}</td>
            <td>{{ $vals->address  ?? 'N/A' }}</td>
            <td>{{ $vals->language  ?? 'N/A' }}</td>
            <td>{{ $vals->education  ?? 'N/A' }}</td>
            <td>{{ $vals->clg_name  ?? 'N/A' }}</td>
            <td>{{ $vals->degree  ?? 'N/A' }}</td>
            <td>{{ $vals->description  ?? 'N/A' }}</td>
            <td>{{ $vals->skills  ?? 'N/A' }}</td>
            <td>{{ $vals->total_experience  ?? 'N/A' }}</td>
            <td>{{ $vals->current_ctc  ?? 'N/A' }}</td>
            <td>{{ $vals->expected_ctc  ?? 'N/A' }}</td>
            <td>{{ $vals->notice_period  ?? 'N/A' }}</td>
            <td>{{ $vals->adhar_number  ?? 'N/A' }}</td>
            <td>{{ $vals->pan_number  ?? 'N/A' }}</td>
            <td>{{ $vals->national_id_name  ?? 'N/A' }}</td>
            <td>{{ $vals->bank_name  ?? 'N/A' }}</td>
            <td>{{ $vals->branch_name ?? 'N/A' }}</td>
            <td>{{ $vals->acct_name  ?? 'N/A' }}</td>
            <td>{{ $vals->account_number  ?? 'N/A' }}</td>
            <td>{{ $vals->ifc_code  ?? 'N/A' }}</td>
            <td>{{ $vals->micr_number  ?? 'N/A' }}</td>
            <td>{{ $vals->account_Type  ?? 'N/A' }}</td>
            <td>{{ $vals->developer_status  ?? 'N/A' }}</td>
            <td>{{ $vals->available_start_date  ?? 'N/A' }}</td>
            <td>{{ $vals->available_end_date  ?? 'N/A' }}</td>
            <td>{{ $vals->profile_complete  ?? 'N/A' }}</td>
            <td>
            @if(!empty($vals->projects))
                @foreach($vals->projects as $val)
                    {{ $val->project_link  ?? 'N/A' }}
                @endforeach
            @endif
            </td>
             @if(!empty($vals->developer_orders))
                @foreach($vals->developer_orders as $val)
                    <td>{{ $val->company_name  ?? 'N/A' }}</td>
                    <td>{{ $val->country  ?? 'N/A' }}</td>
                    <td>{{ $val->state  ?? 'N/A' }}</td>
                    <td>{{ $val->city  ?? 'N/A' }}</td>
                    <td>{{ $val->address_one  ?? 'N/A' }}</td>
                    <td>{{ $val->code  ?? 'N/A' }}</td>
                    <td>{{ $val->gst  ?? 'N/A' }}</td>
                    <td>{{ $val->perhr  ?? 'N/A' }}</td>
                    <td>{{ $val->review  ?? 'N/A' }}</td>
                    <td>{{ $val->payment_amount  ?? 'N/A' }}</td>
                    <td>{{ $val->tax  ?? 'N/A' }}</td>
                    <td>{{ $val->payment_date  ?? 'N/A' }}</td>
                    <td>{{ $val->interviewlink  ?? 'N/A' }}</td>
                @endforeach
            @endif
        </tr>
        @endforeach
    </tbody>
</table>