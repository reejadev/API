<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialAuth extends Model
{
    use SoftDeletes;

    protected $fillable=[
        'twitter_screen_name',
        'twitter_oauth_token',
        'twitter_oauth_token_secret',
        
    ];
    use HasFactory;
}
