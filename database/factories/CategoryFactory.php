<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Tecnología', 'Indumentaria', 'Alimentos', 'Hogar', 'Juguetes',
            'Deportes', 'Libros', 'Mascotas', 'Herramientas', 'Salud y Belleza'
        ]);
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'icon' => fake()->randomElement(['🛍️', '🍔', '💻', '👗', '🚗', '⚽', '📚', '🐶', '🔧', '💄']),
        ];
    }
}
