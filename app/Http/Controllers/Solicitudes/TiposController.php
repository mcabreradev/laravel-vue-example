<?php

namespace App\Http\Controllers\Solicitudes;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Solicitudes\Tipo;
use App\Http\Controllers\ApiController;
use App\Transformers\Solicitudes\TipoTransformer;

class TiposController extends ApiController
{

    /**
     * [main description]
     * @return [type] [description]
     */
    public function main(){

        return view('solicitudes.tipos.main');
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create(){

        return view('solicitudes.tipos.create');
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id) {
        $data = Tipo::findOrFail($id);

        return view('solicitudes.tipos.edit', ['item' => $data->toJson()]);
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index() {
        $tipos = Tipo::all();

        return $this->respondWith($tipos, new TipoTransformer);
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request) {

        Tipo::create($request->all());

        return $this->respondWithOk(201, 'Added');
    }

    /**
     * [show description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id) {
        $tipo = Tipo::findOrFail($id);

        return $this->item($tipo, new TipoTransformer);
    }

    /**
     * [update description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id) {
        $tipo = Tipo::findOrFail($id);
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
            Tipo::destroy($id);
            return $this->respondWithOk(200, 'Deleted');
        } catch(\Illuminate\Database\QueryException $e) {
            return $this->respondWithError('El registro se encuentra en uso y no puede ser borrado', 409);
        }
    }
}
