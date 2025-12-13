#!/bin/bash
set -e

echo "🚀 Starting deployment script..."

# 1. Configurar Puerto Dinámico (Railway usa $PORT)
# Si $PORT está definido, configuramos Apache para escuchar en ese puerto.
if [ -n "$PORT" ]; then
    echo "🔌 Configuring Apache to listen on port $PORT..."
    sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf
else
    echo "⚠️ \$PORT not set, defaulting to 80."
fi

# 2. Link Storage
echo "📂 Linking storage..."
php artisan storage:link || echo "⚠️ Storage link failed or already exists."

# 3. Run Migrations
# Usamos try/catch (||) para que si falla la migración (ej. DB no lista), no tumbe el contenedor inmediatamente
# y podamos ver los logs.
echo "📦 Running migrations..."
php artisan migrate --force || echo "❌ MIGRATION FAILED! Check your database credentials."

# 4. Clear Caches (Opcional pero recomendado en prod)
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear

# 5. Start Apache
echo "🔥 Starting Apache..."
exec "$@"
