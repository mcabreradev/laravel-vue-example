@extends('layouts.app')

@section('content-header')
  Roles <small>administración</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{route('admin::roles.main')}}">Roles</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <panal-table
      :model='{singular: "rol", plural: "roles"}'
      :url="{
        index: 'admin::roles.index',
        store: 'admin::roles.store',
        update: 'admin::roles.update',
        destroy: 'admin::roles.destroy'
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
