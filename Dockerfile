# Imagen para Render: Apache sirve /public y PHP ejecuta Laravel.
FROM php:8.2-apache-bookworm

# Extensiones mínimas para Laravel + Postgres
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libzip-dev \
        libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql zip \
    && rm -rf /var/lib/apt/lists/*

# Composer (imagen oficial)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Apache: document root en /public y rewrites (.htaccess)
RUN a2enmod rewrite \
    && sed -ri 's#DocumentRoot /var/www/html#DocumentRoot /var/www/html/public#g' /etc/apache2/sites-available/000-default.conf \
    && sed -ri 's#<Directory /var/www/>#<Directory /var/www/html/public/>#g' /etc/apache2/apache2.conf \
    && printf '<Directory /var/www/html/public>\n\tAllowOverride All\n\tRequire all granted\n</Directory>\n' >/etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

WORKDIR /var/www/html

# Dependencias primero (mejor cache de build)
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-ansi --optimize-autoloader --no-scripts

# Resto del código (sin vendor local; se instala arriba)
COPY . .

# Con el código completo ya disponible, ejecutamos scripts de Composer/Laravel.
RUN composer run-script post-autoload-dump --no-interaction

RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Arranque: migraciones y luego Apache
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
CMD ["apache2-foreground"]
