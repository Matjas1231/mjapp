<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peripherals extends Model
{
    use HasFactory;
    protected $table = 'peripheral_types';

    public function peripheralType()
    {
        return $this->belongsTo(PeripheralType::class, 'type_id', 'id');
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}

