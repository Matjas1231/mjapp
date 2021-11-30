<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;
    protected $table = 'computers';

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function computerType()
    {
        return $this->belongsTo(ComputerTypes::class, 'type_id', 'id');
    }
}
