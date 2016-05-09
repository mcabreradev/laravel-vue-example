<?php

use Illuminate\Database\Seeder;
use App\Models\OficinaVirtual\Pedido;
use App\Models\OficinaVirtual\Usuario;

class PedidosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pedido = new Pedido();
        $pedido->estado         = 'pendiente';
        $pedido->descripcion    = 'Tengo un pedido';
        $pedido->tipo           = 'factura';
        $pedido->localidad      = 'ushuaia';
        $pedido->domicilio      = 'Kuanip 1866';
        $pedido->nomenclatura   = 'U 3 0088 0032';
        $pedido->origen         = 'web';
        $pedido->prioritario    = true;
        $pedido->metodo_entrega = 'domicilio';
        $pedido->observaciones  = "Perido:04/2016";
        $pedido->usuario()->associate(Usuario::find(1));
        $pedido->save();

        $pedido = new Pedido();
        $pedido->estado         = 'generado';
        $pedido->descripcion    = 'Mi primer pedido';
        $pedido->tipo           = 'libre-deuda';
        $pedido->localidad      = 'ushuaia';
        $pedido->domicilio      = 'Kuanip 1866';
        $pedido->nomenclatura   = 'C 3 1088 1032';
        $pedido->origen         = 'chat';
        $pedido->prioritario    = false;
        $pedido->metodo_entrega = 'personalmente';
        $pedido->observaciones  = "Perido:05/2016";
        $pedido->usuario()->associate(Usuario::find(2));
        $pedido->save();

        $pedido = new Pedido();
        $pedido->estado         = 'entregado';
        $pedido->descripcion    = 'Quiero mi factura';
        $pedido->tipo           = 'factura';
        $pedido->localidad      = 'tolhuin';
        $pedido->domicilio      = 'San Martin 244';
        $pedido->nomenclatura   = 'D 3 0010 0009';
        $pedido->origen         = 'whatsapp';
        $pedido->prioritario    = false;
        $pedido->metodo_entrega = 'email';
        $pedido->observaciones  = "Perido:03/2016";
        $pedido->usuario()->associate(Usuario::find(1));
        $pedido->save();
    }
}
