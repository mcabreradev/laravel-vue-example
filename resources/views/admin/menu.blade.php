@ability('superadmin', ['browse-users', 'browse-roles'])
  <li class="treeview">
    <a href="#">
      <span>Admin usuarios</span><i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      @ability('superadmin', 'browse-users')
        <li><a href="{{ route('admin::users.list') }}">Usuarios</a></li>
      @endability

      @ability('superadmin', 'browse-users')
        <li><a href="{{ route('admin::roles.list') }}">Roles</a></li>
      @endability

      @role('superadmin')
        <li><a href="{{ route('admin::permissions.list') }}">Permisos</a></li>
      @endrole
    </ul>
  </li>
@endability
