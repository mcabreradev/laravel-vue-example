<?php

namespace App\Http\Controllers\Solicitudes;

use Illuminate\Http\Request;

use Flash;
use App\Http\Requests;
use App\Models\Solicitudes\Solicitante;
use App\Http\Controllers\ApiController;
use App\Transformers\Solicitudes\SolicitanteTransformer;

class SolicitantesController extends ApiController
{
    /**
     * [index description]
     * @return [type] [description]
     */
    public function index() {
        $data = Solicitante::all();

        return $this->respondWith($data, new SolicitanteTransformer);
    }
    /**
     * [main description]
     * @return [type] [description]
     */
    public function main(){

        return view('solicitudes.solicitantes.main');
    }
    /**
     * [create description]
     * @return [type] [description]
     */
    public function create(){
        $data = new Solicitante();

        return view('solicitudes.solicitantes.create', ['data' => $data]);
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request) {
        $solicitantes = $this->assignEntity(new Solicitante(), $request);
        $solicitantes->save();

        Flash::success('El registro se creó correctamente');
        return redirect(route("solicitudes::solicitantes"));
    }

    /**
     * [show description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id) {
        $data = Solicitante::findOrFail($id);

        return $this->item($data, new SolicitanteTransformer);
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id) {
        $data = Solicitante::findOrFail($id);

        return view('solicitudes.solicitantes.edit', ['data' => $data]);
    }

    /**
     * [update description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id) {
        $data = Solicitante::findOrFail($id);
        $data->update($request->all());

        Flash::success('El registro se edito correctamente');
        return redirect(route("solicitudes::solicitantes"));
    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id) {
        Solicitante::destroy($id);
        return $this->respondWithOk(200, 'Deleted');
    }

    /**
     * [assignEntity description]
     * @param  Solicitante $entity  [description]
     * @param  Request     $request [description]
     * @return [type]               [description]
     */
    protected function assignEntity(Solicitante $entity, Request $request)
    {
        $entity->fill($request->input());
        return $entity;
    }
}
