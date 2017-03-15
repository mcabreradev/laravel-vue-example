<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Admin\Permission;
use App\Http\Controllers\ApiController;
use App\Transformers\Admin\PermissionTransformer;
use Exception;

class PermissionController extends ApiController
{

    /**
     * [main description]
     * @return [type] [description]
     */
    public function main()
    {
        return view('admin.permissions.main');
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        return $this->respondWith(Permission::withCount(['users', 'roles'])->get(), new PermissionTransformer);
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        Permission::create($request->all());
        return $this->respondWithOk(201, 'Added');
    }

    /**
     * [update description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id)
    {
        Permission::findOrFail($id)
            ->update($request->all());

        return $this->respondWithOk(201, 'Updated');
    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        try {
            $permission = Permission::WithCount(['users', 'roles'])->findOrFail($id);

            if ($permission->users_count === 0 && $permission->roles_count === 0) {
                $permission->destroy($id);
                return $this->respondWithOk(200, 'Deleted');
            }
            else {
                throw new Exception;
            }
        } catch(Exception $e) {
            return $this->respondWithError('El registro se encuentra en uso y no puede ser borrado', 409);
        }
    }
}
