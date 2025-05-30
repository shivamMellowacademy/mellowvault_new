<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Developer as Authenticatable;


class Developer extends Model implements CanResetPassword
{
    use HasFactory;
    use CanResetPasswordTrait;
    use Notifiable;

    protected $table = 'developer_details_tb';
    protected $primaryKey = 'dev_id';
    public $timestamps = false;

    protected $fillable = ['dev_id', 'pro_id', 'name', 'last_name', 'phone', 'email', 'password', 'show_password', 'job', 'total_hours', 'perhr', 'rating', 'address', 'language', 'education', 'clg_name', 'degree', 'percentage', 'passing_year', 'description', 'skills', 'completed_job', 'image', 'portfolio_image', 'resume', 'adharcard', 'pancard', 'national_id_name', 'national_id_image', 'signature', 'bank_name', 'branch_name', 'acct_name', 'account_number', 'ifc_code', 'micr_number', 'passbook', 'account_Type', 'developer_status', 'available_start_date', 'available_end_date', 'profile_complete', 'login_status', 'date'];


    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function projects()
    {
        return $this->hasMany(DeveloperProjectDetail::class, 'developer_id');
    }

    public function developerOrders()
    {
        return $this->hasMany(DeveloperOrder::class, 'dev_id', 'dev_id');
    }
}
