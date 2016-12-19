<?php

namespace App\Http\Controllers\Solicitudes;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Solicitudes\Prioridad;
use App\Http\Controllers\ApiController;
use App\Http\Transformers\PrioridadTransformer;

class PrioridadesController extends ApiController
{

    public function main(){

        return view('solicitudes.prioridades.main');
    }

    public function create(){

        return view('solicitudes.prioridades.create');
    }

    public function edit($id) {
        $data = Prioridad::findOrFail($id);

        return view('solicitudes.prioridades.edit', ['item' => $data->toJson()]);
    }

    public function index() {
        $prioridades = Prioridad::all();

        return $this->respondWith($prioridades, new prioridadTransformer);
    }

    public function store(Request $request) {

        Prioridad::create($request->all());

        return $this->respondWithOk(201, 'Added');
    }

    public function show($id) {
        $prioridad = Prioridad::findOrFail($id);

        return $this->item($prioridad, new prioridadTransformer);
    }

    public function update(Request $request, $id) {
        $prioridad = Prioridad::findOrFail($id);
        $prioridad->update($request->all());

        return $this->respondWithOk(201, 'Updated');
    }

    public function destroy($id) {
        Prioridad::destroy($id);

        return $this->respondWithOk(201, 'Deleted');
    }
}
