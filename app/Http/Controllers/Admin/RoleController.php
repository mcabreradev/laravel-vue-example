<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Admin\Role;
use App\Http\Controllers\ApiController;
use App\Transformers\Admin\RoleTransformer;
use Exception;

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
        return $this->respondWith(Role::all(), new RoleTransformer);
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
        return view('admin.roles.create', [
            'role' => new Role
        ]);
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        Role::create($request->all());
        return $this->respondWithOk(201, 'Added');
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function edit($id)
    {
        try {
            return view('admin.roles.edit', [
                'role' => Role::findOrFail($id)
            ]);
        } catch(Exception $e) {
            Flash::error('No se encontró el registro a editar');
            return redirect(route('pedidos.index'));
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
        Role::findOrFail($id)
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
            Role::destroy($id);
            return $this->respondWithOk(200, 'Deleted');
        } catch(Exception $e) {
            return $this->respondWithError('El registro se encuentra en uso y no puede ser borrado', 409);
        }
    }
}
