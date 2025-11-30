<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Http\Controllers\PublicMarketController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

// Mock the Controller to test logic without full HTTP request cycle (which needs DB for route model binding)
// We will manually call the methods and mock the Eloquent calls if possible, or just instantiate the controller and check method existence.
// Since we can't easily mock static Eloquent calls without a testing framework like Mockery or Laravel's testing tools (which run against DB usually),
// we will do a basic structural check and a "dry run" of the controller instantiation.

echo "Checking PublicMarketController...\n";

if (class_exists(PublicMarketController::class)) {
    echo "Class PublicMarketController exists.\n";
} else {
    echo "Class PublicMarketController NOT found.\n";
    exit(1);
}

$controller = new PublicMarketController();
if (method_exists($controller, 'index')) {
    echo "Method index() exists.\n";
} else {
    echo "Method index() NOT found.\n";
}

if (method_exists($controller, 'show')) {
    echo "Method show() exists.\n";
} else {
    echo "Method show() NOT found.\n";
}

// Check Routes
echo "\nChecking Routes...\n";
$routes = Illuminate\Support\Facades\Route::getRoutes();
$indexRoute = $routes->getByName('market.index');
$showRoute = $routes->getByName('market.show');

if ($indexRoute) {
    echo "Route 'market.index' found: " . $indexRoute->uri() . "\n";
} else {
    echo "Route 'market.index' NOT found.\n";
}

if ($showRoute) {
    echo "Route 'market.show' found: " . $showRoute->uri() . "\n";
} else {
    echo "Route 'market.show' NOT found.\n";
}

echo "\nVerification Complete (Structural).\n";
