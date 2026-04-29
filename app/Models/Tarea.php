<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Una fila de la tabla `tareas`. */
class Tarea extends Model
{
    /** Campos que se pueden rellenar en masa desde el controlador. */
    protected $fillable = [
        'titulo',
        'descripcion',
        'prioridad',
        'completada',
        'fecha_limite',
    ];

    /** Tipos nativos al leer/escribir el modelo. */
    protected $casts = [
        'completada' => 'boolean',
        'fecha_limite' => 'date',
    ];
}
