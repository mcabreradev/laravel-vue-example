<?php

namespace App\Http\Controllers\Solicitudes;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\ApiController;
use App\Models\Solicitudes\Area;
use App\Transformers\Solicitudes\AreaTransformer;

class AreasController extends ApiController
{
    /**
     * [main description]
     * @return [type] [description]
     */
    public function main(){
        return view('solicitudes.areas.main');
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create(){
        return view('solicitudes.areas.create');
    }

    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id) {
        $data = Area::findOrFail($id);
        return view('solicitudes.areas.edit', ['item' => $data->toJson()]);
    }

    /**
     * [index description]
     * @return [type] [description]
     */
    public function index() {
        $tipos = Area::orderBy('nombre', 'asc')->get();
        return $this->respondWith($tipos, new AreaTransformer);
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request) {
        Area::create($request->all());
        return $this->respondWithOk(201, 'Added');
    }

    public function show($id) {
        $tipo = Area::findOrFail($id);
        return $this->item($tipo, new AreaTransformer);
    }

    /**
     * [update description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id) {
        $tipo = Area::findOrFail($id);
        $tipo->update($request->all());
        return $this->respondWithOk(200, 'Updated');
    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id) {
        Area::destroy($id);
        return $this->respondWithOk(200, 'Deleted');
    }
}
