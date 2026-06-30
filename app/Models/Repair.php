<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Repair extends Model
{
    public const STATUS_DEPOSITED = 'Déposé';
    public const STATUS_DIAGNOSIS = 'En diagnostic';
    public const STATUS_DIAGNOSIS_DONE = 'Diagnostic terminé';
    public const STATUS_WAITING_CLIENT = 'En attente validation client';
    public const STATUS_REPAIRING = 'En réparation';
    public const STATUS_READY = 'Prêt à retirer';
    public const STATUS_DELIVERED = 'Livré';
    public const STATUS_CANCELLED = 'Annulé';

    protected $fillable = [
        'client_id',
        'device_id',
        'created_by',
        'receipt_number',
        'declared_issue',
        'diagnosis',
        'proposed_solution',
        'diagnostic_fee',
        'estimated_cost',
        'status',
        'deposit_date',
        'expected_delivery_date',
        'withdrawal_date',
        'dolibarr_invoice_ref',
    ];

    protected $casts = [
        'diagnostic_fee' => 'decimal:2',
        'estimated_cost' => 'decimal:2',
        'deposit_date' => 'datetime',
        'expected_delivery_date' => 'datetime',
        'withdrawal_date' => 'datetime',
    ];

    public static function statuses(): array
    {
        return [
            self::STATUS_DEPOSITED,
            self::STATUS_DIAGNOSIS,
            self::STATUS_DIAGNOSIS_DONE,
            self::STATUS_WAITING_CLIENT,
            self::STATUS_REPAIRING,
            self::STATUS_READY,
            self::STATUS_DELIVERED,
            self::STATUS_CANCELLED,
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function statusLogs(): HasMany
    {
        return $this->hasMany(RepairStatusLog::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(RepairPhoto::class);
    }
}