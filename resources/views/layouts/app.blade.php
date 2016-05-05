@extends('layouts.base')

@section('body-content')
    <div class="wrapper">

        <!-- Main Header -->
        @include('layouts.top-navbar')

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.main-sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @section('content-header')
                    Page Header
                    <small>Optional description</small>
                    @show
                </h1>

                <ol class="breadcrumb">
                    @yield('content-breadcrumb')
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
        </div> <!-- /.content-wrapper -->

        <!-- Main Footer -->
        {{-- @include('layouts.footer') --}}

        <!-- Control Sidebar -->
        {{-- @include('layouts.alternative-sidebar') --}}

    </div><!-- ./wrapper -->
@endsection
