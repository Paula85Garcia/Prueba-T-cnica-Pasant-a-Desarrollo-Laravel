{{-- Formulario de alta: envía a store con validación en servidor. --}}
@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-navy">Crear tarea</h2>
    </div>

    {{-- Errores de validación --}}
    @if ($errors->any())
        <div class="mb-4 rounded border border-red-200 bg-red-100 px-4 py-3 text-red-700">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- POST a tareas.store --}}
    <form action="{{ route('tareas.store') }}" method="POST" class="space-y-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-soft">
        @csrf

        <div>
            <label for="titulo" class="mb-1 block text-sm font-medium text-gray-700">Título</label>
            <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required class="w-full rounded border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none">
        </div>

        <div>
            <label for="descripcion" class="mb-1 block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4" class="w-full rounded border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none">{{ old('descripcion') }}</textarea>
        </div>

        <div>
            <label for="prioridad" class="mb-1 block text-sm font-medium text-gray-700">Prioridad</label>
            <select name="prioridad" id="prioridad" required class="w-full rounded border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none">
                <option value="baja" @selected(old('prioridad') === 'baja')>Baja</option>
                <option value="media" @selected(old('prioridad', 'media') === 'media')>Media</option>
                <option value="alta" @selected(old('prioridad') === 'alta')>Alta</option>
            </select>
        </div>

        <div>
            <label for="fecha_limite" class="mb-1 block text-sm font-medium text-gray-700">Fecha límite</label>
            <input type="date" name="fecha_limite" id="fecha_limite" value="{{ old('fecha_limite') }}" class="w-full rounded border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:outline-none">
        </div>

        <div class="flex items-center gap-2">
            <button type="submit" class="rounded-xl bg-emerald px-4 py-2 text-white font-medium hover:brightness-95">Guardar</button>
            <a href="{{ route('tareas.index') }}" class="rounded-xl bg-slate-200 px-4 py-2 text-slate-700 hover:bg-slate-300">Cancelar</a>
        </div>
    </form>
@endsection
