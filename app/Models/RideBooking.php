<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideBooking extends Model
{
    use HasFactory;
    protected $table = 'ride_bookings'; // Specify the table name

    protected $primaryKey = 'ride_id'; // Specify the custom primary key field

    protected $fillable = [
        'ride_id',
        'persons',
        'luggage',
        'total_distance',
        'date_time',
        'car_id',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'car_id');
    }

    public function pricingSetting()
    {
        return $this->belongsTo(Setting::class, 'key', 'total_distance');
    }

    public function getTotalPriceAttribute()
    {
        return $this->total_price;
    }
}