FROM php:8.2-apache

# 1. Instalar dependencias del sistema y Node.js (Todo en un solo paso para evitar errores)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Instalar extensiones de PHP necesarias para Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 3. Configurar Apache para Laravel (DocumentRoot)
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 4. Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# 5. Obtener Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. Configurar directorio de trabajo
WORKDIR /var/www/html

# 7. Copiar archivos del proyecto
COPY . .

# 8. Instalar dependencias de PHP
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 9. Instalar dependencias de Node y compilar assets
# Aumentamos la memoria disponible para Node para evitar fallos
RUN npm install
RUN npm run build

# 10. Dar permisos a las carpetas de almacenamiento
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 11. Exponer el puerto 80
EXPOSE 80