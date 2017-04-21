<?php

namespace app\Http\Controllers\OficinaVirtual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LibreDeudaController extends Controller
{
    public function solicitarLibreDeuda()
    {
        return view('oficina-virtual.libre-deuda.solicitar', [
            'conexiones' => Auth::user()->conexiones()->get()
        ]);
    }
}
