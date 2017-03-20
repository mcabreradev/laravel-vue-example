@ability('admin', [
  'solicitudes-browse', 'solicitudes-agentes-browse', 'solicitudes-areas-browse',
  'solicitudes-estados-browse', 'solicitudes-origenes-browse', 'solicitudes-prioridades-browse',
  'solicitudes-tipos-browse'
])
<li class="treeview">
  <a href="#">
    <span>Reclamos</span><i class="fa fa-angle-left pull-right"></i>
  </a>
  <ul class="treeview-menu">
    @ability('admin', ['solicitudes-browse'])
      <li><a href="{{ route('solicitudes::solicitudes') }}">Reclamos</a></li>
    @endability

    @ability('admin', ['solicitudes-agentes-browse', 'solicitudes-areas-browse',
      'solicitudes-estados-browse', 'solicitudes-origenes-browse',
      'solicitudes-prioridades-browse', 'solicitudes-tipos-browse'
    ])
      <li>
        <a href="#">Configuración<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
        <ul class="treeview-menu">
          @ability('admin', 'solicitudes-agentes-browse')
            <li><a href="{{ route('solicitudes::agentes.list') }}">Agentes</a></li>
          @endability

          @ability('admin', 'solicitudes-areas-browse')
            <li><a href="{{ route('solicitudes::areas.list') }}">Áreas</a></li>
          @endability

          @ability('admin', 'solicitudes-estados-browse')
            <li><a href="{{ route('solicitudes::estados.list') }}">Estados</a></li>
          @endability

          @ability('admin', 'solicitudes-origenes-browse')
            <li><a href="{{ route('solicitudes::origenes.list') }}">Orígenes</a></li>
          @endability

          @ability('admin', 'solicitudes-prioridades-browse')
            <li><a href="{{ route('solicitudes::prioridades.list') }}">Prioridades</a></li>
          @endability

          @ability('admin', 'solicitudes-tipos-browse')
            <li><a href="{{ route('solicitudes::tipos.list') }}">Tipos</a></li>
          @endability
        </ul>
      </li>
    @endability
  </ul>
</li>
@endability
