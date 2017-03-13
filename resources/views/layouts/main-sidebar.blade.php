<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- search form (Optional) -->
    <!-- <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form> -->
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">

      <li class="header">Módulos</li>
      <!-- Optionally, you can add icons to the links -->
      <li class="treeview">
        <a href="#">
          <span>Admin usuarios</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="#">Usuarios</a></li>
          <li><a href="#">Roles</a></li>
          <li><a href="#">Permisos</a></li>
        </ul>
      </li>

      <li>
        <a href="{{ route('pedidos.index', ['estado' => 'pendientes']) }}">
          <span>Pedidos</span>
        </a>
      </li>

      <li class="treeview">
        <a href="#">
          <span>Alertas</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('alertas::index') }}">Mapa</a></li>
          <li><a href="{{ route('alertas::registros-nivel-agua.index') }}">Nivel de Agua</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <span>Turnos</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('turnos::index') }}">Turnos asignados</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <span>Reclamos</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('solicitudes::solicitudes') }}">Reclamos</a></li>
          <li>
            <a href="#">Configuración<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
              <li><a href="{{ route('solicitudes::agentes.list') }}">Agentes</a></li>
              <li><a href="{{ route('solicitudes::areas.list') }}">Áreas</a></li>
              <li><a href="{{ route('solicitudes::estados.list') }}">Estados</a></li>
              <li><a href="{{ route('solicitudes::origenes.list') }}">Orígenes</a></li>
              <li><a href="{{ route('solicitudes::prioridades.list') }}">Prioridades</a></li>
              <li><a href="{{ route('solicitudes::tipos.list') }}">Tipos</a></li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
