@extends('layouts.app')

@section('head-scripts')
    <meta http-equiv="refresh" content="350">
@endsection

@section('content-header')
    Pedidos
@endsection

                
@section('content-breadcrumb')
    <li><a href="{{ route('pedidos.index') }}"> Pedidos</a></li>
@endsection
                

@section('content')
    <div class="row">
        <div class="col-xs-12">
            
            <div class="box">
                <div class="box-header with-border">
                    <h1>Lista de pedidos {{ $estado }}</h1>
                    <small class="text-danger">Las filas marcadas en rojo son los pedidos prioritarios</small>
                    @include('flash::message')
                </div>

                <div class="box-body">

                    <a class="btn btn-primary pull-right" href="{{ route('pedidos.create') }}">
                        <span class="fa fa-plus"></span> Nuevo pedido
                    </a>

                    <ul class="nav nav-tabs">
                        <li role="presentation" class="{{ ($estado === 'pendientes' ? 'active' : '') }}">
                            <a href="{{ route('pedidos.index', ['estado' => 'pendientes']) }}">Pendientes</a>
                        </li>
                        <li role="presentation" class="{{ ($estado === 'generados' ? 'active' : '') }}">
                            <a href="{{ route('pedidos.index', ['estado' => 'generados']) }}">Generados</a>
                        </li>
                        <li role="presentation" class="{{ ($estado === 'entregados' ? 'active' : '') }}">
                            <a href="{{ route('pedidos.index', ['estado' => 'entregados']) }}">Entregados</a>
                        </li>
                        <li role="presentation" class="{{ ($estado === 'cancelados' ? 'active' : '') }}">
                            <a href="{{ route('pedidos.index', ['estado' => 'cancelados']) }}">Cancelados</a>
                        </li>
                    </ul>

                    @if($pedidos->isEmpty())
                        <div class="well text-center">No hay Pedidos</div>
                    @else
                        @include('oficina-virtual.pedidos.index-table')
                    @endif
                </div>

                <div class="box-footer">
                    
                </div>
            </div> <!-- .box -->

        </div>
    </div>
@endsection
