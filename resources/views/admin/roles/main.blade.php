@extends('layouts.app')

@section('content-header')
  Roles <small>administración</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{route('admin::roles.list')}}">Roles</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <panal-table
      :model='{singular: "rol", plural: "roles"}'
      :has-modal="false"
      :url="{
        index: 'admin::roles',
        create: 'admin::roles.create',
        store: 'admin::roles.store',
        edit: 'admin::roles.edit',
        update: 'admin::roles.update',
        destroy: 'admin::roles.destroy'
      }"
      :fields="[
        {name: 'display_name', title:'Nombre', type: 'text'},
        {name: 'users_count', title: '# Usuarios', type: 'text'},
        {name: 'permissions_count', title: '# Permisos', type: 'text'}
        ]"
    ></panal-table>
  </div>
</div>

@endsection
