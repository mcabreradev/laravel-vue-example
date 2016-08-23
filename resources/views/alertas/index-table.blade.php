<div class="table-responsive">
  <table class="table table-striped" id="alertas-table">
    <thead>
      <th>Inicio</th>
      <th>Fin</th>
      <th>Descripción</th>
      <th>Acciones</th>
    </thead>
    <tbody>
      @foreach($alertas as $alerta)
      <tr>
        <td>{{ date('d/m/Y H:i:s', strtotime($alerta->inicia_el)) }}</td>
        <td>{{ date('d/m/Y H:i:s', strtotime($alerta->finaliza_el)) }}</td>
        <td>{{ $alerta->descripcion }}</td>
        <td>
          <form method="POST" action="{{ route('alertas::destroy', $alerta->id) }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="_method" value="DELETE">

              <a href="{{ route('alertas::edit', $alerta->id) }}" class="btn btn-primary btn-sm" title="editar">
                <span class="fa fa-pencil"></span>
              </a>

              <button class="btn btn-danger btn-sm" type="submit" title="Eliminar">
                <span class="fa fa-times"></span>
              </button>

            </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>


@section('body-scripts')
@parent

<script type="text/javascript">
  (function($, swal){
    $('#alertas-table').on('submit', 'form', function(event){

      event.preventDefault();

      swal({
        title: "¿Estás seguro?",
        text: "El registro se va a eliminar",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: 'No del todo',
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Seguro!",
        closeOnConfirm: false
      },
      function() {
        event.target.submit();
      });
    });
  })(window.jQuery, window.swal);
</script>

@endsection
