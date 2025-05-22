<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'age',
        'gender',
        'zipcode',
        'ip_address',
    ];

    public function backgroundCheck()
    {
        return $this->hasOne(BackgroundCheck::class);
    }
}
