<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;
    public $timestamps = false; // Important since `password_resets` table doesn't use updated_at
    protected $fillable = ['email', 'token', 'created_at'];
    protected $table = 'password_resets';

    // ✅ Tell Eloquent this table does not have an id
    public $incrementing = false;
    protected $primaryKey = 'email';
    protected $keyType = 'string';
}
