<?php

namespace App\Models\OficinaVirtual;

use App\Models\AppModel;

class Pedido extends AppModel
{

    /**
     * [$ESTADOS description]
     * @var [type]
     */
    public static $ESTADOS = [
        'pendiente',
        'generado',
        'entregado'
    ];

    /**
     * Localidades permitidas
     * @var array
     */
    public static $LOCALIDADES = [
        'tolhuin' => 'Tolhuin',
        'ushuaia' => 'Ushuaia'
    ];

    /**
     * Metodos entrega
     * @var [type]
     */
    public static $METODOS_ENTREGA = [
        'domicilio'     => 'Envío a domicilio',
        'email'         => 'Por email',
        'personalmente' => 'Retira personalmente'
    ];

    /**
     * Origenes permitios
     * @var array
     */
    public static $ORIGENES = [
        'chat'     => 'Chat',
        'email'    => 'Email',
        'facebook' => 'Facebook',
        'personal' => 'Personal',
        'telefono' => 'Telefónico',
        'twitter'  => 'Twitter',
        'whatsapp' => 'Whatsapp',
        'web'      => 'Web'
    ];

    /**
     * Tipos permitidos
     * @var array
     */
    public static $TIPOS = [
        'factura'     => 'Factura',
        'libre-deuda' => 'Libre deuda'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo', 'domicilio', 'localidad', 'nomenclatura', 'metodo_entrega', 
        'origen', 'prioritario', 'descripcion', 'observaciones', 'motivo_cancelacion'
    ];

    /**
     * Relacion con el usuario que genero el pedido
     * @return App\Models\OficinaVirtual\Usuario Usuario que genero el pedido
     */
    public function usuario()
    {
        return $this->belongsTo('App\Models\OficinaVirtual\Usuario');
    }

    /**
     * Relacion con sus adjuntos
     * @return Collection Adjuntos del pedido
     */
    public function adjuntos()
    {
        return $this->hasMany('App\Models\OficinaVirtual\Adjunto');
    }

    /**
     * Obtiene el string mostrable al usuario de localidad
     * @return string Nombre de la localidad
     */
    public function getLocalidadMostrable()
    {
        return $this::$LOCALIDADES[$this->localidad];
    }

    /**
     * Obtiene el string mostrable al usuario de metodo_entrega
     * @return string Metodo de entrega
     */
    public function getMetodoEntregaMostrable()
    {
        return $this::$METODOS_ENTREGA[$this->metodo_entrega];
    }

    /**
     * Obtiene el string mostrable al usuario de los origenes
     * @return string Origen
     */
    public function getOrigenMostrable()
    {
        return $this::$ORIGENES[$this->origen];
    }

    /**
     * Obtiene el string mostrable al usuario de Tipo
     * @return string Tipo de pedido
     */
    public function getTipoMostrable()
    {
        return $this::$TIPOS[$this->tipo];
    }
}
