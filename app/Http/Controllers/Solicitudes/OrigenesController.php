<?php

namespace App\Http\Controllers\Solicitudes;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Solicitudes\Origen;
use App\Http\Controllers\ApiController;
use App\Transformers\Solicitudes\OrigenTransformer;

class OrigenesController extends ApiController
{

    /**
     * [main description]
     * @return [type] [description]
     */
    public function main(){

        return view('solicitudes.origenes.main');
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create(){

        return view('solicitudes.origenes.create');
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id) {
        $data = Origen::findOrFail($id);

        return view('solicitudes.origenes.edit', ['item' => $data->toJson()]);
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index() {
        $origenes = Origen::all();

        return $this->respondWith($origenes, new OrigenTransformer);
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request) {

        Origen::create($request->all());

        return $this->respondWithOk(201, 'Added');
    }

    /**
     * [show description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id) {
        $origen = Origen::findOrFail($id);

        return $this->item($origen, new OrigenTransformer);
    }

    /**
     * [update description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id) {
        $origen = Origen::findOrFail($id);
        $origen->update($request->all());

        return $this->respondWithOk(201, 'Updated');
    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id) {
        Origen::destroy($id);

        return $this->respondWithOk(201, 'Deleted');
    }
}
