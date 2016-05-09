<?php 

namespace app\Http\Controllers\OficinaVirtual;

use Flash;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OficinaVirtual\Pedido;
use App\Models\OficinaVirtual\Usuario;
use App\Http\Requests\OficinaVirtual\PedidoStoreRequest;
use App\Http\Requests\OficinaVirtual\PedidoUpdateRequest;

class PedidoController extends Controller
{

    /**
     * [assignarUsuario description]
     * @param  [type] $usuario [description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    protected function assignarUsuario($usuario, $request)
    {
        $usuario->fill($request->input());

        return $usuario;
    }

    /**
     * Assignacion desde el request
     * @param  [type] $trail   [description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    protected function asignarPedido($pedido, $request)
    {
        $pedido->fill($request->input());

        return $pedido;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($estado = 'pendientes')
    {
        $pedidos = Pedido::with('usuario')
                         ->orderBy('prioritario', 'desc')
                         ->orderBy('created_at');

        switch ($estado) {
            case 'pendientes':
                $pedidos = $pedidos->where('estado', '=', 'Pendiente')->get();
                break;
            case 'generados':
                $pedidos = $pedidos->where('estado', '=',  'Generado')->get();
                break;
            case 'entregados':
                $pedidos = $pedidos->where('estado', '=',  'Entregado')->get();
                break;
            default:
                $pedidos = $pedidos->where('estado', '=',  'Pendiente')->get();
                $estado  = 'pendientes';
                break;
        }

        return view('oficina-virtual.pedidos.index')
            ->with('pedidos', $pedidos)
            ->with('estado', $estado);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('oficina-virtual.pedidos.create')
            ->with('pedido', new Pedido())
            ->with('usuario', new Usuario());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PedidoStoreRequest $request)
    {
        try {
            $usuario = Usuario::where('dni', '=', $request->input('dni'))->first();

            $pedido  = $this->asignarPedido(new Pedido(), $request);
            $usuario = $this->assignarUsuario($usuario, $request);

            $usuario->save();

            $pedido->estado = Pedido::$ESTADOS[0];
            $pedido->descripcion = 'Generado por personal de la DPOSS';

            $pedido->usuario()->associate($usuario);
            $pedido->save();

            Flash::success('El registro se creó correctamente');

            return redirect(route('pedidos.index'));
        } catch (ModelNotFoundException $e) {
            Flash::error('Error al crear el registro');

            return redirect(route('pedidos.create', $id));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            $pedido = Pedido::with('usuario')->findOrFail($id);

            return view('oficina-virtual.pedidos.edit')
                ->with('pedido', $pedido)
                ->with('usuario', $pedido->usuario);
        } catch (ModelNotFoundException $e) {
            Flash::warning('No se encontró el registro a editar');

            return redirect(route('pedidos.index'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(PedidoUpdateRequest $request, $id)
    {
        try {

            $pedido = Pedido::with('usuario')->findOrFail($id);

            $pedido  = $this->asignarPedido($pedido, $request);
            $usuario = $this->assignarUsuario($pedido->usuario, $request);

            $usuario->save();

            // @TODO: automatizar
            // $pedido->estado      = 'Pendiente';

            $pedido->usuario()->associate($usuario);
            $pedido->save();

            Flash::success('El registro se modificó correctamente');

            return redirect(route('pedidos.index'));

        } catch(ModelNotFoundException $e) {

            Flash::warning('No se encontró el registro a editar');

            return redirect(route('pedidos.edit', $id));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        // @TODO
        dd($request->input());
    }
}
