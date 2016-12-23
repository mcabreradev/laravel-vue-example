<?php

namespace App\Http\Controllers\Solicitudes;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Solicitudes\Prioridad;
use App\Http\Controllers\ApiController;
use App\Transformers\Solicitudes\PrioridadTransformer;

class PrioridadesController extends ApiController
{

    /**
     * [main description]
     * @return [type] [description]
     */
    public function main(){

        return view('solicitudes.prioridades.main');
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create(){

        return view('solicitudes.prioridades.create');
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id) {
        $data = Prioridad::findOrFail($id);

        return view('solicitudes.prioridades.edit', ['item' => $data->toJson()]);
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index() {
        $prioridades = Prioridad::all();

        return $this->respondWith($prioridades, new prioridadTransformer);
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request) {

        Prioridad::create($request->all());

        return $this->respondWithOk(201, 'Added');
    }

    /**
     * [show description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id) {
        $prioridad = Prioridad::findOrFail($id);

        return $this->item($prioridad, new prioridadTransformer);
    }

    /**
     * [update description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id) {
        $prioridad = Prioridad::findOrFail($id);
        $prioridad->update($request->all());

        return $this->respondWithOk(201, 'Updated');
    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id) {
        Prioridad::destroy($id);

        return $this->respondWithOk(201, 'Deleted');
    }
}
