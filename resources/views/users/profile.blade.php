@extends('layouts.app')

@section('content-header')
    Perfil de usuario
    <small>tu información</small>
@endsection
          

@section('content')
    <div class="row">
        <div class="col-xs-12">
            
            <div class="box">
                <div class="box-header with-border">
                    <h1>Tu perfil</h1>

                    @include('flash::message')
                </div>

                <div class="box-body">
                    <form role="form" method="POST" action="{{ route('users.profile') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="_method" value="PUT">

                        @include('users.fields')
                    </form>
                </div>

                <div class="box-footer">
                    
                </div>
            </div> <!-- .box -->

        </div>
    </div>
@endsection
