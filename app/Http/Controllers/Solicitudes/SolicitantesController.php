<?php

namespace App\Http\Controllers\Solicitudes;

use Illuminate\Http\Request;

use Flash;
use App\Http\Requests;
use App\Models\Solicitudes\Solicitante;
use App\Http\Controllers\ApiController;
use App\Http\Transformers\Solicitudes\SolicitanteTransformer;

class SolicitantesController extends ApiController
{

    public function index() {
        $data = Solicitante::all();

        return $this->respondWith($data, new SolicitanteTransformer);
    }

    public function main(){

        return view('solicitudes.solicitantes.main');
    }

    public function create(){
        $data = new Solicitante();

        return view('solicitudes.solicitantes.create', ['data' => $data]);
    }

    public function store(Request $request) {
        $solicitantes = $this->assignEntity(new Solicitante(), $request);
        $solicitantes->save();

        Flash::success('El registro se creó correctamente');
        return redirect(route("solicitudes::solicitantes"));
    }

    public function show($id) {
        $data = Solicitante::findOrFail($id);

        return $this->item($data, new SolicitanteTransformer);
    }

    public function edit($id) {
        $data = Solicitante::findOrFail($id);

        return view('solicitudes.solicitantes.edit', ['data' => $data]);
    }

    public function update(Request $request, $id) {
        $data = Solicitante::findOrFail($id);
        $data->update($request->all());

        Flash::success('El registro se edito correctamente');
        return redirect(route("solicitudes::solicitantes"));
    }

    public function destroy($id) {
        Solicitante::destroy($id);
        return $this->respondWithOk(200, 'Deleted');
    }

    protected function assignEntity(Solicitante $entity, Request $request)
    {
        $entity->fill($request->input());
        return $entity;
    }
}
