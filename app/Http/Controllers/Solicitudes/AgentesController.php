<?php

namespace App\Http\Controllers\Solicitudes;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Solicitudes\Agente;
use App\Http\Controllers\ApiController;
use App\Transformers\Solicitudes\AgenteTransformer;

class AgentesController extends ApiController
{
    /**
     * [main description]
     * @return [type] [description]
     */
    public function main(){
        return view('solicitudes.agentes.main');
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create(){
        return view('solicitudes.agentes.create');
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id) {
        $data = Agente::findOrFail($id);
        return view('solicitudes.agentes.edit', ['item' => $data->toJson()]);
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index() {
        $tipos = Agente::orderBy('apellido', 'asc')->get();
        return $this->respondWith($tipos, new AgenteTransformer);
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request) {
        Agente::create($request->all());
        return $this->respondWithOk(201, 'Added');
    }

    public function show($id) {
        $tipo = Agente::findOrFail($id);
        return $this->item($tipo, new AgenteTransformer);
    }

    /**
     * [update description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id) {
        $tipo = Agente::findOrFail($id);
        $tipo->update($request->all());
        return $this->respondWithOk(200, 'Updated');
    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id) {
        try {
            Agente::destroy($id);
            return $this->respondWithOk(200, 'Deleted');
        } catch(\Illuminate\Database\QueryException $e) {
            return $this->respondWithError('El registro se encuentra en uso y no puede ser borrado', 409);
        }
    }
}
