<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable=[
        'user_id',
        'name',
        'profile-image',
        'title',
        'description',
        'cv_file',
        'video_url',
    ];
}
