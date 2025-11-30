<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Http\Controllers\HomeController;

echo "Checking HomeController...\n";

if (class_exists(HomeController::class)) {
    echo "Class HomeController exists.\n";
} else {
    echo "Class HomeController NOT found.\n";
    exit(1);
}

$controller = new HomeController();
if (method_exists($controller, 'index')) {
    echo "Method index() exists.\n";
} else {
    echo "Method index() NOT found.\n";
}

echo "Verification Complete.\n";
