<?php

namespace App\Http\Controllers\Alertas;

use Flash;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Alertas\NivelAgua;
use App\Http\Controllers\Controller;
use App\Models\Alertas\NivelAguaRegistro;


class NivelAguaRegistroController extends Controller
{

    /**
     * [assignRegistro description]
     * @param  [type] $registro [description]
     * @param  [type] $request  [description]
     * @return [type]           [description]
     */
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
        $registros = NivelAguaRegistro::orderBy('registrado_el', 'desc')
            ->with('nivelAgua')
            ->get();

        return view('alertas.niveles-agua.registros.index')
            ->with('registros', $registros)
            ->with('niveles', NivelAgua::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {

            $nivel    = NivelAgua::findOrFail($request->input('nivel'));
            $registro = $this->assignRegistro(new NivelAguaRegistro(), $request);

            $registro->nivelAgua()->associate($nivel);
            $registro->save();

            Flash::success('El registro se creó correctamente');

            return redirect(route('alertas::registros-nivel-agua.index'));
        } catch (ModelNotFoundException $e) {
            Flash::error('Error al crear el registro');

            return redirect(route('alertas::registros-nivel-agua.index'));
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

            $registro = NivelAguaRegistro::findOrFail($id);
            $registro->delete();

            Flash::success('El registro se eliminó correctamente');

            return redirect(route('alertas::registros-nivel-agua.index'));

        } catch(ModelNotFoundException $e) {

            Flash::warning('Error al eliminar el registro');

            return redirect(route('alertas::registros-nivel-agua.index'));
        }
    }

    /**
     * [nivelAguaActual description]
     * @return [type] [description]
     */
    public function nivelAguaActual()
    {
        $registro = NivelAguaRegistro::orderBy('registrado_el', 'desc')
            ->with('nivelAgua')
            ->first();

        $response = [
            'nivel'         => $registro->nivelAgua->id,
            'titulo'        => $registro->nivelAgua->titulo,
            'descripcion'   => $registro->nivelAgua->descripcion,
            'color'         => $registro->nivelAgua->color,
            'registrado_el' => $registro->registrado_el->toW3cString()
        ];

        return response()->json($response, 200);
    }
}
