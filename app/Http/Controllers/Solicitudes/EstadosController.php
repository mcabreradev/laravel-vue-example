<?php

namespace App\Http\Controllers\Solicitudes;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Solicitudes\Estado;
use App\Http\Controllers\ApiController;
use App\Transformers\Solicitudes\EstadoTransformer;

class EstadosController extends ApiController
{

    /**
     * [main description]
     * @return [type] [description]
     */
    public function main(){

        return view('solicitudes.estados.main');
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create(){

        return view('solicitudes.estados.create');
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id) {
        $data = Estado::findOrFail($id);

        return view('solicitudes.estados.edit', ['item' => $data->toJson()]);
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index() {
        $estados = Estado::all();

        return $this->respondWith($estados, new EstadoTransformer);
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request) {

        Estado::create($request->all());

        return $this->respondWithOk(201, 'Added');
    }

    /**
     * [show description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id) {
        $estado = Estado::findOrFail($id);

        return $this->item($estado, new EstadoTransformer);
    }

    /**
     * [update description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id) {
        $estado = Estado::findOrFail($id);
        $estado->update($request->all());

        return $this->respondWithOk(201, 'Updated');
    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id) {
        try {
            Estado::destroy($id);
            return $this->respondWithOk(200, 'Deleted');
        } catch(\Illuminate\Database\QueryException $e) {
            return $this->respondWithError('El registro se encuentra en uso y no puede ser borrado', 409);
        }
    }
}
