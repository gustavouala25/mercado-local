<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Peluquería' => '✂️',
            'Kiosco' => '🍬',
            'Panadería' => '🥖',
            'Tecnología' => '💻',
            'Servicios' => '🛠️',
            'Comida' => '🍔',
            'Indumentaria' => '👕',
        ];

        foreach ($categories as $name => $icon) {
            Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'icon' => $icon,
                ]
            );
        }
    }
}
