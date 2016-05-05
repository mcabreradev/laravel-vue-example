<div class="table-responsive">
    <table class="table">
        <thead>
            <th>Fecha</th>
            <th>Tipo</th>
            <th>Descripcion</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->created_at }}</td>
                <td>{{ $pedido->tipo }}</td>
                <td>{{ str_limit($pedido->descripcion, 60) }}</td>
                <td>
                    
                    <div class='btn-group'>
                        <form method="POST" action="{{ route('pedidos.destroy', $pedido->id) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">

                            <a href="{{ route('pedidos.edit', $pedido->id) }}" class='btn btn-default btn-sm'>
                                <span class="fa fa-pencil"></span>
                            </a>

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