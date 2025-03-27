<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pedido::create([
            'usuario_id' => 3, // ID del comprador
            'estado' => 'pendiente',
            'total' => 50.00,
        ]);

        Pedido::create([
            'usuario_id' => 3, // ID del comprador
            'estado' => 'entregado',
            'total' => 30.00,
        ]);
    }
}
