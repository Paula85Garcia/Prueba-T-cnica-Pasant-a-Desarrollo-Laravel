{{-- Listado principal: tarjetas, prioridad, fecha y acciones. --}}
@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-navy">Listado de tareas</h2>
        <a href="{{ route('tareas.create') }}" class="inline-flex items-center rounded-2xl bg-emerald px-4 py-2 text-white font-medium hover:brightness-95 shadow-soft">
            Nueva tarea
        </a>
    </div>

    {{-- Sin datos: mensaje simple --}}
    @if ($tareas->isEmpty())
        <div class="rounded-2xl border border-slate-200 bg-white p-5 text-slate-600 shadow-soft">
            Aún no tienes tareas creadas.
        </div>
    @else
        <div class="grid gap-4 md:grid-cols-2">
            @foreach ($tareas as $tarea)
                {{-- Colores del badge según prioridad --}}
                @php
                    $prioridadClasses = [
                        'alta' => 'bg-red-100 text-red-700',
                        'media' => 'bg-yellow-100 text-yellow-700',
                        'baja' => 'bg-green-100 text-green-700',
                    ];
                @endphp

                {{-- Tarjeta de tarea; si está completada se ve más tenue --}}
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-soft {{ $tarea->completada ? 'opacity-75' : '' }}">
                    <div class="flex flex-col gap-4">
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <div class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-navy">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M9 11h6M9 15h6M9 7h6"/>
                                        <path d="M5 3h14a2 2 0 0 1 2 2v14l-4-2-4 2-4-2-4 2V5a2 2 0 0 1 2-2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold {{ $tarea->completada ? 'line-through text-slate-500' : 'text-slate-800' }}">
                                    {{ $tarea->titulo }}
                                </h3>
                                @if ($tarea->completada)
                                    <span class="text-emerald font-bold">✓</span>
                                @endif
                                <span class="rounded-full px-2 py-1 text-xs font-semibold {{ $prioridadClasses[$tarea->prioridad] }}">
                                    {{ ucfirst($tarea->prioridad) }}
                                </span>
                            </div>

                            @if ($tarea->descripcion)
                                <p class="text-slate-600 {{ $tarea->completada ? 'line-through' : '' }}">
                                    {{ $tarea->descripcion }}
                                </p>
                            @endif

                            {{-- Fecha destacada (o aviso si no hay) --}}
                            <div class="inline-flex items-center gap-2 rounded-xl border border-indigo-100 bg-indigo-50 px-3 py-2 text-sm text-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                    <path d="M16 2v4M8 2v4M3 10h18"/>
                                </svg>
                                @if ($tarea->fecha_limite)
                                    <span>Vence: {{ $tarea->fecha_limite->format('d/m/Y') }}</span>
                                @else
                                    <span>Sin fecha de vencimiento</span>
                                @endif
                            </div>
                        </div>

                        {{-- Iconos: editar, completar y borrar (con confirmación) --}}
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('tareas.edit', $tarea->id) }}" title="Editar" aria-label="Editar tarea" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 20h9"/>
                                    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/>
                                </svg>
                            </a>

                            <form action="{{ route('tareas.toggle', $tarea->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" title="{{ $tarea->completada ? 'Desmarcar' : 'Completar' }}" aria-label="{{ $tarea->completada ? 'Desmarcar tarea' : 'Completar tarea' }}" class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-emerald text-white hover:brightness-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 6L9 17l-5-5"/>
                                    </svg>
                                </button>
                            </form>

                            <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Borrar" aria-label="Borrar tarea" onclick="return confirm('¿Seguro que deseas eliminar esta tarea?')" class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-red-600 text-white hover:bg-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 6h18"/>
                                        <path d="M8 6V4h8v2"/>
                                        <path d="M19 6l-1 14H6L5 6"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
@endsection
