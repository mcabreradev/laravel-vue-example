<?php

namespace App\Http\Controllers\Plantas;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plantas\NivelAguaPlanta;
use App\Models\Plantas\NivelAguaPlantaRegistro;
use Flash;


class NivelAguaPlantaRegistroController extends Controller
{

    protected function assignRegistro($registro, $request)
    {
        $registro->fill($request->input());

        return $registro;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $registros = NivelAguaPlantaRegistro::all();
        $niveles   = NivelAguaPlanta::all();

        return view('plantas.niveles.index-registros')
            ->with('registros', $registros)
            ->with('niveles', $niveles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {

            $nivel    = NivelAguaPlanta::findOrFail($request->input('nivel'));
            $registro = $this->assignRegistro(new NivelAguaPlantaRegistro(), $request);

            $registro->nivelAguaPlanta()->associate($nivel);
            $registro->save();

            Flash::success('El registro se creó correctamente');

            return redirect(route('plantas.niveles.registros.index'));
        } catch (ModelNotFoundException $e) {
            Flash::error('Error al crear el registro');

            return redirect(route('plantas.niveles.registros.index'));
        }
    }

    /**
     * Elimina un registro
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        try {

            $registro = NivelAguaPlantaRegistro::findOrFail($id);
            $registro->delete();

            Flash::success('El registro se eliminó correctamente');

            return redirect(route('plantas.niveles.registros.index'));

        } catch(ModelNotFoundException $e) {

            Flash::warning('Error al eliminar el registro');

            return redirect(route('plantas.niveles.registros.index'));
        }
    }
}
