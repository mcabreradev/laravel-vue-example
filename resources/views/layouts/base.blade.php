<!DOCTYPE html>
<html>
<head>
    @include('layouts.head-commons')
    @yield('head-scripts')
</head>

<body
    @section('body-attributes')
      class="hold-transition skin-blue fixed"
    @show>

    <div id="app">
      @yield('body-content')
    </div>

    @include('layouts.body-commons')
    @yield('body-scripts')
    @stack('body-scripts')
</body>
</html>
