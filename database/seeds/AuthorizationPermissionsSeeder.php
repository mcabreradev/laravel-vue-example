<?php

use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use App\Models\Admin\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorizationPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        /**
         * Usuarios
         */
        Permission::create([
            'name'         => 'admin-users-browse',
            'display_name' => 'Ver lista de usuarios',
            'description'  => 'Acceder a la lista de usuarios del sistema'
        ]);
        Permission::create([
            'name'         => 'admin-users-add',
            'display_name' => 'Crear un usuario',
            'description'  => 'Generar accceso a un usuario'
        ]);
        Permission::create([
            'name'         => 'admin-users-edit',
            'display_name' => 'Editar un usuario',
            'description'  => 'Editar la información básica de un usuario'
        ]);
        Permission::create([
            'name'         => 'admin-users-delete',
            'display_name' => 'Dar de baja un usuario',
            'description'  => 'Dar de baja un usuario para que no pueda acceder al sistema'
        ]);
        Permission::create([
            'name'         => 'admin-users-send-reset',
            'display_name' => 'Enviar correo para recuperar contraseña',
            'description'  => 'Enviar correo para recuperar contraseña'
        ]);
        Permission::create([
            'name'         => 'admin-users-send-verification',
            'display_name' => 'Enviar correo para validar email',
            'description'  => 'Enviar correo para validar email'
        ]);

        /**
         * Roles
         */
        Permission::create([
            'name'         => 'admin-roles-browse',
            'display_name' => 'Ver lista de roles',
            'description'  => 'Acceder a la lista de roles'
        ]);
        Permission::create([
            'name'         => 'admin-roles-add',
            'display_name' => 'Crear un rol',
            'description'  => 'Crear un rol'
        ]);
        Permission::create([
            'name'         => 'admin-roles-edit',
            'display_name' => 'Editar un rol',
            'description'  => 'Editar las propiedades de un rol'
        ]);
        Permission::create([
            'name'         => 'admin-roles-delete',
            'display_name' => 'Eliminar un rol',
            'description'  => 'Eliminar un rol'
        ]);

        /**
         * Permissions
         */
        Permission::create([
            'name'         => 'admin-permissions-browse',
            'display_name' => 'Ver lista de permisos',
            'description'  => 'Acceder a la lista de permisos'
        ]);
        Permission::create([
            'name'         => 'admin-permissions-add',
            'display_name' => 'Crear un permiso',
            'description'  => 'Crear un permiso'
        ]);
        Permission::create([
            'name'         => 'admin-permissions-edit',
            'display_name' => 'Editar un permiso',
            'description'  => 'Editar las propiedades de un permiso'
        ]);
        Permission::create([
            'name'         => 'admin-permissions-delete',
            'display_name' => 'Eliminar un permiso',
            'description'  => 'Eliminar un permiso'
        ]);

        /**
         * Pedidos
         */
        Permission::create([
            'name'         => 'pedidos-browse',
            'display_name' => 'Ver lista de pedidos',
            'description'  => 'Acceder a la lista de pedidos'
        ]);

        /**
         * Alertas: Mapa
         */
        Permission::create([
            'name'         => 'alertas-mapa-browse',
            'display_name' => 'Ver lista de alertas para el mapa',
            'description'  => 'Acceder a la lista de alertas para el mapa'
        ]);
        Permission::create([
            'name'         => 'alertas-mapa-add',
            'display_name' => 'Crear una alerta para el mapa',
            'description'  => 'Crear una alerta para el mapa'
        ]);
        Permission::create([
            'name'         => 'alertas-mapa-edit',
            'display_name' => 'Editar una alerta para el mapa',
            'description'  => 'Editar las propiedades de una alerta para el mapa'
        ]);
        Permission::create([
            'name'         => 'alertas-mapa-delete',
            'display_name' => 'Eliminar una alerta para el mapa',
            'description'  => 'Eliminar una alerta para el mapa'
        ]);

        /**
         * Alertas: Nivel de agua
         */
        Permission::create([
            'name'         => 'alertas-nivel-agua-browse',
            'display_name' => 'Ver lista de registros de nivel de agua',
            'description'  => 'Acceder a la lista de registros de nivel de agua'
        ]);
        Permission::create([
            'name'         => 'alertas-nivel-agua-add',
            'display_name' => 'Crear un registro de nivel de agua',
            'description'  => 'Crear un registro de nivel de agua'
        ]);
        Permission::create([
            'name'         => 'alertas-nivel-agua-delete',
            'display_name' => 'Eliminar un registro de nivel de agua',
            'description'  => 'Eliminar un registro de nivel de agua'
        ]);

        /**
         * Turnos
         */
        Permission::create([
            'name'         => 'turnos-browse',
            'display_name' => 'Ver lista turnos',
            'description'  => 'Acceder a la lista de turnos'
        ]);
        Permission::create([
            'name'         => 'turnos-validar-atencion',
            'display_name' => 'Validar la atención de un turno',
            'description'  => 'Validar la atención de un turno'
        ]);
        Permission::create([
            'name'         => 'turnos-delete',
            'display_name' => 'Cancelar un turno',
            'description'  => 'Cancelar un turno'
        ]);

        /**
         * Solicitudes/Reclamos
         */
        Permission::create([
            'name'         => 'solicitudes-browse',
            'display_name' => 'Ver lista de reclamos',
            'description'  => 'Acceder a la lista de reclamos'
        ]);
        Permission::create([
            'name'         => 'solicitudes-add',
            'display_name' => 'Crear un reclamo',
            'description'  => 'Crear un reclamo'
        ]);
        Permission::create([
            'name'         => 'solicitudes-edit',
            'display_name' => 'Editar un reclamo',
            'description'  => 'Editar un reclamo'
        ]);
        Permission::create([
            'name'         => 'solicitudes-delete',
            'display_name' => 'Eliminar un reclamo',
            'description'  => 'Eliminar un reclamo'
        ]);
        Permission::create([
            'name'         => 'solicitudes-imprimir',
            'display_name' => 'Imprimir reclamo',
            'description'  => 'Imprimir reclamo'
        ]);
        Permission::create([
            'name'         => 'solicitudes-imprimir-orden-trabajo',
            'display_name' => 'Imprimir orden de trabajo de un reclamo',
            'description'  => 'Imprimir orden de trabajo de un reclamo'
        ]);
        Permission::create([
            'name'         => 'solicitudes-timeline',
            'display_name' => 'Ver el timeline del reclamo.',
            'description'  => 'Ver el timeline del reclamo. Incluye datos básicos y el historial.'
        ]);

        /**
         * Solicitudes: derivaciones
         */
        Permission::create([
            'name'         => 'solicitudes-derivaciones-add',
            'display_name' => 'Derivar un reclamo',
            'description'  => 'Derivar un reclamo'
        ]);
        Permission::create([
            'name'         => 'solicitudes-derivaciones-edit',
            'display_name' => 'Editar una derivación de un reclamo',
            'description'  => 'Editar una derivación de un reclamo'
        ]);
        Permission::create([
            'name'         => 'solicitudes-derivaciones-delete',
            'display_name' => 'Eliminar una derivación de un reclamo',
            'description'  => 'Eliminar una derivación de un reclamo'
        ]);

        /**
         * Solicitudes: seguimientos
         */
        Permission::create([
            'name'         => 'solicitudes-seguimientos-add',
            'display_name' => 'Registrar un seguimiento en un reclamo',
            'description'  => 'Registrar un seguimiento en un reclamo'
        ]);
        Permission::create([
            'name'         => 'solicitudes-seguimientos-edit',
            'display_name' => 'Editar un seguimiento de un reclamo',
            'description'  => 'Editar un seguimiento de un reclamo'
        ]);
        Permission::create([
            'name'         => 'solicitudes-seguimientos-delete',
            'display_name' => 'Eliminar un seguimiento de un reclamo',
            'description'  => 'Eliminar un seguimiento de un reclamo'
        ]);

        /**
         * Solicitudes: agentes
         */
        Permission::create([
            'name'         => 'solicitudes-agentes-browse',
            'display_name' => 'Ver lista de agentes (reclamos)',
            'description'  => 'Acceder a la lista de agentes (reclamos)'
        ]);
        Permission::create([
            'name'         => 'solicitudes-agentes-add',
            'display_name' => 'Crear un agente (reclamos)',
            'description'  => 'Crear un agente (reclamos)'
        ]);
        Permission::create([
            'name'         => 'solicitudes-agentes-edit',
            'display_name' => 'Editar un agente (reclamos)',
            'description'  => 'Editar un agente (reclamos)'
        ]);
        Permission::create([
            'name'         => 'solicitudes-agentes-delete',
            'display_name' => 'Eliminar un agente (reclamos)',
            'description'  => 'Eliminar un agente (reclamos)'
        ]);

        /**
         * Solicitudes: areas
         */
        Permission::create([
            'name'         => 'solicitudes-areas-browse',
            'display_name' => 'Ver lista de áreas (reclamos)',
            'description'  => 'Acceder a la lista de áreas (reclamos)'
        ]);
        Permission::create([
            'name'         => 'solicitudes-areas-add',
            'display_name' => 'Crear un área (reclamos)',
            'description'  => 'Crear un área (reclamos)'
        ]);
        Permission::create([
            'name'         => 'solicitudes-areas-edit',
            'display_name' => 'Editar un área (reclamos)',
            'description'  => 'Editar un área (reclamos)'
        ]);
        Permission::create([
            'name'         => 'solicitudes-areas-delete',
            'display_name' => 'Eliminar un área (reclamos)',
            'description'  => 'Eliminar un área (reclamos)'
        ]);

        /**
         * Solicitudes: estados
         */
        Permission::create([
            'name'         => 'solicitudes-estados-browse',
            'display_name' => 'Ver lista de estados (reclamos)',
            'description'  => 'Acceder a la lista de estados (reclamos)'
        ]);
        Permission::create([
            'name'         => 'solicitudes-estados-add',
            'display_name' => 'Crear un estado (reclamos)',
            'description'  => 'Crear un estado (reclamos)'
        ]);
        Permission::create([
            'name'         => 'solicitudes-estados-edit',
            'display_name' => 'Editar un estado (reclamos)',
            'description'  => 'Editar un estado (reclamos)'
        ]);
        Permission::create([
            'name'         => 'solicitudes-estados-delete',
            'display_name' => 'Eliminar un estado (reclamos)',
            'description'  => 'Eliminar un estado (reclamos)'
        ]);

        /**
         * Solicitudes: origenes
         */
        Permission::create([
            'name'         => 'solicitudes-origenes-browse',
            'display_name' => 'Ver lista de orígenes (reclamos)',
            'description'  => 'Acceder a la lista de orígenes (reclamos)'
        ]);
        Permission::create([
            'name'         => 'solicitudes-origenes-add',
            'display_name' => 'Crear un origen (reclamos)',
            'description'  => 'Crear un origen (reclamos)'
        ]);
        Permission::create([
            'name'         => 'solicitudes-origenes-edit',
            'display_name' => 'Editar un origen (reclamos)',
            'description'  => 'Editar un origen (reclamos)'
        ]);
        Permission::create([
            'name'         => 'solicitudes-origenes-delete',
            'display_name' => 'Eliminar un origen (reclamos)',
            'description'  => 'Eliminar un origen (reclamos)'
        ]);

        /**
         * Solicitudes: prioridades
         */
        Permission::create([
            'name'         => 'solicitudes-prioridades-browse',
            'display_name' => 'Ver lista de prioridades (reclamos)',
            'description'  => 'Acceder a la lista de prioridades (reclamos)'
        ]);
        Permission::create([
            'name'         => 'solicitudes-prioridades-add',
            'display_name' => 'Crear una prioridad (reclamos)',
            'description'  => 'Crear una prioridad (reclamos)'
        ]);
        Permission::create([
            'name'         => 'solicitudes-prioridades-edit',
            'display_name' => 'Editar una prioridad (reclamos)',
            'description'  => 'Editar una prioridad (reclamos)'
        ]);
        Permission::create([
            'name'         => 'solicitudes-prioridades-delete',
            'display_name' => 'Eliminar una prioridad (reclamos)',
            'description'  => 'Eliminar una prioridad (reclamos)'
        ]);

        /**
         * Solicitudes: tipos
         */
        Permission::create([
            'name'         => 'solicitudes-tipos-browse',
            'display_name' => 'Ver lista de tipos (reclamos)',
            'description'  => 'Acceder a la lista de tipos (reclamos)'
        ]);
        Permission::create([
            'name'         => 'solicitudes-tipos-add',
            'display_name' => 'Crear un tipo (reclamos)',
            'description'  => 'Crear un tipo (reclamos)'
        ]);
        Permission::create([
            'name'         => 'solicitudes-tipos-edit',
            'display_name' => 'Editar un tipo (reclamos)',
            'description'  => 'Editar un tipo (reclamos)'
        ]);
        Permission::create([
            'name'         => 'solicitudes-tipos-delete',
            'display_name' => 'Eliminar un tipo (reclamos)',
            'description'  => 'Eliminar un tipo (reclamos)'
        ]);
    }
}
