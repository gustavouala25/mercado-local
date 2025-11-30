<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Category;
use Illuminate\Support\Facades\Schema;

echo "Checking Categories...\n";
$count = Category::count();
echo "Category Count: $count\n";

if ($count > 0) {
    echo "Categories found.\n";
    foreach (Category::all() as $category) {
        echo "- {$category->name} ({$category->icon})\n";
    }
} else {
    echo "No categories found.\n";
    exit(1);
}

echo "\nChecking Products Table...\n";
if (Schema::hasColumn('products', 'category_id')) {
    echo "Column 'category_id' exists in 'products' table.\n";
} else {
    echo "Column 'category_id' MISSING in 'products' table.\n";
    exit(1);
}

echo "Verification Complete.\n";
