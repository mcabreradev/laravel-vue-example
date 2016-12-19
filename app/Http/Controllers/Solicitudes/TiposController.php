<?php

namespace App\Http\Controllers\Solicitudes;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Solicitudes\Tipo;
use App\Http\Controllers\ApiController;
use App\Http\Transformers\TipoTransformer;

class TiposController extends ApiController
{

    public function main(){

        return view('solicitudes.tipos.main');
    }

    public function index() {
        $tipos = Tipo::all();

        return $this->respondWith($tipos, new TipoTransformer);
    }

    public function create(){

        return view('solicitudes.tipos.create');
    }

    public function edit($id) {
        $tipo = Tipo::findOrFail($id);

        return view('solicitudes.tipos.edit', ['item' => $tipo->toJson()]);
    }


    public function store(Request $request) {

        Tipo::create($request->all());

        return $this->respondWithOk(201, 'Added');
    }

    public function show($id) {
        $tipo = Tipo::findOrFail($id);

        return $this->item($tipo, new TipoTransformer);
    }

    public function update(Request $request, $id) {
        $tipo = Tipo::findOrFail($id);
        $tipo->update($request->all());

        return $this->respondWithOk(201, 'Updated');
    }

    public function destroy($id) {
        Tipo::destroy($id);

        return $this->respondWithOk(201, 'Deleted');
    }
}
