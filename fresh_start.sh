#!/bin/bash

# Script de Renovación de Datos (Fresh Start)
# Borra la base de datos, corre migraciones y ejecuta el DatabaseSeeder

echo "🚀 Iniciando Fresh Start..."

php artisan migrate:fresh --seed

echo "✅ Base de datos renovada y seeders ejecutados correctamente."
