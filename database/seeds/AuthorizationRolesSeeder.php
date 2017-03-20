<?php

use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use App\Models\Admin\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorizationRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        /**
         * admin
         */
        Role::create([
            'name'         => 'admin',
            'display_name' => 'Administrador',
            'description'  => 'Este usuario tiene acceso a TODO el sistema'
        ]);

        /**
         * turnos-atencion-publico
         */
        $role = Role::create([
            'name'         => 'turnos-atencion-publico',
            'display_name' => 'Atención al público de turnos',
            'description'  => 'Permite ver los turnos y validar su atención'
        ]);

        $permissions = Permission::where('name', 'turnos-browse')
            ->orWhere('name', 'turnos-validar-atencion')
            ->get();

        $role->attachPermissions($permissions);

        $role->save();

        /**
         * turnos-admin
         */
        $role = Role::create([
            'name'         => 'turnos-admin',
            'display_name' => 'Gestionar los turnos',
            'description'  => 'Permite ver los turnos, validar su atención y cancelarlos'
        ]);

        $permissions = Permission::where('name', 'like', 'turnos-%')->get();
        $role->attachPermissions($permissions);

        $role->save();

        /**
         * alertas-mapa
         */
        $role = Role::create([
            'name'         => 'alertas-mapa',
            'display_name' => 'Gestionar las alertas del mapa',
            'description'  => 'Permite listar, crear, editar y borrar las alertas del mapa'
        ]);

        $permissions = Permission::where('name', 'like', 'alertas-mapa-%')->get();
        $role->attachPermissions($permissions);

        $role->save();

        /**
         * alertas-nivel-agua
         */
        $role = Role::create([
            'name'         => 'alertas-nivel-agua',
            'display_name' => 'Gestionar los registros de nivel de agua en plantas',
            'description'  => 'Permite listar, crear, y borrar los registros de agua en plantas'
        ]);

        $permissions = Permission::where('name', 'like', 'alertas-nivel-agua-%')->get();
        $role->attachPermissions($permissions);

        $role->save();

        /**
         * reclamos
         */
        $role = Role::create([
            'name'         => 'reclamos',
            'display_name' => 'Gestionar los reclamos',
            'description'  => 'Permite ver, crear y modificar los reclamos y toda su configuración'
        ]);

        $permissions = Permission::where('name', 'like', 'solicitudes-%')->get();
        $role->attachPermissions($permissions);

        $role->save();

        /**
         * reclamos-ver
         */
        $role = Role::create([
            'name'         => 'reclamos-ver',
            'display_name' => 'Visualización de reclamos',
            'description'  => 'Permite ver la lista de reclamos, imprimirlos y ver su historial/timeline'
        ]);

        $permissions = Permission::where('name', 'solicitudes-browse')
            ->orWhere('name', 'solicitudes-imprimir')
            ->orWhere('name', 'solicitudes-imprimir-orden-trabajo')
            ->orWhere('name', 'solicitudes-timeline')
            ->get();

        $role->attachPermissions($permissions);

        $role->save();
    }
}
