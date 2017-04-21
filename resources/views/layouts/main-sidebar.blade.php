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

      @include('oficina-virtual.menu')

      @if(auth()->user()->roles()->count())
        <li class="header">Administración</li>
      @endif

      @include('admin.menu')

      {{-- @include('oficina-virtual.pedidos.menu') --}}

      @include('alertas.menu')

      @include('turnos.menu')

      @include('solicitudes.menu')

    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
