<?php

use Illuminate\Database\Seeder;
use App\Models\OficinaVirtual\Pedido;
use App\Models\OficinaVirtual\PedidoAdjunto as Adjunto;

class PedidoAdjuntosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adjunto = new Adjunto();
        $adjunto->fill([
            'titulo' => 'Factura',
            'path'   => '1463685933.0642_p1.pdf'
        ]);
        $adjunto->pedido()->associate(Pedido::find(3));
        $adjunto->save();

        $adjunto = new Adjunto();
        $adjunto->fill([
            'titulo' => 'Factura',
            'path'   => '1463685977.4638_p2.pdf'
        ]);
        $adjunto->pedido()->associate(Pedido::find(4));
        $adjunto->save();
    }
}
