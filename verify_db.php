<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Vendor;
use App\Models\Product;

// Create a Vendor (In-memory)
$vendor = new Vendor([
    'name' => 'Test Vendor',
    'slug' => 'test-vendor',
    'whatsapp_number' => '+1234567890',
    'location' => 'Test Location',
]);

echo "Vendor created (in-memory): " . $vendor->name . "\n";

// Create a Product (In-memory)
$product = new Product([
    'name' => 'Test Product',
    'slug' => 'test-product',
    'description' => 'Test Description',
    'price' => 100.00,
    'image_path' => 'path/to/image.jpg',
]);

// Manually set the relationship
$product->setRelation('vendor', $vendor);

echo "Product created (in-memory): " . $product->name . "\n";
echo "Product belongs to: " . $product->vendor->name . "\n";

// Verify WhatsApp Link
echo "WhatsApp Link: " . $product->whatsapp_link . "\n";

$expectedLink = "https://wa.me/+1234567890?text=" . urlencode("Hola, vi Test Product en el Marketplace y me interesa");
if ($product->whatsapp_link === $expectedLink) {
    echo "WhatsApp Link Correct.\n";
} else {
    echo "WhatsApp Link Incorrect. Expected: $expectedLink, Got: " . $product->whatsapp_link . "\n";
}

// Test null case
$vendor->whatsapp_number = null;
echo "WhatsApp Link (Null Number): " . ($product->whatsapp_link === null ? 'NULL (Correct)' : $product->whatsapp_link) . "\n";

$vendor->whatsapp_number = '';
echo "WhatsApp Link (Empty Number): " . ($product->whatsapp_link === null ? 'NULL (Correct)' : $product->whatsapp_link) . "\n";


