<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

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

    public function fullname()
    {
        return "{$this->name} {$this->surname}";
    }

    // RELATIONS

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
        return $this->hasMany(peripheral::class);
    }
}
