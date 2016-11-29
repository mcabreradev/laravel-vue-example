<?php

namespace App\Http\Controllers\Solicitudes;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Solicitudes\Estado;
use App\Http\Controllers\ApiController;
use App\Http\Transformers\EstadoTransformer;

class EstadosController extends ApiController
{

    public function main(){

        return view('solicitudes.estados.main');
    }

    public function index() {
        $estados = Estado::all();

        return $this->respondWith($estados, new EstadoTransformer);
    }

    public function store(Request $request) {

        Estado::create($request->all());

        return $this->respondWithOk(201, 'Added');
    }

    public function show($id) {
        $estado = Estado::findOrFail($id);

        return $this->item($estado, new EstadoTransformer);
    }

    public function update(Request $request, $id) {
        $estado = Estado::findOrFail($id);
        $estado->update($request->all());

        return $this->respondWithOk(201, 'Updated');
    }

    public function destroy($id) {
        Estado::destroy($id);

        return $this->respondWithOk(201, 'Deleted');
    }
}
