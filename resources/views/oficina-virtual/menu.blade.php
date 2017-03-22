@ability('admin', ['usuario-web'])
<li class="treeview">
  <a href="#">
    <span>Oficina Virtual</span><i class="fa fa-angle-left pull-right"></i>
  </a>
  <ul class="treeview-menu">
    <li><a href="{{ route('oficina-virtual::boletas-de-pago') }}">Boletas de Pago</a></li>
  </ul>
</li>
@endability
