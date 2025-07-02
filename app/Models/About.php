<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'birthday',
        'degree',
        'experience',
        'phone',
        'email',
        'address',
        'freelance',
        'description',
        'about_image'
    ];
}
