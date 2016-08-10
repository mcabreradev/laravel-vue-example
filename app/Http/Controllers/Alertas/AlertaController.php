<?php

namespace App\Http\Controllers\Alertas;

use Flash;
use DateTime;
use App\Http\Requests;
use App\Models\Geo\Barrio;
use Illuminate\Http\Request;
use App\Models\Alertas\Alerta;
use App\Models\Alertas\Estado;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Models\Alertas\AlertaDetalle;

class AlertaController extends Controller
{
    /**
     * [generarDetalle description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    protected function generarDetalle($request)
    {
        $estados        = Estado::all()->getDictionary();
        $detallesAlerta = new Collection();
        $barriosJson    = json_decode($request->input('detalle-barrios'));

        foreach ($barriosJson as $barrio) {

            if ($barrio->estado->id !== 1) {

                $detalle = new AlertaDetalle();
                $detalle->barrio()->associate(Barrio::find($barrio->id));
                $detalle->estado()->associate($estados[$barrio->estado->id]);

                $detallesAlerta->push($detalle);
            }
        }

        return $detallesAlerta;
    }

    /**
     * Assignacion desde el request
     * @param  [type] $trail   [description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    protected function asignarEntidad($entidad, $request)
    {
        $entidad->fill($request->input());

        $entidad->finaliza_el = $entidad->inicia_el->addHours($request->input('duracion'));

        return $entidad;
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        return view('alertas.index')
            ->with('alertas', Alerta::all());
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {
        return view('alertas.create');
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {

        $alerta   = $this->asignarEntidad(new Alerta(), $request);
        $detalles = $this->generarDetalle($request);

        $alerta->save();

        $alerta->detalles()->saveMany($detalles);

        Flash::success('El registro se creó correctamente');

        return redirect(route('alertas::index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            $alerta = Alerta::findOrFail($id);

            return view('alertas.edit')
                ->with('alertas', $alerta);
        } catch (ModelNotFoundException $e) {
            Flash::warning('No se encontró el registro a editar');

            return redirect(route('alertas::index'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try {

            $alerta   = $this->asignarEntidad(Alerta::findOrFail($id), $request);
            $detalles = $this->generarDetalle($request);

            $alerta->save();

            $alerta->detalles()->detach();
            $alerta->detalles()->saveMany($detalles);

            Flash::success('El registro se modificó correctamente');

            return redirect(route('alertas::index'));

        } catch(ModelNotFoundException $e) {

            Flash::warning('No se encontró el registro a editar');

            return redirect(route('alertas::index'));
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

            $alerta = Alerta::findOrFail($id);
            $alerta->delete();

            Flash::success('El registro se eliminó correctamente');

            return redirect(route('alertas::index'));

        } catch(ModelNotFoundException $e) {

            Flash::warning('Error al eliminar el registro');

            return redirect(route('alertas::index'));
        }
    }

    /**
     * [getLayer description]
     * @return [type] [description]
     */
    public function createLayer()
    {

        $barrios = Barrio::all();
        $estadoPredeterminado = Estado::findOrFail(1);

        $layer = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        foreach ($barrios as $barrio) {
            $feature = [
                'type' => 'Feature',
                'properties' => [
                    'id'     => $barrio->id,
                    'nombre' => $barrio->nombre,
                    'estado' => [
                        'id'     => $estadoPredeterminado->id,
                        'titulo' => $estadoPredeterminado->titulo,
                        'color'  => $estadoPredeterminado->color
                    ]
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

    /**
     * [getLayer description]
     * @return [type] [description]
     */
    public function editLayer($id)
    {
        try {
            $situacion = Situacion::with('barriosSituaciones')
                ->with('barriosSituaciones.barrio')
                ->with('barriosSituaciones.estado')
                ->findOrFail($id);

            $layer = [
                'type' => 'FeatureCollection',
                'features' => []
            ];

            foreach ($situacion->barriosSituaciones as $barSit) {
                $feature = [
                    'type' => 'Feature',
                    'properties' => [
                        'id'     => $barSit->barrio->id,
                        'nombre' => $barSit->barrio->nombre,
                        'estado' => [
                            'id'     => $barSit->estado->id,
                            'titulo' => $barSit->estado->titulo,
                            'color'  => $barSit->estado->color
                        ]
                    ],
                    'geometry' => [
                        'type' => 'Polygon',
                        'coordinates' => $barSit->barrio->geometria->coordinates
                    ],
                ];

                $layer['features'][] = $feature;
            }

            return response()->json($layer);

        } catch(ModelNotFoundException $e) {
            abort(500);
        }
    }

    /**
     * Arma un layer GeoJson con el estado actual del servicio en los barrios
     *
     * @return geojson [description]
     */
    public function getAlertasActualesLayer()
    {
        // obtengo todos los estados en un arreglo numerado con id
        $estados = Estado::all()->getDictionary();

        // obtengo los barrios con sus alertas vigentes
        $barrios = Barrio::with('alertasVigentes')->get();

        // estructura de layer
        $layer = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        // por cada barrio armo sus propiedades y dibujo en el layer
        foreach ($barrios as $barrio) {

            // me quedo con la ultima alerta
            $alertaActual = $barrio->alertasVigentes->last();
            $alertas      = [];

            // si no tiene alerta vigente genero un registro con valores predeterminados
            if ($alertaActual === null) {
                $alertas[] = [
                    'estado' => [
                        'id'     => 1,
                        'titulo' => $estados[1]->titulo,
                        'color'  => $estados[1]->color
                    ],
                    'inicio'      => '',
                    'fin'         => '',
                    'descripcion' => ''
                ];
            }
            // si tiene alerta vigente genero un registro con sus datos
            else {
                $alertas[] = [
                    'estado' => [
                        'id'     => $alertaActual->pivot->cortes_estado_id,
                        'titulo' => $estados[$alertaActual->pivot->cortes_estado_id]->titulo,
                        'color'  => $estados[$alertaActual->pivot->cortes_estado_id]->color
                    ],
                    'inicio'      => $alertaActual->inicia_el->toDateTimeString(),
                    'fin'         => $alertaActual->finaliza_el->toDateTimeString(),
                    'descripcion' => $alertaActual->descripcion
                ];
            }

            // estructura de feature para el geojson
            $feature = [
                'type' => 'Feature',
                'properties' => [
                    'nombre' => $barrio->nombre,
                    'alertas' => $alertas
                ],
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => $barrio->geometria->coordinates
                ],
            ];

            // agrego el feature/Barrio a la capa
            $layer['features'][] = $feature;
        }

        return response()->json($layer, 200);
    }

    /**
     * Arma un layer GeoJson con las futuras alertas de servicio en los barrios
     *
     * @return geojson [description]
     */
    public function getAlertasFuturasLayer()
    {
        // obtengo todos los estados en un arreglo numerado con id
        $estados = Estado::all()->getDictionary();

        // obtengo los barrios con sus alertas vigentes
        $barrios = Barrio::has('alertasVigentes')->get();

        // estructura de layer
        $layer = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        // por cada barrio armo sus propiedades y dibujo en el layer
        foreach ($barrios as $barrio) {

            $alertas = [];

            if ($barrio->alertasVigentes->count()) {
                foreach ($barrio->alertasVigentes as $alerta) {
                    $alertas[] = [
                        'estado' => [
                            'id'     => $alerta->pivot->cortes_estado_id,
                            'titulo' => $estados[$alerta->pivot->cortes_estado_id]->titulo,
                            'color'  => $estados[$alerta->pivot->cortes_estado_id]->color
                        ],
                        'inicio'      => $alerta->inicia_el->toDateTimeString(),
                        'fin'         => $alerta->finaliza_el->toDateTimeString(),
                        'descripcion' => $alerta->descripcion
                    ];
                }
            }
            else {
                $alertas[] = [
                    'estado' => [
                        'id'     => 1,
                        'titulo' => $estados[1]->titulo,
                        'color'  => $estados[1]->color
                    ],
                    'inicio'      => '',
                    'fin'         => '',
                    'descripcion' => ''
                ];
            }

            // estructura de feature para el geojson
            $feature = [
                'type' => 'Feature',
                'properties' => [
                    'nombre' => $barrio->nombre,
                    'alertas' => $alertas
                ],
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => $barrio->geometria->coordinates
                ],
            ];

            // agrego el feature/Barrio a la capa
            $layer['features'][] = $feature;
        }

        return response()->json($layer, 200);
    }
}
