<?php

use App\Models\Product;
use App\Models\Vendor;

test('whatsapp_link accessor returns correct url', function () {
    $vendor = Vendor::factory()->create([
        'whatsapp_number' => '5491112345678',
    ]);

    $product = Product::factory()->create([
        'vendor_id' => $vendor->id,
        'name' => 'Super Producto',
    ]);

    $expectedText = urlencode("Hola, vi Super Producto en el Marketplace y me interesa");
    $expectedUrl = "https://wa.me/5491112345678?text={$expectedText}";

    expect($product->whatsapp_link)->toBe($expectedUrl);
});

test('whatsapp_link returns null if vendor has no number', function () {
    $vendor = Vendor::factory()->create([
        'whatsapp_number' => '',
    ]);

    $product = Product::factory()->create([
        'vendor_id' => $vendor->id,
    ]);

    expect($product->whatsapp_link)->toBeNull();
});
