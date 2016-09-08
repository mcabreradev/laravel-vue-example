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
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
