<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models\Alertas{
/**
 * App\Models\Alertas\NivelAguaRegistro
 *
 * @property integer $id
 * @property \Carbon\Carbon $registrado_el
 * @property integer $nivel_agua_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Alertas\NivelAgua $nivelAgua
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\NivelAguaRegistro whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\NivelAguaRegistro whereRegistradoEl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\NivelAguaRegistro whereNivelAguaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\NivelAguaRegistro whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\NivelAguaRegistro whereUpdatedAt($value)
 */
	class NivelAguaRegistro extends \Eloquent {}
}

namespace App\Models\Alertas{
/**
 * App\Models\Alertas\AlertaDetalle
 *
 * @property integer $id
 * @property integer $barrio_id
 * @property integer $alerta_id
 * @property integer $alertas_estado_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Geo\Barrio $barrio
 * @property-read \App\Models\Alertas\Estado $estado
 * @property-read \App\Models\Alertas\Alerta $alerta
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\AlertaDetalle whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\AlertaDetalle whereBarrioId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\AlertaDetalle whereAlertaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\AlertaDetalle whereAlertasEstadoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\AlertaDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\AlertaDetalle whereUpdatedAt($value)
 */
	class AlertaDetalle extends \Eloquent {}
}

namespace App\Models\Alertas{
/**
 * App\Models\Alertas\NivelAgua
 *
 * @property integer $id
 * @property string $titulo
 * @property string $descripcion
 * @property string $color
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Alertas\NivelAguaRegistro[] $nivelAguaRegistros
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\NivelAgua whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\NivelAgua whereTitulo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\NivelAgua whereDescripcion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\NivelAgua whereColor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\NivelAgua whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\NivelAgua whereUpdatedAt($value)
 */
	class NivelAgua extends \Eloquent {}
}

namespace App\Models\Alertas{
/**
 * App\Models\Alertas\Alerta
 *
 * @property integer $id
 * @property \Carbon\Carbon $inicia_el
 * @property \Carbon\Carbon $finaliza_el
 * @property string $descripcion
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Alertas\AlertaDetalle[] $detalles
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\Alerta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\Alerta whereIniciaEl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\Alerta whereFinalizaEl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\Alerta whereDescripcion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\Alerta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\Alerta whereUpdatedAt($value)
 */
	class Alerta extends \Eloquent {}
}

namespace App\Models\Alertas{
/**
 * App\Models\Alertas\Estado
 *
 * @property integer $id
 * @property string $titulo
 * @property string $color
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Alertas\AlertaDetalle[] $AlertaDetalles
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\Estado whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\Estado whereTitulo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\Estado whereColor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\Estado whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Alertas\Estado whereUpdatedAt($value)
 */
	class Estado extends \Eloquent {}
}

namespace App\Models\Admin{
/**
 * App\Models\Admin\User
 *
 * @property integer $id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $password
 * @property boolean $superadmin
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereFirstname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereLastname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereSuperadmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin\User whereDeletedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models\Solicitudes\Derivaciones{
/**
 * App\Models\Solicitudes\Derivaciones\Agente
 *
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property integer $legajo
 * @property string $telefono
 * @property string $email
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Solicitudes\Derivaciones\Derivacion[] $derivaciones
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Agente whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Agente whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Agente whereApellido($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Agente whereLegajo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Agente whereTelefono($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Agente whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Agente whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Agente whereUpdatedAt($value)
 */
	class Agente extends \Eloquent {}
}

namespace App\Models\Solicitudes\Derivaciones{
/**
 * App\Models\Solicitudes\Derivaciones\Area
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Solicitudes\Derivaciones\Derivacion[] $derivaciones
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Area whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Area whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Area whereDescripcion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Area whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Area whereUpdatedAt($value)
 */
	class Area extends \Eloquent {}
}

namespace App\Models\Solicitudes\Derivaciones{
/**
 * App\Models\Solicitudes\Derivaciones\Derivacion
 *
 * @property integer $id
 * @property string $derivado_el
 * @property string $observaciones
 * @property integer $solicitud_id
 * @property integer $area_id
 * @property integer $agente_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Derivacion whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Derivacion whereDerivadoEl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Derivacion whereObservaciones($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Derivacion whereSolicitudId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Derivacion whereAreaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Derivacion whereAgenteId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Derivacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Derivaciones\Derivacion whereUpdatedAt($value)
 */
	class Derivacion extends \Eloquent {}
}

namespace App\Models\Solicitudes{
/**
 * App\Models\Solicitudes\Prioridad
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $color
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Prioridad whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Prioridad whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Prioridad whereDescripcion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Prioridad whereColor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Prioridad whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Prioridad whereUpdatedAt($value)
 */
	class Prioridad extends \Eloquent {}
}

