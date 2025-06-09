<table>
    <thead>
        <tr>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Password</th>
            <th>user_name</th>
            <th>Company Name</th>
            <th>Location</th>
            <th>Address</th>
            <th>Purpose</th>
            <th>Kyc Done</th>
            <th>Bank Done</th>
            <th>Status</th>
            <th>Account Holder Name</th>
            <th>Account Number</th>
            <th>IFSC Code</th>
            <th>Bank Name</th>
            <th>Account Type</th>
            <th>GST Number</th>
            <th>Pan Number</th>
            <th>Aadhar Number</th>
            <th>Business Type</th>
            <th>KYC Status</th>
            <th>Developer Name</th>
            <th>Developer Phone</th>
            <th>Developer email</th>
            <th>Developer Password</th>
            <th>Developer job</th>
            <th>Developer total hours</th>
            <th>Developer Monthly payout</th>
            <th>Developer Rating</th>
            <th>Developer Address</th>
            <th>Developer Language</th>
            <th>Developer Education</th>
            <th>Developer Collage Name</th>
            <th>Developer Degree</th>
            <th>Developer Percentage</th>
            <th>Developer Passing Year</th>
            <th>Developer Description</th>
            <th>Developer Skills</th>
            <th>Developer Total Experience</th>
            <th>Developer Current CTC</th>
            <th>Developer Expected CTC</th>
            <th>Developer Notice Period</th>
            <th>Developer Completed Job</th>
            <th>Developer Aadhar Number</th>
            <th>Developer Pan Number</th>
            <th>Developer National Name</th>
            <th>Developer Bank Name</th>
            <th>Developer Branch Name</th>
            <th>Developer Account Name</th>
            <th>Developer Account Number</th>
            <th>Developer IFSC Code</th>
            <th>Developer MICR Number</th>
            <th>Developer Account Type</th>
            <th>Developer Status</th>
            <th>Developer Available Start Date</th>
            <th>Developer Available End Date</th>
            <th>Developer Profile Complete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payout as $vals)
        <tr>
            <td>{{ $vals->id ?? 'N/A' }}</td>
            <td>{{ $vals->fname  ?? 'N/A' }} {{ $vals->lname  ?? 'N/A' }}</td>
            <td>{{ $vals->email  ?? 'N/A' }}</td>
            <td>{{ $vals->phone  ?? 'N/A' }}</td>
            <td>{{ $vals->show_password  ?? 'N/A' }}</td>
            <td>{{ $vals->user_name  ?? 'N/A' }}</td>
            <td>{{ $vals->company_name  ?? 'N/A' }}</td>
            <td>{{ $vals->location  ?? 'N/A' }}</td>
            <td>{{ $vals->address  ?? 'N/A' }}</td>
            <td>{{ $vals->purpose  ?? 'N/A' }}</td>
            <td>{{ $vals->is_kyc_done == 1 ? 'True' : 'False' }}</td>
            <td>{{ $vals->is_bank_done == 1 ? 'True' : 'False' }}</td>
            <td>{{ $vals->status == 1 ? 'True' : 'False' }}</td>
            <td>{{ $vals->bank_detail->account_holder_name   ?? 'N/A'  }}</td>
            <td>{{ $vals->bank_detail->account_number   ?? 'N/A'  }}</td>
            <td>{{ $vals->bank_detail->ifsc_code   ?? 'N/A'  }}</td>
            <td>{{ $vals->bank_detail->bank_name   ?? 'N/A'  }}</td>
            <td>{{ $vals->bank_detail->account_type   ?? 'N/A'  }}</td>
            <td>{{ $vals->kyc->gst_number   ?? 'N/A'  }}</td>
            <td>{{ $vals->kyc->pan_number  ?? 'N/A'  }}</td>
            <td>{{ $vals->kyc->adhar_number  ?? 'N/A'  }}</td>
            <td>{{ $vals->kyc->business_type  ?? 'N/A'  }}</td>
            <td>{{ $vals->kyc->kyc_status  ?? 'N/A'  }}</td>
            @if(!empty($vals->hired_developers))
            @foreach($vals->hired_developers as $val)
                <td>{{ $val->fname  ?? 'N/A' }} {{ $val->last_name  ?? 'N/A' }}</td>
                <td>{{ $val->phone  ?? 'N/A'  }}</td>
                <td>{{ $val->email  ?? 'N/A'  }}</td>
                <td>{{ $val->show_password  ?? 'N/A'  }}</td>
                <td>{{ $val->job  ?? 'N/A'  }}</td>
                <td>{{ $val->total_hours  ?? 'N/A'  }}</td>
                <td>{{ $val->perhr  ?? 'N/A'  }}</td>
                <td>{{ $val->rating  ?? 'N/A'  }}</td>
                <td>{{ $val->address  ?? 'N/A'  }}</td>
                <td>{{ $val->language  ?? 'N/A'  }}</td>
                <td>{{ $val->education  ?? 'N/A'  }}</td>
                <td>{{ $val->clg_name  ?? 'N/A'  }}</td>
                <td>{{ $val->degree  ?? 'N/A'  }}</td>
                <td>{{ $val->percentage  ?? 'N/A'  }}</td>
                <td>{{ $val->passing_year  ?? 'N/A'  }}</td>
                <td>{{ $val->description  ?? 'N/A'  }}</td>
                <td>{{ $val->skills  ?? 'N/A'  }}</td>
                <td>{{ $val->total_experience  ?? 'N/A'  }}</td>
                <td>{{ $val->current_ctc  ?? 'N/A'  }}</td>
                <td>{{ $val->expected_ctc  ?? 'N/A'  }}</td>
                <td>{{ $val->notice_period  ?? 'N/A'  }}</td>
                <td>{{ $val->completed_job  ?? 'N/A'  }}</td>
                <td>{{ $val->adhar_number  ?? 'N/A'  }}</td>
                <td>{{ $val->pan_number  ?? 'N/A'  }}</td>
                <td>{{ $val->national_id_name  ?? 'N/A'  }}</td>
                <td>{{ $val->bank_name  ?? 'N/A'  }}</td>
                <td>{{ $val->branch_name  ?? 'N/A'  }}</td>
                <td>{{ $val->acct_name  ?? 'N/A'  }}</td>
                <td>{{ $val->account_number  ?? 'N/A'  }}</td>
                <td>{{ $val->ifc_code  ?? 'N/A'  }}</td>
                <td>{{ $val->micr_number  ?? 'N/A'  }}</td>
                <td>{{ $val->account_Type  ?? 'N/A'  }}</td>
                <td>{{ $val->developer_status  ?? 'N/A'  }}</td>
                <td>{{ $val->available_start_date  ?? 'N/A'  }}</td>
                <td>{{ $val->available_end_date  ?? 'N/A'  }}</td>
                <td>{{ $val->profile_complete  ?? 'N/A'  }}</td>
            @endforeach
            @endif
        </tr>
        @endforeach
    </tbody>
</table>