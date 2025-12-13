FROM php:8.4-apache

# 1. Instalar dependencias del sistema
# Incluye librerías para Zip, GD (imágenes), Postgres e Intl
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    libicu-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Configurar e instalar extensiones de PHP
# Configuramos GD para soportar JPEG y Freetype
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    zip \
    gd \
    pdo_pgsql \
    bcmath \
    intl \
    opcache

# 3. Configurar DocumentRoot de Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!!g' /etc/apache2/apache2.conf

# 4. Habilitar mod_rewrite
RUN a2enmod rewrite

# 5. Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. Establecer directorio de trabajo
WORKDIR /var/www/html

# 7. Copiar archivos del proyecto
COPY . .

# 8. Instalar dependencias de PHP
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 9. Ajustar permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 10. Exponer puerto 80 (Railway lo mapea automáticamente)
EXPOSE 80

# 11. Entrypoint y Comando
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
