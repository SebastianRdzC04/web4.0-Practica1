FROM php:8.2-fpm

# Instalar extensiones de PHP necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    libpng-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    && docker-php-ext-install pdo pdo_pgsql gd

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Copiar archivos
COPY . /var/www/html

# Instalar dependencias de Laravel
RUN composer install --optimize-autoloader --no-dev

# Permisos para almacenamiento y caché
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Instalar Node y NPM para construir Tailwind
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm

# Construir Tailwind
RUN npm install && npm run build

EXPOSE 9000
CMD ["php-fpm"]
