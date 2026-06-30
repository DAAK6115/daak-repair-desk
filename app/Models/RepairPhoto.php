<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RepairPhoto extends Model
{
    protected $fillable = [
        'repair_id',
        'photo_path',
        'caption',
    ];

    public function repair(): BelongsTo
    {
        return $this->belongsTo(Repair::class);
    }
}