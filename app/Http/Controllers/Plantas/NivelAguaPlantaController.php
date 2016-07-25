<?php

namespace App\Http\Controllers\Plantas;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plantas\NivelAguaPlanta;
use Flash;

class NivelAguaPlantaController extends Controller
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
        $niveles = NivelAguaPlanta::all();

        return view('plantas.niveles.index')
            ->with('niveles', $niveles);
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        try {
            $nivel = $this->assignarEntidad(new NivelAguaPlanta(), $request);
            $nivel->save();

            Flash::success('El registro se creó correctamente');

            return redirect(route('plantas.niveles.index'));
        } catch (ModelNotFoundException $e) {
            Flash::error('Error al crear el registro');

            return redirect(route('plantas.niveles.index'));
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

            $nivel = NivelAguaPlanta::findOrFail($id);
            $nivel->delete();

            Flash::success('El registro se eliminó correctamente');

            return redirect(route('plantas.niveles.index'));

        } catch(ModelNotFoundException $e) {

            Flash::warning('Error al eliminar el registro');

            return redirect(route('plantas.niveles.index'));
        }
    }
}
