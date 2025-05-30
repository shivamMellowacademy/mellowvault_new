<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperProjectDetail extends Model
{
    use HasFactory;

    protected $table = 'developer_project_details_tb';
    public $timestamps = false;

    protected $fillable = ['developer_id', 'screenshot_image','project_link'];

}
