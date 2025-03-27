<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        Producto::create([
            'nombre' => 'Manzanas',
            'descripcion' => 'Manzanas frescas y orgánicas.',
            'precio' => 2.50,
            'cantidad_disponible' => 100,
            'agricultor_id' => 2, // ID del agricultor
        ]);

        Producto::create([
            'nombre' => 'Naranjas',
            'descripcion' => 'Naranjas jugosas y dulces.',
            'precio' => 3.00,
            'cantidad_disponible' => 50,
            'agricultor_id' => 2, // ID del agricultor
        ]);
    }
}
