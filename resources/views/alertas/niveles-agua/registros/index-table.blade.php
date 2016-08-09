<div class="table-responsive">
  <table class="table table-striped" id="registros-nivel-table">
    <thead>
      <th>Fecha</th>
      <th>Nivel</th>
      <th>Acciones</th>
    </thead>
    <tbody>
      @foreach($registros as $registro)
        <tr>
          <td>{{ date('d/m/Y H:i:s', strtotime($registro->registrado_el)) }}</td>
          <td>{{ $registro->nivelAgua->titulo }}</td>
          <td>
            <form method="POST" action="{{ route('alertas::registros-nivel-agua.destroy', $registro->id) }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="_method" value="DELETE">

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
    $('#registros-nivel-table').on('submit', 'form', function(event){

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
