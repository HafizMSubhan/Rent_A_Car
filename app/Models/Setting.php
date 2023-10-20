<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $fillable = ['key', 'value'];

    public function getValueByKey($key)
{
    return $this->where('key', $key)->value('value');
}
}
