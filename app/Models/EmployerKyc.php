<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerKyc extends Model
{
    use HasFactory;
    protected $table = 'employer_kyc';
    protected $fillable = [
        'gst_number',
        'pan_number',
        'adhar_number',
        'business_type',
        'kyc_document',
        'adhar_img',
        'pan_img',
        'employer_id',
        'is_kyc_done',
    ];
    
}
