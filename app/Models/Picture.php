<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = ['path'];

    /**
     * Get the car associated with this picture.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
