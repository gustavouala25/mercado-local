<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Filament\Resources\VendorResource;
use App\Filament\Resources\CategoryResource;
use App\Filament\Resources\ProductResource;

echo "Checking VendorResource...\n";
if (VendorResource::getModelLabel() === 'Vendedor' && VendorResource::getPluralModelLabel() === 'Vendedores') {
    echo "VendorResource labels OK.\n";
} else {
    echo "VendorResource labels INCORRECT.\n";
    exit(1);
}

echo "Checking CategoryResource...\n";
if (CategoryResource::getModelLabel() === 'Categoría' && CategoryResource::getPluralModelLabel() === 'Categorías') {
    echo "CategoryResource labels OK.\n";
} else {
    echo "CategoryResource labels INCORRECT.\n";
    exit(1);
}

echo "Checking ProductResource...\n";
if (ProductResource::getModelLabel() === 'Producto' && ProductResource::getPluralModelLabel() === 'Productos') {
    echo "ProductResource labels OK.\n";
} else {
    echo "ProductResource labels INCORRECT.\n";
    exit(1);
}

// Check for specific form labels (structural check)
$productResourceContent = file_get_contents(__DIR__ . '/app/Filament/Resources/ProductResource.php');
if (strpos($productResourceContent, "label('Nombre del Producto')") !== false) {
    echo "ProductResource form label 'Nombre del Producto' found.\n";
} else {
    echo "ProductResource form label 'Nombre del Producto' MISSING.\n";
    exit(1);
}

echo "Verification Complete.\n";
