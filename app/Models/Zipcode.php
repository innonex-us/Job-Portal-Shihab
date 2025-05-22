<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zipcode extends Model
{
    protected $fillable = [
        'zipcode',
        'ip_address',
    ];
    
    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class, 'zipcode', 'zipcode');
    }
}
