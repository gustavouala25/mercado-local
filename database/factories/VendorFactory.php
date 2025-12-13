<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Kiosco El Paso', 'Modas Juana', 'TecnoFix', 'Almacén Don Pepe', 
            'Librería El Estudiante', 'Ferretería Central', 'Juguetería Mágica', 
            'Farmacia Salud', 'Deportes Total', 'Panadería La Espiga',
            'ElectroHogar', 'Zapatería Pisadas', 'Muebles Confort', 'PetShop Amigos'
        ]);

        return [
            'user_id' => User::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
            'whatsapp_number' => fake()->phoneNumber(),
            'location' => fake()->address(),
            'logo' => null,
        ];
    }
}
