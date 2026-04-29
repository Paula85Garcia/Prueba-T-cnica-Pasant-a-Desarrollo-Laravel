<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/** CRUD simple de tareas + toggle de completada (sin autenticación). */
class TareaController extends Controller
{
    /** Lista todas las tareas, las más nuevas primero. */
    public function index()
    {
        $tareas = Tarea::orderByDesc('created_at')->get();

        return view('tareas.index', compact('tareas'));
    }

    /** Formulario vacío para crear una tarea. */
    public function create()
    {
        return view('tareas.create');
    }

    /** Valida, guarda y vuelve al listado con mensaje. */
    public function store(Request $request)
    {
        $data = $this->validateTarea($request);

        Tarea::create($data);

        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente.');
    }

    /** Formulario con datos actuales de la tarea. */
    public function edit($id)
    {
        $tarea = Tarea::findOrFail($id);

        return view('tareas.edit', compact('tarea'));
    }

    /** Valida, actualiza y vuelve al listado con mensaje. */
    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $data = $this->validateTarea($request);

        $tarea->update($data);

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada correctamente.');
    }

    /** Elimina y vuelve al listado con mensaje. */
    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();

        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada.');
    }

    /** Invierte completada; sin mensaje flash (según enunciado). */
    public function toggle($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->update([
            'completada' => ! $tarea->completada,
        ]);

        return redirect()->route('tareas.index');
    }

    /** Reglas y textos de error exactos del enunciado. */
    private function validateTarea(Request $request): array
    {
        return $request->validate(
            [
                'titulo' => ['required', 'min:3', 'max:100'],
                'descripcion' => ['nullable', 'max:500'],
                'prioridad' => ['required', Rule::in(['baja', 'media', 'alta'])],
                'fecha_limite' => ['nullable', 'date', 'after_or_equal:today'],
            ],
            [
                'titulo.required' => 'El título es obligatorio y debe tener entre 3 y 100 caracteres.',
                'titulo.min' => 'El título es obligatorio y debe tener entre 3 y 100 caracteres.',
                'titulo.max' => 'El título es obligatorio y debe tener entre 3 y 100 caracteres.',
                'descripcion.max' => 'La descripción no puede superar los 500 caracteres.',
                'prioridad.required' => 'La prioridad debe ser baja, media o alta.',
                'prioridad.in' => 'La prioridad debe ser baja, media o alta.',
                'fecha_limite.date' => 'La fecha límite debe ser hoy o una fecha futura.',
                'fecha_limite.after_or_equal' => 'La fecha límite debe ser hoy o una fecha futura.',
            ]
        );
    }
}
