<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $fillable = [
        'horas_diurnas',
        'horas_noturnas',
        'data_hora_inicial',
        'data_hora_final',
    ];
}
