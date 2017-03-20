@ability('admin', ['admin-users-browse', 'admin-roles-browse'])
  <li class="treeview">
    <a href="#">
      <span>Admin usuarios</span><i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      @ability('admin', 'admin-users-browse')
        <li><a href="{{ route('admin::users.list') }}">Usuarios</a></li>
      @endability

      @ability('admin', 'admin-roles-browse')
        <li><a href="{{ route('admin::roles.list') }}">Roles</a></li>
      @endability

      @permission('admin-permissions-browse')
        <li><a href="{{ route('admin::permissions.list') }}">Permisos</a></li>
      @endpermission
    </ul>
  </li>
@endability
