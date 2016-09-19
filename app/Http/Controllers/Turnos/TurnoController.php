<?php

namespace App\Http\Controllers\Turnos;

use Flash;
use Mail;
use \DateTime;
use App\Models\Turnos\Turno;
use Illuminate\Http\Request;
use App\Models\Turnos\Actividad;
use App\Http\Controllers\Controller;
use App\Models\OficinaVirtual\Usuario;
use Illuminate\Database\QueryException;

class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('turnos.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function asignadosPorActividad($actividadId)
    {
        $now = new DateTime();

        $turnosVigentes = Turno::with('usuario', 'actividad')
            ->where('fecha', '>', $now->format('Y-m-d'))
            ->orWhere(function ($q) use ($now){
                $q->where('fecha', '=', $now->format('Y-m-d'))
                  ->where('hora', '>=', $now->format('H:i:s'));
            })
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        return response()->json($turnosVigentes);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function vencidosPorActividad($actividadId)
    {
        $now = new DateTime();

        $turnosVencidos = Turno::with('usuario', 'actividad')
            ->where('fecha', '<', $now->format('Y-m-d'))
            ->orWhere(function ($q) use ($now){
                $q->where('fecha', '=', $now->format('Y-m-d'))
                  ->where('hora', '<', $now->format('H:i:s'));
            })
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        return response()->json($turnosVencidos);
    }

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
     * [getTurnosPorUsaurio description]
     * @param  [type] $usuario   [description]
     * @param  [type] $actividad [description]
     * @return [type]            [description]
     */
    private function getTurnosPorUsaurio($usuario, $actividad)
    {
        return Turno::whereHas('usuario', function($q) {
            $q->where('documento', '=', $usuario->documento)
              ->orWhere('email', '=', 'vieraleonel1@gmail.com');
        })->whereHas('actividad', function($q) {
            $q->where('id', '=', $actividad->id);
        })->get();
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        try {

            $now = new DateTime();

            if (
                $request->input('fecha') < $now->format('Y-m-d') ||
                 ( ($request->input('fecha') == $now->format('Y-m-d')) &&
                   ($request->input('hora') < $now->format('H:i:s'))
                 )
                ) {
                return response()->json([
                    'error' => 'ocupado',
                    'fecha' => $request->input('fecha'),
                    'hora'  => $request->input('hora')
                ], 409);
            }

            $actividad = Actividad::findOrFail($request->input('actividad'));

            // intento buscar por documento
            $usuario = Usuario::firstOrNew(['documento' => $request->input('documento')]);

            // si no encontre por documento busco por email
            if (!$usuario->exists) {
                $usuario = Usuario::firstOrNew(['email' => $request->input('email')]);
            }

            // filtro turnos segun actividad
            $usuario->turnos()->where('actividad_id', '=', $actividad->id)->get();

            // si ya tiene un turno devuelvo conflict
            if ($usuario->turnos->count() > 0) {
                $turno = $usuario->turnos->first();
                return response()->json([
                    'error' => 'duplicado',
                    'fecha' => $turno->fecha->toDateString(),
                    'hora'  => $turno->hora
                ], 409);
            }

            //
            // Sigo el camino normal
            //

            $usuario->fill($request->input());
            $usuario->save();

            $turno = new Turno();
            $turno->fill($request->input());

            $turno->actividad()->associate($actividad);
            $turno->usuario()->associate($usuario);

            $turno->save();

            $this->enviarEmailComprobante($turno);

            return response()->json($request->input(), 201);

        } catch(QueryException $e) {
            return response()->json([
                'error' => 'ocupado',
                'fecha' => $request->input('fecha'),
                'hora'  => $request->input('hora')
            ], 409);
        } catch (Exception $e) {
            abort(500);
        }
    }

    /**
     * [enviarEmailComprobante description]
     * @param  [type] $turno [description]
     * @return [type]        [description]
     */
    protected function enviarEmailComprobante($turno)
    {
        Mail::send('emails.turno-comprobante', ['turno' => $turno], function ($message) use ($turno) {
            $message->from('no-reply@dposs.gov.ar', 'DPOSS')
                ->to($turno->usuario->email)
                ->subject('Comprobante turno ' . $turno->actividad->nombre);
        });
    }

    /**
     * [destroy description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function destroy($id)
    {
        try {
            $turno = Turno::findOrFail($id);
            $turno->delete();

            return response()->json('');

        } catch(ModelNotFoundException $e) {
            return response()->json(['error' => 'No se encontró el turno'], 404);
        } catch(Exception $e) {
            abort(500);
        }
    }

    /**
     * [validarAtencion description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function validarAtencion(Request $request, $id)
    {
        try {
            // turno atendido
            $turno = Turno::with('usuario')->findOrFail($id);
            $turno->atendido = true;
            $turno->save();

            // usuario validado
            $turno->usuario->fill($request->input('usuario'));
            $turno->usuario->validado = true;
            $turno->usuario->save();

            return response()->json('');

        } catch(ModelNotFoundException $e) {
            return response()->json(['error' => 'No se encontró el turno'], 404);
        }
        catch(QueryException $e) {
            return response()->json('');
        } catch(Exception $e) {
            abort(500);
        }
    }
}
