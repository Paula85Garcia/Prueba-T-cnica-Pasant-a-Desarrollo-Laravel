# Prueba Tecnica - Gestion de Tareas (Laravel 11)

Mini aplicacion CRUD de tareas personales hecha con Laravel.

**Autora:** Paula Garcia  
**Version Laravel:** 11.51.0  
**Version PHP recomendada:** 8.2+

## Tecnologias usadas

- PHP 8+
- Laravel 11
- Blade
- Tailwind CSS por CDN
- SQLite en local
- Docker + PostgreSQL para Render

## Entregables de la prueba

- `RESPUESTAS.md` (parte teorica)
- Codigo fuente de la mini app de tareas
- `README.md` con pasos de ejecucion local y notas de deploy

## Como correr el proyecto localmente

> Ejecutar todos los comandos desde la raiz del proyecto.

### 1) Clonar y entrar al proyecto

```bash
git clone <URL_DEL_REPO>
cd "Prueba Técnica"
```

### 2) Instalar dependencias PHP

```bash
composer install
```

### 3) Crear archivo `.env`

**Windows (PowerShell / CMD):**

```powershell
copy .env.example .env
```

**Linux / macOS:**

```bash
cp .env.example .env
```

> El comando copia el archivo origen `.env.example` al archivo destino `.env` en la misma carpeta.

### 4) Generar clave de la aplicacion

```bash
php artisan key:generate
```

### 5) Crear base SQLite local

**Windows:**

```powershell
type nul > database\database.sqlite
```

**Linux / macOS:**

```bash
touch database/database.sqlite
```

### 6) Ejecutar migraciones

```bash
php artisan migrate
```

### 7) Levantar servidor

```bash
php artisan serve
```

Abrir en navegador:

`http://127.0.0.1:8000/tareas`

## Si en Windows no reconoce `php`

Usar ruta completa de XAMPP:

```powershell
c:\xampp\php\php.exe artisan serve
```

Y para migrar:

```powershell
c:\xampp\php\php.exe artisan migrate
```

## Rutas principales

- `GET /tareas` -> listado de tareas
- `GET /tareas/crear` -> formulario de creacion
- `POST /tareas` -> guardar tarea
- `GET /tareas/{id}/editar` -> formulario de edicion
- `PUT /tareas/{id}` -> actualizar tarea
- `DELETE /tareas/{id}` -> eliminar tarea
- `PATCH /tareas/{id}/toggle` -> completar/descompletar

## Pruebas

```bash
php artisan test
```

## Deploy (opcional) en Render

URL de despliegue:

`https://prueba-tecnica-tareas.onrender.com`

Este repositorio incluye:

- `Dockerfile`
- `docker/entrypoint.sh`
- `render.yaml`

### Configuracion minima recomendada en Render

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://TU-SERVICIO.onrender.com`
- `APP_KEY=base64:...`
- `DB_CONNECTION=pgsql`
- `DB_URL=<connection string de Postgres>`
- `SESSION_DRIVER=cookie`
- `CACHE_STORE=file`
- `QUEUE_CONNECTION=sync`
- `LOG_CHANNEL=stderr`

> Si falla el deploy, revisar logs de runtime en Render y buscar `Exception`, `SQLSTATE` o `APP_KEY`.
