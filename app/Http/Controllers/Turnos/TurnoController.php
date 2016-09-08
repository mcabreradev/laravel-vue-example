<?php

namespace App\Http\Controllers\Turnos;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Turnos\Turno;
use \DateTime;
use Flash;

class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $today = (new DateTime())->format('Y-m-d');

        $turnosVigentes = Turno::with('usuario')
            ->with('actividad')
            ->where('fecha', '>=', $today)
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        $turnosVencidos = Turno::with('usuario')
            ->with('actividad')
            ->where('fecha', '<', $today)
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        return view('turnos.index')
            ->with('turnosVigentes', $turnosVigentes)
            ->with('turnosVencidos', $turnosVencidos);
    }

    // /**
    //  * [assignarEntidad description]
    //  * @param  [type] $entity [description]
    //  * @param  [type] $request [description]
    //  * @return [type]          [description]
    //  */
    // protected function assignarEntidad($entity, $request)
    // {
    //     $entity->fill($request->input());

    //     return $entity;
    // }

    // /**
    //  * [store description]
    //  * @param  Request $request [description]
    //  * @return [type]           [description]
    //  */
    // public function store(Request $request)
    // {
    //     try {
    //         $estado = $this->assignarEntidad(new Estado(), $request);
    //         $estado->save();

    //         Flash::success('El registro se creó correctamente');

    //         return redirect(route('alertas::estados.index'));
    //     } catch (ModelNotFoundException $e) {
    //         Flash::error('Error al crear el registro');

    //         return redirect(route('alertas::estados.index'));
    //     }
    // }

    // /**
    //  * [destroy description]
    //  * @param  Request $request [description]
    //  * @param  [type]  $id      [description]
    //  * @return [type]           [description]
    //  */
    // public function destroy(Request $request, $id)
    // {
    //     try {

    //         $estado = Estado::findOrFail($id);
    //         $estado->delete();

    //         Flash::success('El registro se eliminó correctamente');

    //         return redirect(route('alertas::estados.index'));

    //     } catch(ModelNotFoundException $e) {

    //         Flash::warning('Error al eliminar el registro');

    //         return redirect(route('alertas::estados.index'));
    //     }
    // }
}
