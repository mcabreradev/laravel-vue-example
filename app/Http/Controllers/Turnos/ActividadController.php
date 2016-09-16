<?php

namespace App\Http\Controllers\Turnos;

use Illuminate\Http\Request;
use App\Models\Turnos\Actividad;
use App\Http\Controllers\Controller;

class ActividadController extends Controller
{

    /**
     * [show description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function show(Request $request, $id)
    {
        try {
            $actividad = Actividad::findOrFail($id);

            // cargo fechas y horarios
            $actividad->load([
                'fechas' => function($q) use ($request) {
                    $q->orderBy('fecha', 'asc');

                    // filtro desde
                    if ($request->has('fecha_desde')) {
                        $q->where('fecha', '>=', $request->input('fecha_desde'));
                    }

                    // cantidad
                    if ($request->has('fecha_cantidad')) {
                        $q->take($request->input('fecha_cantidad'));
                    }
                },
                'horarios' => function($q) {
                    $q->orderBy('hora', 'asc');
                }
            ]);

            $actividadArray               = $actividad->toArray();
            $actividadArray['cronograma'] = $actividad->getCronograma();

            return response()->json($actividadArray);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No se encontró la actividad'], 404);
        } catch (Exception $e) {
            abort(500);
        }
    }

    /**
     * [turnosAsignados description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function turnosAsignados($id)
    {
        try {
            $actividad = Actividad::with('turnos')->findOrFail($id);

            return response()->json($actividad->getTurnosAsignadosMap());

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No se encontró la actividad'], 404);
        } catch (Exception $e) {
            abort(500);
        }
    }
}