namespace App\Models\Solicitudes{
/**
 * App\Models\Solicitudes\Tipo
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $color
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Tipo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Tipo whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Tipo whereDescripcion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Tipo whereColor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Tipo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Tipo whereUpdatedAt($value)
 */
	class Tipo extends \Eloquent {}
}

namespace App\Models\Solicitudes{
/**
 * App\Models\Solicitudes\Origen
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $color
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Origen whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Origen whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Origen whereDescripcion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Origen whereColor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Origen whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Origen whereUpdatedAt($value)
 */
	class Origen extends \Eloquent {}
}

namespace App\Models\Solicitudes{
/**
 * App\Models\Solicitudes\Solicitante
 *
 * @property integer $id
 * @property string $apellido
 * @property string $nombre
 * @property integer $documento
 * @property string $telefono
 * @property string $celular
 * @property string $email
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitante whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitante whereApellido($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitante whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitante whereDocumento($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitante whereTelefono($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitante whereCelular($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitante whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitante whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitante whereUpdatedAt($value)
 */
	class Solicitante extends \Eloquent {}
}

namespace App\Models\Solicitudes{
/**
 * App\Models\Solicitudes\Estado
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $color
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Estado whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Estado whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Estado whereDescripcion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Estado whereColor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Estado whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Estado whereUpdatedAt($value)
 */
	class Estado extends \Eloquent {}
}

namespace App\Models\Solicitudes{
/**
 * App\Models\Solicitudes\Solicitud
 *
 * @property integer $id
 * @property string $descripcion
 * @property string $creado_el
 * @property string $observaciones
 * @property float $lat
 * @property float $lng
 * @property string $lugar_calle
 * @property string $lugar_numero
 * @property string $lugar_entre_1
 * @property string $lugar_entre_2
 * @property string $lugar_observaciones
 * @property integer $origen_id
 * @property integer $tipo_id
 * @property integer $estado_id
 * @property integer $prioridad_id
 * @property integer $solicitante_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Solicitudes\Origen $origen
 * @property-read \App\Models\Solicitudes\Tipo $tipo
 * @property-read \App\Models\Solicitudes\Estado $estado
 * @property-read \App\Models\Solicitudes\Prioridad $prioridad
 * @property-read \App\Models\Solicitudes\Solicitante $solicitante
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Solicitudes\Derivaciones\Derivacion[] $derivaciones
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitud whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitud whereDescripcion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitud whereCreadoEl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitud whereObservaciones($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitud whereLat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitud whereLng($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitud whereLugarCalle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitud whereLugarNumero($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitud whereLugarEntre1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitud whereLugarEntre2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitud whereLugarObservaciones($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitud whereOrigenId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitud whereTipoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitud whereEstadoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitud wherePrioridadId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitud whereSolicitanteId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitud whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Solicitudes\Solicitud whereUpdatedAt($value)
 */
	class Solicitud extends \Eloquent {}
}

namespace App\Models\Turnos{
/**
 * App\Models\Turnos\Turno
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $fecha
 * @property string $hora
 * @property boolean $atendido
 * @property string $observaciones
 * @property integer $usuario_id
 * @property integer $actividad_id
 * @property-read \App\Models\Turnos\Actividad $actividad
 * @property-read \App\Models\OficinaVirtual\Usuario $usuario
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Turno whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Turno whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Turno whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Turno whereFecha($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Turno whereHora($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Turno whereAtendido($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Turno whereObservaciones($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Turno whereUsuarioId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Turno whereActividadId($value)
 */
	class Turno extends \Eloquent {}
}

namespace App\Models\Turnos{
/**
 * App\Models\Turnos\Fecha
 *
 * @property integer $id
 * @property \Carbon\Carbon $fecha
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $actividad_id
 * @property-read \App\Models\Turnos\Actividad $actividad
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Fecha whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Fecha whereFecha($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Fecha whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Fecha whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Fecha whereActividadId($value)
 */
	class Fecha extends \Eloquent {}
}

namespace App\Models\Turnos{
/**
 * App\Models\Turnos\Actividad
 *
 * @property integer $id
 * @property string $nombre
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Turnos\Fecha[] $fechas
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Turnos\Horario[] $horarios
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Turnos\Turno[] $turnos
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Actividad whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Actividad whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Actividad whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Actividad whereUpdatedAt($value)
 */
	class Actividad extends \Eloquent {}
}

