<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property int vehicle_id
 * @property float amount
 * @property string contract_date
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Vehicle vehicle
 * */
class InsurancePayment extends Model
{
    protected $fillable = [
        'vehicle_id',
        'contract_date',
        'expiration_date',
        'amount'
    ];

    protected $casts = [
        'contract_date' => 'date',
        'expiration_date' => 'date'
    ];

    /**
     * Get the vehicle that owns the insurance payment.
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
