<?php

namespace App\Http\Controllers\Alertas;

use Flash;
use DateTime;
use Carbon\Carbon;
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
            ->with('alertas', Alerta::orderBy('inicia_el', 'desc')->get());
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
                ->with('alerta', $alerta);
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
            $alerta = Alerta::with('detalles')
                ->with('detalles.barrio')
                ->with('detalles.estado')
                ->findOrFail($id);

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

        } catch(ModelNotFoundException $e) {
            abort(500);
        }
    }

    /**
     * Arma un layer GeoJson con el estado actual del servicio en los barrios
     *
     * @return geojson [description]
     */
    public function vigentesLayer()
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
            $estado = [];
            $alerta = [];

            // si no tiene alerta vigente genero un registro con valores predeterminados
            if ($alertaActual === null) {
                $estado =  [
                    'id'     => 1,
                    'titulo' => $estados[1]->titulo,
                    'color'  => $estados[1]->color
                ];
                $alerta = [
                    'id'          => 0,
                    'descripcion' => '',
                    'inicio'      => '',
                    'fin'         => '',
                ];
            }
            // si tiene alerta vigente genero un registro con sus datos
            else {
                $estado = [
                    'id'     => $alertaActual->pivot->alertas_estado_id,
                    'titulo' => $estados[$alertaActual->pivot->alertas_estado_id]->titulo,
                    'color'  => $estados[$alertaActual->pivot->alertas_estado_id]->color
                ];
                $alerta = [
                    'id'          => $alertaActual->id,
                    'descripcion' => $alertaActual->descripcion,
                    'inicio'      => $alertaActual->inicia_el->toDateTimeString(),
                    'fin'         => $alertaActual->finaliza_el->toDateTimeString()
                ];
            }

            // estructura de feature para el geojson
            $feature = [
                'type' => 'Feature',
                'properties' => [
                    'id'     => $barrio->id,
                    'nombre' => $barrio->nombre,
                    'estado' => $estado,
                    'alerta' => $alerta
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
    public function futurasLayer()
    {
        // obtengo todos los estados en un arreglo numerado con id
        $estados = Estado::all()->getDictionary();

        // obtengo los barrios con sus alertas vigentes
        $barrios = Barrio::with('alertasFuturas')->get();

        // estructura de layer
        $layer = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        // por cada barrio armo sus propiedades y dibujo en el layer
        foreach ($barrios as $barrio) {

            // me quedo con la ultima alerta
            $alertaFutura = $barrio->alertasFuturas->first();
            $estado = [];
            $alerta = [];

            // si no tiene alerta vigente genero un registro con valores predeterminados
            if ($alertaFutura === null) {
                $estado =  [
                    'id'     => 1,
                    'titulo' => $estados[1]->titulo,
                    'color'  => $estados[1]->color
                ];
                $alerta = [
                    'id'          => 0,
                    'descripcion' => '',
                    'inicio'      => '',
                    'fin'         => '',
                ];
            }
            // si tiene alerta vigente genero un registro con sus datos
            else {
                $estado = [
                    'id'     => $alertaFutura->pivot->alertas_estado_id,
                    'titulo' => $estados[$alertaFutura->pivot->alertas_estado_id]->titulo,
                    'color'  => $estados[$alertaFutura->pivot->alertas_estado_id]->color
                ];
                $alerta = [
                    'id'          => $alertaFutura->id,
                    'descripcion' => $alertaFutura->descripcion,
                    'inicio'      => $alertaFutura->inicia_el->toDateTimeString(),
                    'fin'         => $alertaFutura->finaliza_el->toDateTimeString()
                ];
            }

            // estructura de feature para el geojson
            $feature = [
                'type' => 'Feature',
                'properties' => [
                    'id'     => $barrio->id,
                    'nombre' => $barrio->nombre,
                    'estado' => $estado,
                    'alerta' => $alerta
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
     * [gacetillas description]
     * @return [type] [description]
     */
    public function gacetillas()
    {
        $gacetillas = [];
        // obtengo las alertas que aun no hayan finalizado
        $alertas = Alerta::where('finaliza_el', '>=', Carbon::now()->toDateTimeString())
            ->orderBy('inicia_el', 'asc')
            ->get();

        // recorro las alertas para armar las gacetillas
        foreach ($alertas as $alerta) {

            // obtengo los nombres de los barrios afectados
            $barriosAfectados = [];
            foreach ($alerta->detalles as $detalle) {
                $barriosAfectados[] = $detalle->barrio->nombre;
            }

            // ordeno alfabeticamente
            sort($barriosAfectados);

            // agrego la alerta a la salida
            $gacetillas[] = [
                'descripcion' => $alerta->descripcion,
                'inicio'      => $alerta->inicia_el->toDateTimeString(),
                'fin'         => $alerta->finaliza_el->toDateTimeString(),
                'barrios'     => $barriosAfectados
            ];
        }

        return response()->json($gacetillas, 200);
    }

    public function getEstadoServicio()
    {
        $estadoServicio = new \StdClass();
        $nowStr = Carbon::now()->toDateTimeString();

        $vigentes = Alerta::where('inicia_el', '<=', $nowStr)
            ->where('finaliza_el', '>=', $nowStr)
            ->take(1)
            ->get()
            ->count();

        $futuras = Alerta::where('inicia_el', '>=', $nowStr)
            ->take(1)
            ->get()
            ->count();

        $estadoServicio->vigente = ($vigentes > 0 ? 'Algunos barrios afectados' : 'Funcionando normalmente');
        $estadoServicio->futuro  = ($futuras > 0 ? 'Algunos barrios afectados' : 'Sin incovenientes');

        return response()->json($estadoServicio, 200);
    }
}
