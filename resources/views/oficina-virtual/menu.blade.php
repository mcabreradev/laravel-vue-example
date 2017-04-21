<li class="{{ activeIfRouteIs('users/dashboard') }}"><a href="{{ route('users.dashboard') }}">Inicio</a></li>
<li class="{{ activeIfRouteIs('users/profile') }}"><a href="{{ route('users.profile') }}">Tus datos</a></li>
<li class="{{ activeIfRouteIs('oficina-virtual/notificaciones') }}"><a href="{{ route('oficina-virtual::notificaciones.de-usuario') }}">Notificaciones</a></li>
<li class="treeview">
    <a href="#">
      <span>Estado de cuenta</span><i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('oficina-virtual::conexiones.vinculadas') }}">Cuentas vinculadas</a></li>
      <li><a href="{{ route('oficina-virtual::boletas-de-pago') }}">Boletas de pago</a></li>
      <li><a href="{{ route('oficina-virtual::deudas-pendientes') }}">Deudas pendientes</a></li>
      <li><a href="{{ route('oficina-virtual::resumen-historico-facturas') }}">Resumen histórico</a></li>
    </ul>
</li>
<li class="{{ activeIfRouteIs('*/solicitar-libre-deuda') }}"><a href="{{ route('oficina-virtual::solicitar-libre-deuda') }}">Solicitar Libre Deuda</a></li>
<li><a href="//dposs.gob.ar/#!/pagina/estado-de-la-red" target="_blank" rel="noopener noreferrer">Estado de la red</a></li>

