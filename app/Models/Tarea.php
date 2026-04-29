<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = [
        'titulo',
        'descripcion',
        'prioridad',
        'completada',
        'fecha_limite',
    ];

    protected $casts = [
        'completada' => 'boolean',
        'fecha_limite' => 'date',
    ];
}
