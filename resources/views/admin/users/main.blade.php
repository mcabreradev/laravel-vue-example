@extends('layouts.app')

@section('content-header')
  Usuarios <small>administración</small>
@endsection


@section('content-breadcrumb')
<li><a href="{{route('admin::users.list')}}">usuarios</a></li>
@endsection


@section('content')

<div class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <panal-table
      :model='{singular: "usuario", plural: "usuarios"}'
      :has-modal="false"
      :url="{
        index: 'admin::users',
        create: 'admin::users.create',
        store: 'admin::users.store',
        edit: 'admin::users.edit',
        update: 'admin::users.update',
        destroy: 'admin::users.destroy'
      }"
      :fields="[
        {name: 'name', title: 'Nombre', type: 'text', required: true},
        {name: 'email', title:'Email', type: 'text', required: true},
        {name: 'roles', title: 'Roles', type: 'text'}
      ]"
    ></panal-table>
  </div>
</div>

@endsection
