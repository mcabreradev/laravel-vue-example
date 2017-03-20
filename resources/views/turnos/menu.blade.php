@ability('admin', ['turnos-browse'])
<li class="treeview">
  <a href="#">
    <span>Turnos</span><i class="fa fa-angle-left pull-right"></i>
  </a>
  <ul class="treeview-menu">
    <li><a href="{{ route('turnos::index') }}">Turnos asignados</a></li>
  </ul>
</li>
@endability
