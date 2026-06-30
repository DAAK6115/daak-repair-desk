<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'address',
        'client_type',
    ];

    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

    public function repairs(): HasMany
    {
        return $this->hasMany(Repair::class);
    }
}