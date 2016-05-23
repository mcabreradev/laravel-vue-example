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
        $pedido->fill([
            'solicitante_apellido' => 'Viera',
            'solicitante_nombre'   => 'Miguel',
            'solicitante_email'    => 'vmigue@gmail.com',
            'solicitante_telefono' => '2901454566',
            'estado'               => 'pendiente',
            'descripcion'          => 'Tengo un pedido',
            'tipo'                 => 'factura',
            'localidad'            => 'ushuaia',
            'domicilio'            => 'Kuanip 1866',
            'nomenclatura'         => 'U 3 0088 0032',
            'origen'               => 'web',
            'prioritario'          => false,
            'metodo_entrega'       => 'domicilio',
            'observaciones'        => 'Período: impagos'
        ]);
        $pedido->usuario()->associate(Usuario::find(1));
        $pedido->save();

        $pedido = new Pedido();
        $pedido->fill([
            'solicitante_apellido' => 'Soler',
            'solicitante_nombre'   => 'Rosina',
            'solicitante_email'    => 'rosina@gmail.com',
            'solicitante_telefono' => '2901978679',
            'estado'               => 'generado',
            'descripcion'          => 'Necesito un libre deuda',
            'tipo'                 => 'libre-deuda',
            'localidad'            => 'ushuaia',
            'domicilio'            => 'Kuanip 1833',
            'nomenclatura'         => 'C 3 1088 1032',
            'origen'               => 'chat',
            'prioritario'          => true,
            'metodo_entrega'       => 'personalmente'
        ]);
        $pedido->usuario()->associate(Usuario::find(2));
        $pedido->save();

        $pedido = new Pedido();
        $pedido->fill([
            'solicitante_apellido' => 'González',
            'solicitante_nombre'   => 'Federico',
            'solicitante_email'    => 'fede@gmail.com',
            'solicitante_telefono' => '2901776655',
            'estado'               => 'entregado',
            'descripcion'          => 'Quiero mi factura',
            'tipo'                 => 'factura',
            'localidad'            => 'tolhuin',
            'domicilio'            => 'San Martin 244',
            'nomenclatura'         => 'D 3 0010 0009',
            'origen'               => 'whatsapp',
            'prioritario'          => true,
            'metodo_entrega'       => 'email',
            'observaciones'        => 'Perido: Último facturado'
        ]);
        $pedido->usuario()->associate(Usuario::find(2));
        $pedido->save();

        $pedido = new Pedido();
        $pedido->fill([
            'solicitante_apellido' => 'Pérez',
            'solicitante_nombre'   => 'Vanesa',
            'solicitante_email'    => 'vane@gmail.com',
            'solicitante_telefono' => '2901998813',
            'estado'               => 'cancelado',
            'descripcion'          => 'Generado por personal de la DPOSS',
            'tipo'                 => 'libre-deuda',
            'localidad'            => 'ushuaia',
            'domicilio'            => 'Isla de los Estados 1432',
            'nomenclatura'         => 'K 3 1110 1009',
            'origen'               => 'twitter',
            'prioritario'          => false,
            'metodo_entrega'       => 'domicilio',
            'motivo_cancelacion'   => 'Faltan datos'
        ]);
        $pedido->usuario()->associate(Usuario::find(1));
        $pedido->save();
    }
}
