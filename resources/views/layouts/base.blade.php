<!DOCTYPE html>
<html>
<head>
    @include('layouts.head-commons')
    @yield('head-scripts')
</head>

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body
    @section('body-attributes')
      class="hold-transition skin-blue fixed"
    @show
>
    @yield('body-content')

    @include('layouts.body-commons')
    @yield('body-scripts')
</body>
</html>
