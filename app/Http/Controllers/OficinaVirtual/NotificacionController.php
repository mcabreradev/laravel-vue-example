<?php

namespace app\Http\Controllers\OficinaVirtual;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Response;

class NotificacionController extends Controller
{
    public function deUsuario()
    {
        return view('oficina-virtual.notificaciones.de-usuario', [
            'notificaciones' => Auth::user()->notificaciones()->get()
        ]);
    }
}
