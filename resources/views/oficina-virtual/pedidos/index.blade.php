@extends('layouts.app')

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
                    <h1>Lista de Pedidos existentes</h1>
                    @include('flash::message')
                </div>

                <div class="box-body">
                    <a class="btn btn-primary pull-right" href="{{ route('pedidos.create') }}">
                        <span class="fa fa-plus"></span> Nuevo pedido
                    </a>
                    <div class="clearfix"></div>

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
