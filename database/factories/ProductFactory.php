<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Coca Cola 1.5L', 'Mate de Calabaza', 'Remera de Algodón', 'Cargador USB-C', 
            'Auriculares Bluetooth', 'Zapatillas Deportivas', 'Libro Best Seller', 
            'Juego de Mesa', 'Martillo', 'Shampoo 400ml', 'Café Tostado', 'Galletitas Variadas',
            'Smartwatch', 'Mochila Urbana', 'Pelota de Fútbol', 'Lámpara LED', 
            'Silla de Oficina', 'Teclado Mecánico', 'Mouse Inalámbrico', 'Monitor 24"',
            'Botella de Agua', 'Toalla de Baño', 'Sábana 2 Plazas', 'Almohada Viscoelástica',
            'Cerveza Artesanal', 'Vino Malbec', 'Queso Cremoso', 'Jamón Cocido'
        ]);

        return [
            'vendor_id' => Vendor::factory(),
            'category_id' => Category::factory(),
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::random(5), // Ensure uniqueness
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 1000, 50000),
            'image_path' => 'https://placehold.co/400x400/orange/white?text=Producto', 
            'is_featured' => fake()->boolean(20), // 20% chance of being featured
            'is_active' => true,
            'views' => fake()->numberBetween(0, 1000),
        ];
    }
}
