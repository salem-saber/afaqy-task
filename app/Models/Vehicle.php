<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string name
 * @property string plate_number
 * @property string imei
 * @property string vin
 * @property int year
 * @property string license
 * @property FuelEntry[] fuelEntries
 * @property InsurancePayment[] insurancePayments
 * @property Service[] services
 * */
class Vehicle extends Model
{
    protected $fillable = [
        'name',
        'plate_number',
        'imei',
        'vin',
        'year',
        'license',
    ];

    /**
     * Get the fuel entries for the vehicle.
     */
    public function fuelEntries(): HasMany
    {
        return $this->hasMany(FuelEntry::class);
    }

    /**
     * Get the insurance payments for the vehicle.
     */
    public function insurancePayments(): HasMany
    {
        return $this->hasMany(InsurancePayment::class);
    }

    /**
     * Get the services for the vehicle.
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
