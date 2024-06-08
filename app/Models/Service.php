<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int vehicle_id
 * @property string start_date
 * @property string end_date
 * @property string invoice_number
 * @property string purchase_order_number
 * @property string status
 * @property float discount
 * @property float tax
 * @property float total
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Vehicle vehicle
 * */
class Service extends Model
{
    protected $fillable = [
        'vehicle_id',
        'start_date',
        'end_date',
        'invoice_number',
        'purchase_order_number',
        'status',
        'discount',
        'tax',
        'total'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    /**
     * Get the vehicle that owns the service.
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
