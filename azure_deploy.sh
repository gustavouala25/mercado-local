#!/bin/bash

# Variables
RESOURCE_GROUP="mercado-rg"
LOCATION="eastus"
ACR_NAME="mercadolocalacr"
PLAN_NAME="mercado-plan"
WEB_APP_NAME="mercado-local-gus"
IMAGE_NAME="mercado-local:latest"

# 1. Crear Resource Group
echo "Creando Resource Group..."
az group create --name $RESOURCE_GROUP --location $LOCATION

# 2. Crear Azure Container Registry (ACR)
echo "Creando ACR..."
az acr create --resource-group $RESOURCE_GROUP --name $ACR_NAME --sku Basic --admin-enabled true

# 3. Loguear Docker en ACR
echo "Logueando en ACR..."
az acr login --name $ACR_NAME

# 4. Construir y subir imagen Docker
echo "Construyendo y subiendo imagen..."
az acr build --registry $ACR_NAME --image $IMAGE_NAME .

# 5. Crear App Service Plan (Linux, B1)
echo "Creando App Service Plan..."
az appservice plan create --name $PLAN_NAME --resource-group $RESOURCE_GROUP --sku B1 --is-linux

# 6. Crear Web App for Containers
echo "Creando Web App..."
az webapp create --resource-group $RESOURCE_GROUP --plan $PLAN_NAME --name $WEB_APP_NAME --deployment-container-image-name "$ACR_NAME.azurecr.io/$IMAGE_NAME"

# 7. Configurar Variables de Entorno
echo "Configurando variables de entorno..."
# Generar una APP_KEY
APP_KEY=$(php artisan key:generate --show)

az webapp config appsettings set --resource-group $RESOURCE_GROUP --name $WEB_APP_NAME --settings \
    APP_KEY="$APP_KEY" \
    APP_ENV="production" \
    APP_DEBUG="false" \
    LOG_CHANNEL="stderr" \
    WEBSITES_PORT="80"

echo "¡Despliegue completado! Tu app debería estar disponible en: https://$WEB_APP_NAME.azurewebsites.net"
