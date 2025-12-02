<?php

use App\Models\Category;
use App\Models\Product;

test('home page loads and shows featured products', function () {
    $featuredProduct = Product::factory()->create([
        'is_featured' => true,
        'is_active' => true,
        'name' => 'Featured Item',
    ]);

    $response = $this->get(route('market.index'));

    $response->assertStatus(200);
    $response->assertSee('Featured Item');
});

test('strict category filtering works', function () {
    $motoCategory = Category::factory()->create(['name' => 'Motos', 'slug' => 'motos']);
    $panaderiaCategory = Category::factory()->create(['name' => 'Panadería', 'slug' => 'panaderia']);

    $motoProduct = Product::factory()->create([
        'category_id' => $motoCategory->id,
        'name' => 'Moto Yamaha',
        'is_active' => true,
        'is_featured' => true,
    ]);

    $panProduct = Product::factory()->create([
        'category_id' => $panaderiaCategory->id,
        'name' => 'Pan Casero',
        'is_active' => true,
        'is_featured' => true,
    ]);

    // Visit with category=motos
    $response = $this->get(route('market.index', ['category' => 'motos']));

    $response->assertStatus(200);
    $response->assertSee('Moto Yamaha');
    $response->assertDontSee('Pan Casero');
    $response->assertSee('Explorando:');
    $response->assertSee('Motos');
});
