@ability('superadmin', ['browse-alertas-mapa', 'browse-alertas-nivel-agua'])
  <li class="treeview">
    <a href="#">
      <span>Alertas</span><i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      @ability('superadmin', ['browse-alertas-mapa'])
        <li><a href="{{ route('alertas::index') }}">Mapa</a></li>
      @endability

      @ability('superadmin', ['browse-alertas-nivel-agua'])
        <li><a href="{{ route('alertas::registros-nivel-agua.index') }}">Nivel de Agua</a></li>
      @endability
    </ul>
  </li>
@endability
