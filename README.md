# Prueba Técnica - Gestión de Tareas (Laravel 11)

Mini aplicación de tareas personales construida con Laravel 11, PHP 8 y SQLite.

**Autora:** Paula Garcia

## Tecnologías

- PHP 8.2+ (recomendado; compatible con Laravel 11)
- Laravel 11
- Blade + Tailwind (CDN)
- SQLite en local; Postgres en Render (producción)

## Requisitos

- PHP 8+
- Composer

## Instalación

1. Instalar dependencias:
   - `composer install`
2. Crear archivo de entorno (si no existe):
   - `copy .env.example .env`
3. Generar clave de aplicación:
   - `php artisan key:generate`
4. Crear base SQLite:
   - `type nul > database\database.sqlite`
5. Ejecutar migraciones:
   - `php artisan migrate`

## Ejecutar proyecto

- Levantar servidor local:
  - `php artisan serve`
- Abrir en navegador:
  - `http://127.0.0.1:8000/tareas`

## Deploy en Render (Docker + Postgres)

Este repo incluye `render.yaml` + `Dockerfile` para desplegar como **Web Service** con **PostgreSQL** (más estable que SQLite en hosting).

### Opción A (recomendada): Blueprint

1. Sube estos archivos a tu repo en GitHub (cuando hagas commit):
   - `Dockerfile`
   - `docker/entrypoint.sh`
   - `render.yaml`
2. En Render: **New > Blueprint** y selecciona el repo.
3. Variables de entorno (importante):
   - **`APP_URL`**: pon la URL pública del servicio (ej. `https://TU-SERVICIO.onrender.com`).  
     En Render la **clave** debe ser exactamente `APP_URL` y el **valor** la URL completa (no al revés).
   - **`APP_KEY`**: si no usas Blueprint, genera una con `php artisan key:generate --show` en local y pégala en Render.
4. Deploy: en el arranque se ejecuta `php artisan migrate --force` (ver `docker/entrypoint.sh`).

### Opción B: Web Service manual (si Render te sugiere Node)

No uses **Node** para este proyecto.

1. **New > Web Service** → elige el repo.
2. **Runtime / Environment**: selecciona **Docker** (no Node).
3. **Dockerfile Path**: `./Dockerfile` (raíz del repo).
4. Crea también una base **PostgreSQL** en Render y define:
   - `DB_CONNECTION=pgsql`
   - `DB_URL=<connection string de Postgres>` (Render suele llamarlo *Internal Database URL*; Laravel lo lee como `DB_URL` en `config/database.php`)
5. Define `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://...`, `APP_KEY=base64:...`.
6. Deploy.

Referencia oficial de Blueprints: [Blueprint spec (Render)](https://render.com/docs/blueprint-spec)

## Rutas principales

- `GET /tareas` - listado de tareas
- `GET /tareas/crear` - formulario de creación
- `POST /tareas` - guardar nueva tarea
- `GET /tareas/{id}/editar` - formulario de edición
- `PUT /tareas/{id}` - actualizar tarea
- `DELETE /tareas/{id}` - eliminar tarea
- `PATCH /tareas/{id}/toggle` - marcar/desmarcar completada

## Estructura importante

- `app/Models/Tarea.php`
- `app/Http/Controllers/TareaController.php`
- `database/migrations/*_create_tareas_table.php`
- `routes/web.php`
- `resources/views/layouts/app.blade.php`
- `resources/views/tareas/index.blade.php`
- `resources/views/tareas/create.blade.php`
- `resources/views/tareas/edit.blade.php`
- `Dockerfile`, `render.yaml`, `docker/entrypoint.sh`
