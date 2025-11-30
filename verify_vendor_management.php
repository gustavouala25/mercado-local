<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Vendor;

echo "Checking 'user_id' column in 'vendors' table...\n";
if (Schema::hasColumn('vendors', 'user_id')) {
    echo "Column 'user_id' EXISTS.\n";
} else {
    echo "Column 'user_id' MISSING.\n";
    exit(1);
}

echo "Checking User-Vendor Relationship...\n";
if (method_exists(User::class, 'vendor')) {
    echo "User::vendor() method EXISTS.\n";
} else {
    echo "User::vendor() method MISSING.\n";
    exit(1);
}

echo "Checking Vendor-User Relationship...\n";
if (method_exists(Vendor::class, 'user')) {
    echo "Vendor::user() method EXISTS.\n";
} else {
    echo "Vendor::user() method MISSING.\n";
    exit(1);
}

echo "Checking Routes...\n";
$routes = ['dashboard', 'vendor.store', 'vendor.products.create', 'vendor.products.store'];
foreach ($routes as $route) {
    if (Route::has($route)) {
        echo "Route '$route' EXISTS.\n";
    } else {
        echo "Route '$route' MISSING.\n";
        exit(1);
    }
}

echo "Checking Controllers...\n";
if (class_exists('App\Http\Controllers\VendorController') && class_exists('App\Http\Controllers\VendorProductController')) {
    echo "Controllers EXIST.\n";
} else {
    echo "Controllers MISSING.\n";
    exit(1);
}

echo "Verification Complete.\n";
