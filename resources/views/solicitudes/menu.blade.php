@ability('superadmin', ['browse-reclamos', 'browse-reclamos-agentes', 'browse-reclamos-areas', 'browse-reclamos-estados', 'browse-reclamos-origenes', 'browse-reclamos-prioridades', 'browse-reclamos-tipos'])
<li class="treeview">
  <a href="#">
    <span>Reclamos</span><i class="fa fa-angle-left pull-right"></i>
  </a>
  <ul class="treeview-menu">
    @ability('superadmin', ['browse-reclamos'])
      <li><a href="{{ route('solicitudes::solicitudes') }}">Reclamos</a></li>
    @endability

    @ability('superadmin', ['browse-reclamos-agentes', 'browse-reclamos-areas', 'browse-reclamos-estados', 'browse-reclamos-origenes', 'browse-reclamos-prioridades', 'browse-reclamos-tipos'])
      <li>
        <a href="#">Configuración<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu">
          @ability('superadmin', 'browse-reclamos-agentes')
            <li><a href="{{ route('solicitudes::agentes.list') }}">Agentes</a></li>
          @endability

          @ability('superadmin', 'browse-reclamos-areas')
            <li><a href="{{ route('solicitudes::areas.list') }}">Áreas</a></li>
          @endability

          @ability('superadmin', 'browse-reclamos-estados')
            <li><a href="{{ route('solicitudes::estados.list') }}">Estados</a></li>
          @endability

          @ability('superadmin', 'browse-reclamos-origenes')
            <li><a href="{{ route('solicitudes::origenes.list') }}">Orígenes</a></li>
          @endability

          @ability('superadmin', 'browse-reclamos-prioridades')
            <li><a href="{{ route('solicitudes::prioridades.list') }}">Prioridades</a></li>
          @endability

          @ability('superadmin', 'browse-reclamos-tipos')
            <li><a href="{{ route('solicitudes::tipos.list') }}">Tipos</a></li>
          @endability
        </ul>
      </li>
    @endability
  </ul>
</li>
@endability