namespace App\Models\Turnos{
/**
 * App\Models\Turnos\Horario
 *
 * @property integer $id
 * @property string $hora
 * @property boolean $lunes
 * @property boolean $martes
 * @property boolean $miercoles
 * @property boolean $jueves
 * @property boolean $viernes
 * @property boolean $sabados
 * @property boolean $domingos
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $actividad_id
 * @property-read \App\Models\Turnos\Actividad $actividad
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Horario whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Horario whereHora($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Horario whereLunes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Horario whereMartes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Horario whereMiercoles($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Horario whereJueves($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Horario whereViernes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Horario whereSabados($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Horario whereDomingos($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Horario whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Horario whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Turnos\Horario whereActividadId($value)
 */
	class Horario extends \Eloquent {}
}

namespace App\Models\OficinaVirtual{
/**
 * App\Models\OficinaVirtual\BoletaPago
 *
 * @property integer $id
 * @property string $factura_tipo
 * @property integer $factura_numero
 * @property string $factura_periodo
 * @property string $factura_fecha
 * @property integer $nro_liq_sp
 * @property integer $numero_cuenta
 * @property integer $expediente
 * @property string $razon_social
 * @property string $ocupante
 * @property integer $unidad_numero
 * @property string $unidad_calle
 * @property integer $unidad_numero_puerta
 * @property string $unidad_piso
 * @property string $unidad_departamento
 * @property string $envio_calle
 * @property integer $envio_numero_puerta
 * @property string $envio_piso
 * @property string $envio_departamento
 * @property \Carbon\Carbon $fecha_vencimiento_1
 * @property float $monto_vencimiento_1
 * @property \Carbon\Carbon $fecha_vencimiento_2
 * @property float $monto_vencimiento_2
 * @property \Carbon\Carbon $fecha_vencimiento_3
 * @property float $monto_vencimiento_3
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property float $saldo
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereFacturaTipo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereFacturaNumero($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereFacturaPeriodo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereFacturaFecha($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereNroLiqSp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereNumeroCuenta($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereExpediente($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereRazonSocial($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereOcupante($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereUnidadNumero($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereUnidadCalle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereUnidadNumeroPuerta($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereUnidadPiso($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereUnidadDepartamento($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereEnvioCalle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereEnvioNumeroPuerta($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereEnvioPiso($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereEnvioDepartamento($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereFechaVencimiento1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereMontoVencimiento1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereFechaVencimiento2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereMontoVencimiento2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereFechaVencimiento3($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereMontoVencimiento3($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\BoletaPago whereSaldo($value)
 */
	class BoletaPago extends \Eloquent {}
}

namespace App\Models\OficinaVirtual{
/**
 * App\Models\OficinaVirtual\Usuario
 *
 * @property integer $id
 * @property integer $documento
 * @property string $apellido
 * @property string $nombre
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property string $email
 * @property string $movil
 * @property boolean $validado
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OficinaVirtual\Pedido[] $pedidos
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Turnos\Turno[] $turnos
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Usuario whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Usuario whereDocumento($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Usuario whereApellido($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Usuario whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Usuario whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Usuario whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Usuario whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Usuario whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Usuario whereMovil($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Usuario whereValidado($value)
 */
	class Usuario extends \Eloquent {}
}

namespace App\Models\OficinaVirtual{
/**
 * App\Models\OficinaVirtual\Pedido
 *
 * @property integer $id
 * @property string $solicitante_nombre
 * @property string $solicitante_apellido
 * @property string $solicitante_telefono
 * @property string $solicitante_email
 * @property string $estado
 * @property string $origen
 * @property string $tipo
 * @property string $metodo_entrega
 * @property string $localidad
 * @property string $domicilio
 * @property string $nomenclatura
 * @property boolean $prioritario
 * @property string $descripcion
 * @property string $observaciones
 * @property string $motivo_cancelacion
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $usuario_id
 * @property-read \App\Models\OficinaVirtual\Usuario $usuario
 * @property-read \Illuminate\Database\Eloquent\Collection|\app\Models\OficinaVirtual\PedidoAdjunto[] $adjuntos
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido whereSolicitanteNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido whereSolicitanteApellido($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido whereSolicitanteTelefono($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido whereSolicitanteEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido whereEstado($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido whereOrigen($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido whereTipo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido whereMetodoEntrega($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido whereLocalidad($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido whereDomicilio($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido whereNomenclatura($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido wherePrioritario($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido whereDescripcion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido whereObservaciones($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido whereMotivoCancelacion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OficinaVirtual\Pedido whereUsuarioId($value)
 */
	class Pedido extends \Eloquent {}
}

