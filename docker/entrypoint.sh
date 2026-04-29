#!/usr/bin/env bash
# Punto de entrada del contenedor: prepara storage y aplica migraciones antes de Apache.
set -euo pipefail

cd /var/www/html

# Permisos de escritura (logs, vistas compiladas, sesiones en file, etc.)
chown -R www-data:www-data storage bootstrap/cache || true
chmod -R ug+rwX storage bootstrap/cache || true

# Asegura esquema en Postgres (Render) en cada despliegue.
php artisan migrate --force

exec "$@"
