<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeripheralType extends Model
{
    use HasFactory;
    protected $table = 'peripheral_types';

    public function peripherals()
    {
        return $this->hasMany(Peripheral::class, 'type_id', 'id');
    }
}
