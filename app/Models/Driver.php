<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $table = 'drivers';
    protected $primaryKey = 'driver_id'; // Specify the custom primary key field

    protected $fillable = [
        'driver_id',
        'Name',
        'Email',
        'Phone_No',
        'Residential_Address',
        'CNIC_Number',
        'License_Number',
        'car_id',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'car_id');
    }
    public function rideBookings()
    {
        return $this->hasMany(RideBooking::class, 'driver_id');
    }

    // Define a custom relationship to get unassigned drivers
    public function unassignedRideBookings()
    {
        return $this->hasMany(RideBooking::class, 'driver_id')
        ->whereNull('car_id'); // Assuming 'car_id' is the foreign key column in RideBooking model
    }
    public function scopeUnassigned($query)
    {
        return $query->whereNull('car_id');
    }
}
