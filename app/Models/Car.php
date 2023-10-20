<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars'; // Set the table name

    protected $primaryKey = 'car_id'; // Set the primary key

    protected $fillable = [
        'name', 
        'model', 
        'number', 
        'luggage_capacity', 
        'person_capacity', 
        'pictures'
    ]; // Define fillable attributes

    // Define relationships and additional methods as needed

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    public function driver()
{
    return $this->hasOne(Driver::class, 'car_id', 'car_id');
}

    public function rideBookings()
    {
        return $this->hasMany(RideBooking::class, 'car_id'); // 'car_id' should be the foreign key column in the RideBooking model
    }
    public function scopeAvailable($query)
    {
        return $query->doesntHave('rideBookings');
    }
}
