@extends('layouts.app')

@section('content-header')
  Permisos <small>administración</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{route('admin::roles.list')}}">Roles</a></li>
<li><a href="{{route('admin::permissions.list')}}">Permisos</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <panal-table
      :model='{singular: "permiso", plural: "permiso"}'
      :url="{
        index: 'admin::permissions',
        store: 'admin::permissions.store',
        update: 'admin::permissions.update',
        destroy: 'admin::permissions.destroy'
      }"
      :fields="[
        {name: 'name', title: 'Clave', type: 'text', required: true},
        {name: 'display_name', title:'Nombre', type: 'text'},
        {name: 'description', title: 'Descripción', type: 'textarea'}
        ]"
    ></panal-table>
  </div>
</div>

@endsection
