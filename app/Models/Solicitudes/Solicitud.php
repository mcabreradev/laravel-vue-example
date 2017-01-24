<?php

namespace App\Models\Solicitudes;

use Carbon\Carbon;
use App\Models\AppModel;

class Solicitud extends AppModel
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'solicitudes';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'solicitudes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion',
        'creado_el',
        'observaciones',
        'lat',
        'lng',
        'lugar_calle',
        'lugar_numero',
        'lugar_entre_1',
        'lugar_entre_2',
        'lugar_observaciones',
        'origen_id',
        'tipo_id',
        'estado_id',
        'prioridad_id',
        'solicitante_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * [$dates description]
     * @var [type]
     */
    protected $dates = ['created_at', 'updated_at', 'creado_el'];

    /**
     * Incluye estos campos en la query
     * @var [type]
     */
    protected $appends = ['ubicacion'];

    /**
     * La fecha el que fue creada la solicutud
     *
     * @param  {value} $value [description]
     */
    public function getCreadoElAttribute($value){
        return $value;
    }

    /**
     * Setea la latitud por defecto
     *
     * @param {decimal} $value
     */
    public function setLatAttribute($value){
        $this->attributes['lat'] = $value == "" ? null : $value;
    }

    /**
     * Setea la longitud por defecto
     *
     * @param {decimal} $value
     */
    public function setLngAttribute($value){
        $this->attributes['lng'] = $value == "" ? null : $value;
    }

    /**
     * Setea el origen por defecto
     *
     * @param {int} $value
     */
    public function setOrigenIdAttribute($value){
        $this->attributes['origen_id'] = $value == "" ? null : $value;
    }

    /**
     * Setea el tipo por defecto
     *
     * @param {int} $value
     */
    public function setTipoIdAttribute($value){
        $this->attributes['tipo_id'] = $value == "" ? null : $value;
    }

    /**
     * Setea el estado por defecto
     *
     * @param {int} $value
     */
    public function setEstadoIdAttribute($value){
        $this->attributes['estado_id'] = $value == "" ? null : $value;
    }

    /**
     * Setea la prioridad por defecto
     *
     * @param {int} $value
     */
    public function setPrioridadIdAttribute($value){
        $this->attributes['prioridad_id'] = $value == "" ? null : $value;
    }

    /**
     * Setea el lugar calle por defecto
     *
     * @param {int} $value
     */
    public function setLugarCalleAttribute($value){
        $this->attributes['lugar_calle'] = $value == "" ? null : $value;
    }

    /**
     * Setea el lugar numero por defecto
     *
     * @param {int} $value
     */
    public function setLugarNumeroAttribute($value){
        $this->attributes['lugar_numero'] = $value == "" ? null : $value;
    }

    /**
     * Setea el lugar entre 1 por defecto
     *
     * @param {int} $value
     */
    public function setLugarEntre1Attribute($value){
        $this->attributes['lugar_entre_1'] = $value == "" ? null : $value;
    }

    /**
     * Setea el lugar entre 2 por defecto
     *
     * @param {int} $value
     */
    public function setLugarEntre2Attribute($value){
        $this->attributes['lugar_entre_2'] = $value == "" ? null : $value;
    }

    /**
     * Setea el lugar obeservaciones por defecto
     *
     * @param {int} $value
     */
    public function setLugarObservacionesAttribute($value){
        $this->attributes['lugar_observaciones'] = $value == "" ? null : $value;
    }

    /**
     * Obtiene la ubicacion
     *
     * @return {string} La ubicacion dependiendo las condiciones dadas
     */
    public function getUbicacionAttribute(){
        // Todos los campos cargados
        if( (null !== $this->lugar_calle) &&
            (null !== $this->lugar_numero) &&
            (null !== $this->lugar_entre_1) &&
            (null !== $this->lugar_entre_2) &&
            (null !== $this->lugar_observaciones) ){
            return "{$this->lugar_calle} {$this->lugar_numero}, entre {$this->lugar_entre_1} y {$this->lugar_entre_2} ({$this->lugar_observaciones})";
        }

        // Sólo calle y/o nro
        if((null !== $this->lugar_calle) &&
            (null !== $this->lugar_numero) &&
            (null === $this->lugar_entre_1) &&
            (null === $this->lugar_entre_2) &&
            (null === $this->lugar_observaciones)){
            return "{$this->lugar_calle} {$this->lugar_numero}";
        }

        // Calle y/o nro más observaciones
        if((null !== $this->lugar_calle) &&
            (null !== $this->lugar_numero) &&
            (null === $this->lugar_entre_1) &&
            (null === $this->lugar_entre_2) &&
            (null !== $this->lugar_observaciones)){
            return "{$this->lugar_calle} {$this->lugar_numero} ({$this->lugar_observaciones})";
        }

        // Sólo entre
        if((null === $this->lugar_calle) &&
            (null === $this->lugar_numero) &&
            (null !== $this->lugar_entre_1) &&
            (null !== $this->lugar_entre_2) &&
            (null === $this->lugar_observaciones)){
            return "entre {$this->lugar_entre_1} y {$this->lugar_entre_2}";
        }

        // Entre más observaciones:
        if((null === $this->lugar_calle) &&
            (null === $this->lugar_numero) &&
            (null !== $this->lugar_entre_1) &&
            (null !== $this->lugar_entre_2) &&
            (null !== $this->lugar_observaciones)){
            return "entre {$this->lugar_entre_1} y {$this->lugar_entre_2} ({$this->lugar_observaciones})";
        }

        // Sólo observaciones
        if((null === $this->lugar_calle) &&
            (null === $this->lugar_numero) &&
            (null === $this->lugar_entre_1) &&
            (null === $this->lugar_entre_2) &&
            (null !== $this->lugar_observaciones)){
            return "({$this->lugar_observaciones})";
        }

        else {
            return null;
        }
    }

    /**
     * El origen de la solicitud
     *
     * @return {Collection}
     */
    public function origen()
    {
        return $this->belongsTo('App\Models\Solicitudes\Origen');
    }

    /**
     * El tipo de solicitud
     *
     * @return {Collection}
     */
    public function tipo()
    {
        return $this->belongsTo('App\Models\Solicitudes\Tipo');
    }

    /**
     * El estado de la solicitud
     *
     * @return {Collection}
     */
    public function estado()
    {
        return $this->belongsTo('App\Models\Solicitudes\Estado');
    }

    /**
     * La prioridad de la solicitud
     *
     * @return {Collection}
     */
    public function prioridad()
    {
        return $this->belongsTo('App\Models\Solicitudes\Prioridad');
    }

    /**
     * El solicitante de la solicitud
     *
     * @return {Collection}
     */
    public function solicitante()
    {
        return $this->belongsTo('App\Models\Solicitudes\Solicitante');
    }

    /**
     * Las derivaciones de la solicitud
     *
     * @return {Collection}
     */
    public function derivaciones()
    {
        return $this->hasMany('App\Models\Solicitudes\Derivacion', 'solicitud_id');
    }

    /**
     * La ultima derivacion de la solicitud
     *
     * @return {Collection}
     */
    public function derivacion()
    {
        return $this->hasOne('App\Models\Solicitudes\Derivacion', 'solicitud_id')->orderBy('id', 'desc');;
    }

    /**
    *
    *   Metodo custom para obtener la ubicaciones..  parece como cuando estaba junior, esto es muy cabeza.. sorry :(
    */
    public function getUbicacion(){
        // Todos los campos cargados
        if(
            (null !== $this->lugar_calle) &&
            (null !== $this->lugar_numero) &&
            (null !== $this->lugar_entre_1) &&
            (null !== $this->lugar_entre_2) &&
            (null !== $this->lugar_observaciones)
        ){
            return "{$this->lugar_calle} {$this->lugar_numero}, entre {$this->lugar_entre_1} y {$this->lugar_entre_2} ({$this->lugar_observaciones})";
        }

        // Sólo calle y/o nro
        if(
            (null !== $this->lugar_calle) &&
            (null !== $this->lugar_numero) &&
            (null === $this->lugar_entre_1) &&
            (null === $this->lugar_entre_2) &&
            (null === $this->lugar_observaciones)
        ){
            return "{$this->lugar_calle} {$this->lugar_numero}";
        }

        // Calle y/o nro más observaciones
        if(
            (null !== $this->lugar_calle) &&
            (null !== $this->lugar_numero) &&
            (null === $this->lugar_entre_1) &&
            (null === $this->lugar_entre_2) &&
            (null !== $this->lugar_observaciones)
        ){
            return "{$this->lugar_calle} {$this->lugar_numero} ({$this->lugar_observaciones})";
        }

        // Sólo entre
        if(
            (null === $this->lugar_calle) &&
            (null === $this->lugar_numero) &&
            (null !== $this->lugar_entre_1) &&
            (null !== $this->lugar_entre_2) &&
            (null === $this->lugar_observaciones)
        ){
            return "entre {$this->lugar_entre_1} y {$this->lugar_entre_2}";
        }

        // Entre más observaciones:
        if(
            (null === $this->lugar_calle) &&
            (null === $this->lugar_numero) &&
            (null !== $this->lugar_entre_1) &&
            (null !== $this->lugar_entre_2) &&
            (null !== $this->lugar_observaciones)
        ){
            return "entre {$this->lugar_entre_1} y {$this->lugar_entre_2} ({$this->lugar_observaciones})";
        }

        // Sólo observaciones
        if(
            (null === $this->lugar_calle) &&
            (null === $this->lugar_numero) &&
            (null === $this->lugar_entre_1) &&
            (null === $this->lugar_entre_2) &&
            (null !== $this->lugar_observaciones)
        ){
            return "({$this->lugar_observaciones})";
        }
        else{
            return null;
        }
    }
}
