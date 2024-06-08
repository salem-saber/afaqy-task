<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property int vehicle_id
 * @property float cost
 * @property string entry_date
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Vehicle vehicle
 * */
class FuelEntry extends Model
{
    protected $fillable = [
        'vehicle_id',
        'entry_date',
        'volume',
        'cost',
    ];

    /**
     * Get the vehicle that owns the fuel entry.
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
