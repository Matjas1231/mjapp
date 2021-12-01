<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'id',
    //     'name',
    //     'surname',
    //     'position',
    //     'department_id',
    //     'phone'
    // ];

    protected $table = 'workers';

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function computers()
    {
        return $this->hasMany(Computer::class);
    }

    public function peripherals()
    {
        return $this->hasMany(Peripherals::class);
    }
}
