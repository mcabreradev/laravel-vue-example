<?php

namespace App\Http\Controllers\Solicitudes;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Solicitudes\Origen;
use App\Http\Controllers\ApiController;
use App\Http\Transformers\Solicitudes\OrigenTransformer;

class OrigenesController extends ApiController
{

    public function main(){

        return view('solicitudes.origenes.main');
    }

    public function create(){

        return view('solicitudes.origenes.create');
    }

    public function edit($id) {
        $data = Origen::findOrFail($id);

        return view('solicitudes.origenes.edit', ['item' => $data->toJson()]);
    }

    public function index() {
        $origenes = Origen::all();

        return $this->respondWith($origenes, new OrigenTransformer);
    }

    public function store(Request $request) {

        Origen::create($request->all());

        return $this->respondWithOk(201, 'Added');
    }

    public function show($id) {
        $origen = Origen::findOrFail($id);

        return $this->item($origen, new OrigenTransformer);
    }

    public function update(Request $request, $id) {
        $origen = Origen::findOrFail($id);
        $origen->update($request->all());

        return $this->respondWithOk(201, 'Updated');
    }

    public function destroy($id) {
        Origen::destroy($id);

        return $this->respondWithOk(201, 'Deleted');
    }
}
