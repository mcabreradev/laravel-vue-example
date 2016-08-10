<?php

namespace App\Http\Controllers\Alertas;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alertas\Estado;
use Flash;

class EstadoController extends Controller
{
    /**
     * [assignarEntidad description]
     * @param  [type] $entity [description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    protected function assignarEntidad($entity, $request)
    {
        $entity->fill($request->input());

        return $entity;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $estados = Estado::all();

        return view('alertas.estados.index')
            ->with('estados', $estados);
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        try {
            $estado = $this->assignarEntidad(new Estado(), $request);
            $estado->save();

            Flash::success('El registro se creó correctamente');

            return redirect(route('alertas::estados.index'));
        } catch (ModelNotFoundException $e) {
            Flash::error('Error al crear el registro');

            return redirect(route('alertas::estados.index'));
        }
    }

    /**
     * [destroy description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function destroy(Request $request, $id)
    {
        try {

            $estado = Estado::findOrFail($id);
            $estado->delete();

            Flash::success('El registro se eliminó correctamente');

            return redirect(route('alertas::estados.index'));

        } catch(ModelNotFoundException $e) {

            Flash::warning('Error al eliminar el registro');

            return redirect(route('alertas::estados.index'));
        }
    }
}
