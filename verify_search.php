<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;

echo "Checking HomeController...\n";
$controller = new HomeController();

if (method_exists($controller, 'index')) {
    $reflection = new ReflectionMethod($controller, 'index');
    $params = $reflection->getParameters();
    if (count($params) > 0 && $params[0]->getType() && $params[0]->getType()->getName() === Request::class) {
        echo "Method index() accepts Request object.\n";
    } else {
        echo "Method index() does NOT accept Request object correctly.\n";
        exit(1);
    }
} else {
    echo "Method index() NOT found.\n";
    exit(1);
}

echo "Verification Complete.\n";
