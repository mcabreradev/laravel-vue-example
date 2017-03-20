<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Requests;
use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use App\Transformers\Admin\RoleTransformer;
use Exception;
use Illuminate\Http\Request;
use Flash;
use Slugify;

class RoleController extends ApiController
{

    /**
     * [main description]
     * @return [type] [description]
     */
    public function main()
    {
        return view('admin.roles.main');
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        return $this->respondWith(Role::withCount(['users', 'permissions'])->get(), new RoleTransformer);
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
        return view('admin.roles.create', [
            'role'            => new Role,
            'permissions'     => Permission::all(),
            'rolePermissions' => collect([])
        ]);
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        try {
            $role = $this->assignValues(new Role, $request);
            $role->save();

            $role->syncPermissions($request->has('permissions') ? $request->input('permissions') : []);

            Flash::success('Registro creado correctamente');
            return redirect()->route('admin::roles.list');

        } catch(Exception $e) {
            Flash::error("No se pudo crear el registro. {$e->getMessage()}");
            return redirect()->back();
        }
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function edit($id)
    {
        try {
            $role = Role::with('permissions')->findOrFail($id);

            return view('admin.roles.edit', [
                'role'            => $role,
                'permissions'     => Permission::all(),
                'rolePermissions' => $role->permissions->pluck('id')
            ]);
        } catch(Exception $e) {
            Flash::error('No se encontró el registro a editar');
            return redirect()->back();
        }
    }

    /**
     * [update description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id)
    {
        try {
            $role = $this->assignValues(Role::findOrFail($id), $request);
            $role->save();

            $role->syncPermissions($request->input('permissions'));

            Flash::success('Registro editado correctamente');
            return redirect()->route('admin::roles.list');

        } catch(Exception $e) {
            Flash::error("No se pudo editar el registro. {$e->getMessage()}");
            return redirect()->back();
        }
    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        try {
            $role = Role::WithCount(['users', 'permissions'])->findOrFail($id);

            if ($role->users_count === 0 && $role->permissions_count === 0) {
                $role->destroy($id);
                return $this->respondWithOk(200, 'Deleted');
            }
            else {
                throw new Exception;
            }
        } catch(Exception $e) {
            return $this->respondWithError("El registro se encuentra en uso y no puede ser borrado. {$e->getMessage()}", 409);
        }
    }

    /**
     * [assignValues description]
     * @param  Role    $role    [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    protected function assignValues(Role $role, Request $request)
    {
        $role->fill($request->input());
        $role->name = Slugify::slugify($role->display_name);
        return $role;
    }
}
