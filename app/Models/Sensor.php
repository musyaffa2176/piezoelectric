<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $fillable = [
        'nama_sensor',
        'tegangan',
        'tekanan',
        'energi',
        'status'
    ];
}
