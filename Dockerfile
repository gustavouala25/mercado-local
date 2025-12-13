FROM php:8.2-apache

# 1. Instalar SOLO dependencias de PHP (Ya no necesitamos Node ni NPM)
RUN apt-get update && apt-get install -y     git     curl     libpng-dev     libonig-dev     libxml2-dev     libzip-dev     libpq-dev     zip     unzip     && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Instalar extensiones
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip intl

# 3. Configurar Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!!g' /etc/apache2/apache2.conf

# 4. Mod Rewrite
RUN a2enmod rewrite

# 5. Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. Workdir
WORKDIR /var/www/html

# 7. Copiar todo el proyecto (Incluyendo la carpeta public/build que acabamos de generar)
COPY . .

# 8. Instalar dependencias PHP (Rápido porque ya subimos el composer.lock)
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 9. Permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 10. Puerto
EXPOSE 80

# 11. Entrypoint
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
