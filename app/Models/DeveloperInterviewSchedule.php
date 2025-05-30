<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperInterviewSchedule extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'developer_interview_schedule';
    protected $fillable = [
        'dev_id', 'u_id', 'fname', 'lname', 'phone', 'email', 'from_time', 'to_time',
        'meet_link', 'perhr', 'address_one', 'code', 'language',
        'interviewdateone', 'interviewdatetwo', 'interviewdatethree',
        'schinterviewdatetime', 'interviewlink', 'review', 'status', 'approve_status'
    ];
}
