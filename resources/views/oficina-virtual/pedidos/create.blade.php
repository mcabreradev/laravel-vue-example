@extends('layouts.app')

@section('content-header')
    Pedido
    <small>creando nuevo</small>
@endsection

                
@section('content-breadcrumb')
    <li><a href="{{ route('pedidos.index') }}"> Pedidos</a></li>
@endsection
          

@section('content')
    <div class="row">
        <div class="col-xs-12">
            
            <div class="box">
                <div class="box-header with-border">
                    <h1>Creación de un pedido</h1>

                    @include('flash::message')
                </div>

                <div class="box-body">
                    <form role="form" method="POST" action="{{ route('pedidos.store') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>Datos del Solicitante</h3>
                            </div>
                            <div class="panel-body">
                                @include('oficina-virtual.pedidos.fields-solicitante')
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>Datos del Titular</h3>
                            </div>
                            <div class="panel-body">
                                @include('oficina-virtual.usuarios.fields')
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>Datos del pedido</h3>
                            </div>
                            <div class="panel-body">
                                @include('oficina-virtual.pedidos.fields')
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="form-group">
                                <div class="pull-right">
                                    <a href="{{ route('pedidos.index') }}" class="btn btn-default">
                                        <span class="fa fa-undo"></span> Cancelar
                                    </a>

                                    <button class="btn btn-success" type="submit">
                                        <span class="fa fa-check"></span> Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="box-footer">
                    
                </div>
            </div> <!-- .box -->

        </div>
    </div>
@endsection
