<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra servicios al arrancar el contenedor de Laravel.
     */
    public function register(): void
    {
        // Nada especial por ahora.
    }

    /**
     * Arranque: ajustes globales (URLs, etc.).
     */
    public function boot(): void
    {
        // Detrás de proxy HTTPS (Render, etc.) evita URLs http mezcladas.
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
