<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $table = 'user_login'; // point to the correct table

    protected $fillable = [
        'fname', 'email', 'password', // include other fields if needed
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = false; // if `user_login` doesn't have created_at/updated_at

    public function hiredDevelopers()
    {
        return $this->hasManyThrough(
            Developer::class,
            DeveloperOrder::class,
            'u_id',        
            'dev_id',      
            'id',          
            'dev_id'      
        );
    }

    public function kyc()
    {
        return $this->hasOne(EmployerKyc::class, 'employer_id');
    }

    public function bankDetail()
    {
        return $this->hasOne(EmployerBankDetail::class, 'employer_id');
    }

}
