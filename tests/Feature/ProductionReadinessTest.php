<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;

test('home loads ok', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});

test('categories structure', function () {
    $this->seed();

    $expectedCategories = [
        'Tecnología',
        'Moda e Indumentaria',
        'Hogar y Muebles',
        'Carnicería y Granja',
        'Alimentos y Bebidas',
        'Herramientas y Construcción',
        'Vehículos y Repuestos',
        'Servicios',
    ];

    foreach ($expectedCategories as $categoryName) {
        $this->assertDatabaseHas('categories', [
            'name' => $categoryName,
        ]);
    }
});

test('vendor public page', function () {
    $user = User::factory()->create();
    $vendor = Vendor::factory()->create([
        'user_id' => $user->id,
        'slug' => 'tienda-prueba',
        'name' => 'Tienda Prueba',
    ]);
    
    $product = Product::factory()->create([
        'vendor_id' => $vendor->id,
        'name' => 'Producto de Prueba',
        'is_active' => true,
    ]);

    $response = $this->get('/tienda/tienda-prueba');
    
    $response->assertStatus(200);
    $response->assertSee('Tienda Prueba');
    $response->assertSee('Producto de Prueba');
});

test('security admin firewall', function () {
    $user = User::factory()->create([
        'is_admin' => false,
    ]);

    $response = $this->actingAs($user)->get('/admin');
    
    $response->assertForbidden();
});

test('whatsapp link generation', function () {
    $user = User::factory()->create();
    $vendor = Vendor::factory()->create([
        'user_id' => $user->id,
        'whatsapp_number' => '5491112345678',
    ]);
    
    $product = Product::factory()->create([
        'vendor_id' => $vendor->id,
        'name' => 'Producto WhatsApp',
    ]);

    // Force refresh to ensure accessors work
    $product->refresh();

    $expectedLinkStart = 'https://wa.me/5491112345678?text=';
    $expectedText = urlencode("Hola, vi Producto WhatsApp en el Marketplace y me interesa");
    
    expect($product->whatsapp_link)->toBe($expectedLinkStart . $expectedText);
});
