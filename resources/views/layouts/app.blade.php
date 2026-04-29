{{-- Plantilla base: tipografía, colores y zonas comunes (cabecera, mensajes, pie). --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Tareas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        {{-- Colores y sombras pedidos para toda la app (Tailwind CDN). --}}
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: '#1A237E',
                        surface: '#F8FAFC',
                        emerald: '#10B981',
                    },
                    boxShadow: {
                        soft: '0 8px 20px rgba(15, 23, 42, 0.08)',
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                },
            },
        };
    </script>
</head>
<body class="bg-surface min-h-screen font-sans text-slate-800">
    {{-- Cabecera fija del sitio --}}
    <header class="bg-navy text-white shadow-soft">
        <div class="max-w-6xl mx-auto px-4 py-5">
            <h1 class="text-2xl font-extrabold tracking-tight">Mis Tareas</h1>
            <p class="text-sm text-indigo-100 mt-1">Organiza tu día con enfoque y consistencia.</p>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-8">
        {{-- Mensaje tras crear/editar/borrar --}}
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 text-emerald-700 px-4 py-3 shadow-soft">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Pie informativo (no afecta la lógica de tareas) --}}
    <footer class="bg-white border-t border-slate-200 mt-10">
        <div class="max-w-6xl mx-auto px-4 py-8 grid gap-6 md:grid-cols-3">
            <section>
                <h3 class="font-semibold text-navy mb-3">Frases Motivacionales</h3>
                <ul class="space-y-2 text-sm text-slate-600">
                    <li>"Empieza donde estás. Usa lo que tienes."</li>
                    <li>"Cada tarea completada es progreso real."</li>
                    <li>"La constancia supera a la perfección."</li>
                </ul>
            </section>
            <section>
                <h3 class="font-semibold text-navy mb-3">Recursos</h3>
                <ul class="space-y-2 text-sm text-slate-600">
                    <li><a href="#" class="hover:text-emerald">Guía de productividad</a></li>
                    <li><a href="#" class="hover:text-emerald">Método Pomodoro</a></li>
                    <li><a href="#" class="hover:text-emerald">Plantillas semanales</a></li>
                </ul>
            </section>
            <section>
                <h3 class="font-semibold text-navy mb-3">Enlaces de Comunidad</h3>
                <div class="flex items-center gap-3 text-slate-500">
                    <a href="#" class="hover:text-emerald" aria-label="X">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.9 2H22l-6.77 7.74L23 22h-6.18l-4.84-6.32L6.45 22H3.34l7.24-8.28L1 2h6.34l4.37 5.76L18.9 2z"/></svg>
                    </a>
                    <a href="#" class="hover:text-emerald" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M13.5 9H16V6h-2.5C11.57 6 10 7.57 10 9.5V12H8v3h2v6h3v-6h2.2l.8-3H13v-2.3c0-.39.11-.7.5-.7z"/></svg>
                    </a>
                    <a href="#" class="hover:text-emerald" aria-label="LinkedIn">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M6.94 8.5a1.75 1.75 0 1 1 0-3.5 1.75 1.75 0 0 1 0 3.5zM5.5 10h2.88v9H5.5v-9zM10.5 10h2.76v1.23h.04c.39-.73 1.34-1.5 2.76-1.5 2.95 0 3.49 1.93 3.49 4.44V19h-2.88v-4.28c0-1.02-.02-2.33-1.42-2.33-1.42 0-1.64 1.1-1.64 2.26V19H10.5v-9z"/></svg>
                    </a>
                </div>
            </section>
        </div>
    </footer>
</body>
</html>
