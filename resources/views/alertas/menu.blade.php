@ability('admin', ['alertas-mapa-browse', 'alertas-nivel-agua-browse'])
  <li class="treeview">
    <a href="#">
      <span>Alertas</span><i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      @ability('admin', ['alertas-mapa-browse'])
        <li><a href="{{ route('alertas::index') }}">Mapa</a></li>
      @endability

      @ability('admin', ['alertas-nivel-agua-browse'])
        <li><a href="{{ route('alertas::registros-nivel-agua.index') }}">Nivel de Agua</a></li>
      @endability
    </ul>
  </li>
@endability
