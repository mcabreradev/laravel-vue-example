@ability('admin', ['pedidos-browse'])
  <li>
    <a href="{{ route('pedidos.index', ['estado' => 'pendientes']) }}">
      <span>Pedidos</span>
    </a>
  </li>
@endability
