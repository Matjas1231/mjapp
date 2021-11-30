<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComputerTypes extends Model
{
    use HasFactory;
    protected $table = 'computer_types';

    public function computers()
    {
        return $this->hasMany(Computer::class, 'type_id', 'id');
    }
}
