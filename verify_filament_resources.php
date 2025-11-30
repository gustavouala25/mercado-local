<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Filament\Resources\CategoryResource;
use App\Filament\Resources\ProductResource;
use Filament\Forms\Form;
use Filament\Tables\Table;

echo "Checking CategoryResource...\n";
if (method_exists(CategoryResource::class, 'form') && method_exists(CategoryResource::class, 'table')) {
    echo "CategoryResource has form and table methods.\n";
} else {
    echo "CategoryResource MISSING form or table methods.\n";
    exit(1);
}

echo "Checking ProductResource...\n";
if (method_exists(ProductResource::class, 'form') && method_exists(ProductResource::class, 'table')) {
    echo "ProductResource has form and table methods.\n";
} else {
    echo "ProductResource MISSING form or table methods.\n";
    exit(1);
}

// Structural check (simplified)
$productResourceContent = file_get_contents(__DIR__ . '/app/Filament/Resources/ProductResource.php');
if (strpos($productResourceContent, "relationship('category', 'name')") !== false) {
    echo "ProductResource contains category relationship in form/filter.\n";
} else {
    echo "ProductResource MISSING category relationship.\n";
    exit(1);
}

echo "Verification Complete.\n";
