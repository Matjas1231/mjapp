<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peripheral extends Model
{
    use HasFactory;
    protected $table = 'peripherals';

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function peripheralType()
    {
        return $this->belongsTo(PeripheralType::class, 'type_id', 'id');
    }


}

