<?php

namespace App\Http\Controllers\Plantas;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plantas\NivelAguaPlanta;

class NivelAguaPlantaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $niveles = NivelAguaPlanta::all();

        return view('plantas.niveles.index')
            ->with('niveles', $niveles);
    }
}
