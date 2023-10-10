<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'gender',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rides()
    {
        // return $this->hasMany(Ride::class);
    }

    public function assignDriver()
    {
        // Implement logic to assign a driver and car to a user (if applicable)
    }

    public function activeRides()
    {
        // Implement logic to retrieve active rides for the user
    }

    public function completedRides()
    {
        // Implement logic to retrieve completed rides for the user
    }

    // Add other methods as needed...
}
