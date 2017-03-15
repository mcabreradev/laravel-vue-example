<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Admin\Role;
use App\Models\Admin\User;
use App\Transformers\Admin\UserTransformer;
use Auth;
use Flash;
use Illuminate\Http\Request;
use Lang;

class UserController extends ApiController
{
    /**
     * [assignValues description]
     * @param  [type] $user    [description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    private function assignValues($user, $request)
    {
        $user->firstname = $request->input('firstname');
        $user->lastname  = $request->input('lastname');
        $user->email     = $request->input('email');
        $user->password  = $this->resolvePassword($user->password, $request);

        return $user;
    }

    /**
     * [resolvePassword description]
     * @param  [type] $oldPassword [description]
     * @param  [type] $request     [description]
     * @return [type]              [description]
     */
    private function resolvePassword($oldPassword, $request)
    {
        $passReturn = $oldPassword;

        if ($request->has('change-password')) {
            if ($request->input('password') === $request->input('confirm-password')) {
                $passReturn = bcrypt($request->input('password'));
            } else {
                throw new \Exception('No se pudo modificar la contraseña. '. Lang::get('passwords.password'));
            }
        }

        return $passReturn;
    }

    /**
     * [profile description]
     * @return [type] [description]
     */
    public function profile()
    {
        return view('users.profile')->with('user', Auth::user());
    }

    /**
     * [saveProfile description]
     * @return [type] [description]
     */
    public function saveProfile(Request $request)
    {
        try {
            $user = $this->assignValues(Auth::user(), $request);
            $user->save();

            Flash::success('El registro se modificó correctamente');
            return redirect(route('users.profile'));
        } catch (ModelNotFoundException $e) {
            Flash::warning('No se encontró el registro a editar');
            return redirect(route('users.profile'));
        } catch (\Exception $e) {
            Flash::error($e->getMessage());
            return redirect(route('users.profile'));
        }
    }

    /**
     * [main description]
     * @return [type] [description]
     */
    public function main()
    {
        return view('admin.users.main');
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        return $this->respondWith(User::all(), new UserTransformer);
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
        return view('admin.users.create', [
            'user'      => new User,
            'roles'     => Role::all(),
            'userRoles' => collect([])
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
            $user = User::create($request->all());
            $user->syncRoles($request->has('roles') ? $request->input('roles') : []);

            Flash::success('Registro creado correctamente');
            return redirect()->route('admin::users.list');

        } catch(Exception $e) {
            Flash::error("No se pudo crear el registro: {$e->getMessage()}");
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
            $user = User::with('roles')->findOrFail($id);

            return view('admin.users.edit', [
                'user'      => $user,
                'roles'     => Role::all(),
                'userRoles' => $user->roles->pluck('id')
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
            $user = User::findOrFail($id);

            $user->update($request->all());
            $user->syncRoles($request->has('roles') ? $request->input('roles') : []);

            Flash::success('Registro editado correctamente');
            return redirect()->route('admin::users.list');

        } catch(Exception $e) {
            Flash::error("No se pudo editar el registro: {$e->getMessage()}");
            return redirect()->route('pedidos.index');
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
            Role::destroy($id);
            return $this->respondWithOk(200, 'Deleted');
        } catch(Exception $e) {
            return $this->respondWithError("El registro se encuentra en uso y no puede ser borrado: {$e->getMessage()}", 409);
        }
    }
}
