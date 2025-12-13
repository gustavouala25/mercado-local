<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Definición de Categorías Fijas
        $categoryNames = [
            'Tecnología',
            'Moda e Indumentaria',
            'Hogar y Muebles',
            'Carnicería y Granja',
            'Alimentos y Bebidas',
            'Herramientas y Construcción',
            'Vehículos y Repuestos',
            'Servicios',
        ];

        $categories = collect();

        foreach ($categoryNames as $name) {
            $categories->push(\App\Models\Category::factory()->create([
                'name' => $name,
                'slug' => \Illuminate\Support\Str::slug($name),
            ]));
        }

        // 2. Generación de Vendedores y Productos
        // Crea 10 Vendedores (cada uno asociado a un Usuario)
        $vendors = \App\Models\Vendor::factory()->count(10)->create();

        // Crea 100 Productos usando el Factory
        // CRÍTICO: Asignar category_id y vendor_id de las colecciones creadas
        // Pasamos null a make() para evitar que el factory cree categorías y vendedores extra innecesariamente
        \App\Models\Product::factory()->count(100)->make([
            'category_id' => null,
            'vendor_id' => null,
        ])->each(function ($product) use ($categories, $vendors) {
            $product->category_id = $categories->random()->id;
            $product->vendor_id = $vendors->random()->id;
            
            // Opcional: Intentar asignar imágenes acordes si se desea lógica extra aquí,
            // pero por ahora confiamos en el placeholder del factory.
            
            $product->save();
        });
        
        // Create a test user for login
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
