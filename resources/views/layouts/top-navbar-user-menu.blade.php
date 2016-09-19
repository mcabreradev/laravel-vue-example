@if(auth()->check())
<!-- User Account Menu -->
<li class="dropdown user user-menu">
  <!-- Menu Toggle Button -->
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <!-- The user image in the navbar-->
    <img src="{{ asset('img/user-avatar.png') }}" class="user-image" alt="User Image">
    <!-- hidden-xs hides the username on small devices so only the image appears. -->
    <span class="hidden-xs">{{ auth()->user()->email }}</span>
  </a>
  <ul class="dropdown-menu">
    <!-- The user image in the menu -->
    <li class="user-header">
      <img src="{{ asset('img/user-avatar.png') }}" class="img-circle" alt="User Image">

      <p>
        {{ auth()->user()->email }}
      </p>
    </li>
    <!-- Menu Body -->
    <li class="user-body">
    </li>
    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <a href="{{ route('users.profile.form') }}" class="btn btn-default btn-flat">Perfil</a>
      </div>
      <div class="pull-right">
        <a href="{{ route('auth::logout') }}" class="btn btn-default btn-flat">Cerrar sesión</a>
      </div>
    </li>
  </ul>
</li>
@endif
