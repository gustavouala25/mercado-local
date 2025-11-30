<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Filament\Resources\ProductResource;

echo "Checking 'views' column in 'products' table...\n";
if (Schema::hasColumn('products', 'views')) {
    echo "Column 'views' EXISTS.\n";
} else {
    echo "Column 'views' MISSING.\n";
    exit(1);
}

echo "Checking 'products.show' route...\n";
if (Route::has('products.show')) {
    echo "Route 'products.show' EXISTS.\n";
} else {
    echo "Route 'products.show' MISSING.\n";
    exit(1);
}

echo "Checking HomeController::show...\n";
if (method_exists(HomeController::class, 'show')) {
    echo "Method HomeController::show EXISTS.\n";
} else {
    echo "Method HomeController::show MISSING.\n";
    exit(1);
}

echo "Checking ProductResource QR Action...\n";
$resourceContent = file_get_contents(__DIR__ . '/app/Filament/Resources/ProductResource.php');
if (strpos($resourceContent, "Action::make('qr_code')") !== false) {
    echo "QR Action found in ProductResource.\n";
} else {
    echo "QR Action MISSING in ProductResource.\n";
    exit(1);
}

echo "Verification Complete.\n";
