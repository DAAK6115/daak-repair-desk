<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Device extends Model
{
    protected $fillable = [
        'client_id',
        'device_type',
        'brand',
        'model',
        'serial_number',
        'accessories',
        'physical_condition',
        'password_provided',
        'device_password',
    ];

    protected $casts = [
        'password_provided' => 'boolean',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function repairs(): HasMany
    {
        return $this->hasMany(Repair::class);
    }
}