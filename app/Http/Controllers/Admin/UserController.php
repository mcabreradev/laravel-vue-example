<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Flash;
use Auth;
use Lang;

class UserController extends Controller
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
}
