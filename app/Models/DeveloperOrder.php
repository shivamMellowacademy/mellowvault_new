<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperOrder extends Model
{
    use HasFactory;

    protected $table = 'developer_order_tb';
    public $timestamps = false;
    protected $fillable = [
        'dev_id', 'u_id', 'fname', 'lname', 'phone', 'email', 'from_time', 'to_time',
        'meet_link', 'perhr', 'address_one', 'code', 'language',
        'interviewdateone', 'interviewdatetwo', 'interviewdatethree',
        'schinterviewdatetime', 'interviewlink', 'review', 'status', 'approve_status'
    ];

    public function developer()
    {
        return $this->belongsTo(Developer::class, 'dev_id', 'dev_id');
    }
}
