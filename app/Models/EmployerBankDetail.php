<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerBankDetail extends Model
{
    use HasFactory;
    protected $table = 'employer_bank_details';
    protected $fillable = [
        'account_holder_name',
        'account_number',
        'ifsc_code',
        'bank_name',
        'branch_name',
        'bank_doc_proof',
        'account_type',
        'employer_id',
        'is_bank_done',
    ];
    
}
