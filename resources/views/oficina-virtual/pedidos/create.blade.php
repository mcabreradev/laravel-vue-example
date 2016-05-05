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

                        @include('oficina-virtual.pedidos.fields')
                    </form>
                </div>

                <div class="box-footer">
                    
                </div>
            </div> <!-- .box -->

        </div>
    </div>
@endsection
