#!/bin/bash
set -e

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Link storage
echo "Linking storage..."
php artisan storage:link

# Execute the main command (Apache)
exec "$@"
