<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackgroundCheck extends Model
{
    protected $fillable = [
        'user_profile_id',
        'verified',
        'verification_date',
    ];

    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class);
    }
}
