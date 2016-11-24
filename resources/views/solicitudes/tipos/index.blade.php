@extends('layouts.app')

@section('content-header')
Turnos asignados
@endsection


@section('content-breadcrumb')
<li><a href="{{ route('turnos::index') }}">Turnos asignados</a></li>
@endsection


@section('content')

<div id="turnos-tables-container" class="row">
  <div class="col-xs-12">

    @include('flash::message')

    <div class="box">
      <div class="box-header with-border">
        <h1>Turnos Asignados</h1>
      </div>

      <div class="box-body">
        <turnos-table url="{{ route('turnos::asignados-por-actividad', 1) }}"></turnos-table>
      </div>
    </div> <!-- .box -->

    <div class="box">
      <div class="box-header with-border">
        <h1>Turnos vencidos</h1>
      </div>

      <div class="box-body">
        <turnos-table url="{{ route('turnos::vencidos-por-actividad', 1) }}"></turnos-table>
      </div>
    </div> <!-- .box -->

  </div>
</div>

<div id="validar-turno-container">
  <validar-turno></validar-turno>
</div>

<template id="validar-turno-template">

  <div id="validar-turno-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Validar atención turno</h4>
        </div>
        <div class="modal-body">

          <div class="alert alert-info" role="alert">
            <p>Revisá que la información sea correcta antes de confirmar el turno</p>
          </div>

          <div class="form-group">
            <label for="usuario-apellido">Apellido</label>
            <input id="usuario-apellido" name="usuario-apellido" class="form-control" type="text" v-model="turno.usuario.apellido">
          </div>

          <div class="form-group">
            <label for="usuario-nombre">Nombre</label>
            <input id="usuario-nombre" name="usuario-nombre" class="form-control" type="text" v-model="turno.usuario.nombre">
          </div>

          <div class="form-group">
            <label for="usuario-documento">DNI/CUIT</label>
            <input id="usuario-documento" name="usuario-documento" class="form-control" type="text" v-model="turno.usuario.documento">
          </div>

          <div class="form-group">
            <label for="usuario-movil">Teléfono</label>
            <input id="usuario-movil" name="usuario-movil" class="form-control" type="text" v-model="turno.usuario.movil">
          </div>

          <div class="form-group">
            <label for="usuario-email">Correo electrónico</label>
            <input id="usuario-email" name="usuario-email" class="form-control" type="text" v-model="turno.usuario.email">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-success" @click="validarAtencion()">Confirmar atención</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</template>

@include('turnos.index-table')

@endsection

@section('body-scripts')
@parent

<script>
  (function($, Vue, moment){
    'use strict';

    Vue.filter('dateOnly', function (value) {
      return moment(value).format('DD/MM/Y');
    });

    Vue.filter('hourSecondsOnly', function (value) {
      return moment(value, 'HH:mm:ss').format('HH:mm');
    });

    Vue.component('validar-turno', {
      template: '#validar-turno-template',

      data: function() {
        return {
          turno: {},
          successCallback: function(){}
        }
      },

      methods: {
        openModal: function() {
          $(this.$el).modal('show');
        },

        validarAtencion: function() {
          var self = this;

          $.ajax({
            url: '{{route('turnos::validar-atencion', '')}}/' + self.turno.id,
            method: 'POST',
            data: {
              _token: '{{ csrf_token() }}',
              _method: 'put',
              usuario: self.turno.usuario
            }
          }).done(function(data){
            self.successCallback();
            $(self.$el).modal('hide');
            swal('Éxito!', 'El turno se borró correctamente', 'success');
          }).fail(function(){
            swal('Ops!', 'Algo salió mal. Intentalo nuevamente', 'error');
          });
        }
      }
    });

    var validarTurnoVue = new Vue({
      el: '#validar-turno-container'
    });

    Vue.component('turnos-table', {
      template: '#turnos-table-template',

      props: ['url'],

      data: function() {
        return {
          turnos: []
        }
      },

      methods: {
        cancelar: function(turno) {
          var self = this;

          swal(
            {
              title: "¿Querés cancelar el turno?",
              text: "El turno se va a canelar",
              type: "warning",
              showCancelButton: true,
              cancelButtonText: 'Me equivoqué',
              confirmButtonColor: '#DD6B55',
              confirmButtonText: 'Cancelar el turno',
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            },
            function() {
              $.ajax({
                url: '{{route('turnos::destroy', '')}}/' + turno.id,
                method: 'POST',
                data: {
                  _token: '{{ csrf_token() }}',
                  _method: 'delete'
                }
              }).done(function(data){
                self.turnos.$remove(turno);
                swal('Éxito!', 'El turno se borró correctamente', 'success');
              }).fail(function(){
                swal('Ops!', 'Algo salió mal. Intentalo nuevamente', 'error');
              });
            }
          );
        }, // cancelar,

        getTurnos: function() {
          var self = this;

          $.getJSON(this.url, function(data){
            self.turnos = data;
          });
        },

        seleccionarTurno: function(turno) {
          validarTurnoVue.$children[0].$set('turno', turno);
          validarTurnoVue.$children[0].$set('successCallback', this.getTurnos);
          validarTurnoVue.$children[0].openModal();
        }
      }, // methods

      created: function() {
        var self = this;
        self.getTurnos();
        setInterval(function(){ self.getTurnos() }, 5000);
      }
    });

    new Vue({
      el: '#turnos-tables-container'
    });

  })(window.jQuery, window.Vue, window.moment);
</script>

@endsection
