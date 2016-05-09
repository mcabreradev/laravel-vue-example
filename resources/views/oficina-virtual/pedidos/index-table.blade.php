<div class="table-responsive">
    <table class="table">
        <thead>
            <th>Fecha</th>
            <th>Número</th>
            <th>Tipo</th>
            <th>Usuario</th>
            <th>Observaciones</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->created_at }}</td>
                <td>{{ $pedido->id }}</td>
                <td>{{ $pedido->tipo }}</td>
                <td>{{ $pedido->usuario->getNombreCompleto() }}</td>
                <td>{{ str_limit($pedido->observaciones, 60) }}</td>
                <td>
                    
                    <div class='btn-group'>
                        <form method="POST" action="{{-- route('pedidos.destroy', $pedido->id) --}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <a href="{{ route('pedidos.edit', ['id' => $pedido->id]) }}" class='btn btn-success btn-sm'>
                                <span class="fa fa-pencil"></span>
                            </a>

                            @if($pedido->estado !== 'Pendiente')
                                <a href="#" class='btn btn-primary btn-sm'>
                                    <span class="fa fa-paper-plane"></span>
                                </a>
                            @endif

                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('¿Estás seguro/a?')">
                                <span class="fa fa-trash"></span>
                            </button>
                        </form>
                    </div>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>