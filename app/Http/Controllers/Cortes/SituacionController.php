<?php

namespace App\Http\Controllers\Cortes;

use App\Http\Requests;
use App\Models\Geo\Barrio;
use Illuminate\Http\Request;
use App\Models\Cortes\Estado;
use App\Models\Cortes\Situacion;
use App\Http\Controllers\Controller;
use App\Models\Cortes\BarrioSituacion;

use Flash;

class SituacionController extends Controller
{
    /**
     * [generarBarriosSituaciones description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    protected function generarBarriosSituaciones($request)
    {
        $barrios = [];
        $barriosJson = json_decode($request->input('barrios-situaciones'));

        foreach ($barriosJson as $barrio) {
            $barSit = new BarrioSituacion();
            $barSit->barrio()->associate(Barrio::find($barrio->id));
            $barSit->estado()->associate(Estado::find($barrio->estado));

            $barrios[] = $barSit;
        }

        return $barrios;
    }

    /**
     * Assignacion desde el request
     * @param  [type] $trail   [description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    protected function asignarSituacion($situacion, $request)
    {
        $situacion->fill($request->input());

        $situacion->finaliza_el = $situacion->inicia_el->addHours($request->input('duracion'));

        return $situacion;
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        return view('cortes.situaciones.index')
            ->with('situaciones', Situacion::all());
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
        return view('cortes.situaciones.create');
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {

        $situacion = $this->asignarSituacion(new Situacion(), $request);

        $barriosSituaciones = $this->generarBarriosSituaciones($request);

        $situacion->save();

        $situacion->barriosSituaciones()->saveMany($barriosSituaciones);

        Flash::success('El registro se creó correctamente');

        return redirect(route('cortes.situaciones.index'));
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

            $situacion = Situacion::findOrFail($id);
            $situacion->delete();

            Flash::success('El registro se eliminó correctamente');

            return redirect(route('cortes.situaciones.index'));

        } catch(ModelNotFoundException $e) {

            Flash::warning('Error al eliminar el registro');

            return redirect(route('cortes.situaciones.index'));
        }
    }

    /**
     * [getLayer description]
     * @return [type] [description]
     */
    public function getLayer()
    {
        $layer = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        $barrios = Barrio::all();

        foreach ($barrios as $barrio) {
            $feature = [
                'type' => 'Feature',
                'properties' => [
                    'nombre' => $barrio->nombre,
                    'estado' => 1,
                    'id'     => $barrio->id
                ],
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => $barrio->geometria->coordinates
                ],
            ];

            $layer['features'][] = $feature;
        }

        return response()->json($layer);
    }
}
