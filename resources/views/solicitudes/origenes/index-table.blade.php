<template id="turnos-table-template">
  <div class="well text-center" v-if="turnos.length === 0">No hay turnos</div>
  <div class="table-responsive" v-if="turnos.length > 0">
    <table class="table table-bordered">
      <thead>
        <tr class="active">
          <th>Fecha</th>
          <th>Hora</th>
          <th>Apellido</th>
          <th>Nombre</th>
          <th>DNI</th>
          <th>Teléfono</th>
          <th>Correo</th>
          <th>Observaciones</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-bind:class="{ 'success': turno.atendido }" v-for="turno in turnos">
          <td>@{{ turno.fecha | dateOnly }}</td>
          <td>@{{ turno.hora | hourSecondsOnly }}</td>
          <td>@{{ turno.usuario.apellido }}</td>
          <td>@{{ turno.usuario.nombre }}</td>
          <td>@{{ turno.usuario.documento }}</td>
          <td>@{{ turno.usuario.movil }}</td>
          <td>@{{ turno.usuario.telefono }}</td>
          <td>@{{ turno.observaciones }}</td>
          <td>
            <button v-if="!turno.atendido" @click="seleccionarTurno(turno)" class="btn btn-primary btn-sm" title="Validar atención">
              <span class="fa fa-check"></span>
            </button>
            <button v-if="!turno.atendido" @click="cancelar(turno)" class="btn btn-danger btn-sm" type="submit" title="Cancelar turno">
              <span class="fa fa-times"></span>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
