@extends('layouts.app')

@section('content-header')
    Pedido
    <small>editando</small>
@endsection

                
@section('content-breadcrumb')
    <li><a href="{{ route('pedidos.index') }}"> Pedidos</a></li>
@endsection
          

@section('content')
    <div class="row">
        <div class="col-xs-12">
            
            <div class="box">
                <div class="box-header with-border">
                    <h1>Edición de un pedido</h1>

                    @include('flash::message')
                </div>

                <div class="box-body">
                    <form role="form" method="POST" action="{{ route('pedidos.update', ['id' => $pedido->id]) }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">

                        <h2>Datos del usuario</h2>
                        @include('oficina-virtual.usuarios.fields')

                        <h2>Datos del pedido</h2>
                        @include('oficina-virtual.pedidos.fields')

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
